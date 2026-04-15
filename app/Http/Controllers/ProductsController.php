<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Orders;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rice_name' => 'required|string|max:255',
            'price_per_kilo' => 'required|numeric|min:0',
            'stock_per_kilo' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Products::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        $request->validate([
            'rice_name' => 'required|string|max:255',
            'price_per_kilo' => 'required|numeric|min:0',
            'stock_per_kilo' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        if ($product->orders()->exists()) {
            return redirect()->route('products.index')->with('error', 'Cannot delete this product because it has existing orders. Delete associated orders first.');
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Display action menu/dashboard.
     */
    public function actions()
    {
        $totalProducts = Products::count();
        $totalOrders = Orders::count();
        $totalPayments = \App\Models\Payment::where('status', 'paid')->sum('amount');
        
        return view('actions', compact('totalProducts', 'totalOrders', 'totalPayments'));
    }
}
