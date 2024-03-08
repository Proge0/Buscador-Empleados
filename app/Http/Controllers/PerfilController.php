<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    // Método para mostrar la vista del perfil del usuario
    public function miPerfil() {
        return view('back.pages.auth.miPerfil');
    }

    // Método para editar el perfil del usuario
    public function editarPerfil(Request $request)
    {
        // Obtiene el usuario autenticado
        $user = Auth::user();

        // Actualiza los campos del usuario con los valores proporcionados en el formulario
        $user->update([
            'username' => $request->input('nombreUsuario'),
            'email' => $request->input('correoUsuario'),
            'password' => Hash::make($request->input('contraseñaUsuario')), // Recuerda cambiar esto según tus necesidades
            'rol' => $request->input('rolUsuario'),
        ]);

        // Muestra un mensaje flash indicando que el perfil se ha actualizado correctamente
        session()->flash('perfil-actualizado', 'El perfil del usuario ha sido actualizado correctamente.');

        // Redirige de vuelta a la página anterior
        return redirect()->back();
    }
}
