<div class="w-full sm:max-w-md flex flex-col items-center">
    <div class="mb-6 transform transition-all duration-300 hover:scale-105">
        {{ $logo }}
    </div>

    <div class="w-full glass-panel shadow-2xl shadow-unesco-500/10 rounded-3xl p-8 sm:p-10 border border-white/80 relative overflow-hidden">
        <!-- Subtle Top Accent Gradient Line -->
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-unesco-500 via-unesco-400 to-vitality-500"></div>
        {{ $slot }}
    </div>
</div>
