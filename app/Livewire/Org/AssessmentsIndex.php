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

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Get the filtered assessments from the database.
     */
    protected function getAssessments(): LengthAwarePaginator
    {
        $query = Assessment::query()
            ->with(['jobRole', 'questions.kpi'])
            ->where('organization_id', auth()->user()->organization_id);

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
