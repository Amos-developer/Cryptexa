@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Choose Network | Cryptexa')

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
    <a href="{{ url()->previous() }}"
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
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Select Network</h6>
    <span style="width: 36px;"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%);">
    <div class="tf-container">

        <!-- PAGE HEADER -->
        <div class="mb-32" style="animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 32px; margin: 0 0 12px 0;">Choose Your Network</h1>
            <p class="text-secondary" style="font-size: 14px; margin: 0;">Select a cryptocurrency and network for your deposit</p>
        </div>

        <!-- DEPOSIT FORM -->
        <form method="POST" action="{{ route('deposit.store') }}" id="deposit-form" class="deposit-form">

            @csrf

            @php
            $coins = [
            ['name'=>'USDT','symbol'=>'BEP20 (BSC)','currency'=>'usdtbsc','badge'=>'Recommended','variant'=>'success','img'=>'usdt.png','description'=>'Binance Smart Chain - Fastest & Cheapest'],
            ['name'=>'USDC','symbol'=>'BEP20 (BSC)','currency'=>'usdcbsc','badge'=>'Fast','variant'=>'primary','img'=>'usdc.png','description'=>'Circle USD Coin on BSC'],
            ['name'=>'USDT','symbol'=>'TRC20','currency'=>'usdttrc20','badge'=>'Alternative','variant'=>'warning','img'=>'usdt.png','description'=>'Tron Network - High Security'],
            ['name'=>'BNB','symbol'=>'BSC','currency'=>'bnbbsc','badge'=>'Native','variant'=>'accent','img'=>'bnb.png','description'=>'Binance Coin - Network Token'],
            ];
            @endphp

            <!-- COINS GRID (mobile-first: single column) -->
            <div class="coins-grid">
                @foreach ($coins as $index => $coin)
                <button
                    type="submit"
                    name="currency"
                    value="{{ $coin['currency'] }}"
                    class="coin-card"
                    data-anim-delay="{{ 0.12 * $index }}">

                    <div class="coin-icon">
                        <img src="{{ asset('images/coin/'.$coin['img']) }}" alt="{{ $coin['name'] }}">
                    </div>

                    <div class="coin-info">
                        <div class="coin-title">{{ $coin['name'] }}</div>
                        <small class="coin-sub">{{ $coin['symbol'] }}</small>
                        <p class="coin-desc">{{ $coin['description'] }}</p>
                    </div>

                    <span class="badge badge-{{ $coin['variant'] }}">{{ $coin['badge'] }}</span>
                </button>
                @endforeach
            </div>

        </form>

        <!-- INFO BOXES -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 32px;">
            <!-- HOW IT WORKS -->
            <div style="
                background: linear-gradient(135deg, rgba(56,189,248,0.05) 0%, rgba(56,189,248,0.02) 100%);
                border: 1px solid rgba(56,189,248,0.15);
                border-radius: 16px;
                padding: 20px;
                box-shadow: 0 10px 30px rgba(56,189,248,0.05), inset 0 0 20px rgba(56,189,248,0.03);
                backdrop-filter: blur(10px);
                animation: slideUp 0.6s ease 0.3s backwards;
            ">
                <h6 style="color: #38bdf8; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 14px 0;">📋 How It Works</h6>
                <ol style="color: #94a3b8; font-size: 13px; padding-left: 16px; margin: 0; line-height: 1.8;">
                    <li>Select your preferred network</li>
                    <li>Scan the QR code to send funds</li>
                    <li>Balance updates automatically</li>
                </ol>
            </div>

            <!-- NETWORK INFO -->
            <div style="
                background: linear-gradient(135deg, rgba(34,197,94,0.05) 0%, rgba(34,197,94,0.02) 100%);
                border: 1px solid rgba(34,197,94,0.15);
                border-radius: 16px;
                padding: 20px;
                box-shadow: 0 10px 30px rgba(34,197,94,0.05), inset 0 0 20px rgba(34,197,94,0.03);
                backdrop-filter: blur(10px);
                animation: slideUp 0.6s ease 0.4s backwards;
            ">
                <h6 style="color: #22c55e; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 14px 0;">💡 Pro Tips</h6>
                <ul style="color: #94a3b8; font-size: 13px; padding-left: 16px; margin: 0; line-height: 1.8;">
                    <li>BEP20 offers lowest fees</li>
                    <li>TRC20 provides high security</li>
                    <li>All networks are secure</li>
                </ul>
            </div>
        </div>

        <!-- SECURITY MESSAGE -->
        <div style="
            background: linear-gradient(135deg, rgba(168,85,247,0.05) 0%, rgba(168,85,247,0.02) 100%);
            border: 1px solid rgba(168,85,247,0.15);
            border-radius: 16px;
            padding: 16px;
            text-align: center;
            animation: slideUp 0.6s ease 0.5s backwards;
        ">
            <p class="text-secondary" style="font-size: 12px; margin: 0;">
                <span style="color: #a855f7; font-weight: 600;">🔐 Secure & Verified</span> - All networks are thoroughly audited and secured by industry-leading standards
            </p>
        </div>

    </div>
</div>

<!-- ANIMATIONS & STYLES -->
<style>
    /* App design tokens (override with global tokens if available) */
    :root {
        --color-primary: #2563eb;
        --color-success: #16a34a;
        --color-warning: #f59e0b;
        --color-accent: #7c3aed;
        --badge-text-dark: #0b1220;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-15px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* MOBILE RESPONSIVE */
    @media (max-width: 768px) {
        .pt-80 {
            padding-top: 80px !important;
        }

        .pb-80 {
            padding-bottom: 60px !important;
        }

        .mb-32 h1 {
            font-size: 24px !important;
        }

        .mb-32 {
            margin-bottom: 20px !important;
        }

        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
            gap: 12px !important;
        }

        [style*="padding: 20px"] {
            padding: 16px !important;
        }

        [style*="padding: 18px"] {
            padding: 14px !important;
        }

        [style*="gap: 16px"] {
            gap: 12px !important;
        }

        [style*="gap: 14px"] {
            gap: 10px !important;
        }

        .mb-32 {
            margin-bottom: 18px !important;
        }

        ol,
        ul {
            font-size: 12px !important;
        }
    }

    /* TABLET RESPONSIVE */
    @media (min-width: 769px) and (max-width: 1024px) {
        .mb-32 h1 {
            font-size: 28px !important;
        }

        [style*="gap: 16px"] {
            gap: 14px !important;
        }
    }

    /* Coins grid and card styles */
    .coins-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
        margin-bottom: 32px;
        animation: slideUp 0.5s ease 0.1s backwards;
    }

    .coin-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px;
        border-radius: 12px;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.01), rgba(255, 255, 255, 0.02));
        border: 1px solid rgba(255, 255, 255, 0.06);
        color: #e5e7eb;
        cursor: pointer;
        text-align: left;
        transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease;
        width: 100%;
    }

    .coin-card:active {
        transform: translateY(1px);
    }

    .coin-card:hover {
        box-shadow: 0 8px 30px rgba(2, 6, 23, 0.6);
        border-color: rgba(56, 189, 248, 0.18);
    }

    .coin-icon {
        width: 52px;
        height: 52px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.02);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .coin-icon img {
        width: 34px;
        height: 34px;
        object-fit: contain;
    }

    .coin-info {
        flex: 1;
    }

    .coin-title {
        color: #e6edf3;
        font-weight: 800;
        font-size: 15px;
    }

    .coin-sub {
        color: #94a3b8;
        font-size: 12px;
    }

    .coin-desc {
        color: #64748b;
        font-size: 12px;
        margin: 6px 0 0 0;
    }

    /* Badges (use design tokens via data-variant) */
    .badge {
        padding: 6px 10px;
        font-size: 12px;
        font-weight: 700;
        border-radius: 999px;
        color: #fff;
        display: inline-block;
    }

    .badge[data-variant="primary"] {
        background: var(--color-primary);
    }

    .badge[data-variant="success"] {
        background: var(--color-success);
    }

    .badge[data-variant="warning"] {
        background: var(--color-warning);
        color: var(--badge-text-dark);
    }

    .badge[data-variant="accent"] {
        background: var(--color-accent);
    }

    /* Desktop: two-column grid */
    @media (min-width: 900px) {
        .coins-grid {
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
    }

    /* Anim delays via data attribute */
    .coin-card {
        opacity: 0;
        transform: translateY(8px);
        animation: cardIn .45s forwards ease;
    }

    @keyframes cardIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Loading overlay when submit */
    .loading-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(2, 6, 23, 0.6);
        align-items: center;
        justify-content: center;
        z-index: 120;
    }

    .loading-overlay.show {
        display: flex;
    }

    .spinner {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        border: 6px solid rgba(255, 255, 255, 0.08);
        border-top-color: #38bdf8;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

@endsection

@section('scripts')
<div id="deposit-loading" class="loading-overlay">
    <div class="spinner" aria-hidden="true"></div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // stagger animation delays
        document.querySelectorAll('.coin-card').forEach(function(el, idx) {
            var delay = parseFloat(el.dataset.animDelay) || 0;
            el.style.animationDelay = (0.05 + delay) + 's';
        });

        var form = document.getElementById('deposit-form');
        if (!form) return;

        form.addEventListener('submit', function(e) {
            // show loading overlay to indicate redirect
            document.getElementById('deposit-loading').classList.add('show');

            // disable all buttons to prevent double submit
            form.querySelectorAll('button').forEach(function(b) {
                b.disabled = true;
            });
        });
    });
</script>
@endsection