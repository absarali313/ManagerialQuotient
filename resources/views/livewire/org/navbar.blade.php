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
                    wire:model.live.debounce.300ms="search"
                    placeholder="{{ auth()->user()->isOrganization() ? 'Search employees, reports...' : 'Search insights...' }}"
                    class="pl-10 pr-4 py-2 bg-gray-50/50 border border-gray-100 rounded-xl text-sm focus:bg-white focus:ring-0 focus:border-brand-lime transition-all w-64"
                >
            </div>

            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="relative p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl transition-all">
                    <x-lucide-bell class="w-5 h-5" />
                    @if($this->notifications->count() > 0)
                        <span class="absolute top-2 right-2.5 w-2 h-2 bg-red-500 border-2 border-white rounded-full"></span>
                    @endif
                </button>

                <div x-show="open" @click.away="open = false" 
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="absolute right-0 mt-2 w-80 bg-white rounded-2xl border border-gray-100 shadow-xl overflow-hidden z-50">
                    <div class="p-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                        <h3 class="text-sm font-bold text-gray-900">Notifications</h3>
                        <span class="text-[10px] font-bold text-blue-600 uppercase">{{ $this->notifications->count() }} New</span>
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                        @forelse($this->notifications as $notification)
                            <div class="p-4 border-b border-gray-50 hover:bg-gray-50 transition-colors cursor-pointer group">
                                <div class="flex gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                        <x-lucide-check-circle class="w-5 h-5" />
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-900 leading-tight">
                                            {{ $notification->assignedTo->name }} completed an assessment
                                        </p>
                                        <p class="text-[10px] text-gray-500 mt-1">
                                            {{ $notification->jobRole?->title ?? 'General' }} Assessment • <span class="text-emerald-600 font-bold uppercase">Completed</span>
                                        </p>
                                        <p class="text-[10px] text-gray-400 mt-1">{{ $notification->completed_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center">
                                <x-lucide-bell-off class="w-8 h-8 text-gray-200 mx-auto mb-2" />
                                <p class="text-xs text-gray-500">No new notifications</p>
                            </div>
                        @endforelse
                    </div>
                    @if($this->notifications->count() > 0)
                        <div class="p-3 bg-gray-50 text-center">
                            <button class="text-[10px] font-bold text-gray-500 uppercase hover:text-gray-700">View All Notifications</button>
                        </div>
                    @endif
                </div>
            </div>

            @if(auth()->user()->isEmployee())
                <button class="flex items-center gap-2 px-4 py-2 bg-[#111827] text-white rounded-xl text-sm font-semibold hover:bg-black transition-all shadow-sm shadow-black/10">
                    <x-lucide-plus-circle class="w-4 h-4" />
                    <span>Set Goal</span>
                </button>
            @endif
        </div>
    </div>
</header>
