<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Ruta principal que carga la página home con layout público
Route::get('/', function () {
    return view('public.home');
})->name('home');

// Rutas públicas adicionales para el e-commerce
Route::get('/productos', function () {
    return view('public.products');
})->name('productos');

Route::get('/categorias', function () {
    return view('public.categorys');
})->name('categorias');

Route::get('/contacto', function () {
    return view('public.contact');
})->name('contacto');

Route::get('/nosotros', function () {
    return view('public.about-us');
})->name('nosotros');

// Dashboard para usuarios autenticados
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de perfil para usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
