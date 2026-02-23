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
<link rel="stylesheet" href="{{ asset('css/choose-cryptocurrency.css') }}">

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
