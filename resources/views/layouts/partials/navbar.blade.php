<header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-gray-100 px-8 py-3.5">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            @if(auth()->user()->isOrganization())
                @php $org = auth()->user()->ownedOrganization; @endphp
                <div class="flex items-center gap-2 px-3 py-1.5 bg-gray-50 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-100 transition-all">
                    <div class="w-6 h-6 rounded-md bg-[#5D45FD] flex items-center justify-center text-white text-[10px] font-bold">
                        {{ strtoupper(substr($org?->name ?? 'O', 0, 2)) }}
                    </div>
                    <span class="text-sm font-bold text-gray-800">{{ $org?->name ?? 'Organization' }}</span>
                    <x-lucide-chevron-down class="w-3.5 h-3.5 text-gray-400" />
                </div>
            @else
                @php $firstName = explode(' ', auth()->user()->display_name)[0]; @endphp
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Good morning, {{ $firstName }} 👋</h1>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <div class="relative group">
                <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                    <x-lucide-search class="w-4 h-4 text-gray-400 group-focus-within:text-gray-600 transition-colors" />
                </div>
                <input type="text"
                    placeholder="{{ auth()->user()->isOrganization() ? 'Search employees, reports...' : 'Search insights...' }}"
                    class="pl-10 pr-4 py-2 bg-gray-50/50 border border-gray-100 rounded-xl text-sm focus:bg-white focus:ring-0 focus:border-brand-lime transition-all w-64"
                >
            </div>

            <button class="relative p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl transition-all">
                <x-lucide-bell class="w-5 h-5" />
                <span class="absolute top-2 right-2.5 w-2 h-2 bg-red-500 border-2 border-white rounded-full"></span>
            </button>

            @if(auth()->user()->isEmployee())
                <button class="flex items-center gap-2 px-4 py-2 bg-[#111827] text-white rounded-xl text-sm font-semibold hover:bg-black transition-all shadow-sm shadow-black/10">
                    <x-lucide-plus-circle class="w-4 h-4" />
                    <span>Set Goal</span>
                </button>
            @endif
        </div>
    </div>
</header>
