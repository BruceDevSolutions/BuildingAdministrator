<x-card>
    <x-title class="mb-8">Inmueble {{ $fine->property->code }}</x-title>

    <div class="mb-4">
        <x-title>Concepto:</x-title>
        <x-paragraph>{{ $fine->concept }}</x-paragraph>
    </div>

    <div class="mb-4">
        <x-title>Detalles:</x-title>
        <x-paragraph>{{ $fine->details }}</x-paragraph>
    </div>

    <div class="mb-4">
        <x-title>Monto:</x-title>
        <x-paragraph>{{ $fine->value }}</x-paragraph>
    </div>

    <div class="mb-4">
        <x-title class="mb-1">Estado:</x-title>
        @if($fine->status)
            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                Pagado
            </span>
            @else
            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                Pendiente
            </span>
        @endif
    </div>

    <div>
        <x-title>Fecha:</x-title>
        <x-paragraph>{{ $fine->date }}</x-paragraph>
    </div>
</x-card>