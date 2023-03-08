<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Announcement;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class AnnouncementsIndex extends Component
{
    use WithPagination;

    public $search;
    public $confirmDelete;

    public function render()
    {
        abort_unless(Gate::allows('administrar_anuncios'), 403);

        $announcements = Announcement::where('title','LIKE', '%'.$this->search.'%')->orWhere('description','LIKE', '%'.$this->search.'%')->orderBy('id', 'desc')->paginate(5);
        
        return view('livewire.announcements-index', compact('announcements'))->layoutData(['title' => 'Lista de anuncios']);
    }

    public function confirmDeleteAnnouncement($announcement)
    {
        $this->confirmDelete = $announcement;
    }

    public function deleteAnnouncement()
    {
        $announcement = Announcement::findOrFail($this->confirmDelete);
        $announcement->delete();
        
        $this->reset(['confirmDelete']);

        session()->flash('notify-saved', 'Anuncio eliminado satisfactoriamente');
    }

    public function cleanPage(){
        $this->resetPage();
    }
}
