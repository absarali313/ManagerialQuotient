<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LogoutController extends Controller
{
    /**
     * Display the login/register view.
     */
    public function destroy(): View
    {
        auth()->logout();

        return view('auth.login', [
            'mode' => 'login'
        ]);
    }
}
