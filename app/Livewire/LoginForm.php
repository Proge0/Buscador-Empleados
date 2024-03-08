<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class LoginForm extends Component
{
    // Variables públicas para el formulario de inicio de sesión
    public $login_id, $password;

    // Método para manejar la lógica de inicio de sesión
    public function LoginHandler(){
        // Determina el tipo de campo (email o username) ingresado por el usuario
        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Validación de campos dependiendo del tipo de campo ingresado
        if($fieldType == 'email'){
            $this->validate([
                'login_id'=>'required|email|exists:users,email',
                'password'=>'required|min:5',
            ],[
                'login_id'=>'Debe ingresar correo o usuario',
                'login_id.email'=>'Dirección de correo inválida',
                'login_id.exists'=>'El correo no está registrado',
                'password.required'=>'Ingrese la contraseña'
            ]);
        } else {
            $this->validate([
                'login_id'=> 'required|exists:users,username',
                'password'=>'required|min:5'
            ],[
                'login_id.required'=> 'Debe ingresar correo o usuario',
                'login_id.exists'=>'Usuario no está registrado',
                'password.required'=>'Ingrese la contraseña'
            ]);
        }

        // Credenciales para intentar el inicio de sesión
        $creds = array($fieldType=>$this->login_id,'password'=>$this->password);

        // Intenta autenticar al usuario con las credenciales proporcionadas
        if( Auth::guard('web')->attempt($creds)) {
            // Verifica si el usuario está autenticado y redirige a la página de inicio
            $checkUser = User::where($fieldType, $this->login_id)->first();
            return redirect()->route('auth.home');
        } else {
            // Muestra un mensaje de error si las credenciales son incorrectas
            session()->flash('fail','Usuario o contraseña incorrectos');
        }
    }

    // Método para renderizar la vista del formulario de inicio de sesión
    public function render()
    {
        return view('livewire.login-form');
    }
}
