<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Property;
use Illuminate\Validation\Rule;
use App\Models\ExtraordinaryFee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ExtraordinaryFeesCreateForm extends Component
{
    public $concept;
    public $details;
    public $value;
    public $date;
    public $properties_ids;

    protected function rules()
    {
        return [
            'concept' => ['required', 'string','max:180'],
            'details' => ['nullable','min:10','max:3500'],
            'value' => ['required','max:6','regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',],
            'date' => ['required', 'date'],
            'properties_ids' => ['required','array']
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

        $extraordinary_fee = ExtraordinaryFee::create($validatedData);
        $extraordinary_fee->properties()->attach($this->properties_ids);

        return redirect()->route('properties.extraordinary-fees.index')->with('notify-saved', 'Cuota extraordinaria registrada satisfactoriamente.');

    }

    public function render()
    {
        abort_unless(Gate::allows('crear_cuota'), 403);

        $properties = Property::all();

        return view('livewire.extraordinary-fees-create-form', compact('properties'))->layoutData(['title' => 'Registrar cuota extraordinaria']);
    }
}
