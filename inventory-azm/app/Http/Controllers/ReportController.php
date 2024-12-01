<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        return view('reports.index');
    }

    public function stockReport(Request $request)
    {
        $stocks = $this->reportService->getStockReport();

        if ($request->type === 'pdf') {
            $pdf = PDF::loadView('reports.stock_pdf', compact('stocks'));
            return $pdf->download('stock-report.pdf');
        }

        return view('reports.stock', compact('stocks'));
    }

    public function movementReport(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'type' => 'nullable|in:in,out,pdf'
        ]);

        $movements = $this->reportService->getMovementReport(
            $request->start_date,
            $request->end_date,
            $request->type === 'pdf' ? null : $request->type
        );

        if ($request->type === 'pdf') {
            $pdf = PDF::loadView('reports.movement_pdf', compact('movements'));
            return $pdf->download('movement-report.pdf');
        }

        return view('reports.movement', compact('movements'));
    }

    public function lowStockReport(Request $request)
    {
        $lowStocks = $this->reportService->getLowStockReport();

        if ($request->type === 'pdf') {
            $pdf = PDF::loadView('reports.low_stock_pdf', compact('lowStocks'));
            return $pdf->download('low-stock-report.pdf');
        }

        return view('reports.low_stock', compact('lowStocks'));
    }
} 