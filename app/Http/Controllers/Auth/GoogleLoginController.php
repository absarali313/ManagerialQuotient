<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleLoginController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Find user by email
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Determine if user is active
                if (!$user->is_active) {
                    return redirect()->route('login')->with('error', 'Your account is inactive. Please contact your organization administrator.');
                }
                
                Auth::login($user, true);
                return redirect()->intended('/dashboard');
            }

            // Standard SSO behavior usually delegates registration to admins or auto-provisions if allowed. 
            // In Managerial Quotient, if they don't exist, we redirect to login with an error because
            // employees must be invited or belong to a signed-up Organization.
            return redirect()->route('login')->with('error', 'We could not find an account matching that Google email. If your company uses Managerial Quotient, please ask your admin to invite you.');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Failed to authenticate with Google. Please try again.');
        }
    }
}
