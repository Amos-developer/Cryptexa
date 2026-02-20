@extends('layouts.app')

@section('title', 'Home | Cryptexa')

@section('content')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<div class="dashboard-container">
    <!-- Top Header -->
    <div class="dashboard-top">
        <div class="dashboard-brand">Golhold°</div>
        <div class="dashboard-menu">
            <img src="{{ asset('images/icons/settings.svg') }}" alt="Settings" style="width: 18px; height: 18px;">
        </div>
    </div>

    <!-- Balance Section -->
    <div class="balance-section">
        <p class="balance-label">Balance in dollars</p>
        <div class="balance-amount">${{ number_format(auth()->user()->balance, 0) }}</div>
        <div class="balance-change">
            <span class="balance-change-positive">+ ${{ number_format(auth()->user()->balance * 0.02, 2) }}</span>
            <span class="balance-change-percent">· 3.95% for today</span>
        </div>
        <div class="balance-chart">
            <div class="chart-bar"></div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <a href="{{ route('choose.cryptocurrency') }}" class="action-card">
            <div class="action-icon">
                <img src="{{ asset('images/icons/history.svg') }}" alt="History" style="width: 20px; height: 20px;">
            </div>
            <div class="action-label">History</div>
        </a>
        <a href="{{ route('choose.cryptocurrency') }}" class="action-card">
            <div class="action-icon">
                <img src="{{ asset('images/icons/deposit.svg') }}" alt="Deposit" style="width: 20px; height: 20px;">
            </div>
            <div class="action-label">Deposit</div>
        </a>
        <a href="{{ route('withdraw') }}" class="action-card">
            <div class="action-icon">
                <img src="{{ asset('images/icons/favorites.svg') }}" alt="Favorites" style="width: 20px; height: 20px;">
            </div>
            <div class="action-label">Favorites</div>
        </a>
    </div>

    <!-- Portfolio Analytics -->
    <div class="section-container" style="margin-bottom: 24px;">
        <div class="portfolio-card">
            <div class="portfolio-icon">
                <img src="{{ asset('images/icons/analytics.svg') }}" alt="Analytics" style="width: 16px; height: 16px;">
            </div>
            <p class="portfolio-text">Portfolio Analytics</p>
        </div>
    </div>

    <!-- Sections Grid -->
    <div class="main-grid">
        <!-- Compute Plans Section -->
        <div class="section-container">
            <div class="section-header">
                <span class="section-title">
                    <img src="{{ asset('images/icons/compute.svg') }}" alt="Compute" style="width: 16px; height: 16px;">
                    AI Compute Plans
                </span>
                <span class="section-change">+2.42%</span>
            </div>
            <div class="cards-list">
                @forelse ($plans as $plan)
                <a href="{{ route('compute.show', $plan->id) }}" class="card-item">
                    <div class="card-icon">
                        <img src="{{ asset('images/coin/'.$plan['icon']) }}" alt="{{ $plan['name'] }}"
                            style="width: 20px; height: 20px; object-fit: contain;">
                    </div>
                    <div class="card-info">
                        <p class="card-name">{{ $plan['name'] }}</p>
                        <p class="card-meta">{{ $plan['type'] }} · {{ $plan['duration'] }}</p>
                    </div>
                    <div class="card-price">
                        <p class="card-amount">${{ $plan['price'] }}</p>
                        <p class="card-change card-change-positive">+{{ $plan['yield'] }}</p>
                    </div>
                </a>
                @empty
                <div class="card-item" style="justify-content: center;">
                    <p style="color: rgba(226, 232, 240, 0.5); margin: 0;">No plans available</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Links Section -->
        <!-- <div class="section-container">
            <div class="section-header">
                <span class="section-title">🔗 Quick Links</span>
                <span class="section-change">+1.28%</span>
            </div>
            <div class="cards-list">
                <a href="{{ route('invites') }}" class="card-item">
                    <div class="card-icon">👥</div>
                    <div class="card-info">
                        <p class="card-name">Referrals</p>
                        <p class="card-meta">Earn from invites</p>
                    </div>
                </a>
                <a href="javascript:void(0)" onclick="openCommunityModal()" class="card-item">
                    <div class="card-icon">🌐</div>
                    <div class="card-info">
                        <p class="card-name">Community</p>
                        <p class="card-meta">Join the network</p>
                    </div>
                </a>
                <a href="{{ route('withdraw') }}" class="card-item">
                    <div class="card-icon">📤</div>
                    <div class="card-info">
                        <p class="card-name">Withdraw</p>
                        <p class="card-meta">Cash out funds</p>
                    </div>
                </a>
            </div>
        </div> -->
    </div>

</div>

@endsection