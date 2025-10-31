<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/account/login', [LoginController::class, 'index'])->name('account.login');
Route::get('/account/dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
Route::get('/account/register', [LoginController::class, 'register'])->name('account.register');


Route::post('/account/login', [LoginController::class, 'authenticate'])->name('account.login-post');
Route::post('/account/register', [LoginController::class, 'processRegister'])->name('account.register-post');

