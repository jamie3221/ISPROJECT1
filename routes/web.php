<?php

use App\Http\Controllers\AdminAuthController;
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

Route::get('/register', function () {
    return view('auth/register');
})->name('register');

Route::get('/admin/login', function () {
    return view('auth/admin_login');
})->name('admin.login');

Route::get('/admin.login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin.login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::get('/customer/home', function () {
    return view('customer_home');
})->name('customer.home');

Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

Route::get('/customer/dashboard', function () {
    return view('customer_dashboard');
})->name('customer.dashboard');

Route::middleware('auth:customer')->group(function () {
    Route::get('/dashboard', [CustomerAuthController::class, 'showDashboard'])->name('customer.dashboard');
    // Other authenticated customer routes
});