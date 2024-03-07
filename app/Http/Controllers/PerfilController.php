<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function miPerfil() {
        return view('back.pages.auth.miPerfil');
    }

    
    public function editarPerfil(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'username' => $request->input('nombreUsuario'),
            'email' => $request->input('correoUsuario'),
            'password' => Hash::make($request->input('contraseñaUsuario')), // Recuerda cambiar esto según tus necesidades
            'rol' => $request->input('rolUsuario'),
        ]);
        session()->flash('perfil-actualizado', 'El perfil del usuario ha sido actualizado correctamente.');

        return redirect()->back();
    }
}
