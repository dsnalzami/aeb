<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Inventory\CategoryController;
use App\Http\Controllers\Inventory\ProductController;
use App\Http\Controllers\Inventory\StockController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Kategori & Produk Routes
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    
    // Stock Management Routes
    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    Route::get('/stock/{product}/adjust', [StockController::class, 'adjust'])->name('stock.adjust');
    Route::post('/stock/{product}/update', [StockController::class, 'update'])->name('stock.update');
    Route::get('/stock/{product}/history', [StockController::class, 'history'])->name('stock.history');
    
    // Notification Routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    
    // Report Routes - Pastikan bagian ini ada dan benar
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/stock', [ReportController::class, 'stockReport'])->name('stock');
        Route::get('/movement', [ReportController::class, 'movementReport'])->name('movement');
        Route::get('/low-stock', [ReportController::class, 'lowStockReport'])->name('low-stock');
    });
});