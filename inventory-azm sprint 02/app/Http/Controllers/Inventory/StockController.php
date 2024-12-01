<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\LowStockNotification;
use App\Models\User;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'stock'])->paginate(10);
        return view('inventory.stock.index', compact('products'));
    }

    public function adjust(Product $product)
    {
        return view('inventory.stock.adjust', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'description' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            // Cek stok cukup jika pengurangan
            if ($request->type === 'out') {
                if ($product->stock->quantity < $request->quantity) {
                    return back()->with('error', 'Stok tidak mencukupi!');
                }
            }

            // Buat record stock movement
            StockMovement::create([
                'product_id' => $product->id,
                'type' => $request->type,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'user_id' => auth()->id()
            ]);

            // Update stok produk
            $newQuantity = $request->type === 'in' 
                ? $product->stock->quantity + $request->quantity
                : $product->stock->quantity - $request->quantity;

            $product->stock->update(['quantity' => $newQuantity]);

            // Cek dan kirim notifikasi jika stok menipis
            if ($newQuantity <= $product->stock->minimum_stock) {
                // Kirim notifikasi ke user yang sedang login
                auth()->user()->notify(new LowStockNotification($product));
                
                // Log untuk debugging
                \Log::info('Notifikasi stok menipis dikirim untuk produk: ' . $product->name);
            }

            DB::commit();

            return redirect()->route('stock.index')
                ->with('success', 'Stok berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error saat update stok: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui stok');
        }
    }

    public function history(Product $product)
    {
        $movements = StockMovement::with(['user'])
            ->where('product_id', $product->id)
            ->latest()
            ->paginate(10);

        return view('inventory.stock.history', compact('product', 'movements'));
    }
} 