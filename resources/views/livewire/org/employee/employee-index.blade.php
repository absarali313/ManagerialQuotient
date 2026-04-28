<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-extrabold text-gray-900">Employees</h1>
            <p class="text-sm text-gray-400 font-medium mt-0.5">Manage your organisation's members</p>
        </div>
        <button
            wire:click="invite"
            class="flex items-center gap-2 px-4 py-2 rounded-xl bg-[#5D45FD] text-white text-sm font-bold hover:bg-[#4c38e0] transition-colors shadow-sm"
        >
            <x-lucide-user-plus class="w-4 h-4" />
            Invite Employee
        </button>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ([
            ['label' => 'Total',    'value' => $stats['total'],    'icon' => 'users',        'color' => 'text-[#5D45FD]', 'bg' => 'bg-purple-50'],
            ['label' => 'Active',   'value' => $stats['active'],   'icon' => 'user-check',   'color' => 'text-green-600',  'bg' => 'bg-green-50'],
            ['label' => 'Inactive', 'value' => $stats['inactive'], 'icon' => 'user-x',       'color' => 'text-red-500',    'bg' => 'bg-red-50'],
            ['label' => 'Avg Score','value' => $stats['avgScore'], 'icon' => 'bar-chart-2',  'color' => 'text-blue-600',   'bg' => 'bg-blue-50'],
        ] as $card)
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm px-5 py-4 flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl {{ $card['bg'] }} flex items-center justify-center shrink-0">
                    <x-dynamic-component :component="'lucide-' . $card['icon']" class="w-5 h-5 {{ $card['color'] }}" />
                </div>
                <div>
                    <p class="text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">{{ $card['label'] }}</p>
                    <p class="text-xl font-extrabold text-gray-900 leading-tight">{{ $card['value'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Filters + Table --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden pb-2">

        {{-- Toolbar --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 px-6 py-4 border-b border-gray-100">

            {{-- Search --}}
            <div class="relative flex-1 w-full sm:max-w-xs">
                <x-lucide-search class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" />
                <input
                    wire:model.live.debounce.300ms="search"
                    type="text"
                    placeholder="Search name or email…"
                    class="w-full pl-9 pr-4 py-2 text-sm bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#5D45FD]/20 focus:border-[#5D45FD] transition-all"
                />
            </div>

            {{-- Department filter --}}
            <select
                wire:model.live="department"
                class="text-sm bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-gray-700 font-semibold focus:outline-none focus:ring-2 focus:ring-[#5D45FD]/20 focus:border-[#5D45FD] transition-all"
            >
                <option value="">All Departments</option>
                @foreach ($departments as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                @endforeach
            </select>

            {{-- Active filter indicator --}}
            @if ($search || $department)
                <button
                    wire:click="resetFilters"
                    class="flex items-center gap-1.5 text-xs font-bold text-gray-400 hover:text-red-500 transition-colors ml-auto sm:ml-0"
                >
                    <x-lucide-x class="w-3.5 h-3.5" />
                    Clear
                </button>
            @endif

            {{-- Count --}}
            <p class="text-xs font-bold text-gray-400 ml-auto hidden sm:block">
                {{ $employees->total() }} {{ Str::plural('employee', $employees->total()) }}
            </p>
        </div>

        {{-- Table --}}
        <table class="w-full text-left">
            <thead>
            <tr class="border-b border-gray-100">
                <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest w-12">#</th>
                <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">
                    <button wire:click="sort('name')" class="flex items-center gap-1 hover:text-gray-700 transition-colors">
                        Employee
                        @include('livewire.org.employee.partials.sort-icon', ['column' => 'name'])
                    </button>
                </th>
                <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Department</th>
                <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">Role</th>
                <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">
                    <button wire:click="sort('is_active')" class="flex items-center gap-1 hover:text-gray-700 transition-colors">
                        Status
                        @include('livewire.org.employee.partials.sort-icon', ['column' => 'is_active'])
                    </button>
                </th>
                <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">
                    <button wire:click="sort('current_mq_score')" class="flex items-center gap-1 hover:text-gray-700 transition-colors">
                        Score
                        @include('livewire.org.employee.partials.sort-icon', ['column' => 'current_mq_score'])
                    </button>
                </th>
                <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">
                    <button wire:click="sort('created_at')" class="flex items-center gap-1 hover:text-gray-700 transition-colors">
                        Joined
                        @include('livewire.org.employee.partials.sort-icon', ['column' => 'created_at'])
                    </button>
                </th>
                <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest text-center w-20">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
            @forelse ($employees as $index => $employee)
                @include('livewire.org.employee.partials.row', [
                    'employee' => $employee,
                    'rowNumber' => ($employees->currentPage() - 1) * $employees->perPage() + $index + 1,
                ])
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center">
                                <x-lucide-users class="w-6 h-6 text-gray-400" />
                            </div>
                            <p class="text-sm font-bold text-gray-500">No employees found</p>
                            <p class="text-xs text-gray-400 font-medium">Try adjusting your search or filters</p>
                            @if ($search || $department)
                                <button wire:click="resetFilters" class="text-xs font-bold text-[#5D45FD] hover:underline">
                                    Clear filters
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if ($employees->hasPages())
            <div class="px-6 pt-4">
                {{ $employees->links() }}
            </div>
        @endif

    </div>

</div>
