@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Payment Details
    </h2>
@endsection

@section('content')
<style>
    .detail-page { padding: 2.5rem 1rem; }
    .detail-card {
        max-width: 640px;
        margin: 0 auto;
        background: #1a193e;
        border: 1px solid rgba(113,104,195,0.25);
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 24px rgba(0,0,0,0.4);
    }
    .detail-card h2 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #e5e2f3;
        margin: 0 0 1.5rem 0;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(113,104,195,0.25);
        background: none;
        -webkit-text-fill-color: #e5e2f3;
    }
    .detail-row {
        padding: 0.9rem 0;
        border-bottom: 1px solid rgba(113,104,195,0.12);
    }
    .detail-row:last-of-type { border-bottom: none; }
    .detail-label { font-size: 0.75rem; font-weight: 600; color: #aca5db; text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 0.3rem; }
    .detail-value { font-size: 1rem; color: #e5e2f3; font-weight: 500; }
    .detail-value.amount { color: #8f87cf; font-weight: 700; font-size: 1.15rem; }
    .badge-paid {
        display: inline-block;
        padding: 0.3rem 0.9rem;
        background: rgba(74,222,128,0.15);
        color: #4ade80;
        border: 1px solid rgba(74,222,128,0.3);
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
    }
    .badge-unpaid {
        display: inline-block;
        padding: 0.3rem 0.9rem;
        background: rgba(248,113,113,0.15);
        color: #f87171;
        border: 1px solid rgba(248,113,113,0.3);
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
    }
    .detail-actions { display: flex; gap: 0.75rem; margin-top: 1.75rem; flex-wrap: wrap; }
    .btn-edit {
        padding: 0.7rem 1.5rem;
        background: linear-gradient(135deg, #7168c3 0%, #534ab7 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: filter 0.2s, transform 0.2s;
    }
    .btn-edit:hover { filter: brightness(1.15); transform: translateY(-1px); text-decoration: none; color: white; }
    .btn-back {
        padding: 0.7rem 1.5rem;
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
</style>

<div class="detail-page">
    <div class="detail-card">
        <h2>Payment Details</h2>

        <div class="detail-row">
            <div class="detail-label">Order</div>
            <div class="detail-value">{{ $payment->order->rice_name }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Amount</div>
            <div class="detail-value amount">₱{{ number_format($payment->amount, 2) }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Status</div>
            <div class="detail-value">
                @if($payment->status == 'paid')
                    <span class="badge-paid">Paid</span>
                @else
                    <span class="badge-unpaid">Unpaid</span>
                @endif
            </div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Payment Method</div>
            <div class="detail-value" style="text-transform: capitalize;">{{ $payment->payment_method }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Payment Date</div>
            <div class="detail-value">{{ $payment->payment_date ? $payment->payment_date->format('F d, Y h:i A') : 'N/A' }}</div>
        </div>

        <div class="detail-actions">
            <a href="{{ route('payments.edit', $payment) }}" class="btn-edit">Edit Status</a>
            <a href="{{ route('payments.index') }}" class="btn-back">← Back</a>
        </div>
    </div>
</div>
@endsection
