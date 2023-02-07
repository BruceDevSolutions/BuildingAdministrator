<?php

namespace App\Http\Livewire;

use App\Models\Fine;
use App\Models\Income;
use Livewire\Component;
use App\Models\Property;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class IncomeCreateForm extends Component
{
    use WithFileUploads;

    public $concept;
    public $details;
    public $value;
    public $date;
    public $vaucher_path;
    public $type_id = null;
    public $property_fine_id;
    public $property_fines;
    public $fine_selected;

    protected function rules()
    {
        return [
            'concept' => ['required', 'string','max:180'],
            'details' => ['nullable','min:10','max:3500'],
            'value' => ['required','max:6','regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',],
            'date' => ['required', 'date'],
            'type_id' => ['required', 'in:1,2,3'],
            'vaucher_path' => ['nullable','mimes:jpg,png,pdf','max:3072'],
            'property_fine_id' => ['nullable', Rule::exists('properties','id')],
            'fine_selected' => ['nullable', Rule::exists('fines','id')],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedPropertyFineId()
    {
        if($this->property_fine_id){
            $this->property_fines = Property::findOrFail($this->property_fine_id)->fines_pendant ?? false;
        }
    }

    public function updatedFineSelected()
    {
        if($this->property_fines){
            if($this->fine_selected){
                $fine = Fine::findOrFail($this->fine_selected);
                $this->concept = "Pago por: $fine->concept";
                $this->value = $fine->value;
            }
        }
    }

    public function save()
    {
        $validatedData = $this->validate();
        $validatedData['user_id'] = Auth::user()->id;

        /* Multas */
        if($this->type_id == Income::MULTA && $this->fine_selected){
            $fine = Fine::findOrFail($this->fine_selected);

            $fine->update(['status' => true]);

            if($this->vaucher_path){
                $background_name = $this->vaucher_path->store('/incomes/vaucher', 'public');
                $validatedData['vaucher_path'] = $background_name;
            }

            $income = Income::create(array_filter($validatedData));
    
            $income->property_fine()->attach([$this->property_fine_id => ['fine_id' => $fine->id]]);
    
            return redirect()->route('finances.incomes.index')->with('notify-saved', 'Registro creado satisfactoriamente.');
    
        }else{
            session()->flash('notify-danger', 'Selecciona una multa válida');
        }

    }

    public function render()
    {
        $properties = Property::select('id', 'code')->get();

        return view('livewire.income-create-form', compact('properties'))->layoutData(['title' => 'Registrar ingreso']);
    }
}
