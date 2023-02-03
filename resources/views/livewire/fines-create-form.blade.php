<x-card>
    <x-title title="Registrar inmueble" class="mb-4" />
    <form wire:submit.prevent='save'>
        <div class="flex flex-col space-y-4">
            <x-forms.input 
                wire:model="concept"
                label="Concepto"
                type="text"
                placeholder="Ingresa el concepto de la deuda"
                error-name="concept"
            />

            <x-forms.textarea 
                wire:model="details"
                label="Detalles adicionales"
                rows="3"
                placeholder="Ingresa detalles adicionales"
                error-name="details"
            />

            <x-forms.input 
                wire:model="value"
                label="Monto"
                type="Number"
                placeholder="Ingresa un monto"
                error-name="value"
            />

            <x-forms.input 
                wire:model="date"
                label="Fecha en que se aplicó la multa"
                type="date"
                error-name="date"
            />

            <x-forms.select error_name="property_id" label="Inmueble" wire:model="property_id">
                <option value="null" selected disabled >--Selecciona un inmueble--</option>
                @foreach ($properties as $property)
                    <option value="{{ $property->id }}">{{ $property->code }} </option>
                @endforeach
            </x-forms.select>

        </div>
        <div class="mt-8 flex justify-end">
            <x-button>
                Crear
            </x-button>
        </div>
    </form>
</x-card>
