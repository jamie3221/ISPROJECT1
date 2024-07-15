<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\ServiceProviderAuthController; // Add this line to import the ServiceProviderAuthController class

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Login routes - Customer
Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomerAuthController::class, 'login'])->name('login.submit');

//Register routes - Customer
Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [CustomerAuthController::class, 'register'])->name('register.submit');

//logout routes

//test confirmation routes
Route::get('/test', function () {
    return view('test_working');
})->name('test');

//Login routes - service provider
Route::get('/service_provider/login', [ServiceProviderAuthController::class, 'showLoginForm'])->name('service_provider.login');
Route::post('/service_provider/login', [ServiceProviderAuthController::class, 'login'])->name('service_provider.login.submit');

//Register routes - service provider
Route::get('/service_provider/register', [ServiceProviderAuthController::class, 'showRegisterForm'])->name('service_provider.register');
Route::post('/service_provider/register', [ServiceProviderAuthController::class, 'register'])->name('service_provider.register.submit');