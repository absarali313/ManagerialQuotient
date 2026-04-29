<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 group hover:shadow-md transition-shadow">
        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
            <x-lucide-clipboard-check class="w-6 h-6" />
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900">{{ App\Models\Assessment::where('organization_id', auth()->user()->organization_id)->count() }}</p>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Assignments</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 group hover:shadow-md transition-shadow">
        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
            <x-lucide-check-circle class="w-6 h-6" />
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900">{{ App\Models\Assessment::where('organization_id', auth()->user()->organization_id)->where('status', 'completed')->count() }}</p>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Completed</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 group hover:shadow-md transition-shadow">
        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
            <x-lucide-clock class="w-6 h-6" />
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900">{{ App\Models\Assessment::where('organization_id', auth()->user()->organization_id)->whereIn('status', ['pending', 'in_progress'])->count() }}</p>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Active</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 group hover:shadow-md transition-shadow">
        <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
            <x-lucide-users class="w-6 h-6" />
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-900">{{ App\Models\User::where('organization_id', auth()->user()->organization_id)->count() }}</p>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Org Size</p>
        </div>
    </div>
</div>
