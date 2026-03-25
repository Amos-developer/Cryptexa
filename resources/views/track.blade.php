@extends('layouts.app')

@section('title', 'Compute Orders | Cryptexa')
@section('hide-header', true)

@push('styles')
<style>
    .track-page {
        --panel: rgba(9, 18, 33, 0.94);
        --line: rgba(106, 227, 255, 0.14);
        --line-strong: rgba(106, 227, 255, 0.28);
        --text: #e8f0ff;
        --muted: rgba(232, 240, 255, 0.62);
        --accent: #6ae3ff;
        --success: #22c55e;
        --warning: #fbbf24;
        min-height: 100vh;
        background: radial-gradient(circle at top left, rgba(27, 184, 242, 0.12), transparent 28%), linear-gradient(180deg, #06101d 0%, #07111f 48%, #0a1422 100%);
        padding: 74px 14px 100px;
        color: var(--text);
    }

    .track-shell {
        max-width: 980px;
        margin: 0 auto;
    }

    .track-topbar {
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        z-index: 40;
        width: min(980px, calc(100% - 28px));
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 18px;
        margin-top: 0;
        padding: 10px 12px;
        border: 1px solid rgba(106, 227, 255, 0.14);
        border-radius: 0 0 20px 20px;
        background: rgba(6, 16, 29, 0.82);
        backdrop-filter: blur(14px);
        box-shadow: 0 16px 34px rgba(0, 0, 0, 0.24);
    }

    .track-back {
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

    .track-back span {
        font-size: 1.75rem;
        line-height: 0.8;
        transform: translateX(-1px);
    }

    .track-topbar h1 {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 700;
        letter-spacing: 0.02em;
    }

    .track-topbar .placeholder {
        width: 44px;
        height: 44px;
    }

    .track-hero,
    .track-tabs,
    .track-order {
        position: relative;
        overflow: hidden;
        border: 1px solid var(--line);
        border-radius: 20px;
        background: linear-gradient(180deg, rgba(12, 24, 43, 0.94), var(--panel));
        box-shadow: 0 18px 46px rgba(0, 0, 0, 0.24);
    }

    .track-hero::before,
    .track-tabs::before,
    .track-order::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(106, 227, 255, 0.06), transparent 28%, transparent 72%, rgba(34, 197, 94, 0.04));
        pointer-events: none;
    }

    .track-hero {
        padding: 16px;
        margin-bottom: 14px;
    }

    .track-kicker {
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

    .track-hero h2 {
        margin: 12px 0 6px;
        font-size: clamp(1.6rem, 5vw, 2.35rem);
        line-height: 0.96;
        letter-spacing: -0.05em;
    }

    .track-hero p {
        margin: 0;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.6;
    }

    .track-hero-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 10px;
        margin-top: 14px;
    }

    .track-stat {
        padding: 11px 12px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.04);
    }

    .track-stat span {
        display: block;
        color: var(--muted);
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .track-stat strong {
        display: block;
        margin-top: 4px;
        font-size: 14px;
        font-weight: 700;
    }

    .track-tabs {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 8px;
        padding: 8px;
        margin-bottom: 14px;
    }

    .track-tab-btn {
        min-height: 46px;
        border-radius: 14px;
        border: 1px solid transparent;
        background: rgba(255, 255, 255, 0.03);
        color: var(--muted);
        font-size: 13px;
        font-weight: 700;
        transition: all 0.22s ease;
    }

    .track-tab-btn.active[data-tab="active"] {
        background: rgba(251, 191, 36, 0.1);
        border-color: rgba(251, 191, 36, 0.22);
        color: var(--warning);
    }

    .track-tab-btn.active[data-tab="completed"] {
        background: rgba(34, 197, 94, 0.1);
        border-color: rgba(34, 197, 94, 0.2);
        color: #86efac;
    }

    .track-list {
        display: grid;
        gap: 12px;
    }

    .track-order {
        padding: 16px;
    }

    .track-order-head,
    .track-order-foot,
    .track-meta-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .track-order-head {
        margin-bottom: 14px;
        align-items: flex-start;
    }

    .track-order-title {
        margin: 0 0 4px;
        font-size: 16px;
        font-weight: 700;
    }

    .track-order-id {
        color: var(--muted);
        font-size: 12px;
    }

    .track-badge {
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        white-space: nowrap;
    }

    .track-badge.active {
        background: rgba(251, 191, 36, 0.12);
        border: 1px solid rgba(251, 191, 36, 0.22);
        color: var(--warning);
    }

    .track-badge.completed {
        background: rgba(34, 197, 94, 0.12);
        border: 1px solid rgba(34, 197, 94, 0.2);
        color: #86efac;
    }

    .track-time-card,
    .track-countdown-card,
    .track-total-return {
        padding: 13px;
        border-radius: 15px;
        margin-bottom: 12px;
    }

    .track-time-card {
        background: rgba(106, 227, 255, 0.06);
        border: 1px solid rgba(106, 227, 255, 0.16);
    }

    .track-countdown-card {
        background: rgba(251, 191, 36, 0.06);
        border: 1px solid rgba(251, 191, 36, 0.16);
        text-align: center;
    }

    .track-card-label {
        color: var(--muted);
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 6px;
    }

    .track-time-card strong {
        display: block;
        color: var(--accent);
        font-size: 15px;
        font-weight: 700;
    }

    .countdown {
        color: var(--warning);
        font-size: 20px;
        font-weight: 800;
        letter-spacing: 0.02em;
    }

    .track-progress {
        margin-bottom: 12px;
    }

    .track-progress-top {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 6px;
        color: var(--muted);
        font-size: 11px;
    }

    .track-progress-bar {
        height: 7px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.06);
        overflow: hidden;
    }

    .track-progress-bar i {
        display: block;
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, #fbbf24, #f59e0b);
    }

    .track-order-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
        margin-bottom: 12px;
    }

    .track-mini {
        padding: 12px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.04);
    }

    .track-mini span {
        display: block;
        color: var(--muted);
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .track-mini strong {
        display: block;
        margin-top: 4px;
        font-size: 15px;
        font-weight: 700;
    }

    .track-total-return {
        background: rgba(34, 197, 94, 0.07);
        border: 1px solid rgba(34, 197, 94, 0.16);
        text-align: center;
    }

    .track-total-return strong {
        display: block;
        color: #86efac;
        font-size: 22px;
        font-weight: 800;
    }

    .track-order-foot {
        padding-top: 10px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        color: var(--muted);
        font-size: 12px;
    }

    .track-empty {
        padding: 34px 18px;
        border-radius: 18px;
        border: 1px dashed rgba(106, 227, 255, 0.16);
        background: rgba(255, 255, 255, 0.02);
        text-align: center;
        color: var(--muted);
    }

    .track-empty strong {
        display: block;
        margin-bottom: 8px;
        color: var(--text);
        font-size: 15px;
    }

    @media (min-width: 768px) {
        .track-page {
            padding: 82px 18px 110px;
        }

        .track-hero,
        .track-order {
            padding: 18px;
        }

        .track-topbar {
            width: min(980px, calc(100% - 36px));
            margin-top: 0;
        }
    }
</style>
@endpush

@section('content')
@php
    $activeCapital = $activeOrders->sum(fn ($order) => $order->principal_amount);
    $activeProfit = $activeOrders->sum('expected_profit');
@endphp

<div class="track-page">
    <div class="track-shell">
        <div class="track-topbar">
            <a href="{{ url()->previous() }}" class="track-back" aria-label="Go back">
                <span aria-hidden="true">&#8249;</span>
            </a>
            <h1>{{ __t('my_pools') }}</h1>
            <span class="placeholder"></span>
        </div>

        <section class="track-hero">
            <span class="track-kicker">Vault tracking</span>
            <h2>Monitor active and completed positions.</h2>
            <p>{{ __t('track_orders') }}</p>

            <div class="track-hero-grid">
                <div class="track-stat">
                    <span>Active</span>
                    <strong>{{ $activeOrders->count() }}</strong>
                </div>
                <div class="track-stat">
                    <span>Capital</span>
                    <strong>${{ number_format($activeCapital, 2) }}</strong>
                </div>
                <div class="track-stat">
                    <span>Expected Profit</span>
                    <strong style="color:#86efac;">+${{ number_format($activeProfit, 2) }}</strong>
                </div>
            </div>
        </section>

        <div class="track-tabs">
            <button class="track-tab-btn active" data-tab="active" onclick="showTab('active', this)">{{ __t('active_orders') }}</button>
            <button class="track-tab-btn" data-tab="completed" onclick="showTab('completed', this)">{{ __t('completed_orders') }}</button>
        </div>

        <div id="active-orders" class="track-list">
            @forelse($activeOrders as $order)
                @php
                    $remaining = max(0, now()->diffInSeconds($order->ends_at, false));
                    $totalDuration = $order->created_at->diffInSeconds($order->ends_at);
                    $elapsed = $order->created_at->diffInSeconds(now());
                    $progress = $totalDuration > 0 ? min(100, ($elapsed / $totalDuration) * 100) : 100;
                @endphp

                <div class="track-order">
                    <div class="track-order-head">
                        <div>
                            <h3 class="track-order-title">{{ optional($order->computePlan)->name ?? 'Compute Plan' }}</h3>
                            <div class="track-order-id">Order #{{ $order->id }}</div>
                        </div>
                        <span class="track-badge active">{{ __t('active_orders') }}</span>
                    </div>

                    <div class="track-time-card">
                        <div class="track-card-label">{{ __t('pool_ends_on') }}</div>
                        <strong>{{ $order->ends_at->format('l, F j, Y') }}</strong>
                        <div style="margin-top:4px;color:var(--accent);font-size:13px;">{{ $order->ends_at->format('g:i A') }} ({{ $order->ends_at->timezone->getName() }})</div>
                    </div>

                    <div class="track-countdown-card">
                        <div class="track-card-label">Time Remaining</div>
                        <div class="countdown" data-remaining="{{ $remaining }}"></div>
                    </div>

                    <div class="track-progress">
                        <div class="track-progress-top">
                            <span>Progress</span>
                            <strong style="color:#fbbf24;">{{ number_format($progress, 1) }}%</strong>
                        </div>
                        <div class="track-progress-bar">
                            <i style="width: {{ $progress }}%;"></i>
                        </div>
                    </div>

                    <div class="track-order-grid">
                        <div class="track-mini">
                            <span>Capital</span>
                            <strong>${{ number_format($order->principal_amount, 2) }}</strong>
                        </div>
                        <div class="track-mini">
                            <span>Expected Profit</span>
                            <strong style="color:#86efac;">+${{ number_format($order->expected_profit, 2) }}</strong>
                        </div>
                    </div>

                    <div class="track-total-return">
                        <div class="track-card-label">Total Return</div>
                        <strong>${{ number_format($order->total_return, 2) }}</strong>
                    </div>

                    <div class="track-order-foot">
                        <span>Started {{ $order->created_at->diffForHumans() }}</span>
                        <span>{{ optional($order->computePlan)->type ?? 'Vault' }}</span>
                    </div>
                </div>
            @empty
                <div class="track-empty">
                    <strong>{{ __t('no_active_orders') }}</strong>
                    <span>No live positions are running right now.</span>
                </div>
            @endforelse
        </div>

        <div id="completed-orders" class="track-list" style="display:none;">
            @forelse($completedOrders as $order)
                <div class="track-order">
                    <div class="track-order-head">
                        <div>
                            <h3 class="track-order-title">{{ optional($order->computePlan)->name ?? 'Compute Plan' }}</h3>
                            <div class="track-order-id">Order #{{ $order->id }}</div>
                        </div>
                        <span class="track-badge completed">{{ __t('completed') }}</span>
                    </div>

                    <div class="track-order-grid">
                        <div class="track-mini">
                            <span>Capital</span>
                            <strong>${{ number_format($order->principal_amount, 2) }}</strong>
                        </div>
                        <div class="track-mini">
                            <span>{{ __t('profit') }}</span>
                            <strong style="color:#86efac;">+${{ number_format($order->expected_profit, 2) }}</strong>
                        </div>
                    </div>

                    <div class="track-total-return" style="margin-bottom:0;">
                        <div class="track-card-label">Total Return</div>
                        <strong style="color:var(--accent);">${{ number_format($order->total_return, 2) }}</strong>
                    </div>

                    <div class="track-order-foot">
                        <span>Finished {{ $order->ends_at->diffForHumans() }}</span>
                        <span>{{ optional($order->computePlan)->type ?? 'Vault' }}</span>
                    </div>
                </div>
            @empty
                <div class="track-empty">
                    <strong>{{ __t('no_completed_orders') }}</strong>
                    <span>No completed positions yet.</span>
                </div>
            @endforelse
        </div>
    </div>
</div>

@include('partials.alerts')
<script>
    function showTab(tab, button) {
        const activeOrders = document.getElementById('active-orders');
        const completedOrders = document.getElementById('completed-orders');
        const allButtons = document.querySelectorAll('.track-tab-btn');

        activeOrders.style.display = tab === 'active' ? 'grid' : 'none';
        completedOrders.style.display = tab === 'completed' ? 'grid' : 'none';

        allButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
    }

    document.querySelectorAll('.countdown').forEach(el => {
        let seconds = parseInt(el.dataset.remaining, 10);

        function tick() {
            if (seconds <= 0) {
                el.innerText = 'Completed!';
                el.style.color = '#22c55e';
                setTimeout(() => window.location.href = window.location.href, 2000);
                return;
            }

            const d = Math.floor(seconds / 86400);
            const h = Math.floor((seconds % 86400) / 3600);
            const m = Math.floor((seconds % 3600) / 60);
            const s = seconds % 60;
            el.innerText = d > 0 ? `${d}d ${h}h ${m}m ${s}s` : `${h}h ${m}m ${s}s`;
            seconds--;
        }

        tick();
        setInterval(tick, 1000);
    });
</script>
@endsection
