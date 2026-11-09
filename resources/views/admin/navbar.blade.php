<!-- Top Telemetry Header -->
<header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200/80 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-30">
    <div class="flex items-center gap-3 sm:gap-4">
        <!-- Mobile Sidebar Toggle -->
        <button 
            @click="sidebarOpen = !sidebarOpen" 
            class="lg:hidden p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Breadcrumbs -->
        <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
            <span class="text-slate-400 hidden sm:inline">UNESCO Operations</span>
            <span class="text-slate-300 hidden sm:inline">/</span>
            <span class="text-unesco-600 font-bold">Health Terminal</span>
            <span class="text-slate-300">/</span>
            <span class="text-slate-800 font-bold">{{ request()->is('add_donor_view') ? 'Donor Intake' : 'Grid Dashboard' }}</span>
        </div>
    </div>

    <!-- Right Telemetry Strip -->
    <div class="flex items-center gap-3 sm:gap-4">
        <!-- Live Database Connectivity Pill -->
        <div class="hidden sm:inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 text-[11px] font-mono text-slate-700 border border-slate-200">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span>MARIADB_3306: SYNCED</span>
        </div>

        <!-- Jetstream Profile Link -->
        <a 
            href="{{ route('profile.show') }}" 
            class="flex items-center gap-2 p-1.5 sm:px-3 sm:py-1.5 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-100 transition-colors border border-transparent hover:border-slate-200"
            title="Coordinator Settings"
        >
            <div class="w-7 h-7 rounded-lg bg-unesco-100 text-unesco-600 flex items-center justify-center font-bold text-xs">
                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
            </div>
            <span class="hidden md:inline">{{ Auth::user()->name ?? 'Coordinator' }}</span>
        </a>
    </div>
</header>
