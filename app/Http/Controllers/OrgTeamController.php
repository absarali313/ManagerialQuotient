<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\View\View;

class OrgTeamController extends Controller
{
    public function index(): View
    {
        return view('organization.teams.index');
    }

    public function create(): View
    {
        return view('organization.teams.create');
    }

    public function edit(Team $team): View
    {
        return view('organization.teams.edit', [
            'team' => $team,
        ]);
    }
}
