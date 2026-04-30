<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-extrabold text-gray-900">{{ $employee && $employee->exists ? 'Edit Employee' : 'Create Employee' }}</h1>
            <p class="text-sm text-gray-400 font-medium mt-0.5">Fill in the details below to {{ $employee && $employee->exists ? 'update the' : 'add a new' }} member.</p>
        </div>
        <a wire:navigate href="{{ route('org-employees') }}" class="px-4 py-2 text-sm font-bold text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
            Back to Employees
        </a>
    </div>

    <form wire:submit.prevent="save" class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 space-y-8">
        
        <!-- Basic Info -->
        <div>
            <h2 class="text-lg font-bold text-gray-900 mb-4">Basic Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="space-y-1.5">
                    <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                    <input type="text" id="name" wire:model="name" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none" placeholder="John Doe">
                    @error('name') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                    <input type="email" id="email" wire:model="email" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none" placeholder="john@example.com">
                    @error('email') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Phone -->
                <div class="space-y-1.5">
                    <label for="phone" class="block text-sm font-semibold text-gray-700">Phone Number (Optional)</label>
                    <input type="text" id="phone" wire:model="phone" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none" placeholder="+1 (555) 000-0000">
                    @error('phone') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <!-- Employee ID -->
                <div class="space-y-1.5">
                    <label for="employee_id" class="block text-sm font-semibold text-gray-700">Employee ID (Optional)</label>
                    <input type="text" id="employee_id" wire:model="employee_id" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none" placeholder="EMP-001">
                    @error('employee_id') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <hr class="border-gray-100">

        <!-- Role & Department -->
        <div>
            <h2 class="text-lg font-bold text-gray-900 mb-4">Role & Department</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Department -->
                <div class="space-y-1.5">
                    <label for="department_id" class="block text-sm font-semibold text-gray-700">Department</label>
                    <select id="department_id" wire:model="department_id" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none">
                        <option value="">Select a department...</option>
                        @foreach($this->departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Job Role -->
                <div class="space-y-1.5">
                    <label for="job_role_id" class="block text-sm font-semibold text-gray-700">Job Role</label>
                    <select id="job_role_id" wire:model="job_role_id" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none">
                        <option value="">Select a role...</option>
                        @foreach($this->jobRoles as $role)
                            <option value="{{ $role->id }}">{{ $role->title }}</option>
                        @endforeach
                    </select>
                    @error('job_role_id') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- System Role -->
                <div class="space-y-1.5">
                    <label for="system_role" class="block text-sm font-semibold text-gray-700">System Permissions</label>
                    <select id="system_role" wire:model="system_role" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none">
                        <option value="employee">Employee</option>
                        <option value="manager">Manager</option>
                        <option value="hr">HR</option>
                        <option value="org_admin">Organization Admin</option>
                    </select>
                    @error('system_role') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <!-- Status -->
                <div class="space-y-1.5 flex flex-col justify-center">
                    <label class="flex items-center gap-3 cursor-pointer mt-6">
                        <div class="relative">
                            <input type="checkbox" wire:model="is_active" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#5D45FD]"></div>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Active Employee</span>
                    </label>
                    @error('is_active') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
            <a wire:navigate href="{{ route('org-employees') }}" class="px-5 py-2.5 text-sm font-bold text-gray-600 hover:text-gray-900 transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#5D45FD] text-white text-sm font-bold hover:bg-[#4c38e0] transition-colors shadow-sm flex items-center gap-2">
                <x-lucide-save class="w-4 h-4" />
                {{ $employee && $employee->exists ? 'Update Employee' : 'Create Employee' }}
            </button>
        </div>
    </form>
</div>
