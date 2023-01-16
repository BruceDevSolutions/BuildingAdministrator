@props([
    'label',
])
<label class="inline-flex items-center text-gray-600 dark:text-gray-400">
    <input {{ $attributes(['class' => 'placeholder-gray-400 border-gray-300 shadow-sm text-primary-600 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-gray dark:placeholder-gray-500 dark:focus:placeholder-gray-600 focus:placeholder-gray-300', 'type' => 'radio']) }}/>
    <span class="ml-2">{{ $label }}</span>
</label>