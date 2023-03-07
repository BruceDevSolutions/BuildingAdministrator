<?php

namespace App\Http\Livewire;

use App\Models\Income;
use Livewire\Component;
use App\Models\Property;
use Livewire\WithPagination;
use App\Models\ExtraordinaryFee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IncomesIndex extends Component
{
    use WithPagination;
    public $search;
    public $confirmDelete;
    public $filter_by = null;

    public function confirmDeleteIncome($income)
    {
        $this->confirmDelete = $income;
    }

    public function deleteIncome()
    {
        $income = Income::findOrFail($this->confirmDelete);

        if($income->type == Income::EXPENSA){
            $income_property_id = $income->property_expense[0]->pivot->property_id;
            $last_income_id = Property::find($income_property_id)->expenses->last()->id;
            
            if($income->id < $last_income_id){
                session()->flash('notify-danger', 'Elimina los pagos de expensa más recientes relacionados con esta propiedad primero.');
                $this->reset(['confirmDelete']);
                return;
            }
        }

        if($income->created_at > now()->subMonth(1)){

            if($income->vaucher_path){
                Storage::disk('public')->delete($income->vaucher_path);
            } 

            /* Para revertir la multa */
            if($income->property_fine ?? false){
                $income->fine()->update(['status' => false]);
            }

            if($income->property_extraordinary_fee[0] ?? false){
                $property = $income->property_extraordinary_fee[0];

                $fee = DB::table('extraordinary_fee_property')->where('property_id', $property->id)->where('extraordinary_fee_id', $property->pivot->extraordinary_fee_id)->update(['status' => false]);
                
                if($income->property_extraordinary_fee[0]){
                    ExtraordinaryFee::find($income->property_extraordinary_fee[0]->pivot->extraordinary_fee_id)->update(['status' => false]);
                }
            }



            $income->delete();

            $this->reset(['confirmDelete']);

            session()->flash('notify-saved', 'Ingreso eliminado satisfactoriamente');

        }else{
            $this->reset(['confirmDelete']);

            session()->flash('notify-danger', 'No puedes eliminar un registro con más de un mes de antiguedad desde su registro.');
        }
    }

    public function render()
    {
        if($this->filter_by == 1)
            $incomes = Income::where('type', Income::MULTA)->where(function($query){
                return $query->where('date', 'LIKE', '%'.$this->search.'%')->orWhere('concept', 'LIKE', '%'.$this->search.'%');
            })->orderBy('id','desc')->paginate(5);
        elseif($this->filter_by == 2)
            $incomes = Income::where('type', Income::CUOTA_EXTRAORDINARIA)->where(function($query){
                return $query->where('date', 'LIKE', '%'.$this->search.'%')->orWhere('concept', 'LIKE', '%'.$this->search.'%');
            })->orderBy('id','desc')->paginate(5);
        elseif($this->filter_by == 3)
            $incomes = Income::where('default', false)->where('type', Income::EXPENSA)->where(function($query){
                return $query->where('date', 'LIKE', '%'.$this->search.'%')->orWhere('concept', 'LIKE', '%'.$this->search.'%');
            })->orderBy('id','desc')->paginate(5);
        else{
            $incomes = Income::where('default', false)->where(function($query){
                return $query->where('date', 'LIKE', '%'.$this->search.'%')->orWhere('concept', 'LIKE', '%'.$this->search.'%');
            })->orderBy('id','desc')->paginate(5);
        }

        return view('livewire.incomes-index', compact('incomes'))->layoutData(['title' => 'Ingresos del inmueble']);
    }

    public function cleanPage(){
        $this->resetPage();
    }
}
