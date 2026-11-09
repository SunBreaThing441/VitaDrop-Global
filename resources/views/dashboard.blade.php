<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-xl text-slate-900 leading-tight flex items-center gap-2">
                <span>{{ __('Humanitarian Telemetry Dashboard') }}</span>
                @if(Auth::user()->usertype != '0')
                    <span class="px-2.5 py-0.5 rounded-full bg-vitality-100 text-vitality-700 font-mono text-xs font-bold border border-vitality-200">
                        ADMINISTRATOR NODE
                    </span>
                @else
                    <span class="px-2.5 py-0.5 rounded-full bg-unesco-100 text-unesco-700 font-mono text-xs font-bold border border-unesco-200">
                        VOLUNTEER DONOR
                    </span>
                @endif
            </h2>

            <div class="text-xs font-mono text-slate-500 hidden sm:block">
                PROTOCOL 14-B SYNCHRONIZED
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            @if(Auth::user()->usertype != '0')
                <!-- Administrator Role Dashboard View -->
                <div class="glass-panel rounded-3xl p-8 border border-white/80 shadow-xl relative overflow-hidden">
                    <div class="max-w-2xl relative z-10">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-vitality-50 text-vitality-700 text-xs font-bold uppercase tracking-wider mb-4 border border-vitality-200">
                            <span class="w-2 h-2 rounded-full bg-vitality-500 animate-ping"></span>
                            Command Access Granted
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                            Health Logistics Command Terminal
                        </h3>
                        <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                            You are authenticated as an authorized health system administrator. You have full privileges to manage the MariaDB blood registry, register emergency donors with verified photographs, and audit system telemetry.
                        </p>

                        <div class="mt-6 flex flex-wrap items-center gap-3">
                            <a href="{{ url('home') }}" class="px-5 py-3 rounded-2xl bg-gradient-to-r from-unesco-600 to-unesco-500 hover:from-unesco-500 hover:to-unesco-600 text-white text-xs font-bold uppercase tracking-wider shadow-lg shadow-unesco-500/25 active:scale-95 transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Open Command Console
                            </a>

                            <a href="{{ url('add_donor_view') }}" class="px-5 py-3 rounded-2xl bg-gradient-to-r from-vitality-600 to-vitality-500 hover:from-vitality-500 hover:to-vitality-600 text-white text-xs font-bold uppercase tracking-wider shadow-lg shadow-vitality-500/25 active:scale-95 transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Donor Intake Terminal
                            </a>

                            <a href="{{ url('/') }}" target="_blank" class="px-5 py-3 rounded-2xl bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold uppercase tracking-wider border border-slate-200 shadow-sm transition-all flex items-center gap-2">
                                <svg class="w-4 h-4 text-unesco-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Public Grid
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Regular Volunteer Donor Dashboard View -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left: Donor Identity Credential Card -->
                    <div class="lg:col-span-5 glass-panel rounded-3xl p-6 sm:p-8 border border-white/80 shadow-xl relative overflow-hidden">
                        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-unesco-600 to-vitality-500"></div>

                        <div class="flex items-center gap-4 pb-6 border-b border-slate-100">
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-unesco-600 to-vitality-500 flex items-center justify-center text-white font-black text-2xl shadow-lg shadow-unesco-500/25">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-xl font-extrabold text-slate-900">{{ Auth::user()->name }}</h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-200 font-mono">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        VERIFIED DONOR
                                    </span>
                                    <span class="text-xs text-slate-400 font-mono">ID #USR-{{ Auth::user()->id }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Registered Telemetry Details -->
                        <div class="py-6 space-y-4 text-xs font-medium">
                            <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50/80 border border-slate-100">
                                <span class="text-slate-500 font-semibold">Registered Email</span>
                                <span class="text-slate-800 font-mono font-bold">{{ Auth::user()->email }}</span>
                            </div>

                            <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50/80 border border-slate-100">
                                <span class="text-slate-500 font-semibold">Emergency Contact Phone</span>
                                <span class="text-slate-800 font-mono font-bold">{{ Auth::user()->phone ?? 'Pending Verification' }}</span>
                            </div>

                            <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50/80 border border-slate-100">
                                <span class="text-slate-500 font-semibold">Regional Sector / Place</span>
                                <span class="text-slate-800 font-bold">{{ Auth::user()->address ?? 'Kerala Command Hub' }}</span>
                            </div>

                            <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50/80 border border-slate-100">
                                <span class="text-slate-500 font-semibold">Enrolled Since</span>
                                <span class="text-slate-800 font-mono">{{ Auth::user()->created_at ? Auth::user()->created_at->format('M d, Y') : 'Active' }}</span>
                            </div>
                        </div>

                        <!-- Card Action Buttons -->
                        <div class="pt-4 border-t border-slate-100 grid grid-cols-2 gap-3">
                            <a href="{{ route('profile.show') }}" class="px-4 py-2.5 rounded-xl bg-unesco-50 hover:bg-unesco-100 text-unesco-700 text-xs font-bold text-center transition-colors border border-unesco-200">
                                Edit Profile / 2FA
                            </a>

                            <a href="{{ url('/#donors') }}" class="px-4 py-2.5 rounded-xl bg-vitality-50 hover:bg-vitality-100 text-vitality-700 text-xs font-bold text-center transition-colors border border-vitality-200">
                                Browse Donors
                            </a>
                        </div>
                    </div>

                    <!-- Right: Humanitarian Directive & Response Guidelines -->
                    <div class="lg:col-span-7 space-y-6">
                        <div class="glass-panel rounded-3xl p-6 sm:p-8 border border-white/80 shadow-xl">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-unesco-50 text-unesco-700 text-xs font-bold uppercase tracking-wider mb-4 border border-unesco-200">
                                Volunteer Emergency Protocols
                            </div>
                            <h3 class="text-xl font-extrabold text-slate-900 tracking-tight">
                                UNESCO Volunteer Blood Donor Directives
                            </h3>
                            <p class="mt-2 text-xs sm:text-sm text-slate-600 leading-relaxed">
                                Thank you for your humanitarian service. As an enrolled volunteer donor in the VitaDrop Global network, you are part of a decentralized, real-time life support telemetry grid.
                            </p>

                            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="p-4 rounded-2xl bg-white/70 border border-slate-200">
                                    <div class="font-bold text-xs text-slate-900 flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        Incoming Direct Calls
                                    </div>
                                    <p class="mt-1 text-[11px] text-slate-500 leading-relaxed">
                                        Hospitals or patient families may contact your registered number directly when an urgent match is requested in your sector.
                                    </p>
                                </div>

                                <div class="p-4 rounded-2xl bg-white/70 border border-slate-200">
                                    <div class="font-bold text-xs text-slate-900 flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-unesco-500"></span>
                                        Security & Privacy
                                    </div>
                                    <p class="mt-1 text-[11px] text-slate-500 leading-relaxed">
                                        You can update your availability, modify your contact number, or enable Two-Factor Authentication (2FA) at any time.
                                    </p>
                                </div>
                            </div>

                            <!-- Hotline Help Banner -->
                            <div class="mt-6 p-4 rounded-2xl bg-cosmic-950 text-white flex flex-col sm:flex-row items-center justify-between gap-4">
                                <div>
                                    <div class="text-xs font-mono font-bold text-vitality-400">CENTRAL DISPATCH HOTLINE</div>
                                    <div class="text-sm font-bold text-slate-200 mt-0.5">Need assistance or reporting a critical shortage?</div>
                                </div>
                                <a href="tel:+919744701363" class="px-4 py-2.5 rounded-xl bg-vitality-600 hover:bg-vitality-500 text-white text-xs font-bold transition-all shadow-md flex items-center gap-2 whitespace-nowrap">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    +91 9744701363
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
