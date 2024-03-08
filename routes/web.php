<?php
  
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginRegisterController;
use Illuminate\Support\Facades\Route;

// Define resourceful routes for products
Route::resource('products', ProductController::class);

// Additional routes for create and edit with authentication middleware
Route::middleware(['auth'])->group(function () {
    // Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    // Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
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

use App\Http\Controllers\DashboardController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

use App\Http\Controllers\NewsController;

// List news articles
Route::get('/news', [NewsController::class, 'index'])->name('news.index');

// Display the form for creating a new news article
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');

// Store a new news article
Route::post('/news', [NewsController::class, 'store'])->name('news.store');
Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('/news/active', [NewsController::class, 'activeNews'])->name('news.active');
Route::get('/news/inactive', [NewsController::class, 'inactiveNews'])->name('news.inactive');