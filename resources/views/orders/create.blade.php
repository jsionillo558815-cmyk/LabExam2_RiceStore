@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Create New Order
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
    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.75rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(113,104,195,0.25);
    }
    .form-header h3 { font-size: 1.25rem; font-weight: 700; color: #e5e2f3; margin: 0; }
    .btn-view-orders {
        padding: 0.5rem 1rem;
        background: transparent;
        color: #8f87cf;
        border: 1px solid rgba(113,104,195,0.4);
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .btn-view-orders:hover { background: rgba(113,104,195,0.15); color: #e5e2f3; text-decoration: none; }
    .form-group { display: flex; flex-direction: column; margin-bottom: 1.25rem; }
    .form-group label { font-size: 0.875rem; font-weight: 600; color: #aca5db; margin-bottom: 0.5rem; }
    .form-group input,
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
    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #7168c3;
        box-shadow: 0 0 0 3px rgba(113,104,195,0.2);
    }
    .form-group input[readonly] {
        background: rgba(113,104,195,0.08);
        color: #8f87cf;
        cursor: default;
        border-color: rgba(113,104,195,0.2);
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
        text-align: center;
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
        <div class="form-header">
            <h3>Create New Order</h3>
            <a href="{{ route('orders.index') }}" class="btn-view-orders">View Orders</a>
        </div>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Select Rice Product</label>
                <select name="products_id" id="product_select" required>
                    <option value="">— Select Available Rice —</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}"
                            data-name="{{ $product->rice_name }}"
                            data-price="{{ $product->price_per_kilo }}">
                            {{ $product->rice_name }} — ₱{{ number_format($product->price_per_kilo, 2) }}/kg (Stock: {{ $product->stock_per_kilo }}kg)
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Rice Name</label>
                <input type="text" id="rice_name" name="rice_name" required readonly placeholder="Auto-filled from selection">
            </div>
            <div class="form-group">
                <label>Price per Kilo (₱)</label>
                <input type="number" step="0.01" id="price_per_kilo" name="price_per_kilo" required readonly placeholder="Auto-filled">
            </div>
            <div class="form-group">
                <label>Quantity (kg)</label>
                <input type="number" id="quantity" name="quantity" required min="0.1" step="0.1" placeholder="Enter quantity in kg">
            </div>
            <div class="form-group">
                <label>Total Amount (₱)</label>
                <input type="number" step="0.01" id="total_amount" name="total_amount" required readonly placeholder="Auto-calculated">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-submit">Create Order</button>
                <a href="{{ route('orders.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('product_select').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    document.getElementById('rice_name').value = selectedOption.getAttribute('data-name') || '';
    document.getElementById('price_per_kilo').value = selectedOption.getAttribute('data-price') || '';
    calculateTotal();
});

document.getElementById('quantity').addEventListener('input', calculateTotal);

function calculateTotal() {
    const price = parseFloat(document.getElementById('price_per_kilo').value) || 0;
    const quantity = parseFloat(document.getElementById('quantity').value) || 0;
    document.getElementById('total_amount').value = (price * quantity).toFixed(2);
}
</script>
@endsection
