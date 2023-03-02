<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Fine;
use App\Models\Income;
use Livewire\Component;
use App\Models\Property;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Models\ExtraordinaryFee;
use Illuminate\Support\Facades\DB;
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

    /* Multas */
    public $property_fine_id;
    public $property_fines;
    public $fine_selected;

    /* Cuotas extraordinarias */
    public $property_fee_id;
    public $property_fees;
    public $fee_selected;

    /* Expensas */
    public $property_expense_id;
    public $paid_up_to;
    public $names;

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
            'property_expense_id' => ['nullable', Rule::exists('properties','id')],
            'property_fee_id' => ['nullable', Rule::exists('properties','id')],
            'fine_selected' => ['nullable', Rule::exists('fines','id')],
            'fee_selected' => ['nullable', Rule::exists('fines','id')],
            'names' => $this->type_id === Income::EXPENSA ? [ 'required', 'min:3'] : [],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /* Expensa */
    public function updatedPropertyExpenseId($value)
    {
        $this->value = Property::find($this->property_expense_id)->monthly_rate;

        if(Property::find($this->property_expense_id)->expenses->count()){
            $this->paid_up_to = Carbon::parse(Property::find($this->property_expense_id)->expenses->first()->pivot->paid_up_to)->addMonth()->isoFormat('YYYY-MM'); 
        }else{
            $this->paid_up_to = '';
        }
    }

    public function updatedPropertyFeeId()
    {
        if($this->property_fee_id){
            $this->property_fees = Property::findOrFail($this->property_fee_id)->fees_pendant ?? false;
        }
    }

    public function updatedFeeSelected()
    {
        if($this->property_fees){
            if($this->fee_selected){
                $fee = ExtraordinaryFee::findOrFail($this->fee_selected);
                $this->concept = "Pago por: $fee->concept";
                $this->value = $fee->value;
            }
        }
    }

    /* Multas */
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
    
        }else if($this->type_id == Income::MULTA && !$this->fine_selected){
            session()->flash('notify-danger', 'Selecciona una multa válida');
        }

        /* Cuotas extraordinarias */
        if($this->type_id == Income::CUOTA_EXTRAORDINARIA && $this->fee_selected){
            DB::table('extraordinary_fee_property')->where('property_id', $this->property_fee_id)->where('extraordinary_fee_id', $this->fee_selected)->update(['status' => true]);

            $validatedData['type'] = Income::CUOTA_EXTRAORDINARIA;

            if($this->vaucher_path){
                $background_name = $this->vaucher_path->store('/incomes/vaucher', 'public');
                $validatedData['vaucher_path'] = $background_name;
            }

            $income = Income::create(array_filter($validatedData));
    
            $income->property_extraordinary_fee()->attach([$this->property_fee_id => ['extraordinary_fee_id' => $this->fee_selected]]);
    
            return redirect()->route('finances.incomes.index')->with('notify-saved', 'Registro creado satisfactoriamente.');
    
        }else if($this->type_id == Income::CUOTA_EXTRAORDINARIA && !$this->fee_selected){
            session()->flash('notify-danger', 'Selecciona una cuota extraordinaria válida');
        }

        /* Pago de expensas */
        if($this->type_id == Income::EXPENSA){
            
            $validatedData['type'] = Income::EXPENSA;

        /*     $fee->update(['status' => true]); */

            if($this->vaucher_path){
                $background_name = $this->vaucher_path->store('/incomes/vaucher', 'public');
                $validatedData['vaucher_path'] = $background_name;
            }

            $income = Income::create(array_filter($validatedData));
    
            $income->property_extraordinary_fee()->attach([$this->property_fee_id => ['extraordinary_fee_id' => $this->fee_selected]]);
    
            return redirect()->route('finances.incomes.index')->with('notify-saved', 'Registro creado satisfactoriamente.');
    
        }else if($this->type_id == Income::CUOTA_EXTRAORDINARIA && !$this->fee_selected){
            session()->flash('notify-danger', 'Selecciona una cuota extraordinaria válida');
        }

    }

    public function render()
    {
        $properties = Property::select('id', 'code')->get();

        return view('livewire.income-create-form', compact('properties'))->layoutData(['title' => 'Registrar ingreso']);
    }
}
