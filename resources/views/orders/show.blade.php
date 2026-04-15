@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Order #{{ $order->id }}
    </h2>
@endsection

@section('content')
<style>
    .detail-page { padding: 2.5rem 1rem; max-width: 760px; margin: 0 auto; }
    .detail-card {
        background: #1a193e;
        border: 1px solid rgba(113,104,195,0.25);
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 24px rgba(0,0,0,0.4);
        margin-bottom: 1.5rem;
    }
    .section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #8f87cf;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin: 0 0 1.25rem 0;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid rgba(113,104,195,0.25);
    }
    .order-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
    .order-title { font-size: 1.4rem; font-weight: 700; color: #e5e2f3; margin: 0; }
    .badge-paid {
        display: inline-block;
        padding: 0.35rem 0.9rem;
        background: rgba(74,222,128,0.15);
        color: #4ade80;
        border: 1px solid rgba(74,222,128,0.3);
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
    }
    .badge-unpaid {
        display: inline-block;
        padding: 0.35rem 0.9rem;
        background: rgba(248,113,113,0.15);
        color: #f87171;
        border: 1px solid rgba(248,113,113,0.3);
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
    }
    .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .detail-row {
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(113,104,195,0.12);
    }
    .detail-row.full { grid-column: 1 / -1; }
    .detail-row:last-child { border-bottom: none; }
    .detail-label { font-size: 0.75rem; font-weight: 600; color: #aca5db; text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 0.25rem; }
    .detail-value { font-size: 0.95rem; color: #e5e2f3; font-weight: 500; }
    .detail-value.highlight { color: #4ade80; font-weight: 700; font-size: 1.1rem; }
    .payments-table { width: 100%; border-collapse: collapse; }
    .payments-table th {
        text-align: left;
        padding: 0.6rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
        color: #8f87cf;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        background: rgba(113,104,195,0.1);
        border-bottom: 1px solid rgba(113,104,195,0.25);
    }
    .payments-table td { padding: 0.75rem; font-size: 0.9rem; color: #e5e2f3; border-bottom: 1px solid rgba(113,104,195,0.1); }
    .payments-table tr:last-child td { border-bottom: none; }
    .payments-table tr:hover td { background: rgba(113,104,195,0.06); }
    .no-payments { color: #aca5db; font-size: 0.9rem; font-style: italic; padding: 1rem 0; }
    .detail-actions { display: flex; gap: 0.75rem; flex-wrap: wrap; margin-top: 1.5rem; }
    .btn-back {
        padding: 0.7rem 1.4rem;
        background: transparent;
        color: #aca5db;
        border: 1px solid rgba(113,104,195,0.3);
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .btn-back:hover { background: rgba(113,104,195,0.15); color: #e5e2f3; text-decoration: none; }
    .btn-edit {
        padding: 0.7rem 1.4rem;
        background: rgba(250,204,21,0.12);
        color: #facc15;
        border: 1px solid rgba(250,204,21,0.3);
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .btn-edit:hover { background: #facc15; color: #0d0d20; text-decoration: none; }
    .btn-pay {
        padding: 0.7rem 1.4rem;
        background: rgba(74,222,128,0.15);
        color: #4ade80;
        border: 1px solid rgba(74,222,128,0.3);
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .btn-pay:hover { background: #4ade80; color: #0d0d20; text-decoration: none; }
    @media (max-width: 560px) { .detail-grid { grid-template-columns: 1fr; } }
</style>

<div class="detail-page">
    <!-- Order Details -->
    <div class="detail-card">
        <div class="order-header">
            <h2 class="order-title">Order #{{ $order->id }}</h2>
            @if($order->payments->isNotEmpty() && $order->payments->last()->status == 'paid')
                <span class="badge-paid">Paid</span>
            @else
                <span class="badge-unpaid">Unpaid</span>
            @endif
        </div>

        <p class="section-title">Order Details</p>
        <div class="detail-grid">
            <div class="detail-row">
                <div class="detail-label">Rice Type</div>
                <div class="detail-value">{{ $order->rice_name }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Product</div>
                <div class="detail-value">{{ $order->product ? $order->product->rice_name : 'N/A' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Quantity</div>
                <div class="detail-value">{{ $order->quantity }} kg</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Price per kg</div>
                <div class="detail-value">₱{{ number_format($order->price_per_kilo, 2) }}</div>
            </div>
            <div class="detail-row full">
                <div class="detail-label">Total Amount</div>
                <div class="detail-value highlight">₱{{ number_format($order->total_amount, 2) }}</div>
            </div>
        </div>
    </div>

    <!-- Payments -->
    <div class="detail-card">
        <p class="section-title">Payment History</p>
        @if($order->payments->isNotEmpty())
            <table class="payments-table">
                <thead>
                    <tr>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->payments as $payment)
                        <tr>
                            <td>₱{{ number_format($payment->amount, 2) }}</td>
                            <td>
                                @if($payment->status == 'paid')
                                    <span class="badge-paid">Paid</span>
                                @else
                                    <span class="badge-unpaid">Unpaid</span>
                                @endif
                            </td>
                            <td>{{ $payment->payment_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-payments">No payments recorded for this order.</p>
        @endif
    </div>

    <div class="detail-actions">
        <a href="{{ route('orders.index') }}" class="btn-back">← Back to Orders</a>
        <a href="{{ route('orders.edit', $order) }}" class="btn-edit">Edit Order</a>
        @if($order->payments->isEmpty() || $order->payments->last()->status == 'unpaid')
            <a href="{{ route('payments.create', ['order_id' => $order->id]) }}" class="btn-pay">Process Payment</a>
        @endif
    </div>
</div>
@endsection
