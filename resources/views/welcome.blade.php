<x-frontend-layout>
    <!-- Temporary Alert Testing Section -->
    <div class="fixed bottom-24 left-8 z-[100] flex flex-col gap-2">
        <button @click="window.dispatchEvent(new CustomEvent('notify', {detail: {message: 'Success Notification!', type: 'success'}}))" class="bg-emerald-500 text-white px-4 py-2 rounded-xl text-xs font-bold shadow-lg hover:bg-emerald-600 transition-colors">Test Success</button>
        <button @click="window.dispatchEvent(new CustomEvent('notify', {detail: {message: 'Error Notification!', type: 'error'}}))" class="bg-rose-500 text-white px-4 py-2 rounded-xl text-xs font-bold shadow-lg hover:bg-rose-600 transition-colors">Test Error</button>
        <button @click="window.dispatchEvent(new CustomEvent('notify', {detail: {message: 'Info Notification!', type: 'info'}}))" class="bg-blue-500 text-white px-4 py-2 rounded-xl text-xs font-bold shadow-lg hover:bg-blue-600 transition-colors">Test Info</button>
    </div>

    <x-home.hero />
    <x-home.comparison />
    <x-home.features />
    <x-home.ai-insights />
    <x-home.dashboard-preview />
    <x-home.how-it-works />
    <x-home.built-for />
    <x-home.reports />
    <x-home.cta />
</x-frontend-layout>
