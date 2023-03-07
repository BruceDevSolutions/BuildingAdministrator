<?php

namespace App\Http\Livewire;

use App\Models\Expense;
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
    public $new_paid_month;
    public $last_paid;
    public $property;
    public $min_date;

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

    public function updatedTypeId()
    {
        $this->reset([
            'concept',
            'details',
            'value',
            'date',
            'vaucher_path',
            'property_fine_id',
            'property_fines',
            'fine_selected',
            'property_fee_id',
            'property_fees',
            'fee_selected',
            'property_expense_id',
            'paid_up_to',
            'names',
            'new_paid_month',
            'last_paid',
            'property',
        ]);
    }

    /* Expensa */
    public function updatedPropertyExpenseId($value)
    {
        if($this->property_expense_id){

            $this->property = Property::find($this->property_expense_id);
            
            $this->min_date = isset($this->property->expenses->last()->pivot) ? Carbon::parse($this->property->expenses->last()->pivot->paid_up_to)->addMonth()->isoFormat('YYYY-MM') : '';

            if($this->property){
                $property_code = $this->property->code;
                $this->value = $this->property->monthly_rate;
                $this->concept = "Pago de expensas del inmueble: $property_code";
                if($this->property->expenses->count()){
                    $this->last_paid = $this->property->expenses->last()->pivot->paid_up_to;
                    $this->new_paid_month = Carbon::parse($this->last_paid)->addMonth()->Format('F Y');
                    $this->details = "Pago de expensas del inmueble $property_code correspondiente hasta el mes de $this->new_paid_month";
                    $this->paid_up_to = Carbon::parse($this->last_paid)->addMonth()->isoFormat('YYYY-MM'); 
                }else{
                    $this->paid_up_to = '';
                }
            }
        }
    }

    public function updatedPaidUpTo()
    {
        if($this->property_expense_id){
            $property_code = $this->property->code;
            $this->new_paid_month = Carbon::parse($this->paid_up_to)->Format('F Y');
            $this->details = "Pago de expensas del inmueble $property_code correspondiente hasta el mes de $this->new_paid_month";

            if(isset($this->property->expenses->last()->pivot)){ 
                $old = Carbon::parse($this->property->expenses->last()->pivot->paid_up_to);
                $new = Carbon::parse($this->paid_up_to);

                $this->value = $this->property->monthly_rate * ($old->diffInMonths($new)+1);
            }
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
    
            $income->property_extraordinary_fee()
                ->attach(
                    [$this->property_fee_id => ['extraordinary_fee_id' => $this->fee_selected]]
                );

            $extraordinary_fee = ExtraordinaryFee::find($this->fee_selected); 
            
            if(!$extraordinary_fee->properties_pending->count()){
                $extraordinary_fee->update(['status' => true]);
            }
    
            return redirect()->route('finances.incomes.index')->with('notify-saved', 'Registro creado satisfactoriamente.');
    
        }else if($this->type_id == Income::CUOTA_EXTRAORDINARIA && !$this->fee_selected){
            session()->flash('notify-danger', 'Selecciona una cuota extraordinaria válida');
        }

        /* Pago de expensas */
        if($this->type_id == Income::EXPENSA && $this->property_expense_id){
            
            $validatedData['type'] = Income::EXPENSA;

            if($this->vaucher_path){
                $background_name = $this->vaucher_path->store('/incomes/vaucher', 'public');
                $validatedData['vaucher_path'] = $background_name;
            }

            $income = Income::create(array_filter($validatedData));
    
            $income->property_expense()->attach([$this->property_expense_id => ['names' => $this->names, 'paid_up_to' => Carbon::createFromFormat('Y-m', $this->paid_up_to)]]);
    
            return redirect()->route('finances.incomes.index')->with('notify-saved', 'Registro creado satisfactoriamente.');
    
        }else if($this->type_id == Income::EXPENSA && !$this->property_expense_id){
            session()->flash('notify-danger', 'Selecciona un inmueble válido');
        }
    }

    public function render()
    {
        $properties = Property::select('id', 'code')->get();

        return view('livewire.income-create-form', compact('properties'))->layoutData(['title' => 'Registrar ingreso']);
    }
}
