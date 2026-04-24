<section class="py-24 bg-gradient-to-br from-purple-100 to-purple-50">
    <div class="max-w-[1224px] mx-auto px-6">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-purple-600 font-bold mb-3 tracking-wider text-sm uppercase block">AI-Powered System</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 tracking-tight">AI That Understands Your Workforce</h2>
            <p class="text-lg text-gray-600">Advanced machine learning designed to give you continuous predictability on employee success.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-ui.insight-card title="Performance Summary" description="Auto-generated contextual descriptions of employee strengths and weaknesses." iconColor="purple">
                <x-slot:icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </x-slot:icon>
                <div class="bg-gray-50 rounded-lg p-3 border border-gray-100 text-xs text-gray-600 flex gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-purple-500 mt-1 flex-shrink-0"></span>
                    "Consistently outperforms in Q4 sales metrics but needs help in team collaboration."
                </div>
            </x-ui.insight-card>

            <x-ui.insight-card title="Promotion Prediction" description="Metrics indicate when someone is deeply ready to advance to the next level." iconColor="blue">
                <x-slot:icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                </x-slot:icon>
                <div class="mt-auto">
                    <div class="flex justify-between text-xs font-semibold mb-1">
                        <span class="text-gray-700">Readiness</span>
                        <span class="text-green-600">89%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 89%"></div>
                    </div>
                </div>
            </x-ui.insight-card>

            <x-ui.insight-card title="Skill Gap Detection" description="Automatically identify missing competencies and recommend targeted training programs." iconColor="orange">
                <x-slot:icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </x-slot:icon>
                <div class="flex items-center gap-2 mt-auto">
                    <div class="bg-red-50 border border-red-100 text-red-700 text-xs font-bold px-3 py-1.5 rounded-md flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-red-500"></span> Leadership : Gap 12%
                    </div>
                </div>
            </x-ui.insight-card>

            <x-ui.insight-card title="Sentiment" description="Analyzes feedback language to discover true team sentiment." iconColor="pink">
                <x-slot:icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </x-slot:icon>
                <div class="flex items-center gap-2 mt-auto">
                    <div class="bg-blue-50 border border-blue-100 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-md flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Positive Shift
                    </div>
                </div>
            </x-ui.insight-card>
        </div>
    </div>
</section>
