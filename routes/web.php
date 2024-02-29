<?php

use Illuminate\Support\Facades\Route;
use \App\http\Controllers\AuthController;
use \App\Http\Middleware\RedirectIfAuthenticated;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('inicio');
});


Route::fallback(function () {
    return redirect()->route('inicio');
});