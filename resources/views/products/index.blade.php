@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        All Products
    </h2>
@endsection

@section('content')
<style>
    .products-page { padding: 2.5rem 1rem; max-width: 1200px; margin: 0 auto; }
    .page-actions { margin-bottom: 1.75rem; }
    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #7168c3 0%, #534ab7 100%);
        color: white;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 600;
        text-decoration: none;
        transition: filter 0.2s, transform 0.2s;
    }
    .btn-add:hover { filter: brightness(1.15); transform: translateY(-1px); text-decoration: none; color: white; }
    .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 1.5rem; }
    .product-card {
        background: #1a193e;
        border: 1px solid rgba(113,104,195,0.25);
        border-radius: 12px;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        transition: border-color 0.3s, transform 0.3s, box-shadow 0.3s;
    }
    .product-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, #534ab7, #7168c3, #8f87cf);
    }
    .product-card:hover {
        border-color: #7168c3;
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(83,74,183,0.2);
    }
    .product-card h2 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #e5e2f3;
        margin: 0 0 1rem 0;
        border-bottom: none;
        padding-bottom: 0;
    }
    .product-meta { margin-bottom: 0.6rem; }
    .product-meta .meta-label { font-size: 0.8rem; color: #aca5db; font-weight: 500; }
    .product-meta .meta-value { font-size: 1rem; color: #8f87cf; font-weight: 700; }
    .product-desc { font-size: 0.875rem; color: #aca5db; font-style: italic; margin: 0.75rem 0 1.25rem; line-height: 1.5; }
    .card-actions { display: flex; gap: 0.6rem; flex-wrap: wrap; }
    .btn-view {
        padding: 0.5rem 1rem;
        background: rgba(113,104,195,0.15);
        color: #8f87cf;
        border: 1px solid rgba(113,104,195,0.35);
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .btn-view:hover { background: #7168c3; color: white; text-decoration: none; }
    .btn-edit {
        padding: 0.5rem 1rem;
        background: rgba(143,135,207,0.12);
        color: #8f87cf;
        border: 1px solid rgba(143,135,207,0.3);
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
    }
    .btn-edit:hover { background: #8f87cf; color: #0d0d20; text-decoration: none; }
    .btn-delete {
        padding: 0.5rem 1rem;
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
    .btn-delete:hover { background: #f87171; color: white; }
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: #1a193e;
        border: 2px dashed rgba(113,104,195,0.25);
        border-radius: 12px;
        color: #aca5db;
    }
    .empty-state a { color: #8f87cf; font-weight: 600; }
    @media (max-width: 640px) { .products-grid { grid-template-columns: 1fr; } }
</style>

<div class="products-page">
    <div class="page-actions">
        <a href="{{ route('products.create') }}" class="btn-add">+ Add Product</a>
    </div>

    @if($products->isEmpty())
        <div class="empty-state">
            <p style="font-size:1rem;margin-bottom:1rem;">No products found.</p>
            <a href="{{ route('products.create') }}">Add your first product →</a>
        </div>
    @else
        <div class="products-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <h2>{{ $product->rice_name }}</h2>
                    <div class="product-meta">
                        <div class="meta-label">Price per kg</div>
                        <div class="meta-value">₱{{ number_format($product->price_per_kilo, 2) }}</div>
                    </div>
                    <div class="product-meta">
                        <div class="meta-label">Stock</div>
                        <div class="meta-value">{{ $product->stock_per_kilo }} kg</div>
                    </div>
                    @if($product->description)
                        <p class="product-desc">{{ $product->description }}</p>
                    @endif
                    <div class="card-actions">
                        <a href="{{ route('products.show', $product) }}" class="btn-view">View</a>
                        <a href="{{ route('products.edit', $product) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete"
                                onclick="return confirm('Delete this product?')">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
