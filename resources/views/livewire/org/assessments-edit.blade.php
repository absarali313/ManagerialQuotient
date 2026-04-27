<div class="max-w-4xl mx-auto space-y-8 pb-12">
    {{-- Breadcrumbs & Header --}}
    <div class="flex flex-col gap-2">
        <nav class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-gray-400">
            <a href="{{ route('org-assessments') }}" wire:navigate class="hover:text-blue-600 transition-colors">Assessments</a>
            <x-lucide-chevron-right class="w-3 h-3" />
            <span class="text-gray-900">Edit Deployment</span>
        </nav>
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-black font-display text-gray-900 tracking-tight leading-tight">Edit Assessment</h1>
                <p class="text-gray-500 text-sm mt-1">Adjusting parameters for {{ $assessment->assignedTo?->name }}'s evaluation</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('org-assessments') }}" wire:navigate class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-700 transition-colors">Cancel</a>
                <button wire:click="update" class="px-8 py-2.5 bg-[#5D45FD] text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-100 hover:bg-[#4C36E0] transition-all hover:-translate-y-0.5 flex items-center gap-2">
                    <x-lucide-save class="w-4 h-4" />
                    <span>Update Assessment</span>
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
                        <x-lucide-file-edit class="w-5 h-5" />
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 tracking-tight">Active Configuration</h2>
                        <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Modify the active evaluation parameters</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-widest text-gray-400">Job Role Preference</label>
                        <select wire:model="job_role_id" class="w-full bg-gray-50 border-none rounded-xl text-sm font-bold text-gray-700 focus:ring-2 focus:ring-blue-500/20 py-3">
                            @foreach($jobRoles as $role)
                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                            @endforeach
                        </select>
                        @error('job_role_id') <p class="text-[10px] text-rose-500 font-bold uppercase mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-widest text-gray-400">Evaluation Cycle</label>
                        <select wire:model="evaluation_cycle_id" class="w-full bg-gray-50 border-none rounded-xl text-sm font-bold text-gray-700 focus:ring-2 focus:ring-blue-500/20 py-3">
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

            {{-- Assignee Info Card --}}
            <div class="bg-emerald-50/30 rounded-3xl border border-emerald-100/50 p-8 flex items-center justify-between group">
                <div class="flex items-center gap-6">
                    <div class="relative">
                        <div class="w-16 h-16 rounded-2xl bg-white shadow-sm flex items-center justify-center border border-emerald-100">
                             <x-lucide-user class="w-8 h-8 text-emerald-600" />
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-500 rounded-full border-2 border-white flex items-center justify-center">
                            <x-lucide-check class="w-3 h-3 text-white" />
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 leading-tight">{{ $assessment->assignedTo?->name }}</h3>
                        <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">{{ $assessment->assignedTo?->department?->name ?? 'Organization Talent' }}</p>
                        <div class="flex items-center gap-2 mt-1">
                             <span class="text-xs font-bold text-gray-500">Current MQ Score:</span>
                             <span class="text-xs font-black text-emerald-600">{{ $assessment->assignedTo?->current_mq_score ?? '--' }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Status</p>
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-white border border-emerald-100 rounded-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">{{ $assessment->status }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Status & Metadata --}}
        <div class="space-y-8">
            <div class="bg-gray-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden group">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,rgba(93,69,253,0.2),transparent)]"></div>
                
                <div class="relative z-10 space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                            <x-lucide-activity class="w-5 h-5 text-indigo-300" />
                        </div>
                        <h3 class="text-lg font-bold tracking-tight">Deployment Status</h3>
                    </div>

                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Update Status</label>
                            <select wire:model="status" class="w-full bg-white/5 border-white/10 rounded-xl text-sm font-bold text-white focus:ring-2 focus:ring-indigo-500/20 py-3 appearance-none">
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="expired">Expired</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Submission deadline</label>
                            <input type="date" wire:model="due_at" class="w-full bg-white/5 border-white/10 rounded-xl text-sm font-bold text-white focus:ring-2 focus:ring-indigo-500/20 py-3">
                        </div>
                    </div>

                    <div class="pt-4 border-t border-white/10">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-bold text-gray-400">Last Synced</span>
                            <span class="text-xs font-black text-indigo-400 uppercase tracking-widest">{{ now()->format('H:i') }}</span>
                        </div>
                        <button wire:click="update" wire:loading.attr="disabled" class="w-full py-4 bg-white text-gray-900 rounded-2xl font-black text-sm hover:bg-gray-100 transition-all flex items-center justify-center gap-2">
                            <span wire:loading.remove>Commit Changes</span>
                            <span wire:loading><x-lucide-loader-2 class="w-4 h-4 animate-spin" /> Syncing...</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Audit Trail Card --}}
            <div class="bg-gray-50 border border-gray-100 rounded-3xl p-6 space-y-4">
                <div class="flex items-center gap-2 text-gray-400">
                    <x-lucide-history class="w-4 h-4" />
                    <span class="text-xs font-black uppercase tracking-widest">Digital Audit Trail</span>
                </div>
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <div class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1"></div>
                        <p class="text-[10px] font-bold text-gray-500 leading-tight">Assigned by <span class="text-gray-900">{{ $assessment->assignedBy?->name }}</span> on {{ $assessment->created_at?->format('M d, Y') }}</p>
                    </div>
                    @if($assessment->updated_at > $assessment->created_at)
                    <div class="flex items-start gap-3">
                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1"></div>
                        <p class="text-[10px] font-bold text-gray-500 leading-tight">Last modified on {{ $assessment->updated_at?->format('M d, Y H:i') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
