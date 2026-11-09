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
            <h2 class="text-xl font-extrabold text-slate-900">Coordinator Authentication Required</h2>
            <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                Donor intake requires authenticated coordinator credentials under UNESCO Protocol 14-B.
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
                INTAKE AUTHORIZATION RESTRICTED
            </div>
            <h2 class="text-xl font-extrabold text-slate-900">Administrator Role Required</h2>
            <p class="text-xs text-slate-500 mt-2 leading-relaxed">
                Your account is currently classified as a <strong class="text-slate-800">Volunteer Donor (usertype: 0)</strong>. Intake and registry modification actions require administrator clearance.
            </p>
            <div class="mt-6 flex flex-col gap-2.5">
                <a href="{{ url('home') }}" class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-unesco-600 to-unesco-500 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-unesco-500/25 transition-all">
                    Return to My Dashboard
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
    <!-- Authorized Administrator Intake Terminal -->
    <!-- Responsive Sidebar Dock -->
    @include('admin.sidebar')

    <!-- Main Viewport Area -->
    <div class="flex-1 flex flex-col min-w-0 h-screen overflow-y-auto mesh-backdrop">
        <!-- Top Telemetry Header -->
        @include('admin.navbar')

        <!-- Main Form Terminal Stage -->
        <main class="p-6 sm:p-10 max-w-4xl w-full mx-auto space-y-8" x-data="{ 
            photoName: null, 
            photoPreview: null,
            selectedGroup: '',
            groups: [
                'A Positive', 'A Negative', 
                'B Positive', 'B Negative', 
                'AB Positive', 'AB Negative', 
                'O Positive', 'O Negative'
            ]
        }">
            
            <!-- Terminal Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-vitality-50 border border-vitality-200 text-vitality-700 text-xs font-bold uppercase tracking-wider mb-2">
                        <span class="w-2 h-2 rounded-full bg-vitality-500 animate-ping"></span>
                        Humanitarian Intake Terminal
                    </div>
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Register Emergency Donor</h1>
                    <p class="text-sm text-slate-600 mt-1">Enroll a validated blood donor into the global UNESCO peer-to-peer telemetry grid.</p>
                </div>

                <a href="{{ url('home') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50 transition-colors shadow-sm self-start sm:self-auto">
                    &larr; Back to Dashboard
                </a>
            </div>

            <!-- Inline Flash Message Alert (if present) -->
            @if(session()->has('message'))
                <div class="glass-panel p-5 rounded-2xl border-l-4 border-l-emerald-500 border border-white/80 shadow-lg shadow-emerald-500/10 flex items-center justify-between" x-data="{ show: true }" x-show="show">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 border border-emerald-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Donor Successfully Synchronized</h4>
                            <p class="text-xs text-slate-600 mt-0.5">{{ session()->get('message') }}</p>
                        </div>
                    </div>
                    <button @click="show = false" type="button" class="p-2 text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Main Intake Card: Native POST to /upload_donor with multipart/form-data -->
            <div class="glass-panel rounded-3xl p-8 sm:p-10 border border-white/80 shadow-xl shadow-unesco-500/5 relative overflow-hidden">
                <!-- Top Accent Gradient Line -->
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-unesco-600 via-unesco-500 to-vitality-500"></div>

                <form action="{{ url('upload_donor') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Donor Full Name -->
                        <div class="sm:col-span-2">
                            <label class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">
                                Donor Full Legal Name <span class="text-vitality-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    name="name" 
                                    placeholder="e.g. Dr. Ayesha Rahman" 
                                    required 
                                    class="w-full pl-11 pr-4 py-3 bg-white/90 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-unesco-500 focus:ring-4 focus:ring-unesco-500/15 transition-all outline-none"
                                >
                            </div>
                        </div>

                        <!-- Reachable Phone Number -->
                        <div>
                            <label class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">
                                Reachable Phone Number <span class="text-vitality-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    name="number" 
                                    placeholder="+91 9876543210" 
                                    required 
                                    class="w-full pl-11 pr-4 py-3 bg-white/90 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-unesco-500 focus:ring-4 focus:ring-unesco-500/15 transition-all outline-none"
                                >
                            </div>
                            <span class="text-[11px] text-slate-500 mt-1.5 block">Used for direct phone calls and instant WhatsApp routing.</span>
                        </div>

                        <!-- City / Sector Hub -->
                        <div>
                            <label class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">
                                City / District Hub <span class="text-vitality-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    name="place" 
                                    placeholder="e.g. Kozhikode Central, Kerala" 
                                    required 
                                    class="w-full pl-11 pr-4 py-3 bg-white/90 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-unesco-500 focus:ring-4 focus:ring-unesco-500/15 transition-all outline-none"
                                >
                            </div>
                        </div>

                        <!-- Validated Blood Group -->
                        <div class="sm:col-span-2">
                            <label class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">
                                Validated Blood Group Classification <span class="text-vitality-500">*</span>
                            </label>

                            <!-- Interactive Pill Selectors -->
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 mb-3">
                                <template x-for="grp in groups" :key="grp">
                                    <button 
                                        type="button" 
                                        @click="selectedGroup = grp; $refs.bloodSelect.value = grp"
                                        class="py-2.5 px-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-1.5 focus:outline-none border"
                                        :class="selectedGroup === grp 
                                            ? 'bg-vitality-600 text-white border-vitality-600 shadow-md shadow-vitality-500/25 scale-[1.02]' 
                                            : 'bg-white hover:bg-slate-50 text-slate-700 border-slate-200'"
                                    >
                                        <span class="w-1.5 h-1.5 rounded-full" :class="selectedGroup === grp ? 'bg-white' : 'bg-vitality-500'"></span>
                                        <span x-text="grp"></span>
                                    </button>
                                </template>
                            </div>

                            <!-- Native Select Bound for Form POST Compatibility -->
                            <select 
                                name="blood_group" 
                                required 
                                x-ref="bloodSelect"
                                @change="selectedGroup = $el.value"
                                class="w-full py-3 px-4 bg-white/90 border border-slate-200 rounded-xl text-sm text-slate-800 font-semibold focus:bg-white focus:border-unesco-500 focus:ring-4 focus:ring-unesco-500/15 transition-all outline-none"
                            >
                                <option value="" disabled selected>-- Or choose from dropdown --</option>
                                <option value="A Positive">A Positive</option>
                                <option value="A Negative">A Negative</option>
                                <option value="B Positive">B Positive</option>
                                <option value="B Negative">B Negative</option>
                                <option value="AB Positive">AB Positive</option>
                                <option value="AB Negative">AB Negative</option>
                                <option value="O Positive">O Positive</option>
                                <option value="O Negative">O Negative</option>
                            </select>
                        </div>

                        <!-- Photo Upload with Live Drag & Drop Preview (file stream bound to 'file') -->
                        <div class="sm:col-span-2">
                            <label class="block font-bold text-xs uppercase tracking-wider text-slate-700 mb-2">
                                Official Identification Photo <span class="text-vitality-500">*</span>
                            </label>

                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-2xl bg-white/50 hover:bg-white/80 transition-colors relative">
                                <div class="space-y-2 text-center flex flex-col items-center">
                                    <!-- Photo Preview or Icon -->
                                    <template x-if="photoPreview">
                                        <div class="relative w-28 h-28 rounded-2xl overflow-hidden border-2 border-unesco-500 shadow-lg">
                                            <img :src="photoPreview" class="w-full h-full object-cover">
                                        </div>
                                    </template>

                                    <template x-if="!photoPreview">
                                        <div class="w-16 h-16 rounded-2xl bg-unesco-50 text-unesco-500 flex items-center justify-center border border-unesco-200">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </template>

                                    <div class="flex text-xs text-slate-600">
                                        <label for="file-upload" class="relative cursor-pointer rounded-md font-bold text-unesco-600 hover:text-unesco-500 focus-within:outline-none">
                                            <span>Upload identification headshot</span>
                                            <input 
                                                id="file-upload" 
                                                name="file" 
                                                type="file" 
                                                class="sr-only" 
                                                required
                                                x-ref="photo"
                                                @change="
                                                    const file = $refs.photo.files[0];
                                                    if (file) {
                                                        photoName = file.name;
                                                        const reader = new FileReader();
                                                        reader.onload = (e) => {
                                                            photoPreview = e.target.result;
                                                        };
                                                        reader.readAsDataURL(file);
                                                    }
                                                "
                                            >
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-[11px] text-slate-400">PNG, JPG, WEBP up to 5MB</p>
                                    <span x-show="photoName" class="text-xs font-mono text-emerald-600 font-semibold" x-text="photoName"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Action Button -->
                    <div class="pt-6 border-t border-slate-200/80 flex items-center justify-end gap-4">
                        <button 
                            type="submit" 
                            class="w-full sm:w-auto px-8 py-3.5 bg-gradient-to-r from-unesco-600 via-unesco-500 to-vitality-500 hover:from-unesco-500 hover:to-vitality-500 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-unesco-500/25 active:scale-95 transition-all flex items-center justify-center gap-2"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Confirm & Synchronize Donor
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    @include('admin.script')
@endif

</body>
</html>
