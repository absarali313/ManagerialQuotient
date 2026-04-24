<?php

namespace App\Livewire\Org;

use Livewire\Component;
use App\Models\PerformanceHistory;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;

class PerformanceOverTime extends Component
{
    public string $timeRange = '6';  // months: '3', '6', '12'

    public array $ranges = [
        '3' => 'Last 3 Months',
        '6' => 'Last 6 Months',
        '12' => 'Last Year',
    ];

    public function setRange(string $months): void
    {
        $this->timeRange = $months;
    }

    public function getHistoryDataProperty()
    {
        $user = auth()->user();
        $org = $user->isOrganization() ? $user->ownedOrganization : $user->organization;

        if (! $org) return collect();

        return PerformanceHistory::where('organization_id', $org->id)
            ->where('recorded_on', '>=', now()->subMonths((int) $this->timeRange)->startOfMonth())
            ->select(
                DB::raw('DATE_FORMAT(recorded_on, "%b") as month'),
                DB::raw('AVG(mq_score) as avg_score'),
                DB::raw('MIN(recorded_on) as recorded_on')
            )
            ->groupBy('month', DB::raw('YEAR(recorded_on)'), DB::raw('MONTH(recorded_on)'))
            ->orderBy('recorded_on')
            ->get();
    }

    public function render()
    {
        $history = $this->historyData;
        $points = [];
        $labels = [];
        $count = $history->count();

        if ($count > 1) {
            foreach ($history as $idx => $record) {
                $points[] = ['score' => round($record->avg_score, 1)];
                $labels[] = $record->month;
            }
        }

        return view('livewire.org.performance-over-time', [
            'points' => $points,
            'labels' => $labels,
            'ranges' => $this->ranges,
        ]);
    }
}
