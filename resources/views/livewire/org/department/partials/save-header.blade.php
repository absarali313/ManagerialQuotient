<div class="flex items-center justify-between">
    <div>
        <h1 class="text-xl font-extrabold text-gray-900">{{ $department && $department->exists ? 'Edit Department' : 'Create Department' }}</h1>
        <p class="text-sm text-gray-400 font-medium mt-0.5">Fill in the details below to {{ $department && $department->exists ? 'update the' : 'add a new' }} department.</p>
    </div>
    <a wire:navigate href="{{ route('org_departments') }}" class="px-4 py-2 text-sm font-bold text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors shadow-sm">
        Back to Departments
    </a>
</div>
