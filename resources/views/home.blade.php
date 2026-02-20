@extends('layouts.app')

@section('title', 'Home | Cryptexa')

@section('content')

<style>
    * {
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #0f172a 0%, #1a1f3a 50%, #0d1726 100%);
    }



    /* Main Container */
    .dashboard-container {
        padding: 24px 16px;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Header */
    .dashboard-header {
        margin-bottom: 32px;
    }

    .dashboard-header .greeting {
        font-size: 12px;
        color: rgba(226, 232, 240, 0.6);
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 6px;
        font-weight: 500;
    }

    .dashboard-header h1 {
        color: #fff;
        font-size: 32px;
        font-weight: 800;
        margin: 0;
        background: linear-gradient(135deg, #38bdf8, #22d3ee);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Cards Container */
    .cards-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        margin-bottom: 28px;
    }

    /* Balance Card */
    .balance-card {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.8) 0%, rgba(30, 41, 59, 0.8) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(56, 189, 248, 0.2);
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 20px 60px rgba(56, 189, 248, 0.15),
            inset 0 1px 1px rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .balance-card:hover {
        box-shadow: 0 20px 60px rgba(56, 189, 248, 0.25),
            inset 0 1px 1px rgba(255, 255, 255, 0.1);
        border-color: rgba(56, 189, 248, 0.4);
    }

    .balance-label {
        color: rgba(226, 232, 240, 0.6);
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .balance-amount {
        color: #fff;
        font-size: 40px;
        font-weight: 900;
        margin: 12px 0 24px 0;
        text-shadow: 0 0 30px rgba(56, 189, 248, 0.3);
    }

    /* Quick Actions Grid */
    .quick-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .action-btn {
        padding: 14px 16px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-height: 44px;
    }

    .action-btn-primary {
        background: linear-gradient(135deg, #38bdf8 0%, #22d3ee 100%);
        color: #020617;
        box-shadow: 0 10px 30px rgba(56, 189, 248, 0.3);
    }

    .action-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 40px rgba(56, 189, 248, 0.4);
    }

    .action-btn-secondary {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(34, 197, 94, 0.08));
        color: #22c55e;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .action-btn-secondary:hover {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.25), rgba(34, 197, 94, 0.15));
        transform: translateY(-2px);
    }

    /* Quick Links Grid */
    .quick-links {
        display: grid;
        grid-template-columns: 1fr;
        gap: 14px;
    }

    .quick-link-card {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.8) 0%, rgba(30, 41, 59, 0.8) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(56, 189, 248, 0.2);
        border-radius: 14px;
        padding: 16px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 14px;
        transition: all 0.3s ease;
    }

    .quick-link-card:hover {
        transform: translateY(-2px);
        border-color: rgba(56, 189, 248, 0.4);
        box-shadow: 0 10px 30px rgba(56, 189, 248, 0.2);
    }

    .quick-link-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .quick-link-content h6 {
        color: #fff;
        font-weight: 700;
        margin: 0;
        font-size: 14px;
    }

    .quick-link-content small {
        color: rgba(226, 232, 240, 0.6);
        font-size: 12px;
    }

    /* Compute Plans Section */
    .compute-section {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.8) 0%, rgba(30, 41, 59, 0.8) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(56, 189, 248, 0.2);
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 20px 60px rgba(56, 189, 248, 0.15),
            inset 0 1px 1px rgba(255, 255, 255, 0.1);
    }

    .section-header {
        margin-bottom: 24px;
    }

    .section-header h5 {
        color: #fff;
        font-weight: 800;
        font-size: 18px;
        margin: 0 0 6px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-header small {
        color: rgba(226, 232, 240, 0.6);
        font-size: 12px;
    }

    /* Plan Items */
    .plans-list {
        display: grid;
        gap: 14px;
    }

    .plan-item {
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.05) 0%, rgba(56, 189, 248, 0.02) 100%);
        border: 1px solid rgba(56, 189, 248, 0.15);
        border-radius: 14px;
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 14px;
        transition: all 0.3s ease;
    }

    .plan-item:hover {
        border-color: rgba(56, 189, 248, 0.4);
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.1) 0%, rgba(56, 189, 248, 0.05) 100%);
        box-shadow: 0 10px 30px rgba(56, 189, 248, 0.15);
        transform: translateY(-2px);
    }

    .plan-icon {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        background: rgba(56, 189, 248, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(56, 189, 248, 0.2);
        flex-shrink: 0;
    }

    .plan-icon img {
        width: 24px;
        height: 24px;
        object-fit: contain;
    }

    .plan-info {
        flex: 1;
    }

    .plan-name {
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        margin: 0 0 4px 0;
    }

    .plan-meta {
        color: rgba(226, 232, 240, 0.6);
        font-size: 11px;
    }

    .plan-stats {
        display: flex;
        gap: 18px;
        align-items: center;
    }

    .stat-item {
        text-align: right;
    }

    .stat-label {
        color: rgba(226, 232, 240, 0.6);
        font-size: 11px;
        display: block;
    }

    .stat-value {
        color: #fff;
        font-weight: 700;
        font-size: 13px;
    }

    .stat-yield {
        background: rgba(34, 197, 94, 0.15);
        color: #22c55e;
        padding: 2px 8px;
        border-radius: 4px;
        display: inline-block;
    }

    .plan-action {
        background: linear-gradient(135deg, #38bdf8, #0ea5e9);
        color: #020617;
        padding: 10px 16px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 12px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(56, 189, 248, 0.3);
        white-space: nowrap;
    }

    .plan-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(56, 189, 248, 0.4);
    }

    /* View All Link */
    .view-all-section {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid rgba(56, 189, 248, 0.1);
        text-align: center;
    }

    .view-all-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        color: #38bdf8;
        background: rgba(56, 189, 248, 0.1);
        border: 1px solid rgba(56, 189, 248, 0.3);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .view-all-link:hover {
        background: rgba(56, 189, 248, 0.15);
        border-color: rgba(56, 189, 248, 0.5);
        color: #22d3ee;
    }

    /* Mobile Responsive */
    @media (max-width: 640px) {
        .dashboard-container {
            padding: 16px 12px;
        }

        .dashboard-header h1 {
            font-size: 24px;
        }

        .balance-amount {
            font-size: 32px;
        }

        .quick-actions {
            grid-template-columns: 1fr;
        }

        .action-btn {
            min-height: 40px;
            font-size: 12px;
        }

        .section-header h5 {
            font-size: 16px;
        }

        .plan-stats {
            flex-direction: column;
            gap: 8px;
            align-items: flex-end;
        }

        .plan-item {
            flex-wrap: wrap;
            padding: 14px;
        }

        .plan-action {
            width: 100%;
            text-align: center;
            padding: 10px;
        }
    }

    /* Tablet */
    @media (min-width: 641px) and (max-width: 1024px) {
        .cards-grid {
            grid-template-columns: 1fr 1fr;
        }

        .dashboard-container {
            padding: 24px;
        }
    }

    /* Desktop */
    @media (min-width: 1025px) {
        .cards-grid {
            grid-template-columns: 2fr 1fr;
        }

        .dashboard-container {
            padding: 32px;
        }

        .quick-links {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <p class="greeting">Welcome back</p>
        <h1>Dashboard</h1>
    </div>

    <!-- Main Cards Grid -->
    <div class="cards-grid">
        <!-- Balance Card -->
        <div class="balance-card">
            <p class="balance-label">Your Balance</p>
            <p class="balance-amount">${{ number_format(auth()->user()->balance, 2) }}</p>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <a href="{{ route('choose.cryptocurrency') }}" class="action-btn action-btn-primary">
                    <span>💰</span> Deposit
                </a>
                <a href="{{ route('withdraw') }}" class="action-btn action-btn-secondary">
                    <span>📤</span> Withdraw
                </a>
            </div>
        </div>

        <!-- Quick Links Column -->
        <div class="quick-links">
            <!-- Referrals Card -->
            <a href="{{ route('invites') }}" class="quick-link-card" style="background: linear-gradient(135deg, rgba(168,85,247,0.08) 0%, rgba(168,85,247,0.03) 100%); border-color: rgba(168,85,247,0.2);">
                <div class="quick-link-icon" style="background: rgba(168,85,247,0.15);">
                    👥
                </div>
                <div class="quick-link-content">
                    <h6>Referrals</h6>
                    <small>Earn from invites</small>
                </div>
            </a>

            <!-- Community Card -->
            <a href="javascript:void(0)" onclick="openCommunityModal()" class="quick-link-card" style="background: linear-gradient(135deg, rgba(251,191,36,0.08) 0%, rgba(251,191,36,0.03) 100%); border-color: rgba(251,191,36,0.2); cursor: pointer;">
                <div class="quick-link-icon" style="background: rgba(251,191,36,0.15);">
                    🌐
                </div>
                <div class="quick-link-content">
                    <h6>Community</h6>
                    <small>Join the network</small>
                </div>
            </a>
        </div>
    </div>

    <!-- AI Compute Plans Section -->
    <div class="compute-section">
        <div class="section-header">
            <h5>
                <span>⚙️</span>
                AI Compute Plans
            </h5>
            <small>Lease decentralized AI & cloud compute resources</small>
        </div>

        <!-- Plans List -->
        <div class="plans-list">
            @foreach ($plans as $plan)
            <div class="plan-item">
                <!-- Icon -->
                <div class="plan-icon">
                    <img src="{{ asset('images/coin/'.$plan['icon']) }}" alt="{{ $plan['name'] }}">
                </div>

                <!-- Info -->
                <div class="plan-info">
                    <p class="plan-name">{{ $plan['name'] }}</p>
                    <p class="plan-meta">{{ $plan['type'] }} · {{ $plan['duration'] }}</p>
                </div>

                <!-- Stats -->
                <div class="plan-stats">
                    <div class="stat-item">
                        <span class="stat-label">Cost</span>
                        <span class="stat-value">{{ $plan['price'] }} USDT</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Yield</span>
                        <span class="stat-value stat-yield">{{ $plan['yield'] }}</span>
                    </div>
                </div>

                <!-- Action -->
                <a href="{{ route('compute.show', $plan->id) }}" class="plan-action">
                    Unlock →
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection