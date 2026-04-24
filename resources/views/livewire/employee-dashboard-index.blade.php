<div class="space-y-6 max-w-[1400px] mx-auto">
    <!-- Stats Row -->
    <livewire:stats-cards />

    <div class="grid grid-cols-12 gap-6">
        <!-- Main Column (Left) -->
        <div class="col-span-12 lg:col-span-8 space-y-6 flex flex-col">
            <!-- Performance Timeline Chart -->
            <livewire:performance-timeline />

            <!-- MQ Dimensions -->
            <livewire:mq-dimensions />
        </div>

        <!-- Sidebar Column (Right) -->
        <div class="col-span-12 lg:col-span-4 space-y-6">
            <!-- AI Insights -->
            <livewire:ai-insights />

            <!-- Key Traits -->
            <div class="space-y-6">
                <livewire:key-traits />
                <livewire:team-leaderboard />
            </div>
        </div>
    </div>
</div>
