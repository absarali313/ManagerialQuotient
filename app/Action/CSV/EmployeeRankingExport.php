<?php
namespace App\Action\CSV;

use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EmployeeRankingExport
{
    public function execute(Collection $employees, string $period): StreamedResponse
    {
        $filename = 'rankings_' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($employees, $period) {

            $handle = fopen('php://output', 'w');

            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                'Rank',
                'Name',
                'Email',
                'Department',
                'Job Role',
                'Performance Score',
                'Trend (%)',
                'Period',
            ]);

            $rank = 1;

            foreach ($employees as $employee) {
                fputcsv($handle, [
                    $rank++,
                    $employee->name,
                    $employee->email,
                    $employee->department->name ?? 'N/A',
                    $employee->jobRole->title ?? 'Employee',
                    $employee->current_mq_score,
                    $employee->latestPerformanceHistory?->score_delta ?? 'N/A',
                    $period,
                ]);
            }

            fclose($handle);

        }, $filename);
    }
}
