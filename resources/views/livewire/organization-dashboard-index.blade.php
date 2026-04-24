<div class="space-y-6 max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-8 h-full bg-[#FAFAFA]">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-2">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Managerial Quotient</h1>
            <p class="text-base text-gray-500 mt-1 font-medium">Overview of organizational performance and intelligence metrics.</p>
        </div>
        <div class="flex items-center gap-3">
            <button wire:click="export" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-xl text-sm font-semibold hover:bg-gray-50 transition-all shadow-sm">
                <x-lucide-download class="w-4 h-4" />
                Export
            </button>
            <a href="{{ route('org-assessments') }}" class="flex items-center gap-2 px-4 py-2 bg-[#5D45FD] text-white rounded-xl text-sm font-semibold hover:bg-[#4C36E0] transition-all shadow-md shadow-indigo-100">
                <x-lucide-plus class="w-4 h-4" />
                New Assessment
            </a>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <livewire:org.stats />

    <div class="grid grid-cols-12 gap-6 items-stretch">
        <!-- Performance Over Time -->
        <div class="col-span-12 lg:col-span-8 flex flex-col">
            <livewire:org.performance-over-time />
        </div>

        <!-- AI Intelligence -->
        <div class="col-span-12 lg:col-span-4 flex flex-col">
            <livewire:org.ai-intelligence />
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6 items-stretch pb-10">
        <!-- Top Performers -->
        <div class="col-span-12 lg:col-span-7 flex flex-col">
            <livewire:org.top-performers-list />
        </div>

        <!-- Department Health -->
        <div class="col-span-12 lg:col-span-5 flex flex-col">
            <livewire:org.department-health-chart />
        </div>
    </div>
</div>
