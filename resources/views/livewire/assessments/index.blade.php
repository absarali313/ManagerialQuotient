<div class="space-y-8">

    @include('livewire.assessments.partials.header')

    @include('livewire.assessments.partials.stats')

    @include('livewire.assessments.partials.table', [
        'assessments' => $assessments
    ])

</div>
