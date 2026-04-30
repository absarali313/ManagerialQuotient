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
            <input type="text" id="employee_id" wire:model="employeeId" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none" placeholder="EMP-001">
            @error('employeeId') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div class="space-y-1.5 md:col-span-2" x-data="{ showPassword: false }">
            <label for="password" class="block text-sm font-semibold text-gray-700">
                Password {{ $employee && $employee->exists ? '(Leave blank to keep current)' : '' }}
            </label>
            <div class="relative">
                <input :type="showPassword ? 'text' : 'password'" id="password" wire:model="password" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5D45FD] focus:border-[#5D45FD] transition-all text-sm outline-none pr-10" placeholder="••••••••">
                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition-colors focus:outline-none">
                    <x-lucide-eye x-show="!showPassword" class="h-5 w-5" />
                    <x-lucide-eye-off x-show="showPassword" class="h-5 w-5" style="display: none;" />
                </button>
            </div>
            @error('password') <span class="text-xs font-bold text-red-500">{{ $message }}</span> @enderror
        </div>
    </div>
</div>
