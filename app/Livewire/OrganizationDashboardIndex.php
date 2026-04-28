<?php

namespace App\Livewire;

use Livewire\Component;

class OrganizationDashboardIndex extends Component
{
    public function export(): mixed
    {
        $user = auth()->user();
        $org = $user->isOrganization() ? $user->ownedOrganization : $user->organization;

        if (!$org) {
            session()->flash('error', 'No org found.');
            return $this->redirect(request()->header('Referer') ?? '/');
        }

        $csv = "Employee,Email,Department,MQ_Score\n";
        $employees = $org->employees()->with('department')->get();
        foreach ($employees as $employee) {
            $dept = $employee->department ? $employee->department->name : 'N/A';
            $score = $employee->current_mq_score ?? '0';
            $csv .= "$employee->name,$employee->email,$dept,$score\n";
        }

        return response()->streamDownload(function () use ($csv) {
            echo $csv; // Modern standard avoiding double quotes if possible, or keeping it clean.
        }, 'org-report-' . date('Y-m-d') . '.csv');
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.organization-dashboard-index');
    }
}
