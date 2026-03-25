@extends('layouts.app')

@section('title', 'Home | Cryptexa')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
@php
$activeOrders = $orders->where('status', 'running');
$totalCapital = $activeOrders->sum(fn ($order) => $order->principal_amount);
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
                    <strong class="metric-positive">+${{ number_format($totalExpectedProfit, 2) }}</strong>
                </div>
                <div class="metric-card">
                    <span>Running</span>
                    <strong>{{ $activeOrders->count() }} {{ __t('active') }}</strong>
                </div>
            </div>
        </section>

        <section>
            <div class="home-section-head home-section-head--tight">
                <div>
                    <h2 class="home-section-title">Quick Options</h2>
                    <div class="home-section-note">Fast access to key actions</div>
                </div>
            </div>
            <div class="action-grid">
                <a href="{{ route('select.network') }}" class="home-action">
                    <span class="action-icon"><img src="{{ asset('images/icons/deposit.svg') }}" alt="Deposit"></span>
                    <div>
                        <div class="action-title">{{ __t('deposit') }}</div>
                        <div class="action-sub">Fund account</div>
                    </div>
                </a>
                <a href="{{ route('withdraw') }}" class="home-action">
                    <span class="action-icon"><img src="{{ asset('images/icons/withdraw.svg') }}" alt="Withdraw"></span>
                    <div>
                        <div class="action-title">{{ __t('withdraw') }}</div>
                        <div class="action-sub">Move funds</div>
                    </div>
                </a>
                <a href="{{ route('checkin') }}" class="home-action">
                    <span class="action-icon"><img src="{{ asset('images/icons/checkin.svg') }}" alt="Check-in"></span>
                    <div>
                        <div class="action-title">{{ __t('checkin') }}</div>
                        <div class="action-sub">Daily reward</div>
                    </div>
                </a>
                <a href="{{ route('luckybox') }}" class="home-action">
                    <span class="action-icon"><img src="{{ asset('images/icons/luckybox.svg') }}" alt="Lucky Box"></span>
                    <div>
                        <div class="action-title">{{ __t('lucky_box') }}</div>
                        <div class="action-sub">Bonus entry</div>
                    </div>
                </a>
                <a href="{{ route('weekly-salary') }}" class="home-action">
                    <span class="action-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                            <path d="M7 15h0M12 15h0M17 15h0M7 11h10M7 7h10"></path>
                        </svg></span>
                    <div>
                        <div class="action-title">{{ __t('weekly_salary') }}</div>
                        <div class="action-sub">Income desk</div>
                    </div>
                </a>
                <a href="{{ route('leaderboard') }}" class="home-action">
                    <span class="action-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                            <path d="M2 17l10 5 10-5"></path>
                            <path d="M2 12l10 5 10-5"></path>
                        </svg></span>
                    <div>
                        <div class="action-title">{{ __t('leaders_rank') }}</div>
                        <div class="action-sub">Top users</div>
                    </div>
                </a>
            </div>
        </section>

        <section class="home-layout home-layout--single">
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
                                <strong class="vault-profit">{{ number_format($plan->daily_profit, 2) }}%</strong>
                            </div>
                            <div class="vault-stat">
                                <span>{{ __t('total_roi') }}</span>
                                <strong class="vault-roi">{{ number_format($roi, 2) }}%</strong>
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
