<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ComingSoonController extends Controller
{
    public function __invoke(Request $request): View
    {
        $feature = $request->route()->getName();

        $labels = [
            'employees'     => 'Employee Management',
            'departments'   => 'Departments',
            'assessments'   => 'Assessments',
            'rankings'      => 'Rankings',
            'ai-insights'   => 'AI Insights',
            'reports'       => 'Reports',
            'notifications' => 'Notifications',
            'settings'      => 'Settings',
        ];

        $descriptions = [
            'employees'     => 'Add, manage, and evaluate all employees in your organization.',
            'departments'   => 'Organize your workforce into departments and track team-level performance.',
            'assessments'   => 'Design and deploy custom assessments to measure managerial intelligence.',
            'rankings'      => 'Compare and rank employees across teams, departments, or the entire organization.',
            'ai-insights'   => 'Deep-dive into AI-generated insights and recommendations for your team.',
            'reports'       => 'Generate detailed performance and benchmark reports for any period.',
            'notifications' => 'View and manage all your system notifications and alerts.',
            'settings'      => 'Configure your account, organization settings, and preferences.',
        ];

        return view('coming-soon', [
            'title'       => $labels[$feature] ?? ucfirst($feature),
            'description' => $descriptions[$feature] ?? 'This feature is coming soon.',
        ]);
    }
}
