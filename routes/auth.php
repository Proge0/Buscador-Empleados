<?php

use App\Livewire\RegisterForm;
use Illuminate\Support\Facades\Route;
use \App\http\Controllers\AuthController;
use \App\http\Controllers\UserController;
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


Route::prefix('auth')->name('auth.')->group(function () { 

    Route::middleware(['guest:web'])->group(function () { 
        Route::view('/login','back.pages.auth.login')->name('login');
        Route::view('/forgot-password','back.pages.auth.forgot')->name('forgot-password');
    });

    Route::middleware(['auth:web.check'])->group(function () {
        Route::match(['get','post'],'/home',[AuthController::class,'index'])->name('home');
        Route::get('/users',[UserController::class,'index'])->name('users')->middleware('role:ADM');
        Route::post('/agregar_anexo', [AuthController::class,'create'])->name('create');
        Route::post('/logout',[AuthController::class,'logout'])->name('logout');
        Route::view('/register','back.pages.auth.register')->name('register')->middleware('role:ADM');
        Route::get('delete/anexo/{id}',[AuthController::class,'deleteAnexo'])->name('deleteAnexo');
        Route::match(['get','post'],'/edit/anexo',[AuthController::class,'editAnexo'])->name('editAnexo');
        Route::get('/agregar_empleado', [AuthController::class,'addEmpleados'])->name('addEmpleados');
    });

});

Route::get('/inicio',[AuthController::class,'indexInicio'])->name('inicio');