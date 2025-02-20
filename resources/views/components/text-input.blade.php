@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-200 text-gray-900 text-sm
rounded-lg focus:ring-[#3e35d4] focus:border-[#3e35d4] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
dark:placeholder-gray-400 dark:text-gray-50 dark:focus:ring-[#3e35d4] dark:focus:border-[#3e35d4]']) }}>