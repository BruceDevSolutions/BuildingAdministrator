<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Announcement;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class AnnouncementsCreateForm extends Component
{
    public string $title;
    public string $description;
    public bool $status;
    public bool $pinned;

    protected function rules()
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:120', Rule::unique('announcements','title')],
            'description' => ['required', 'string', 'min:10', 'max:1500'],
            'status' => ['required', 'boolean'],
            'pinned' => ['required', 'boolean'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save(){
        $validatedData = $this->validate();

        Announcement::create($validatedData); 

        $this->emit('notify-saved');

        return redirect()->route('announcements.index')->with('notify-saved', 'Anuncio creado satisfactoriamente.');

    }

    public function render()
    {
        abort_unless(Gate::allows('administrar_anuncios'), 403);

        return view('livewire.announcements-create-form')->layoutData(['title' => 'Crear anuncio']);
    }
}
