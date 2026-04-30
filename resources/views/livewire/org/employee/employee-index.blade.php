<div class="space-y-6">
    @include('livewire.org.employee.partials.header')

    @include('livewire.org.employee.partials.stats')

    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden pb-2">

        @include('livewire.org.employee.partials.toolbar')

        <table class="w-full text-left">
            @include('livewire.org.employee.partials.table-head')
            <tbody class="divide-y divide-gray-50">
                @forelse ($employees as $index => $employee)
                    @include('livewire.org.employee.partials.row', [
                        'employee'  => $employee,
                        'rowNumber' => ($employees->currentPage() - 1) * $employees->perPage() + $index + 1,
                    ])
                @empty
                    @include('livewire.org.employee.partials.empty-state')
                @endforelse
            </tbody>
        </table>

        @if ($employees->hasPages())
            <div class="px-6 pt-4">
                {{ $employees->links() }}
            </div>
        @endif

    </div>

</div>
