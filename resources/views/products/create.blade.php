@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Add New Rice Product
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
        margin: 0 0 1.75rem 0;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(113,104,195,0.25);
    }
    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 1.25rem;
    }
    .form-group label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #aca5db;
        margin-bottom: 0.5rem;
        text-transform: capitalize;
    }
    .form-group input,
    .form-group textarea,
    .form-group select {
        background: #0d0d20;
        border: 1px solid rgba(113,104,195,0.4);
        border-radius: 8px;
        padding: 12px;
        color: #e5e2f3;
        font-size: 1rem;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-family: inherit;
    }
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        outline: none;
        border-color: #7168c3;
        box-shadow: 0 0 0 3px rgba(113,104,195,0.2);
    }
    .form-group textarea { resize: vertical; min-height: 100px; }
    .form-actions { display: flex; gap: 0.75rem; margin-top: 1.75rem; }
    .btn-submit {
        padding: 0.75rem 1.75rem;
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
        padding: 0.75rem 1.75rem;
        background: transparent;
        color: #8f87cf;
        border: 1px solid rgba(113,104,195,0.4);
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: background 0.2s, color 0.2s;
        font-family: inherit;
    }
    .btn-cancel:hover { background: rgba(113,104,195,0.15); color: #e5e2f3; text-decoration: none; }
</style>

<div class="form-page">
    <div class="form-card">
        <h3>Add New Rice Product</h3>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Rice Name</label>
                <input type="text" name="rice_name" required placeholder="e.g., Jasmine Rice">
            </div>
            <div class="form-group">
                <label>Price per Kilo (₱)</label>
                <input type="number" step="0.01" name="price_per_kilo" required placeholder="e.g., 45.50">
            </div>
            <div class="form-group">
                <label>Stock per Kilo</label>
                <input type="number" step="0.01" name="stock_per_kilo" required placeholder="e.g., 100">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" placeholder="Optional product description..."></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-submit">Create Product</button>
                <a href="{{ route('products.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
