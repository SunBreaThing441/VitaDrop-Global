<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <!-- Gateway Header -->
        <div class="mb-6 text-center">
            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-unesco-50 border border-unesco-200 text-unesco-700 text-[11px] font-bold uppercase tracking-wider mb-2">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                Secure Telemetry Gateway
            </div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Identity Authentication</h2>
            <p class="text-xs text-slate-500 mt-1">Access the UNESCO Global Humanitarian Blood Network</p>
        </div>

        <x-validation-errors />

        @if (session('status'))
            <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-xs font-semibold text-emerald-700 flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5" x-data="{ showPassword: false }">
            @csrf

            <!-- Email Address Field -->
            <div>
                <x-label for="email" value="{{ __('Registered Email') }}" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                    <x-input 
                        id="email" 
                        class="block w-full pl-10 pr-4 py-2.5" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        placeholder="operator@vitadrop.unesco.org" 
                        required 
                        autofocus 
                        autocomplete="username" 
                    />
                </div>
            </div>

            <!-- Password Field with Toggle -->
            <div>
                <div class="flex items-center justify-between">
                    <x-label for="password" value="{{ __('Security Key / Password') }}" />
                    @if (Route::has('password.request'))
                        <a class="text-xs font-semibold text-unesco-600 hover:text-unesco-700 hover:underline transition-colors" href="{{ route('password.request') }}">
                            {{ __('Forgot key?') }}
                        </a>
                    @endif
                </div>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <x-input 
                        id="password" 
                        class="block w-full pl-10 pr-10 py-2.5" 
                        ::type="showPassword ? 'text' : 'password'" 
                        name="password" 
                        placeholder="••••••••••••" 
                        required 
                        autocomplete="current-password" 
                    />
                    <button 
                        type="button" 
                        @click="showPassword = !showPassword" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none"
                    >
                        <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg x-show="showPassword" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pt-1">
                <label for="remember_me" class="flex items-center cursor-pointer">
                    <x-checkbox id="remember_me" name="remember" class="rounded-lg text-unesco-600 focus:ring-unesco-500 border-slate-300" />
                    <span class="ml-2 text-xs font-semibold text-slate-600">{{ __('Persist verified session') }}</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-unesco-600 via-unesco-500 to-vitality-500 hover:from-unesco-500 hover:to-vitality-500 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-unesco-500/25 active:scale-95 transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Authenticate & Access Grid</span>
                </button>
            </div>

            <!-- Gateway Switch -->
            <div class="pt-4 border-t border-slate-200/60 text-center">
                <p class="text-xs text-slate-500">
                    Not yet enrolled in the registry?
                    <a href="{{ route('register') }}" class="font-bold text-unesco-600 hover:text-unesco-700 hover:underline transition-colors">
                        Register as Emergency Donor
                    </a>
                </p>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
