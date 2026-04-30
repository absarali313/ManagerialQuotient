<div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
    <a wire:navigate href="{{ route('org-employees') }}" class="px-5 py-2.5 text-sm font-bold text-gray-600 hover:text-gray-900 transition-colors">
        Cancel
    </a>
    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#5D45FD] text-white text-sm font-bold hover:bg-[#4c38e0] transition-colors shadow-sm flex items-center gap-2">
        <x-lucide-save class="w-4 h-4" />
        {{ $employee && $employee->exists ? 'Update Employee' : 'Create Employee' }}
    </button>
</div>
