<x-card>
    <div class="flex justify-end">
        <a href="{{ route('properties.create') }}">
            <x-button title="Nuevo" />
        </a>
    </div>

    <x-title title="Lista de propiedades registradas" class="mb-4"/>

    <div class="relative w-full focus-within:text-primary-500 mb-4">
        <div class="absolute inset-y-0 flex items-center pl-2">
            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <input wire:keydown="cleanPage" wire:model="search" class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-400 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 focus:ring-purple-300 focus:ring-opacity-50 dark:focus:placeholder-gray-600 dark:bg-zinc-700 dark:text-gray-200 focus:placeholder-gray-300 focus:bg-white focus:border-primary-300 focus:outline-none focus:ring form-input" type="text" placeholder="Buscar inmueble por identificador o código" aria-label="Search" />
    </div>

    <div class="container grid mx-auto">
        <div class="w-full overflow-hidden rounded-lg ring-1 ring-black ring-opacity-5">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-zinc-200 dark:text-gray-400 dark:bg-zinc-800">
                            <th class="px-4 py-3">Identificador</th>
                            <th class="px-4 py-3">Código</th>
                            <th class="px-4 py-3">Contacto</th>
                            <th class="px-4 py-3">Residentes</th>
                            <th class="px-4 py-3">Cuota</th>
                            <th class="px-4 py-3">Tipo</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-zinc-100 divide-y dark:divide-gray-700 dark:bg-zinc-800">
                        @forelse ($properties as $property)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    {{ $property->id }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap">
                                    {{ $property->code }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap xl:whitespace-normal">
                                    789494
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    Residente de ejemplo
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    {{ $property->monthly_rate }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap text-center xl:whitespace-normal">
                                        @if($property->property_type == 1)
                                                Departamento
                                        @else
                                                Local Comercial
                                        @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('properties.edit', $property) }}">
                                            <x-edit-button />
                                        </a>
                                        <x-delete-button wire:click="confirmDeleteProperty({{ $property->id }})" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td colspan="7" class="py-6 text-center">
                                    Aún no hay registros de propiedades.
                                </td>
                            </tr>
                        @endforelse 
                    </tbody>
                </table>
            </div>
            <div class=" px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-zinc-200 sm:grid-cols-9 dark:text-gray-400 dark:bg-zinc-800">
                {{ $properties->links() }}
            </div>
        </div>

        <x-notifications />

        <x-jet-dialog-modal wire:model="confirmDelete">
            <x-slot name="title">
                Eliminar propiedad
            </x-slot>

            <x-slot name="content">
                ¿Estás seguro de eliminar esta propiedad?
                <x-paragraph>
                    Esto eliminará todas las deudas, pagos e información histórica relacionada con esta propiedad.
                    Esta acción no se puede deshacer.
                </x-paragraph>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmDelete', false)" wire:loading.attr="disabled">
                    Cancelar
                </x-secondary-button>

                <x-button class="ml-3" wire:click="deleteProperty()" wire:loading.attr="disabled">
                    Eliminar 
                </x-button>
            </x-slot>
        </x-jet-dialog-modal> 
    </div>

</x-card>
