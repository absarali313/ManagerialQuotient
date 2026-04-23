<x-layouts.dashboard>
    <div class="flex flex-col items-center justify-center min-h-[60vh] text-center px-4">
        <div class="w-20 h-20 bg-[#5D45FD]/10 rounded-3xl flex items-center justify-center mb-6">
            <x-lucide-rocket class="w-10 h-10 text-[#5D45FD]" />
        </div>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-3">{{ $title }}</h1>
        <p class="text-base text-gray-400 max-w-md mb-8">{{ $description }}</p>
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#5D45FD]/10 text-[#5D45FD] rounded-full text-sm font-bold">
            <x-lucide-clock class="w-4 h-4" />
            Coming Soon
        </div>
        <div class="mt-8">
            <a href="javascript:history.back()"
               class="flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-xl text-sm font-semibold hover:bg-gray-50 transition-all shadow-sm">
                <x-lucide-arrow-left class="w-4 h-4" />
                Go Back
            </a>
        </div>
    </div>
</x-layouts.dashboard>
