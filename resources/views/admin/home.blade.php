<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    @include('admin.css')
</head>
<body class="h-full bg-slate-100 font-sans antialiased text-slate-800 flex overflow-hidden" x-data="{ sidebarOpen: false }">

<!-- Global Auto-Dismissing Flash Toast -->
<x-flash-toast />

@if(!Auth::check())
    <!-- Unauthenticated Guard Screen -->
    <div class="min-h-screen w-full flex items-center justify-center p-6 mesh-backdrop">
        <div class="glass-panel max-w-md w-full p-8 rounded-3xl text-center border border-white/80 shadow-2xl">
            <div class="w-16 h-16 rounded-2xl bg-vitality-50 text-vitality-500 mx-auto flex items-center justify-center mb-4 border border-vitality-200">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-extrabold text-slate-900">Authentication Required</h2>
            <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                You must authenticate with valid coordinator credentials to access the UNESCO Humanitarian Operations Terminal.
            </p>
            <div class="mt-6 flex flex-col gap-2">
                <a href="{{ route('login') }}" class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-unesco-600 to-unesco-500 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-unesco-500/25 transition-all">
                    Sign In to Terminal
                </a>
                <a href="{{ url('/') }}" class="w-full py-2.5 px-4 rounded-xl text-slate-600 hover:text-slate-900 text-xs font-semibold transition-colors">
                    &larr; Back to Public Portal
                </a>
            </div>
        </div>
    </div>
@elseif(Auth::user()->usertype == '0')
    <!-- Non-Admin Role Restricted Screen -->
    <div class="min-h-screen w-full flex items-center justify-center p-6 mesh-backdrop">
        <div class="glass-panel max-w-md w-full p-8 rounded-3xl text-center border border-white/80 shadow-2xl">
            <div class="w-16 h-16 rounded-2xl bg-vitality-50 text-vitality-500 mx-auto flex items-center justify-center mb-4 border border-vitality-200">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-vitality-50 text-vitality-700 text-[10px] font-mono font-bold border border-vitality-200 mb-2">
                SECURITY PROTOCOL 14-B
            </div>
            <h2 class="text-xl font-extrabold text-slate-900">Administrator Privileges Required</h2>
            <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                Your account is registered as a <strong class="text-slate-800">Volunteer Donor (usertype: 0)</strong>. Direct command and intake operations are restricted to verified clinical coordinators.
            </p>
            <div class="mt-6 flex flex-col gap-2.5">
                <a href="{{ url('home') }}" class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-unesco-600 to-unesco-500 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-unesco-500/25 transition-all">
                    Return to Volunteer Hub
                </a>
                <a href="{{ url('/#donors') }}" class="w-full py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors">
                    Browse Emergency Registry
                </a>

                <!-- Secure Logout Form -->
                <form method="POST" action="{{ route('logout') }}" class="pt-2">
                    @csrf
                    <button type="submit" class="text-xs text-vitality-600 hover:underline font-bold">
                        Switch Identity / Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
@else
    <!-- Authorized Administrator Console -->
    <!-- Responsive Sidebar Dock -->
    @include('admin.sidebar')

    <!-- Main Viewport Area -->
    <div class="flex-1 flex flex-col min-w-0 h-screen overflow-y-auto mesh-backdrop">
        <!-- Top Telemetry Header -->
        @include('admin.navbar')

        <!-- Main Dashboard Canvas -->
        <main class="p-6 sm:p-8 max-w-7xl w-full mx-auto space-y-8">
            
            <!-- Welcome Command Banner -->
            <div class="glass-panel rounded-3xl p-8 border border-white/80 shadow-xl shadow-unesco-500/5 relative overflow-hidden">
                <div class="relative z-10 max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-unesco-50 border border-unesco-200 text-unesco-700 text-xs font-bold uppercase tracking-wider mb-4">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                        UNESCO Telemetry Node ASIA-SOUTH-1 Active
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        VitaDrop Global <span class="text-transparent bg-clip-text bg-gradient-to-r from-unesco-600 via-unesco-500 to-vitality-500">Command Center</span>
                    </h1>
                    <p class="mt-3 text-sm sm:text-base text-slate-600 leading-relaxed">
                        Authorized health coordinator console. Monitor blood registry integrity, register verified donors, and oversee immediate peer-to-peer life support mobilization.
                    </p>

                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        <a href="{{ url('add_donor_view') }}" class="px-5 py-3 rounded-2xl bg-gradient-to-r from-vitality-600 to-vitality-500 hover:from-vitality-500 hover:to-vitality-600 text-white text-xs font-bold uppercase tracking-wider shadow-lg shadow-vitality-500/25 active:scale-95 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Intake Emergency Donor
                        </a>

                        <a href="{{ url('/') }}" target="_blank" class="px-5 py-3 rounded-2xl bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold uppercase tracking-wider border border-slate-200 shadow-sm transition-all flex items-center gap-2">
                            <svg class="w-4 h-4 text-unesco-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Inspect Public Grid
                        </a>
                    </div>
                </div>

                <!-- Ambient Glow Decoration -->
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-gradient-to-br from-unesco-400/20 to-vitality-400/20 rounded-full blur-3xl pointer-events-none"></div>
            </div>

            <!-- Health Telemetry Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Metric 1 -->
                <div class="glass-card rounded-2xl p-6">
                    <div class="flex items-center justify-between text-xs font-bold uppercase tracking-wider text-slate-400">
                        <span>Database Node</span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    </div>
                    <div class="mt-4 text-3xl font-extrabold text-slate-900 font-mono">ONLINE</div>
                    <div class="mt-2 text-xs text-slate-500 flex items-center gap-1 font-medium">
                        <span class="text-emerald-600 font-bold">&bull; MariaDB 10.4</span>
                        <span>Synchronized</span>
                    </div>
                </div>

                <!-- Metric 2 -->
                <div class="glass-card rounded-2xl p-6">
                    <div class="flex items-center justify-between text-xs font-bold uppercase tracking-wider text-slate-400">
                        <span>Dispatch SLA</span>
                        <span class="w-2.5 h-2.5 rounded-full bg-unesco-500"></span>
                    </div>
                    <div class="mt-4 text-3xl font-extrabold text-unesco-600 font-mono">&lt; 3.8m</div>
                    <div class="mt-2 text-xs text-slate-500 font-medium">
                        Average clinical response
                    </div>
                </div>

                <!-- Metric 3 -->
                <div class="glass-card rounded-2xl p-6">
                    <div class="flex items-center justify-between text-xs font-bold uppercase tracking-wider text-slate-400">
                        <span>Active Protocol</span>
                        <span class="w-2.5 h-2.5 rounded-full bg-vitality-500"></span>
                    </div>
                    <div class="mt-4 text-3xl font-extrabold text-vitality-600 font-mono">14-B</div>
                    <div class="mt-2 text-xs text-slate-500 font-medium">
                        UNESCO Humanitarian Standard
                    </div>
                </div>

                <!-- Metric 4 -->
                <div class="glass-card rounded-2xl p-6">
                    <div class="flex items-center justify-between text-xs font-bold uppercase tracking-wider text-slate-400">
                        <span>Auth Guard</span>
                        <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                    </div>
                    <div class="mt-4 text-3xl font-extrabold text-slate-900 font-mono">SANCTUM</div>
                    <div class="mt-2 text-xs text-slate-500 font-medium">
                        Encrypted stateful session
                    </div>
                </div>
            </div>

            <!-- Operational Control Panels -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Panel 1: Fast Intake Directive -->
                <div class="glass-panel rounded-3xl p-7 border border-white/80 shadow-md flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-2xl bg-vitality-50 text-vitality-600 flex items-center justify-center mb-4 border border-vitality-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Emergency Volunteer Intake</h3>
                        <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                            Upload verified blood donors into the central MariaDB registry. Each entry requires a legal name, reachable phone number, clinical blood group, regional place, and photo.
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-mono text-slate-400">ENDPOINT: /upload_donor</span>
                        <a href="{{ url('add_donor_view') }}" class="px-4 py-2 rounded-xl bg-vitality-50 hover:bg-vitality-100 text-vitality-700 text-xs font-bold transition-colors">
                            Launch Terminal &rarr;
                        </a>
                    </div>
                </div>

                <!-- Panel 2: Live Verification Directive -->
                <div class="glass-panel rounded-3xl p-7 border border-white/80 shadow-md flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-2xl bg-unesco-50 text-unesco-600 flex items-center justify-center mb-4 border border-unesco-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Public Grid Synchronization</h3>
                        <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                            Verify how donors are reflected on the public grid. Donors become immediately dialable via phone and WhatsApp directly on the user-facing portal without delay.
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs font-mono text-slate-400">ENDPOINT: /#donors</span>
                        <a href="{{ url('/') }}" target="_blank" class="px-4 py-2 rounded-xl bg-unesco-50 hover:bg-unesco-100 text-unesco-700 text-xs font-bold transition-colors">
                            View Live Grid &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('admin.script')
@endif

</body>
</html>
