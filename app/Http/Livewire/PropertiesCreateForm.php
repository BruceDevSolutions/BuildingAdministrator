<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Income;
use Livewire\Component;
use App\Models\Property;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PropertiesCreateForm extends Component
{
    public $code;
    public $description;
    public $monthly_rate;
    public $area;
    public $property_type = null;
    public $user_id;
    public $paid_up_to;

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

        $property = Property::create($validatedData);

        $income = Income::create([
            'concept' => 'Ingreso default al crear inmueble',
            'value' => 0,
            'date' => now(),
            'type' => Income::EXPENSA,
            'user_id' => Auth::user()->id,
            'default' => true,
        ]);

        $income->property_expense()
            ->attach([$property->id => ['names' => $this->code, 'paid_up_to' => Carbon::createFromFormat('Y-m', $this->paid_up_to)]]);

        $this->emit('notify-saved');

        return redirect()->route('properties.index')->with('notify-saved', 'Propiedad registrada satisfactoriamente.');

    }

    public function render()
    {
        abort_unless(Gate::allows('registrar_inmueble'), 403);

        $users = User::all();
        
        return view('livewire.properties-create-form', compact('users'))->layoutData(['title' => 'Registrar inmueble']);
    }
}
