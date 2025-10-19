<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;


// Grupo de rutas públicas sin middleware
Route::group([], function () {
    Route::get('/', function () {
        return view('public.home');
    })->name('home');
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
});

// Dashboard para usuarios autenticados
// Redirigir al dashboard adecuado según rol
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user && method_exists($user, 'hasRole') && $user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('customer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Dashboards específicos
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('admin.dashboard');

    Route::get('/admin/products', function () {
        return view('admin.products.index');
    })->name('admin.products.index');
    
    

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('customers', CustomerController::class);
        
        // Rutas adicionales para acciones específicas de clientes
        Route::patch('customers/{customer}/activate', [CustomerController::class, 'activate'])->name('customers.activate');
        Route::patch('customers/{customer}/deactivate', [CustomerController::class, 'deactivate'])->name('customers.deactivate');
        Route::patch('customers/{customer}/verify-email', [CustomerController::class, 'verifyEmail'])->name('customers.verify-email');
        Route::patch('customers/{customer}/unverify-email', [CustomerController::class, 'unverifyEmail'])->name('customers.unverify-email');
    });

    Route::get('/admin/orders', function () {
        return view('admin.orders.index');
    })->name('admin.orders.index');

    Route::get('/admin/payments', function () {
        return view('admin.payments.index');
    })->name('admin.payments.index');

    Route::get('/admin/discounts', function () {
        return view('admin.discounts.index');
    })->name('admin.discounts.index');
    
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/customer/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');
});

// Rutas de perfil para usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
