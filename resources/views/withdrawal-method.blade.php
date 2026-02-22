@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Withdrawal Method | Cryptexa')

@section('content')

<!-- HEADER BAR -->
<div class="header fixed-top d-flex justify-content-between align-items-center px-16"
    style="
        background: linear-gradient(135deg, #020617, #0f172a);
        border-bottom: 1px solid rgba(56,189,248,0.2);
        backdrop-filter: blur(10px);
        z-index: 100;
        padding: 12px 16px;
    ">
    <a href="{{ route('account.settings') }}"
        style="
            width: 36px;
            height: 36px;
            background: rgba(56,189,248,0.1);
            border: 1px solid rgba(56,189,248,0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        "
        onmouseover="this.style.background='rgba(56,189,248,0.15)'; this.style.borderColor='rgba(56,189,248,0.4)';"
        onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.2)';">
        <i class="icon-left-btn" style="color: #38bdf8; font-size: 18px;"></i>
    </a>
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Withdrawal Method</h6>
    <span style="width: 36px;"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%);">
    <div class="tf-container">

        <!-- PAGE HEADER -->
        <div class="mb-32" style="animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 32px; margin: 0 0 12px 0;">Set Withdrawal Address</h1>
            <p class="text-secondary" style="font-size: 14px; margin: 0;">Choose your preferred cryptocurrency network</p>
        </div>

        @php
        $methods = [
            ['name'=>'USDT','symbol'=>'BEP20 (BSC)','currency'=>'usdtbsc','badge'=>'Recommended','variant'=>'success','img'=>'usdt.png','description'=>'Binance Smart Chain - Fastest & Cheapest'],
            ['name'=>'USDC','symbol'=>'BEP20 (BSC)','currency'=>'usdcbsc','badge'=>'Fast','variant'=>'primary','img'=>'usdc.png','description'=>'Circle USD Coin on BSC'],
            ['name'=>'USDT','symbol'=>'TRC20','currency'=>'usdttrc20','badge'=>'Alternative','variant'=>'warning','img'=>'usdt.png','description'=>'Tron Network - High Security'],
            ['name'=>'BNB','symbol'=>'BSC','currency'=>'bnbbsc','badge'=>'Native','variant'=>'accent','img'=>'bnb.png','description'=>'Binance Coin - Network Token'],
        ];
        @endphp

        <!-- METHODS GRID -->
        <div class="methods-grid">
            @foreach ($methods as $index => $method)
            <a href="#" class="method-card" data-anim-delay="{{ 0.12 * $index }}">
                <div class="method-icon">
                    <img src="{{ asset('images/coin/'.$method['img']) }}" alt="{{ $method['name'] }}">
                </div>
                <div class="method-info">
                    <div class="method-title">{{ $method['name'] }}</div>
                    <small class="method-sub">{{ $method['symbol'] }}</small>
                    <p class="method-desc">{{ $method['description'] }}</p>
                </div>
                <span class="badge badge-{{ $method['variant'] }}">{{ $method['badge'] }}</span>
            </a>
            @endforeach
        </div>

        <!-- INFO BOX -->
        <div style="
            background: linear-gradient(135deg, rgba(168,85,247,0.05) 0%, rgba(168,85,247,0.02) 100%);
            border: 1px solid rgba(168,85,247,0.15);
            border-radius: 16px;
            padding: 16px;
            animation: slideUp 0.6s ease 0.5s backwards;
        ">
            <p class="text-secondary" style="font-size: 12px; margin: 0; text-align: center;">
                <span style="color: #a855f7; font-weight: 600;">💡 Important</span> - Ensure your wallet address matches the selected network to avoid loss of funds
            </p>
        </div>

    </div>
</div>

<style>
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes cardIn {
        to { opacity: 1; transform: translateY(0); }
    }

    .methods-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
        margin-bottom: 32px;
        animation: slideUp 0.5s ease 0.1s backwards;
    }

    .method-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px;
        border-radius: 12px;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.01), rgba(255, 255, 255, 0.02));
        border: 1px solid rgba(255, 255, 255, 0.06);
        color: #e5e7eb;
        cursor: pointer;
        text-decoration: none;
        transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease;
        opacity: 0;
        transform: translateY(8px);
        animation: cardIn .45s forwards ease;
    }

    .method-card:active { transform: translateY(1px); }
    .method-card:hover {
        box-shadow: 0 8px 30px rgba(2, 6, 23, 0.6);
        border-color: rgba(56, 189, 248, 0.18);
    }

    .method-icon {
        width: 52px;
        height: 52px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.02);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .method-icon img {
        width: 34px;
        height: 34px;
        object-fit: contain;
    }

    .method-info { flex: 1; }
    .method-title { color: #e6edf3; font-weight: 800; font-size: 15px; }
    .method-sub { color: #94a3b8; font-size: 12px; }
    .method-desc { color: #64748b; font-size: 12px; margin: 6px 0 0 0; }

    .badge {
        padding: 6px 10px;
        font-size: 12px;
        font-weight: 700;
        border-radius: 999px;
        color: #fff;
    }

    .badge-primary { background: #2563eb; }
    .badge-success { background: #16a34a; }
    .badge-warning { background: #f59e0b; color: #0b1220; }
    .badge-accent { background: #7c3aed; }

    @media (max-width: 768px) {
        .pt-80 { padding-top: 80px !important; }
        .pb-80 { padding-bottom: 60px !important; }
        .mb-32 h1 { font-size: 24px !important; }
        .mb-32 { margin-bottom: 20px !important; }
    }

    @media (min-width: 900px) {
        .methods-grid { grid-template-columns: 1fr 1fr; gap: 16px; }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.method-card').forEach(function(el, idx) {
            var delay = parseFloat(el.dataset.animDelay) || 0;
            el.style.animationDelay = (0.05 + delay) + 's';
        });
    });
</script>

@endsection