<x-card>
    <x-title class="mb-8">Ingreso por 
            @if($income->type == 1)
                Multa
            @elseif ($income->type == 2)
                Cuota Extraordinaria
            @else
                Pago de Expensas
            @endif 
    </x-title>

    <div class="mb-4">
        <x-title>Concepto:</x-title>
        <x-paragraph>{{ $income->concept }}</x-paragraph>
    </div>

    <div class="mb-4">
        <x-title>Detalles:</x-title>
        <x-paragraph>{{ $income->details }}</x-paragraph>
    </div>

    <div class="mb-4">
        <x-title>Monto:</x-title>
        <x-paragraph>{{ $income->value }}</x-paragraph>
    </div>

    <div class="mb-4">
        <x-title>Fecha:</x-title>
        <x-paragraph>{{ $income->date }}</x-paragraph>
    </div>
    
    @if($income->type == 1)
        <div class="mb-4">
            <x-title>Inmueble:</x-title>
            <x-paragraph>{{ $income->property_fine[0]->code }}</x-paragraph>
        </div>
    @elseif($income->type == 2)
        <div class="mb-4">
            <x-title>Inmueble:</x-title>
            <x-paragraph>{{ $income->property_extraordinary_fee[0]->code }}</x-paragraph>
        </div>
    @endif
    
    <div>
        <x-title>Comprobante:</x-title>
        @if($income->vaucher_path)
            <img src="{{  Storage::url($income->vaucher_path) }}" alt="">
            @else
            <x-paragraph>Sin comprobante</x-paragraph>
        @endif
    </div>
</x-card>