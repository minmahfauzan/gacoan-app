<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

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
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::post('/orders/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update-status');
    Route::post('/orders/{id}/cancel', [AdminOrderController::class, 'cancel'])->name('admin.orders.cancel');
});