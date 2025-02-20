@props(['active' => false])

<ul class="space-y-2">
    <li>
        <a {{ $attributes }}
            class="{{ $active ? 'bg-gray-100 dark:bg-gray-700' : '' }} flex items-center p-2 my-1 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
            aria-current="{{ $active ? 'page' : false }}">
            {{$icon}}
            <span class="ml-3">{{ $slot }}</span>
        </a>
    </li>
</ul>