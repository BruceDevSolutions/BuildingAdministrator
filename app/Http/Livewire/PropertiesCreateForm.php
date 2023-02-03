<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Property;
use Illuminate\Validation\Rule;

class PropertiesCreateForm extends Component
{
    public $code;
    public $description;
    public $monthly_rate;
    public $area;
    public $property_type = null;
    public $user_id;

    protected function rules()
    {
        return [
            'code' => ['required', 'string', 'max:10'],
            'description' => ['nullable','min:10','max:2500'],
            'monthly_rate' => ['required','max:6','regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',],
            'area' => ['required','max:8','regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',],
            'property_type' => ['required', 'integer', 'digits_between:1,2'],
            'user_id' => ['required','integer', Rule::exists('users','id')]
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validatedData = $this->validate();

        Property::create($validatedData);

        $this->emit('notify-saved');

        return redirect()->route('properties.index')->with('notify-saved', 'Propiedad registrada satisfactoriamente.');

    }

    public function render()
    {
        $users = User::all();
        
        return view('livewire.properties-create-form', compact('users'))->layoutData(['title' => 'Registrar inmueble']);
    }
}
