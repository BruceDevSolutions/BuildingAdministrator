<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyShow extends Component
{
    use WithPagination;
    public Property $property;
    public $filter_by = 1;

    public function render()
    {   
        if($this->filter_by == 1){
            $expenses = $this->property->expenses()->orderBy('id','desc')->paginate(5);
        }
        elseif($this->filter_by == 2){
            $expenses = $this->property->paid_fines()->orderBy('id','desc')->paginate(5);
        }
        elseif($this->filter_by == 3){
            $expenses = $this->property->extraordinaryFees()
                ->orderBy('id','desc')
                ->paginate(5);
        }

        return view('livewire.property-show', compact('expenses'))->layoutData(['title' => 'Propiedad: '.$this->property->code.'']);
    }
}
