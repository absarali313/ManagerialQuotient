<?php

namespace App\Livewire\Auth;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class UnifiedAuth extends Component
{
    public string $mode = 'login'; // 'login', 'register', 'forgot'

    // Form inputs
    public string $org_name = '';
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function mount($initialMode = 'login')
    {
        $this->mode = $initialMode;
    }

    public function switchMode($newMode)
    {
        $this->mode = $newMode;
        $this->resetErrorBag();
        $this->password = ''; // Clear password for security when switching
    }

    public function login()
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password, 'is_active' => true], $this->remember)) {
            session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }

    public function register()
    {
        $this->validate([
            'org_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // Create the organization
        $organization = Organization::create([
            'name' => $this->org_name,
            'slug' => \Illuminate\Support\Str::slug($this->org_name) . '-' . uniqid(),
            'license_type' => 'trial',
            'is_active' => true,
        ]);

        // Create the user as a platform admin
        $user = User::create([
            'organization_id' => $organization->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'system_role' => 'admin',
            'is_active' => true,
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function sendPasswordReset()
    {
        $this->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::broker()->sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('status', __($status));
            $this->switchMode('login'); // Return back to login with success banner
        } else {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.unified-auth');
    }
}
