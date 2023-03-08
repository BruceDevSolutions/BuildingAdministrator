<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Property;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class PropertiesIndex extends Component
{
    use WithPagination;

    public $search;
    public $confirmDelete;

    public function render()
    {
        $properties = Property::where('code', 'LIKE', '%'.$this->search.'%')->orderBy('id','desc')->paginate(5);

        return view('livewire.properties-index', compact('properties'))->layoutData(['title' => 'Lista de propiedades']);
    }

    public function confirmDeleteProperty($announcement)
    {
        $this->confirmDelete = $announcement;
    }

    public function deleteProperty()
    {
        abort_unless(Gate::allows('eliminar_inmueble'), 403);

        $property = Property::findOrFail($this->confirmDelete);
        $property->delete();
        
        $this->reset(['confirmDelete']);

        session()->flash('notify-saved', 'Propiedad eliminada satisfactoriamente');
    }

    public function cleanPage(){
        $this->resetPage();
    }
}
