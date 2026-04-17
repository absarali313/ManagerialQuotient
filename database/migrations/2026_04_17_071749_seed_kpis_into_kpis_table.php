<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Seeds the master KPI list. All 40 system KPIs that ship with MQ.
     * These are global (organization_id = null, is_system = true).
     *
     * Categories:
     *  - character      : personal traits and attitudes
     *  - interpersonal  : communication and relationships
     *  - cognitive      : thinking, analysis, decision-making
     *  - leadership     : managing people, delegation
     *  - execution      : getting work done, performance, compliance
     *  - strategy       : planning, innovation, improvement
     */
    public function up(): void
    {
        $now = now();

        $kpis = [
            // ── Character ──────────────────────────────────────────────────
            ['slug' => 'attitude',              'name' => 'Attitude',                       'category' => 'character',     'description' => 'Employee attitude towards work and peers'],
            ['slug' => 'commitment',            'name' => 'Commitment',                     'category' => 'character',     'description' => 'Level of dedication to responsibilities'],
            ['slug' => 'discipline',            'name' => 'Discipline',                     'category' => 'character',     'description' => 'Adherence to rules and policies'],
            ['slug' => 'determination',         'name' => 'Determination',                  'category' => 'character',     'description' => 'Persistence in achieving goals'],
            ['slug' => 'drive_to_achieve',      'name' => 'Drive to Achieve',               'category' => 'character',     'description' => 'Motivation to accomplish goals'],
            ['slug' => 'motivation',            'name' => 'Motivation',                     'category' => 'character',     'description' => 'Internal drive and enthusiasm'],
            ['slug' => 'personality',           'name' => 'Personality',                    'category' => 'character',     'description' => 'Overall personality traits'],
            ['slug' => 'stress_management',     'name' => 'Stress Management',              'category' => 'character',     'description' => 'Handling stress effectively'],
            ['slug' => 'citizenship_behavior',  'name' => 'Citizenship Behavior',           'category' => 'character',     'description' => 'Going beyond formal job requirements'],
            ['slug' => 'cultural_adoption',     'name' => 'Cultural Adoption',              'category' => 'character',     'description' => 'Alignment with company culture'],

            // ── Interpersonal ───────────────────────────────────────────────
            ['slug' => 'communication_skills',  'name' => 'Communication Skills',           'category' => 'interpersonal', 'description' => 'Ability to communicate effectively'],
            ['slug' => 'interpersonal_relations','name' => 'Interpersonal Relations',        'category' => 'interpersonal', 'description' => 'Relationship management with others'],
            ['slug' => 'feedback',              'name' => 'Feedback',                       'category' => 'interpersonal', 'description' => 'Ability to give and receive feedback'],
            ['slug' => 'negotiation_skills',    'name' => 'Negotiation Skills',             'category' => 'interpersonal', 'description' => 'Ability to negotiate effectively'],
            ['slug' => 'assertive_skills',      'name' => 'Assertive Skills',               'category' => 'interpersonal', 'description' => 'Ability to assert ideas confidently'],
            ['slug' => 'presentation_skills',   'name' => 'Presentation Skills',            'category' => 'interpersonal', 'description' => 'Ability to present ideas clearly'],
            ['slug' => 'team_work_skills',      'name' => 'Team Work Skills',               'category' => 'interpersonal', 'description' => 'Collaboration with team members'],

            // ── Cognitive ───────────────────────────────────────────────────
            ['slug' => 'decision_making',       'name' => 'Decision Making Skills',         'category' => 'cognitive',     'description' => 'Quality of decision making'],
            ['slug' => 'creativity',            'name' => 'Creativity',                     'category' => 'cognitive',     'description' => 'Ability to think innovatively'],
            ['slug' => 'problem_solving',       'name' => 'Problem Solving',                'category' => 'cognitive',     'description' => 'Ability to solve problems'],
            ['slug' => 'analytical_skills',     'name' => 'Analytical Skills',              'category' => 'cognitive',     'description' => 'Ability to analyze situations'],
            ['slug' => 'learning_style',        'name' => 'Learning Style',                 'category' => 'cognitive',     'description' => 'Ability and approach to learning'],
            ['slug' => 'time_management',       'name' => 'Time Management Skills',         'category' => 'cognitive',     'description' => 'Effective use of time'],

            // ── Leadership ──────────────────────────────────────────────────
            ['slug' => 'leadership_style',      'name' => 'Leadership Style',               'category' => 'leadership',    'description' => 'Approach to leading teams'],
            ['slug' => 'delegation',            'name' => 'Delegation of Authority',        'category' => 'leadership',    'description' => 'Ability to delegate tasks effectively'],
            ['slug' => 'people_management',     'name' => 'People Management',              'category' => 'leadership',    'description' => 'Managing people effectively'],
            ['slug' => 'span_management',       'name' => 'Span Management',                'category' => 'leadership',    'description' => 'Managing scope and responsibilities'],
            ['slug' => 'goal_setting',          'name' => 'Goal Setting Skills',            'category' => 'leadership',    'description' => 'Setting clear and achievable goals'],
            ['slug' => 'performance_management','name' => 'Performance Management',         'category' => 'leadership',    'description' => 'Managing and improving performance'],

            // ── Execution ───────────────────────────────────────────────────
            ['slug' => 'job_knowledge',         'name' => 'Job Knowledge',                  'category' => 'execution',     'description' => 'Understanding of job responsibilities'],
            ['slug' => 'task_performance',      'name' => 'Task Performance',               'category' => 'execution',     'description' => 'Execution of assigned tasks'],
            ['slug' => 'contextual_performance','name' => 'Contextual Performance',         'category' => 'execution',     'description' => 'Performance in varying contexts'],
            ['slug' => 'resource_management',   'name' => 'Resource Management',            'category' => 'execution',     'description' => 'Efficient use of resources'],
            ['slug' => 'compliance_skills',     'name' => 'Compliance Skills',              'category' => 'execution',     'description' => 'Adherence to rules and compliance'],
            ['slug' => 'crisis_management',     'name' => 'Crisis Management and Follow Up','category' => 'execution',     'description' => 'Handling crises effectively'],

            // ── Strategy ────────────────────────────────────────────────────
            ['slug' => 'innovation_skills',     'name' => 'Innovation Skills',              'category' => 'strategy',      'description' => 'Capability to innovate'],
            ['slug' => 'development_insight',   'name' => 'Development Insight',            'category' => 'strategy',      'description' => 'Understanding of growth and improvement'],
            ['slug' => 'continuous_improvement','name' => 'Continuous Improvement Skills',  'category' => 'strategy',      'description' => 'Focus on continuous improvement'],
            ['slug' => 'strategy_development',  'name' => 'Strategy Development',           'category' => 'strategy',      'description' => 'Ability to develop strategies'],
            ['slug' => 'strategy_execution',    'name' => 'Strategy Execution',             'category' => 'strategy',      'description' => 'Executing strategies effectively'],
        ];

        $data = array_values(array_map(fn ($kpi, $index) => [
            'name'            => $kpi['name'],
            'slug'            => $kpi['slug'],
            'description'     => $kpi['description'],
            'category'        => $kpi['category'],
            'is_system'       => true,
            'organization_id' => null,
            'display_order'   => $index + 1,
            'is_active'       => true,
            'created_at'      => $now,
            'updated_at'      => $now,
        ], $kpis, array_keys($kpis)));

        DB::table('kpis')->insert($data);
    }

    public function down(): void
    {
        DB::table('kpis')
            ->where('is_system', true)
            ->whereNull('organization_id')
            ->delete();
    }
};
