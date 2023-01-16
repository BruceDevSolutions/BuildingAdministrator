@props([
    'title',
    'errorName',
])
<div {{ $attributes(['class' => 'text-sm']) }}>
    <span class="text-gray-700 dark:text-gray-400">{{ $title }}</span>
    <div class="mt-2 space-x-6">
        {{ $slot }}
    </div>
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