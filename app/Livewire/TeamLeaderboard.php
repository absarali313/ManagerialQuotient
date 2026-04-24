<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EmployeeRanking;
use Illuminate\Support\Facades\Auth;

class TeamLeaderboard extends Component
{
    public function getLeadersProperty()
    {
        $user = Auth::user();
        if (!$user || !$user->team_id) return [];

        $rankings = EmployeeRanking::where('scope', 'team')
            ->where('scope_id', $user->team_id)
            ->with('user')
            ->orderBy('rank')
            ->get();

        // Find user rank and show neighbors
        $userRankIndex = $rankings->search(fn($r) => $r->user_id === $user->id);
        
        $slice = $rankings->slice(max(0, $userRankIndex - 1), 3);

        return $slice->map(function ($r) use ($user) {
            $isUser = $r->user_id === $user->id;
            return [
                'rank' => $r->rank,
                'name' => $isUser ? $r->user->name . ' (You)' : $r->user->name,
                'score' => (int)$r->mq_score,
                'image' => 'https://i.pravatar.cc/150?u=' . $r->user->email,
                'is_user' => $isUser,
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.team-leaderboard', [
            'leaders' => $this->leaders
        ]);
    }
}
