@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-white/80 border-slate-200/90 text-slate-800 placeholder-slate-400 focus:bg-white focus:border-unesco-500 focus:ring-4 focus:ring-unesco-500/15 rounded-xl text-sm shadow-sm transition-all duration-200']) !!}>
