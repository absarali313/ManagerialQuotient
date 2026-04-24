<?php

namespace App\Livewire\Org;

use Livewire\Component;
use Livewire\WithPagination;

class AssessmentsIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $activeTab = 'All';
    public $tabs = ['All', 'Technical', 'Soft Skills', 'Leadership', 'Compliance'];

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Mock data to match the UI image provided
        $allAssessments = [
            [
                'id' => 1,
                'name' => 'Frontend Developer Assessment',
                'description' => 'React, JavaScript, CSS fundamentals',
                'category' => 'Technical',
                'questions' => 32,
                'last_modified' => 'Jun 12, 2025',
                'modified_by' => 'Sarah Collins',
                'status' => 'Published',
                'icon' => 'code'
            ],
            [
                'id' => 2,
                'name' => 'Leadership & Communication Skills',
                'description' => 'Team management and verbal skills',
                'category' => 'Soft Skills',
                'questions' => 24,
                'last_modified' => 'Jun 10, 2025',
                'modified_by' => 'Marcus Reid',
                'status' => 'Published',
                'icon' => 'users'
            ],
            [
                'id' => 3,
                'name' => 'Data Privacy & Compliance 2025',
                'description' => 'GDPR, ISO 27001 basics',
                'category' => 'Compliance',
                'questions' => 40,
                'last_modified' => 'Jun 08, 2025',
                'modified_by' => 'Sarah Collins',
                'status' => 'Draft',
                'icon' => 'shield'
            ],
            [
                'id' => 4,
                'name' => 'Emotional Intelligence Evaluation',
                'description' => 'EQ, empathy & self-awareness',
                'category' => 'Soft Skills',
                'questions' => 18,
                'last_modified' => 'Jun 05, 2025',
                'modified_by' => 'Priya Nair',
                'status' => 'Published',
                'icon' => 'star'
            ],
            [
                'id' => 5,
                'name' => 'Cloud Infrastructure & DevOps',
                'description' => 'AWS, Docker, CI/CD pipelines',
                'category' => 'Technical',
                'questions' => 28,
                'last_modified' => 'Jun 02, 2025',
                'modified_by' => 'Tom Higgins',
                'status' => 'Draft',
                'icon' => 'layers'
            ],
        ];

        $filtered = collect($allAssessments)
            ->filter(function($item) {
                $matchesSearch = empty($this->search) || 
                                 str_contains(strtolower($item['name']), strtolower($this->search)) ||
                                 str_contains(strtolower($item['description']), strtolower($this->search));
                
                $matchesTab = $this->activeTab === 'All' || $item['category'] === $this->activeTab;

                return $matchesSearch && $matchesTab;
            });

        return view('livewire.org.assessments-index', [
            'assessments' => $filtered
        ])->layout('components.layouts.dashboard');
    }
}
