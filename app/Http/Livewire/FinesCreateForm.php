<?php

namespace App\Http\Livewire;

use App\Models\Fine;
use Livewire\Component;
use App\Models\Property;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class FinesCreateForm extends Component
{
    public $concept;
    public $details;
    public $value;
    public $date;
    public $property_id;

    protected function rules()
    {
        return [
            'concept' => ['required', 'string','max:180'],
            'details' => ['nullable','min:10','max:3500'],
            'value' => ['required','max:6','regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',],
            'date' => ['required', 'date'],
            'property_id' => ['required','integer', Rule::exists('properties','id')]
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validatedData = $this->validate();
        $validatedData['user_id'] = Auth::user()->id;

        Fine::create($validatedData);

        return redirect()->route('properties.fines.index')->with('notify-saved', 'Multa registrada satisfactoriamente.');

    }

    public function render()
    {
        abort_unless(Gate::allows('crear_multa'), 403);

        $properties = Property::all();
        
        return view('livewire.fines-create-form', compact('properties'))->layoutData(['title' => 'Crear multa']);
    }
}
