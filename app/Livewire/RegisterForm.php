<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterForm extends Component
{
    // Variables públicas para el formulario de registro
    public $username;
    public $email;
    public $password;
    public $rol = 'USR';
    public $is_admin = false;

    // Método para crear un nuevo usuario
    public function createUser(){
        // Validación de campos del formulario de registro
        $this->validate([
            'username'=> ['required','string'],
            'email' => ['required','email','unique:users'],
            'password' => ['required','min:5'],
        ]);

        // Crea un nuevo usuario en la base de datos
        User::create([
            'username' => $this->username,
            'email'=> $this->email,
            'password'=> Hash::make($this->password),
            'rol' => $this->rol,
        ]);

        // Muestra un mensaje de éxito y redirige a la página de usuarios
        Session::flash('success', 'Usuario creado exitosamente.');
        return redirect()->route('auth.users');
    }
    
    // Método que se ejecuta cuando se actualiza el estado de la variable is_admin
    public function updated($field)
    {
        // Actualiza la variable rol según el estado de is_admin
        if ($field == 'is_admin') {
            if ($this->is_admin) {
                $this->rol = 'ADM';
            } else {
                $this->rol = 'USR';
            }
        }
    }
    
    // Método para renderizar la vista del formulario de registro
    public function render(){
        return view('livewire.register-form');
    }
}
