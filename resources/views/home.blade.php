@extends('layouts.app')

@section('title', 'Home | Cryptexa')

@push('styles')
<style>
    .trade-home {
        --panel: linear-gradient(180deg, rgba(10, 20, 36, 0.94), rgba(8, 19, 35, 0.92));
        --line: rgba(106, 227, 255, 0.16);
        --line-strong: rgba(106, 227, 255, 0.34);
        --text: #e8f0ff;
        --muted: rgba(232, 240, 255, 0.62);
        --accent: #6ae3ff;
        --accent-strong: #1bb8f2;
        --success: #22c55e;
        --warning: #fbbf24;
        --danger: #fb7185;
        max-width: 1180px;
        margin: 0 auto;
        padding: 84px 14px 110px;
        color: var(--text);
    }

    .trade-home *,
    .trade-home *::before,
    .trade-home *::after {
        box-sizing: border-box;
    }

    .trade-home a {
        text-decoration: none;
    }

    .trade-shell {
        display: grid;
        gap: 16px;
    }

    .trade-card,
    .trade-action,
    .trade-pool {
        position: relative;
        overflow: hidden;
        border: 1px solid var(--line);
        border-radius: 22px;
        background: var(--panel);
        box-shadow: 0 22px 60px rgba(0, 0, 0, 0.3);
    }

    .trade-card::before,
    .trade-action::before,
    .trade-pool::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(106, 227, 255, 0.08), transparent 28%, transparent 70%, rgba(45, 212, 191, 0.05));
        pointer-events: none;
    }

    .trade-hero {
        padding: 15px;
    }

    .trade-topline,
    .trade-balance-row,
    .trade-section-head,
    .trade-pool-head,
    .trade-pool-foot,
    .trade-market-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .trade-kicker,
    .trade-badge,
    .trade-chip,
    .trade-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .trade-kicker {
        padding: 8px 12px;
        border: 1px solid rgba(106, 227, 255, 0.16);
        background: rgba(106, 227, 255, 0.08);
        color: #b7f4ff;
    }

    .trade-badge {
        padding: 7px 11px;
        border: 1px solid rgba(34, 197, 94, 0.2);
        background: rgba(34, 197, 94, 0.1);
        color: #86efac;
        white-space: nowrap;
    }

    .trade-title {
        margin: 14px 0 6px;
        font-size: clamp(30px, 8vw, 48px);
        line-height: 0.94;
        letter-spacing: -0.05em;
    }

    .trade-subtitle {
        margin: 0;
        max-width: 42rem;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.65;
    }

    .trade-balance-row {
        margin-top: 18px;
        align-items: flex-end;
    }

    .trade-balance-label {
        margin: 0 0 6px;
        color: var(--muted);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .trade-balance-amount {
        margin: 0;
        font-size: clamp(34px, 9vw, 56px);
        line-height: 0.9;
        font-weight: 800;
        letter-spacing: -0.06em;
    }

    .trade-balance-note {
        margin: 10px 0 0;
        color: #86efac;
        font-size: 13px;
        font-weight: 600;
    }

    .trade-market-strip {
        margin-top: 14px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 8px;
    }

    .trade-market-tile,
    .trade-stat,
    .trade-pool-stat {
        padding: 10px;
        border-radius: 14px;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.045), rgba(255, 255, 255, 0.02));
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.03);
    }

    .trade-market-tile span,
    .trade-stat span,
    .trade-pool-stat span,
    .trade-pool-meta,
    .trade-section-note {
        display: block;
        color: var(--muted);
        font-size: 11px;
    }

    .trade-market-tile strong,
    .trade-stat strong,
    .trade-pool-stat strong {
        display: block;
        margin-top: 4px;
        font-size: 15px;
        font-weight: 700;
    }

    .trade-market-tile {
        overflow: hidden;
    }

    .trade-market-tile::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, rgba(106, 227, 255, 0.9), rgba(27, 184, 242, 0.15));
        opacity: 0.8;
    }

    .trade-market-tile.balance::after {
        background: linear-gradient(90deg, rgba(106, 227, 255, 0.95), rgba(27, 184, 242, 0.18));
    }

    .trade-market-tile.profit::after {
        background: linear-gradient(90deg, rgba(34, 197, 94, 0.95), rgba(34, 197, 94, 0.12));
    }

    .trade-market-tile.active::after {
        background: linear-gradient(90deg, rgba(251, 191, 36, 0.95), rgba(251, 191, 36, 0.14));
    }

    .trade-market-tile small {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        color: rgba(232, 240, 255, 0.46);
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .trade-market-up {
        color: #86efac;
    }

    .trade-quick-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 10px;
    }

    .trade-action {
        min-height: 112px;
        padding: 14px 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease;
    }

    .trade-action:hover {
        transform: translateY(-3px);
        border-color: var(--line-strong);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.24);
    }

    .trade-action-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, rgba(106, 227, 255, 0.2), rgba(27, 184, 242, 0.25));
        border: 1px solid rgba(106, 227, 255, 0.18);
    }

    .trade-action-icon img,
    .trade-action-icon svg {
        width: 20px;
        height: 20px;
    }

    .trade-action-label {
        color: var(--text);
        font-size: 12px;
        font-weight: 700;
        line-height: 1.3;
    }

    .trade-action-sub {
        color: var(--muted);
        font-size: 10px;
        line-height: 1.4;
    }

    .trade-grid {
        display: grid;
        gap: 16px;
    }

    .trade-summary {
        padding: 16px;
    }

    .trade-section-head {
        margin-bottom: 14px;
    }

    .trade-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
        font-size: 17px;
        font-weight: 700;
    }

    .trade-section-note {
        margin-top: 4px;
    }

    .trade-summary-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .trade-track-card {
        display: block;
        padding: 16px;
        border-radius: 18px;
        background: linear-gradient(135deg, rgba(251, 191, 36, 0.09), rgba(251, 191, 36, 0.03));
        border: 1px solid rgba(251, 191, 36, 0.22);
        color: inherit;
        transition: transform 0.22s ease, border-color 0.22s ease;
    }

    .trade-track-card:hover {
        transform: translateY(-3px);
        border-color: rgba(251, 191, 36, 0.42);
    }

    .trade-track-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
        margin-top: 14px;
    }

    .trade-pools {
        padding: 16px;
    }

    .trade-pools-list {
        display: grid;
        gap: 14px;
    }

    .trade-pool {
        display: block;
        padding: 16px;
        transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease;
        color: inherit;
    }

    .trade-pool:hover {
        transform: translateY(-3px);
        border-color: var(--line-strong);
        box-shadow: 0 18px 44px rgba(0, 0, 0, 0.24);
    }

    .trade-pool.is-locked {
        opacity: 0.68;
        cursor: not-allowed;
    }

    .trade-pool-icon {
        width: 46px;
        height: 46px;
        min-width: 46px;
        border-radius: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #38bdf8, #0ea5e9);
        box-shadow: 0 10px 24px rgba(56, 189, 248, 0.24);
    }

    .trade-pool-icon svg {
        width: 22px;
        height: 22px;
        stroke: #fff;
    }

    .trade-pool-title {
        margin: 0 0 4px;
        font-size: 16px;
        font-weight: 700;
    }

    .trade-pool-meta {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
    }

    .trade-chip {
        padding: 5px 9px;
        border: 1px solid rgba(34, 197, 94, 0.24);
        background: rgba(34, 197, 94, 0.1);
        color: #86efac;
    }

    .trade-chip.locked {
        border-color: rgba(251, 191, 36, 0.22);
        background: rgba(251, 191, 36, 0.1);
        color: #fbbf24;
    }

    .trade-pool-stats {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
        margin-top: 14px;
    }

    .trade-pool-roi {
        margin-top: 10px;
    }

    .trade-progress {
        margin-top: 12px;
    }

    .trade-progress-bar {
        height: 6px;
        border-radius: 999px;
        background: rgba(106, 227, 255, 0.1);
        overflow: hidden;
        margin-top: 6px;
    }

    .trade-progress-bar i {
        display: block;
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, #38bdf8, #0ea5e9);
    }

    .trade-pool-foot {
        margin-top: 14px;
        padding-top: 12px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        color: var(--muted);
        font-size: 12px;
    }

    .trade-pool-link {
        color: var(--accent);
        font-weight: 700;
    }

    .trade-empty {
        padding: 36px 20px;
        text-align: center;
        border-radius: 18px;
        border: 1px dashed rgba(106, 227, 255, 0.18);
        background: rgba(255, 255, 255, 0.02);
    }

    .trade-empty strong {
        display: block;
        margin-bottom: 8px;
        font-size: 16px;
    }

    .trade-empty p {
        margin: 0;
        color: var(--muted);
        font-size: 13px;
    }

    @media (min-width: 768px) {
        .trade-home {
            padding: 94px 18px 120px;
        }

        .trade-grid {
            grid-template-columns: 340px minmax(0, 1fr);
            align-items: start;
        }

        .trade-hero,
        .trade-summary,
        .trade-pools {
            padding: 20px;
        }

        .trade-quick-grid {
            grid-template-columns: repeat(6, minmax(0, 1fr));
        }
    }
</style>
@endpush

@section('content')
@php
    $activeOrders = $orders->where('status', 'running');
    $totalCapital = $activeOrders->sum('amount');
    $totalExpectedProfit = $activeOrders->sum('expected_profit');
@endphp

<div class="trade-home">
    <div class="trade-shell">
        <section class="trade-card trade-hero">
            <div class="trade-topline">
                <div class="trade-kicker">Live trading desk</div>
                <div class="trade-badge">Investment vaults</div>
            </div>

           
            <div class="trade-balance-row">
                <div>
                    <p class="trade-balance-label">{{ __t('total_balance') }}</p>
                    <p class="trade-balance-amount">${{ number_format(auth()->user()->balance, 2) }}</p>
                    <p class="trade-balance-note">Vault capital ready</p>
                </div>
            </div>

            <div class="trade-market-strip">
                <div class="trade-market-tile balance">
                    <span>Vault capital</span>
                    <small>Allocated</small>
                    <strong>${{ number_format($totalCapital, 2) }}</strong>
                </div>
                <div class="trade-market-tile profit">
                    <span>Projected</span>
                    <small>Expected</small>
                    <strong class="trade-market-up">+${{ number_format($totalExpectedProfit, 2) }}</strong>
                </div>
                <div class="trade-market-tile active">
                    <span>Running</span>
                    <small>Vaults live</small>
                    <strong>{{ $activeOrders->count() }} {{ __t('active') }}</strong>
                </div>
            </div>
        </section>

        <section class="trade-quick-grid">
            <a href="{{ route('select.network') }}" class="trade-action">
                <span class="trade-action-icon"><img src="{{ asset('images/icons/deposit.svg') }}" alt="Deposit"></span>
                <div>
                    <div class="trade-action-label">{{ __t('deposit') }}</div>
                    <div class="trade-action-sub">Fund wallet</div>
                </div>
            </a>

            <a href="{{ route('withdraw') }}" class="trade-action">
                <span class="trade-action-icon"><img src="{{ asset('images/icons/withdraw.svg') }}" alt="Withdraw"></span>
                <div>
                    <div class="trade-action-label">{{ __t('withdraw') }}</div>
                    <div class="trade-action-sub">Move capital</div>
                </div>
            </a>

            <a href="{{ route('checkin') }}" class="trade-action">
                <span class="trade-action-icon"><img src="{{ asset('images/icons/checkin.svg') }}" alt="Check-in"></span>
                <div>
                    <div class="trade-action-label">{{ __t('checkin') }}</div>
                    <div class="trade-action-sub">Daily reward</div>
                </div>
            </a>

            <a href="{{ route('luckybox') }}" class="trade-action">
                <span class="trade-action-icon"><img src="{{ asset('images/icons/luckybox.svg') }}" alt="Lucky Box"></span>
                <div>
                    <div class="trade-action-label">{{ __t('lucky_box') }}</div>
                    <div class="trade-action-sub">Bonus draw</div>
                </div>
            </a>

            <a href="{{ route('weekly-salary') }}" class="trade-action">
                <span class="trade-action-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"></rect><path d="M7 15h0M12 15h0M17 15h0M7 11h10M7 7h10"></path></svg>
                </span>
                <div>
                    <div class="trade-action-label">{{ __t('weekly_salary') }}</div>
                    <div class="trade-action-sub">Income desk</div>
                </div>
            </a>

            <a href="{{ route('leaderboard') }}" class="trade-action">
                <span class="trade-action-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
                </span>
                <div>
                    <div class="trade-action-label">{{ __t('leaders_rank') }}</div>
                    <div class="trade-action-sub">Top traders</div>
                </div>
            </a>
        </section>

        <section class="trade-grid">
            <aside class="trade-card trade-summary">
                <div class="trade-section-head">
                    <div>
                        <h2 class="trade-section-title">
                            <img src="{{ asset('images/icons/analytics.svg') }}" alt="Analytics" style="width:18px;height:18px;">
                            Investment vault overview
                        </h2>
                        <span class="trade-section-note">Current account deployment</span>
                    </div>
                </div>

                <div class="trade-summary-grid">
                    <div class="trade-stat">
                        <span>{{ __t('total_balance') }}</span>
                        <strong>${{ number_format(auth()->user()->balance, 2) }}</strong>
                    </div>
                    <div class="trade-stat">
                        <span>{{ __t('active_orders') }}</span>
                        <strong>{{ $activeOrders->count() }}</strong>
                    </div>
                    <div class="trade-stat">
                        <span>{{ __t('amount') }}</span>
                        <strong>${{ number_format($totalCapital, 2) }}</strong>
                    </div>
                    <div class="trade-stat">
                        <span>{{ __t('total_profit') }}</span>
                        <strong style="color:#86efac;">+${{ number_format($totalExpectedProfit, 2) }}</strong>
                    </div>
                </div>

                @if($activeOrders->count() > 0)
                    <a href="{{ route('compute.track') }}" class="trade-track-card">
                        <div class="trade-section-head" style="margin-bottom:0;">
                            <div>
                                <h3 class="trade-section-title" style="font-size:15px;">
                                    <span class="trade-action-icon" style="width:38px;height:38px;border-radius:12px;">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                                    </span>
                                    Track vaults
                                </h3>
                            </div>
                            <span class="trade-pill" style="color:#fbbf24;">{{ $activeOrders->count() }} {{ __t('active') }}</span>
                        </div>
                        <div class="trade-track-grid">
                            <div class="trade-pool-stat">
                                <span>{{ __t('amount') }}</span>
                                <strong>${{ number_format($totalCapital, 2) }}</strong>
                            </div>
                            <div class="trade-pool-stat">
                                <span>{{ __t('total_profit') }}</span>
                                <strong style="color:#86efac;">+${{ number_format($totalExpectedProfit, 2) }}</strong>
                            </div>
                        </div>
                    </a>
                @endif
            </aside>

            <section class="trade-card trade-pools">
                <div class="trade-section-head">
                    <div>
                        <h2 class="trade-section-title">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
                            Investment vaults
                        </h2>
                        <span class="trade-section-note">{{ count($plans) }} {{ __t('active') }}</span>
                    </div>
                </div>

                <div class="trade-pools-list">
                    @forelse ($plans as $plan)
                        @php
                            $days = $plan->duration_minutes / 1440;
                            $isLocked = $plan->price > auth()->user()->balance;
                            $progress = rand(60, 95);
                            $investors = rand(100, 500);
                            $roi = (pow(1 + ($plan->daily_profit / 100), $days) - 1) * 100;
                            $tag = $isLocked ? 'div' : 'a';
                            $href = $isLocked ? '' : 'href="' . route('compute.show', $plan->id) . '"';
                        @endphp

                        <{{ $tag }} {!! $href !!} class="trade-pool{{ $isLocked ? ' is-locked' : '' }}">
                            <div class="trade-pool-head">
                                <div style="display:flex;align-items:center;gap:12px;">
                                    <span class="trade-pool-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
                                    </span>
                                    <div>
                                        <h3 class="trade-pool-title">{{ $plan->name }}</h3>
                                        <div class="trade-pool-meta">
                                            <span>{{ $days }} {{ $days > 1 ? __t('days') : __t('day') }}</span>
                                            <span>•</span>
                                            <span>{{ $plan->type }}</span>
                                        </div>
                                    </div>
                                </div>
                                <span class="trade-chip{{ $isLocked ? ' locked' : '' }}">{{ $isLocked ? __t('locked') : __t('available') }}</span>
                            </div>

                            <div class="trade-pool-stats">
                                <div class="trade-pool-stat">
                                    <span>{{ __t('investment_range') }}</span>
                                    <strong>
                                        ${{ number_format($plan->price, 0) }}
                                        @if($plan->max_investment)
                                            - ${{ number_format($plan->max_investment, 0) }}
                                        @else
                                            - ∞
                                        @endif
                                    </strong>
                                </div>
                                <div class="trade-pool-stat">
                                    <span>{{ __t('daily_return') }}</span>
                                    <strong style="color:#86efac;">{{ number_format($plan->daily_profit, 2) }}%</strong>
                                </div>
                            </div>

                            <div class="trade-pool-roi trade-pool-stat">
                                <span>{{ __t('total_roi') }}</span>
                                <strong style="color:#fbbf24;">{{ number_format($roi, 2) }}%</strong>
                            </div>

                            <div class="trade-progress">
                                <div class="trade-market-row" style="font-size:11px;color:var(--muted);">
                                    <span>{{ __t('pool_capacity') }}</span>
                                    <strong style="font-size:11px;color:var(--accent);">{{ $progress }}%</strong>
                                </div>
                                <div class="trade-progress-bar">
                                    <i style="width:{{ $progress }}%;"></i>
                                </div>
                            </div>

                            <div class="trade-pool-foot">
                                <span>{{ $investors }}+ {{ __t('investors') }}</span>
                                <span class="trade-pool-link">{{ $isLocked ? __t('insufficient_balance') : __t('view_details') }}</span>
                            </div>
                        </{{ $tag }}>
                    @empty
                        <div class="trade-empty">
                            <strong>No Pools Available</strong>
                            <p>Check back later for new investment vaults.</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </section>
    </div>
</div>
@endsection
