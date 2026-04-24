<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AiInsight;
use Illuminate\Support\Facades\Auth;

class AiInsights extends Component
{
    public function getInsightsProperty()
    {
        $user = Auth::user();
        if (!$user) return [];

        $dbInsights = AiInsight::where('user_id', $user->id)
            ->latest()
            ->take(3)
            ->get();

        return $dbInsights->map(function ($insight) {
            $typeMap = [
                'performance_summary' => [
                    'label' => 'SUMMARY',
                    'icon' => 'sparkles',
                    'icon_bg' => 'bg-purple-100',
                    'icon_color' => 'text-purple-600',
                ],
                'development_plan' => [
                    'label' => 'SUGGESTION',
                    'icon' => 'lightbulb',
                    'icon_bg' => 'bg-blue-100',
                    'icon_color' => 'text-blue-600',
                ],
                'risk_flag' => [
                    'label' => 'RISK ALERT',
                    'icon' => 'alert-triangle',
                    'icon_bg' => 'bg-orange-100',
                    'icon_color' => 'text-orange-600',
                    'border_color' => 'border-l-4 border-orange-500',
                ],
                'skill_gap' => [
                    'label' => 'SKILL GAP',
                    'icon' => 'target',
                    'icon_bg' => 'bg-red-100',
                    'icon_color' => 'text-red-600',
                ],
            ];

            $config = $typeMap[$insight->insight_type] ?? $typeMap['performance_summary'];
            
            return array_merge($config, [
                'type' => $config['label'],
                'content' => $insight->content,
            ]);
        })->toArray();
    }

    public function render()
    {
        return view('livewire.ai-insights', [
            'insights' => $this->insights
        ]);
    }
}
