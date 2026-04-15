@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Edit Payment Status
    </h2>
@endsection

@section('content')
<style>
    .form-page { padding: 2.5rem 1rem; }
    .form-card {
        max-width: 640px;
        margin: 0 auto;
        background: #1a193e;
        border: 1px solid rgba(113,104,195,0.25);
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 24px rgba(0,0,0,0.4);
    }
    .form-card h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #e5e2f3;
        margin: 0 0 1.25rem 0;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(113,104,195,0.25);
    }
    .payment-summary {
        background: rgba(113,104,195,0.08);
        border: 1px solid rgba(113,104,195,0.25);
        border-radius: 8px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
    }
    .payment-summary p { margin-bottom: 0.4rem; font-size: 0.9rem; color: #aca5db; }
    .payment-summary p strong { color: #e5e2f3; }
    .form-group { display: flex; flex-direction: column; margin-bottom: 1.25rem; }
    .form-group label { font-size: 0.875rem; font-weight: 600; color: #aca5db; margin-bottom: 0.5rem; }
    .form-group select {
        background: #0d0d20;
        border: 1px solid rgba(113,104,195,0.4);
        border-radius: 8px;
        padding: 12px;
        color: #e5e2f3;
        font-size: 1rem;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-family: inherit;
        width: 100%;
    }
    .form-group select:focus {
        outline: none;
        border-color: #7168c3;
        box-shadow: 0 0 0 3px rgba(113,104,195,0.2);
    }
    .form-group select option { background: #0d0d20; color: #e5e2f3; }
    .form-actions { display: flex; gap: 0.75rem; margin-top: 1.75rem; }
    .btn-submit {
        flex: 1;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #7168c3 0%, #534ab7 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: filter 0.2s, transform 0.2s;
        font-family: inherit;
    }
    .btn-submit:hover { filter: brightness(1.15); transform: translateY(-1px); }
    .btn-cancel {
        flex: 1;
        padding: 0.75rem 1.5rem;
        background: transparent;
        color: #aca5db;
        border: 1px solid rgba(113,104,195,0.3);
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s, color 0.2s;
    }
    .btn-cancel:hover { background: rgba(113,104,195,0.15); color: #e5e2f3; text-decoration: none; }
</style>

<div class="form-page">
    <div class="form-card">
        <h3>Edit Payment Status</h3>

        <div class="payment-summary">
            <p><strong>Amount:</strong> ₱{{ number_format($payment->amount, 2) }}</p>
            <p>
                <strong>Current Status:</strong>
                <span style="color: {{ $payment->status == 'paid' ? '#4ade80' : '#f87171' }}; font-weight: 700;">
                    {{ ucfirst($payment->status) }}
                </span>
            </p>
            <p><strong>Payment Date:</strong> {{ $payment->payment_date ? $payment->payment_date->format('M d, Y h:i A') : 'N/A' }}</p>
            <p><strong>Payment Method:</strong> {{ ucfirst($payment->payment_method) }}</p>
        </div>

        <form action="{{ route('payments.update', $payment) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Update Status</label>
                <select name="status" required>
                    <option value="paid" {{ $payment->status == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="unpaid" {{ $payment->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-submit">Update Status</button>
                <a href="{{ route('payments.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
