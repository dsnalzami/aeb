<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockMovement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportService
{
    public function getStockReport()
    {
        return Product::with(['category', 'stock'])
            ->select('products.*')
            ->selectRaw('
                (SELECT COUNT(*) 
                FROM stock_movements 
                WHERE product_id = products.id AND type = "in") as total_in
            ')
            ->selectRaw('
                (SELECT COUNT(*) 
                FROM stock_movements 
                WHERE product_id = products.id AND type = "out") as total_out
            ')
            ->get();
    }

    public function getMovementReport($startDate = null, $endDate = null, $type = null)
    {
        $query = StockMovement::with(['product', 'product.category', 'user'])
            ->when($startDate, function ($q) use ($startDate) {
                return $q->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($q) use ($endDate) {
                return $q->whereDate('created_at', '<=', $endDate);
            })
            ->when($type, function ($q) use ($type) {
                return $q->where('type', $type);
            });

        return $query->latest()->get();
    }

    public function getLowStockReport()
    {
        return Product::with(['category', 'stock'])
            ->whereHas('stock', function ($query) {
                $query->whereRaw('quantity <= minimum_stock');
            })
            ->get();
    }
} 