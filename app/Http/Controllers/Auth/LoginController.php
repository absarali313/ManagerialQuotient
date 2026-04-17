<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request)
    {
        $mode = $request->routeIs('register') ? 'register' : 'login';
        
        return view('auth.login', ['mode' => $mode]);
    }
}
