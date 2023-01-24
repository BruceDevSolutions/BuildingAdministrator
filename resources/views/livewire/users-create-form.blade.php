<x-card>
    <x-title title="Registrar inmueble" class="mb-4" />
    <form wire:submit.prevent='save'>
        <div class="flex flex-col space-y-4">
            <x-forms.input 
                wire:model="first_name"
                label="Nombres"
                type="text"
                placeholder="Ingresa los nombres"
                error-name="first_name"
            />

            <x-forms.input 
                wire:model="last_name"
                label="Apellidos"
                type="text"
                placeholder="Ingresa los apellidos"
                error-name="last_name"
            />

            <x-forms.input 
                wire:model="ci"
                label="Carnet de Identidad"
                type="text"
                placeholder="Ingresa el CI"
                error-name="ci"
            />

            <x-forms.select error-name="departament_id" label="Departamento" wire:model="departament_id">
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

            <div class="flex">
                <div class="w-full">
                    <x-forms.input 
                        wire:model="phone"
                        label="Teléfono de contacto"
                        type="tel"
                        placeholder="Ingresa un número de contacto"
                        error-name="phone"
                    />
                </div>

                <div class="flex-shrink-0 px-3 pt-12" wire:click="addNumber()">
                    <i title="Agregar número">
                        <svg class="w-6 h-6 cursor-pointer text-purple-500 hover:text-purple-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </i>
                </div>
            </div>
            
            @if(isset($phones[0]))
                <div>
                    <x-paragraph class="text-sm">Haz clic en un número para eliminarlo</x-paragraph>
                    @foreach ($phones as $tel)
                        <x-paragraph class="cursor-pointer" wire:click="deleteNumber({{ $loop->index }})" >{{ $tel['phone'] }} </x-paragraph>
                    @endforeach
                </div>
            @endif
            
            <x-forms.input 
                wire:model="password"
                label="Contraseña"
                type="password"
                placeholder="Ingresa la contraseña"
                error-name="password"
            />

            <x-forms.input 
                wire:model="password_confirmation"
                label="Confirmar contraseña"
                type="password"
                placeholder="Repite la contraseña"
                error-name="password_confirmation"
            />

        </div>

        <div class="mt-8 flex justify-end">
            <x-button>
                Registrar
            </x-button>
        </div>
    </form>
</x-card>
