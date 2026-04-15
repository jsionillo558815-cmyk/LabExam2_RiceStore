<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Orders;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Orders::with('product', 'payments')->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Products::where('stock_per_kilo', '>', 0)->get();
        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rice_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:1',
            'price_per_kilo' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'products_id' => 'required|exists:products,id',
        ]);

        $product = Products::find($request->products_id);
        if ($request->quantity > $product->stock_per_kilo) {
            return back()->withErrors(['quantity' => 'Quantity exceeds available stock.'])->withInput();
        }

        $order = Orders::create($request->all());

        return redirect()->route('payments.create', ['order_id' => $order->id])->with('success', 'Order created successfully. Please process payment.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $order)
    {
        $order->load('product', 'payments');
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $order)
    {
        $products = Products::where('stock_per_kilo', '>', 0)->get();
        return view('orders.edit', compact('order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $order)
    {
        $request->validate([
            'rice_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:1',
            'price_per_kilo' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'products_id' => 'required|exists:products,id',
        ]);

        $product = Products::find($request->products_id);
        if ($request->quantity > $product->stock_per_kilo) {
            return back()->withErrors(['quantity' => 'Quantity exceeds available stock.'])->withInput();
        }

        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
