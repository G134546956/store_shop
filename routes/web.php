<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProduitsController;

// Route::get('/login', [AuthController::class, 'showLoginForm']
// )->name('login');

// // POST pour tenter la connexion, nom unique pour éviter conflit avec la route GET
// Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('login.submit');
// Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [ProduitsController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/produits', [ProduitsController::class, 'index'])->name('admin.produits.index');
    Route::get('/admin/produits/create', [ProduitsController::class, 'create'])->name('admin.produits.create');
    Route::post('/admin/produits', [ProduitsController::class, 'store'])->name('admin.produits.store');
    route::get('/admin/produits/{id}/edit', [ProduitsController::class, 'edit'])->name('admin.produits.edit');
    Route::put('/admin/produits/{id}', [ProduitsController::class, 'update'])->name('admin.produits.update');
    Route::delete('/admin/produits/{id}', [ProduitsController::class, 'destroy'])->name('admin.produits.destroy');
    Route::get('/admin/produits/{id}', [ProduitsController::class, 'show'])->name('admin.produits.show');
    // Route::get('/reservation/{reference}', [ReservationController::class, 'show'])->name('reservation.show');

    // Categories routes
    Route::get('/admin/categories', [App\Http\Controllers\CategoriesController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [App\Http\Controllers\CategoriesController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories', [App\Http\Controllers\CategoriesController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{id}/edit', [App\Http\Controllers\CategoriesController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{id}', [App\Http\Controllers\CategoriesController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{id}', [App\Http\Controllers\CategoriesController::class, 'destroy'])->name('admin.categories.destroy');
    Route::get('/admin/categories/{id}', [App\Http\Controllers\CategoriesController::class, 'show'])->name('admin.categories.show');

});



Route::get('/', function () {
    return view('Client.home');
})->name('home');

// partier client 
Route::get('/about', function () {
    return view('Client.about');
})->name('about');

Route::get(
    '/boutique',
    [ProduitController::class, 'index']
)->name('boutique');

Route::get('/contact', function () {
    return view('Client.contact');
})->name('contact');
Route::get('/panier', function () {
    return view('Client.panier');
})->name('panier');
route::get('/lignecommande', function () {
    return view('Client.lignecommande');
})->name('lignecommande');
