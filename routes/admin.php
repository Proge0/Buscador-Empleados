<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', 'back.pages.auth.login')->name('login');
    });

    Route::middleware(['auth:admin'])->group(function () { 
        Route::view('/home', 'back.pages.home')->name('home');
    });
});