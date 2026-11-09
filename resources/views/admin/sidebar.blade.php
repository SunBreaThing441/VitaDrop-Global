<!-- Mobile Drawer Overlay -->
<div 
    x-show="sidebarOpen" 
    x-cloak 
    @click="sidebarOpen = false" 
    class="fixed inset-0 z-40 bg-cosmic-950/80 backdrop-blur-sm lg:hidden transition-opacity"
></div>

<!-- VitaDrop Global High-Tech Command Sidebar Dock -->
<aside 
    class="fixed inset-y-0 left-0 z-50 w-72 bg-cosmic-950 text-slate-300 border-r border-white/10 flex flex-col justify-between transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:h-screen lg:flex-shrink-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
>
    <div>
        <!-- Brand Header Bar -->
        <div class="p-6 border-b border-white/10 flex items-center justify-between">
            <a href="{{ url('/') }}" class="block focus:outline-none">
                <x-vitadrop-logo class="text-white scale-90 origin-left" />
            </a>

            <!-- Mobile Close Button -->
            <button 
                @click="sidebarOpen = false" 
                class="lg:hidden p-1.5 rounded-xl text-slate-400 hover:text-white hover:bg-white/10"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Node & Operator Badge -->
        <div class="px-6 py-4 border-b border-white/5 bg-white/[0.02]">
            <div class="flex items-center justify-between text-[11px] font-mono text-slate-400">
                <span class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>NODE #8000_AUTH</span>
                </span>
                <span class="text-unesco-400 font-bold">LVL-4 ADMIN</span>
            </div>
        </div>

        <!-- Primary Navigation Links -->
        <nav class="p-4 space-y-1.5">
            <div class="px-3 py-2 text-[10px] font-bold uppercase tracking-wider text-slate-500 font-mono">
                Logistics & Telemetry Operations
            </div>

            <!-- Command Dashboard -->
            <a 
                href="{{ url('home') }}" 
                class="flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-bold transition-all {{ request()->is('home') ? 'bg-gradient-to-r from-unesco-600 to-unesco-500 text-white shadow-lg shadow-unesco-600/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}"
            >
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Command Dashboard</span>
                </div>
                @if(request()->is('home'))
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                @endif
            </a>

            <!-- Donor Intake Terminal -->
            <a 
                href="{{ url('add_donor_view') }}" 
                class="flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-bold transition-all {{ request()->is('add_donor_view') ? 'bg-gradient-to-r from-vitality-600 to-vitality-500 text-white shadow-lg shadow-vitality-600/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}"
            >
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    <span>Donor Intake Terminal</span>
                </div>
                @if(request()->is('add_donor_view'))
                    <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                @endif
            </a>

            <!-- Public Registry Link -->
            <a 
                href="{{ url('/') }}" 
                target="_blank" 
                class="flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-bold text-slate-400 hover:bg-white/5 hover:text-white transition-all group"
            >
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-unesco-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    <span>Live Public Portal</span>
                </div>
                <span class="px-2 py-0.5 rounded-full bg-emerald-500/15 text-emerald-400 font-mono text-[9px] font-bold border border-emerald-500/30">
                    LIVE
                </span>
            </a>
        </nav>
    </div>

    <!-- Active Health Administrator Footer -->
    <div class="p-4 border-t border-white/10 bg-black/30">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-unesco-600 via-unesco-500 to-vitality-500 flex items-center justify-center text-white font-extrabold text-sm shadow-md">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="truncate max-w-[120px]">
                    <div class="text-xs font-bold text-white truncate">{{ Auth::user()->name ?? 'Health Officer' }}</div>
                    <div class="text-[10px] text-slate-400 font-mono truncate">{{ Auth::user()->email ?? 'admin@vitadrop.org' }}</div>
                </div>
            </div>

            <!-- Sign Out -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button 
                    type="submit" 
                    title="Sign Out of Terminal" 
                    class="p-2 rounded-xl text-slate-400 hover:text-vitality-400 hover:bg-white/10 transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>
