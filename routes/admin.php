<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TableController;

// Admin Authentication Routes
Route::get('/admin/login', function () {
    return view('admin.auth.login');
})->name('admin.login');

Route::post('/admin/login', function () {
    // For demo purposes, simple login
    // In a real app, implement proper authentication
    \Illuminate\Support\Facades\Session::put('admin_logged_in', true);
    return redirect()->route('admin.dashboard');
})->name('admin.login.attempt');

Route::post('/admin/logout', function () {
    \Illuminate\Support\Facades\Session::forget('admin_logged_in');
    return redirect()->route('admin.login');
})->name('admin.logout');

// Admin Protected Routes
Route::middleware(['admin.auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('/orders/{id}/cancel', [AdminOrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/tables/qrcodes', [TableController::class, 'qrcodes'])->name('tables.qrcodes');
    Route::resource('products', ProductController::class);
    Route::post('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
});