<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $competencies = [
            ['name' => 'Attitude', 'description' => 'Professional outlook and positive mental approach to challenges.'],
            ['name' => 'Communication Skills', 'description' => 'Effectiveness in conveying information, listening, and clarity.'],
            ['name' => 'Decision Making', 'description' => 'Ability to make informed, data-driven, and timely choices.'],
            ['name' => 'Creativity', 'description' => 'Openness to new ideas and thinking outside traditional boundaries.'],
            ['name' => 'Innovation', 'description' => 'Ability to implement new solutions and improve existing processes.'],
            ['name' => 'Discipline', 'description' => 'Consistency in work ethic and adherence to organizational standards.'],
            ['name' => 'Commitment', 'description' => 'Dedication to organizational goals and long-term vision.'],
            ['name' => 'Leadership', 'description' => 'Ability to inspire, guide, and develop team members.'],
            ['name' => 'Delegation', 'description' => 'Effectiveness in assigning tasks and empowering others.'],
        ];

        foreach ($competencies as $competency) {
            \App\Models\Competency::updateOrCreate(['name' => $competency['name']], $competency);
        }
    }
}
