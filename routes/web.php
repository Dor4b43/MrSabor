<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ── LANDING ──────────────────────────────────────────────────
Route::get('/', [LandingController::class, 'index']);
Route::get('/promociones/{promotion}', [LandingController::class, 'showPromotion'])->name('promotions.show');
Route::post('/api/menu-items/{id}/view', [LandingController::class, 'trackView']);

// ── CLIENTE (autenticado) ─────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');

    // Pedidos del cliente
    Route::get('/mis-pedidos',          [CustomerOrderController::class, 'index'])->name('orders.index');
    Route::post('/mis-pedidos',         [CustomerOrderController::class, 'store'])->name('orders.store');
    Route::get('/mis-pedidos/{order}',  [CustomerOrderController::class, 'show'])->name('orders.show');
    Route::post('/mis-pedidos/{order}/cancel', [CustomerOrderController::class, 'cancel'])->name('orders.cancel');

    // Perfil
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Direcciones
    Route::post('/addresses',          [App\Http\Controllers\AddressController::class, 'store'])->name('addresses.store');
    Route::delete('/addresses/{address}', [App\Http\Controllers\AddressController::class, 'destroy'])->name('addresses.destroy');
});

// ── ADMIN (autenticado + is.admin) ───────────────────────────
Route::middleware(['auth', 'is.admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

        // Gestión del menú
        Route::resource('menu-items', Admin\MenuItemController::class);

        // Categorías
        Route::resource('categories', Admin\CategoryController::class)->except(['create', 'show', 'edit']);

        // Promociones
        Route::get('promotions/quick-create',  [Admin\PromotionController::class, 'quickCreate'])->name('promotions.quick-create');
        Route::post('promotions/quick-store',  [Admin\PromotionController::class, 'quickStore'])->name('promotions.quick-store');
        Route::resource('promotions', Admin\PromotionController::class);

        // Pedidos
        Route::get('orders',                     [Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}',             [Admin\OrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}/status',    [Admin\OrderController::class, 'updateStatus'])->name('orders.status');
    });

require __DIR__.'/auth.php';
