<x-card>
    <x-title title="Ajustes generales" class="mb-4" />
    <form wire:submit.prevent='save'>
        <div class="flex flex-col space-y-4">
            <x-forms.input 
                wire:model="building_name"
                label="Nombre de la propiedad"
                type="text"
                placeholder="Ingresa el nombre"
                error-name="building_name"
            />

            <x-forms.textarea 
                wire:model="address"
                label="Dirección"
                rows="3"
                placeholder="Ingresa la dirección"
                error-name="address"
            />

            <x-forms.input 
                wire:model="building_number"
                label="Número"
                type="number"
                placeholder="Ingresa el número"
                error-name="building_number"
            />

            <x-forms.select label="Departamento" wire:model="departament_id">
                <option value="null" selected disabled >--Selecciona un departamento--</option>
                @foreach ($departaments as $departament)
                    <option value="{{ $departament->id }}">{{ $departament->name }}</option>
                @endforeach
            </x-forms.select>

            <x-forms.input 
                wire:model="email"
                label="Email"
                type="email"
                placeholder="Ingresa el email"
                error-name="email"
            />

            <x-forms.textarea 
                wire:model="welcome_message"
                label="Mensaje de bienvenida"
                rows="3"
                placeholder="Escribe un mensaje"
                error-name="welcome_message"
            />

            <x-forms.input 
                wire:model="application_logo_path"
                label="Logo"
                type="file"
                error-name="application_logo_path"
            />

        </div>
        
        <div class="mt-8 flex justify-end">
            <x-button>
                Actualizar
            </x-button>
        </div>
    </form>

    <x-notifications />
    
</x-card>
