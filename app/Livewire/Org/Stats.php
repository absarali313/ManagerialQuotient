<?php

namespace App\Livewire\Org;

use Livewire\Component;
use App\Models\User;
use App\Models\AssessmentResult;
use App\Models\PerformanceHistory;
use Illuminate\Support\Facades\DB;

class Stats extends Component
{
    public function getStatsProperty()
    {
        $user = auth()->user();
        $org = $user->isOrganization() ? $user->ownedOrganization : $user->organization;

        if (!$org) return [];

        $avgScore = $org->employees()
            ->whereNotNull('current_mq_score')
            ->avg('current_mq_score') ?? 0;

        $topPerformersCount = $org->employees()
            ->where('current_mq_score', '>=', 90)
            ->count();

        $atRiskCount = $org->employees()
            ->where('current_mq_score', '<', 60)
            ->count();

        $promoReadyCount = $org->employees()
            ->where('promotion_readiness', 'ready')
            ->count();

        $totalAssessed = AssessmentResult::where('organization_id', $org->id)
            ->distinct('user_id')
            ->count();

        // Sample deltas (could be calculated from history)
        return [
            [
                'label' => 'Avg MQ Score',
                'value' => number_format($avgScore, 1),
                'total' => '/100',
                'change' => '+ 4.2%',
                'change_type' => 'up',
                'icon' => 'presentation-chart-line',
                'icon_bg' => 'bg-blue-50',
                'icon_color' => 'text-blue-500',
            ],
            [
                'label' => 'Top Performers',
                'value' => $topPerformersCount,
                'change' => '+ 12',
                'change_type' => 'up',
                'icon' => 'star',
                'icon_bg' => 'bg-purple-50',
                'icon_color' => 'text-purple-600',
            ],
            [
                'label' => 'At-Risk Employees',
                'value' => $atRiskCount,
                'change' => '↑ 3',
                'change_type' => 'down',
                'icon' => 'exclamation-triangle',
                'icon_bg' => 'bg-red-50',
                'icon_color' => 'text-red-500',
            ],
            [
                'label' => 'Promotion Ready',
                'value' => $promoReadyCount,
                'change' => '— 0%',
                'change_type' => 'neutral',
                'icon' => 'rectangle-stack',
                'icon_bg' => 'bg-yellow-50',
                'icon_color' => 'text-yellow-600',
            ],
            [
                'label' => 'Total Assessed',
                'value' => $totalAssessed,
                'change' => '↑ 14',
                'change_type' => 'up',
                'icon' => 'users',
                'icon_bg' => 'bg-gray-50',
                'icon_color' => 'text-gray-500',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.org.stats', [
            'stats' => $this->stats
        ]);
    }
}
