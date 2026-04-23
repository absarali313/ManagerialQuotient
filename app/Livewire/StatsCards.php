<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EmployeeRanking;
use App\Models\PerformanceHistory;
use Illuminate\Support\Facades\Auth;

class StatsCards extends Component
{
    public function getStatsProperty()
    {
        $user = Auth::user();
        if (!$user) return [];

        $history = PerformanceHistory::where('user_id', $user->id)
            ->latest('recorded_on')
            ->first();

        $ranking = EmployeeRanking::where('user_id', $user->id)
            ->where('scope', 'team')
            ->latest('ranked_on')
            ->first();

        return [
            [
                'label' => 'My MQ Score',
                'value' => number_format($user->current_mq_score ?? 0, 0),
                'total' => '100',
                'change' => ($history && $history->score_delta >= 0 ? '+' : '') . ($history->score_delta ?? 0) . ' pts',
                'icon' => 'activity',
                'icon_bg' => 'bg-blue-50',
                'icon_color' => 'text-blue-500',
            ],
            [
                'label' => 'My Rank',
                'value' => '#' . ($ranking->rank ?? '-'),
                'subtitle' => 'in ' . ($user->team->name ?? 'Team'),
                'badge' => 'Top ' . (100 - ($ranking->percentile ?? 0)) . '%',
                'icon' => 'award',
                'icon_bg' => 'bg-yellow-50',
                'icon_color' => 'text-yellow-600',
            ],
            [
                'label' => 'Performance Change',
                'value' => ($history && $history->score_delta >= 0 ? '+' : '') . ($history->score_delta ?? 0) . '%',
                'subtitle' => 'this month',
                'icon' => 'bar-chart-2',
                'icon_bg' => 'bg-green-50',
                'icon_color' => 'text-green-500',
            ],
            [
                'label' => 'Promotion Status',
                'value' => str_replace('_', ' ', ucfirst($user->promotion_readiness ?? 'Not Set')),
                'status_icon' => $user->promotion_readiness === 'ready' ? 'check-circle' : 'trending-up',
                'icon' => 'briefcase',
                'icon_bg' => 'bg-purple-50',
                'icon_color' => 'text-purple-500',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.stats-cards', [
            'stats' => $this->stats
        ]);
    }
}
