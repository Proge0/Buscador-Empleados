<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class LoginForm extends Component
{

    public $login_id, $password;
    public function LoginHandler(){
        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if($fieldType == 'email'){
            $this->validate([
                'login_id'=>'required|email|exists:users,email',
                'password'=>'required|min:5',
            ],[
                'login_id'=>'Debe ingresar correo o usuario',
                'login_id.email'=>'Dirección de corre invalida',
                'login_id.exists'=>'El correo no esta registrado',
                'password.required'=>'Ingrese la contraseña'
            ]);
        } else {
            $this->validate([
                'login_id'=> 'required|exists:users,username',
                'password'=>'required|min:5'
            ],[
                'login_id.required'=> 'Debe ingresar correo o usuario',
                'login_id.exists'=>'Usuario no esta registrado',
                'password.required'=>'Ingrese la contraseña'
            ]);
        }

        $creds = array($fieldType=>$this->login_id,'password'=>$this->password);

    if( Auth::guard('web')->attempt($creds)) {
        $checkUser = User::where($fieldType, $this->login_id)->first();

        return redirect()->route('auth.home');
    } else {
        session()->flash('fail','Usuario o contraseña incorrectos');
    }
}
    public function render()
    {
        return view('livewire.login-form');
    }
}

