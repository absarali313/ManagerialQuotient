<x-frontend-layout>
    <div class="flex min-h-screen font-sans bg-gray-50">
        <!-- Left Pattern/Gradient Side -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-blue-700 via-indigo-600 to-purple-700 overflow-hidden text-white flex-col justify-between p-12">
            <!-- Abstract gradient shapes -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>

            <div class="absolute top-0 right-0 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob" style="animation-delay: 2s;"></div>

            <div class="absolute -bottom-8 left-20 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob" style="animation-delay: 4s;"></div>

            <div class="relative z-10 max-w-lg mt-6">
                <h1 class="text-5xl font-bold leading-tight tracking-tight mb-4 text-white">Managerial<br>Quotient</h1>
                <p class="text-xl text-blue-100 font-light max-w-xs">AI-Powered Performance Intelligence System</p>

                <div class="mt-20 space-y-8">
                    <!-- Feature 1 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center backdrop-blur shadow-sm border border-white/10 flex-shrink-0">
                            <x-lucide-database class="w-5 h-5 text-blue-200" />
                        </div>

                        <div>
                            <h3 class="font-semibold text-white">Data</h3>
                            <p class="text-sm text-blue-200">Unified performance metrics</p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center backdrop-blur shadow-sm border border-white/10 flex-shrink-0">
                            <x-lucide-brain class="w-5 h-5 text-blue-200" />
                        </div>

                        <div>
                            <h3 class="font-semibold text-white">AI</h3>
                            <p class="text-sm text-blue-200">Advanced pattern recognition</p>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center backdrop-blur shadow-sm border border-white/10 flex-shrink-0">
                            <x-lucide-zap class="w-5 h-5 text-blue-200" />
                        </div>

                        <div>
                            <h3 class="font-semibold text-white">Insights</h3>
                            <p class="text-sm text-blue-200">Actionable intelligence</p>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center backdrop-blur shadow-sm border border-white/10 flex-shrink-0">
                            <x-lucide-trending-up class="w-5 h-5 text-blue-200" />
                        </div>

                        <div>
                            <h3 class="font-semibold text-white">Decisions</h3>
                            <p class="text-sm text-blue-200">Strategic performance optimization</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Login Form Side -->
        <div class="w-full lg:w-1/2 flex items-center justify-center relative bg-white lg:bg-gray-50/50">
            <div class="w-full max-w-md px-8 lg:px-0">
                <livewire:auth.unified-auth :initial-mode="$mode" />

                <!-- Bottom trust indicators -->
                <div class="mt-8 flex flex-col items-center justify-center space-y-4">
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center text-xs text-gray-500 font-medium tracking-wide">
                            <x-lucide-shield-check class="h-4 w-4 text-gray-400 mr-1.5" />
                            <span>Enterprise-grade encryption</span>
                        </div>

                        <div class="flex items-center text-xs text-gray-500 font-medium tracking-wide">
                            <x-lucide-lock class="h-4 w-4 text-blue-500 mr-1.5" />
                            <span>SOC2-ready</span>
                        </div>
                    </div>

                    <!-- Line Separator -->
                    <div class="w-full max-w-[240px] border-t border-gray-200"></div>

                    <div class="flex items-center text-xs text-gray-500 font-medium tracking-wide">
                        <x-lucide-check-circle class="h-4 w-4 text-blue-600 mr-1.5" />
                        <span>Secure AI data processing</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>
