<section class="py-24 bg-gray-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 tracking-tight">Comprehensive Reports & Insights</h2>
            <p class="text-lg text-gray-500">Generate powerful, presentation-ready insights with just one click.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <x-ui.report-card title="Executive Summary" description="High-level overview of org performance." iconColor="blue">
                <x-slot:icon>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </x-slot:icon>
            </x-ui.report-card>
            
            <x-ui.report-card title="Training Needs" description="Spot skill gaps to build training programs." iconColor="purple">
                <x-slot:icon>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </x-slot:icon>
            </x-ui.report-card>

            <x-ui.report-card title="Performance Reports" description="Deep dive into specific individual goals." iconColor="green">
                <x-slot:icon>
                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </x-slot:icon>
            </x-ui.report-card>

            <x-ui.report-card title="Sentiment Reports" description="Track psychological safety and team morale." iconColor="orange">
                <x-slot:icon>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </x-slot:icon>
            </x-ui.report-card>
        </div>

        <div class="bg-white rounded-[2rem] border border-gray-100 p-8 lg:p-12 shadow-sm flex flex-col md:flex-row gap-12 items-center justify-between overflow-hidden">
            <div class="max-w-xl">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Export & Share Reports</h3>
                <p class="text-gray-500 mb-6">Distribute valuable insights directly with stakeholders across all popular document formats.</p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-red-100 text-red-600 rounded-lg flex items-center justify-center font-bold text-xs">PDF</div>
                        <span class="font-medium text-gray-700">PDF Report</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center font-bold text-xs">XLS</div>
                        <span class="font-medium text-gray-700">Excel Export</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center font-bold text-xs">DOC</div>
                        <span class="font-medium text-gray-700">Word Doc</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gray-100 text-gray-600 rounded-lg flex items-center justify-center font-bold text-xs">CSV</div>
                        <span class="font-medium text-gray-700">CSV Data</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-100 w-full md:w-1/2 h-64 rounded-2xl flex items-center justify-center border-2 border-dashed border-gray-300 relative">
                <div class="absolute inset-0 bg-gradient-to-tr from-gray-100 to-white opacity-50 rounded-2xl"></div>
                <!-- Document Icon mock -->
                <svg class="w-24 h-24 text-gray-400 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
        </div>
    </div>
</section>
