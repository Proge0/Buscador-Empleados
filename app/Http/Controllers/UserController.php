<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Método para mostrar la vista con todos los usuarios
    public function index(){
        $users = User::all();
        return view('back.pages.auth.users', compact('users'));
    }

    // Método para eliminar un usuario
    public function deleteUser($id) {
        try {
            // Elimina el usuario con el ID proporcionado
            $delete_user = User::where('id',$id)->delete();
        } catch (\Exception $e) {
            // Devuelve una respuesta JSON con un mensaje de error si hay una excepción
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    // Método para editar un usuario
    public function editUser(Request $request)
    {
        // Validación de los campos del formulario de edición
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'user_correo' => 'required',
            'user_contraseña' => 'required',
            'user_rol' => 'required',
        ]);

        // Verifica si la validación falla y devuelve los errores en formato JSON
        if ($validator->fails()) {
            return response()->json([
                'msg' => $validator->errors()->toArray()
            ]);
        } else {
            try {
                // Busca el usuario por ID
                if ($user = User::findOrFail($request->user_id)) {
                    // Actualiza los campos del usuario con los nuevos valores
                    $user->username = $request->user_name;
                    $user->email = $request->user_correo;
                    $user->password = Hash::make($request->user_password);
                    $user->rol = $request->user_rol;
                    $user->save();
                    
                    // Devuelve una respuesta JSON indicando que el usuario se ha actualizado con éxito
                    return response()->json([
                        'success' => true,
                        'msg' => 'Usuario actualizado con exito',
                    ]);
                } else {
                    // Devuelve una respuesta JSON indicando que no se encontró el usuario a actualizar
                    return response()->json([
                        'error' => false,
                        'msg' => 'No se encontró el usuario que desea actualizar.'
                    ]);
                }

            } catch (\Exception $e) {
                // Devuelve una respuesta JSON con un mensaje de error si hay una excepción
                return response()->json([
                    'error' => false, 
                    'msg' => $e->getMessage()
                ]);
            }
        }
    }
}
