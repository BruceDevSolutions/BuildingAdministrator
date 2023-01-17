@props([
    'title' => null,
])
<button {{ $attributes(['class' => 'px-4 py-2 text-sm font-medium leading-5 text-gray-900 dark:text-white transition-colors duration-150 border border-gray-300 dark:border-transparent rounded-lg bg-gray-100 hover:bg-white dark:bg-zinc-500 dark:hover:bg-zinc-600 focus:outline-none ']) }}>
    {{ $title ?? $slot }}
</button>