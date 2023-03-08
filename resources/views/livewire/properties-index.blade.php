<x-card>
    <div class="flex justify-end">
        @can('registrar_inmueble')
            <a href="{{ route('properties.create') }}">
                <x-button title="Nuevo" />
            </a>
        @endcan
    </div>

    <x-title title="Lista de propiedades registradas" class="mb-4"/>

    <x-searcher wire:keydown="cleanPage" wire:model="search"  placeholder="Buscar inmueble por identificador o código"  />

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
                            <th class="px-2 py-3 text-center w-min">Acciones</th>
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
                                    @foreach ($property->user->phones as $phone)
                                        <a href="{{'tel:+591'.$phone->phone }}">{{ $phone->phone }}</a>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    {{ $property->user->first_name }} {{ $property->user->last_name }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    {{ $property->monthly_rate }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap xl:whitespace-normal">
                                        @if($property->property_type == 1)
                                                Departamento
                                        @else
                                                Local Comercial
                                        @endif
                                </td>
                                <td class="px-2 py-3 w-min">
                                    <div class="flex items-center justify-center space-x-4 text-sm">
{{--                                         @can('editar_inmueble')
                                            <a href="{{ route('properties.edit', $property) }}">
                                                <x-edit-button />
                                            </a>
                                        @endcan --}}

                                        @can('eliminar_inmueble')
                                            <x-delete-button wire:click="confirmDeleteProperty({{ $property->id }})" />
                                        @endcan
                                        <a href="{{ route('properties.show', $property) }}">
                                            <x-view-button />
                                        </a>
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
