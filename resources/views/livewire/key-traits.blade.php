<x-ui.card>
    <h2 class="text-xl font-bold text-gray-900 tracking-tight mb-8">Key Traits</h2>

    <div class="grid grid-cols-2 gap-8">
        <div>
            <p class="text-[11px] font-bold text-gray-400 tracking-widest uppercase mb-4">Top Strengths</p>
            <ul class="space-y-4">
                @foreach($strengths as $strength)
                    <li class="flex items-center gap-3">
                        <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                             <x-lucide-check class="w-3 h-3 stroke-[3]" />
                        </div>
                        <span class="text-sm font-semibold text-gray-700">{{ $strength }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <p class="text-[11px] font-bold text-gray-400 tracking-widest uppercase mb-4">Focus Areas</p>
            <ul class="space-y-4">
                @foreach($focusAreas as $area)
                    <li class="flex items-center gap-3">
                        <div class="w-5 h-5 bg-orange-100 rounded-full flex items-center justify-center text-orange-600">
                             <x-lucide-alert-circle class="w-3 h-3 stroke-[3]" />
                        </div>
                        <span class="text-sm font-semibold text-gray-700">{{ $area }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-ui.card>
