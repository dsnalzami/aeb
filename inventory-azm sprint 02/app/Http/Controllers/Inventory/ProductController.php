<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'stock'])->latest()->paginate(10);
        return view('inventory.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('inventory.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:products',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'initial_stock' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id
        ]);

        // Buat stok awal
        Stock::create([
            'product_id' => $product->id,
            'quantity' => $request->initial_stock,
            'minimum_stock' => $request->minimum_stock
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('inventory.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:products,code,' . $product->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'minimum_stock' => 'required|integer|min:0'
        ]);

        $product->update($request->except('minimum_stock'));
        
        // Update minimum stock
        $product->stock->update([
            'minimum_stock' => $request->minimum_stock
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
} 