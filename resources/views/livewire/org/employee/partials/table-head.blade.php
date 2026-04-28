@php
    $sortableColumns = [
        ['key' => 'name',              'label' => 'Employee', 'sortable' => true],
        ['key' => 'department',        'label' => 'Department', 'sortable' => false],
        ['key' => 'jobRole',           'label' => 'Role', 'sortable' => false],
        ['key' => 'is_active',         'label' => 'Status', 'sortable' => true],
        ['key' => 'current_mq_score',  'label' => 'Score', 'sortable' => true],
        ['key' => 'created_at',        'label' => 'Joined', 'sortable' => true],
    ];
@endphp

<thead>
<tr class="border-b border-gray-100">
    <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest w-12">#</th>

    @foreach ($sortableColumns as $col)
        <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest">
            @if ($col['sortable'])
                <button wire:click="sort('{{ $col['key'] }}')" class="flex items-center gap-1 hover:text-gray-700 transition-colors">
                    {{ $col['label'] }}
                    @include('livewire.org.employee.partials.sort-icon', ['column' => $col['key']])
                </button>
            @else
                {{ $col['label'] }}
            @endif
        </th>
    @endforeach

    <th class="px-6 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest text-center w-20">Actions</th>
</tr>
</thead>
