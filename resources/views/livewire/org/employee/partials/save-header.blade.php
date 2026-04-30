<div class="flex items-center justify-between">
    <div>
        <h1 class="text-xl font-extrabold text-gray-900">{{ $employee && $employee->exists ? 'Edit Employee' : 'Create Employee' }}</h1>
        <p class="text-sm text-gray-400 font-medium mt-0.5">Fill in the details below to {{ $employee && $employee->exists ? 'update the' : 'add a new' }} member.</p>
    </div>
    <a wire:navigate href="{{ route('org-employees') }}" class="px-4 py-2 text-sm font-bold text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
        Back to Employees
    </a>
</div>
