<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-extrabold text-gray-900">{{ $department && $department->exists ? 'Edit Department' : 'Create Department' }}</h1>
            <p class="text-sm text-gray-400 font-medium mt-0.5">Fill in the details below to {{ $department && $department->exists ? 'update the' : 'add a new' }} department.</p>
        </div>
        <a wire:navigate href="{{ route('org_departments') }}" class="px-4 py-2 text-sm font-bold text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
            Back to Departments
        </a>
    </div>

    <form wire:submit.prevent="save" class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 space-y-8">
        
        <div>
            <h2 class="text-lg font-bold text-gray-900 mb-4">Department Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="space-y-1.5">
                    <label for="name" class="block text-sm font-semibold text-gray-700">Department Name</label>
                    <input type="text" id="name" wire:model="name" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none" placeholder="E.g. Engineering">
                    @error('name') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Code -->
                <div class="space-y-1.5">
                    <label for="code" class="block text-sm font-semibold text-gray-700">Department Code (Optional)</label>
                    <input type="text" id="code" wire:model="code" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none" placeholder="E.g. ENG">
                    @error('code') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Department Head -->
                <div class="space-y-1.5 md:col-span-2" x-data="{
                    open: false,
                    search: '',
                    value: @entangle('headUserId'),
                    options: {{ Js::from($this->employees->map(fn($e) => ['id' => $e->id, 'name' => $e->name, 'email' => $e->email, 'employee_id' => $e->employee_id ?? 'No ID'])) }},
                    get filteredOptions() {
                        if (this.search === '') return this.options;
                        return this.options.filter(i => 
                            i.name.toLowerCase().includes(this.search.toLowerCase()) || 
                            i.email.toLowerCase().includes(this.search.toLowerCase()) ||
                            (i.employee_id && i.employee_id.toLowerCase().includes(this.search.toLowerCase()))
                        );
                    },
                    get selectedOption() {
                        return this.options.find(i => i.id == this.value);
                    }
                }">
                    <label class="block text-sm font-semibold text-gray-700">Department Head (Optional)</label>
                    <div class="relative">
                        <!-- Select Button -->
                        <button type="button" @click="open = !open" @click.outside="open = false" class="w-full flex items-center justify-between px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none text-left">
                            <span x-text="selectedOption ? selectedOption.name : 'Select a department head...'" :class="selectedOption ? 'text-gray-900 font-bold' : 'text-gray-500'"></span>
                            <x-lucide-chevron-down class="w-4 h-4 text-gray-400 transition-transform" x-bind:class="open ? 'rotate-180' : ''" />
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" x-transition class="absolute z-10 w-full mt-1 bg-white border border-gray-100 rounded-xl shadow-lg overflow-hidden" style="display: none;">
                            <div class="p-2 border-b border-gray-50 bg-gray-50/50">
                                <div class="relative">
                                    <x-lucide-search class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
                                    <input x-ref="searchInput" type="text" x-model="search" placeholder="Search employees..." class="w-full pl-9 pr-3 py-1.5 text-sm bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] outline-none transition-all shadow-sm" @click.stop>
                                </div>
                            </div>
                            <ul class="max-h-64 overflow-y-auto py-1">
                                <li @click="value = null; open = false; search = ''" class="px-3 py-2.5 hover:bg-gray-50 cursor-pointer text-sm text-gray-500 font-semibold border-b border-gray-50">
                                    Clear selection
                                </li>
                                <template x-for="option in filteredOptions" :key="option.id">
                                    <li @click="value = option.id; open = false; search = ''" 
                                        class="px-3 py-2 hover:bg-gray-50 cursor-pointer flex flex-col gap-0.5 border-l-2 transition-colors"
                                        :class="value === option.id ? 'border-[#5D45FD] bg-[#5D45FD]/5' : 'border-transparent'">
                                        <div class="flex items-center justify-between">
                                            <span x-text="option.name" class="text-sm font-bold text-gray-900"></span>
                                            <span x-text="option.employee_id" class="text-[10px] font-bold text-[#5D45FD] bg-[#5D45FD]/10 px-1.5 py-0.5 rounded tracking-wide" x-show="option.employee_id !== 'No ID'"></span>
                                        </div>
                                        <span x-text="option.email" class="text-xs text-gray-500 font-medium"></span>
                                    </li>
                                </template>
                                <li x-show="filteredOptions.length === 0" class="px-3 py-6 text-center">
                                    <p class="text-sm font-bold text-gray-900">No employees found</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Try a different search term</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @error('headUserId') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div class="space-y-1.5 md:col-span-2">
                    <label for="description" class="block text-sm font-semibold text-gray-700">Description (Optional)</label>
                    <textarea id="description" wire:model="description" rows="3" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none" placeholder="A brief description of this department..."></textarea>
                    @error('description') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <!-- Status -->
                <div class="space-y-1.5 md:col-span-2">
                    <label class="flex items-center gap-3 cursor-pointer mt-2">
                        <div class="relative">
                            <input type="checkbox" wire:model="isActive" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#5D45FD]"></div>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Active Department</span>
                    </label>
                    @error('isActive') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
            <a wire:navigate href="{{ route('org_departments') }}" class="px-5 py-2.5 text-sm font-bold text-gray-600 hover:text-gray-900 transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#5D45FD] text-white text-sm font-bold hover:bg-[#4c38e0] transition-colors shadow-sm flex items-center gap-2">
                <x-lucide-save class="w-4 h-4" />
                {{ $department && $department->exists ? 'Update Department' : 'Create Department' }}
            </button>
        </div>
    </form>
</div>
