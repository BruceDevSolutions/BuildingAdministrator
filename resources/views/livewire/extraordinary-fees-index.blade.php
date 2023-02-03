<x-card>
    <div class="flex justify-end">
        <a href="{{ route('properties.extraordinary-fees.create') }}">
            <x-button title="Nueva" />
        </a>
    </div>

    <x-title title="Cuotas extraordinarias" class="mb-4" />

    <div class="flex my-2 space-x-2 items-end">
        <p class=" text-gray-900 dark:text-white font-semibold">Ver:</p>
        <p class="@if($orderBy == 'active') text-black dark:text-white font-medium @else text-gray-600 dark:text-gray-300 @endif text-sm cursor-pointer" wire:click="$set('orderBy','active')">Activos</p>
        <p class="@if($orderBy == 'all') text-black dark:text-white font-medium @else text-gray-600 dark:text-gray-300 @endif  text-sm cursor-pointer" wire:click="$set('orderBy','all')">Todas</p>
    </div>

    <x-searcher wire:keydown="cleanPage" wire:model="search"  placeholder="Buscar cuotas extraordinarias por concepto o código de inmueble"  />

    <div class="container grid mx-auto">
        <div class="w-full overflow-hidden rounded-lg ring-1 ring-black ring-opacity-5">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-zinc-200 dark:text-gray-400 dark:bg-zinc-800">
                            <th class="px-4 py-3">Id</th>
                            <th class="px-4 py-3">Concepto</th>
                            <th class="px-4 py-3">Detalles</th>
                            <th class="px-4 py-3">Monto</th>
                            <th class="px-4 py-3">Inmueble(es)</th>
                            <th class="px-4 py-3">Pagado</th>
                            <th class="px-4 py-3">Pendiente</th>
                            <th class="px-4 py-3">Fecha</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-zinc-100 divide-y dark:divide-gray-700 dark:bg-zinc-800">
                        @forelse ($fines as $fine)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    {{ $fine->id }}
                                </td>
                                <td class="px-4 py-3 text-sm ">
                                    {{ $fine->concept }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap xl:whitespace-normal">
                                    {{ Str::limit($fine->details, 150, '...')  }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap">
                                    {{ $fine->value }} Bs.
                                </td>
                                <td class="px-4 py-3 text-sm ">
                                    @foreach ($fine->properties as $property)
                                        {{ $property->code }}
                                    @endforeach
                                </td>
                                <td class="px-4 py-3 text-sm ">
                                    @foreach ($fine->properties_paid as $property)
                                        {{ $property->code }}
                                    @endforeach
                                </td>
                                <td class="px-4 py-3 text-sm ">
                                    @foreach ($fine->properties_pending as $property)
                                        {{ $property->code }}
                                    @endforeach
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap">
                                    {{ $fine->date }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <div class="cursor-pointer">
                                        @if($fine->status)
                                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                                Pagado
                                            </span>
                                            @else
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                Activo
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <x-delete-button wire:click="confirmDeleteFine({{ $fine->id }})" />
                                        <a href="{{ route('properties.fines.show', $fine->id) }}">
                                            <x-view-button />
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td colspan="8" class="py-6 text-center">
                                    Aún no hay registros de cuotas extraordinarios.
                                </td>
                            </tr>
                        @endforelse 
                    </tbody>
                </table>
            </div>
            <div class=" px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-zinc-200 sm:grid-cols-9 dark:text-gray-400 dark:bg-zinc-800">
                {{ $fines->links() }}
            </div>
        </div>

        <x-notifications />

        {{-- Modal de eliminación --}}
        <x-jet-dialog-modal wire:model="confirmDelete">
            <x-slot name="title">
                Eliminar cuota extraordinaria
            </x-slot>

            <x-slot name="content">
                ¿Estás seguro de eliminar este registro?
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmDelete', false)" wire:loading.attr="disabled">
                    Cancelar
                </x-secondary-button>

                <x-button class="ml-3" wire:click="deleteFine()" wire:loading.attr="disabled">
                    Eliminar 
                </x-button>
            </x-slot>
        </x-jet-dialog-modal> 
    </div>
</x-card>