<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-unesco-600 to-unesco-500 hover:from-unesco-500 hover:to-unesco-600 text-white font-semibold text-xs tracking-wider uppercase rounded-xl shadow-lg shadow-unesco-500/25 hover:shadow-unesco-500/40 active:scale-95 focus:outline-none focus:ring-2 focus:ring-unesco-400 focus:ring-offset-2 transition-all duration-200']) }}>
    {{ $slot }}
</button>
