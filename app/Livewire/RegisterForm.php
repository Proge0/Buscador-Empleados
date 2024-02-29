<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class RegisterForm extends Component
{
    public $username;
    public $email;
    public $password;
    public $rol = 'USR';
    public $is_admin = false;

    public function createUser(){
        $this->validate([
            'username'=> ['required','string'],
            'email' => ['required','email','unique:users'],
            'password' => ['required','min:5'],
        ]);

        User::create([
            'username' => $this->username,
            'email'=> $this->email,
            'password'=> Hash::make($this->password),
            'rol' => $this->rol,
        ]);

        Session::flash('success', 'Usuario creado exitosamente.');
        return redirect()->route('auth.users');
    }
    
    public function updated($field)
    {
        if ($field == 'is_admin') {
            if ($this->is_admin) {
                $this->rol = 'ADM';
            } else {
                $this->rol = 'USR';
            }
        }
    }
    
    public function render(){
        return view('livewire.register-form');
    }
}
