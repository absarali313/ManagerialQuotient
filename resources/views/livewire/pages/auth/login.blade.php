<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div x-data="{ showPassword: false }">
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-sm text-emerald-600 bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-3 font-medium">
            {{ session('status') }}
        </div>
    @endif

    <!-- Heading -->
    <div class="mb-8">
        <h2 class="text-2xl font-black text-slate-900 mb-1">Welcome Back</h2>
        <p class="text-sm text-slate-500 font-medium">Access your performance intelligence dashboard</p>
    </div>

    <form wire:submit="login" class="space-y-4">
        <!-- Email -->
        <div class="relative">
            <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <input
                wire:model="form.email"
                id="email"
                type="email"
                name="email"
                required
                autofocus
                autocomplete="username"
                placeholder="Work Email"
                class="w-full pl-10 pr-4 py-3 text-sm bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
            >
            @error('form.email') <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
        </div>

        <!-- Password -->
        <div class="relative">
            <div class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <input
                wire:model="form.password"
                id="password"
                :type="showPassword ? 'text' : 'password'"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Password"
                class="w-full pl-10 pr-10 py-3 text-sm bg-white border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
            >
            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                <svg x-show="showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
            </button>
            @error('form.password') <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
        </div>

        <!-- Remember me + Forgot password -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember" class="flex items-center gap-2 cursor-pointer">
                <input wire:model="form.remember" id="remember" type="checkbox" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 focus:ring-offset-0 transition-colors">
                <span class="text-sm text-slate-600 font-medium">Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" wire:navigate class="text-sm text-blue-600 font-semibold hover:text-blue-700 transition-colors">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Sign In Button -->
        <button type="submit" class="w-full py-3 rounded-xl font-bold text-sm text-white transition-all shadow-md hover:shadow-lg hover:scale-[1.01] active:scale-[0.99]" style="background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);">
            <span wire:loading.remove wire:target="login">Sign In</span>
            <span wire:loading wire:target="login" class="flex items-center justify-center gap-2">
                <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                Signing in...
            </span>
        </button>

        <!-- Divider -->
        <div class="flex items-center gap-3 py-1">
            <div class="flex-1 h-px bg-slate-100"></div>
            <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-widest">Or continue with</span>
            <div class="flex-1 h-px bg-slate-100"></div>
        </div>

        <!-- Google Button -->
        <button type="button" class="w-full py-3 rounded-xl font-semibold text-sm text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm flex items-center justify-center gap-3">
            <svg class="w-5 h-5" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
            Sign in with Google
        </button>
    </form>

    <!-- Register link -->
    <p class="mt-6 text-center text-sm text-slate-500">
        Don't have an account?
        <a href="{{ route('register') }}" wire:navigate class="text-blue-600 font-semibold hover:text-blue-700 transition-colors">Sign up</a>
    </p>
</div>
