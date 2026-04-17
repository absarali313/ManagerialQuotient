<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Display the login/register view.
     */
    public function create(Request $request): View
    {
        $mode = $request->routeIs('register') ? 'register' : 'login';

        return view('auth.login', ['mode' => $mode]);
    }
}
