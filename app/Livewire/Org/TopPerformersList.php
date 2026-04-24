<?php

namespace App\Livewire\Org;

use Livewire\Component;
use App\Models\User;

class TopPerformersList extends Component
{
    public bool $showAll = false;

    public function toggleShowAll(): void
    {
        $this->showAll = ! $this->showAll;
    }

    public function getPerformersProperty()
    {
        $user = auth()->user();
        $org = $user->isOrganization() ? $user->ownedOrganization : $user->organization;

        if (! $org) return collect();

        return $org->employees()
            ->with(['department'])
            ->whereNotNull('current_mq_score')
            ->orderBy('current_mq_score', 'desc')
            ->take($this->showAll ? 20 : 5)
            ->get();
    }

    public function render()
    {
        return view('livewire.org.top-performers-list', [
            'performers' => $this->performers,
        ]);
    }
}
