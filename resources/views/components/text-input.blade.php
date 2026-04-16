@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white/5 border-white/10 dark:text-zinc-100 placeholder-zinc-600 focus:border-indigo-500/50 focus:ring-4 focus:ring-indigo-500/10 rounded-xl shadow-[inset_0_1px_2px_rgba(0,0,0,0.2)] transition-all']) }}>
