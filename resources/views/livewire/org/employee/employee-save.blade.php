<div class="max-w-4xl mx-auto space-y-6">
    @include('livewire.org.employee.partials.save-header')

    <form wire:submit.prevent="save" class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 space-y-8">
        @include('livewire.org.employee.partials.basic-info')

        <hr class="border-gray-100">

        @include('livewire.org.employee.partials.role-info')

        @include('livewire.org.employee.partials.save-footer')
    </form>
</div>
