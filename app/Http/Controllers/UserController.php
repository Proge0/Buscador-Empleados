<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index()
{
    $users = User::all(); // Suponiendo que estás utilizando el modelo User y que tienes una tabla llamada 'users' en tu base de datos
    return view('back.pages.auth.users', compact('users'));
}
}
