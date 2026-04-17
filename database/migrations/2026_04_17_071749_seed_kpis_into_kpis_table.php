<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $kpis = [
            ['name' => 'Attitude', 'description' => 'Employee attitude towards work and peers'],
            ['name' => 'Commitment', 'description' => 'Level of dedication to responsibilities'],
            ['name' => 'Communication Skills', 'description' => 'Ability to communicate effectively'],
            ['name' => 'Creativity', 'description' => 'Ability to think innovatively'],
            ['name' => 'Decision Making Skills', 'description' => 'Quality of decision making'],
            ['name' => 'Delegation of Authority', 'description' => 'Ability to delegate tasks effectively'],
            ['name' => 'Determination', 'description' => 'Persistence in achieving goals'],
            ['name' => 'Development Insight', 'description' => 'Understanding of growth and improvement'],
            ['name' => 'Discipline', 'description' => 'Adherence to rules and policies'],
            ['name' => 'Drive to Achieve', 'description' => 'Motivation to accomplish goals'],
            ['name' => 'Feedback', 'description' => 'Ability to give and receive feedback'],
            ['name' => 'Innovation Skills', 'description' => 'Capability to innovate'],
            ['name' => 'Interpersonal Relations', 'description' => 'Relationship management with others'],
            ['name' => 'Job Knowledge', 'description' => 'Understanding of job responsibilities'],
            ['name' => 'Leadership Style', 'description' => 'Approach to leading teams'],
            ['name' => 'Learning Style', 'description' => 'Ability and approach to learning'],
            ['name' => 'Motivation', 'description' => 'Internal drive and enthusiasm'],
            ['name' => 'Negotiation Skills', 'description' => 'Ability to negotiate effectively'],
            ['name' => 'Performance Management', 'description' => 'Managing and improving performance'],
            ['name' => 'Personality', 'description' => 'Overall personality traits'],
            ['name' => 'Problem Solving', 'description' => 'Ability to solve problems'],
            ['name' => 'Resource Management', 'description' => 'Efficient use of resources'],
            ['name' => 'Span Management', 'description' => 'Managing scope and responsibilities'],
            ['name' => 'Team Work Skills', 'description' => 'Collaboration with team members'],
            ['name' => 'Time Management Skills', 'description' => 'Effective use of time'],
            ['name' => 'Analytical Skills', 'description' => 'Ability to analyze situations'],
            ['name' => 'Presentation Skills', 'description' => 'Ability to present ideas clearly'],
            ['name' => 'People Management', 'description' => 'Managing people effectively'],
            ['name' => 'Goal Setting Skills', 'description' => 'Setting clear and achievable goals'],
            ['name' => 'Stress Management', 'description' => 'Handling stress effectively'],
            ['name' => 'Citizenship Behavior', 'description' => 'Going beyond formal job requirements'],
            ['name' => 'Continuous Improvement Skills', 'description' => 'Focus on continuous improvement'],
            ['name' => 'Strategy Development', 'description' => 'Ability to develop strategies'],
            ['name' => 'Cultural Adoption', 'description' => 'Alignment with company culture'],
            ['name' => 'Strategy Execution', 'description' => 'Executing strategies effectively'],
            ['name' => 'Contextual Performance', 'description' => 'Performance in varying contexts'],
            ['name' => 'Task Performance', 'description' => 'Execution of assigned tasks'],
            ['name' => 'Compliance Skills', 'description' => 'Adherence to rules and compliance'],
            ['name' => 'Crisis Management and Follow Up', 'description' => 'Handling crises effectively'],
            ['name' => 'Assertive Skills', 'description' => 'Ability to assert ideas confidently'],
        ];

        $data = array_map(fn ($kpi) => [
            'name' => $kpi['name'],
            'description' => $kpi['description'],
            'is_system' => true,
            'organization_id' => null,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ], $kpis);

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
