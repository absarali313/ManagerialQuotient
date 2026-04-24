<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AssessmentResult;
use App\Models\ResultKpiScore;
use Illuminate\Support\Facades\Auth;

class KeyTraits extends Component
{
    public function getTraitsProperty()
    {
        $user = Auth::user();
        if (!$user) return ['strengths' => [], 'focusAreas' => []];

        $latestResult = AssessmentResult::where('user_id', $user->id)
            ->latest()
            ->first();

        if (!$latestResult) return ['strengths' => [], 'focusAreas' => []];

        $scores = ResultKpiScore::where('assessment_result_id', $latestResult->id)
            ->with('kpi')
            ->orderBy('raw_score', 'desc')
            ->get();

        return [
            'strengths' => $scores->take(3)->pluck('kpi.name')->toArray(),
            'focusAreas' => $scores->reverse()->take(3)->pluck('kpi.name')->toArray(),
        ];
    }

    public function render()
    {
        return view('livewire.key-traits', $this->traits);
    }
}
