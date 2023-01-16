@props([
    'label',
    'errorName'
])
<div>
    <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">{{ $label }}</span>
        <textarea {{ $attributes(['class' => 'block w-full mt-1 placeholder-gray-400 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-gray focus-within:text-primary-600 dark:focus-within:text-primary-400 dark:placeholder-gray-500 dark:focus:placeholder-gray-600 focus:placeholder-gray-300']) }}></textarea>
    </label>
    <div>
        @if(isset($errorName))
            @error($errorName)
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror
        @endif
    </div>

</div>
