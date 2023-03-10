<x-card>

    <div class="flex justify-end">
        <a href="{{ route('announcements.create') }}">
            <x-button title="Nuevo" />
        </a>
    </div>

    <x-title title="Lista de anuncios"/>
    
    <x-paragraph class="mb-8">
        Los anuncios se mostrarán en página de Inicio. Desde este panel puedes configurarlos.
    </x-paragraph>

    <x-searcher wire:keydown="cleanPage" wire:model="search"  placeholder="Buscar anuncio" />

    <div class="container grid mx-auto">
        <div class="w-full overflow-hidden rounded-lg ring-1 ring-black ring-opacity-5">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-zinc-200 dark:text-gray-400 dark:bg-zinc-800">
                            <th class="px-4 py-3">Identificador</th>
                            <th class="px-4 py-3">Título</th>
                            <th class="px-4 py-3">Anuncio</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Anclado</th>
                            <th class="px-4 py-3">Fecha</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-zinc-100 divide-y dark:divide-gray-700 dark:bg-zinc-800">
                        @forelse ($announcements as $announcement)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    {{ $announcement->id }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap">
                                    {{ $announcement->title }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap xl:whitespace-normal">
                                    {{ Str::limit($announcement->description, 150, '...')  }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <div>
                                        @if($announcement->status)
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                Activo
                                            </span>
                                        @else
                                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                                Oculto
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap text-center xl:whitespace-normal">
                                   <div>
                                        @if($announcement->pinned)
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                Si
                                            </span>
                                        @else
                                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                                No
                                            </span>
                                        @endif
                                   </div>
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap">
                                    {{ $announcement->created_at }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('announcements.edit', $announcement) }}">
                                            <x-edit-button />
                                        </a>
                                        <x-delete-button wire:click="confirmDeleteAnnouncement({{ $announcement->id }})" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td colspan="7" class="py-6 text-center">
                                    Aún no hay registros de anuncios.
                                </td>
                            </tr>
                        @endforelse 
                    </tbody>
                </table>
            </div>
            <div class=" px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-zinc-200 sm:grid-cols-9 dark:text-gray-400 dark:bg-zinc-800">
                {{ $announcements->links() }}
            </div>
        </div>

        <x-notifications />

        <x-jet-dialog-modal wire:model="confirmDelete">
            <x-slot name="title">
                Eliminar Anuncio
            </x-slot>

            <x-slot name="content">
                ¿Estás seguro de eliminar este anuncio?
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmDelete', false)" wire:loading.attr="disabled">
                    Cancelar
                </x-secondary-button>

                <x-button class="ml-3" wire:click="deleteAnnouncement()" wire:loading.attr="disabled">
                    Eliminar 
                </x-button>
            </x-slot>
        </x-jet-dialog-modal> 
    </div>
</x-card>