@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Payment History
    </h2>
@endsection

@section('content')
<style>
    .payments-page { padding: 2.5rem 1rem; max-width: 1200px; margin: 0 auto; }
    .table-card {
        background: #1a193e;
        border: 1px solid rgba(113,104,195,0.25);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,0.4);
    }
    .table-scroll { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    thead tr { background: rgba(113,104,195,0.15); border-bottom: 2px solid #7168c3; }
    thead th { padding: 0.85rem 1rem; text-align: left; font-size: 0.8rem; font-weight: 600; color: #8f87cf; text-transform: uppercase; letter-spacing: 0.4px; }
    tbody td { padding: 0.85rem 1rem; font-size: 0.9rem; color: #e5e2f3; border-bottom: 1px solid rgba(113,104,195,0.12); }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover td { background: rgba(113,104,195,0.08); }
    .td-amount { color: #8f87cf; font-weight: 700; }
    .td-method { color: #aca5db; text-transform: capitalize; }
    .td-date { color: #aca5db; font-size: 0.85rem; }
    .badge-paid {
        display: inline-block;
        padding: 0.25rem 0.7rem;
        background: rgba(74,222,128,0.15);
        color: #4ade80;
        border: 1px solid rgba(74,222,128,0.3);
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 700;
    }
    .badge-unpaid {
        display: inline-block;
        padding: 0.25rem 0.7rem;
        background: rgba(248,113,113,0.15);
        color: #f87171;
        border: 1px solid rgba(248,113,113,0.3);
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 700;
    }
    .td-actions { display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; }
    .btn-view-sm {
        padding: 0.35rem 0.75rem;
        background: rgba(113,104,195,0.15);
        color: #8f87cf;
        border: 1px solid rgba(113,104,195,0.3);
        border-radius: 5px;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .btn-view-sm:hover { background: #7168c3; color: white; text-decoration: none; }
    .btn-edit-sm {
        padding: 0.35rem 0.75rem;
        background: rgba(250,204,21,0.12);
        color: #facc15;
        border: 1px solid rgba(250,204,21,0.3);
        border-radius: 5px;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .btn-edit-sm:hover { background: #facc15; color: #0d0d20; text-decoration: none; }
    .btn-delete-sm {
        padding: 0.35rem 0.75rem;
        background: rgba(248,113,113,0.12);
        color: #f87171;
        border: 1px solid rgba(248,113,113,0.3);
        border-radius: 5px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
        font-family: inherit;
    }
    .btn-delete-sm:hover { background: #f87171; color: white; }
    .empty-state { padding: 4rem 2rem; text-align: center; color: #aca5db; }
</style>

<div class="payments-page">
    <div class="table-card">
        @if($payments->isEmpty())
            <div class="empty-state">No payment records found.</div>
        @else
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Method</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->order->rice_name }}</td>
                                <td class="td-amount">₱{{ number_format($payment->amount, 2) }}</td>
                                <td>
                                    @if($payment->status == 'paid')
                                        <span class="badge-paid">Paid</span>
                                    @else
                                        <span class="badge-unpaid">Unpaid</span>
                                    @endif
                                </td>
                                <td class="td-method">{{ $payment->payment_method }}</td>
                                <td class="td-date">{{ $payment->payment_date ? $payment->payment_date->format('M d, Y') : 'N/A' }}</td>
                                <td>
                                    <div class="td-actions">
                                        <a href="{{ route('payments.show', $payment) }}" class="btn-view-sm">View</a>
                                        <a href="{{ route('payments.edit', $payment) }}" class="btn-edit-sm">Edit</a>
                                        <form action="{{ route('payments.destroy', $payment) }}" method="POST" style="display:inline;"
                                            onsubmit="return confirm('Delete this payment?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
