@php
    $score = $employee->current_mq_score ?? 0;
    $isActive = $employee->is_active ?? true;
    $deptName = $employee->department->name ?? 'N/A';

    $barColor = match (true) {
        $score >= 90 => '#5D45FD',
        $score >= 75 => '#3B82F6',
        $score >= 60 => '#F59E0B',
        default => '#EF4444',
    };

    $deptColors = [
        'Engineering' => ['bg-blue-50', 'text-blue-600'],
        'Product' => ['bg-indigo-50', 'text-indigo-600'],
        'Marketing' => ['bg-pink-50', 'text-pink-600'],
        'Sales' => ['bg-green-50', 'text-green-600'],
        'Design' => ['bg-orange-50', 'text-orange-600'],
        'Operations' => ['bg-gray-100', 'text-gray-600'],
        'HR' => ['bg-purple-50', 'text-purple-600'],
        'Finance' => ['bg-teal-50', 'text-teal-600'],
    ];

    [$badgeBg, $badgeText] = $deptColors[$deptName] ?? ['bg-gray-100', 'text-gray-600'];
@endphp

<tr wire:key="{{ $employee->id }}" class="group hover:bg-gray-50/60 transition-colors">

    {{-- Row number --}}
    <td class="px-6 py-4">
        <span class="text-sm font-extrabold text-gray-300">{{ $rowNumber }}</span>
    </td>

    {{-- Employee --}}
    <td class="px-6 py-4">
        <div class="flex items-center gap-3">
            <div class="relative shrink-0">
                <img
                    src="https://i.pravatar.cc/150?u={{ $employee->email }}"
                    class="w-9 h-9 rounded-full border border-gray-100 shadow-sm object-cover"
                    alt="{{ $employee->name }}"
                />
                <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full border-2 border-white {{ $isActive ? 'bg-green-400' : 'bg-gray-300' }}"></span>
            </div>
            <div>
                <p class="text-sm font-extrabold text-gray-900">{{ $employee->name }}</p>
                <p class="text-[11px] font-semibold text-gray-400">{{ $employee->email }}</p>
            </div>
        </div>
    </td>

    {{-- Department --}}
    <td class="px-6 py-4">
        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold {{ $badgeBg }} {{ $badgeText }}">
            <span class="w-1.5 h-1.5 rounded-full bg-current inline-block"></span>
            {{ $deptName }}
        </span>
    </td>

    {{-- Role --}}
    <td class="px-6 py-4">
        <span class="text-sm font-semibold text-gray-600">
            {{ $employee->jobRole->title ?? '—' }}
        </span>
    </td>

    {{-- Status --}}
    <td class="px-6 py-4">
        @if ($isActive)
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-green-50 text-green-600">
                <span class="w-1.5 h-1.5 rounded-full bg-green-400 inline-block"></span>
                Active
            </span>
        @else
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500">
                <span class="w-1.5 h-1.5 rounded-full bg-gray-400 inline-block"></span>
                Inactive
            </span>
        @endif
    </td>

    {{-- Score --}}
    <td class="px-6 py-4">
        @if ($score > 0)
            <div class="flex items-center gap-3">
                <div class="flex-1 max-w-[100px] bg-gray-100 rounded-full h-1.5">
                    <div class="h-1.5 rounded-full transition-all" style="width: {{ min(100, $score) }}%; background-color: {{ $barColor }};"></div>
                </div>
                <span class="text-sm font-extrabold text-gray-900">{{ number_format($score, 0) }}</span>
            </div>
        @else
            <span class="text-xs font-bold text-gray-300">—</span>
        @endif
    </td>

    {{-- Joined --}}
    <td class="px-6 py-4">
        <span class="text-sm font-semibold text-gray-500">
            {{ $employee->created_at->format('M d, Y') }}
        </span>
    </td>

    {{-- Actions dropdown --}}
    <td class="px-6 py-4 text-center">
        <div x-data="{ open: false }" class="relative inline-block">
            <button
                @click="open = !open"
                @click.outside="open = false"
                class="w-8 h-8 rounded-xl flex items-center justify-center border border-gray-200 text-gray-400 hover:border-[#5D45FD] hover:text-[#5D45FD] transition-all"
            >
                <x-lucide-more-horizontal class="w-4 h-4" />
            </button>

            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute right-0 mt-1.5 w-44 bg-white border border-gray-100 rounded-xl shadow-lg z-10 py-1 origin-top-right"
                style="display: none;"
            >
                {{-- View Profile --}}
                <button
                    @click="open = false"
                    class="w-full flex items-center gap-2.5 px-3.5 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors text-left"
                >
                    <x-lucide-user class="w-3.5 h-3.5 text-gray-400" />
                    View Profile
                </button>

                {{-- Edit Role --}}
                <a
                    wire:navigate
                    href="{{ route('org_employees_edit', $employee->id) }}"
                    class="w-full flex items-center gap-2.5 px-3.5 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors text-left"
                >
                    <x-lucide-briefcase class="w-3.5 h-3.5 text-gray-400" />
                    Edit Employee
                </a>

                <div class="border-t border-gray-100 my-1"></div>

                {{-- Deactivate / Activate --}}
                @if ($isActive)
                    <button
                        wire:click="deactivate({{ $employee->id }})"
                        wire:confirm="Deactivate {{ $employee->name }}? They will lose access immediately."
                        @click="open = false"
                        class="w-full flex items-center gap-2.5 px-3.5 py-2 text-sm font-semibold text-red-500 hover:bg-red-50 transition-colors text-left"
                    >
                        <x-lucide-user-x class="w-3.5 h-3.5" />
                        Deactivate
                    </button>
                @else
                    <button
                        wire:click="activate({{ $employee->id }})"
                        @click="open = false"
                        class="w-full flex items-center gap-2.5 px-3.5 py-2 text-sm font-semibold text-green-600 hover:bg-green-50 transition-colors text-left"
                    >
                        <x-lucide-user-check class="w-3.5 h-3.5" />
                        Reactivate
                    </button>
                @endif
            </div>
        </div>
    </td>

</tr>
