<!-- White card container on desktop -->
<div class="bg-white lg:rounded-2xl lg:shadow-[0_8px_30px_rgb(0,0,0,0.04)] lg:border lg:border-gray-100 p-8 lg:p-10">
    
    @if(session('error'))
        <div class="mb-6 p-4 rounded-lg bg-red-50 text-red-700 text-sm border border-red-200">
            {{ session('error') }}
        </div>
    @endif
    
    @if(session('status'))
        <div class="mb-6 p-4 rounded-lg bg-green-50 text-green-700 text-sm border border-green-200">
            {{ session('status') }}
        </div>
    @endif

    <!-- Headers dynamically driven by state -->
    <div class="mb-8">
        @if($mode === 'login')
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Welcome Back</h2>
            <p class="text-gray-500 mt-2 text-sm">Access your performance intelligence dashboard</p>
        @elseif($mode === 'register')
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Setup Organization</h2>
            <p class="text-gray-500 mt-2 text-sm">Register your company's intelligence hub</p>
        @elseif($mode === 'forgot')
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Reset Password</h2>
            <p class="text-gray-500 mt-2 text-sm">We'll send instructions to your email</p>
        @endif
    </div>

    <!-- Forms -->
    @if($mode === 'login')
        <form wire:submit="login" class="space-y-6">
            <x-form.input 
                label="Email Address" 
                id="email" 
                type="email" 
                model="email" 
                placeholder="Enter your work email" 
                required
            >
                <x-slot name="icon">
                    <x-lucide-mail class="w-5 h-5" />
                </x-slot>
            </x-form.input>

            <x-form.input 
                label="Password" 
                id="password" 
                type="password" 
                model="password" 
                placeholder="Enter your password" 
                required
            >
                <x-slot name="icon">
                    <x-lucide-lock class="w-5 h-5" />
                </x-slot>
            </x-form.input>

            <div class="flex items-center justify-between">
                <x-form.checkbox 
                    label="Remember me" 
                    id="remember_me" 
                    model="remember" 
                />

                <div class="text-sm">
                    <button type="button" wire:click="switchMode('forgot')" class="font-medium text-blue-600 hover:text-blue-500 transition">
                        Forgot password?
                    </button>
                </div>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                    <svg wire:loading wire:target="login" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Sign In
                </button>
            </div>
        </form>
    @elseif($mode === 'register')
        <form wire:submit="register" class="space-y-5">
            <x-form.input 
                label="Organization Name" 
                id="org_name" 
                model="org_name" 
                placeholder="Acme Corp" 
                required
            >
                <x-slot name="icon">
                    <x-lucide-building class="w-5 h-5" />
                </x-slot>
            </x-form.input>

            <x-form.input 
                label="Your Full Name" 
                id="name" 
                model="name" 
                placeholder="John Doe" 
                required
            >
                <x-slot name="icon">
                    <x-lucide-user class="w-5 h-5" />
                </x-slot>
            </x-form.input>

            <x-form.input 
                label="Work Email" 
                id="reg_email" 
                type="email" 
                model="email" 
                placeholder="john@acmecorp.com" 
                required
            >
                <x-slot name="icon">
                    <x-lucide-mail class="w-5 h-5" />
                </x-slot>
            </x-form.input>

            <x-form.input 
                label="Password" 
                id="reg_password" 
                type="password" 
                model="password" 
                placeholder="Create a strong password" 
                required
            >
                <x-slot name="icon">
                    <x-lucide-lock class="w-5 h-5" />
                </x-slot>
            </x-form.input>

            <div class="pt-2">
                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                    <svg wire:loading wire:target="register" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Create Organization Account
                </button>
            </div>
        </form>
    @elseif($mode === 'forgot')
        <form wire:submit="sendPasswordReset" class="space-y-6">
            <x-form.input 
                label="Email Address" 
                id="forgot_email" 
                type="email" 
                model="email" 
                placeholder="Enter your work email" 
                required
            >
                <x-slot name="icon">
                    <x-lucide-mail class="w-5 h-5" />
                </x-slot>
            </x-form.input>

            <div class="flex space-x-3">
                <button type="button" wire:click="switchMode('login')" class="w-1/3 flex justify-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                    Back
                </button>
                <button type="submit" class="w-2/3 flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                    <svg wire:loading wire:target="sendPasswordReset" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Send Reset Link
                </button>
            </div>
        </form>
    @endif

    @if($mode === 'login' || $mode === 'register')
        <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-3 bg-white text-gray-500 text-xs uppercase tracking-wide">
                        Or continue with
                    </span>
                </div>
            </div>

            <div class="mt-6">
                <!-- Point to Socialite endpoint -->
                <a href="{{ route('auth.google') }}" class="w-full inline-flex justify-center items-center py-2.5 px-4 border border-gray-200 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-150">
                    <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    Sign in with Google
                </a>
            </div>
        </div>
    @endif

    <div class="mt-8 text-center text-sm text-gray-500">
        @if($mode === 'login')
            Don't have an account? 
            <button type="button" wire:click="switchMode('register')" class="font-medium text-blue-600 hover:text-blue-500 transition">Sign up</button>
        @elseif($mode === 'register')
            Already have an account? 
            <button type="button" wire:click="switchMode('login')" class="font-medium text-blue-600 hover:text-blue-500 transition">Sign in</button>
        @endif
    </div>
</div>
