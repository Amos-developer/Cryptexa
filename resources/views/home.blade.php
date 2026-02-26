@extends('layouts.app')

@section('title', 'Home | Cryptexa')

@section('content')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<div class="dashboard-container">

    <!-- Top Header -->
    <!-- <div class="dashboard-top">
        <div class="dashboard-brand">Cryptexa</div>
        <div class="dashboard-menu">
            <img src="{{ asset('images/icons/settings.svg') }}" alt="Settings" style="width: 18px; height: 18px;">
        </div>
    </div> -->

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
                <img src="{{ asset('images/icons/deposit.svg') }}" alt="Deposit">
            </div>
            <div class="action-label">Deposit</div>
        </a>

        <a href="{{ route('withdraw') }}" class="action-card">
            <div class="action-icon">
                <img src="{{ asset('images/icons/withdraw.svg') }}" alt="Withdraw">
            </div>
            <div class="action-label">Withdraw</div>
        </a>

        <a href="{{ route('checkin') }}" class="action-card">
            <div class="action-icon">
                <img src="{{ asset('images/icons/checkin.svg') }}" alt="Check-in">
            </div>
            <div class="action-label">Check-in</div>
        </a>

        <a href="{{ route('luckybox') }}" class="action-card">
            <div class="action-icon">
                <img src="{{ asset('images/icons/luckybox.svg') }}" alt="Lucky Box">
            </div>
            <div class="action-label">Lucky Box</div>
        </a>

        <a href="{{ route('weekly-salary') }}" class="action-card">
            <div class="action-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                    <path d="M7 15h0M12 15h0M17 15h0M7 11h10M7 7h10"/>
                </svg>
            </div>
            <div class="action-label">Weekly Salary</div>
        </a>

        <a href="{{ route('leaderboard') }}" class="action-card">
            <div class="action-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                    <path d="M2 17l10 5 10-5"/>
                    <path d="M2 12l10 5 10-5"/>
                </svg>
            </div>
            <div class="action-label">Leaders Rank</div>
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
            <div class="section-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <span class="section-title" style="display: flex; align-items: center; gap: 8px; color: #e5e7eb; font-weight: 700; font-size: 18px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                        <path d="M2 17l10 5 10-5"/>
                        <path d="M2 12l10 5 10-5"/>
                    </svg>
                    Liquidity Growth Pools
                </span>
                <span style="color: #38bdf8; font-size: 12px; font-weight: 600;">{{ count($plans) }} Active</span>
            </div>

            <div style="display: grid; gap: 16px;">

                @forelse ($plans as $index => $plan)

                @php
                $days = $plan->duration_minutes / 1440;
                $isLocked = $plan->price > auth()->user()->balance;
                $tag = $isLocked ? 'div' : 'a';
                $href = $isLocked ? '' : 'href="' . route('compute.show', $plan->id) . '"';
                @endphp

                <{{ $tag }} {!! $href !!}
                   style="
                       display: block;
                       background: linear-gradient(135deg, rgba(56,189,248,0.08), rgba(56,189,248,0.02));
                       border: 1px solid rgba(56,189,248,0.2);
                       border-radius: 16px;
                       padding: 16px;
                       text-decoration: none;
                       transition: all 0.3s ease;
                       position: relative;
                       overflow: hidden;
                       animation: slideIn 0.5s ease {{ $index * 0.1 }}s backwards;
                       {{ $isLocked ? 'cursor: not-allowed; opacity: 0.6;' : 'cursor: pointer;' }}
                   "
                   @if(!$isLocked)
                   onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='rgba(56,189,248,0.4)'; this.style.boxShadow='0 8px 24px rgba(56,189,248,0.15)'"
                   onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(56,189,248,0.2)'; this.style.boxShadow='none'"
                   @endif>
                   
                    <!-- Gradient Overlay -->
                    <div style="position: absolute; top: 0; right: 0; width: 100px; height: 100px; background: radial-gradient(circle, rgba(56,189,248,0.1) 0%, transparent 70%); pointer-events: none;"></div>
                    
                    <!-- Header -->
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 12px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 44px; height: 44px; background: linear-gradient(135deg, #38bdf8, #0ea5e9); border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(56,189,248,0.3);">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                                    <path d="M2 17l10 5 10-5"/>
                                    <path d="M2 12l10 5 10-5"/>
                                </svg>
                            </div>
                            <div>
                                <h3 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0 0 2px 0;">{{ $plan->name }}</h3>
                                <p style="color: #94a3b8; font-size: 12px; margin: 0; display: flex; align-items: center; gap: 6px;">
                                    <span style="display: inline-flex; align-items: center; gap: 3px;">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"/>
                                            <polyline points="12 6 12 12 16 14"/>
                                        </svg>
                                        {{ $days }} Day{{ $days > 1 ? 's' : '' }}
                                    </span>
                                    <span style="color: #64748b;">•</span>
                                    <span>{{ $plan->type }}</span>
                                </p>
                            </div>
                        </div>
                        
                        @if($isLocked)
                        <div style="display: flex; align-items: center; gap: 4px; padding: 4px 10px; background: rgba(251,191,36,0.15); border: 1px solid rgba(251,191,36,0.3); border-radius: 20px;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <span style="color: #fbbf24; font-size: 10px; font-weight: 600;">LOCKED</span>
                        </div>
                        @else
                        <div style="display: flex; align-items: center; gap: 4px; padding: 4px 10px; background: rgba(34,197,94,0.15); border: 1px solid rgba(34,197,94,0.3); border-radius: 20px;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                <polyline points="22 4 12 14.01 9 11.01"/>
                            </svg>
                            <span style="color: #22c55e; font-size: 10px; font-weight: 600;">AVAILABLE</span>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Stats Grid -->
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; margin-bottom: 12px;">
                        <div style="background: rgba(56,189,248,0.05); border: 1px solid rgba(56,189,248,0.15); border-radius: 8px; padding: 10px; text-align: center;">
                            <p style="color: #64748b; font-size: 10px; margin: 0 0 3px 0; text-transform: uppercase; letter-spacing: 0.5px;">Investment Range</p>
                            <p style="color: #38bdf8; font-weight: 700; font-size: 15px; margin: 0;">
                                ${{ number_format($plan->price, 0) }} - 
                                @if($plan->max_investment)
                                    ${{ number_format($plan->max_investment, 0) }}
                                @else
                                    <span style="font-size: 13px;">∞</span>
                                @endif
                            </p>
                        </div>
                        <div style="background: rgba(34,197,94,0.05); border: 1px solid rgba(34,197,94,0.15); border-radius: 8px; padding: 10px; text-align: center;">
                            <p style="color: #64748b; font-size: 10px; margin: 0 0 3px 0; text-transform: uppercase; letter-spacing: 0.5px;">Daily Return</p>
                            <p style="color: #22c55e; font-weight: 700; font-size: 15px; margin: 0;">{{ number_format($plan->daily_profit, 1) }}%</p>
                        </div>
                    </div>
                    
                    <!-- Total ROI -->
                    <div style="background: rgba(251,191,36,0.05); border: 1px solid rgba(251,191,36,0.15); border-radius: 8px; padding: 10px; text-align: center; margin-bottom: 12px;">
                        <p style="color: #64748b; font-size: 10px; margin: 0 0 3px 0; text-transform: uppercase; letter-spacing: 0.5px;">Total ROI</p>
                        <p style="color: #fbbf24; font-weight: 700; font-size: 15px; margin: 0;">{{ number_format((pow(1 + ($plan->daily_profit / 100), $days) - 1) * 100, 1) }}%</p>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div style="margin-bottom: 10px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span style="color: #94a3b8; font-size: 11px;">Pool Capacity</span>
                            <span style="color: #38bdf8; font-size: 11px; font-weight: 600;">{{ rand(60, 95) }}%</span>
                        </div>
                        <div style="height: 5px; background: rgba(56,189,248,0.1); border-radius: 3px; overflow: hidden;">
                            <div style="height: 100%; width: {{ rand(60, 95) }}%; background: linear-gradient(90deg, #38bdf8, #0ea5e9); border-radius: 3px; transition: width 0.3s ease;"></div>
                        </div>
                    </div>
                    
                    <!-- Footer -->
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 10px; border-top: 1px solid rgba(56,189,248,0.1);">
                        <div style="display: flex; align-items: center; gap: 5px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                            <span style="color: #64748b; font-size: 11px;">{{ rand(100, 500) }}+ investors</span>
                        </div>
                        @if(!$isLocked)
                        <div style="display: flex; align-items: center; gap: 5px; color: #38bdf8; font-weight: 600; font-size: 13px;">
                            <span>View Details</span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"/>
                            </svg>
                        </div>
                        @else
                        <div style="display: flex; align-items: center; gap: 5px; color: #64748b; font-weight: 600; font-size: 13px;">
                            <span>Insufficient Balance</span>
                        </div>
                        @endif
                    </div>
                    
                </{{ $tag }}>

                @empty

                <div style="text-align: center; padding: 60px 20px; color: #94a3b8;">
                    <div style="font-size: 48px; margin-bottom: 16px;">📊</div>
                    <div style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">No Pools Available</div>
                    <div style="font-size: 14px;">Check back later for new liquidity pools</div>
                </div>

                @endforelse

            </div>
        </div>

    </div>

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @media (max-width: 768px) {
            [style*="grid-template-columns: repeat(3, 1fr)"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>

</div>

@endsection