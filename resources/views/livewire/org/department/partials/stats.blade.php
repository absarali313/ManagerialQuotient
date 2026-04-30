<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
        <p class="text-sm font-semibold text-gray-400">Total Departments</p>
        <p class="text-3xl font-extrabold text-gray-900 mt-2">{{ $stats['total'] }}</p>
    </div>
    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
        <p class="text-sm font-semibold text-gray-400">Active</p>
        <p class="text-3xl font-extrabold text-green-500 mt-2">{{ $stats['active'] }}</p>
    </div>
    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
        <p class="text-sm font-semibold text-gray-400">Inactive</p>
        <p class="text-3xl font-extrabold text-gray-300 mt-2">{{ $stats['inactive'] }}</p>
    </div>
</div>
