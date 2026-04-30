<div>
    <h2 class="text-lg font-bold text-gray-900 mb-4">Team Members</h2>
    
    <div class="space-y-4">
        <!-- Add Member Search -->
        <div class="relative max-w-md" x-data="{
            open: false,
            search: '',
            options: {{ Js::from($this->employees->map(fn($e) => ['id' => $e->id, 'name' => $e->name, 'email' => $e->email, 'employee_id' => $e->employee_id ?? 'No ID'])) }},
            get availableOptions() {
                // Use $wire directly for better reactivity with arrays in getters
                const existingIds = Array.from($wire.memberIds || []);
                return this.options.filter(i => !existingIds.some(id => id == i.id));
            },
            get filteredOptions() {
                let available = this.availableOptions;
                if (this.search === '') return available;
                
                const term = this.search.toLowerCase();
                return available.filter(i => 
                    i.name.toLowerCase().includes(term) || 
                    i.email.toLowerCase().includes(term) ||
                    (i.employee_id && i.employee_id.toLowerCase().includes(term))
                );
            }
        }">
            <div class="relative">
                <x-lucide-search class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                <input 
                    type="text" 
                    x-model="search" 
                    @focus="open = true" 
                    @click.stop
                    placeholder="Search to add members..." 
                    class="w-full pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none"
                >
            </div>

            <!-- Dropdown -->
            <div x-show="open" 
                 @click.outside="open = false"
                 x-transition 
                 class="absolute z-10 w-full mt-1 bg-white border border-gray-100 rounded-xl shadow-lg overflow-hidden" 
                 style="display: none;">
                <ul class="max-h-64 overflow-y-auto py-1">
                    <template x-for="option in filteredOptions" :key="option.id">
                        <li @click="$wire.addMember(option.id); search = '';" 
                            class="px-3 py-2 hover:bg-gray-50 cursor-pointer flex flex-col gap-0.5 border-l-2 border-transparent hover:border-[#5D45FD] transition-colors">
                            <div class="flex items-center justify-between">
                                <span x-text="option.name" class="text-sm font-bold text-gray-900"></span>
                                <span x-text="option.employee_id" class="text-[10px] font-bold text-[#5D45FD] bg-[#5D45FD]/10 px-1.5 py-0.5 rounded tracking-wide" x-show="option.employee_id !== 'No ID'"></span>
                            </div>
                            <span x-text="option.email" class="text-xs text-gray-500 font-medium"></span>
                        </li>
                    </template>
                    <li x-show="filteredOptions.length === 0" class="px-3 py-4 text-center text-sm text-gray-500">
                        <span x-text="search === '' ? 'All employees are already in this team.' : 'No matching employees found.'"></span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Selected Members List -->
        <div class="bg-gray-50 rounded-xl border border-gray-200 overflow-hidden">
            @if(count($this->teamMembers) > 0)
                <ul class="divide-y divide-gray-200">
                    @foreach($this->teamMembers as $member)
                        <li class="flex items-center justify-between p-3 bg-white group hover:bg-gray-50/50 transition-colors">
                            <div class="flex items-center gap-3">
                                <img src="{{ $member->display_avatar }}" alt="{{ $member->name }}" class="w-8 h-8 rounded-full border border-gray-100 shadow-sm object-cover">
                                <div>
                                    <p class="text-sm font-bold text-gray-900">{{ $member->name }}</p>
                                    <p class="text-xs text-gray-500 font-medium">{{ $member->email }}</p>
                                </div>
                            </div>
                            <button type="button" wire:click="removeMember({{ $member->id }})" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors opacity-0 group-hover:opacity-100 focus:opacity-100">
                                <x-lucide-x class="w-4 h-4" />
                            </button>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="p-8 text-center">
                    <x-lucide-users class="w-8 h-8 text-gray-400 mx-auto mb-2" />
                    <p class="text-sm font-bold text-gray-900">No members added yet</p>
                    <p class="text-xs text-gray-500 mt-1">Search and select employees above to add them to this team.</p>
                </div>
            @endif
        </div>
    </div>
</div>
