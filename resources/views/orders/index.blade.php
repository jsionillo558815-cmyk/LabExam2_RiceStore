@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        All Orders
    </h2>
@endsection

@section('content')
<style>
    .orders-page { padding: 2.5rem 1rem; max-width: 1200px; margin: 0 auto; }
    .page-actions { margin-bottom: 1.75rem; }
    .btn-create {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #7168c3 0%, #534ab7 100%);
        color: white;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 600;
        text-decoration: none;
        transition: filter 0.2s, transform 0.2s;
    }
    .btn-create:hover { filter: brightness(1.15); transform: translateY(-1px); text-decoration: none; color: white; }
    .orders-list { display: flex; flex-direction: column; gap: 1.25rem; }
    .order-card {
        background: #1a193e;
        border: 1px solid rgba(113,104,195,0.25);
        border-radius: 12px;
        padding: 1.5rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .order-card:hover { border-color: #7168c3; box-shadow: 0 8px 24px rgba(83,74,183,0.2); }
    .order-head { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem; }
    .order-id { font-size: 1.1rem; font-weight: 700; color: #e5e2f3; margin: 0 0 0.2rem 0; }
    .order-date { font-size: 0.8rem; color: #aca5db; }
    .badge-paid {
        display: inline-block;
        padding: 0.3rem 0.8rem;
        background: rgba(74,222,128,0.15);
        color: #4ade80;
        border: 1px solid rgba(74,222,128,0.3);
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.3px;
    }
    .badge-unpaid {
        display: inline-block;
        padding: 0.3rem 0.8rem;
        background: rgba(248,113,113,0.15);
        color: #f87171;
        border: 1px solid rgba(248,113,113,0.3);
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.3px;
    }
    .order-meta { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 0.75rem 1.5rem; margin-bottom: 1.25rem; }
    .meta-item .meta-label { font-size: 0.75rem; color: #aca5db; font-weight: 500; margin-bottom: 0.2rem; }
    .meta-item .meta-value { font-size: 0.95rem; color: #e5e2f3; font-weight: 500; }
    .meta-item .meta-value.amount { color: #4ade80; font-weight: 700; font-size: 1.05rem; }
    .order-actions { display: flex; gap: 0.6rem; flex-wrap: wrap; padding-top: 1rem; border-top: 1px solid rgba(113,104,195,0.15); }
    .btn-pay {
        padding: 0.45rem 1rem;
        background: rgba(74,222,128,0.15);
        color: #4ade80;
        border: 1px solid rgba(74,222,128,0.3);
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .btn-pay:hover { background: #4ade80; color: #0d0d20; text-decoration: none; }
    .btn-details {
        padding: 0.45rem 1rem;
        background: rgba(113,104,195,0.15);
        color: #8f87cf;
        border: 1px solid rgba(113,104,195,0.3);
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .btn-details:hover { background: #7168c3; color: white; text-decoration: none; }
    .btn-edit-sm {
        padding: 0.45rem 1rem;
        background: rgba(250,204,21,0.12);
        color: #facc15;
        border: 1px solid rgba(250,204,21,0.3);
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .btn-edit-sm:hover { background: #facc15; color: #0d0d20; text-decoration: none; }
    .btn-delete-sm {
        padding: 0.45rem 1rem;
        background: rgba(248,113,113,0.12);
        color: #f87171;
        border: 1px solid rgba(248,113,113,0.3);
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
        font-family: inherit;
    }
    .btn-delete-sm:hover { background: #f87171; color: white; }
    .empty-card {
        background: #1a193e;
        border: 2px dashed rgba(113,104,195,0.25);
        border-radius: 12px;
        padding: 4rem 2rem;
        text-align: center;
        color: #aca5db;
    }
    .empty-card a { color: #8f87cf; font-weight: 600; }
</style>

<div class="orders-page">
    <div class="page-actions">
        <a href="{{ route('orders.create') }}" class="btn-create">+ Create Order</a>
    </div>

    <div class="orders-list">
        @forelse($orders as $order)
            <div class="order-card">
                <div class="order-head">
                    <div>
                        <p class="order-id">Order #{{ $order->id }}</p>
                        <p class="order-date">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                    </div>
                    @if($order->payments->isNotEmpty() && $order->payments->last()->status == 'paid')
                        <span class="badge-paid">Paid</span>
                    @else
                        <span class="badge-unpaid">Unpaid</span>
                    @endif
                </div>

                <div class="order-meta">
                    <div class="meta-item">
                        <div class="meta-label">Rice Type</div>
                        <div class="meta-value">{{ $order->rice_name }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Quantity</div>
                        <div class="meta-value">{{ $order->quantity }} kg</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Price per kg</div>
                        <div class="meta-value">₱{{ number_format($order->price_per_kilo, 2) }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Total Amount</div>
                        <div class="meta-value amount">₱{{ number_format($order->total_amount, 2) }}</div>
                    </div>
                </div>

                <div class="order-actions">
                    @if($order->payments->isEmpty() || $order->payments->last()->status == 'unpaid')
                        <a href="{{ route('payments.create', ['order_id' => $order->id]) }}" class="btn-pay">Pay Now</a>
                    @endif
                    <a href="{{ route('orders.show', $order) }}" class="btn-details">View Details</a>
                    <a href="{{ route('orders.edit', $order) }}" class="btn-edit-sm">Edit</a>
                    <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete-sm"
                            onclick="return confirm('Delete this order?')">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-card">
                <p style="margin-bottom:1rem;">No orders yet.</p>
                <a href="{{ route('orders.create') }}">Create your first order →</a>
            </div>
        @endforelse
    </div>
</div>
@endsection
