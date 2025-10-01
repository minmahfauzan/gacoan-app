<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\TableAuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

// Include admin routes
require __DIR__.'/admin.php';

// Table Authentication Routes
Route::get('/table/login', [TableAuthController::class, 'showLoginForm'])->name('table.auth.login');
Route::post('/table/login', [TableAuthController::class, 'login'])->name('table.auth.login');
Route::post('/table/logout', [TableAuthController::class, 'logout'])->name('table.auth.logout');

Route::get('/table-login/qr', [TableAuthController::class, 'loginWithQr'])->name('table.login.qr');

// Protected Routes (Table Auth Required)
Route::middleware(['table.auth'])->group(function () {
    // Menu Routes
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    
    // Cart Routes
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    
    // Order Routes
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/status/{id}', [OrderController::class, 'status'])->name('order.status');
});

// Homepage
Route::get('/', function () {
    return view('welcome');
});

// Koki Panel Routes
Route::prefix('koki')->group(function () {
    Route::get('/', [App\Http\Controllers\KokiController::class, 'index'])->name('koki.index');
    Route::post('order-items/{orderItem}/mark-made', [App\Http\Controllers\KokiController::class, 'markItemMade'])->name('koki.order-items.mark-made');
    Route::post('orders/{order}/mark-ready', [App\Http\Controllers\KokiController::class, 'markOrderReady'])->name('koki.orders.mark-ready');
});

// Pelayan Panel Routes
Route::prefix('pelayan')->group(function () {
    Route::get('/', [App\Http\Controllers\PelayanController::class, 'index'])->name('pelayan.index');
    Route::post('orders/{order}/mark-served', [App\Http\Controllers\PelayanController::class, 'markOrderServed'])->name('pelayan.orders.mark-served');
});

Route::get('products/images/{filename}', function ($filename) {
    $path = 'products/' . $filename;

    if (!Storage::exists($path)) {
        abort(404);
    }

    $file = Storage::get($path);
    $type = Storage::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->name('products.image');
