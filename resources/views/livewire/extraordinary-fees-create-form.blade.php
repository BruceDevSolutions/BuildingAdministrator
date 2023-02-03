<x-card>
    <x-title title="Registrar cuota extraordinaria" class="mb-4" />
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

            <div wire:ignore>
                <x-forms.select class="select2" label="Inmueble(es)"  name="properties[]" multiple="multiple" >
                    @foreach ($properties as $property)
                        <option value="{{ $property->id }}">{{ $property->code }} </option>
                    @endforeach
                </x-forms.select>
            </div>
            @error('properties_ids')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="mt-8 flex justify-end">
            <x-button>
                Registrar
            </x-button>
        </div>
    </form>
</x-card>
@push('js')
<script 
src="https://code.jquery.com/jquery-3.6.3.min.js"
integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" ></script>

        <script>
            document.addEventListener('livewire:load', function(){
                $('.select2').select2();
                $('.select2').on('change', function(){
                    @this.set('properties_ids', $(this).val());
                });
            });
        </script>
@endpush