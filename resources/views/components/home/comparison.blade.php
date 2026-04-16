<section class="py-24 bg-gray-50" id="benefits">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 tracking-tight">The Old Way vs. The MQ Way</h2>
            <p class="text-lg text-gray-500">See how modern dynamic performance management outpaces traditional methods.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
            <!-- Old Way -->
            <div class="bg-red-50/50 border border-red-100 rounded-3xl p-8 lg:p-12 shadow-xl relative overflow-hidden group hover:shadow-2xl transition-all duration-300 transform md:-translate-y-2">
                <div class="absolute top-0 right-0 p-6 opacity-10 transform scale-150 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-32 h-32 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                </div>

                <h3 class="text-2xl font-bold text-red-900 mb-8 flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    Traditional Methods
                </h3>

                <ul class="space-y-6 relative z-10">
                    <x-ui.comparison-item type="old" title="High Turnover / Attrition" description="Losing top talent due to unrecognized drop in morale and engagement.">
                        <x-slot:icon><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/></svg></x-slot:icon>
                    </x-ui.comparison-item>
                    <x-ui.comparison-item type="old" title="Time-Consuming Reviews" description="Months spent on manual yearly performance reviews.">
                        <x-slot:icon><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/></svg></x-slot:icon>
                    </x-ui.comparison-item>
                    <x-ui.comparison-item type="old" title="Subjective Decisions" description="Biased promotions and raises based on recency and favoritism.">
                        <x-slot:icon><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/></svg></x-slot:icon>
                    </x-ui.comparison-item>
                    <x-ui.comparison-item type="old" title="Low Engagement" description="Employees feel unseen and their impact undervalued.">
                        <x-slot:icon><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/></svg></x-slot:icon>
                    </x-ui.comparison-item>
                </ul>
            </div>

            <!-- MQ Way -->
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 border border-green-100 rounded-3xl p-8 lg:p-12 shadow-xl relative overflow-hidden group hover:shadow-2xl transition-all duration-300 transform md:-translate-y-2">
                <div class="absolute top-0 right-0 p-6 opacity-10 transform scale-150 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-32 h-32 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                </div>

                <h3 class="text-2xl font-bold text-green-900 mb-8 flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-green-500/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    MQ Solutions
                </h3>

                <ul class="space-y-6 relative z-10">
                    <x-ui.comparison-item type="new" title="Retain Top Performers" description="Predict attrition risks and proactively retain your best employees.">
                        <x-slot:icon><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg></x-slot:icon>
                    </x-ui.comparison-item>
                    <x-ui.comparison-item type="new" title="Fast Performance Analysis" description="Instant continuous feedback and AI-generated insights.">
                         <x-slot:icon><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg></x-slot:icon>
                    </x-ui.comparison-item>
                    <x-ui.comparison-item type="new" title="Data-Driven Decisions" description="Empirical metrics eliminate bias and ensure fairness.">
                         <x-slot:icon><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg></x-slot:icon>
                    </x-ui.comparison-item>
                    <x-ui.comparison-item type="new" title="Boost Engagement" description="Recognize impact continuously with transparent rankings.">
                         <x-slot:icon><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg></x-slot:icon>
                    </x-ui.comparison-item>
                </ul>
            </div>
        </div>
    </div>
</section>
