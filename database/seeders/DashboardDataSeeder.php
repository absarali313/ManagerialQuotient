<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Organization;
use App\Models\Team;
use App\Models\Department;
use App\Models\Kpi;
use App\Models\Assessment;
use App\Models\AssessmentResult;
use App\Models\ResultKpiScore;
use App\Models\AiInsight;
use App\Models\PerformanceHistory;
use App\Models\EmployeeRanking;
use App\Models\EvaluationCycle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DashboardDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Organization
        $org = Organization::firstOrCreate(['slug' => 'acme-corp'], [
            'name' => 'Acme Corp',
        ]);

        // 2. Create Evaluation Cycle
        $cycle = EvaluationCycle::firstOrCreate(['name' => 'Q2 2026', 'organization_id' => $org->id], [
            'starts_at' => now()->startOfQuarter(),
            'ends_at' => now()->endOfQuarter(),
            'status' => 'active',
        ]);

        // 3. Create Department & Team
        $dept = Department::firstOrCreate(['name' => 'Design', 'organization_id' => $org->id], [
            'code' => 'DSGN',
        ]);

        $team = Team::firstOrCreate(['name' => 'Product Team', 'organization_id' => $org->id], [
            'department_id' => $dept->id,
        ]);

        // 4. Use System KPIs
        $kpiMapping = [
            'Communication' => 'communication_skills',
            'Leadership' => 'leadership_style',
            'Creativity' => 'creativity',
            'Decision Making' => 'decision_making',
            'Discipline' => 'discipline',
        ];

        $kpiModels = [];
        foreach ($kpiMapping as $displayName => $slug) {
            $kpiModels[$displayName] = Kpi::where('slug', $slug)->first();
            
            // Fallback if not found for some reason
            if (!$kpiModels[$displayName]) {
                $kpiModels[$displayName] = Kpi::firstOrCreate(['slug' => $slug], [
                    'name' => $displayName,
                    'organization_id' => $org->id,
                    'is_system' => false,
                ]);
            }
        }

        // 5. Create Main User (Alex Carter)
        $user = User::updateOrCreate(['email' => 'alex@example.com'], [
            'organization_id' => $org->id,
            'department_id' => $dept->id,
            'team_id' => $team->id,
            'name' => 'Alex Carter',
            'password' => Hash::make('password'),
            'current_mq_score' => 84,
            'system_role' => 'employee',
            'promotion_readiness' => 'ready',
        ]);

        // 6. Create Assessment (Assigned to Alex)
        $assessment = Assessment::firstOrCreate([
            'organization_id' => $org->id,
            'evaluation_cycle_id' => $cycle->id,
            'assigned_to_user_id' => $user->id,
        ], [
            'level' => 1,
            'duration_minutes' => 60,
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        // 7. Create Results & KPI Scores
        $result = AssessmentResult::updateOrCreate([
            'assessment_id' => $assessment->id,
            'user_id' => $user->id,
        ], [
            'organization_id' => $org->id,
            'evaluation_cycle_id' => $cycle->id,
            'total_score' => 84,
            'performance_band' => 'High',
        ]);

        $scores = [
            'Communication' => 92,
            'Leadership' => 88,
            'Creativity' => 85,
            'Decision Making' => 74,
            'Discipline' => 62,
        ];

        foreach ($scores as $name => $val) {
            ResultKpiScore::updateOrCreate([
                'assessment_result_id' => $result->id,
                'kpi_id' => $kpiModels[$name]->id,
            ], [
                'raw_score' => $val,
                'max_score' => 100,
            ]);
        }

        // 8. Create Performance History (for Chart)
        PerformanceHistory::where('user_id', $user->id)->delete();
        $historyData = [
            ['Jan', 70], ['Feb', 75], ['Mar', 78], ['Apr', 74], ['May', 80], ['Jun', 84]
        ];

        foreach ($historyData as $idx => $data) {
            PerformanceHistory::create([
                'user_id' => $user->id,
                'organization_id' => $org->id,
                'assessment_result_id' => $result->id,
                'evaluation_cycle_id' => $cycle->id,
                'mq_score' => $data[1],
                'recorded_on' => Carbon::parse("2026-".($idx+1)."-01"),
            ]);
        }

        // 9. Create AI Insights
        AiInsight::where('user_id', $user->id)->delete();
        $insights = [
            ['SUMMARY', 'Consistent growth in Leadership metrics. Your recent project presentations boosted your Communication score by 8%.'],
            ['SUGGESTION', "Focus on cross-departmental collaboration to elevate your 'Decision Making' score next quarter."],
            ['RISK ALERT', "Slight dip in 'Discipline' metrics regarding deadline adherence in the last 2 weeks."],
        ];

        foreach ($insights as $item) {
            AiInsight::create([
                'organization_id' => $org->id,
                'user_id' => $user->id,
                'insight_type' => $item[0],
                'content' => $item[1],
            ]);
        }

        // 10. Create Rankings (Leaderboard)
        EmployeeRanking::updateOrCreate([
            'user_id' => $user->id,
            'evaluation_cycle_id' => $cycle->id,
            'scope' => 'team',
        ], [
            'organization_id' => $org->id,
            'scope_id' => $team->id,
            'rank' => 4,
            'total_in_scope' => 15,
            'mq_score' => 84,
            'percentile' => 75,
            'ranked_on' => now(),
        ]);

        // Add other users for leaderboard
        $others = [
            ['Sarah J.', 86, 3],
            ['Michael R.', 81, 5],
            ['Emily D.', 90, 1],
            ['James B.', 88, 2],
        ];

        foreach ($others as $o) {
            $u = User::updateOrCreate(['email' => str($o[0])->slug().'@example.com'], [
                'organization_id' => $org->id,
                'name' => $o[0],
                'password' => Hash::make('password'),
                'current_mq_score' => $o[1],
            ]);

            EmployeeRanking::updateOrCreate([
                'user_id' => $u->id,
                'evaluation_cycle_id' => $cycle->id,
                'scope' => 'team',
            ], [
                'organization_id' => $org->id,
                'scope_id' => $team->id,
                'rank' => $o[2],
                'mq_score' => $o[1],
                'ranked_on' => now(),
            ]);
        }
    }
}
