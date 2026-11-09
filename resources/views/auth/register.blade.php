<x-guest-layout>
    <div class="w-full sm:max-w-xl flex flex-col items-center">
        <div class="mb-6 transform transition-all duration-300 hover:scale-105">
            <x-authentication-card-logo />
        </div>

        <div class="w-full glass-panel shadow-2xl shadow-unesco-500/10 rounded-3xl p-8 sm:p-10 border border-white/80 relative overflow-hidden">
            <!-- Top Gradient Accent -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-unesco-600 via-unesco-500 to-vitality-500"></div>

            <!-- Enrollment Header -->
            <div class="mb-6 text-center">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-vitality-50 border border-vitality-200 text-vitality-700 text-[11px] font-bold uppercase tracking-wider mb-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-vitality-500 animate-ping"></span>
                    Global Humanitarian Enrollment
                </div>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Register as Volunteer Donor</h2>
                <p class="text-xs text-slate-500 mt-1">Join the verified emergency blood telemetry registry</p>
            </div>

            <x-validation-errors />

            <form method="POST" action="{{ route('register') }}" class="space-y-4" x-data="{ showPass: false }">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Legal Name -->
                    <div class="sm:col-span-2">
                        <x-label for="name" value="{{ __('Full Legal Name') }}" />
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <x-input 
                                id="name" 
                                class="block w-full pl-10 pr-4 py-2.5" 
                                type="text" 
                                name="name" 
                                :value="old('name')" 
                                placeholder="Dr. Elena Rostova" 
                                required 
                                autofocus 
                                autocomplete="name" 
                            />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="sm:col-span-2">
                        <x-label for="email" value="{{ __('Official Email Address') }}" />
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
                                placeholder="donor@hospital.org" 
                                required 
                                autocomplete="username" 
                            />
                        </div>
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <x-label for="phone" value="{{ __('Emergency Phone') }}" />
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <x-input 
                                id="phone" 
                                class="block w-full pl-10 pr-4 py-2.5" 
                                type="text" 
                                name="phone" 
                                :value="old('phone')" 
                                placeholder="+91 9744701363" 
                                required 
                                autocomplete="tel" 
                            />
                        </div>
                    </div>

                    <!-- Sector / City Address -->
                    <div>
                        <x-label for="address" value="{{ __('City / District Hub') }}" />
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <x-input 
                                id="address" 
                                class="block w-full pl-10 pr-4 py-2.5" 
                                type="text" 
                                name="address" 
                                :value="old('address')" 
                                placeholder="Kozhikode, Kerala" 
                                required 
                                autocomplete="street-address" 
                            />
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <x-label for="password" value="{{ __('Access Key') }}" />
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <x-input 
                                id="password" 
                                class="block w-full pl-10 pr-10 py-2.5" 
                                ::type="showPass ? 'text' : 'password'" 
                                name="password" 
                                placeholder="••••••••" 
                                required 
                                autocomplete="new-password" 
                            />
                            <button 
                                type="button" 
                                @click="showPass = !showPass" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none"
                            >
                                <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg x-show="showPass" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-label for="password_confirmation" value="{{ __('Confirm Key') }}" />
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <x-input 
                                id="password_confirmation" 
                                class="block w-full pl-10 pr-4 py-2.5" 
                                ::type="showPass ? 'text' : 'password'" 
                                name="password_confirmation" 
                                placeholder="••••••••" 
                                required 
                                autocomplete="new-password" 
                            />
                        </div>
                    </div>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="pt-2">
                        <label for="terms" class="flex items-start">
                            <x-checkbox name="terms" id="terms" required class="mt-0.5 rounded text-unesco-600 focus:ring-unesco-500 border-slate-300" />
                            <div class="ml-2 text-xs text-slate-600">
                                {!! __('I agree to the :terms_of_service and :privacy_policy under UNESCO Humanitarian Guidelines', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline font-semibold text-unesco-600 hover:text-unesco-700">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline font-semibold text-unesco-600 hover:text-unesco-700">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </label>
                    </div>
                @endif

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-vitality-600 via-vitality-500 to-unesco-600 hover:from-vitality-500 hover:to-unesco-500 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-vitality-500/25 active:scale-95 transition-all flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Enroll & Synchronize Profile</span>
                    </button>
                </div>

                <!-- Link to Sign In -->
                <div class="pt-4 border-t border-slate-200/60 text-center">
                    <p class="text-xs text-slate-500">
                        Already enrolled in the registry?
                        <a href="{{ route('login') }}" class="font-bold text-unesco-600 hover:text-unesco-700 hover:underline transition-colors">
                            Authenticate with Key
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
