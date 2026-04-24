<?php

namespace App\Livewire\Org;

use Livewire\Component;
use App\Models\AiInsight;

class AiIntelligence extends Component
{
    public function getActiveInsightsProperty()
    {
        $orgId = auth()->user()->organization_id;

        // In a real app, we might have org-wide insights.
        // For now, we take top 3 distinct insights.
        return [
            [
                'title' => 'Engineering Dept Surge',
                'description' => 'MQ scores in Engineering rose 12% this month, correlating with the new agile training completion.',
                'color' => 'bg-green-500',
            ],
            [
                'title' => 'Burnout Risk Alert',
                'description' => '3 managers in Sales show declining empathy scores alongside increased hours logged.',
                'color' => 'bg-red-500',
            ],
            [
                'title' => 'Promotion Ready',
                'description' => 'Sarah J. (Marketing) has sustained top 5% MQ scores for 3 consecutive quarters.',
                'color' => 'bg-yellow-500',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.org.ai-intelligence', [
            'insights' => $this->activeInsights
        ]);
    }
}
