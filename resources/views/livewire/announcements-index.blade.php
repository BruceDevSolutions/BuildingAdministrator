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

    <div class="relative w-full focus-within:text-primary-500 mb-4">
        <div class="absolute inset-y-0 flex items-center pl-2">
            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <input wire:keydown="cleanPage" wire:model="search" class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-400 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 focus:ring-purple-300 focus:ring-opacity-50 dark:focus:placeholder-gray-600 dark:bg-zinc-700 dark:text-gray-200 focus:placeholder-gray-300 focus:bg-white focus:border-primary-300 focus:outline-none focus:ring form-input" type="text" placeholder="Buscar anuncio" aria-label="Search" />
    </div>

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
                                    {{ Str::limit($announcement->announcement, 150, '...')  }}
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
                                        <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 rounded-lg hover:text-purple-500 text-gray-400  focus:outline-none focus:ring-gray" aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </button>
                                        <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 rounded-lg hover:text-purple-500 text-gray-400 focus:outline-none focus:ring-gray" aria-label="Delete">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
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
    </div>


</x-card>