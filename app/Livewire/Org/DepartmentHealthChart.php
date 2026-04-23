<?php

namespace App\Livewire\Org;

use Livewire\Component;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DepartmentHealthChart extends Component
{
    public function getDeptDataProperty()
    {
        $orgId = auth()->user()->organization_id;

        return Department::where('organization_id', $orgId)
            ->withAvg('users', 'current_mq_score')
            ->get()
            ->map(function ($dept) {
                return [
                    'label' => $dept->name,
                    'score' => $dept->users_avg_current_mq_score ?? 0,
                    'color' => $this->getColorForDept($dept->name),
                ];
            });
    }

    private function getColorForDept($name)
    {
        $map = [
            'Engineering' => 'bg-[#3B82F6]',
            'Product' => 'bg-[#8B5CF6]',
            'Sales' => 'bg-[#F59E0B]',
            'Marketing' => 'bg-[#10B981]',
            'HR' => 'bg-[#EF4444]',
        ];

        return $map[$name] ?? 'bg-gray-400';
    }

    public function render()
    {
        return view('livewire.org.department-health-chart', [
            'depts' => $this->deptData
        ]);
    }
}
