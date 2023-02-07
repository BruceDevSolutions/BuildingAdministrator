<?php

namespace App\Http\Livewire;

use App\Models\Income;
use Livewire\Component;

class IncomeShow extends Component
{
    public Income $income;

    public function render()
    {
        return view('livewire.income-show')->layoutData(['title' => 'Ingreso']);
    }
}
