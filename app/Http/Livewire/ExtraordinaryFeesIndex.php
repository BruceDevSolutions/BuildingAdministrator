<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Property;
use Livewire\WithPagination;
use App\Models\ExtraordinaryFee;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Builder;

class ExtraordinaryFeesIndex extends Component
{
    use WithPagination;
    public $search;
    public $orderBy = 'active';
    public $confirmDelete;

    public function confirmDeleteFine($fine)
    {
        $this->confirmDelete = $fine;
    }

    public function deleteFine()
    {
        abort_unless(Gate::allows('eliminar_cuota'), 403);

        $fine = ExtraordinaryFee::findOrFail($this->confirmDelete);

        if($fine->created_at > now()->subMonth(1)){

            $fine->delete();

            $this->reset(['confirmDelete']);
            

            session()->flash('notify-saved', 'Cuota extraordinaria eliminada satisfactoriamente');

        }else{
            $this->reset(['confirmDelete']);

            session()->flash('notify-danger', 'No puedes eliminar un registro con más de un mes de antiguedad.');
        }
    }

    public function render()
    {
        if($this->orderBy === 'active')
        {
            $fines = ExtraordinaryFee::where('status', false)->where(function($query){
                return  $query->where('concept','like','%'.$this->search.'%')->orwhereHas('properties', function (Builder $query) {
                    $query->where('code','like','%'.$this->search.'%');
                });
            })->orderBy('id','desc')->paginate(5);
        }else{
            $fines = ExtraordinaryFee::where('concept','like','%'.$this->search.'%')->orwhereHas('properties', function (Builder $query) {
                $query->where('code','like','%'.$this->search.'%');
            })->orderBy('id','desc')->paginate(5);
        }

        return view('livewire.extraordinary-fees-index', compact('fines'))->layoutData(['title' => 'Cuotas extraordinarias']);
    }

    public function cleanPage(){
        $this->resetPage();
    }
}
