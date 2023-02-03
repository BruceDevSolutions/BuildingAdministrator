<?php

namespace App\Http\Livewire;

use App\Models\Expense;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class ExpenseCreateForm extends Component
{
    use WithFileUploads;

    public $concept;
    public $details;
    public $value;
    public $date;
    public $vaucher_path;

    protected function rules()
    {
        return [
            'concept' => ['required', 'string','max:180'],
            'details' => ['nullable','min:10','max:3500'],
            'value' => ['required','max:6','regex:/^(([0-9]*)(\.([0-9]{0,2}+))?)$/',],
            'date' => ['required', 'date'],
            'vaucher_path' => ['nullable','mimes:jpg,png,pdf','max:3072'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validatedData = $this->validate();
        $validatedData['user_id'] = Auth::user()->id;

        if($this->vaucher_path){
            $background_name = $this->vaucher_path->store('/expenses/vaucher', 'public');
            $validatedData['vaucher_path'] = $background_name;
        }

        Expense::create(array_filter($validatedData));

        return redirect()->route('admin.expenses.index')->with('notify-saved', 'Registro creado satisfactoriamente.');

    }

    public function render()
    {
        return view('livewire.expense-create-form')->layoutData(['title' => 'Registrar gasto']);
    }
}
