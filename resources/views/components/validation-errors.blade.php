@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'p-4 rounded-2xl bg-vitality-50/90 border border-vitality-200/90 backdrop-blur-md shadow-lg shadow-vitality-500/10 mb-6 animate-shake']) }}>
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-xl bg-vitality-100 text-vitality-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <div class="flex-grow">
                <div class="font-bold text-xs uppercase tracking-wider text-vitality-700">Verification Alert</div>
                <ul class="mt-1.5 space-y-1 text-xs text-vitality-600 font-medium">
                    @foreach ($errors->all() as $error)
                        <li class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-vitality-500 flex-shrink-0"></span>
                            <span>{{ $error }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
