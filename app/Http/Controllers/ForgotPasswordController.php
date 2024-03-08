<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\response;

class ForgotPasswordController extends Controller
{
    /**
     * Muestra el formulario de recuperar de contraseña.
     *
     * @return response()
     */
    public function showForgetPasswordForm()
    {
        return view('back.pages.auth.forgot');
    }

    /**
     * Procesa el formulario de recuperar de contraseña y envía un correo electrónico con el token.
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        // Genera un token aleatorio de 64 caracteres
        $token = Str::random(64);

        // Inserta el correo electrónico y el token en la tabla de reset de contraseñas
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);

        // Envía un correo electrónico con el token al usuario
        Mail::send('email.forgotPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'Hemos enviado un correo con el link!');
    }

    /**
     * Muestra el formulario de restablecimiento de contraseña con el token proporcionado.
     *
     * @return response()
     */
    public function showResetPasswordForm($token) { 
        return view('back.pages.auth.forgotPasswordLink', ['token' => $token]);
    }

    /**
     * Procesa el formulario de restablecimiento de contraseña y actualiza la contraseña del usuario.
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        // Verifica si el token y el correo electrónico coinciden en la tabla de reset de contraseñas
        $updatePassword = DB::table('password_reset_tokens')
                            ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                            ])
                            ->first();

        // Si no hay coincidencia, devuelve un error
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Token inválido!');
        }

        // Actualiza la contraseña del usuario en la base de datos
        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        // Elimina el registro de token de reset de contraseñas asociado al correo electrónico
        DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();

        return redirect('/login')->with('message', 'Tu contraseña ha sido cambiada');
    }
}