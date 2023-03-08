<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class UsersIndex extends Component
{
    use WithPagination;

    public $search;
    public $confirmDelete;

    public function render()
    {
        abort_unless(Gate::allows('administrar_usuarios'), 403);

        $users = User::where('first_name','LIKE', '%'.$this->search.'%')->orWhere('last_name','LIKE', '%'.$this->search.'%')->orderBy('id', 'desc')->paginate(5);
        
        return view('livewire.users-index', compact('users'))->layoutData(['title' => 'Lista de usuarios']);
    }

        public function confirmDeleteUser($user)
    {
        $this->confirmDelete = $user;
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->confirmDelete);
        $user->phones()->delete();
        $user->delete();
        
        $this->reset(['confirmDelete']);

        session()->flash('notify-saved', 'Usuario eliminado satisfactoriamente');
    }

    public function cleanPage(){
        $this->resetPage();
    }
}
