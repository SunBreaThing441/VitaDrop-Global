@if(session()->has('message') || session()->has('status'))
    @php
        $toastMsg = session()->get('message') ?? session()->get('status');
    @endphp
    <div 
        x-data="{ 
            show: true, 
            progress: 100, 
            timer: null,
            duration: 5000,
            init() {
                const interval = 50;
                const step = 100 / (this.duration / interval);
                this.timer = setInterval(() => {
                    this.progress -= step;
                    if (this.progress <= 0) {
                        this.dismiss();
                    }
                }, interval);
            },
            dismiss() {
                this.show = false;
                if (this.timer) clearInterval(this.timer);
            },
            pause() {
                if (this.timer) clearInterval(this.timer);
            },
            resume() {
                const interval = 50;
                const step = 100 / (this.duration / interval);
                this.timer = setInterval(() => {
                    this.progress -= step;
                    if (this.progress <= 0) {
                        this.dismiss();
                    }
                }, interval);
            }
        }"
        x-show="show"
        x-cloak
        x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:translate-x-4 scale-95"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @mouseenter="pause()"
        @mouseleave="resume()"
        class="fixed bottom-6 right-6 z-50 max-w-sm sm:max-w-md w-full glass-panel-dark text-white rounded-2xl p-4 shadow-2xl border border-white/20 overflow-hidden"
    >
        <div class="flex items-start gap-3.5">
            <!-- Telemetry Status Icon -->
            <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0 border border-emerald-500/30 mt-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <div class="flex-grow pr-2">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-emerald-400">TELEMETRY_CONFIRMED</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                </div>
                <p class="text-sm font-semibold text-slate-100 mt-1 leading-snug">{{ $toastMsg }}</p>
                <span class="text-[10px] text-slate-400 font-mono mt-1 block">Auto-dismissing in 5s &bull; Hover to pause</span>
            </div>

            <!-- Manual Close Button -->
            <button 
                @click="dismiss()" 
                type="button" 
                class="p-1 rounded-lg text-slate-400 hover:text-white hover:bg-white/10 transition-colors"
                title="Dismiss"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Animated Countdown Progress Bar -->
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-white/10">
            <div 
                class="h-full bg-gradient-to-r from-emerald-400 via-unesco-400 to-vitality-500 transition-all duration-75"
                :style="'width: ' + progress + '%'"
            ></div>
        </div>
    </div>
@endif
