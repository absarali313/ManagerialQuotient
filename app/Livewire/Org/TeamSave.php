<?php

namespace App\Livewire\Org;

use App\Models\Department;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class TeamSave extends Component
{
    public ?Team $team = null;

    public string $name = '';

    public ?string $description = null;

    public ?int $departmentId = null;

    public ?int $managerUserId = null;

    public bool $isActive = true;

    public array $memberIds = [];

    public function mount(?Team $team = null): void
    {
        if ($team && $team->exists) {
            $this->team = $team;
            $this->name = $team->name;
            $this->description = $team->description;
            $this->departmentId = $team->department_id;
            $this->managerUserId = $team->manager_user_id;
            $this->isActive = $team->is_active;
            $this->memberIds = $team->members()->pluck('id')->toArray();
        }
    }

    public function getEmployeesProperty(): Collection
    {
        return User::where('organization_id', $this->organizationId())
            ->where('is_active', true)
            ->where('user_type', 'employee')
            ->orderBy('name')
            ->get();
    }

    #[\Livewire\Attributes\Computed]
    public function teamMembers(): Collection
    {
        if (empty($this->memberIds)) {
            return new Collection();
        }

        return User::whereIn('id', $this->memberIds)
            ->orderBy('name')
            ->get();
    }

    public function addMember(int $userId): void
    {
        if (!in_array($userId, $this->memberIds)) {
            $this->memberIds[] = $userId;
        }
    }

    public function removeMember(int $userId): void
    {
        $this->memberIds = array_values(array_filter($this->memberIds, fn($id) => $id !== $userId));
    }

    public function getDepartmentsProperty(): Collection
    {
        return Department::where('organization_id', $this->organizationId())
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    private function organizationId(): int
    {
        $user = auth()->user();

        return $user->isOrganization() ? $user->ownedOrganization->id : $user->organization_id;
    }

    public function save(): void
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('teams', 'name')
                    ->where('organization_id', $this->organizationId())
                    ->ignore($this->team?->id),
            ],
            'departmentId' => ['required', 'exists:departments,id'],
            'description' => ['nullable', 'string', 'max:1000'],
            'managerUserId' => ['nullable', 'exists:users,id'],
            'isActive' => ['boolean'],
        ];

        $validated = $this->validate($rules);

        $data = [
            'name' => $validated['name'],
            'department_id' => $validated['departmentId'],
            'description' => $validated['description'],
            'manager_user_id' => $validated['managerUserId'],
            'is_active' => $validated['isActive'],
            'organization_id' => $this->organizationId(),
        ];

        if (! $this->team || ! $this->team->exists) {
            $this->team = Team::create($data);
            session()->flash('success', "Team $this->name has been created.");
        } else {
            $this->team->update($data);
            session()->flash('success', "Team $this->name has been updated.");
        }

        User::where('team_id', $this->team->id)
            ->whereNotIn('id', $this->memberIds)
            ->update(['team_id' => null]);

        if (!empty($this->memberIds)) {
            User::whereIn('id', $this->memberIds)
                ->update(['team_id' => $this->team->id]);
        }

        $this->redirectRoute('org_teams_edit', ['team' => $this->team->id], navigate: true);
    }

    public function render(): View
    {
        return view('livewire.org.team.team-save');
    }
}
