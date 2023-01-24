<x-card>
    <x-title title="Registrar inmueble" class="mb-4" />
    <form wire:submit.prevent='save'>
        <div class="flex flex-col space-y-4">
            <x-forms.input 
                wire:model="code"
                label="Código de inmueble"
                type="text"
                placeholder="Código del inmueble (Por ejemplo 4C)"
                error-name="code"
            />

            <x-forms.textarea 
                wire:model="description"
                label="Descripción del inmueble"
                rows="3"
                placeholder="Ingresa una descripción"
                error-name="description"
            />

            <x-forms.input 
                wire:model="monthly_rate"
                label="Cuota mensual (Expensas)"
                type="Number"
                placeholder="Ingresa un monto"
                error-name="monthly_rate"
            />

            <x-forms.input 
                wire:model="area"
                label="Área del inmuble en metros cuadrados"
                type="number"
                Step=".01" 
                placeholder="Ingresa un monto"
                error-name="area"
            />

            <x-forms.select error_name="property_type" label="Tipo de inmueble" wire:model="property_type">
                <option value="null" selected disabled >--Selecciona un tipo--</option>
                <option value="1">Departamento</option>
                <option value="2">Local comercial</option>
            </x-forms.select>

        </div>
        <div class="mt-8 flex justify-end">
            <x-button>
                Registrar
            </x-button>
        </div>
    </form>
</x-card>