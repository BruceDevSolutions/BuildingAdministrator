<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ExpensesIndex extends Component
{
    use WithPagination;
    public $search;
    public $confirmDelete;

    public function confirmDeleteExpense($expense)
    {
        $this->confirmDelete = $expense;
    }

    public function deleteExpense()
    {
        $expense = Expense::findOrFail($this->confirmDelete);

        if($expense->date > now()->subMonth(1)){

            Storage::disk('public')->delete($expense->vaucher_path);


            $expense->delete();

            $this->reset(['confirmDelete']);

            session()->flash('notify-saved', 'Gasto eliminada satisfactoriamente');

        }else{
            $this->reset(['confirmDelete']);

            session()->flash('notify-danger', 'No puedes eliminar un registro con más de un mes de antiguedad.');
        }
    }

    public function render()
    {
        $expenses = Expense::where('date', 'LIKE', '%'.$this->search.'%')->orWhere('concept', 'LIKE', '%'.$this->search.'%')->orderBy('id','desc')->paginate(5);
        return view('livewire.expenses-index', compact('expenses'))->layoutData(['title' => 'Gastos del inmueble']);
    }

    public function cleanPage(){
        $this->resetPage();
    }
}
