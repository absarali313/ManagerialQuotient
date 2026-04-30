<div class="space-y-8">

    @include('livewire.assessments.partials.header')

    @include('livewire.assessments.partials.stats', [
        'stats' => $stats
    ])

    @include('livewire.assessments.partials.table', [
        'assessments' => $assessments
    ])

</div>
