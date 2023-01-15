@props([
    'title',
])

<h1 {{ $attributes(['class' => 'text-black dark:text-gray-200 text-xl font-semibold']) }} >
    {{ $title ?? $slot }}
</h1>