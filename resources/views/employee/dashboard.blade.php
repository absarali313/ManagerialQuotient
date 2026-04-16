<x-app-layout>
    <div class="space-y-10 pb-12 max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-1">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900">
                    Employee Portal
                </h2>
                <p class="text-slate-500 font-medium text-sm">Welcome back, {{ $user->name }}. Here are your pending assessments.</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold uppercase tracking-widest rounded-full border border-blue-100">
                    {{ $user->company->name ?? 'Organization' }}
                </span>
            </div>
        </div>

        @if(session('status'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-xl flex items-center justify-between">
                <div class="flex items-center gap-3 font-semibold text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('status') }}
                </div>
            </div>
        @endif

        <!-- Open Assessments -->
        <div class="glass-card !p-0 overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-100 bg-slate-50">
                <h3 class="text-lg font-bold text-slate-900">Your Action Required</h3>
            </div>
            <div class="p-6">
                @php
                    $pendingAssessment = $user->assessments()->where('status', 'ongoing')->orWhere('status', 'pending')->first();
                @endphp

                @if($pendingAssessment || true) <!-- Fallback showing start for demo -->
                    <div class="flex items-center justify-between p-6 bg-white border border-slate-200 rounded-2xl md:hover:shadow-md transition-all group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center shrink-0 border border-orange-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            </div>
                            <div>
                                <h4 class="text-base font-bold text-slate-900">Standard Q2 Competency Assessment</h4>
                                <p class="text-xs font-medium text-slate-500 mt-1">Expected Time: 15-20 Min • AI Evaluated</p>
                            </div>
                        </div>
                        <a href="{{ route('assessment') }}" class="mq-button-primary shadow-sm hover:scale-105 active:scale-95 transition-transform !py-2.5">
                            Start Assessment
                        </a>
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-emerald-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">You're all caught up!</h3>
                        <p class="text-sm font-medium text-slate-500">There are no pending assessments assigned to you at this time.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Past Results -->
        <div class="glass-card shadow-sm border border-slate-200 bg-white">
            <h3 class="text-lg font-bold text-slate-900 mb-6">Historical Evaluations</h3>
            <div class="text-center py-12 border-2 border-dashed border-slate-200 rounded-2xl">
                <h3 class="text-sm font-bold text-slate-500 mb-1">No Past Data</h3>
                <p class="text-xs font-medium text-slate-400">Complete an assessment to view your AI feedback matrix.</p>
            </div>
        </div>
    </div>
</x-app-layout>
