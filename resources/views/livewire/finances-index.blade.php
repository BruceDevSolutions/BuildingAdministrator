<x-card>
    <x-title title="Finanzas" class="mb-4" />

    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-8 mb-4">
            <x-finance-card title="Ingresos totales" :money="$total_incomes[0]->total" />

            <x-finance-card title="Ingresos este mes" :money="$current_month_incomes[0]->total" />

            <x-finance-card title="Gastos este mes" :money="$current_month_expenses[0]->total" />

            <x-finance-card title="Efectivo disponible" :money="$amount_available" />

            <x-finance-card title="Inmuebles registrados" :value="$total_properties" icon-type="house" />

            <x-finance-card title="Departamentos" :value="$total_apartment_properties" icon-type="house" />
          
            <x-finance-card title="Locales comerciales" :value="$total_shop_properties" icon-type="house" />
          
            <x-finance-card title="Usuarios registrados" :value="$users_count" icon-type="users" />
    </div>

    <x-title title="Deudas de expensas" class="mb-4" />

    <x-searcher wire:keydown="cleanPage" wire:model="search"  placeholder="Buscar inmueble por identificador o código"  />

    <div class="container grid mx-auto">
        <div class="w-full overflow-hidden rounded-lg ring-1 ring-black ring-opacity-5">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-zinc-200 dark:text-gray-400 dark:bg-zinc-800">
                            <th class="px-4 py-3">Id</th>
                            <th class="px-4 py-3">Inmueble</th>
                            <th class="px-4 py-3">Cuota</th>
                            <th class="px-4 py-3">Tipo de inmueble</th>
                            <th class="px-4 py-3">Pagado hasta:</th>
                            <th class="px-4 py-3">Debe</th>
                            <th class="px-4 py-3">Debe (bs.)</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-zinc-100 divide-y dark:divide-gray-700 dark:bg-zinc-800">
                        @forelse ($properties as $property)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    {{ $property->id }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $property->code }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $property->monthly_rate }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($property->property_type == 1)
                                        Departamento
                                    @else
                                        Local comercial
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap xl:whitespace-normal">
                                    {{ isset($property->expenses->last()->pivot)  ? \Carbon\Carbon::parse($property->expenses->last()->pivot->paid_up_to)->Format('F Y') : '--' }}
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap">
                                    {{ isset($property->expenses->last()->pivot)  && $property->expenses->last()->pivot->paid_up_to < now() ? \Carbon\Carbon::parse($property->expenses->last()->pivot->paid_up_to)->diffInMonths(now()) : '--' }} meses.
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap">
                                    {{ isset($property->expenses->last()->pivot)  && $property->expenses->last()->pivot->paid_up_to < now() ? \Carbon\Carbon::parse($property->expenses->last()->pivot->paid_up_to)->diffInMonths(now()) * $property->monthly_rate : '--' }} Bs.
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('properties.show', $property) }}">
                                            <x-view-button />
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td colspan="8" class="py-6 text-center">
                                    Aún no hay registros de propiedades
                                </td>
                            </tr>
                        @endforelse 
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-zinc-200 sm:grid-cols-9 dark:text-gray-400 dark:bg-zinc-800">
                {{ $properties->links() }}
            </div>
        </div>
    </div>
</x-card>