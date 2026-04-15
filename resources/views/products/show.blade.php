@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $product->rice_name }}
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
    .detail-card h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #e5e2f3;
        margin: 0 0 1.5rem 0;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(113,104,195,0.25);
        background: none;
        -webkit-text-fill-color: #e5e2f3;
    }
    .detail-row {
        display: flex;
        flex-direction: column;
        padding: 0.9rem 0;
        border-bottom: 1px solid rgba(113,104,195,0.15);
    }
    .detail-row:last-of-type { border-bottom: none; }
    .detail-label { font-size: 0.8rem; font-weight: 600; color: #aca5db; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.3rem; }
    .detail-value { font-size: 1rem; color: #e5e2f3; font-weight: 500; }
    .detail-value.highlight { color: #8f87cf; font-weight: 700; font-size: 1.1rem; }
    .detail-actions { display: flex; gap: 0.75rem; margin-top: 1.75rem; }
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
</style>

<div class="detail-page">
    <div class="detail-card">
        <h1>{{ $product->rice_name }}</h1>

        <div class="detail-row">
            <span class="detail-label">Price per Kilogram</span>
            <span class="detail-value highlight">₱{{ number_format($product->price_per_kilo, 2) }}/kg</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Stock Quantity</span>
            <span class="detail-value highlight">{{ $product->stock_per_kilo }} kg</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Description</span>
            <span class="detail-value">{{ $product->description ?? 'No description provided.' }}</span>
        </div>

        <div class="detail-actions">
            <a href="{{ route('products.index') }}" class="btn-back">← Back</a>
            <a href="{{ route('products.edit', $product) }}" class="btn-edit">Edit Product</a>
        </div>
    </div>
</div>
@endsection
