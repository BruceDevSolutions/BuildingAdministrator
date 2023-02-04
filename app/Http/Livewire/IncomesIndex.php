<?php

namespace App\Http\Livewire;

use App\Models\Income;
use Livewire\Component;
use Livewire\WithPagination;
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

        if($income->date > now()->subMonth(1)){

            if($income->vaucher_path){
                Storage::disk('public')->delete($income->vaucher_path);
            }

            $income->delete();

            $this->reset(['confirmDelete']);

            session()->flash('notify-saved', 'Ingreso eliminado satisfactoriamente');

        }else{
            $this->reset(['confirmDelete']);

            session()->flash('notify-danger', 'No puedes eliminar un registro con más de un mes de antiguedad.');
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
            $incomes = Income::where('type', Income::EXPENSA)->where(function($query){
                return $query->where('date', 'LIKE', '%'.$this->search.'%')->orWhere('concept', 'LIKE', '%'.$this->search.'%');
            })->orderBy('id','desc')->paginate(5);
        else{
            $incomes = Income::where('date', 'LIKE', '%'.$this->search.'%')->orWhere('concept', 'LIKE', '%'.$this->search.'%')->orderBy('id','desc')->paginate(5);
        }

        return view('livewire.incomes-index', compact('incomes'))->layoutData(['title' => 'Ingresos del inmueble']);
    }

    public function cleanPage(){
        $this->resetPage();
    }
}
