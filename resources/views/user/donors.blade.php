<section id="donors" class="py-24 relative z-10" x-data="{
    searchQuery: '',
    selectedGroup: 'all',
    bloodGroups: [
        { label: 'All Donors', value: 'all', count: null },
        { label: 'O-', value: 'O Negative', isRare: true },
        { label: 'O+', value: 'O Positive' },
        { label: 'A-', value: 'A Negative', isRare: true },
        { label: 'A+', value: 'A Positive' },
        { label: 'B-', value: 'B Negative', isRare: true },
        { label: 'B+', value: 'B Positive' },
        { label: 'AB-', value: 'AB Negative', isRare: true },
        { label: 'AB+', value: 'AB Positive' }
    ],
    matches(name, place, bloodGroup, number) {
        const q = this.searchQuery.toLowerCase().trim();
        const matchesQuery = !q || 
            (name && name.toLowerCase().includes(q)) || 
            (place && place.toLowerCase().includes(q)) || 
            (bloodGroup && bloodGroup.toLowerCase().includes(q)) || 
            (number && number.toLowerCase().includes(q));
        
        const matchesGroup = this.selectedGroup === 'all' || 
            (bloodGroup && bloodGroup.toLowerCase().includes(this.selectedGroup.toLowerCase()));
        
        return matchesQuery && matchesGroup;
    }
}">
    <!-- Subtle Background Ambient Glows -->
    <div class="absolute top-1/2 left-0 w-96 h-96 bg-unesco-400/10 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute bottom-10 right-0 w-96 h-96 bg-vitality-400/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Telemetry Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-vitality-50 border border-vitality-200 text-vitality-700 text-xs font-bold uppercase tracking-wider mb-3 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-vitality-500 animate-ping"></span>
                    Live Dispatch Registry &bull; Zero Delay
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight">
                    Emergency <span class="text-transparent bg-clip-text bg-gradient-to-r from-unesco-600 via-unesco-500 to-vitality-500">Blood Registry</span>
                </h2>
                <p class="mt-2 text-sm sm:text-base text-slate-600 max-w-xl">
                    Direct access to registered emergency volunteers. Verified regional clinical donors ready for immediate peer-to-peer mobilization.
                </p>
            </div>

            <!-- Registry Telemetry Counter -->
            <div class="flex items-center gap-3">
                <div class="glass-panel px-5 py-3 rounded-2xl border border-white/80 shadow-md flex items-center gap-4">
                    <div class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></div>
                    <div>
                        <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Donors Online</div>
                        <div class="text-xl font-extrabold text-slate-900 font-mono">{{ count($donors) }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Deck -->
        <div class="glass-panel rounded-3xl p-5 sm:p-6 mb-10 shadow-xl shadow-unesco-500/5 border border-white/80">
            <!-- Search Input with Instant Clear -->
            <div class="relative mb-5">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input 
                    type="text" 
                    x-model="searchQuery"
                    placeholder="Search by donor name, city, hospital sector, or blood group (e.g. Kozhikode, O Negative, Rahman)..." 
                    class="w-full pl-11 pr-10 py-3.5 bg-white/90 border border-slate-200 rounded-2xl text-sm placeholder-slate-400 focus:bg-white focus:border-unesco-500 focus:ring-4 focus:ring-unesco-500/15 transition-all outline-none"
                >
                <button 
                    x-show="searchQuery.length > 0" 
                    x-cloak
                    @click="searchQuery = ''" 
                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Quick Blood Group Pills -->
            <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none">
                <template x-for="group in bloodGroups" :key="group.value">
                    <button 
                        type="button"
                        @click="selectedGroup = group.value"
                        class="px-3.5 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-all duration-200 flex items-center gap-1.5 focus:outline-none"
                        :class="selectedGroup === group.value 
                            ? 'bg-gradient-to-r from-unesco-600 to-unesco-500 text-white shadow-md shadow-unesco-500/30 scale-105' 
                            : 'bg-white hover:bg-slate-50 text-slate-700 border border-slate-200/80 hover:border-unesco-300'"
                    >
                        <span x-show="group.value !== 'all'" class="w-1.5 h-1.5 rounded-full" :class="group.isRare ? 'bg-vitality-400' : 'bg-unesco-400'"></span>
                        <span x-text="group.label"></span>
                    </button>
                </template>
            </div>
        </div>

        {{-- Donors Glassmorphic Cards Grid (Eloquent foreach Loop) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($donors as $donor)
                <div 
                    x-show="matches('{{ addslashes($donor->name ?? '') }}', '{{ addslashes($donor->place ?? '') }}', '{{ addslashes($donor->blood_group ?? '') }}', '{{ addslashes($donor->number ?? '') }}')"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="glass-card rounded-3xl overflow-hidden flex flex-col group border border-slate-200/90 hover:border-unesco-400/60 transition-all duration-300"
                >
                    <!-- Card Media / Photo Header (Resolving to donorphotos/{photo}) -->
                    <div class="relative h-56 bg-gradient-to-br from-slate-100 via-unesco-50/40 to-slate-200 overflow-hidden flex items-center justify-center">
                        @if(!empty($donor->photo))
                            <img 
                                src="donorphotos/{{ $donor->photo }}" 
                                alt="{{ $donor->name }}"
                                class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
                                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80'"
                            >
                        @else
                            <div class="flex flex-col items-center justify-center text-slate-400 p-4">
                                <div class="w-16 h-16 rounded-2xl bg-white/80 shadow-md flex items-center justify-center text-unesco-500 border border-unesco-200 mb-2">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <span class="text-[10px] uppercase font-bold tracking-wider text-slate-400 font-mono">CLINICAL ID #{{ $donor->id }}</span>
                            </div>
                        @endif

                        <!-- Blood Group Floating Pill -->
                        <div class="absolute top-3 right-3 shadow-lg">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-vitality-500 text-white font-black text-xs tracking-wider shadow-md shadow-vitality-500/30 uppercase">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-ping"></span>
                                <span>{{ $donor->blood_group ?? 'Verified' }}</span>
                            </span>
                        </div>

                        <!-- Availability Indicator -->
                        <div class="absolute bottom-3 left-3">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-semibold border border-white/10 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span>Emergency Ready</span>
                            </span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 sm:p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <!-- Donor Name -->
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-unesco-600 transition-colors truncate">
                                    {{ $donor->name }}
                                </h3>
                            </div>

                            <!-- Place / District Hub -->
                            <div class="flex items-center gap-2 mt-2 text-xs font-semibold text-slate-500">
                                <div class="w-5 h-5 rounded-lg bg-unesco-50 text-unesco-600 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <span class="truncate">{{ $donor->place ?? 'Registered Sector' }}</span>
                            </div>

                            <!-- Phone Verification Display -->
                            <div class="flex items-center gap-2 mt-1.5 text-xs font-mono font-medium text-slate-400">
                                <div class="w-5 h-5 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span class="truncate">{{ $donor->number ?? 'Direct Dial Verified' }}</span>
                            </div>
                        </div>

                        <!-- Action Anchors: Direct Call & WhatsApp -->
                        <div class="mt-6 pt-4 border-t border-slate-100 grid grid-cols-2 gap-2">
                            <!-- Direct Call Action -->
                            <a 
                                href="tel:{{ $donor->number }}"
                                class="inline-flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-gradient-to-r from-unesco-600 to-unesco-500 hover:from-unesco-500 hover:to-unesco-600 text-white text-xs font-bold transition-all shadow-md shadow-unesco-500/20 active:scale-95"
                                title="Direct Emergency Call"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>Direct Call</span>
                            </a>

                            <!-- Instant WhatsApp Action -->
                            @php
                                $cleanPhone = preg_replace('/[^0-9]/', '', $donor->number ?? '');
                            @endphp
                            <a 
                                href="https://api.whatsapp.com/send?phone={{ $cleanPhone }}&text=Hello%20{{ urlencode($donor->name ?? 'Donor') }},%20this%20is%20an%20urgent%20blood%20request%20via%20VitaDrop%20Global%20(UNESCO%20Humanitarian%20Blood%20Initiative)." 
                                target="_blank"
                                class="inline-flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-bold transition-all shadow-md shadow-emerald-500/20 active:scale-95"
                                title="Instant WhatsApp Coordination"
                            >
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.312.045-.697.072-2.12-.519-1.815-.752-2.985-2.597-3.076-2.716-.091-.121-.734-.977-.734-1.864 0-.887.465-1.323.63-1.503.167-.179.365-.224.487-.224.121 0 .243.002.35.007.113.006.264-.043.413.315.152.366.518 1.265.564 1.356.046.091.077.198.016.32-.061.121-.092.198-.182.304-.091.106-.192.237-.274.318-.091.091-.186.19-.08.372.106.182.472.779 1.014 1.261.697.621 1.285.814 1.468.905.183.091.29.076.397-.046.106-.122.456-.533.578-.716.121-.183.243-.152.41-.091.168.061 1.066.503 1.249.594.183.091.29.076.397-.046.106-.122.456-.533.578-.716.121-.183.243-.152.41-.091.168.061 1.066.503 1.249.594.183.092.305.137.35.213.046.077.046.444-.098.849z"/>
                                </svg>
                                <span>WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State When Zero Records in DB -->
                <div class="col-span-full glass-panel rounded-3xl p-12 text-center max-w-lg mx-auto border border-white/80 shadow-xl">
                    <div class="w-16 h-16 rounded-2xl bg-vitality-50 text-vitality-500 mx-auto flex items-center justify-center mb-4 border border-vitality-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-extrabold text-slate-800">No Donors Currently Registered</h3>
                    <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                        The central registry is ready for initial donor intake. Volunteer donors can enroll now or health coordinators can intake verified participants.
                    </p>
                    <div class="mt-6 flex items-center justify-center gap-3">
                        <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-unesco-600 hover:bg-unesco-500 text-white text-xs font-bold transition-colors shadow-md">
                            Enroll as Volunteer
                        </a>
                        <a href="tel:+919744701363" class="px-5 py-2.5 rounded-xl bg-vitality-600 hover:bg-vitality-500 text-white text-xs font-bold transition-colors shadow-md">
                            Emergency Hotline
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
