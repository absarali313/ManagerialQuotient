<x-ui.card>
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-[15px] font-bold text-gray-900 tracking-tight">Team Leaderboard</h2>
        <a href="{{ route('rankings') }}" class="text-[11px] font-bold text-indigo-600 hover:text-indigo-700 tracking-wide uppercase transition-colors">View All</a>
    </div>

    <div class="space-y-1">
        @foreach($leaders as $leader)
            <div class="flex items-center gap-4 p-3 rounded-2xl transition-all {{ ($leader['is_user'] ?? false) ? 'bg-blue-50/50' : 'hover:bg-gray-50' }}">
                <span class="w-4 text-xs font-bold text-gray-400">{{ $leader['rank'] }}</span>
                <img src="{{ $leader['image'] }}" alt="{{ $leader['name'] }}" class="w-8 h-8 rounded-full object-cover grayscale-[0.2]">
                <span class="flex-1 text-sm font-semibold text-gray-700">{{ $leader['name'] }}</span>
                <span class="text-sm font-bold text-gray-900">{{ $leader['score'] }}</span>
            </div>
        @endforeach
    </div>
</x-ui.card>
