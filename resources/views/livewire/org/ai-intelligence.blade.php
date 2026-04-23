<x-ui.card class="flex-1 bg-[#F5F3FF] border-none shadow-sm h-full flex flex-col">
    <div class="flex items-center gap-3 mb-8">
        <div class="bg-[#5D45FD] p-2 rounded-lg">
            <x-lucide-sparkles class="w-5 h-5 text-white" />
        </div>
        <h2 class="text-xl font-extrabold text-gray-900 tracking-tight">AI Intelligence</h2>
    </div>

    <div class="space-y-6 flex-1">
        @foreach($insights as $insight)
            <div class="flex gap-4 p-5 bg-white rounded-2xl shadow-sm border border-indigo-50/50 hover:shadow-md transition-shadow duration-300">
                <div class="flex-shrink-0 w-2 h-2 mt-2 rounded-full {{ $insight['color'] }}"></div>
                <div>
                    <h3 class="font-extrabold text-gray-900 text-sm tracking-tight">{{ $insight['title'] }}</h3>
                    <p class="text-[13px] text-gray-500 mt-1.5 leading-relaxed font-medium">
                        {{ $insight['description'] }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <a href="{{ route('org-ai-insights') }}" class="mt-8 w-full block text-center py-4 bg-white text-[#5D45FD] text-sm font-extrabold rounded-2xl border border-indigo-100/50 hover:bg-gray-50 transition-colors shadow-sm shadow-indigo-50">
        View All Insights
    </a>
</x-ui.card>
