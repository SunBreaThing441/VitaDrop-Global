<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VitaDrop Global — UNESCO Humanitarian Blood Initiative</title>

    <!-- Google Fonts Inter & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="mesh-backdrop text-slate-800 antialiased min-h-screen flex flex-col selection:bg-vitality-500 selection:text-white" x-data="{ mobileNav: false }">

    <!-- Global Auto-Dismissing Flash Toast -->
    <x-flash-toast />

    <!-- Top Telemetry Protocol Ribbon -->
    <div class="bg-cosmic-950 text-slate-300 border-b border-white/10 text-xs py-2 px-4 sm:px-8 relative z-50">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-emerald-500/15 text-emerald-400 font-mono text-[10px] font-bold border border-emerald-500/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                    TELEMETRY ONLINE
                </span>
                <span class="text-slate-400 text-xs hidden md:inline font-mono">UNESCO Protocol 14-B &bull; ASIA-SOUTH-1 NODE</span>
            </div>
            <div class="flex items-center gap-6 font-medium text-slate-400 text-xs">
                <a href="tel:+919744701363" class="hover:text-white transition-colors flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-vitality-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <span>Dispatch Hotline: <strong class="text-white font-mono">+91 9744701363</strong></span>
                </a>
                <span class="hidden sm:inline text-slate-700">|</span>
                <a href="mailto:dispatch@vitadrop.unesco.org" class="hover:text-white transition-colors hidden sm:flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-unesco-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span>dispatch@vitadrop.unesco.org</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Floating Frosted Navigation Dock -->
    <header class="sticky top-4 z-40 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 mt-2">
        <nav class="glass-panel rounded-2xl sm:rounded-3xl shadow-xl shadow-unesco-500/5 px-5 sm:px-6 py-3.5 flex items-center justify-between border border-white/80">
            <!-- Brand Mark -->
            <a href="/" class="focus:outline-none focus:ring-2 focus:ring-unesco-500 rounded-xl">
                <x-vitadrop-logo />
            </a>

            <!-- Desktop Links -->
            <div class="hidden lg:flex items-center gap-8 text-xs uppercase tracking-wider font-bold text-slate-600">
                <a href="/" class="text-unesco-600 hover:text-unesco-700 transition-colors">Overview</a>
                <a href="#donors" class="hover:text-unesco-600 transition-colors">Live Registry</a>
                <a href="#telemetry" class="hover:text-unesco-600 transition-colors">Medical Telemetry</a>
                <a href="#protocols" class="hover:text-unesco-600 transition-colors">UNESCO Protocols</a>
            </div>

            <!-- Dynamic Session / Auth Buttons -->
            <div class="hidden sm:flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <div class="flex items-center gap-3">
                            @if(Auth::user()->usertype != '0')
                                <!-- Administrator Privilege Navigation -->
                                <a href="{{ url('home') }}" class="px-4 py-2 rounded-xl bg-cosmic-900 text-white hover:bg-cosmic-800 text-xs font-bold uppercase tracking-wider transition-all shadow-md flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-vitality-400 animate-pulse"></span>
                                    Admin Console
                                </a>
                                <a href="{{ url('add_donor_view') }}" class="px-3.5 py-2 rounded-xl bg-vitality-50 hover:bg-vitality-100 text-vitality-700 text-xs font-bold uppercase tracking-wider transition-all border border-vitality-200">
                                    Intake
                                </a>
                            @else
                                <!-- Regular Volunteer Donor Navigation -->
                                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl bg-unesco-50 text-unesco-700 hover:bg-unesco-100 text-xs font-bold uppercase tracking-wider transition-all border border-unesco-200 flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Volunteer Hub
                                </a>
                                <a href="{{ route('profile.show') }}" class="p-2 rounded-xl text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition-colors" title="Profile Settings & 2FA">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </a>
                            @endif

                            <!-- Secure POST Logout Form -->
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="px-3.5 py-2 rounded-xl text-slate-500 hover:text-vitality-600 hover:bg-vitality-50 text-xs font-bold transition-all flex items-center gap-1.5" title="Sign Out of Grid">
                                    <svg class="w-3.5 h-3.5 text-vitality-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>Sign Out</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2.5 rounded-xl text-slate-700 hover:text-unesco-600 text-xs font-bold uppercase tracking-wider transition-colors">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-unesco-600 via-unesco-500 to-vitality-500 hover:from-unesco-500 hover:to-vitality-500 text-white text-xs font-bold uppercase tracking-wider shadow-lg shadow-unesco-500/25 active:scale-95 transition-all">
                            Enroll Donor
                        </a>
                    @endauth
                @endif
            </div>

            <!-- Mobile Hamburger -->
            <div class="flex sm:hidden">
                <button @click="mobileNav = !mobileNav" class="p-2 rounded-xl text-slate-600 hover:bg-slate-100 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileNav" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="mobileNav" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Mobile Drawer -->
        <div x-show="mobileNav" x-cloak class="sm:hidden mt-2 glass-panel rounded-2xl p-4 shadow-2xl border border-white/80 space-y-3 font-semibold text-sm">
            <a href="/" @click="mobileNav = false" class="block py-2 text-unesco-600">Overview</a>
            <a href="#donors" @click="mobileNav = false" class="block py-2 text-slate-700">Live Registry</a>
            <a href="#telemetry" @click="mobileNav = false" class="block py-2 text-slate-700">Medical Telemetry</a>
            <a href="#protocols" @click="mobileNav = false" class="block py-2 text-slate-700">UNESCO Protocols</a>
            <div class="pt-3 border-t border-slate-200/80 flex flex-col gap-2">
                @if (Route::has('login'))
                    @auth
                        @if(Auth::user()->usertype != '0')
                            <a href="{{ url('home') }}" class="text-center py-2.5 rounded-xl bg-cosmic-900 text-white text-xs font-bold uppercase tracking-wider">Admin Console</a>
                            <a href="{{ url('add_donor_view') }}" class="text-center py-2.5 rounded-xl bg-vitality-600 text-white text-xs font-bold uppercase tracking-wider">Donor Intake</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="text-center py-2.5 rounded-xl bg-unesco-600 text-white text-xs font-bold uppercase tracking-wider">Volunteer Dashboard</a>
                            <a href="{{ route('profile.show') }}" class="text-center py-2.5 rounded-xl bg-slate-100 text-slate-800 text-xs font-bold">Profile & 2FA</a>
                        @endif

                        <!-- Secure POST Logout Mobile -->
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-center py-2.5 rounded-xl bg-vitality-50 text-vitality-600 text-xs font-bold uppercase tracking-wider hover:bg-vitality-100 transition-colors">
                                Sign Out
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-center py-2.5 rounded-xl bg-slate-100 text-slate-800 text-xs font-bold">Sign In</a>
                        <a href="{{ route('register') }}" class="text-center py-2.5 rounded-xl bg-unesco-600 text-white text-xs font-bold uppercase tracking-wider">Enroll Donor</a>
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content Flow -->
    <main class="flex-grow">
        
        <!-- Authenticated Role Context Strip -->
        @auth
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                @if(Auth::user()->usertype == '0')
                    <!-- Volunteer Donor Context Strip -->
                    <div class="glass-panel rounded-2xl p-4 sm:px-6 border-l-4 border-l-emerald-500 border border-white/80 shadow-md flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs border border-emerald-200">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-900">Volunteer Donor Verified: {{ Auth::user()->name }}</span>
                                <span class="block text-[11px] text-slate-500">Sector: {{ Auth::user()->address ?? 'Active' }} &bull; Reachable: {{ Auth::user()->phone ?? 'Registered' }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('dashboard') }}" class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50 transition-colors">
                                Donor Hub
                            </a>
                            <a href="{{ route('profile.show') }}" class="px-3.5 py-1.5 rounded-xl bg-unesco-50 border border-unesco-200 text-xs font-bold text-unesco-700 hover:bg-unesco-100 transition-colors">
                                Edit Info
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Administrator Officer Context Strip -->
                    <div class="glass-panel rounded-2xl p-4 sm:px-6 border-l-4 border-l-vitality-500 border border-white/80 shadow-md flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-vitality-50 text-vitality-600 flex items-center justify-center font-bold text-xs border border-vitality-200">
                                AD
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-900">Health Operations Officer: {{ Auth::user()->name }}</span>
                                <span class="block text-[11px] text-slate-500">Administrator Privileges Active &bull; UNESCO Level-1 Clearance</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ url('home') }}" class="px-3.5 py-1.5 rounded-xl bg-cosmic-900 text-white text-xs font-bold transition-colors">
                                Command Center &rarr;
                            </a>
                            <a href="{{ url('add_donor_view') }}" class="px-3.5 py-1.5 rounded-xl bg-vitality-600 text-white text-xs font-bold transition-colors">
                                Add Donor
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        @endauth

        <!-- Hero Section with Medical Telemetry Graphic -->
        <section class="relative pt-10 pb-24 overflow-hidden">
            <!-- Chromatic Glow Orbs -->
            <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[900px] h-[450px] bg-gradient-to-tr from-unesco-400/20 via-vitality-400/15 to-transparent rounded-full blur-3xl pointer-events-none -z-10"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    
                    <!-- Left Hero Headline & Direct CTAs -->
                    <div class="lg:col-span-7 text-center lg:text-left">
                        <!-- Protocol Status Badge -->
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-panel border border-white/80 shadow-md shadow-unesco-500/5 mb-8">
                            <span class="flex h-2.5 w-2.5 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-vitality-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-vitality-500"></span>
                            </span>
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-700">
                                UNESCO Humanitarian Framework &bull; Global Grid
                            </span>
                        </div>

                        <!-- Hero Main Headline -->
                        <h1 class="text-4xl sm:text-6xl font-black text-slate-900 tracking-tight leading-[1.08]">
                            Every Blood Unit <br class="hidden sm:inline">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-unesco-600 via-unesco-500 to-vitality-500">
                                Synchronized In Real Time.
                            </span>
                        </h1>

                        <!-- Subtitle -->
                        <p class="mt-6 text-base sm:text-lg text-slate-600 leading-relaxed max-w-xl mx-auto lg:mx-0">
                            VitaDrop Global connects regional blood reserves and voluntary registered donors directly with emergency surgical and ICU units. Zero intermediaries. Pure peer-to-peer life support.
                        </p>

                        <!-- Call to Action Deck -->
                        <div class="mt-10 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                            <a href="#donors" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-vitality-600 to-vitality-500 hover:from-vitality-500 hover:to-vitality-600 text-white font-bold text-xs uppercase tracking-wider shadow-xl shadow-vitality-500/30 hover:shadow-vitality-500/50 hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Search Verified Donors
                            </a>

                            @guest
                                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl glass-panel hover:bg-white text-slate-800 font-bold text-xs uppercase tracking-wider shadow-md border border-white hover:border-unesco-300 hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4 text-unesco-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Register as Volunteer
                                </a>
                            @else
                                <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl glass-panel hover:bg-white text-slate-800 font-bold text-xs uppercase tracking-wider shadow-md border border-white hover:border-unesco-300 hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4 text-unesco-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Go to My Dashboard
                                </a>
                            @endguest
                        </div>
                    </div>

                    <!-- Right Interactive Medical Telemetry Graphic -->
                    <div class="lg:col-span-5 relative" id="telemetry">
                        <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-white/90 shadow-2xl shadow-unesco-500/10 relative overflow-hidden">
                            <!-- Card Header -->
                            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-3 h-3 rounded-full bg-vitality-500 animate-ping"></div>
                                    <span class="text-xs font-mono font-bold uppercase text-slate-800">TELEMETRY_NODE #KL-8000</span>
                                </div>
                                <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600 font-mono text-[10px] font-bold border border-emerald-200">
                                    ACTIVE 99.98%
                                </span>
                            </div>

                            <!-- Animated ECG / Pulse Line Graphic (SVG) -->
                            <div class="my-6 p-4 rounded-2xl bg-cosmic-950 text-white relative overflow-hidden border border-white/10">
                                <div class="flex items-center justify-between text-[11px] font-mono text-slate-400 mb-2">
                                    <span>PULSE_RHYTHM (72 BPM)</span>
                                    <span class="text-vitality-400 font-bold">OXYGEN: 99%</span>
                                </div>

                                <!-- ECG SVG Waveform -->
                                <svg class="w-full h-16 text-vitality-500 stroke-current" viewBox="0 0 400 60" fill="none" preserveAspectRatio="none">
                                    <path d="M0,30 L60,30 L75,10 L85,50 L95,20 L105,38 L115,30 L200,30 L215,8 L225,52 L235,18 L245,40 L255,30 L340,30 L355,10 L365,50 L375,20 L385,38 L400,30" 
                                          stroke-width="2.5" 
                                          stroke-linecap="round" 
                                          stroke-linejoin="round"
                                          class="animate-pulse"
                                    />
                                </svg>
                                
                                <div class="mt-2 flex items-center justify-between text-[10px] font-mono text-slate-500">
                                    <span>COLD-CHAIN: 4.1&deg;C</span>
                                    <span class="text-emerald-400">DISPATCH READY</span>
                                </div>
                            </div>

                            <!-- Real-time Blood Telemetry Rings Grid -->
                            <div class="grid grid-cols-4 gap-2 text-center">
                                <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                                    <span class="text-xs font-black text-vitality-600">O-</span>
                                    <span class="block text-[10px] text-slate-400 font-mono mt-0.5">CRITICAL</span>
                                </div>
                                <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                                    <span class="text-xs font-black text-slate-800">O+</span>
                                    <span class="block text-[10px] text-emerald-600 font-mono mt-0.5">OPTIMAL</span>
                                </div>
                                <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                                    <span class="text-xs font-black text-slate-800">A+</span>
                                    <span class="block text-[10px] text-emerald-600 font-mono mt-0.5">OPTIMAL</span>
                                </div>
                                <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                                    <span class="text-xs font-black text-vitality-600">AB-</span>
                                    <span class="block text-[10px] text-vitality-500 font-mono mt-0.5">LOW</span>
                                </div>
                            </div>

                            <!-- Live Dispatch Stats Strip -->
                            <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-600 font-semibold">
                                <span>Verified Donors: <strong class="text-slate-900 font-mono">{{ count($donors) }}</strong></span>
                                <span class="text-unesco-600 font-mono">LATENCY: &lt; 3.8 MINS</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4 Quick Telemetry Indicators -->
                <div class="mt-16 grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                    <div class="glass-panel rounded-2xl p-6 border border-white/80 shadow-md">
                        <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Humanitarian Units</div>
                        <div class="mt-2 text-3xl font-black text-unesco-600 font-mono">14,820+</div>
                        <div class="mt-1 text-[11px] text-slate-500">Coordinated with certified hospitals</div>
                    </div>

                    <div class="glass-panel rounded-2xl p-6 border border-white/80 shadow-md">
                        <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Registered Donors</div>
                        <div class="mt-2 text-3xl font-black text-vitality-500 font-mono">{{ count($donors) }} Volunteers</div>
                        <div class="mt-1 text-[11px] text-slate-500">Live verified in database</div>
                    </div>

                    <div class="glass-panel rounded-2xl p-6 border border-white/80 shadow-md">
                        <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Clinical Dispatch SLA</div>
                        <div class="mt-2 text-3xl font-black text-slate-900 font-mono">&lt; 3.8 Mins</div>
                        <div class="mt-1 text-[11px] text-slate-500">Direct peer-to-peer phone routing</div>
                    </div>

                    <div class="glass-panel rounded-2xl p-6 border border-white/80 shadow-md">
                        <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Cost to Patients</div>
                        <div class="mt-2 text-3xl font-black text-emerald-600 font-mono">100% Free</div>
                        <div class="mt-1 text-[11px] text-slate-500">UNESCO Humanitarian Charter</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Donors Registry Section -->
        @include('user.donors')

        <!-- UNESCO Humanitarian Protocols / Pillars Section -->
        <section id="protocols" class="py-24 bg-white/40 border-y border-slate-200/60 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-unesco-50 border border-unesco-200 text-unesco-700 text-xs font-bold uppercase tracking-wider mb-3">
                        Ratified Emergency Framework
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        UNESCO Humanitarian Blood Directives
                    </h2>
                    <p class="mt-3 text-base text-slate-600">
                        Structured response pipelines ensuring surgical and acute emergency requirements are fulfilled within minutes.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Pillar 1 -->
                    <div class="glass-card rounded-3xl p-8 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-unesco-50 text-unesco-600 flex items-center justify-center mb-6 border border-unesco-200 shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">Direct Voice & WhatsApp Routing</h3>
                            <p class="mt-3 text-sm text-slate-600 leading-relaxed">
                                No app installations required for patients. Doctors and family members can tap "Direct Call" or "WhatsApp" on any verified donor to initiate instant mobilization.
                            </p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-bold text-unesco-600">
                            <span>Instant Dial Protocol 14-A</span>
                            &rarr;
                        </div>
                    </div>

                    <!-- Pillar 2 -->
                    <div class="glass-card rounded-3xl p-8 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-vitality-50 text-vitality-600 flex items-center justify-center mb-6 border border-vitality-200 shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">Clinical Verification Integrity</h3>
                            <p class="mt-3 text-sm text-slate-600 leading-relaxed">
                                Authorized health coordinators intake volunteer donors with validated identity photos, geographic hub location, and medical blood group confirmation.
                            </p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-bold text-vitality-600">
                            <span>Clinical Safeguard 14-B</span>
                            &rarr;
                        </div>
                    </div>

                    <!-- Pillar 3 -->
                    <div class="glass-card rounded-3xl p-8 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-6 border border-emerald-200 shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">Zero-Fee Humanitarian Grid</h3>
                            <p class="mt-3 text-sm text-slate-600 leading-relaxed">
                                Universal open access. Operates without paywalls, transaction charges, or monetization to ensure blood access remains an uncompromised fundamental human right.
                            </p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-bold text-emerald-600">
                            <span>Universal Access Charter</span>
                            &rarr;
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Global Humanitarian Footer -->
    <footer class="bg-cosmic-950 text-slate-400 py-16 border-t border-white/10 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10">
                <div class="md:col-span-5">
                    <x-vitadrop-logo class="text-white" />
                    <p class="mt-4 text-xs sm:text-sm text-slate-400 max-w-sm leading-relaxed">
                        An international humanitarian blood telemetry protocol operating under UNESCO humanitarian directives. Coordinating voluntary emergency peer-to-peer blood donation networks.
                    </p>
                    <div class="mt-6 flex items-center gap-2 text-xs text-slate-500 font-mono">
                        <span class="inline-block w-2 h-2 rounded-full bg-emerald-500"></span>
                        Active Dispatch Node: KERALA-CENTRAL-HUB
                    </div>
                </div>

                <div class="md:col-span-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-200">Protocol Navigation</h4>
                    <ul class="mt-4 space-y-2 text-xs sm:text-sm">
                        <li><a href="#donors" class="hover:text-white transition-colors">Emergency Blood Registry</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Volunteer Enrollment</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Coordinator Gateway</a></li>
                        <li><a href="tel:+919744701363" class="hover:text-vitality-400 transition-colors">Emergency Dispatch Line</a></li>
                    </ul>
                </div>

                <div class="md:col-span-4">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-200">Emergency Dispatch Operations</h4>
                    <p class="mt-4 text-xs sm:text-sm text-slate-400 leading-relaxed">
                        For rare blood categories (Bombay Blood Group, AB-, O-), contact the central coordination terminal immediately:
                    </p>
                    <div class="mt-4 p-4 rounded-2xl bg-white/5 border border-white/10 font-mono text-xs sm:text-sm text-slate-200">
                        Dispatch Line: <a href="tel:+919744701363" class="text-vitality-400 font-bold hover:underline">+91 9744701363</a> <br>
                        Email: <a href="mailto:dispatch@vitadrop.unesco.org" class="text-unesco-400 hover:underline">dispatch@vitadrop.unesco.org</a>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} VitaDrop Global &bull; UNESCO Humanitarian Blood Initiative. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="#" class="hover:text-slate-300 transition-colors">Clinical SLA</a>
                    <a href="#" class="hover:text-slate-300 transition-colors">Donor Privacy</a>
                    <a href="#" class="hover:text-slate-300 transition-colors">Emergency Directives</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
