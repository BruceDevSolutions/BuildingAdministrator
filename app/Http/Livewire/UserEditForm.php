<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Phone;
use Livewire\Component;
use App\Models\Departament;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;

class UserEditForm extends Component
{
    use PasswordValidationRules;

    public $user;
    public $user_object;
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
            'email' => ['required', 'email', 'max:70', Rule::unique('users','email')->ignore($this->user),],
            'password' => ['nullable', 'string', 'confirmed'],
            'phone' => ['nullable','string','max:20', 'min:7', Rule::unique('phones', 'phone')],
        ];
    }

    public function mount()
    {
        $this->user_object = User::select('id','first_name','last_name','ci','departament_id','email')->where('id',$this->user)->firstOrFail();

        $this->first_name = $this->user_object->first_name;
        $this->last_name = $this->user_object->last_name;
        $this->ci = $this->user_object->ci;
        $this->departament_id = $this->user_object->departament_id;
        $this->email = $this->user_object->email;

        $this->phones = $this->user_object->phones->toArray();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $validatedData = $this->validate();

        if($this->password){
            $validatedData['password'] = Hash::make($this->password);

            DB::table('users')->where('id', $this->user_object->id)->update(['remember_token' => null]);
            DB::table('sessions')->where('user_id', $this->user_object->id)->delete();
        }

        $this->user_object->update(array_filter($validatedData));

        if($this->phone){
            array_push($this->phones, ['phone' => $this->phone]);
        }

        if(isset($this->phones[0])){
            $this->user_object->phones()->delete();

            $this->user_object->phones()->createMany(array_filter($this->phones));
        }

        return redirect()->route('admin.users.index')->with('notify-saved', 'Usuario registrado satisfactoriamente.');

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

    public function render()
    {
        $departaments = Departament::all();

        return view('livewire.user-edit-form', compact('departaments'))->layoutData(['title' => 'Actualizar usuario']);
    }
}
