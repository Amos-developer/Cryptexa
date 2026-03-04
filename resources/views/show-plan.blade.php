@extends('layouts.app')

@section('hide-header', true)
@section('title', $plan->name . ' | Cryptexa')

@section('content')

<link rel="stylesheet" href="{{ asset('css/team.css') }}">

<!-- HEADER BAR -->
<div class="team-header">
    <a href="{{ url()->previous() }}" class="back-btn">
        <i class="icon-left-btn"></i>
    </a>
    <h6 class="header-title">Vault Details</h6>
    <span class="placeholder"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%);">
    <div class="tf-container">

        <!-- HERO SECTION -->
        <div class="mb-32" style="animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 32px; margin: 0 0 12px 0;">
                {{ $plan->name }}
            </h1>
            <p class="text-secondary" style="font-size: 14px; margin: 0; line-height: 1.6;">
                {{ $plan->description }}
            </p>
        </div>

        <!-- PLAN DETAILS CARD -->
        <div style="
            background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
            border: 1px solid rgba(56,189,248,0.15);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(56,189,248,0.05), inset 0 0 20px rgba(56,189,248,0.03);
            backdrop-filter: blur(10px);
            margin-bottom: 24px;
            animation: slideUp 0.6s ease 0.1s backwards;
        ">

            <!-- DETAILS GRID -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">

                <!-- INVESTMENT RANGE -->
                <div style="
                    background: rgba(255,255,255,0.02);
                    padding: 16px;
                    border-radius: 12px;
                    border: 1px solid rgba(56,189,248,0.2);
                ">
                    <p style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 8px 0;">💰 {{ __t('investment_range') }}</p>
                    <h3 style="color: #38bdf8; font-size: 24px; font-weight: 900; margin: 0;">
                        ${{ number_format($plan->price, 2) }} -
                        @if($plan->max_investment)
                        ${{ number_format($plan->max_investment, 2) }}
                        @else
                        <span style="font-size: 20px;">∞</span>
                        @endif
                    </h3>
                </div>

                <!-- {{ __t('duration') }} -->
                <div style="
                    background: rgba(255,255,255,0.02);
                    padding: 16px;
                    border-radius: 12px;
                    border: 1px solid rgba(56,189,248,0.2);
                ">
                    <p style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 8px 0;">⏱️ {{ __t('duration') }}</p>
                    <h3 style="color: #e5e7eb; font-size: 24px; font-weight: 900; margin: 0;">
                        {{ $plan->duration_minutes }} min <span style="font-size: 14px; color: #94a3b8;">({{ $plan->duration_minutes / 1440 }} Days)</span>
                    </h3>
                </div>

            </div>

            <!-- PROFIT SECTION -->
            <div style="
                background: linear-gradient(135deg, rgba(34,197,94,0.08) 0%, rgba(34,197,94,0.02) 100%);
                border: 1px solid rgba(34,197,94,0.15);
                border-radius: 12px;
                padding: 16px;
            ">
                <p style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 8px 0;">📈 {{ __t('daily_return') }} ({{ __t('fixed') }})</p>
                <h3 style="color: #22c55e; font-size: 28px; font-weight: 900; margin: 0;">
                    {{ number_format($plan->daily_profit, 2) }}%
                </h3>
                <p style="color: #86efac; font-size: 12px; margin: 8px 0 0 0;">
                    {{ __t('daily_compounding_returns') }}
                </p>
            </div>

        </div>

        <!-- {{ __t('enter_amount') }} INPUT -->
        <form method="POST" action="{{ route('pools.activate', $plan->id) }}" id="activationForm" style="animation: slideUp 0.6s ease 0.2s backwards;">
            @csrf

            <!-- VALIDATION ERRORS -->
            @if ($errors->any())
            <div style="
                background: linear-gradient(135deg, rgba(239,68,68,0.1) 0%, rgba(239,68,68,0.05) 100%);
                border: 1px solid rgba(239,68,68,0.3);
                border-radius: 12px;
                padding: 14px;
                margin-bottom: 16px;
            ">
                <p style="color: #ef4444; font-size: 13px; font-weight: 600; margin: 0;">
                    ⚠️ {{ $errors->first('amount') ?: $errors->first() }}
                </p>
            </div>
            @endif

            <!-- USER BALANCE DISPLAY -->
            <div style="
                background: linear-gradient(135deg, rgba(168,85,247,0.08) 0%, rgba(168,85,247,0.02) 100%);
                border: 1px solid rgba(168,85,247,0.15);
                border-radius: 12px;
                padding: 14px 18px;
                margin-bottom: 16px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            ">
                <span style="color: #94a3b8; font-size: 13px; font-weight: 600;">💼 {{ __t('your_balance') }}</span>
                <span style="color: #a855f7; font-size: 18px; font-weight: 900;">${{ number_format(auth()->user()->balance, 2) }}</span>
            </div>

            <!-- AMOUNT INPUT CARD -->
            <div style="
                background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
                border: 1px solid rgba(56,189,248,0.15);
                border-radius: 16px;
                padding: 24px;
                margin-bottom: 16px;
                box-shadow: 0 10px 30px rgba(56,189,248,0.05);
            ">
                <label style="
                    display: block;
                    color: #94a3b8;
                    font-size: 13px;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    margin-bottom: 12px;
                ">💵 {{ __t('enter_amount') }} (USDT)</label>

                <div style="position: relative;">
                    <!-- <span style="
                        position: absolute;
                        left: 16px;
                        top: 50%;
                        transform: translateY(-50%);
                        color: #38bdf8;
                        font-size: 20px;
                        font-weight: 700;
                        pointer-events: none;
                    ">$</span> -->

                    <input
                        type="number"
                        name="amount"
                        id="investmentAmount"
                        step="0.01"
                        min="{{ $plan->price }}"
                        max="{{ $plan->max_investment ?? auth()->user()->balance }}"
                        value="{{ old('amount') }}"
                        placeholder="{{ number_format($plan->price, 2) }}"
                        required
                        style="
                            width: 100%;
                            padding: 16px 16px 16px 36px;
                            border-radius: 12px;
                            background: rgba(15,23,42,0.6);
                            border: 2px solid rgba(56,189,248,0.2);
                            color: #e5e7eb;
                            font-size: 24px;
                            font-weight: 700;
                            transition: all 0.3s ease;
                            outline: none;
                        "
                        onfocus="this.style.borderColor='rgba(56,189,248,0.5)'; this.style.background='rgba(15,23,42,0.8)';"
                        onblur="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='rgba(15,23,42,0.6)';"
                        oninput="calculateReturns()">
                </div>

                <div style="display: flex; justify-content: space-between; margin-top: 8px;">
                    <p style="color: #64748b; font-size: 12px; margin: 0;">
                        {{ __t('min') }}: <span style="color: #38bdf8; font-weight: 600;">${{ number_format($plan->price, 2) }}</span>
                    </p>
                    <p style="color: #64748b; font-size: 12px; margin: 0;">
                        {{ __t('max') }}: <span style="color: #a855f7; font-weight: 600;">
                            @if($plan->max_investment)
                            ${{ number_format($plan->max_investment, 2) }}
                            @else
                            {{ __t('unlimited') }}
                            @endif
                        </span>
                    </p>
                </div>
            </div>

            <!-- QUICK AMOUNT BUTTONS -->
            <div style="
                display: grid;
                grid-template-columns: repeat(5, 1fr);
                gap: 8px;
                margin-bottom: 16px;
            ">
                <button type="button" onclick="setAmount({{ $plan->price }})" style="
                    padding: 10px;
                    border-radius: 8px;
                    background: rgba(56,189,248,0.1);
                    border: 1px solid rgba(56,189,248,0.2);
                    color: #38bdf8;
                    font-size: 12px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.2s ease;
                "
                    onmouseover="this.style.background='rgba(56,189,248,0.15)'"
                    onmouseout="this.style.background='rgba(56,189,248,0.1)'">
                    ${{ number_format($plan->price, 0) }}
                </button>
                <button type="button" onclick="setAmount({{ $plan->price * 2 }})" style="
                    padding: 10px;
                    border-radius: 8px;
                    background: rgba(56,189,248,0.1);
                    border: 1px solid rgba(56,189,248,0.2);
                    color: #38bdf8;
                    font-size: 12px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.2s ease;
                "
                    onmouseover="this.style.background='rgba(56,189,248,0.15)'"
                    onmouseout="this.style.background='rgba(56,189,248,0.1)'">
                    ${{ number_format($plan->price * 2, 0) }}
                </button>
                <button type="button" onclick="setAmount({{ $plan->price * 5 }})" style="
                    padding: 10px;
                    border-radius: 8px;
                    background: rgba(56,189,248,0.1);
                    border: 1px solid rgba(56,189,248,0.2);
                    color: #38bdf8;
                    font-size: 12px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.2s ease;
                "
                    onmouseover="this.style.background='rgba(56,189,248,0.15)'"
                    onmouseout="this.style.background='rgba(56,189,248,0.1)'">
                    ${{ number_format($plan->price * 5, 0) }}
                </button>
                <button type="button" onclick="setAmount({{ $plan->price * 10 }})" style="
                    padding: 10px;
                    border-radius: 8px;
                    background: rgba(56,189,248,0.1);
                    border: 1px solid rgba(56,189,248,0.2);
                    color: #38bdf8;
                    font-size: 12px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.2s ease;
                "
                    onmouseover="this.style.background='rgba(56,189,248,0.15)'"
                    onmouseout="this.style.background='rgba(56,189,248,0.1)'">
                    ${{ number_format($plan->price * 10, 0) }}
                </button>
                <button type="button" onclick="setAmount({{ $plan->max_investment ?? auth()->user()->balance }})" style="
                    padding: 10px;
                    border-radius: 8px;
                    background: rgba(168,85,247,0.15);
                    border: 1px solid rgba(168,85,247,0.3);
                    color: #a855f7;
                    font-size: 12px;
                    font-weight: 700;
                    cursor: pointer;
                    transition: all 0.2s ease;
                "
                    onmouseover="this.style.background='rgba(168,85,247,0.2)'"
                    onmouseout="this.style.background='rgba(168,85,247,0.15)'">
                    MAX
                </button>
            </div>

            <!-- PROJECTED RETURNS CARD -->
            <div id="returnsCard" style="
                background: linear-gradient(135deg, rgba(34,197,94,0.08) 0%, rgba(34,197,94,0.02) 100%);
                border: 1px solid rgba(34,197,94,0.15);
                border-radius: 16px;
                padding: 20px;
                margin-bottom: 16px;
                display: none;
            ">
                <h6 style="color: #22c55e; font-weight: 700; font-size: 14px; margin: 0 0 16px 0;">📊 {{ __t('projected_returns') }}</h6>

                <div style="display: grid; gap: 12px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #94a3b8; font-size: 13px;">{{ __t('investment') }}</span>
                        <span id="investDisplay" style="color: #e5e7eb; font-weight: 700; font-size: 15px;">$0.00</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #94a3b8; font-size: 13px;">{{ __t('expected_profit') }}</span>
                        <span id="profitDisplay" style="color: #22c55e; font-weight: 700; font-size: 15px;">$0.00</span>
                    </div>
                    <div style="height: 1px; background: rgba(34,197,94,0.2); margin: 4px 0;"></div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #94a3b8; font-size: 13px; font-weight: 600;">{{ __t('expected_return') }}</span>
                        <span id="totalDisplay" style="color: #22c55e; font-weight: 900; font-size: 18px;">$0.00</span>
                    </div>
                </div>
            </div>

            <!-- ACTIVATION BUTTON -->
            <button type="submit" id="activateBtn"
                style="
                    width: 100%;
                    padding: 16px;
                    border-radius: 12px;
                    background: linear-gradient(135deg, rgba(34,197,94,0.2) 0%, rgba(34,197,94,0.1) 100%);
                    border: 1px solid rgba(34,197,94,0.3);
                    color: #22c55e;
                    font-weight: 700;
                    font-size: 15px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    box-shadow: 0 0 30px rgba(34,197,94,0.0);
                "
                onmouseover="this.style.background='linear-gradient(135deg, rgba(34,197,94,0.3) 0%, rgba(34,197,94,0.15) 100%)'; this.style.boxShadow='0 0 30px rgba(34,197,94,0.3)';"
                onmouseout="this.style.background='linear-gradient(135deg, rgba(34,197,94,0.2) 0%, rgba(34,197,94,0.1) 100%)'; this.style.boxShadow='0 0 30px rgba(34,197,94,0.0)';">
                🚀 {{ __t('activate_pool') }}
            </button>
        </form>

        <!-- INFO MESSAGE -->
        <div style="
            background: linear-gradient(135deg, rgba(168,85,247,0.08) 0%, rgba(168,85,247,0.02) 100%);
            border: 1px solid rgba(168,85,247,0.15);
            border-radius: 12px;
            padding: 14px;
            text-align: center;
            margin-top: 16px;
            margin-bottom: 24px;
            animation: slideUp 0.6s ease 0.3s backwards;
        ">
            <p class="text-secondary" style="font-size: 12px; margin: 0;">
                <span style="color: #a855f7; font-weight: 600;">🔒 {{ __t('locked_funds') }}</span> - {{ __t('investment_locked_until_complete') }}
            </p>
        </div>

        <!-- FEATURES SECTION
        <div style="
            background: linear-gradient(135deg, rgba(251,191,36,0.08) 0%, rgba(251,191,36,0.02) 100%);
            border: 1px solid rgba(251,191,36,0.15);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(251,191,36,0.05), inset 0 0 20px rgba(251,191,36,0.03);
            backdrop-filter: blur(10px);
            margin-bottom: 24px;
            animation: slideUp 0.6s ease 0.4s backwards;
        ">
            <h5 style="color: #fbbf24; font-weight: 700; font-size: 16px; margin: 0 0 16px 0;">💡 Pool Features</h5>

            <div style="display: grid; gap: 12px;">
                <div style="display: flex; gap: 12px; align-items: flex-start;">
                    <span style="color: #fbbf24; font-size: 18px; margin-top: 2px;">✓</span>
                    <div>
                        <p style="color: #e5e7eb; font-weight: 600; font-size: 13px; margin: 0 0 2px 0;">Compound Interest</p>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">Daily compounding for maximum returns</p>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; align-items: flex-start;">
                    <span style="color: #fbbf24; font-size: 18px; margin-top: 2px;">✓</span>
                    <div>
                        <p style="color: #e5e7eb; font-weight: 600; font-size: 13px; margin: 0 0 2px 0;">Auto-Completion</p>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">Pool automatically completes and profits are credited</p>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; align-items: flex-start;">
                    <span style="color: #fbbf24; font-size: 18px; margin-top: 2px;">✓</span>
                    <div>
                        <p style="color: #e5e7eb; font-weight: 600; font-size: 13px; margin: 0 0 2px 0;">Real-time Tracking</p>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">Monitor your investment progress in real-time</p>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; align-items: flex-start;">
                    <span style="color: #fbbf24; font-size: 18px; margin-top: 2px;">✓</span>
                    <div>
                        <p style="color: #e5e7eb; font-weight: 600; font-size: 13px; margin: 0 0 2px 0;">Secure & Audited</p>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">All pools are thoroughly audited and verified</p>
                    </div>
                </div>
            </div>
        </div> -->

    </div>
</div>

<!-- ANIMATIONS & STYLES -->
<script>
    const dailyProfit = {{ $plan->daily_profit }};
    const days = {{ $plan->duration_minutes / 1440 }};

    function setAmount(value) {
        document.getElementById('investmentAmount').value = value.toFixed(2);
        calculateReturns();
    }

    function calculateReturns() {
        const amount = parseFloat(document.getElementById('investmentAmount').value) || 0;
        const returnsCard = document.getElementById('returnsCard');

        if (amount >= {{ $plan->price }}) {
            const finalAmount = amount * Math.pow((1 + (dailyProfit / 100)), days);
            const profit = finalAmount - amount;
            const total = finalAmount;

            document.getElementById('investDisplay').textContent = '$' + amount.toFixed(2);
            document.getElementById('profitDisplay').textContent = '$' + profit.toFixed(2);
            document.getElementById('totalDisplay').textContent = '$' + total.toFixed(2);

            returnsCard.style.display = 'block';
        } else {
            returnsCard.style.display = 'none';
        }
    }

    window.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('investmentAmount');
        if (input.value) {
            calculateReturns();
        }
    });
</script>

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

        h1 {
            font-size: 24px !important;
        }

        h3 {
            font-size: 20px !important;
        }

        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
            gap: 12px !important;
        }

        [style*="grid-template-columns: repeat(5, 1fr)"] {
            grid-template-columns: repeat(3, 1fr) !important;
            gap: 6px !important;
        }

        [style*="grid-template-columns: repeat(5, 1fr)"] button {
            font-size: 11px !important;
            padding: 8px !important;
        }

        [style*="padding: 24px"] {
            padding: 16px !important;
        }

        [style*="padding: 16px"] {
            padding: 12px !important;
        }

        [style*="gap: 16px"] {
            gap: 12px !important;
        }

        .mb-32 {
            margin-bottom: 20px !important;
        }

        .mb-24 {
            margin-bottom: 18px !important;
        }

        #investmentAmount {
            font-size: 20px !important;
        }
    }

    /* TABLET RESPONSIVE */
    @media (min-width: 769px) and (max-width: 1024px) {
        h1 {
            font-size: 28px !important;
        }

        h3 {
            font-size: 22px !important;
        }
    }
</style>

@endsection