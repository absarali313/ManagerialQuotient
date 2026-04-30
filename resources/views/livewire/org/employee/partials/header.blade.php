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
