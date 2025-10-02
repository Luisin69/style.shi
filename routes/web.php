<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/login', "login")->name('login');
Route::view('/registro', "register")->name('registro');
Route::view('/privada', "secret")->name('privada');

Route::post('/validar-registro', [LoginController::class,'register'])->name('validar-registro');
Route::post('/inicia-sesion', [LoginController::class,'login'])->name('inicia-sesion');
Route::post('/logout', [LoginController::class,'logout'])->name('logout');

