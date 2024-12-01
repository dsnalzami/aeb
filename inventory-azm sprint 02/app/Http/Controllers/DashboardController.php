<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\StockMovement;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil statistik untuk dashboard
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'low_stock_count' => Product::whereHas('stock', function($query) {
                $query->whereRaw('quantity <= minimum_stock');
            })->count(),
            'recent_movements' => StockMovement::with(['product', 'user'])
                ->latest()
                ->take(5)
                ->get()
        ];

        return view('dashboard.index', compact('stats'));
    }
} 