@props(['id' => null, 'maxWidth' => null])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg dark:text-white">
            {{ $title }}
        </div>

        <div class="mt-4 dark:text-gray-100">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 dark:bg-zinc-900 text-right">
        {{ $footer }}
    </div>
</x-jet-modal>
