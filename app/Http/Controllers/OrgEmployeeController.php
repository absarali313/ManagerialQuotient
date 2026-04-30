<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\View\View;

class OrgEmployeeController extends Controller
{
    /**
     * Display the org dashboard.
     */
    public function index(): View
    {
        return view('organization.employees.index', [
            'organization' => Organization::find(auth()->user()->organization->id),
        ]);
    }

    public function create(): View
    {
        return view('organization.employees.create');
    }

    public function edit(User $employee): View
    {
        return view('organization.employees.edit', [
            'employee' => $employee,
        ]);
    }
}
