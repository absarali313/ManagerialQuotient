<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AssessmentResult;
use App\Models\ResultKpiScore;
use Illuminate\Support\Facades\Auth;

class MqDimensions extends Component
{
    public function getDimensionsProperty()
    {
        $user = Auth::user();
        if (!$user) return [];

        $latestResult = AssessmentResult::where('user_id', $user->id)
            ->latest()
            ->first();

        if (!$latestResult) return [];

        $scores = ResultKpiScore::where('assessment_result_id', $latestResult->id)
            ->with('kpi')
            ->get();

        return $scores->map(function ($score) {
            $val = $score->raw_score;
            $color = 'bg-gray-500';
            if ($val >= 80) $color = 'bg-green-500';
            elseif ($val >= 70) $color = 'bg-orange-500';
            else $color = 'bg-red-500';

            return [
                'label' => $score->kpi->name ?? 'Unknown',
                'value' => (int)$val,
                'teamAvg' => 75, // Sample average
                'color' => $color,
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.mq-dimensions', [
            'dimensions' => $this->dimensions
        ]);
    }
}
