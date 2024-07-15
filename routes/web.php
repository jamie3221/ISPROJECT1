<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\ServiceProviderAuthController;

// Default route to welcome page
Route::get('/', function () {
    return view('welcome');
})->name('home');

/// Login routes - Customer
Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('/login', [CustomerAuthController::class, 'login'])->name('customer_login.submit');

// Register routes - Customer
Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/register', [CustomerAuthController::class, 'register'])->name('customer_register.submit');

// Login routes - service provider
Route::get('/service_provider/login', [ServiceProviderAuthController::class, 'showLoginForm'])->name('service_provider.login');
Route::post('/service_provider/login', [ServiceProviderAuthController::class, 'login'])->name('service_provider.login.submit');

// Register routes - service provider
Route::get('/service_provider/register', [ServiceProviderAuthController::class, 'showRegisterForm'])->name('service_provider.register');
Route::post('/service_provider/register', [ServiceProviderAuthController::class, 'register'])->name('service_provider.register.submit');

// Test route
Route::get('/test', function () {
    return view('test_working');
})->name('test');

Route::get('/login', function () {
    return view('auth/login');
})->name('login');