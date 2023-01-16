@props([
    'title',
    'size' => 'text-xl'
])

<h1 {{ $attributes(['class' => "text-black dark:text-gray-200 font-semibold $size"]) }} >
    {{ $title ?? $slot }}
</h1>