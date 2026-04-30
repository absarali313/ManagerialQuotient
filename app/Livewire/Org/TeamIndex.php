<?php

namespace App\Livewire\Org;

use App\Models\Team;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TeamIndex extends Component
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
    public function teams(): LengthAwarePaginator
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
        return Team::query()
            ->where('organization_id', $this->organizationId())
            ->with(['manager', 'department']);
    }

    private function filteredQuery(): Builder
    {
        $query = $this->baseQuery();

        if ($this->search) {
            $query->whereAny(['name'], 'like', "%{$this->search}%");
        }

        $allowedColumns = ['name', 'created_at', 'is_active'];
        $column = in_array($this->sortBy, $allowedColumns, true) ? $this->sortBy : 'name';
        $dir = $this->sortDir === 'desc' ? 'desc' : 'asc';

        return $query->orderBy($column, $dir);
    }

    private function organizationId(): int
    {
        $user = auth()->user();

        return $user->isOrganization() ? $user->ownedOrganization->id : $user->organization_id;
    }

    public function deactivate(int $teamId): void
    {
        $team = Team::where('id', $teamId)
            ->where('organization_id', $this->organizationId())
            ->first();

        if ($team) {
            $team->update(['is_active' => false]);
            session()->flash('success', "{$team->name} has been deactivated.");
        }
    }

    public function activate(int $teamId): void
    {
        $team = Team::where('id', $teamId)
            ->where('organization_id', $this->organizationId())
            ->first();

        if ($team) {
            $team->update(['is_active' => true]);
            session()->flash('success', "{$team->name} has been reactivated.");
        }
    }

    public function render(): View
    {
        return view('livewire.org.team.team-index', [
            'teams' => $this->teams(),
            'stats' => $this->stats(),
        ]);
    }
}
