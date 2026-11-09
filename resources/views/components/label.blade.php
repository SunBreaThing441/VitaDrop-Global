@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-xs uppercase tracking-wider text-slate-600 mb-1']) }}>
    {{ $value ?? $slot }}
</label>
