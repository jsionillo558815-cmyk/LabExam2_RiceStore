@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Rice Store Dashboard') }}
    </h2>
@endsection

@section('content')
<style>
    :root {
        --bg-color: #0d0d20;
        --card-bg: #1a193e;
        --text-main: #e5e2f3;
        --text-muted: #aca5db;
        --primary-accent: #7168c3;
        --secondary-accent: #8f87cf;
        --tertiary-accent: #534ab7;
        --border-color: rgba(113, 104, 195, 0.25);
        --success: #4ade80;
        --warning: #facc15;
    }

    * {
        box-sizing: border-box;
    }

    body {
        background-color: var(--bg-color);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-main);
    }

    .dashboard-container {
        padding: 2rem 1rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Header Section */
    .dashboard-header {
        margin-bottom: 4rem;
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(113, 104, 195, 0.08) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
    }

    .header-content {
        position: relative;
        z-index: 1;
    }

    .header-title {
        font-size: 3.5rem;
        font-weight: 700;
        margin: 0 0 0.5rem 0;
        background: linear-gradient(135deg, var(--primary-accent) 0%, var(--secondary-accent) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -1px;
        animation: slideInDown 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .header-subtitle {
        font-size: 1.1rem;
        color: var(--text-muted);
        font-weight: 300;
        animation: slideInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Action Cards Grid */
    .action-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2rem;
        margin-bottom: 4rem;
    }

    .action-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        animation: fadeInScale 0.6s ease-out backwards;
    }

    .action-card:nth-child(1) { animation-delay: 0.1s; }
    .action-card:nth-child(2) { animation-delay: 0.2s; }
    .action-card:nth-child(3) { animation-delay: 0.3s; }

    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .action-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(113, 104, 195, 0) 0%, rgba(113, 104, 195, 0.04) 100%);
        pointer-events: none;
    }

    .action-card:hover {
        border-color: var(--primary-accent);
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(83, 74, 183, 0.2);
    }

    .card-icon-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        font-size: 2.5rem;
        font-weight: bold;
    }

    .card-icon-wrapper.blue {
        background: rgba(113, 104, 195, 0.15);
        color: var(--secondary-accent);
    }

    .card-icon-wrapper.green {
        background: rgba(74, 222, 128, 0.15);
        color: var(--success);
    }

    .card-icon-wrapper.terracotta {
        background: rgba(250, 204, 21, 0.15);
        color: var(--warning);
    }

    .action-card h3 {
        font-size: 1.4rem;
        margin: 1rem 0 0.5rem 0;
        font-weight: 600;
        color: var(--text-main);
    }

    .action-card p {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .card-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .btn {
        padding: 0.9rem 1.5rem;
        border: none;
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-accent) 0%, var(--tertiary-accent) 100%);
        color: white;
    }

    .btn-primary:hover {
        filter: brightness(1.15);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(113, 104, 195, 0.35);
        text-decoration: none;
        color: white;
    }

    .btn-secondary {
        background: transparent;
        color: var(--secondary-accent);
        border: 1.5px solid var(--primary-accent);
    }

    .btn-secondary:hover {
        background: var(--primary-accent);
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
    }

    /* Stats Section */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 4rem;
    }

    .stat-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 2.5rem 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        animation: fadeInScale 0.6s ease-out backwards;
    }

    .stat-card:nth-child(1) { animation-delay: 0.4s; }
    .stat-card:nth-child(2) { animation-delay: 0.5s; }
    .stat-card:nth-child(3) { animation-delay: 0.6s; }

    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-accent) 0%, var(--secondary-accent) 100%);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .stat-card:hover::after {
        transform: scaleX(1);
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary-accent) 0%, var(--secondary-accent) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--text-muted);
        font-size: 0.95rem;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    /* Products Section */
    .products-header {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--border-color);
    }

    .products-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-main);
        margin: 0;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }

    .product-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        animation: fadeInScale 0.6s ease-out backwards;
    }

    .product-card:nth-child(1) { animation-delay: 0.1s; }
    .product-card:nth-child(2) { animation-delay: 0.2s; }
    .product-card:nth-child(3) { animation-delay: 0.3s; }

    .product-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--tertiary-accent), var(--primary-accent), var(--secondary-accent));
    }

    .product-card:hover {
        border-color: var(--primary-accent);
        transform: translateY(-12px);
        box-shadow: 0 25px 50px rgba(83, 74, 183, 0.2);
    }

    .product-name {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--text-main);
    }

    .product-detail {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.8rem;
        padding-bottom: 0.8rem;
        border-bottom: 1px solid var(--border-color);
    }

    .product-detail:last-of-type {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 1.5rem;
    }

    .detail-label {
        color: var(--text-muted);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .detail-value {
        color: var(--secondary-accent);
        font-weight: 700;
        font-size: 1.1rem;
    }

    .product-description {
        color: var(--text-muted);
        font-size: 0.85rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
        font-style: italic;
    }

    .product-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
    }

    .btn-small {
        padding: 0.75rem 1rem;
        font-size: 0.85rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .btn-small-primary {
        background: var(--primary-accent);
        color: white;
    }

    .btn-small-primary:hover {
        filter: brightness(1.15);
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }

    .btn-small-secondary {
        background: transparent;
        color: var(--secondary-accent);
        border: 1.5px solid var(--primary-accent);
    }

    .btn-small-secondary:hover {
        background: var(--primary-accent);
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        background: var(--card-bg);
        border-radius: 16px;
        border: 2px dashed var(--border-color);
    }

    .empty-state p {
        color: var(--text-muted);
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    .empty-state a {
        color: var(--secondary-accent);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .empty-state a:hover {
        color: var(--text-main);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem;
        }

        .header-title {
            font-size: 2.2rem;
        }

        .action-cards {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .products-grid {
            grid-template-columns: 1fr;
        }

        .product-actions {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-container">
    <!-- Header Section -->
    <div class="dashboard-header">
        <div class="header-content">
            <h1 class="header-title">Bugasan ni Sio</h1>
            <p class="header-subtitle">Manage inventory, orders, and payments seamlessly</p>
        </div>
    </div>

    <!-- Main Action Cards -->
    <div class="action-cards">
        <!-- Add Rice Stocks -->
        <div class="action-card">
            <div class="card-icon-wrapper blue">🌾</div>
            <h3>Add Rice Stocks</h3>
            <p>Add new rice varieties or update existing stock quantities to keep your inventory fresh and organized.</p>
            <div class="card-buttons">
                <a href="{{ route('products.create') }}" class="btn btn-primary">+ New Product</a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">View All</a>
            </div>
        </div>

        <!-- Create Order -->
        <div class="action-card">
            <div class="card-icon-wrapper green">🛒</div>
            <h3>Create Order</h3>
            <p>Place new orders with automatic calculations. Simple, fast, and efficient order processing system.</p>
            <div class="card-buttons">
                <a href="{{ route('orders.create') }}" class="btn btn-primary">+ Create Order</a>
            </div>
        </div>

        <!-- Process Payments -->
        <div class="action-card">
            <div class="card-icon-wrapper terracotta">💳</div>
            <h3>Process Payments</h3>
            <p>Handle cash and card payments securely. View complete payment history and transaction records.</p>
            <div class="card-buttons">
                <a href="{{ route('orders.index') }}?action=payment" class="btn btn-primary">Make Payment</a>
                <a href="{{ route('payments.index') }}" class="btn btn-secondary">History</a>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $totalProducts ?? 0 }}</div>
            <div class="stat-label">Rice Products Available</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $totalOrders ?? 0 }}</div>
            <div class="stat-label">Total Orders Placed</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">₱{{ number_format($totalPayments ?? 0, 0) }}</div>
            <div class="stat-label">Payment Collected</div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="products-header">
        <h2 class="products-title">📦 Available Rice Varieties</h2>
    </div>

    <div class="products-grid">
        @forelse($products ?? [] as $product)
            <div class="product-card">
                <h4 class="product-name">{{ $product->rice_name }}</h4>
                
                <div class="product-detail">
                    <span class="detail-label">Price per kg</span>
                    <span class="detail-value">₱{{ number_format($product->price_per_kilo, 2) }}</span>
                </div>

                <div class="product-detail">
                    <span class="detail-label">Current Stock</span>
                    <span class="detail-value">{{ $product->stock_per_kilo }} kg</span>
                </div>

                <p class="product-description">{{ $product->description ?? 'Premium quality rice product' }}</p>

                <div class="product-actions">
                    <a href="{{ route('orders.create') }}" class="btn-small btn-small-primary">Order Now</a>
                    <a href="{{ route('products.show', $product) }}" class="btn-small btn-small-secondary">Details</a>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <p>No rice products available yet.</p>
                <a href="{{ route('products.create') }}">Start by adding your first product →</a>
            </div>
        @endforelse
    </div>
</div>

@endsection