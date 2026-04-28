<div class="space-y-6 max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-8 h-full bg-[#FAFAFA]">
    {{-- Header --}}
    @include('livewire.org.ranking.partials.header')

    {{-- Podium (top 3) --}}
    @include('livewire.org.ranking.partials.podium')

    {{-- Filters --}}
    @include('livewire.org.ranking.partials.filters')

    {{-- Leaderboard Table --}}
    @include('livewire.org.ranking.partials.table')
</div>
