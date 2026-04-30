<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\View\View;

class OrgDepartmentController extends Controller
{
    public function index(): View
    {
        return view('organization.departments.index');
    }

    public function create(): View
    {
        return view('organization.departments.create');
    }

    public function edit(Department $department): View
    {
        return view('organization.departments.edit', [
            'department' => $department,
        ]);
    }
}
