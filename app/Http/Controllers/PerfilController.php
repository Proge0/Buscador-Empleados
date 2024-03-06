<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function miPerfil() {
        return view('back.pages.auth.miPerfil');
    }
}
