<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Organization;
use App\Models\Team;
use App\Models\Department;
use App\Models\JobRole;
use App\Models\Kpi;
use App\Models\KpiWeight;
use App\Models\EvaluationCycle;
use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentAnswer;
use App\Models\AssessmentResult;
use App\Models\ResultKpiScore;
use App\Models\PerformanceHistory;
use App\Models\EmployeeRanking;
use App\Models\AiInsight;
use App\Models\PerformanceAlert;
use App\Models\ManagerNote;
use App\Models\PromotionRecommendation;
use App\Models\BenchmarkReport;
use App\Models\ReportExport;
use App\Models\Notification;
use App\Models\NotificationPreference;
use App\Models\ShareableReportToken;
use App\Models\AuditLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FullSystemSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. The Organization Admin (The "Organization Login") ────────────
        $orgAdmin = User::updateOrCreate(['email' => 'admin@mqelevate.com'], [
            'name' => 'MQ Elevate Admin',
            'password' => Hash::make('password'),
            'user_type' => 'organization',
            'system_role' => 'org_admin',
            'is_active' => true,
        ]);

        // ── 2. The Organization record (Now a child of User) ─────────────────
        $org = Organization::updateOrCreate(['slug' => 'mq-elevate'], [
            'owner_user_id' => $orgAdmin->id,
            'name' => 'MQ Elevate Corp',
            'industry' => 'Technology',
            'license_type' => 'Enterprise',
            'max_users' => 1000,
            'is_active' => true,
        ]);

        // Link admin to their org
        $orgAdmin->update(['organization_id' => $org->id]);

        // ── 3. Evaluation Cycle ───────────────────────────────────────────────
        $cycle = EvaluationCycle::updateOrCreate(['name' => 'Annual Review 2026', 'organization_id' => $org->id], [
            'starts_at' => Carbon::parse('2026-01-01'),
            'ends_at' => Carbon::parse('2026-12-31'),
            'status' => 'active',
            'frequency' => 'annual',
        ]);

        // ── 4. Departments & Teams ───────────────────────────────────────────
        $depts = [];
        $deptData = [
            ['Engineering', 'ENG'],
            ['Product', 'PROD'],
            ['Sales', 'SALES'],
            ['Marketing', 'MKTG'],
            ['HR', 'HR'],
        ];

        foreach ($deptData as $d) {
            $depts[$d[0]] = Department::updateOrCreate(['name' => $d[0], 'organization_id' => $org->id], [
                'code' => $d[1],
                'is_active' => true,
            ]);
        }

        $team = Team::updateOrCreate(['name' => 'Core Platform', 'organization_id' => $org->id], [
            'department_id' => $depts['Engineering']->id,
            'is_active' => true,
        ]);

        // ── 5. Job Role ──────────────────────────────────────────────────────
        $role = JobRole::updateOrCreate(['title' => 'Senior Product Manager', 'organization_id' => $org->id], [
            'department_id' => $depts['Product']->id,
            'code' => 'SPM-1',
            'level' => 5,
            'is_active' => true,
        ]);

        // ── 6. Users (Employees) ─────────────────────────────────────────────
        // Manager
        $manager = User::updateOrCreate(['email' => 'manager@mqelevate.com'], [
            'organization_id' => $org->id,
            'department_id' => $depts['HR']->id,
            'team_id' => null,
            'name' => 'Jane Director',
            'password' => Hash::make('password'),
            'user_type' => 'employee',
            'system_role' => 'manager',
            'is_active' => true,
        ]);

        // Employees for Leaderboard and Org View
        $employeeData = [
            ['Alex Carter', 'alex@mqelevate.com', 'Engineering', 84, 'ready'],
            ['Sarah Jenkins', 'sarah@mqelevate.com', 'Marketing', 96, 'ready'],
            ['Marcus Chen', 'marcus@mqelevate.com', 'Engineering', 94, 'ready'],
            ['Elena Rodriguez', 'elena@mqelevate.com', 'Sales', 92, 'potential'],
            ['David Thompson', 'david@mqelevate.com', 'Product', 91, 'ready'],
            ['AtRisk User', 'risk@mqelevate.com', 'Sales', 45, 'not_ready'],
        ];

        $users = [];
        foreach ($employeeData as $data) {
            $users[$data[1]] = User::updateOrCreate(['email' => $data[1]], [
                'user_type' => 'employee',
                'organization_id' => $org->id,
                'department_id' => $depts[$data[2]]->id,
                'name' => $data[0],
                'password' => Hash::make('password'),
                'system_role' => 'employee',
                'current_mq_score' => $data[3],
                'promotion_readiness' => $data[4],
                'is_active' => true,
            ]);
        }

        $user = $users['alex@mqelevate.com'];
        $user->update(['reports_to_user_id' => $manager->id, 'team_id' => $team->id]);
        $team->update(['manager_user_id' => $manager->id]);

        // ── 6. KPI Weights ───────────────────────────────────────────────────
        $kpis = Kpi::all();
        foreach ($kpis as $k) {
            KpiWeight::updateOrCreate([
                'organization_id' => $org->id,
                'kpi_id' => $k->id,
            ], [
                'weight' => 20, // 5 KPIs = 100%
            ]);
        }

        foreach ($users as $email => $user) {
            // ── 7. Assessment ────────────────────────────────────────────────────
            $assessment = Assessment::updateOrCreate([
                'organization_id' => $org->id,
                'evaluation_cycle_id' => $cycle->id,
                'assigned_to_user_id' => $user->id,
            ], [
                'level' => 1,
                'duration_minutes' => 45,
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            // ── 8. Questions & Answers ───────────────────────────────────────────
            $q = AssessmentQuestion::updateOrCreate([
                'assessment_id' => $assessment->id,
                'kpi_id' => $kpis->first()->id ?? 1,
            ], [
                'question_text' => 'How do you handle conflict?',
                'question_type' => 'rating_scale',
                'max_score' => 5,
            ]);

            AssessmentAnswer::updateOrCreate([
                'assessment_id' => $assessment->id,
                'assessment_question_id' => $q->id,
            ], [
                'answer_value' => '4',
                'score' => 4,
            ]);

            // ── 9. Assessment Result ─────────────────────────────────────────────
            $result = AssessmentResult::updateOrCreate([
                'assessment_id' => $assessment->id,
            ], [
                'user_id' => $user->id,
                'organization_id' => $org->id,
                'evaluation_cycle_id' => $cycle->id,
                'raw_score' => $user->current_mq_score,
                'total_score' => $user->current_mq_score,
                'performance_band' => $user->current_mq_score >= 80 ? 'excellent' : ($user->current_mq_score >= 60 ? 'good' : 'average'),
                'ai_confidence' => 88.50,
            ]);

            // KPI Scores
            foreach ($kpis as $k) {
                ResultKpiScore::updateOrCreate([
                    'assessment_result_id' => $result->id,
                    'kpi_id' => $k->id,
                ], [
                    'raw_score' => $user->current_mq_score + rand(-5, 5),
                    'weighted_score' => ($user->current_mq_score / 5),
                    'weight_applied' => 20,
                    'max_score' => 100,
                ]);
            }

            // ── 10. Performance History ──────────────────────────────────────────
            $historyData = [
                ['2026-01-01', $user->current_mq_score - 10],
                ['2026-02-01', $user->current_mq_score - 8],
                ['2026-03-01', $user->current_mq_score - 5],
                ['2026-04-01', $user->current_mq_score - 3],
                ['2026-05-01', $user->current_mq_score - 1],
                ['2026-06-01', $user->current_mq_score],
            ];

            foreach ($historyData as $idx => $data) {
                PerformanceHistory::create([
                    'user_id' => $user->id,
                    'organization_id' => $org->id,
                    'assessment_result_id' => $result->id,
                    'evaluation_cycle_id' => $cycle->id,
                    'mq_score' => $data[1],
                    'recorded_on' => Carbon::parse($data[0]),
                    'score_delta' => $idx > 0 ? $data[1] - $historyData[$idx-1][1] : 0,
                    'performance_band' => $data[1] >= 80 ? 'excellent' : 'good',
                ]);
            }

            // ── 11. AI Insights ──────────────────────────────────────────────────
            AiInsight::create([
                'organization_id' => $org->id,
                'user_id' => $user->id,
                'assessment_result_id' => $result->id,
                'insight_type' => 'performance_summary',
                'content' => "Consistent growth for {$user->name} in Leadership metrics.",
                'confidence_score' => 88.00,
            ]);

            // ── 12. Rankings ─────────────────────────────────────────────────────
            EmployeeRanking::updateOrCreate([
                'user_id' => $user->id,
                'evaluation_cycle_id' => $cycle->id,
                'scope' => 'team',
            ], [
                'organization_id' => $org->id,
                'scope_id' => $user->team_id ?? $team->id,
                'rank' => rand(1, 15),
                'total_in_scope' => 15,
                'mq_score' => $user->current_mq_score,
                'percentile' => rand(70, 99),
                'performance_band' => $user->current_mq_score >= 80 ? 'excellent' : 'good',
                'ranked_on' => now(),
            ]);

            // Org Ranking
            EmployeeRanking::updateOrCreate([
                'user_id' => $user->id,
                'evaluation_cycle_id' => $cycle->id,
                'scope' => 'organization',
            ], [
                'organization_id' => $org->id,
                'scope_id' => null,
                'rank' => rand(1, 100),
                'total_in_scope' => 100,
                'mq_score' => $user->current_mq_score,
                'percentile' => rand(70, 99),
                'performance_band' => $user->current_mq_score >= 80 ? 'excellent' : 'good',
                'ranked_on' => now(),
            ]);
        }

        // ── 12. Performance Alerts ───────────────────────────────────────────
        PerformanceAlert::create([
            'organization_id' => $org->id,
            'user_id' => $user->id,
            'triggered_by_result_id' => $result->id,
            'alert_type' => 'score_improvement',
            'severity' => 'info',
            'message' => 'Significant improvement detected in leadership scores.',
        ]);

        // ── 13. Manager Notes ───────────────────────────────────────────────
        ManagerNote::create([
            'organization_id' => $org->id,
            'employee_user_id' => $user->id,
            'manager_user_id' => $manager->id,
            'assessment_id' => $assessment->id,
            'kpi_id' => Kpi::where('slug', 'leadership_style')->first()->id ?? 1,
            'note_type' => 'positive',
            'content' => 'Alex handled the recent team conflict with great maturity.',
            'is_visible_to_employee' => true,
        ]);

        // ── 14. Promotion Recommendation ─────────────────────────────────────
        PromotionRecommendation::create([
            'organization_id' => $org->id,
            'user_id' => $user->id,
            'evaluation_cycle_id' => $cycle->id,
            'current_job_role_id' => $role->id,
            'target_job_role_id' => $role->id,
            'readiness' => 'ready',
            'score_at_evaluation' => 84.00,
            'trend' => 'improving',
            'consistency_met' => true,
            'threshold_met' => true,
            'hr_decision' => 'pending',
        ]);

        // ── 15. Benchmark Report ─────────────────────────────────────────────
        BenchmarkReport::create([
            'organization_id' => $org->id,
            'evaluation_cycle_id' => $cycle->id,
            'benchmark_type' => 'internal',
            'scope_label' => 'Engineering Dept vs Org Average',
            'org_avg_score' => 78.5,
            'period_start' => '2026-01-01',
            'period_end' => '2026-06-30',
        ]);

        // ── 16. Report Export ────────────────────────────────────────────────
        $export = ReportExport::create([
            'organization_id' => $org->id,
            'generated_by_user_id' => $manager->id,
            'user_id' => $user->id,
            'report_type' => 'kpi_performance',
            'status' => 'ready',
            'file_path' => 'reports/alex_carter_2026.pdf',
        ]);

        // ── 17. Notification & Preferences ───────────────────────────────────
        Notification::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'organization_id' => $org->id,
            'type' => 'App\Notifications\PerformanceUpdate',
            'channel' => 'database',
            'title' => 'New Assessment Result',
            'body' => 'Your Q2 result is now available.',
            'read_at' => null,
        ]);

        NotificationPreference::updateOrCreate(['user_id' => $user->id], [
            'email_assessment_reminder' => true,
            'inapp_performance_alert' => true,
        ]);

        // ── 18. Shareable Token ──────────────────────────────────────────────
        ShareableReportToken::create([
            'organization_id' => $org->id,
            'report_export_id' => $export->id,
            'created_by_user_id' => $user->id,
            'token' => Str::random(64),
            'expires_at' => now()->addDays(7),
        ]);

        // ── 19. Audit Log ────────────────────────────────────────────────────
        AuditLog::create([
            'organization_id' => $org->id,
            'actor_user_id' => $manager->id,
            'auditable_type' => User::class,
            'auditable_id' => $user->id,
            'event' => 'updated_mq_score',
            'new_values' => ['mq_score' => 84],
            'ip_address' => '127.0.0.1',
        ]);
    }
}
