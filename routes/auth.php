<?php

use App\Http\Controllers\CSVImportController;
use App\Livewire\RegisterForm;
use Illuminate\Support\Facades\Route;
use \App\http\Controllers\AuthController;
use \App\http\Controllers\PerfilController;
use \App\http\Controllers\UserController;
use \App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\ForgotPasswordController;

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
        Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forgot.password.get');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forgot.password.post'); 
        Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
        Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    });

    Route::middleware(['auth:web.check'])->group(function () {
        Route::get('/home',[AuthController::class,'index'])->name('home');
        Route::post('/listar-anexo',[AuthController::class,'listarAnexo'])->name('listar.anexo');
        Route::get('/users',[UserController::class,'index'])->name('users')->middleware('role:ADM');
        Route::post('/agregar_anexo', [AuthController::class,'create'])->name('create');
        Route::post('/logout',[AuthController::class,'logout'])->name('logout');
        Route::view('/register','back.pages.auth.register')->name('register')->middleware('role:ADM');
        Route::get('delete/anexo/{id}',[AuthController::class,'deleteAnexo'])->name('deleteAnexo');
        Route::get('delete/user/{id}',[UserController::class,'deleteUser'])->name('deleteUser');
        Route::match(['get','post'],'/edit/anexo',[AuthController::class,'editAnexo'])->name('editAnexo');
        Route::match(['get','post'],'/edit/user',[UserController::class,'editUser'])->name('editUser');
        Route::match(['get','post'],'/mi_perfil',[PerfilController::class,'miPerfil'])->name('miPerfil');
        Route::get('/agregar_empleado', [AuthController::class,'addEmpleados'])->name('addEmpleados');
        Route::post('/import', [CSVImportController::class,'import'])->name('import');
    });

});



Route::get('/inicio',[AuthController::class,'indexInicio'])->name('inicio');