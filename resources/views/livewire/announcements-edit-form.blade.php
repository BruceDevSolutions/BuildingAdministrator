<x-card>
    <x-title title="Editar anuncio" class="mb-4" />
    <form wire:submit.prevent='edit'>
        <x-forms.input 
            wire:model="announcement.title"
            label="Título"
            type="text"
            placeholder="Título del anuncio"
            error-name="announcement.title"
        />
        {{ $announcement->announcement }}
        <x-forms.textarea 
            wire:model="announcement.description"
            label="Anuncio"
            rows="3"
            placeholder="Descripción del anuncio"
            error-name="announcement.description"
        />
        
        <x-forms.radio-button-field title="¿Mostrar en inicio?" class="mt-8 mb-4" error-name="announcement.status">
            <x-forms.radio-button label="Si" name="status" value=1  wire:model="announcement.status" />
            <x-forms.radio-button label="No" name="status" value=0  wire:model="announcement.status" />
        </x-forms.radio-button-field>

        <x-forms.radio-button-field title="Anclado" error-name="announcement.pinned">
            <x-forms.radio-button label="Si" name="pinned" value="1"  wire:model="announcement.pinned" />
            <x-forms.radio-button label="No" name="pinned" value="0"  wire:model="announcement.pinned" />
        </x-forms.radio-button-field>

        <div class="mt-8 flex justify-end">
            <x-button>
                Actualizar
            </x-button>
        </div>
    </form>
</x-card>

