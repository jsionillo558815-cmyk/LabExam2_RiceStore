@extends('layouts.app')

@section('content')
<style>
    .dash-wrap {
        max-width: 1280px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* ---- Breadcrumb header ---- */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.5rem;
        padding-bottom: 1.5rem;
        margin-bottom: 2rem;
        border-bottom: 1px solid rgba(113, 104, 195, 0.25);
    }

    .page-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-main);
        margin: 0;
    }

    .bc-trail {
        display: flex;
        align-items: center;
        gap: 0;
        list-style: none;
        margin: 0;
        padding: 0;
        font-size: 0.85rem;
    }

    .bc-trail li + li::before {
        content: '/';
        color: var(--text-muted);
        padding: 0 0.4rem;
    }

    .bc-trail a {
        color: var(--secondary-accent);
        text-decoration: none;
    }

    .bc-trail a:hover { color: var(--text-main); }

    .bc-trail .bc-active { color: var(--text-muted); }

    /* ---- Action cards ---- */
    .action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .action-card {
        background: var(--card-bg);
        border: 1px solid rgba(113, 104, 195, 0.25);
        border-radius: 12px;
        padding: 1.75rem;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 32px rgba(83, 74, 183, 0.2);
        border-color: var(--primary-accent);
    }

    .icon-box {
        width: 64px;
        height: 64px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1.25rem;
        flex-shrink: 0;
    }

    .icon-blue  { background: rgba(113, 104, 195, 0.15); }
    .icon-green { background: rgba(74, 222, 128, 0.15); }
    .icon-gold  { background: rgba(250, 204, 21, 0.15); }

    .action-card h5 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-main);
        margin: 0 0 0.5rem;
    }

    .action-card p {
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.6;
        margin: 0 0 1.5rem;
        flex-grow: 1;
    }

    .btn-stack {
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
        margin-top: auto;
    }

    .btn-main, .btn-outline {
        padding: 0.7rem 1.25rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        display: block;
        transition: all 0.25s ease;
        border: none;
        cursor: pointer;
        font-family: inherit;
    }

    .btn-main {
        background: linear-gradient(135deg, var(--primary-accent), var(--tertiary-accent));
        color: #fff;
    }

    .btn-main:hover {
        filter: brightness(1.15);
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(113, 104, 195, 0.35);
        color: #fff;
    }

    .btn-outline {
        background: transparent;
        color: var(--secondary-accent);
        border: 1.5px solid var(--primary-accent);
    }

    .btn-outline:hover {
        background: var(--primary-accent);
        color: #fff;
        transform: translateY(-2px);
    }

    /* ---- Stat cards ---- */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-box {
        background: var(--card-bg);
        border: 1px solid rgba(113, 104, 195, 0.25);
        border-radius: 12px;
        padding: 2rem 1.5rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .stat-box::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-accent), var(--secondary-accent));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.35s ease;
    }

    .stat-box:hover::after { transform: scaleX(1); }

    .stat-num {
        font-size: 2.25rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary-accent), var(--secondary-accent));
        -webkit-background-clip: text;
        background-clip: text;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-lbl {
        color: var(--text-muted);
        font-size: 0.875rem;
        font-weight: 500;
    }

    /* ---- Products section ---- */
    .section-card {
        background: var(--card-bg);
        border: 1px solid rgba(113, 104, 195, 0.25);
        border-radius: 12px;
        overflow: hidden;
    }

    .section-head {
        padding: 1.1rem 1.75rem;
        border-bottom: 1px solid rgba(113, 104, 195, 0.25);
    }

    .section-head h5 {
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-main);
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.25rem;
        padding: 1.5rem;
    }

    .product-box {
        background: var(--bg-color);
        border: 1px solid rgba(113, 104, 195, 0.25);
        border-top: 3px solid var(--primary-accent);
        border-radius: 10px;
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 32px rgba(83, 74, 183, 0.2);
    }

    .product-box h6 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-main);
        margin: 0 0 1rem;
    }

    .product-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px solid rgba(113, 104, 195, 0.2);
        font-size: 0.875rem;
    }

    .product-row:last-of-type { border-bottom: none; }

    .row-label { color: var(--text-muted); }
    .row-value { color: var(--secondary-accent); font-weight: 700; }

    .product-desc {
        color: var(--text-muted);
        font-size: 0.825rem;
        font-style: italic;
        line-height: 1.5;
        margin: 0.75rem 0 1rem;
        flex-grow: 1;
    }

    .product-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
        margin-top: auto;
    }

    .btn-sm {
        padding: 0.5rem 0.75rem;
        font-size: 0.8rem;
    }

    /* ---- Empty state ---- */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 3rem 1rem;
    }

    .empty-state p {
        color: var(--text-muted);
        margin-bottom: 1rem;
    }

    /* ---- Responsive ---- */
    @media (max-width: 640px) {
        .dash-wrap { padding: 1rem; }
        .page-header { flex-direction: column; align-items: flex-start; }
        .action-grid, .stats-grid { grid-template-columns: 1fr; }
        .products-grid { grid-template-columns: 1fr; }
        .product-actions { grid-template-columns: 1fr; }
    }
</style>

<div class="dash-wrap">

    {{-- Breadcrumb Header --}}
    <div class="page-header">
        <h4 class="page-title">Rice Store Dashboard</h4>
        <ol class="bc-trail">
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="bc-active">Dashboard</li>
        </ol>
    </div>

    {{-- Action Cards --}}
    <div class="action-grid">

        <div class="action-card">
            <div class="icon-box icon-blue">🌾</div>
            <h5>Add Rice Stocks</h5>
            <p>Add new rice varieties or update existing stock quantities to keep your inventory fresh and organized.</p>
            <div class="btn-stack">
                <a href="{{ route('products.create') }}" class="btn-main">+ New Product</a>
                <a href="{{ route('products.index') }}" class="btn-outline">View All</a>
            </div>
        </div>

        <div class="action-card">
            <div class="icon-box icon-green">🛒</div>
            <h5>Create Order</h5>
            <p>Place new orders with automatic calculations. Simple, fast, and efficient order processing system.</p>
            <div class="btn-stack">
                <a href="{{ route('orders.create') }}" class="btn-main">+ Create Order</a>
            </div>
        </div>

        <div class="action-card">
            <div class="icon-box icon-gold">💳</div>
            <h5>Process Payments</h5>
            <p>Handle cash and card payments securely. View complete payment history and transaction records.</p>
            <div class="btn-stack">
                <a href="{{ route('orders.index') }}?action=payment" class="btn-main">Make Payment</a>
                <a href="{{ route('payments.index') }}" class="btn-outline">History</a>
            </div>
        </div>

    </div>

    {{-- Statistics --}}
    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-num">{{ $totalProducts ?? 0 }}</div>
            <div class="stat-lbl">Rice Products Available</div>
        </div>
        <div class="stat-box">
            <div class="stat-num">{{ $totalOrders ?? 0 }}</div>
            <div class="stat-lbl">Total Orders Placed</div>
        </div>
        <div class="stat-box">
            <div class="stat-num">₱{{ number_format($totalPayments ?? 0, 0) }}</div>
            <div class="stat-lbl">Payment Collected</div>
        </div>
    </div>

    {{-- Products --}}
    <div class="section-card">
        <div class="section-head">
            <h5>📦 Available Rice Varieties</h5>
        </div>
        <div class="products-grid">
            @forelse($products ?? [] as $product)
                <div class="product-box">
                    <h6>{{ $product->rice_name }}</h6>

                    <div class="product-row">
                        <span class="row-label">Price per kg</span>
                        <span class="row-value">₱{{ number_format($product->price_per_kilo, 2) }}</span>
                    </div>

                    <div class="product-row">
                        <span class="row-label">Current Stock</span>
                        <span class="row-value">{{ $product->stock_per_kilo }} kg</span>
                    </div>

                    <p class="product-desc">{{ $product->description ?? 'Premium quality rice product' }}</p>

                    <div class="product-actions">
                        <a href="{{ route('orders.create') }}" class="btn-main btn-sm">Order Now</a>
                        <a href="{{ route('products.show', $product) }}" class="btn-outline btn-sm">Details</a>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <p>No rice products available yet.</p>
                    <a href="{{ route('products.create') }}" class="btn-main" style="display: inline-block;">Start by adding your first product →</a>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
