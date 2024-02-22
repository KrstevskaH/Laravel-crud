<?php
  
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginRegisterController;
use Illuminate\Support\Facades\Route;

// Define resourceful routes for products
Route::resource('products', ProductController::class);

// Additional routes for create and edit with authentication middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::resource('products', ProductController::class)->middleware(['auth']);
});

// Authentication-related routes using the LoginRegisterController
Route::get('/', function () {
    return view('welcome');
});

// Adjusted the namespace for Auth routes
Route::prefix('auth')->group(function () {
    Route::get('/register', [LoginRegisterController::class, 'register'])->name('register');
    Route::post('/store', [LoginRegisterController::class, 'store'])->name('store');
    Route::get('/login', [LoginRegisterController::class, 'login'])->name('login');
    Route::post('/authenticate', [LoginRegisterController::class, 'authenticate'])->name('authenticate');
    Route::get('/dashboard', [LoginRegisterController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
    Route::get('/index', [LoginRegisterController::class, 'index'])->name('index');
    Route::get('/layout', [LoginRegisterController::class, 'layout'])->name('layout');
});
