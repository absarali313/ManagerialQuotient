@if($ranked->hasPages())
    <div class="px-6 py-4 border-t border-gray-50 flex items-center justify-between">
        <p class="text-sm font-semibold text-gray-500">
            Showing <strong>{{ $ranked->firstItem() }}–{{ $ranked->lastItem() }}</strong> of <strong>{{ $ranked->total() }}</strong> employees
        </p>

        <div class="flex items-center gap-1">
            @if($ranked->onFirstPage())
                <span class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-300 cursor-not-allowed">
                    <x-lucide-chevron-left class="w-4 h-4" />
                </span>
            @else
                <button wire:click="previousPage" class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:border-[#5D45FD] hover:text-[#5D45FD] transition-all">
                    <x-lucide-chevron-left class="w-4 h-4" />
                </button>
            @endif

            @foreach($ranked->getUrlRange(max(1, $ranked->currentPage() - 2), min($ranked->lastPage(), $ranked->currentPage() + 2)) as $page => $url)
                @if($page == $ranked->currentPage())
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#5D45FD] text-white text-sm font-bold shadow-sm shadow-indigo-200">{{ $page }}</button>
                @else
                    <button wire:click="gotoPage({{ $page }})" class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 text-sm font-semibold hover:border-[#5D45FD] hover:text-[#5D45FD] transition-all">{{ $page }}</button>
                @endif
            @endforeach

            @if($ranked->lastPage() > $ranked->currentPage() + 2)
                <span class="w-8 h-8 flex items-center justify-center text-gray-400 text-sm">…</span>
                <button wire:click="gotoPage({{ $ranked->lastPage() }})" class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 text-sm font-semibold hover:border-[#5D45FD] hover:text-[#5D45FD] transition-all">{{ $ranked->lastPage() }}</button>
            @endif

            @if($ranked->hasMorePages())
                <button wire:click="nextPage" class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:border-[#5D45FD] hover:text-[#5D45FD] transition-all">
                    <x-lucide-chevron-right class="w-4 h-4" />
                </button>
            @else
                <span class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-300 cursor-not-allowed">
                    <x-lucide-chevron-right class="w-4 h-4" />
                </span>
            @endif
        </div>
    </div>
@else
    <div class="px-6 py-4 border-t border-gray-50">
        <p class="text-sm font-semibold text-gray-500">
            Showing <strong>{{ $ranked->count() }}</strong> of <strong>{{ $ranked->total() }}</strong> employees
        </p>
    </div>
@endif
