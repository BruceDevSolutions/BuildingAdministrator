<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Announcement;
use Illuminate\Validation\Rule;

class AnnouncementsEditForm extends Component
{
    public Announcement $announcement; 

    protected function rules()
    {
        return [
            'announcement.title' => ['required', 'string', 'min:3', 'max:90', Rule::unique('announcements','title')->ignore($this->announcement->id)],
            'announcement.description' => ['required', 'string', 'min:10', 'max:1500'],
            'announcement.status' => ['required', 'boolean'],
            'announcement.pinned' => ['required', 'boolean'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function edit(){
        $validatedData = $this->validate();

        $this->announcement->update($validatedData);

        return redirect()->route('announcements.index')->with('notify-saved', 'Anuncio editado satisfactoriamente.');
    }

    public function render()
    {
        return view('livewire.announcements-edit-form')->layoutData(['title' => 'Editar anuncio']);
    }
}
