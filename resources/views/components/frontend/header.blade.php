<header class="w-full bg-white/80 backdrop-blur-xl sticky top-0 z-50 border-b border-gray-100/50">
    <div class="max-w-[1224px] mx-auto px-6">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center group cursor-pointer">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('assets/images/logo.jpg') }}" alt="Managerial Quotient" class="h-10 w-auto group-hover:scale-105 transition-transform duration-300">
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center space-x-1">
                <a href="{{ route('features_page') }}" @class([
                    'px-4 py-2 text-sm font-semibold transition-all hover:bg-gray-50 rounded-xl',
                    'text-blue-600 bg-blue-50' => request()->routeIs('features_page'),
                    'text-gray-500 hover:text-gray-900' => !request()->routeIs('features_page')
                ])>Features</a>
                <a href="#how-it-works" class="px-4 py-2 text-gray-500 hover:text-gray-900 text-sm font-semibold transition-all hover:bg-gray-50 rounded-xl">How it Works</a>
                <a href="#benefits" class="px-4 py-2 text-gray-500 hover:text-gray-900 text-sm font-semibold transition-all hover:bg-gray-50 rounded-xl">Benefits</a>
                <a href="#pricing" class="px-4 py-2 text-gray-500 hover:text-gray-900 text-sm font-semibold transition-all hover:bg-gray-50 rounded-xl">Pricing</a>
            </nav>

            <!-- Auth Buttons -->
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-bold text-gray-700 hover:text-blue-600 transition-colors bg-gray-50 hover:bg-blue-50 rounded-2xl">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex text-gray-600 hover:text-gray-900 text-sm font-bold transition-colors">Sign In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-bold rounded-2xl shadow-xl shadow-blue-500/25 text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all hover:-translate-y-0.5 active:translate-y-0">
                            Get Started
                        </a>
                    @endif
                @endauth
                
                <!-- Mobile Menu Button -->
                <button type="button" class="md:hidden p-2 text-gray-500 hover:text-gray-900 transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>
