<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomerAuthController::class, 'login'])->name('login.post');

Route::middleware('auth:customer')->get('/test', function () {
    return view('test');
})->name('test');
