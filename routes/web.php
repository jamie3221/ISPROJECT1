<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuthController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/test_working', function () {
    return view('test_working');
})->name('test_working');

Route::get('/customer/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit'); 

