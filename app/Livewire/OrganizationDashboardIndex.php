<?php

namespace App\Livewire;

use Livewire\Component;

class OrganizationDashboardIndex extends Component
{
    public function export()
    {
        $user = auth()->user();
        $org = $user->isOrganization() ? $user->ownedOrganization : $user->organization;

        if (!$org) {
            session()->flash('error', 'No organization found.');
            return $this->redirect(request()->header('Referer'));
        }

        $csv = "Employee,Email,Department,MQ_Score\n";
        $employees = $org->employees()->with('department')->get();
        foreach ($employees as $employee) {
            $dept = $employee->department ? $employee->department->name : 'N/A';
            $score = $employee->current_mq_score ?? '0';
            $csv .= "{$employee->name},{$employee->email},{$dept},{$score}\n";
        }

        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, 'organization-report-' . date('Y-m-d') . '.csv');
    }

    public function render()
    {
        return view('livewire.organization-dashboard-index');
    }
}
