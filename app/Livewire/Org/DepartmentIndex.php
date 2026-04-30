<?php

namespace App\Livewire\Org;

use App\Models\Department;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentIndex extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public string $search = '';

    #[Url(except: 'name')]
    public string $sortBy = 'name';

    #[Url(except: 'asc')]
    public string $sortDir = 'asc';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function sort(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDir = 'asc';
        }

        $this->resetPage();
    }

    #[Computed]
    public function departments(): LengthAwarePaginator
    {
        return $this->filteredQuery()->paginate(15);
    }

    #[Computed]
    public function stats(): array
    {
        $row = $this->baseQuery()->selectRaw(
            'COUNT(*) as total,
             SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) as active_count'
        )->first();

        $total = (int) ($row->total ?? 0);
        $active = (int) ($row->active_count ?? 0);

        return [
            'total' => $total,
            'active' => $active,
            'inactive' => $total - $active,
        ];
    }

    private function baseQuery(): Builder
    {
        return Department::query()
            ->where('organization_id', $this->organizationId())
            ->with(['head']);
    }

    private function filteredQuery(): Builder
    {
        $query = $this->baseQuery();

        if ($this->search) {
            $query->whereAny(['name', 'code'], 'like', "%{$this->search}%");
        }

        $allowedColumns = ['name', 'code', 'created_at', 'is_active'];
        $column = in_array($this->sortBy, $allowedColumns, true) ? $this->sortBy : 'name';
        $dir = $this->sortDir === 'desc' ? 'desc' : 'asc';

        return $query->orderBy($column, $dir);
    }

    private function organizationId(): int
    {
        $user = auth()->user();

        return $user->isOrganization() ? $user->ownedOrganization->id : $user->organization_id;
    }

    public function deactivate(int $departmentId): void
    {
        $department = Department::where('id', $departmentId)
            ->where('organization_id', $this->organizationId())
            ->first();

        if ($department) {
            $department->update(['is_active' => false]);
            session()->flash('success', "{$department->name} has been deactivated.");
        }
    }

    public function activate(int $departmentId): void
    {
        $department = Department::where('id', $departmentId)
            ->where('organization_id', $this->organizationId())
            ->first();

        if ($department) {
            $department->update(['is_active' => true]);
            session()->flash('success', "{$department->name} has been reactivated.");
        }
    }

    public function render(): View
    {
        return view('livewire.org.department.department-index', [
            'departments' => $this->departments(),
            'stats' => $this->stats(),
        ]);
    }
}
