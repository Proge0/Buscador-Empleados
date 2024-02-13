<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anexos;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request){
        $anexos = Anexos::all();
        $successMessage = session('success','Usuario Creado Exitosamente');

        return view("back.pages.home", compact('anexos', 'successMessage'));

    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('inicio');
    }
    public function indexInicio(){
        $anexos = Anexos::all();
        return view('back.pages.inicio', compact('anexos'));
    }

}

