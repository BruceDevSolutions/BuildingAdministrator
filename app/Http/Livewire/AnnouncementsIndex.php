<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Announcement;
use Livewire\WithPagination;

class AnnouncementsIndex extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        $announcements = Announcement::where('title','LIKE', '%'.$this->search.'%')->orWhere('announcement','LIKE', '%'.$this->search.'%')->paginate(1);
        
        return view('livewire.announcements-index', compact('announcements'))->layoutData(['title' => 'Lista de anuncios']);
    }
}
