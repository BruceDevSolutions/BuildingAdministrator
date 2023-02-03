<x-card>
    <x-title class="mb-8">Gasto </x-title>

    <div class="mb-4">
        <x-title>Concepto:</x-title>
        <x-paragraph>{{ $expense->concept }}</x-paragraph>
    </div>

    <div class="mb-4">
        <x-title>Detalles:</x-title>
        <x-paragraph>{{ $expense->details }}</x-paragraph>
    </div>

    <div class="mb-4">
        <x-title>Monto:</x-title>
        <x-paragraph>{{ $expense->value }}</x-paragraph>
    </div>

    <div class="mb-4">
        <x-title>Fecha:</x-title>
        <x-paragraph>{{ $expense->date }}</x-paragraph>
    </div>

    <div>
        <x-title>Comprobante:</x-title>
        @if($expense->vaucher_path)
            <img src="{{  Storage::url($expense->vaucher_path) }}" alt="">
            @else
            <x-paragraph>Sin comprobante</x-paragraph>
        @endif
    </div>
</x-card>