@extends('layouts.app')

@section('title', 'Home | Cryptexa')

@section('content')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<div class="dashboard-container">

    <!-- Top Header -->
    <div class="dashboard-top">
        <div class="dashboard-brand">Cryptexa</div>
        <div class="dashboard-menu">
            <img src="{{ asset('images/icons/settings.svg') }}" alt="Settings" style="width: 18px; height: 18px;">
        </div>
    </div>

    <!-- Balance Section -->
    <div class="balance-section">
        <p class="balance-label">Total Account Balance</p>
        <div class="balance-amount">${{ number_format(auth()->user()->balance, 2) }}</div>
        <div class="balance-change">
            <span class="balance-change-positive">
                Active Liquidity Allocation
            </span>
        </div>
        <div class="balance-chart">
            <div class="chart-bar"></div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <a href="{{ route('choose.cryptocurrency') }}" class="action-card">
            <div class="action-icon">
                <img src="{{ asset('images/icons/deposit.svg') }}" alt="Deposit" style="width: 20px; height: 20px;">
            </div>
            <div class="action-label">Deposit</div>
        </a>

        <a href="{{ route('withdraw') }}" class="action-card">
            <div class="action-icon">
                <img src="{{ asset('images/icons/favorites.svg') }}" alt="Withdraw" style="width: 20px; height: 20px;">
            </div>
            <div class="action-label">Withdraw</div>
        </a>

        <a href="#" class="action-card">
            <div class="action-icon">
                <img src="{{ asset('images/icons/checkin.svg') }}" alt="Check-in" style="width: 20px; height: 20px;">
            </div>
            <div class="action-label">Check-in</div>
        </a>

        <a href="#" class="action-card">
            <div class="action-icon">
                <img src="{{ asset('images/icons/luckybox.svg') }}" alt="Lucky Box" style="width: 20px; height: 20px;">
            </div>
            <div class="action-label">Lucky Box</div>
        </a>
    </div>

    <!-- Portfolio Analytics -->
    <div class="section-container" style="margin-bottom: 24px;">
        <div class="portfolio-card">
            <div class="portfolio-icon">
                <img src="{{ asset('images/icons/analytics.svg') }}" alt="Analytics" style="width: 16px; height: 16px;">
            </div>
            <p class="portfolio-text">Liquidity Portfolio Overview</p>
        </div>
    </div>

    <!-- Liquidity Growth Pools Section -->
    <div class="main-grid">

        <div class="section-container">
            <div class="section-header">
                <span class="section-title">
                    <img src="{{ asset('images/icons/compute.svg') }}" alt="Liquidity" style="width: 16px; height: 16px;">
                    Liquidity Growth Pools
                </span>
            </div>

            <div class="cards-list">

                @forelse ($plans as $plan)

                @php
                $days = $plan->duration_minutes / 1440;
                @endphp

                <a href="{{ route('compute.show', $plan->id) }}" class="card-item">

                    <div class="card-icon">
                        <img src="{{ asset('images/coin/default.png') }}"
                            alt="{{ $plan->name }}"
                            style="width: 20px; height: 20px; object-fit: contain;">
                    </div>

                    <div class="card-info">
                        <p class="card-name">{{ $plan->name }}</p>
                        <p class="card-meta">
                            {{ $plan->type }} · {{ $days }} Day{{ $days > 1 ? 's' : '' }}
                        </p>
                    </div>

                    <div class="card-price">
                        <p class="card-amount">
                            Min: ${{ number_format($plan->price, 0) }}
                        </p>
                        <p class="card-change card-change-positive">
                            {{ $plan->min_profit }}% – {{ $plan->max_profit }}% Daily
                        </p>
                    </div>

                </a>

                @empty

                <div class="card-item" style="justify-content: center;">
                    <p style="color: rgba(226, 232, 240, 0.5); margin: 0;">
                        No liquidity pools available
                    </p>
                </div>

                @endforelse

            </div>
        </div>

    </div>

</div>

@endsection