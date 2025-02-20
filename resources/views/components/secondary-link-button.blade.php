<a {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-green-700 border border-transparent
    rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 focus:bg-green-800
    active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>