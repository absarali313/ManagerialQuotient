<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class OrgEmployeeRankingController extends Controller
{
    /**
     * Display the org dashboard.
     */
    public function index(): View
    {
        return view('organization.employees');
    }
}
