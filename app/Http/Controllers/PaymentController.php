<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Orders;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments (payment history).
     */
    public function index()
    {
        $payments = Payment::with('order.product')->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new payment for an order.
     */
    public function create(Request $request)
    {
        $orderId = $request->query('order_id');
        $order = Orders::findOrFail($orderId);
        return view('payments.create', compact('order'));
    }

    /**
     * Store a newly created payment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string',
        ]);

        $payment = Payment::create([
            'order_id' => $request->order_id,
            'amount' => $request->amount,
            'status' => 'paid',
            'payment_date' => now(),
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment processed successfully.');
    }

    /**
     * Display the specified payment.
     */
    public function show(Payment $payment)
    {
        $payment->load('order.product');
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the payment status.
     */
    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    /**
     * Update the payment status.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:paid,unpaid',
        ]);

        $payment->update($request->only('status'));

        return redirect()->route('payments.index')->with('success', 'Payment status updated.');
    }

    /**
     * Remove the payment.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted.');
    }
}
