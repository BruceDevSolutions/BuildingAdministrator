<?php

namespace App\Http\Livewire;

use App\Models\ExtraordinaryFee;
use Livewire\Component;

class ExtraordinaryFeeShow extends Component
{
    public ExtraordinaryFee $extraordinaryFee;

    public function render()
    {
        return view('livewire.extraordinary-fee-show')->layoutData(['title' => 'Cuota extraordinaria']);
    } 
}
