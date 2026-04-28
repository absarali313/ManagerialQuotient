<?php

namespace App\Livewire\Org;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeIndex extends Component
{
    use WithPagination;

    public string $search     = '';
    public string $department = '';
    public string $sortBy     = 'name';
    public string $sortDir    = 'asc';

    private ?Organization $cachedOrg = null;

    protected array $queryString = [
        'search'     => ['except' => ''],
        'department' => ['except' => ''],
        'sortBy'     => ['except' => 'name'],
        'sortDir'    => ['except' => 'asc'],
    ];

    public function updatedSearch(): void     { $this->resetPage(); }
    public function updatedDepartment(): void { $this->resetPage(); }

    public function sort(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy  = $column;
            $this->sortDir = 'asc';
        }

        $this->resetPage();
    }

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

        if (! $employee) return;

        $employee->update(['is_active' => false]);

        $this->dispatch('notify', [
            'type'    => 'success',
            'message' => "{$employee->name} has been deactivated.",
        ]);
    }

    public function activate(int $userId): void
    {
        $employee = $this->resolveEmployee($userId);

        if (! $employee) return;

        $employee->update(['is_active' => true]);

        $this->dispatch('notify', [
            'type'    => 'success',
            'message' => "{$employee->name} has been reactivated.",
        ]);
    }

    // ── Query Building ────────────────────────────────────────────────────────

    private function baseQuery(): Builder
    {
        $org = $this->resolveOrg();

        if (! $org) {
            return User::query()->whereRaw('0 = 1');
        }

        return User::query()
            ->where('organization_id', $org->id)
            ->whereNot('user_type', 'organization')
            ->with(['department', 'jobRole']);
    }

    private function applyFilters(Builder $query): Builder
    {
        if ($this->search) {
            $query->whereAny(['name', 'email'], 'like', "%{$this->search}%");
        }

        if ($this->department) {
            $query->where('department_id', $this->department);
        }

        return $query;
    }

    private function applySort(Builder $query): Builder
    {
        $allowed = ['name', 'email', 'current_mq_score', 'created_at', 'is_active'];

        $column = in_array($this->sortBy, $allowed, true) ? $this->sortBy : 'name';
        $dir    = $this->sortDir === 'desc' ? 'desc' : 'asc';

        return $query->orderBy($column, $dir);
    }

    // ── Computed Properties ───────────────────────────────────────────────────

    public function getEmployeesProperty(): LengthAwarePaginator
    {
        $query = $this->baseQuery();
        $this->applyFilters($query);
        $this->applySort($query);

        return $query->paginate(15);
    }

    public function getDepartmentsProperty(): Collection
    {
        $org = $this->resolveOrg();

        return $org ? $org->departments()->orderBy('name')->get() : collect();
    }

    public function getStatsProperty(): array
    {
        $base = $this->baseQuery();

        $total    = (clone $base)->count();
        $active   = (clone $base)->where('is_active', true)->count();
        $inactive = $total - $active;
        $avgScore = (clone $base)->whereNotNull('current_mq_score')->avg('current_mq_score');

        return [
            'total'    => $total,
            'active'   => $active,
            'inactive' => $inactive,
            'avgScore' => $avgScore ? number_format($avgScore, 1) : '—',
        ];
    }

    // ── Private Helpers ───────────────────────────────────────────────────────

    private function resolveOrg(): ?Organization
    {
        if ($this->cachedOrg) {
            return $this->cachedOrg;
        }

        $user = auth()->user();
        if (! $user) return null;

        $this->cachedOrg = $user->isOrganization()
            ? $user->ownedOrganization
            : $user->organization;

        return $this->cachedOrg;
    }

    private function resolveEmployee(int $userId): ?User
    {
        $org = $this->resolveOrg();

        if (! $org) return null;

        return User::where('id', $userId)
            ->where('organization_id', $org->id)
            ->first();
    }

    // ── Render ────────────────────────────────────────────────────────────────

    public function render(): View
    {
        return view('livewire.org.employee.employee-index', [
            'employees'   => $this->employees,
            'departments' => $this->departments,
            'stats'       => $this->stats,
        ]);
    }
}
