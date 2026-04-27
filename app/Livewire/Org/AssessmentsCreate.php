<?php

namespace App\Livewire\Org;

use App\Models\Assessment;
use App\Models\JobRole;
use App\Models\User;
use App\Models\EvaluationCycle;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class AssessmentsCreate extends Component
{
    public int|null $job_role_id = null;
    public int|null $evaluation_cycle_id = null;
    public array $assigned_user_ids = [];
    public int $level = 1;
    public int $duration_minutes = 45;
    public string $status = 'pending';
    public string|null $due_at = null;

    public function mount(): void
    {
        // Default to the first active cycle if available
        $cycle = EvaluationCycle::where('organization_id', auth()->user()->organization_id)
            ->where('status', 'active')
            ->first();
        
        if ($cycle) {
            $this->evaluation_cycle_id = $cycle->id;
        }
    }

    public function getJobRolesProperty(): Collection
    {
        return JobRole::where('organization_id', auth()->user()->organization_id)
            ->where('is_active', true)
            ->get();
    }

    public function getCyclesProperty(): Collection
    {
        return EvaluationCycle::where('organization_id', auth()->user()->organization_id)
            ->latest()
            ->get();
    }

    public function getEmployeesProperty(): Collection
    {
        return User::where('organization_id', auth()->user()->organization_id)
            ->where('user_type', 'employee')
            ->where('is_active', true)
            ->get();
    }

    public function save(): void
    {
        $this->validate([
            'job_role_id' => 'required|exists:job_roles,id',
            'evaluation_cycle_id' => 'required|exists:evaluation_cycles,id',
            'assigned_user_ids' => 'required|array|min:1',
            'level' => 'required|integer|min:1|max:5',
            'duration_minutes' => 'required|integer|min:5|max:300',
            'due_at' => 'nullable|date|after:today',
        ]);

        foreach ($this->assigned_user_ids as $userId) {
            Assessment::create([
                'organization_id' => auth()->user()->organization_id,
                'evaluation_cycle_id' => $this->evaluation_cycle_id,
                'assigned_to_user_id' => $userId,
                'assigned_by_user_id' => auth()->id(),
                'job_role_id' => $this->job_role_id,
                'level' => $this->level,
                'duration_minutes' => $this->duration_minutes,
                'status' => 'pending',
                'due_at' => $this->due_at,
            ]);
        }

        session()->flash('success', count($this->assigned_user_ids) . ' assessments deployed successfully.');
        $this->redirect(route('org-assessments'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.org.assessments-create', [
            'jobRoles' => $this->jobRoles,
            'cycles' => $this->cycles,
            'employees' => $this->employees,
        ])->layout('components.layouts.dashboard');
    }
}
