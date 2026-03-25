@extends('layouts.app')

@section('hide-header', true)
@section('title', $plan->name . ' | Cryptexa')
@section('page-heading', $plan->name)

@push('styles')
<style>
    .plan-page {
        --panel: rgba(9, 18, 33, 0.94);
        --line: rgba(106, 227, 255, 0.14);
        --line-strong: rgba(106, 227, 255, 0.28);
        --text: #e8f0ff;
        --muted: rgba(232, 240, 255, 0.62);
        --accent: #6ae3ff;
        --success: #22c55e;
        --warning: #fbbf24;
        --violet: #a855f7;
        min-height: 100vh;
        background: radial-gradient(circle at top left, rgba(27, 184, 242, 0.12), transparent 28%), linear-gradient(180deg, #06101d 0%, #07111f 48%, #0a1422 100%);
        padding: 74px 14px 100px;
        color: var(--text);
    }

    .plan-shell {
        max-width: 880px;
        margin: 0 auto;
    }

    .plan-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 18px;
        padding-top: 4px;
    }

    .plan-back {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(180deg, rgba(10, 24, 42, 0.96), rgba(7, 18, 34, 0.92));
        border: 1px solid rgba(106, 227, 255, 0.18);
        color: var(--accent);
        box-shadow: 0 16px 34px rgba(0, 0, 0, 0.25);
    }

    .plan-back span {
        font-size: 1.75rem;
        line-height: 0.8;
        transform: translateX(-1px);
    }

    .plan-topbar h1 {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 700;
    }

    .plan-topbar .placeholder {
        width: 44px;
        height: 44px;
    }

    .plan-hero,
    .plan-card,
    .amount-chip,
    .plan-submit {
        position: relative;
        overflow: hidden;
        border: 1px solid var(--line);
        border-radius: 20px;
        background: linear-gradient(180deg, rgba(12, 24, 43, 0.94), var(--panel));
        box-shadow: 0 18px 46px rgba(0, 0, 0, 0.24);
    }

    .plan-hero::before,
    .plan-card::before,
    .amount-chip::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(106, 227, 255, 0.06), transparent 28%, transparent 72%, rgba(34, 197, 94, 0.04));
        pointer-events: none;
    }

    .plan-hero,
    .plan-card {
        padding: 16px;
        margin-bottom: 14px;
    }

    .plan-kicker {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 999px;
        background: rgba(106, 227, 255, 0.08);
        border: 1px solid rgba(106, 227, 255, 0.14);
        color: #b7f4ff;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .plan-hero h2 {
        margin: 12px 0 8px;
        font-size: clamp(1.75rem, 6vw, 2.45rem);
        line-height: 0.96;
        letter-spacing: -0.05em;
    }

    .plan-hero p {
        margin: 0;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.65;
    }

    .plan-hero-grid,
    .plan-stats,
    .returns-grid,
    .amount-grid {
        display: grid;
        gap: 10px;
    }

    .plan-hero-grid,
    .plan-stats,
    .returns-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .plan-hero-grid {
        margin-top: 14px;
    }

    .plan-metric,
    .plan-stat,
    .returns-row,
    .balance-row {
        padding: 12px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.04);
    }

    .plan-metric span,
    .plan-stat span,
    .returns-row span,
    .balance-row span,
    .card-label,
    .amount-note {
        display: block;
        color: var(--muted);
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .plan-metric strong,
    .plan-stat strong,
    .returns-row strong,
    .balance-row strong {
        display: block;
        margin-top: 4px;
        font-size: 15px;
        font-weight: 700;
    }

    .plan-stat.profit,
    .returns-card {
        background: rgba(34, 197, 94, 0.06);
        border-color: rgba(34, 197, 94, 0.16);
    }

    .plan-balance {
        margin-bottom: 14px;
    }

    .balance-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        border-color: rgba(168, 85, 247, 0.16);
        background: rgba(168, 85, 247, 0.06);
    }

    .balance-row strong {
        color: var(--violet);
        font-size: 18px;
    }

    .input-card {
        margin-bottom: 14px;
    }

    .amount-label {
        display: block;
        color: rgba(232, 240, 255, 0.86);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .amount-input {
        width: 100%;
        min-height: 58px;
        padding: 14px 16px;
        border-radius: 16px;
        background: rgba(6, 16, 30, 0.9);
        border: 1px solid rgba(106, 227, 255, 0.16);
        color: var(--text);
        font-size: 24px;
        font-weight: 800;
        outline: none;
        transition: border-color 0.22s ease, box-shadow 0.22s ease, background 0.22s ease;
    }

    .amount-input:focus {
        border-color: rgba(106, 227, 255, 0.34);
        box-shadow: 0 0 0 4px rgba(106, 227, 255, 0.08);
        background: rgba(8, 21, 39, 0.95);
    }

    .amount-note-row {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 8px;
    }

    .amount-note strong {
        color: var(--accent);
        font-size: 12px;
        font-weight: 700;
    }

    .amount-grid {
        grid-template-columns: repeat(5, minmax(0, 1fr));
        margin-bottom: 14px;
    }

    .amount-chip {
        min-height: 42px;
        border-radius: 14px;
        background: rgba(106, 227, 255, 0.06);
        border: 1px solid rgba(106, 227, 255, 0.12);
        color: var(--accent);
        font-size: 12px;
        font-weight: 700;
        transition: transform 0.2s ease, border-color 0.2s ease;
    }

    .amount-chip:hover {
        transform: translateY(-1px);
        border-color: rgba(106, 227, 255, 0.22);
    }

    .amount-chip.max {
        color: var(--violet);
        border-color: rgba(168, 85, 247, 0.16);
        background: rgba(168, 85, 247, 0.08);
    }

    .returns-card {
        display: none;
        padding: 16px;
        border-radius: 18px;
        margin-bottom: 14px;
    }

    .returns-card h3 {
        margin: 0 0 14px;
        font-size: 15px;
        font-weight: 700;
        color: #86efac;
    }

    .returns-grid {
        grid-template-columns: 1fr;
    }

    .returns-total {
        border-top: 1px solid rgba(34, 197, 94, 0.14);
        padding-top: 12px;
        margin-top: 2px;
    }

    .returns-total strong {
        font-size: 20px;
        color: #86efac;
    }

    .plan-submit {
        width: 100%;
        min-height: 56px;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.22), rgba(34, 197, 94, 0.12));
        border: 1px solid rgba(34, 197, 94, 0.26);
        color: #86efac;
        font-size: 14px;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition: transform 0.22s ease, box-shadow 0.22s ease;
        box-shadow: 0 12px 28px rgba(34, 197, 94, 0.14);
    }

    .plan-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 16px 32px rgba(34, 197, 94, 0.2);
    }

    .plan-info {
        padding: 14px 16px;
        border-radius: 16px;
        border: 1px solid rgba(168, 85, 247, 0.14);
        background: rgba(168, 85, 247, 0.06);
        text-align: center;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.55;
    }

    .plan-info strong {
        color: var(--violet);
    }

    .plan-error {
        margin-bottom: 14px;
        padding: 13px 14px;
        border-radius: 16px;
        border: 1px solid rgba(251, 113, 133, 0.24);
        background: rgba(251, 113, 133, 0.08);
        color: #fecdd3;
        font-size: 13px;
        font-weight: 600;
    }

    @media (max-width: 640px) {
        .amount-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (min-width: 768px) {
        .plan-page {
            padding: 82px 18px 110px;
        }

        .plan-hero,
        .plan-card {
            padding: 18px;
        }

        .returns-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }
</style>
@endpush

@section('content')
<div class="plan-page">
    <div class="plan-shell">
        <div class="plan-topbar">
            <a href="{{ url()->previous() }}" class="plan-back" aria-label="Go back">
                <span aria-hidden="true">&#8249;</span>
            </a>
            <h1>{{ __t('my_pools') }}</h1>
            <span class="placeholder"></span>
        </div>

        <section class="plan-hero">
            <span class="plan-kicker">Investment vault</span>
            <h2>{{ $plan->name }}</h2>
            <p>{{ $plan->description }}</p>

            <div class="plan-hero-grid">
                <div class="plan-metric">
                    <span>{{ __t('investment_range') }}</span>
                    <strong>
                        ${{ number_format($plan->price, 2) }}
                        @if($plan->max_investment)
                            - ${{ number_format($plan->max_investment, 2) }}
                        @else
                            - ∞
                        @endif
                    </strong>
                </div>
                <div class="plan-metric">
                    <span>{{ __t('duration') }}</span>
                    <strong>{{ $plan->duration_days }} {{ __t('days') }}</strong>
                </div>
            </div>
        </section>

        <section class="plan-card">
            <div class="plan-stats">
                <div class="plan-stat">
                    <span>{{ __t('investment_range') }}</span>
                    <strong>
                        ${{ number_format($plan->price, 2) }}
                        @if($plan->max_investment)
                            - ${{ number_format($plan->max_investment, 2) }}
                        @else
                            - ∞
                        @endif
                    </strong>
                </div>
                <div class="plan-stat">
                    <span>{{ __t('duration') }}</span>
                    <strong>{{ $plan->duration_days }} {{ __t('days') }}</strong>
                </div>
                <div class="plan-stat profit" style="grid-column:1 / -1;">
                    <span>{{ __t('daily_return') }} ({{ __t('fixed') }})</span>
                    <strong style="color:#86efac;">{{ number_format($plan->daily_profit, 2) }}%</strong>
                    <div style="margin-top:6px;color:#86efac;font-size:12px;">{{ __t('daily_compounding_returns') }}</div>
                </div>
            </div>
        </section>

        <form method="POST" action="{{ route('pools.activate', $plan->id) }}" id="activationForm">
            @csrf

            @if ($errors->any())
                <div class="plan-error">{{ $errors->first('amount') ?: $errors->first() }}</div>
            @endif

            <div class="plan-balance">
                <div class="balance-row">
                    <span>{{ __t('your_balance') }}</span>
                    <strong>${{ number_format(auth()->user()->balance, 2) }}</strong>
                </div>
            </div>

            <section class="plan-card input-card">
                <label class="amount-label" for="investmentAmount">{{ __t('enter_amount') }} (USDT)</label>
                <input
                    type="number"
                    name="amount"
                    id="investmentAmount"
                    class="amount-input"
                    step="0.01"
                    min="{{ $plan->price }}"
                    max="{{ $plan->max_investment ?? auth()->user()->balance }}"
                    value="{{ old('amount') }}"
                    placeholder="{{ number_format($plan->price, 2) }}"
                    required
                    oninput="calculateReturns()">

                <div class="amount-note-row">
                    <div class="amount-note">
                        <span>{{ __t('min') }}</span>
                        <strong>${{ number_format($plan->price, 2) }}</strong>
                    </div>
                    <div class="amount-note" style="text-align:right;">
                        <span>{{ __t('max') }}</span>
                        <strong>
                            @if($plan->max_investment)
                                ${{ number_format($plan->max_investment, 2) }}
                            @else
                                {{ __t('unlimited') }}
                            @endif
                        </strong>
                    </div>
                </div>
            </section>

            <div class="amount-grid">
                <button type="button" class="amount-chip" onclick="setAmount({{ $plan->price }})">${{ number_format($plan->price, 0) }}</button>
                <button type="button" class="amount-chip" onclick="setAmount({{ min($plan->max_investment ?? $plan->price * 2, $plan->price * 2) }})">${{ number_format(min($plan->max_investment ?? $plan->price * 2, $plan->price * 2), 0) }}</button>
                <button type="button" class="amount-chip" onclick="setAmount({{ min($plan->max_investment ?? $plan->price * 5, $plan->price * 5) }})">${{ number_format(min($plan->max_investment ?? $plan->price * 5, $plan->price * 5), 0) }}</button>
                <button type="button" class="amount-chip" onclick="setAmount({{ min($plan->max_investment ?? $plan->price * 10, $plan->price * 10) }})">${{ number_format(min($plan->max_investment ?? $plan->price * 10, $plan->price * 10), 0) }}</button>
                <button type="button" class="amount-chip max" onclick="setAmount({{ $plan->max_investment ?? auth()->user()->balance }})">MAX</button>
            </div>

            <div id="returnsCard" class="returns-card">
                <h3>{{ __t('projected_returns') }}</h3>
                <div class="returns-grid">
                    <div class="returns-row">
                        <span>{{ __t('investment') }}</span>
                        <strong id="investDisplay">$0.00</strong>
                    </div>
                    <div class="returns-row">
                        <span>{{ __t('expected_profit') }}</span>
                        <strong id="profitDisplay">$0.00</strong>
                    </div>
                    <div class="returns-row returns-total">
                        <span>{{ __t('expected_return') }}</span>
                        <strong id="totalDisplay">$0.00</strong>
                    </div>
                </div>
            </div>

            <button type="submit" id="activateBtn" class="plan-submit">{{ __t('activate_pool') }}</button>
        </form>

        <div class="plan-info" style="margin-top:14px;">
            <strong>{{ __t('locked_funds') }}</strong> - {{ __t('investment_locked_until_complete') }}
        </div>
    </div>
</div>

<script>
    const dailyProfit = {{ (float) $plan->daily_profit }};
    const days = {{ $plan->duration_days }};
    const minAmount = {{ (float) $plan->price }};
    const maxAmount = {{ (float) ($plan->max_investment ?? auth()->user()->balance) }};

    function setAmount(value) {
        const safeValue = Math.min(Math.max(value, minAmount), maxAmount);
        document.getElementById('investmentAmount').value = safeValue.toFixed(2);
        calculateReturns();
    }

    function calculateReturns() {
        const amount = parseFloat(document.getElementById('investmentAmount').value) || 0;
        const returnsCard = document.getElementById('returnsCard');

        if (amount >= minAmount && amount <= maxAmount) {
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

    window.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('investmentAmount');
        if (input.value) {
            calculateReturns();
        }
    });
</script>
@endsection
