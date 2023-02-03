<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Livewire\Component;

class PropertyShow extends Component
{
    public Property $property;

    public function render()
    {
        return view('livewire.property-show')->layoutData(['title' => 'Propiedad: '.$this->property->code.'']);
    }
}
