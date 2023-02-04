<x-card>
    <div class="flex justify-end">
        <a href="{{ route('finances.expenses.create') }}">
            <x-button title="Nuevo" />
        </a>
    </div>
    
    <x-title class="mb-4" title="Gastos del edificio"/>

    <x-searcher wire:keydown="cleanPage" wire:model="search"  placeholder="Buscar gasto por concepto o fecha" />

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
                            <th class="px-4 py-3">Comprobante</th>
                            <th class="px-4 py-3">Fecha</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-zinc-100 divide-y dark:divide-gray-700 dark:bg-zinc-800">
                        @forelse ($expenses as $expense)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    {{ $expense->id }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap">
                                    {{ $expense->concept }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap xl:whitespace-normal">
                                    {{ Str::limit($expense->details, 150, '...')  }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap">
                                    {{ $expense->value }} Bs.
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap flex justify-centerweb ">
                                    @if($expense->vaucher_path)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap">
                                    {{ $expense->date }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <x-delete-button wire:click="confirmDeleteExpense({{ $expense->id }})" />
                                        <a href="{{ route('finances.expenses.show', $expense->id) }}">
                                            <x-view-button />
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td colspan="8" class="py-6 text-center">
                                    Aún no hay registros de gastos.
                                </td>
                            </tr>
                        @endforelse 
                    </tbody>
                </table>
            </div>
            <div class=" px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-zinc-200 sm:grid-cols-9 dark:text-gray-400 dark:bg-zinc-800">
                {{ $expenses->links() }}
            </div>
        </div>

        <x-notifications />

        {{-- Modal de eliminación --}}
        <x-jet-dialog-modal wire:model="confirmDelete">
            <x-slot name="title">
                Eliminar registro
            </x-slot>

            <x-slot name="content">
                ¿Estás seguro de eliminar este registro?
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmDelete', false)" wire:loading.attr="disabled">
                    Cancelar
                </x-secondary-button>

                <x-button class="ml-3" wire:click="deleteExpense()" wire:loading.attr="disabled">
                    Eliminar 
                </x-button>
            </x-slot>
        </x-jet-dialog-modal> 
    </div>

</x-card>