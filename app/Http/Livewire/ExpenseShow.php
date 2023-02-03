<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use Livewire\Component;

class ExpenseShow extends Component
{
    public Expense $expense;

    public function render()
    {
        return view('livewire.expense-show')->layoutData(['title' => 'Gasto']);
    }
}
