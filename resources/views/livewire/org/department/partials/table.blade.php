<div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden pb-2">
    <div class="p-4 border-b border-gray-100 flex items-center justify-between gap-4 bg-gray-50/50">
        <div class="relative w-72">
            <x-lucide-search class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400" />
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Search departments..."
                class="w-full pl-10 pr-4 py-2 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] outline-none transition-all"
            >
        </div>
    </div>

    <table class="w-full text-left">
        <thead class="bg-gray-50/50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-3.5 text-xs font-bold text-gray-400 uppercase tracking-wider">#</th>
                <th class="px-6 py-3.5 text-xs font-bold text-gray-400 uppercase tracking-wider cursor-pointer hover:text-gray-700" wire:click="sort('name')">Department</th>
                <th class="px-6 py-3.5 text-xs font-bold text-gray-400 uppercase tracking-wider cursor-pointer hover:text-gray-700" wire:click="sort('code')">Code</th>
                <th class="px-6 py-3.5 text-xs font-bold text-gray-400 uppercase tracking-wider">Head</th>
                <th class="px-6 py-3.5 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3.5 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse ($departments as $index => $department)
                <tr wire:key="{{ $department->id }}" class="group hover:bg-gray-50/60 transition-colors">
                    <td class="px-6 py-4">
                        <span class="text-sm font-extrabold text-gray-300">{{ ($departments->currentPage() - 1) * $departments->perPage() + $index + 1 }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm font-extrabold text-gray-900">{{ $department->name }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-semibold text-gray-500">{{ $department->code ?? '—' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if($department->head)
                            <img src="https://i.pravatar.cc/150?u={{ $department->head->email }}" class="w-8 h-8 rounded-full border border-gray-100 shadow-sm object-cover" alt="{{ $department->head->name }}">
                            @endif
                            <span class="text-sm font-semibold text-gray-600">{{ $department->head->name ?? '—' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if ($department->is_active)
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
                    <td class="px-6 py-4 text-center">
                        <div x-data="{ open: false }" class="relative inline-block">
                            <button @click="open = !open" @click.outside="open = false" class="w-8 h-8 rounded-xl flex items-center justify-center border border-gray-200 text-gray-400 hover:border-[#5D45FD] hover:text-[#5D45FD] transition-all">
                                <x-lucide-more-horizontal class="w-4 h-4" />
                            </button>
                            <div x-show="open" x-transition class="absolute right-0 mt-1.5 w-44 bg-white border border-gray-100 rounded-xl shadow-lg z-10 py-1 origin-top-right" style="display: none;">
                                <a wire:navigate href="{{ route('org_departments_edit', $department->id) }}" class="w-full flex items-center gap-2.5 px-3.5 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors text-left">
                                    <x-lucide-edit class="w-3.5 h-3.5 text-gray-400" />
                                    Edit
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                @if ($department->is_active)
                                    <button wire:click="deactivate({{ $department->id }})" wire:confirm="Deactivate {{ $department->name }}?" class="w-full flex items-center gap-2.5 px-3.5 py-2 text-sm font-semibold text-red-500 hover:bg-red-50 transition-colors text-left">
                                        <x-lucide-x-circle class="w-3.5 h-3.5" />
                                        Deactivate
                                    </button>
                                @else
                                    <button wire:click="activate({{ $department->id }})" class="w-full flex items-center gap-2.5 px-3.5 py-2 text-sm font-semibold text-green-600 hover:bg-green-50 transition-colors text-left">
                                        <x-lucide-check-circle class="w-3.5 h-3.5" />
                                        Reactivate
                                    </button>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <x-lucide-folder-open class="w-8 h-8 text-gray-400" />
                        </div>
                        <p class="text-sm font-bold text-gray-900">No departments found</p>
                        <p class="text-sm text-gray-500 mt-1">Try adjusting your search.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if ($departments->hasPages())
        <div class="px-6 pt-4">
            {{ $departments->links() }}
        </div>
    @endif
</div>
