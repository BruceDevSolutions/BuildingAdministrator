@props([
    'title' => null,
])
<button {{ $attributes(['class' => 'px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 border border-transparent rounded-lg bg-primary-600 active:bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring']) }}>
    {{ $title ?? $slot }}
</button>