<nav class="w-full bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center gap-2">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-md">
                    <span class="text-white font-bold text-xl tracking-tight">MQ</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-10">
                <a href="#features" class="text-gray-600 hover:text-gray-900 text-sm font-semibold transition-colors">Features</a>
                <a href="#how-it-works" class="text-gray-600 hover:text-gray-900 text-sm font-semibold transition-colors">How it Works</a>
                <a href="#benefits" class="text-gray-600 hover:text-gray-900 text-sm font-semibold transition-colors">Benefits</a>
                <a href="#pricing" class="text-gray-600 hover:text-gray-900 text-sm font-semibold transition-colors">Pricing</a>
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center space-x-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-gray-900 text-sm font-semibold transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 text-sm font-semibold transition-colors hidden sm:block">Sign In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-full text-sm font-semibold shadow-md shadow-blue-500/30 transition-all hover:-translate-y-0.5">Get Started</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
