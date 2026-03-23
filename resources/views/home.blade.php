@extends('layouts.app')

@section('title', 'Home | Cryptexa')

@push('styles')
<style>
    .home-simple {
        --panel: rgba(9, 18, 33, 0.92);
        --line: rgba(106, 227, 255, 0.14);
        --text: #e8f0ff;
        --muted: rgba(232, 240, 255, 0.62);
        --accent: #6ae3ff;
        --success: #22c55e;
        --warning: #fbbf24;
        max-width: 1080px;
        margin: 0 auto;
        padding: 84px 14px 110px;
        color: var(--text);
    }

    .home-simple *,
    .home-simple *::before,
    .home-simple *::after {
        box-sizing: border-box;
    }

    .home-simple a {
        text-decoration: none;
    }

    .home-grid {
        display: grid;
        gap: 16px;
    }

    .home-card,
    .home-action,
    .vault-card {
        border: 1px solid var(--line);
        border-radius: 18px;
        background: linear-gradient(180deg, rgba(12, 24, 43, 0.94), var(--panel));
        box-shadow: 0 18px 44px rgba(0, 0, 0, 0.24);
    }

    .home-card {
        padding: 16px;
    }

    .home-eyebrow {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(106, 227, 255, 0.08);
        border: 1px solid rgba(106, 227, 255, 0.16);
        color: #b7f4ff;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .home-balance-label,
    .home-section-note,
    .metric-card span,
    .vault-meta,
    .vault-foot,
    .action-sub {
        color: var(--muted);
    }

    .home-balance-label {
        margin: 14px 0 6px;
        font-size: 11px;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .home-balance-value {
        margin: 0;
        font-size: clamp(34px, 9vw, 52px);
        line-height: 0.92;
        letter-spacing: -0.06em;
        font-weight: 800;
    }

    .home-balance-note {
        margin: 10px 0 0;
        color: var(--success);
        font-size: 13px;
        font-weight: 600;
    }

    .metric-grid,
    .action-grid,
    .vault-stats {
        display: grid;
        gap: 10px;
    }

    .metric-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        margin-top: 16px;
    }

    .metric-card,
    .vault-stat {
        padding: 12px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.04);
    }

    .metric-card span,
    .vault-stat span {
        display: block;
        font-size: 11px;
    }

    .metric-card strong,
    .vault-stat strong {
        display: block;
        margin-top: 4px;
        font-size: 15px;
        font-weight: 700;
    }

    .action-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 8px;
    }

    .home-action {
        padding: 8px 6px;
        display: flex;
        flex-direction: column;
        gap: 6px;
        justify-content: space-between;
        min-height: 72px;
        transition: transform 0.2s ease, border-color 0.2s ease;
        border-radius: 14px;
    }

    .home-action:hover {
        transform: translateY(-2px);
        border-color: rgba(106, 227, 255, 0.28);
    }

    .action-icon {
        width: 30px;
        height: 30px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, rgba(106, 227, 255, 0.14), rgba(27, 184, 242, 0.1));
        border: 1px solid rgba(106, 227, 255, 0.14);
    }

    .action-icon img,
    .action-icon svg {
        width: 15px;
        height: 15px;
    }

    .action-title {
        color: var(--text);
        font-size: 10px;
        font-weight: 700;
        line-height: 1.2;
    }

    .action-sub {
        margin-top: 2px;
        font-size: 8px;
        letter-spacing: 0.02em;
    }

    .home-layout {
        display: grid;
        gap: 16px;
    }

    .home-section-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
    }

    .home-section-title {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
    }

    .home-section-note {
        font-size: 12px;
    }

    .track-card {
        display: block;
        padding: 14px;
        border-radius: 16px;
        background: rgba(251, 191, 36, 0.08);
        border: 1px solid rgba(251, 191, 36, 0.18);
        color: inherit;
    }

    .vault-list {
        display: grid;
        gap: 12px;
    }

    .vault-card {
        display: block;
        padding: 15px;
        color: inherit;
        transition: transform 0.2s ease, border-color 0.2s ease;
    }

    .vault-card:hover {
        transform: translateY(-2px);
        border-color: rgba(106, 227, 255, 0.28);
    }

    .vault-card.is-locked {
        opacity: 0.68;
        cursor: not-allowed;
    }

    .vault-head,
    .vault-foot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .vault-name {
        margin: 0 0 4px;
        font-size: 16px;
        font-weight: 700;
    }

    .vault-meta {
        font-size: 12px;
    }

    .vault-badge {
        padding: 5px 9px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        border: 1px solid rgba(34, 197, 94, 0.2);
        background: rgba(34, 197, 94, 0.1);
        color: #86efac;
        white-space: nowrap;
    }

    .vault-badge.locked {
        border-color: rgba(251, 191, 36, 0.2);
        background: rgba(251, 191, 36, 0.1);
        color: var(--warning);
    }

    .vault-stats {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        margin-top: 12px;
    }

    .vault-foot {
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        font-size: 12px;
    }

    .vault-link {
        color: var(--accent);
        font-weight: 700;
    }

    .vault-empty {
        padding: 34px 20px;
        text-align: center;
        border-radius: 16px;
        border: 1px dashed rgba(106, 227, 255, 0.16);
        color: var(--muted);
    }

    .vault-empty strong {
        display: block;
        margin-bottom: 8px;
        color: var(--text);
        font-size: 16px;
    }

    @media (min-width: 768px) {
        .home-simple {
            padding: 94px 18px 120px;
        }

        .action-grid {
            grid-template-columns: repeat(6, minmax(0, 1fr));
        }

        .home-layout {
            grid-template-columns: 320px minmax(0, 1fr);
            align-items: start;
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

<div class="home-simple">
    <div class="home-grid">
        <section class="home-card">
            <!-- <span class="home-eyebrow">Investment Vault</span> -->
            <p class="home-balance-label">{{ __t('total_balance') }}</p>
            <p class="home-balance-value">${{ number_format(auth()->user()->balance, 2) }}</p>
            <p class="home-balance-note">Simple view of your account capital.</p>

            <div class="metric-grid">
                <div class="metric-card">
                    <span>Vault capital</span>
                    <strong>${{ number_format($totalCapital, 2) }}</strong>
                </div>
                <div class="metric-card">
                    <span>Projected</span>
                    <strong style="color:#86efac;">+${{ number_format($totalExpectedProfit, 2) }}</strong>
                </div>
                <div class="metric-card">
                    <span>Running</span>
                    <strong>{{ $activeOrders->count() }} {{ __t('active') }}</strong>
                </div>
            </div>
        </section>

        <section>
            <div class="home-section-head" style="margin-bottom:8px;">
                <div>
                    <h2 class="home-section-title">Quick Options</h2>
                    <div class="home-section-note">Fast access to key actions</div>
                </div>
            </div>
            <div class="action-grid">
            <a href="{{ route('select.network') }}" class="home-action">
                <span class="action-icon"><img src="{{ asset('images/icons/deposit.svg') }}" alt="Deposit"></span>
                <div><div class="action-title">{{ __t('deposit') }}</div><div class="action-sub">Fund account</div></div>
            </a>
            <a href="{{ route('withdraw') }}" class="home-action">
                <span class="action-icon"><img src="{{ asset('images/icons/withdraw.svg') }}" alt="Withdraw"></span>
                <div><div class="action-title">{{ __t('withdraw') }}</div><div class="action-sub">Move funds</div></div>
            </a>
            <a href="{{ route('checkin') }}" class="home-action">
                <span class="action-icon"><img src="{{ asset('images/icons/checkin.svg') }}" alt="Check-in"></span>
                <div><div class="action-title">{{ __t('checkin') }}</div><div class="action-sub">Daily reward</div></div>
            </a>
            <a href="{{ route('luckybox') }}" class="home-action">
                <span class="action-icon"><img src="{{ asset('images/icons/luckybox.svg') }}" alt="Lucky Box"></span>
                <div><div class="action-title">{{ __t('lucky_box') }}</div><div class="action-sub">Bonus entry</div></div>
            </a>
            <a href="{{ route('weekly-salary') }}" class="home-action">
                <span class="action-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"></rect><path d="M7 15h0M12 15h0M17 15h0M7 11h10M7 7h10"></path></svg></span>
                <div><div class="action-title">{{ __t('weekly_salary') }}</div><div class="action-sub">Income desk</div></div>
            </a>
            <a href="{{ route('leaderboard') }}" class="home-action">
                <span class="action-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg></span>
                <div><div class="action-title">{{ __t('leaders_rank') }}</div><div class="action-sub">Top users</div></div>
            </a>
            </div>
        </section>

        <section class="home-layout" style="grid-template-columns:1fr;">
            <section class="home-card">
                <div class="home-section-head">
                    <div>
                        <h2 class="home-section-title">Investment Vaults</h2>
                        <div class="home-section-note">{{ count($plans) }} {{ __t('active') }}</div>
                    </div>
                </div>

                <div class="vault-list">
                    @forelse ($plans as $plan)
                        @php
                            $days = $plan->duration_minutes / 1440;
                            $isLocked = $plan->price > auth()->user()->balance;
                            $roi = (pow(1 + ($plan->daily_profit / 100), $days) - 1) * 100;
                            $tag = $isLocked ? 'div' : 'a';
                            $href = $isLocked ? '' : 'href="' . route('compute.show', $plan->id) . '"';
                        @endphp

                        <{{ $tag }} {!! $href !!} class="vault-card{{ $isLocked ? ' is-locked' : '' }}">
                            <div class="vault-head">
                                <div>
                                    <h3 class="vault-name">{{ $plan->name }}</h3>
                                    <div class="vault-meta">{{ $days }} {{ $days > 1 ? __t('days') : __t('day') }} • {{ $plan->type }}</div>
                                </div>
                                <span class="vault-badge{{ $isLocked ? ' locked' : '' }}">{{ $isLocked ? __t('locked') : __t('available') }}</span>
                            </div>

                            <div class="vault-stats">
                                <div class="vault-stat">
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
                                <div class="vault-stat">
                                    <span>{{ __t('daily_return') }}</span>
                                    <strong style="color:#86efac;">{{ number_format($plan->daily_profit, 2) }}%</strong>
                                </div>
                                <div class="vault-stat">
                                    <span>{{ __t('total_roi') }}</span>
                                    <strong style="color:#fbbf24;">{{ number_format($roi, 2) }}%</strong>
                                </div>
                                <div class="vault-stat">
                                    <span>Status</span>
                                    <strong>{{ $isLocked ? __t('locked') : __t('available') }}</strong>
                                </div>
                            </div>

                            <div class="vault-foot">
                                <span>{{ $plan->type }}</span>
                                <span class="vault-link">{{ $isLocked ? __t('insufficient_balance') : __t('view_details') }}</span>
                            </div>
                        </{{ $tag }}>
                    @empty
                        <div class="vault-empty">
                            <strong>No Vaults Available</strong>
                            <span>Check back later for new investment vaults.</span>
                        </div>
                    @endforelse
                </div>
            </section>
        </section>
    </div>
</div>
@endsection
