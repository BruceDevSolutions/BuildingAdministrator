<x-card>
    <x-title title="Registrar gasto" class="mb-4" />
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
                label="Fecha "
                type="date"
                error-name="date"
            />

            <x-forms.input 
                wire:model="vaucher_path"
                label="Comprobante"
                type="file"
                error-name="vaucher_path"
            />

        </div>
        <div class="mt-8 flex justify-end">
            <x-button>
                Crear
            </x-button>
        </div>
    </form>
</x-card>
