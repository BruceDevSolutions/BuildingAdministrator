<x-card>
    <div class="flex justify-end">
        <a href="{{ route('admin.users.create') }}">
            <x-button title="Registrar usuario" />
        </a>
    </div>

    <x-title class="mb-4" title="Lista de usuarios"/>

    <x-searcher wire:keydown="cleanPage" wire:model="search" placeholder="Buscar usuario"  />

    <div class="container grid mx-auto">
        <div class="w-full overflow-hidden rounded-lg ring-1 ring-black ring-opacity-5">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-zinc-200 dark:text-gray-400 dark:bg-zinc-800">
                            <th class="px-4 py-3">Identificador</th>
                            <th class="px-4 py-3">Nombres</th>
                            <th class="px-4 py-3">CI</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Rol</th>
                            <th class="px-4 py-3">Contacto</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-zinc-100 divide-y dark:divide-gray-700 dark:bg-zinc-800">
                        @forelse ($users as $user)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    {{ $user->id }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap">
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap xl:whitespace-normal">
                                    {{ $user->ci }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    {{ $user->email }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @if($user->user_type == 1)
                                        Administrador
                                    @else
                                        Propietario
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap xl:whitespace-normal">
                                    @forelse ($user->phones as $phone)
                                        {{ $phone->phone }}
                                        @empty
                                        --
                                    @endforelse
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('admin.users.edit', $user) }}">
                                            <x-edit-button />
                                        </a>
                                        <x-delete-button wire:click="confirmDeleteUser({{ $user->id }})" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td colspan="7" class="py-6 text-center">
                                    A??n no hay registros de anuncios.
                                </td>
                            </tr>
                        @endforelse 
                    </tbody>
                </table>
            </div>
            <div class=" px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-zinc-200 sm:grid-cols-9 dark:text-gray-400 dark:bg-zinc-800">
                {{ $users->links() }}
            </div>
        </div>


        <x-notifications />

        <x-jet-dialog-modal wire:model="confirmDelete">
            <x-slot name="title">
                Eliminar Usuario
            </x-slot>

            <x-slot name="content">
                ??Est??s seguro de eliminar este usuario?
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmDelete', false)" wire:loading.attr="disabled">
                    Cancelar
                </x-secondary-button>

                <x-button class="ml-3" wire:click="deleteUser()" wire:loading.attr="disabled">
                    Eliminar 
                </x-button>
            </x-slot>
        </x-jet-dialog-modal> 
    </div>

</x-card>
