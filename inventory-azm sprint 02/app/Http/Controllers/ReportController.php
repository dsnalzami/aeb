<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockMovement;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function stockReport(Request $request)
    {
        $stocks = Product::with(['category', 'stock'])
            ->select('products.*')
            ->selectRaw('(SELECT SUM(quantity) FROM stock_movements WHERE product_id = products.id AND type = "in") as total_in')
            ->selectRaw('(SELECT SUM(quantity) FROM stock_movements WHERE product_id = products.id AND type = "out") as total_out')
            ->get();

        if ($request->type === 'pdf') {
            $pdf = PDF::loadView('reports.stock_pdf', compact('stocks'));
            return $pdf->download('laporan-stok-' . now()->format('Y-m-d') . '.pdf');
        }

        return view('reports.stock', compact('stocks'));
    }

    public function movementReport(Request $request)
    {
        $movements = StockMovement::with(['product', 'user'])
            ->when($request->start_date, function($query) use ($request) {
                return $query->whereDate('created_at', '>=', $request->start_date);
            })
            ->when($request->end_date, function($query) use ($request) {
                return $query->whereDate('created_at', '<=', $request->end_date);
            })
            ->latest()
            ->get();

        if ($request->type === 'pdf') {
            $pdf = PDF::loadView('reports.movement_pdf', [
                'movements' => $movements,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);
            return $pdf->download('laporan-pergerakan-stok-' . now()->format('Y-m-d') . '.pdf');
        }

        return view('reports.movement', compact('movements'));
    }

    public function lowStockReport(Request $request)
    {
        $lowStocks = Product::with(['category', 'stock'])
            ->whereHas('stock', function($query) {
                $query->whereRaw('quantity <= minimum_stock');
            })
            ->get();

        if ($request->type === 'pdf') {
            $pdf = PDF::loadView('reports.low_stock_pdf', compact('lowStocks'));
            return $pdf->download('laporan-stok-menipis-' . now()->format('Y-m-d') . '.pdf');
        }

        return view('reports.low_stock', compact('lowStocks'));
    }
} 