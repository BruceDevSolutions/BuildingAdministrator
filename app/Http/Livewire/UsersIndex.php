<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        $users = User::where('first_name','LIKE', '%'.$this->search.'%')->orWhere('last_name','LIKE', '%'.$this->search.'%')->orderBy('id', 'desc')->paginate(5);
        
        return view('livewire.users-index', compact('users'))->layoutData(['title' => 'Lista de anuncios']);
    }
}
