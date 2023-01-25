<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Departament;
use Illuminate\Validation\Rule;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersCreateForm extends Component
{
    use PasswordValidationRules;

    public $first_name;
    public $last_name;
    public $ci;
    public $departament_id;
    public $email;
    public $password;
    public $password_confirmation;
    public $phone;
    public $phones = [];

    protected function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'ci' => ['required','string','max:12'],
            'departament_id' => ['required','integer',Rule::exists('departaments', 'id')],
            'email' => ['required', 'email', 'max:70', Rule::unique('users','email')],
            'password' => $this->passwordRules(),
            'phone' => ['nullable','string','max:20', 'min:7', Rule::unique('phones', 'phone')],
        ];
    }

    public function addNumber()
    {
        $this->validate([
            'phone' => ['nullable','string','max:20', 'min:7', Rule::unique('phones', 'phone')],
        ]);

        array_push($this->phones, ['phone' => $this->phone]);
        $this->phone = null;
    }

    public function deleteNumber($number)
    {
        array_splice($this->phones, $number, 1);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validatedData = $this->validate();
        $validatedData['password'] = Hash::make($this->password);

        $user = User::create($validatedData);

        if($this->phone){
            array_push($this->phones, ['phone' => $this->phone]);
        }

        if(isset($this->phones[0])){
            $user->phones()->createMany(array_filter($this->phones));
        }

        return redirect()->route('admin.users.index')->with('notify-saved', 'Usuario registrado satisfactoriamente.');

    }

    public function render()
    {
        $departaments = Departament::all();
        
        return view('livewire.users-create-form', compact('departaments'))->layoutData(['title' => 'Registrar usuario']);
    }
}
