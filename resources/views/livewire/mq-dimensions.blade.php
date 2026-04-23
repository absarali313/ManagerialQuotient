<x-ui.card>
    <div class="flex justify-between items-center mb-10">
        <h2 class="text-xl font-bold text-gray-900 tracking-tight">MQ Dimensions</h2>
        <button class="text-gray-400 hover:text-gray-600">
            <x-lucide-more-horizontal class="w-5 h-5" />
        </button>
    </div>

    <div class="space-y-8">
        @foreach($dimensions as $dimension)
            <x-ui.progress-bar 
                :label="$dimension['label']" 
                :value="$dimension['value']" 
                :teamAvg="$dimension['teamAvg']"
                :color="$dimension['color']"
            />
        @endforeach
    </div>
</x-ui.card>
