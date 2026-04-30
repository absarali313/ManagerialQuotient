<div>
    <h2 class="text-lg font-bold text-gray-900 mb-4">Role & Department</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Department -->
        <div class="space-y-1.5">
            <label for="department_id" class="block text-sm font-semibold text-gray-700">Department</label>
            <select id="department_id" wire:model="departmentId" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none">
                <option value="">Select a department...</option>
                @foreach($this->departments as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                @endforeach
            </select>
            @error('departmentId') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Team -->
        <div class="space-y-1.5">
            <label for="team_id" class="block text-sm font-semibold text-gray-700">Team (Optional)</label>
            <select id="team_id" wire:model="teamId" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none">
                <option value="">Select a team...</option>
                @foreach($this->teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
            @error('teamId') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Job Role -->
        <div class="space-y-1.5">
            <label for="job_role_id" class="block text-sm font-semibold text-gray-700">Job Role</label>
            <select id="job_role_id" wire:model="jobRoleId" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none">
                <option value="">Select a role...</option>
                @foreach($this->jobRoles as $role)
                    <option value="{{ $role->id }}">{{ $role->title }}</option>
                @endforeach
            </select>
            @error('jobRoleId') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- System Role -->
        <div class="space-y-1.5">
            <label for="system_role" class="block text-sm font-semibold text-gray-700">System Permissions</label>
            <select id="system_role" wire:model="systemRole" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none">
                <option value="employee">Employee</option>
                <option value="manager">Manager</option>
                <option value="hr">HR</option>
                <option value="org_admin">Organization Admin</option>
            </select>
            @error('systemRole') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
        </div>
        
        <!-- Status -->
        <div class="space-y-1.5 flex flex-col justify-center">
            <label class="flex items-center gap-3 cursor-pointer mt-6">
                <div class="relative">
                    <input type="checkbox" wire:model="isActive" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#5D45FD]"></div>
                </div>
                <span class="text-sm font-semibold text-gray-700">Active Employee</span>
            </label>
            @error('isActive') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
        </div>
    </div>
</div>
