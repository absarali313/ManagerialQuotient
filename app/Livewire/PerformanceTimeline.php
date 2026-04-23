<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PerformanceHistory;
use Illuminate\Support\Facades\Auth;

class PerformanceTimeline extends Component
{
    public string $months = '6';

    public array $ranges = [
        '3'  => '3M',
        '6'  => '6M',
        '12' => '1Y',
    ];

    public function setMonths(string $months): void
    {
        $this->months = $months;
    }

    public function getHistoryProperty()
    {
        $user = Auth::user();
        if (! $user) return collect();

        return PerformanceHistory::where('user_id', $user->id)
            ->where('recorded_on', '>=', now()->subMonths((int) $this->months)->startOfMonth())
            ->orderBy('recorded_on')
            ->get();
    }

    public function render()
    {
        $history = $this->history;
        $points = [];
        $labels = [];
        $count = $history->count();

        if ($count > 1) {
            foreach ($history as $idx => $record) {
                $points[] = ['score' => (float) $record->mq_score];
                $labels[] = $record->recorded_on->format('M');
            }
        }

        return view('livewire.performance-timeline', [
            'points' => $points,
            'labels' => $labels,
            'ranges' => $this->ranges,
        ]);
    }
}
