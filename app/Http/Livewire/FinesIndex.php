<?php

namespace App\Http\Livewire;

use App\Models\Fine;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class FinesIndex extends Component
{
    use WithPagination;

    public $search;
    public $orderBy = 'pending';
    public $confirmDelete;
    public $changeStatus;

    public function render()
    {
        if($this->orderBy === 'pending')
        {
            $fines = Fine::where('status', false)->where(function($query){
                return $query->where('concept','like','%'.$this->search.'%')->orwhereHas('property', function (Builder $query) {
                    $query->where('code','like','%'.$this->search.'%');
                });
            })->orderBy('id','desc')->paginate(5);
        }else{
            $fines = Fine::where('concept','like','%'.$this->search.'%')->orwhereHas('property', function (Builder $query) {
                $query->where('code','like','%'.$this->search.'%');
            })->orderBy('id','desc')->paginate(5);
        }

        return view('livewire.fines-index', compact('fines'))->layoutData(['title' => 'Multas por inmueble']);
    }

    public function changeFineStatus($fine)
    {
        $this->changeStatus = $fine;
    }

    public function confirmChangeFineStatus()
    {
        $fine = Fine::findOrFail($this->changeStatus);

        if($fine->status){
            if($fine->date > now()->subMonth(1)){
                $fine->update([
                    'status' => false
                ]);
            }else{
                session()->flash('notify-danger', 'No puedes marcar como pendiente una multa con más de un mes de antiguedad.');
            }
        }else{
            $fine->update([
                'status' => true
            ]);
        }

        $this->reset(['changeStatus']);

        session()->flash('notify-saved', 'Estado cambiado satisfactoriamente');

    }

    public function confirmDeleteFine($fine)
    {
        $this->confirmDelete = $fine;
    }

    public function deleteFine()
    {
        $fine = Fine::findOrFail($this->confirmDelete);

        if($fine->date > now()->subMonth(1)){

            $fine->delete();

            $this->reset(['confirmDelete']);

            session()->flash('notify-saved', 'Multa eliminada satisfactoriamente');

        }else{
            $this->reset(['confirmDelete']);

            session()->flash('notify-danger', 'No puedes eliminar una multa con más de un mes de antiguedad.');
        }
    }

    public function cleanPage(){
        $this->resetPage();
    }
}
