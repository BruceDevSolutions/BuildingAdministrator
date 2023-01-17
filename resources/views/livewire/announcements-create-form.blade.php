<x-card>
    <x-title title="Crear anuncio" class="mb-4" />
    <form wire:submit.prevent='save'>
        <x-forms.input 
            wire:model="title"
            label="Título"
            type="text"
            placeholder="Título del anuncio"
            error-name="title"
        />

        <x-forms.textarea 
            wire:model="description"
            label="Anuncio"
            rows="3"
            placeholder="Descripción del anuncio"
            error-name="description"
        />
        
        <x-forms.radio-button-field title="¿Mostrar en inicio?" class="mt-8 mb-4" wire:model="status" error-name="status">
            <x-forms.radio-button label="Si" name="status" value="1" />
            <x-forms.radio-button label="No" name="status" value="0" />
        </x-forms.radio-button-field>

        <x-forms.radio-button-field title="Anclado" wire:model="pinned" error-name="pinned">
            <x-forms.radio-button label="Si" name="pinned" value="1" />
            <x-forms.radio-button label="No" name="pinned" value="0" />
        </x-forms.radio-button-field>

        <div class="mt-8 flex justify-end">
            <x-button>
                Crear
            </x-button>
        </div>
    </form>
</x-card>

