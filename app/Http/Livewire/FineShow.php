<?php

namespace App\Http\Livewire;

use App\Models\Fine;
use Livewire\Component;

class FineShow extends Component
{
    public Fine $fine;

    public function render()
    {
        return view('livewire.fine-show')->layoutData(['title' => 'Multa']);
    }
}
