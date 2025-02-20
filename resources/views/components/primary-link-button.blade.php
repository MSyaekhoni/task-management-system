<a {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-[#4F46E5] border border-transparent
    rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#3e35d4] focus:bg-[#3e35d4]
    active:bg-[#3e35d4] focus:outline-none focus:ring-2 focus:ring-[#3e35d4] transition ease-in-out
    duration-150']) }}>
    {{ $slot }}
</a>