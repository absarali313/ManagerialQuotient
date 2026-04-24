<div
    x-data="{
        messages: [],
        add(message, type = 'success') {
            const id = Date.now();
            this.messages.push({ id, message, type });
            setTimeout(() => {
                this.remove(id);
            }, 5000);
        },
        remove(id) {
            this.messages = this.messages.filter(m => m.id !== id);
        }
    }"
    @notify.window="add($event.detail.message, $event.detail.type)"
    class="fixed top-4 right-4 z-[9999] flex flex-col space-y-3 pointer-events-none"
>
    <!-- Template for PHP direct usage -->
    @if(session()->has('success'))
        <div x-init="add(@js(session('success')), 'success')"></div>
    @endif
    @if(session()->has('error'))
        <div x-init="add(@js(session('error')), 'error')"></div>
    @endif
    @if(session()->has('status'))
        <div x-init="add(@js(session('status')), 'info')"></div>
    @endif

    <template x-for="msg in messages" :key="msg.id">
        <div
            x-show="true"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="pointer-events-auto bg-white rounded-2xl shadow-2xl border border-gray-100 flex items-center p-4 min-w-[320px] max-w-md gap-4 overflow-hidden relative"
        >
            <!-- Background Indicator -->
            <div :class="{
                'bg-emerald-500': msg.type === 'success',
                'bg-rose-500': msg.type === 'error',
                'bg-amber-500': msg.type === 'warning',
                'bg-blue-500': msg.type === 'info'
            }" class="absolute left-0 top-0 bottom-0 w-1.5 h-full"></div>

            <!-- Icon -->
            <div :class="{
                'bg-emerald-100 text-emerald-600': msg.type === 'success',
                'bg-rose-100 text-rose-600': msg.type === 'error',
                'bg-amber-100 text-amber-600': msg.type === 'warning',
                'bg-blue-100 text-blue-600': msg.type === 'info'
            }" class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0">
                <template x-if="msg.type === 'success'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </template>
                <template x-if="msg.type === 'error'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </template>
                <template x-if="msg.type === 'warning'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </template>
                <template x-if="msg.type === 'info'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </template>
            </div>

            <!-- Content -->
            <div class="flex-grow">
                <p x-text="msg.message" class="text-sm font-semibold text-gray-900 leading-tight"></p>
                <p class="text-[10px] text-gray-500 mt-0.5 uppercase tracking-wider font-bold" x-text="msg.type"></p>
            </div>

            <!-- Close Button -->
            <button @click="remove(msg.id)" class="text-gray-400 hover:text-gray-900 transition-colors p-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </template>
</div>
