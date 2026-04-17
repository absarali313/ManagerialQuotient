<?php

namespace App\Livewire\Auth;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class UnifiedAuth extends Component
{
    public string $mode = 'login'; // 'login', 'register', 'forgot'

    public string $orgName = '';

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public bool $isRemembered = false;

    public function mount(string $initialMode = 'login'): void
    {
        $this->mode = $initialMode;
    }

    public function switchMode(string $newMode): void
    {
        $this->mode = $newMode;
        $this->resetErrorBag();
        $this->password = '';
    }

    public function login(): Redirector|RedirectResponse
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password, 'is_active' => true], $this->isRemembered)) {
            session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }

    public function register(): Redirector|RedirectResponse
    {
        $this->validate([
            'orgName' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $organization = Organization::create([
            'name' => $this->orgName,
            'slug' => Str::slug($this->orgName) . '-' . uniqid(),
            'license_type' => 'trial',
            'is_active' => true,
        ]);

        $user = User::create([
            'organization_id' => $organization->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'system_role' => 'org_admin',
            'is_active' => true,
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function sendPasswordReset(): void
    {
        $this->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::broker()->sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('status', __($status));
            $this->switchMode('login');
        } else {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }
    }

    public function render(): View
    {
        return view('livewire.auth.unified-auth');
    }
}
