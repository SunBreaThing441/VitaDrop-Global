<div {{ $attributes->merge(['class' => 'flex items-center gap-3']) }}>
    <div class="relative flex items-center justify-center w-11 h-11 rounded-2xl bg-gradient-to-br from-unesco-500 via-unesco-600 to-vitality-500 shadow-md shadow-unesco-500/25 p-2 transition-transform duration-300 hover:scale-105">
        <!-- Stylized Humanitarian Blood Drop & Globe SVG -->
        <svg class="w-full h-full text-white" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 3C16 3 7 13.5 7 19.5C7 24.4706 11.0294 28.5 16 28.5C20.9706 28.5 25 24.4706 25 19.5C25 13.5 16 3 16 3Z" fill="currentColor" fill-opacity="0.95"/>
            <path d="M16 8C16 8 10.5 15.5 10.5 19.5C10.5 22.5 12.96 25 16 25" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"/>
            <circle cx="16" cy="19.5" r="3" fill="#E63946" stroke="#FFFFFF" stroke-width="1.2"/>
            <path d="M13 19.5H19M16 16.5V22.5" stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round"/>
        </svg>
        <span class="absolute -top-1 -right-1 flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-vitality-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-vitality-500"></span>
        </span>
    </div>
    <div class="flex flex-col">
        <div class="flex items-center gap-1.5">
            <span class="font-extrabold text-xl tracking-tight text-slate-900 leading-none">VitaDrop</span>
            <span class="font-bold text-xl tracking-tight text-unesco-600 leading-none">Global</span>
        </div>
        <span class="text-[10px] uppercase tracking-wider font-semibold text-slate-500 flex items-center gap-1 mt-0.5">
            <span class="w-1.5 h-1.5 rounded-full bg-unesco-500 inline-block"></span>
            UNESCO Humanitarian Initiative
        </span>
    </div>
</div>
