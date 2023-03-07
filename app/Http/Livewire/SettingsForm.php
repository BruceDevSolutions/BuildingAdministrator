<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;
use App\Models\Departament;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class SettingsForm extends Component
{
    use WithFileUploads;

    public $building_name;
    public $address;
    public $building_number;
    public $email;
    public $application_logo_path;
    public $welcome_message;
    public $departament_id;

    public function getSettingsProperty()
    {
        return Setting::first();
    }
    
    public function mount()
    {
        $this->building_name = isset($this->settings->building_name) ? $this->settings->building_name : '';
        $this->address = isset($this->settings->address) ? $this->settings->address : '';
        $this->building_number = isset($this->settings->building_number) ? $this->settings->building_number : '';
        $this->email = isset($this->settings->email) ? $this->settings->email : '';
        $this->application_logo_path = isset($this->settings->application_logo_path) ? $this->settings->application_logo_path : '';
        $this->welcome_message = isset($this->settings->welcome_message) ? $this->settings->welcome_message : '';
        $this->departament_id = isset($this->settings->departament_id) ? $this->settings->departament_id : null;
    }

    protected function rules()
    {
        return [
            'building_name' => ['required', 'string', 'min:3', 'max:120'],
            'address' => ['nullable', 'string', 'min:10', 'max:1500'],
            'building_number' => ['nullable', 'integer', 'max_digits:5'],
            'email' => ['nullable', 'email', 'max:70'],
            'application_logo_path' => ['nullable','mimes:jpg,png','max:3072'],
            'welcome_message' => ['nullable', 'string', 'min:10', 'max:1500'],
            'departament_id' => ['nullable', 'integer', Rule::exists('departaments', 'id')],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    

    public function render()
    {
        $departaments = Departament::all();

        return view('livewire.settings-form', compact('departaments'))->layoutData(['title' => 'Ajustes generales']);
    }

    public function save()
    {
        $validatedData = $this->validate();

        if($this->application_logo_path){
            if($this->settings->application_logo_path){
                Storage::disk('public')->delete($this->settings->application_logo_path);
            }

            $background_name = $this->application_logo_path->store('/settings/logo', 'public');
            $validatedData['application_logo_path'] = $background_name;

            $this->emit('refreshComponent');
        }

        $this->settings->update(array_filter($validatedData));

        session()->flash('notify-saved', 'Información actualizada satisfactoriamente');

    }
}
