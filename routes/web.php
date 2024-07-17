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
    return view('/customer/customer_home');
})->name('customer.home');

Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

Route::get('/customer/dashboard', function () {
    return view('/customer/customer_dashboard');
})->name('customer.dashboard');

Route::middleware('auth:customer')->group(function () {
    Route::get('/dashboard', [CustomerAuthController::class, 'showDashboard'])->name('customer.dashboard');
    // Other authenticated customer routes
});

Route::delete('/customer/delete', [CustomerAuthController::class, 'delete'])->name('customer.delete');

Route::get('/customer/update', function () {
    return view('/customer/customer_detail_update');
})->name('customer.update');

Route::post('/customer/update', [CustomerAuthController::class, 'update'])->name('customer.update.submit');

Route::get('/customer/history', function () {
    return view('/customer/customer_history');
})->name('customer.history');

Route::get('/service_provider/home', function () {
    return view('/serviceProvider.service_provider_home');
})->name('service_provider.home');

Route::post('/service_provider/logout', [ServiceProviderAuthController::class, 'logout'])->name('service_provider.logout');

Route::get('/service_provider/dashboard', function () {
    return view('/serviceProvider/service_provider_dashboard');
})->name('service_provider.dashboard');

Route::get('/service_provider/update', function () {
    return view('/serviceProvider/service_provider_detail_update');
})->name('service_provider.update');

Route::post('/service_provider/update', [ServiceProviderAuthController::class, 'update'])->name('service_provider.update.submit');

Route::get('/service_provider/history', function () {
    return view('/serviceProvider/service_provider_history');
})->name('service_provider.history');

Route::delete('/service_provider/delete', [ServiceProviderAuthController::class, 'delete'])->name('service_provider.delete');

Route::get('/admin/dashboard', function () {
    return view('/admin/admin_dashboard');
})->name('admin.dashboard');

Route::get('/admin/reports', [AdminAuthController::class, 'reports'])->name('admin.reports');
Route::get('/admin/report', function () {
    return view('/admin/admin_showreports');
})->name('admin.reports');

Route::get('/admin/manageUsers', function () {
    return view('/admin/admin_manage_users');
})->name('admin.manageUsers');

Route::post('/admin/ban-customer/{id}', [AdminAuthController::class, 'banCustomer'])->name('admin.banCustomer');
Route::post('/admin/ban-service-provider/{id}', [AdminAuthController::class, 'banServiceProvider'])->name('admin.banServiceProvider');


Route::get('/admin/manage', 'AdminController@index')->name('admin.manage');
    Route::post('/admin/add', 'AdminController@store')->name('admin.add');
    Route::delete('/admin/remove/{id}', 'AdminController@destroy')->name('admin.remove');

Route::get('/admin/manage', function() {
    return view('admin.admin_manage_admins');
})->name('admin.manage');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/service/create', [ServiceProviderAuthController::class, 'create'])->name('service.create');
Route::post('/service/store', [ServiceProviderAuthController::class, 'store'])->name('service.store');

Route::get('/service/create', function () {
    return view('serviceProvider.create_service');
})->name('service.create');