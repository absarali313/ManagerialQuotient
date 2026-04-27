<?php

namespace App\Livewire\Org;

use App\Models\Assessment;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;

class AssessmentsIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $activeTab = 'All';
    public array $tabs = ['All', 'Technical', 'Soft Skills', 'Leadership', 'Compliance'];

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function deleteAssessment(Assessment $assessment): void
    {
        // Ensure user belongs to the same organization
        if ($assessment->organization_id !== auth()->user()->organization_id) {
            return;
        }

        $assessment->delete();
        session()->flash('success', 'Assessment deleted successfully.');
    }

    public function duplicateAssessment(Assessment $assessment): void
    {
        if ($assessment->organization_id !== auth()->user()->organization_id) {
            return;
        }

        $newAssessment = $assessment->replicate();
        $newAssessment->status = 'pending';
        $newAssessment->created_at = now();
        $newAssessment->save();

        session()->flash('success', 'Assessment duplicated successfully.');
    }

    /**
     * Get the filtered assessments from the database.
     */
    protected function getAssessments(): LengthAwarePaginator
    {
        $query = Assessment::query()
            ->with(['jobRole', 'questions.kpi'])
            ->where('organization_id', auth()->user()->organization_id);

        if ($this->activeTab !== 'All') {
            $query->whereHas('questions.kpi', function ($q) {
                $q->where('category', $this->activeTab);
            });
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->whereHas('jobRole', function ($inner) {
                    $inner->where('title', 'like', '%' . $this->search . '%');
                })->orWhereHas('questions', function ($inner) {
                    $inner->where('question_text', 'like', '%' . $this->search . '%');
                });
            });
        }

        return $query->latest()->paginate(10);
    }

    public function render(): View
    {
        return view('livewire.org.assessments-index', [
            'assessments' => $this->getAssessments()
        ])->layout('components.layouts.dashboard');
    }
}
