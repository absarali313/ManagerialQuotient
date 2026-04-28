<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrgEmployeeController extends Controller
{
    /**
     * Display the org dashboard.
     */
    public function index(): View
    {
        return view('organization.employees.index', [
            'organization' => Organization::find(auth()->user()->organization->id)
        ]);
    }
}
