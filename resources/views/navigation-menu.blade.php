<nav x-data="{ open: false }" class="glass-panel border-b border-slate-200/80 sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <!-- VitaDrop Global Logo -->
                <a href="{{ url('/') }}" class="focus:outline-none">
                    <x-vitadrop-logo class="scale-90 origin-left" />
                </a>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:space-x-4">
                    <x-nav-link href="{{ url('/') }}" :active="request()->is('/')">
                        {{ __('Overview') }}
                    </x-nav-link>

                    <x-nav-link href="{{ url('/#donors') }}">
                        {{ __('Live Registry') }}
                    </x-nav-link>

                    <x-nav-link href="{{ url('home') }}" :active="request()->is('home') || request()->is('dashboard')">
                        @if(Auth::user() && Auth::user()->usertype != '0')
                            {{ __('Command Terminal') }}
                        @else
                            {{ __('My Volunteer Hub') }}
                        @endif
                    </x-nav-link>

                    @if(Auth::user() && Auth::user()->usertype != '0')
                        <x-nav-link href="{{ url('add_donor_view') }}" :active="request()->is('add_donor_view')">
                            {{ __('Intake Terminal') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-4">
                <!-- Role Telemetry Badge -->
                @if(Auth::user()->usertype != '0')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-vitality-50 text-vitality-700 text-[10px] font-mono font-bold border border-vitality-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-vitality-500 animate-pulse"></span>
                        ADMIN_NODE (LVL-1)
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-unesco-50 text-unesco-700 text-[10px] font-mono font-bold border border-unesco-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        VOLUNTEER_DONOR
                    </span>
                @endif

                <!-- User Dropdown Menu -->
                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button 
                        @click="dropdownOpen = !dropdownOpen" 
                        class="flex items-center gap-2.5 p-1.5 rounded-2xl border border-slate-200/80 bg-white/80 hover:bg-white text-slate-700 text-xs font-bold transition-all focus:outline-none"
                    >
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-unesco-600 to-vitality-500 flex items-center justify-center text-white font-extrabold text-xs shadow-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Content -->
                    <div 
                        x-show="dropdownOpen" 
                        x-cloak 
                        @click.away="dropdownOpen = false" 
                        class="absolute right-0 mt-2 w-56 glass-panel rounded-2xl shadow-xl border border-white/80 py-2 z-50 text-xs font-medium text-slate-700"
                    >
                        <div class="px-4 py-2 border-b border-slate-100">
                            <div class="font-bold text-slate-900 truncate">{{ Auth::user()->name }}</div>
                            <div class="text-[10px] text-slate-400 font-mono truncate">{{ Auth::user()->email }}</div>
                        </div>

                        <a href="{{ route('profile.show') }}" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-slate-100 transition-colors">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>{{ __('Profile & 2FA Security') }}</span>
                        </a>

                        <a href="{{ url('home') }}" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-slate-100 transition-colors">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>{{ __('Dashboard Home') }}</span>
                        </a>

                        <div class="border-t border-slate-100 my-1"></div>

                        <!-- Secure POST Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button 
                                type="submit" 
                                class="w-full text-left flex items-center gap-2.5 px-4 py-2.5 text-vitality-600 hover:bg-vitality-50 font-bold transition-colors"
                            >
                                <svg class="w-4 h-4 text-vitality-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span>{{ __('Sign Out of Grid') }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-slate-200/80 bg-white/95 backdrop-blur-lg">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link href="{{ url('/') }}" :active="request()->is('/')">
                {{ __('Overview') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ url('/#donors') }}">
                {{ __('Live Registry') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ url('home') }}" :active="request()->is('home')">
                {{ __('Dashboard Home') }}
            </x-responsive-nav-link>

            @if(Auth::user() && Auth::user()->usertype != '0')
                <x-responsive-nav-link href="{{ url('add_donor_view') }}" :active="request()->is('add_donor_view')">
                    {{ __('Intake Terminal') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive User Profile & Logout -->
        <div class="pt-4 pb-3 border-t border-slate-200/80 px-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-unesco-600 to-vitality-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-bold text-sm text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-slate-500 font-mono">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link href="{{ route('profile.show') }}">
                    {{ __('Profile & Security') }}
                </x-responsive-nav-link>

                <!-- Secure POST Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button 
                        type="submit" 
                        class="w-full text-left block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-semibold text-vitality-600 hover:text-vitality-700 hover:bg-vitality-50 hover:border-vitality-500 transition duration-150 ease-in-out"
                    >
                        {{ __('Sign Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
