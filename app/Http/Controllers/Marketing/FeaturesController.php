<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class FeaturesController extends Controller
{
    /**
     * Display the features page.
     */
    public function index(): View
    {
        return view('marketing.features');
    }
}
