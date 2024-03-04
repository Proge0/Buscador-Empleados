<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index(){
    $users = User::all();
    return view('back.pages.auth.users', compact('users'));
    }

    public function deleteUser($id) {
        try {
            $delete_user = User::where('id',$id)->delete();

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function editUser(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'user_correo' => 'required',
            'user_contraseña' => 'required',
            'user_rol' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => $validator->errors()->toArray()
            ]);
        } else {
            try {
                if ($user = User::findOrFail($request->user_id)) {
                        $user->username = $request->user_name;
                        $user->email = $request->user_correo;
                        $user->password = Hash::make($request->user_password);
                        $user->rol = $request->user_rol;
                        $user->save();
                        return response()->json([
                            'success' => true,
                            'msg' => 'Usuario actualizado con exito',
                        ]);
                } else {
                    return response()->json([
                        'error' => false,
                        'msg' => 'No se encontró el usuario que desea actualizar.'
                    ]);
                }

            } catch (\Exception $e) {
                return response()->json([
                    'error' => false, 
                    'msg' => $e->getMessage()
                ]);
            }
        }
    }
}
