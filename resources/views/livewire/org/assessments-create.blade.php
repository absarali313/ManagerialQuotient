<div class="max-w-4xl mx-auto space-y-8 pb-12">
    {{-- Breadcrumbs & Header --}}
    <div class="flex flex-col gap-2">
        <nav class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-gray-400">
            <a href="{{ route('org-assessments') }}" wire:navigate class="hover:text-blue-600 transition-colors">Assessments</a>
            <x-lucide-chevron-right class="w-3 h-3" />
            <span class="text-gray-900">Create New Deployment</span>
        </nav>
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-black font-display text-gray-900 tracking-tight leading-tight">Assessment Deployment</h1>
                <p class="text-gray-500 text-sm mt-1">Configure and assign evaluations to your talent pool</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('org-assessments') }}" wire:navigate class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-700 transition-colors">Cancel</a>
                <button wire:click="save" class="px-8 py-2.5 bg-[#5D45FD] text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-100 hover:bg-[#4C36E0] transition-all hover:-translate-y-0.5 flex items-center gap-2">
                    <x-lucide-rocket class="w-4 h-4" />
                    <span>Deploy Assessments</span>
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left Column: Configuration --}}
        <div class="lg:col-span-2 space-y-8">
            {{-- Assessment Identity Card --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 space-y-6">
                <div class="flex items-center gap-3 border-b border-gray-50 pb-6">
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                        <x-lucide-settings-2 class="w-5 h-5" />
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 tracking-tight">Core Configuration</h2>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Define the evaluation parameters</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-widest text-gray-400">Job Role Preference</label>
                        <select wire:model="job_role_id" class="w-full bg-gray-50 border-none rounded-xl text-sm font-bold text-gray-700 focus:ring-2 focus:ring-blue-500/20 py-3">
                            <option value="">Select a Role</option>
                            @foreach($jobRoles as $role)
                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                            @endforeach
                        </select>
                        @error('job_role_id') <p class="text-[10px] text-rose-500 font-bold uppercase mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-widest text-gray-400">Evaluation Cycle</label>
                        <select wire:model="evaluation_cycle_id" class="w-full bg-gray-50 border-none rounded-xl text-sm font-bold text-gray-700 focus:ring-2 focus:ring-blue-500/20 py-3">
                            <option value="">Select a Cycle</option>
                            @foreach($cycles as $cycle)
                                <option value="{{ $cycle->id }}">{{ $cycle->name }}</option>
                            @endforeach
                        </select>
                        @error('evaluation_cycle_id') <p class="text-[10px] text-rose-500 font-bold uppercase mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-widest text-gray-400">Skill Level (1-5)</label>
                        <div class="flex items-center gap-3">
                            <input type="range" wire:model="level" min="1" max="5" class="w-full h-2 bg-gray-100 rounded-lg appearance-none cursor-pointer accent-[#5D45FD]">
                            <span class="w-8 text-center font-black text-blue-600 text-lg">{{ $level }}</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-widest text-gray-400">Duration (Minutes)</label>
                        <div class="relative">
                            <x-lucide-clock class="w-4 h-4 text-gray-300 absolute left-3 top-1/2 -translate-y-1/2" />
                            <input type="number" wire:model="duration_minutes" class="w-full pl-10 bg-gray-50 border-none rounded-xl text-sm font-bold text-gray-700 focus:ring-2 focus:ring-blue-500/20 py-3">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Assignees Card --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 space-y-6">
                <div class="flex items-center justify-between border-b border-gray-50 pb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                            <x-lucide-users class="w-5 h-5" />
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900 tracking-tight">Select Employees</h2>
                            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Assign to specific team members</p>
                        </div>
                    </div>
                    <div class="text-[10px] font-black text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full uppercase tracking-tighter">
                        {{ count($assigned_user_ids) }} Selected
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-96 overflow-y-auto pr-2 scrollbar-hide">
                    @foreach($employees as $employee)
                        <label class="relative flex items-center gap-4 p-4 rounded-2xl border border-gray-50 hover:bg-gray-50 transition-all cursor-pointer group">
                            <input type="checkbox" wire:model="assigned_user_ids" value="{{ $employee->id }}" class="w-5 h-5 rounded-lg border-gray-200 text-[#5D45FD] focus:ring-blue-500/20">
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors">{{ $employee->name }}</p>
                                <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider">{{ $employee->department?->name ?? 'Unassigned' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] font-black {{ $employee->current_mq_score >= 80 ? 'text-emerald-500' : 'text-amber-500' }}">MQ: {{ $employee->current_mq_score ?? '--' }}</p>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('assigned_user_ids') <p class="text-[10px] text-rose-500 font-bold uppercase mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Right Column: Scheduling & Preview --}}
        <div class="space-y-8">
            <div class="bg-gray-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden group">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,rgba(93,69,253,0.2),transparent)]"></div>
                
                <div class="relative z-10 space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                            <x-lucide-calendar class="w-5 h-5 text-indigo-300" />
                        </div>
                        <h3 class="text-lg font-bold tracking-tight">Scheduling</h3>
                    </div>

                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Submission Deadline</label>
                            <input type="date" wire:model="due_at" class="w-full bg-white/5 border-white/10 rounded-xl text-sm font-bold text-white focus:ring-2 focus:ring-indigo-500/20 py-3">
                        </div>

                        <div class="p-5 rounded-2xl bg-white/5 border border-white/10 space-y-3">
                            <div class="flex items-center gap-2">
                                <x-lucide-info class="w-4 h-4 text-indigo-400" />
                                <span class="text-xs font-bold text-gray-300">Deployment Info</span>
                            </div>
                            <p class="text-[11px] text-gray-400 leading-relaxed">Assessments will be deployed instantly upon confirmation. Employees will receive a dashboard notification and email alert.</p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-white/10">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-bold text-gray-400">Status</span>
                            <span class="text-xs font-black text-emerald-400 uppercase tracking-widest">Live Ready</span>
                        </div>
                        <button wire:click="save" wire:loading.attr="disabled" class="w-full py-4 bg-white text-gray-900 rounded-2xl font-black text-sm hover:bg-gray-100 transition-all flex items-center justify-center gap-2">
                            <span wire:loading.remove>Confirm Deployment</span>
                            <span wire:loading><x-lucide-loader-2 class="w-4 h-4 animate-spin" /> Processing...</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Pro Tip Card --}}
            <div class="bg-blue-50/50 border border-blue-100 rounded-3xl p-6 space-y-3">
                <div class="flex items-center gap-2 text-blue-600">
                    <x-lucide-sparkles class="w-4 h-4" />
                    <span class="text-xs font-black uppercase tracking-widest">AI Intelligence</span>
                </div>
                <p class="text-xs font-medium text-blue-800 leading-relaxed">This deployment will automatically trigger our <span class="font-bold">Skill-Match Algorithm</span> once completed by the talent pool.</p>
            </div>
        </div>
    </div>
</div>
