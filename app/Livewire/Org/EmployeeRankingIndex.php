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

class EmployeeRankingIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $department = '';
    public string $period = 'this_month';
    public string $scoreRange = 'all';

    /**
     * Cache for the resolved organization.
     */
    private ?Organization $cachedOrg = null;

    protected array $queryString = [
        'search' => ['except' => ''],
        'department' => ['except' => ''],
        'period' => ['except' => 'this_month'],
        'scoreRange' => ['except' => 'all'],
    ];

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedDepartment(): void
    {
        $this->resetPage();
    }

    public function updatedScoreRange(): void
    {
        $this->resetPage();
    }

    public function updatedPeriod(): void
    {
        $this->resetPage();
    }

    /**
     * Reset all filters to their default values.
     */
    public function resetFilters(): void
    {
        $this->reset(['search', 'department', 'period', 'scoreRange']);
        $this->resetPage();
    }

    // ── Query Building ────────────────────────────────────────────────────────

    /**
     * Get the base query for employees with necessary relations.
     * Relations are scoped to the current period to ensure data consistency.
     */
    private function baseEmployeeQuery(): Builder
    {
        $org = $this->resolveOrg();

        if (!$org) {
            return User::query()->whereRaw('0 = 1');
        }

        return User::query()
            ->where('organization_id', $org->id)
            ->with(['department', 'jobRole', 'latestPerformanceHistory'])
            ->whereNotNull('current_mq_score');
    }

    /**
     * Apply all active filters to the employee query.
     */
    private function applyFilters(Builder $query): Builder
    {
        $this->applySearchFilter($query);
        $this->applyDepartmentFilter($query);
        $this->applyScoreRangeFilter($query);
        $this->applyPeriodFilter($query);

        return $query;
    }

    private function applySearchFilter(Builder $query): void
    {
        if ($this->search) {
            $query->whereAny(['name', 'email'], 'like', "%{$this->search}%");
        }
    }

    private function applyDepartmentFilter(Builder $query): void
    {
        if ($this->department) {
            $query->where('department_id', $this->department);
        }
    }

    private function applyScoreRangeFilter(Builder $query): void
    {
        match ($this->scoreRange) {
            'high' => $query->where('current_mq_score', '>=', 80),
            'mid'  => $query->whereBetween('current_mq_score', [60, 79.99]),
            'low'  => $query->where('current_mq_score', '<', 60),
            default => null,
        };
    }

    /**
     * Apply date-based filtering for performance records.
     * This method is used to filter the main User query based on their history.
     */
    private function applyPeriodFilter(Builder|\Illuminate\Database\Eloquent\Relations\Relation $query): void
    {
        $query->whereHas('performanceHistory', function (Builder $q) {
            $this->applyDateFilter($q);
        });
    }

    /**
     * Internal helper to apply date constraints to a PerformanceHistory query.
     */
    private function applyDateFilter(Builder|\Illuminate\Database\Eloquent\Relations\Relation $query): void
    {
        match ($this->period) {
            'this_month'   => $query->whereMonth('recorded_on', now()->month)
                                    ->whereYear('recorded_on', now()->year),
            
            'last_month'   => $query->whereMonth('recorded_on', now()->subMonth()->month)
                                    ->whereYear('recorded_on', now()->subMonth()->year),
            
            'this_quarter' => $query->whereBetween('recorded_on', [
                                    now()->startOfQuarter(), 
                                    now()->endOfQuarter()
                                ]),
            
            'this_year'    => $query->whereYear('recorded_on', now()->year),
            
            default        => null,
        };
    }

    // ── Actions ───────────────────────────────────────────────────────────────

    /**
     * Placeholder for export functionality.
     */
    public function export(): void
    {
        // TODO: Implement CSV/Excel export logic
        $this->dispatch('notify', ['type' => 'info', 'message' => 'Exporting filtered rankings...']);
    }

    /**
     * Placeholder for metric configuration.
     */
    public function configureMetrics(): void
    {
        // TODO: Open a modal to configure ranking metrics
        $this->dispatch('openModal', 'org.ranking.configure-metrics');
    }

    // ── Private Helpers ───────────────────────────────────────────────────────

    /**
     * Resolve the organization and cache it for the current request cycle.
     */
    private function resolveOrg(): ?Organization
    {
        if ($this->cachedOrg) {
            return $this->cachedOrg;
        }

        $user = auth()->user();
        if (!$user) return null;

        $this->cachedOrg = $user->isOrganization() 
            ? $user->ownedOrganization 
            : $user->organization;

        return $this->cachedOrg;
    }

    // ── Computed Properties ───────────────────────────────────────────────────

    public function getPodiumProperty(): Collection
    {
        $query = $this->baseEmployeeQuery();
        $this->applyFilters($query);

        return $query->orderByDesc('current_mq_score')
            ->take(3)
            ->get();
    }

    public function getDepartmentsProperty(): Collection
    {
        $org = $this->resolveOrg();
        return $org ? $org->departments()->orderBy('name')->get() : collect();
    }

    public function getRankedProperty(): LengthAwarePaginator
    {
        $query = $this->baseEmployeeQuery();
        $this->applyFilters($query);

        return $query->orderByDesc('current_mq_score')
            ->paginate(8);
    }

    /**
     * Get the total count of employees matching the current filters.
     */
    public function getTotalCountProperty(): int
    {
        $query = $this->baseEmployeeQuery();
        $this->applyFilters($query);
        
        return $query->count();
    }

    /**
     * Get a descriptive title for the current ranking view based on filters.
     */
    public function getRankingsTitleProperty(): string
    {
        $title = 'Employee Rankings';

        if ($this->department) {
            $dept = $this->resolveOrg()?->departments()->find($this->department);
            if ($dept) {
                $title = "{$dept->name} Rankings";
            }
        }

        return $title . ' Leaderboard';
    }

    // ── Render ────────────────────────────────────────────────────────────────

    public function render(): View
    {
        return view('livewire.org.ranking.employee-ranking', [
            'podium'      => $this->podium,
            'departments' => $this->departments,
            'ranked'      => $this->ranked,
            'totalCount'  => $this->totalCount,
        ]);
    }
}
