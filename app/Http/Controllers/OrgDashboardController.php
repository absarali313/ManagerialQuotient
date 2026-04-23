<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class OrgDashboardController extends Controller
{
    /**
     * Display the organization dashboard.
     */
    public function index(): View
    {
        return view('org-dashboard.index');
    }
}
