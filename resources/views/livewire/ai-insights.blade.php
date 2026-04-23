<section class="bg-gradient-to-br from-indigo-50/50 via-purple-50/50 to-blue-50/50 border border-indigo-100 rounded-[32px] p-6 flex flex-col shadow-sm">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center shadow-md shadow-indigo-200">
            <x-lucide-activity class="w-5 h-5 text-white" />
        </div>
        <h2 class="text-lg font-bold text-gray-900 tracking-tight font-display">AI Insights</h2>
    </div>

    <div class="space-y-3 mb-6">
        @foreach($insights as $insight)
            <div class="bg-white/80 backdrop-blur-md rounded-2xl p-4 shadow-sm border border-white/50 {{ $insight['border_color'] ?? '' }}">
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="text-[9px] font-bold text-indigo-500 tracking-widest uppercase">{{ $insight['type'] }}</span>
                </div>
                <p class="text-[13px] leading-relaxed text-gray-700 font-medium tracking-tight">
                    {{ $insight['content'] }}
                </p>
            </div>
        @endforeach
    </div>

    <a href="{{ route('ai-insights') }}" class="w-full flex items-center justify-center gap-2 py-3 bg-white border border-gray-100 text-indigo-600 rounded-xl text-sm font-bold hover:bg-white hover:shadow-md transition-all">
        <span>Explore All Insights</span>
        <x-lucide-arrow-right class="w-4 h-4" />
    </a>
</section>
