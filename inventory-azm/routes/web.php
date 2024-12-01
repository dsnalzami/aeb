<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Inventory\StockController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Tambahkan route untuk kategori
    Route::resource('categories', \App\Http\Controllers\Inventory\CategoryController::class);
    Route::resource('products', \App\Http\Controllers\Inventory\ProductController::class);
    
    // Stock Management Routes
    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    Route::get('/stock/{product}/adjust', [StockController::class, 'adjust'])->name('stock.adjust');
    Route::post('/stock/{product}/update', [StockController::class, 'update'])->name('stock.update');
    Route::get('/stock/{product}/history', [StockController::class, 'history'])->name('stock.history');
    
    // Notification Routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    
    // Report Routes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/stock', [ReportController::class, 'stockReport'])->name('reports.stock');
    Route::get('/reports/movement', [ReportController::class, 'movementReport'])->name('reports.movement');
    Route::get('/reports/low-stock', [ReportController::class, 'lowStockReport'])->name('reports.low-stock');
});