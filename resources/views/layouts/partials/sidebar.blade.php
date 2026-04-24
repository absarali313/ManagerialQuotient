<aside class="fixed inset-y-0 left-0 w-60 bg-white border-r border-gray-100 flex flex-col z-50">
    <div class="px-6 py-5 flex items-center gap-2.5">
        <div class="w-8 h-8 bg-[#5D45FD] rounded-lg flex items-center justify-center">
             <span class="text-white font-bold text-[11px] uppercase">MQ</span>
        </div>
        <span class="text-lg font-bold text-gray-900 tracking-tight font-display">Intel</span>
    </div>

    <nav class="flex-1 px-3 overflow-y-auto">
        {{-- MAIN Group --}}
        @if(auth()->user()->isEmployee())
            <p class="px-3 pt-4 pb-1.5 text-[10px] font-extrabold text-gray-300 uppercase tracking-widest">Main</p>
            <a href="{{ route('dashboard') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("dashboard"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("dashboard"),
                ])>
                <x-lucide-layout-dashboard class="w-4 h-4" />
                <span>Dashboard</span>
            </a>
            <a href="{{ route('employees') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("employees"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("employees"),
                ])>
                <x-lucide-users class="w-4 h-4" />
                <span>Employees</span>
            </a>
            <a href="{{ route('departments') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("departments"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("departments"),
                ])>
                <x-lucide-building class="w-4 h-4" />
                <span>Departments</span>
            </a>

            {{-- INTELLIGENCE Group --}}
            <p class="px-3 pt-5 pb-1.5 text-[10px] font-extrabold text-gray-300 uppercase tracking-widest">Intelligence</p>
            <a href="{{ route('assessments') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("assessments"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("assessments"),
                ])>
                <x-lucide-clipboard-list class="w-4 h-4" />
                <span>Assessments</span>
            </a>
            <a href="{{ route('rankings') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("rankings"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("rankings"),
                ])>
                <x-lucide-trophy class="w-4 h-4" />
                <span>Rankings</span>
            </a>
            <a href="{{ route('ai-insights') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("ai-insights"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("ai-insights"),
                ])>
                <x-lucide-sparkles class="w-4 h-4" />
                <span>AI Insights</span>
            </a>

            {{-- SYSTEM Group --}}
            <p class="px-3 pt-5 pb-1.5 text-[10px] font-extrabold text-gray-300 uppercase tracking-widest">System</p>
            <a href="{{ route('reports') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("reports"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("reports"),
                ])>
                <x-lucide-file-bar-chart class="w-4 h-4" />
                <span>Reports</span>
            </a>
            <a href="{{ route('notifications') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("notifications"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("notifications"),
                ])>
                <x-lucide-bell class="w-4 h-4" />
                <span>Notifications</span>
                <span class="ml-auto bg-red-500 text-white text-[9px] font-bold w-4 h-4 rounded-full flex items-center justify-center">3</span>
            </a>
            <a href="{{ route('settings') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("settings"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("settings"),
                ])>
                <x-lucide-settings class="w-4 h-4" />
                <span>Settings</span>
            </a>
        @endif

        @if(auth()->user()->isOrgAdmin())
            <p class="px-3 pt-4 pb-1.5 text-[10px] font-extrabold text-gray-300 uppercase tracking-widest">Main</p>
            <a href="{{ route('org-dashboard') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("org-dashboard"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("org-dashboard"),
                ])>
                <x-lucide-layout-dashboard class="w-4 h-4" />
                <span>Dashboard</span>
            </a>
            <a href="{{ route('org-employees') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("org-employees"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("org-employees"),
                ])>
                <x-lucide-users class="w-4 h-4" />
                <span>Employees</span>
            </a>
            <a href="{{ route('org-departments') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("org-departments"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("org-departments"),
                ])>
                <x-lucide-building class="w-4 h-4" />
                <span>Departments</span>
            </a>

            {{-- INTELLIGENCE Group --}}
            <p class="px-3 pt-5 pb-1.5 text-[10px] font-extrabold text-gray-300 uppercase tracking-widest">Intelligence</p>
            <a href="{{ route('org-assessments') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("org-assessments"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("org-assessments"),
                ])>
                <x-lucide-clipboard-list class="w-4 h-4" />
                <span>Assessments</span>
            </a>
            <a href="{{ route('org-rankings') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("org-rankings"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("org-rankings"),
                ])>
                <x-lucide-trophy class="w-4 h-4" />
                <span>Rankings</span>
            </a>
            <a href="{{ route('org-ai-insights') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("org-ai-insights"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("org-ai-insights"),
                ])>
                <x-lucide-sparkles class="w-4 h-4" />
                <span>AI Insights</span>
            </a>

            {{-- SYSTEM Group --}}
            <p class="px-3 pt-5 pb-1.5 text-[10px] font-extrabold text-gray-300 uppercase tracking-widest">System</p>
            <a href="{{ route('org-reports') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("org-reports"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("org-reports"),
                ])>
                <x-lucide-file-bar-chart class="w-4 h-4" />
                <span>Reports</span>
            </a>
            <a href="{{ route('org-notifications') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("org-notifications"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("org-notifications"),
                ])>
                <x-lucide-bell class="w-4 h-4" />
                <span>Notifications</span>
                <span class="ml-auto bg-red-500 text-white text-[9px] font-bold w-4 h-4 rounded-full flex items-center justify-center">3</span>
            </a>
            <a href="{{ route('org-settings') }}" @class([
                    "flex",
                    "items-center",
                    "gap-3",
                    "px-3",
                    "py-2",
                    "rounded-xl",
                    "font-semibold",
                    "text-sm",
                    "tracking-tight",
                    "transition-all",
                    "mb-0.5",
                    "bg-[#5D45FD] text-white shadow-md shadow-indigo-100" => request()->routeIs("org-settings"),
                    "text-gray-500 hover:bg-gray-50 hover:text-gray-700" => ! request()->routeIs("org-settings"),
                ])>
                <x-lucide-settings class="w-4 h-4" />
                <span>Settings</span>
            </a>
        @endif
    </nav>

    <div class="p-3 border-t border-gray-50" x-data="{ open: false }">
        <div class="relative">
            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false" 
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute bottom-full left-0 w-full mb-2 bg-white border border-gray-100 rounded-xl shadow-lg shadow-black/5 overflow-hidden z-50 py-1"
                 style="display: none;">
                 
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-red-600 transition-colors">
                        <x-lucide-log-out class="w-4 h-4" />
                        Log Out
                    </button>
                </form>
            </div>

            <!-- Profile Button -->
            <div @click="open = !open" class="flex items-center gap-3 p-2 bg-gray-50/50 border border-gray-100 rounded-2xl hover:bg-gray-100 transition-colors cursor-pointer group">
                <div class="relative">
                    <img src="{{ auth()->user()->display_avatar }}" alt="{{ auth()->user()->display_name }}" class="w-9 h-9 rounded-full border border-white shadow-sm object-cover">
                    @if(auth()->user()->isEmployee())
                        <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-white rounded-full"></div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[13px] font-bold text-gray-900 truncate tracking-tight">{{ auth()->user()->display_name }}</p>
                    <p class="text-[10px] text-gray-400 font-medium truncate">{{ auth()->user()->display_subtitle }}</p>
                </div>
                <x-lucide-chevron-up class="w-3.5 h-3.5 text-gray-300 group-hover:text-gray-500 transition-transform duration-200" x-bind:class="{ 'rotate-180': open }" />
            </div>
        </div>
    </div>
</aside>
