<x-card>
    <x-title title="Propiedad {{ $property->code }} " class="mb-4"/>

        <div class="mb-4">
            <x-title>Descripción:</x-title>
            <x-paragraph>{{ $property->description }}</x-paragraph>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="mb-4">
                <x-title>Cuota de expensas:</x-title>
                <x-paragraph>{{ $property->monthly_rate }}</x-paragraph>
            </div>

            <div class="mb-4">
                <x-title>Pagado hasta:</x-title>
                <x-paragraph>{{ isset($property->expenses->last()->pivot)  ? \Carbon\Carbon::parse($property->expenses->last()->pivot->paid_up_to)->Format('F Y') : '--' }}</x-paragraph>
            </div>
        
            <div class="mb-4">
                <x-title>Superficie:</x-title>
                <x-paragraph>{{ $property->area }} m<sup>2</sup> </x-paragraph>
            </div>

            <div class="mb-4">
                <x-title>Tipo de propiedad:</x-title>
                @if($property->property_type == 1)
                    <x-paragraph>Departamento</x-paragraph>
                @else
                    <x-paragraph>Local comercial</x-paragraph>
                @endif
            </div>

            <div class="mb-4">
                <x-title>Residente/Contacto principal:</x-title>
                <x-paragraph>{{ $property->user->first_name }} {{ $property->user->last_name }}</x-paragraph>
            </div>

            <div class="mb-4">
                <x-title>Número(s) de contacto:</x-title>
                @foreach ($property->user->phones as $phone)
                    <x-paragraph>
                        <a href="{{'tel:'.$phone->phone }}">{{ $phone->phone }}</a>
                    </x-paragraph>
                @endforeach
            </div>

            <div class="mb-4">
                <x-title>Email:</x-title>
                <x-paragraph>{{ $property->user->email }}</x-paragraph>
            </div>

            <div class="mb-4">
                <x-title>Debe:</x-title>
                <x-paragraph>{{ isset($property->expenses->last()->pivot)  && $property->expenses->last()->pivot->paid_up_to < now() ? \Carbon\Carbon::parse($property->expenses->last()->pivot->paid_up_to)->diffInMonths(now()) : '--' }} meses. - {{ isset($property->expenses->last()->pivot)  && $property->expenses->last()->pivot->paid_up_to < now() ? \Carbon\Carbon::parse($property->expenses->last()->pivot->paid_up_to)->diffInMonths(now()) * $property->monthly_rate : '--' }} Bs. </x-paragraph>
            </div>
        </div>

        <x-title title="Historial de pagos" class="my-4 text-center" />

        <div class="my-4 w-48">
            <x-forms.select label="Filtrar por:" wire:model="filter_by">
                <option value="1">Pago de expensas</option>
                <option value="2">Multas</option>
                <option value="3">Cuotas extraordinarias</option>
            </x-forms.select>
        </div>

        <div class="container grid mx-auto">
            <div class="w-full overflow-hidden rounded-lg ring-1 ring-black ring-opacity-5">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-zinc-200 dark:text-gray-400 dark:bg-zinc-800">
                                <th class="px-4 py-3">Id</th>
                                <th class="px-4 py-3">Monto</th>
                                <th class="px-4 py-3">Concepto</th>
                                <th class="px-4 py-3">Detalles:</th>
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
                                    <td class="px-4 py-3 text-sm">
                                        {{ $expense->value }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        {{ $expense->concept }}
                                    </td>
                                    <td class="px-4 py-3 text-sm whitespace-nowrap lg:whitespace-normal">
                                        {{ Str::limit($expense->details, 120, '...') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                                        {{ $expense->date }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-4 text-sm">
                                            @if($filter_by == 1)
                                                <a href="{{ route('finances.incomes.show', $expense->id) }}">
                                                    <x-view-button />
                                                </a>
                                            @elseif ($filter_by == 2)
                                                <a href="{{ route('finances.incomes.show', $expense->income[0]->id) }}">
                                                    <x-view-button />
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td colspan="8" class="py-6 text-center">
                                        Aún no hay registros que coincidan con su búsqueda
                                    </td>
                                </tr>
                            @endforelse 
                        </tbody>
                    </table>
                </div>
                <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-zinc-200 sm:grid-cols-9 dark:text-gray-400 dark:bg-zinc-800">
                    {{ $expenses->links() }}
                </div>
            </div>
        </div>
</x-card>

