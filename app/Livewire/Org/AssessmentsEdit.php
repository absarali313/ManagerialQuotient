<?php

namespace App\Livewire\Org;

use App\Models\Assessment;
use App\Models\JobRole;
use App\Models\EvaluationCycle;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class AssessmentsEdit extends Component
{
    public Assessment $assessment;
    
    public int|null $job_role_id = null;
    public int|null $evaluation_cycle_id = null;
    public int $level = 1;
    public int $duration_minutes = 45;
    public string $status = 'pending';
    public string|null $due_at = null;

    public function mount(Assessment $assessment): void
    {
        $this->assessment = $assessment;
        $this->job_role_id = $assessment->job_role_id;
        $this->evaluation_cycle_id = $assessment->evaluation_cycle_id;
        $this->level = $assessment->level;
        $this->duration_minutes = $assessment->duration_minutes;
        $this->status = $assessment->status;
        $this->due_at = $assessment->due_at ? $assessment->due_at->format('Y-m-d') : null;
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

    public function update(): void
    {
        $this->validate([
            'job_role_id' => 'required|exists:job_roles,id',
            'evaluation_cycle_id' => 'required|exists:evaluation_cycles,id',
            'level' => 'required|integer|min:1|max:5',
            'duration_minutes' => 'required|integer|min:5|max:300',
            'due_at' => 'nullable|date|after:today',
            'status' => 'required|in:pending,in_progress,completed,expired',
        ]);

        $this->assessment->update([
            'job_role_id' => $this->job_role_id,
            'evaluation_cycle_id' => $this->evaluation_cycle_id,
            'level' => $this->level,
            'duration_minutes' => $this->duration_minutes,
            'status' => $this->status,
            'due_at' => $this->due_at,
        ]);

        session()->flash('success', 'Assessment updated successfully.');
        $this->redirect(route('org-assessments'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.org.assessments-edit', [
            'jobRoles' => $this->jobRoles,
            'cycles' => $this->cycles,
        ])->layout('components.layouts.dashboard');
    }
}
