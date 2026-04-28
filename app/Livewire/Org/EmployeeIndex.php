<?php

namespace App\Livewire\Org;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeIndex extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public string $search = '';

    #[Url(except: '')]
    public string $department = '';

    #[Url(except: 'name')]
    public string $sortBy = 'name';

    #[Url(except: 'asc')]
    public string $sortDir = 'asc';

    public Organization $organization;

    // ── Lifecycle ─────────────────────────────────────────────────────────────

    public function mount(): void
    {
        $this->organization = $this->resolveOrg();
    }

    // ── Watchers ──────────────────────────────────────────────────────────────

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedDepartment(): void
    {
        $this->resetPage();
    }

    // ── Sort ──────────────────────────────────────────────────────────────────

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

    // ── Filters ───────────────────────────────────────────────────────────────

    public function resetFilters(): void
    {
        $this->reset(['search', 'department']);
        $this->resetPage();
    }

    // ── Actions ───────────────────────────────────────────────────────────────

    public function invite(): void
    {
        $this->dispatch('openModal', 'org.employees.invite');
    }

    public function editRole(int $userId): void
    {
        $this->dispatch('openModal', 'org.employees.edit-role', ['userId' => $userId]);
    }

    public function deactivate(int $userId): void
    {
        $employee = $this->resolveEmployee($userId);

        if (! $employee) {
            return;
        }

        $employee->update(['is_active' => false]);

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => "{$employee->name} has been deactivated.",
        ]);
    }

    public function activate(int $userId): void
    {
        $employee = $this->resolveEmployee($userId);

        if (! $employee) {
            return;
        }

        $employee->update(['is_active' => true]);

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => "{$employee->name} has been reactivated.",
        ]);
    }

    // ── Computed Properties ───────────────────────────────────────────────────

    #[Computed]
    public function employees(): LengthAwarePaginator
    {
        return $this->filteredQuery()->paginate(15);
    }

    #[Computed]
    public function departments(): Collection
    {
        return $this->organization->departments()->orderBy('name')->get();
    }

    #[Computed]
    public function stats(): array
    {
        $row = $this->baseQuery()->selectRaw(
            'COUNT(*) as total,
             SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) as active_count,
             AVG(CASE WHEN current_mq_score IS NOT NULL THEN current_mq_score END) as avg_score'
        )->first();

        $total = (int) ($row->total ?? 0);
        $active = (int) ($row->active_count ?? 0);
        $avgScore = $row->avg_score ?? null;

        return [
            'total' => $total,
            'active' => $active,
            'inactive' => $total - $active,
            'avgScore' => $avgScore !== null ? number_format($avgScore, 1) : '—',
        ];
    }

    // ── Query Building ────────────────────────────────────────────────────────

    /**
     * Scoped to the current org, excluding org-type accounts.
     * Eager-loads relationships needed by the table row partial.
     */
    private function baseQuery(): Builder
    {
        return User::query()
            ->where('organization_id', $this->organization->id)
            ->whereNot('user_type', 'organization')
            ->with(['department', 'jobRole']);
    }

    /**
     * Applies active search + department filters on top of the base query,
     * then applies sorting. Returns a ready-to-paginate Builder.
     */
    private function filteredQuery(): Builder
    {
        $query = $this->baseQuery();

        if ($this->search) {
            $query->whereAny(['name', 'email'], 'like', "%{$this->search}%");
        }

        if ($this->department) {
            $query->where('department_id', $this->department);
        }

        $allowedColumns = ['name', 'email', 'current_mq_score', 'created_at', 'is_active'];
        $column = in_array($this->sortBy, $allowedColumns, true) ? $this->sortBy : 'name';
        $dir = $this->sortDir === 'desc' ? 'desc' : 'asc';

        return $query->orderBy($column, $dir);
    }

    private function resolveOrg(): Organization
    {
        $user = auth()->user();

        return $user->isOrganization()
            ? $user->ownedOrganization
            : $user->organization;
    }

    private function resolveEmployee(int $userId): ?User
    {
        return User::where('id', $userId)
            ->where('organization_id', $this->organization->id)
            ->first();
    }

    public function render(): View
    {
        return view('livewire.org.employee.employee-index', [
            'employees' => $this->employees(),
            'departments' => $this->departments(),
            'stats' => $this->stats(),
        ]);
    }
}
