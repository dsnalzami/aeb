<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $lowStockProducts = Product::whereHas('stock', function($query) {
            $query->whereRaw('quantity <= minimum_stock');
        })->count();

        return view('dashboard.index', compact('totalProducts', 'totalCategories', 'lowStockProducts'));
    }
} 