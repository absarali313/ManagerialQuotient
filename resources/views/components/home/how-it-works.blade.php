<section class="py-24 bg-gray-50/50" id="how-it-works">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 tracking-tight">How It Works</h2>
            <p class="text-lg text-gray-500">A seamless process that fits directly into your daily operations.</p>
        </div>

        <div class="relative">
            <!-- Connecting Line -->
            <div class="absolute top-1/2 -translate-y-1/2 left-0 right-0 h-0.5 bg-gray-200 hidden lg:block border-t border-dashed border-gray-300"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
                <x-ui.step-item number="01" title="Add Employees" description="Sync with your HR platform or upload your team structure directly." color="blue">
                    <x-slot:icon>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </x-slot:icon>
                </x-ui.step-item>

                <x-ui.step-item number="02" title="Gather Analytics" description="Automated multi-source continuous reviews occur smoothly." color="indigo">
                    <x-slot:icon>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </x-slot:icon>
                </x-ui.step-item>

                <x-ui.step-item number="03" title="Get AI Insights" description="MQ ranks performance, finds attrition risks, & delivers insights." color="purple" :isActive="true">
                    <x-slot:icon>
                         <svg class="w-8 h-8 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </x-slot:icon>
                </x-ui.step-item>

                <x-ui.step-item number="04" title="Take Action" description="Act confidently on compensation, promotions, and training." color="pink">
                    <x-slot:icon>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                    </x-slot:icon>
                </x-ui.step-item>

                <x-ui.step-item number="05" title="Track Success" description="Watch engagement rise as you continuously apply data-driven management." color="green">
                    <x-slot:icon>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </x-slot:icon>
                </x-ui.step-item>
            </div>
        </div>
    </div>
</section>
