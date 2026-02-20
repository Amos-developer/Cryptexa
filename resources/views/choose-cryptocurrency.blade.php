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
        <form method="POST" action="{{ route('deposit.store') }}" style="animation: slideUp 0.6s ease 0.1s backwards;">

            @csrf

            @php
            $coins = [
            ['name'=>'USDT','symbol'=>'BEP20 (BSC)','currency'=>'usdtbsc','badge'=>'Recommended','color'=>'#16a34a','img'=>'usdt.png','description'=>'Binance Smart Chain - Fastest & Cheapest'],
            ['name'=>'USDC','symbol'=>'BEP20 (BSC)','currency'=>'usdcbsc','badge'=>'Fast','color'=>'#2563eb','img'=>'usdc.png','description'=>'Circle USD Coin on BSC'],
            ['name'=>'USDT','symbol'=>'TRC20','currency'=>'usdttrc20','badge'=>'Alternative','color'=>'#ca8a04','img'=>'usdt.png','description'=>'Tron Network - High Security'],
            ['name'=>'BNB','symbol'=>'BSC','currency'=>'bnbbsc','badge'=>'Native Token','color'=>'#f59e0b','img'=>'bnb.svg','description'=>'Binance Coin - Network Token'],
            ];
            @endphp

            <!-- COINS GRID -->
            <div style="display: grid; gap: 14px; margin-bottom: 32px;">
                @foreach ($coins as $index => $coin)
                <button
                    type="submit"
                    name="currency"
                    value="{{ $coin['currency'] }}"
                    style="
                        display: flex;
                        align-items: center;
                        gap: 16px;
                        padding: 18px;
                        border-radius: 16px;
                        background: linear-gradient(135deg, rgba(255,255,255,0.02) 0%, rgba(255,255,255,0.01) 100%);
                        border: 1px solid rgba(255,255,255,0.08);
                        text-align: left;
                        color: #e5e7eb;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        animation: slideIn 0.6s ease {{ 0.2 + ($index * 0.1) }}s backwards;
                    "
                    onmouseover="this.style.borderColor='rgba(56,189,248,0.3)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.05) 0%, rgba(56,189,248,0.02) 100%)'; this.style.boxShadow='0 0 20px rgba(56,189,248,0.1)';"
                    onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'; this.style.background='linear-gradient(135deg, rgba(255,255,255,0.02) 0%, rgba(255,255,255,0.01) 100%)'; this.style.boxShadow='none';">

                    <!-- COIN ICON -->
                    <div style="
                        width: 56px;
                        height: 56px;
                        border-radius: 12px;
                        background: rgba(56,189,248,0.1);
                        border: 1px solid rgba(56,189,248,0.2);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                    ">
                        <img src="{{ asset('images/coin/'.$coin['img']) }}"
                            style="width: 32px; height: 32px; object-fit: contain;">
                    </div>

                    <!-- COIN INFO -->
                    <div style="flex: 1;">
                        <div style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin-bottom: 4px;">
                            {{ $coin['name'] }}
                        </div>
                        <small style="color: #94a3b8; font-size: 12px;">{{ $coin['symbol'] }}</small>
                        <p style="color: #64748b; font-size: 11px; margin: 4px 0 0 0;">{{ $coin['description'] }}</p>
                    </div>

                    <!-- BADGE -->
                    <span style="
                        background: {{ $coin['color'] }};
                        color: #fff;
                        padding: 6px 12px;
                        font-size: 11px;
                        font-weight: 600;
                        border-radius: 999px;
                        white-space: nowrap;
                    ">
                        {{ $coin['badge'] }}
                    </span>
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
</style>

@endsection