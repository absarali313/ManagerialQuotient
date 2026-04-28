<?php

namespace App\Livewire\Org;

use Livewire\Component;
use App\Models\Assessment;
use Illuminate\Support\Collection;

class Navbar extends Component
{
    public string $search = '';

    public function updatedSearch(): void
    {
        $this->dispatch('search-updated', search: $this->search);
    }

    public function getNotificationsProperty(): Collection
    {
        return Assessment::where('organization_id', auth()->user()->organization_id)
            ->where('status', 'completed')
            ->with(['assignedTo', 'jobRole'])
            ->latest('completed_at')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.org.navbar');
    }
}
