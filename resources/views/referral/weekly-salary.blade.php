@extends('layouts.app')

@section('title', 'Weekly Salary')
@section('hide-header', true)

@section('content')
<style>
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.salary-card { animation: fadeInUp 0.5s ease; }
.stat-card { animation: fadeInUp 0.6s ease; }
</style>

<div style="min-height: 100vh; background: linear-gradient(135deg, #0f172a 0%, #1a1f3a 50%, #0d1726 100%); padding: 16px; padding-bottom: 80px;">
    <div style="max-width: 480px; margin: 0 auto;">
        
        <!-- Header -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; padding: 8px 0;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <a href="{{ route('home') }}" style="width: 44px; height: 44px; background: linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.25); border-radius: 14px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(56,189,248,0.1);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(56,189,248,0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(56,189,248,0.1)'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 style="color: #e5e7eb; font-size: 24px; font-weight: 800; margin: 0; letter-spacing: -0.5px;">Weekly Salary</h1>
                    <p style="color: #64748b; font-size: 12px; margin: 4px 0 0 0; font-weight: 500;">Rank-Based Rewards</p>
                </div>
            </div>
            <div style="width: 44px; height: 44px; background: linear-gradient(135deg, rgba(251,191,36,0.15), rgba(251,191,36,0.05)); border: 1px solid rgba(251,191,36,0.25); border-radius: 14px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(251,191,36,0.2);">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                    <path d="M7 15h0M12 15h0M17 15h0M7 11h10M7 7h10"/>
                </svg>
            </div>
        </div>

        <!-- Current Rank Card -->
        @php
        if ($earnings >= 300) {
            $rankColor = '#a855f7';
            $rankBg = 'rgba(168,85,247,0.15)';
            $rankBorder = 'rgba(168,85,247,0.3)';
            $rankIcon = '👑';
        } elseif ($earnings >= 180) {
            $rankColor = '#f59e0b';
            $rankBg = 'rgba(245,158,11,0.15)';
            $rankBorder = 'rgba(245,158,11,0.3)';
            $rankIcon = '⭐';
        } elseif ($earnings >= 50) {
            $rankColor = '#38bdf8';
            $rankBg = 'rgba(56,189,248,0.15)';
            $rankBorder = 'rgba(56,189,248,0.3)';
            $rankIcon = '💎';
        } elseif ($earnings >= 10) {
            $rankColor = '#22c55e';
            $rankBg = 'rgba(34,197,94,0.15)';
            $rankBorder = 'rgba(34,197,94,0.3)';
            $rankIcon = '🌟';
        } else {
            $rankColor = '#64748b';
            $rankBg = 'rgba(100,116,139,0.15)';
            $rankBorder = 'rgba(100,116,139,0.3)';
            $rankIcon = '📊';
        }
        @endphp

        <div class="salary-card" style="background: linear-gradient(135deg, {{ $rankBg }}, {{ str_replace('0.15', '0.05', $rankBg) }}); border: 1px solid {{ $rankBorder }}; border-radius: 20px; padding: 24px; margin-bottom: 20px; text-align: center; box-shadow: 0 8px 24px {{ str_replace('0.3', '0.15', $rankBorder) }}; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -50px; right: -50px; width: 150px; height: 150px; background: radial-gradient(circle, {{ str_replace('0.15', '0.1', $rankBg) }}, transparent); pointer-events: none;"></div>
            <div style="font-size: 48px; margin-bottom: 8px;">{{ $rankIcon }}</div>
            <p style="color: #94a3b8; font-size: 13px; margin: 0 0 8px 0; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Your Current Rank</p>
            <h2 style="color: {{ $rankColor }}; font-size: 28px; font-weight: 900; margin: 0 0 16px 0; letter-spacing: -0.5px;">{{ $rankName }}</h2>
            
            @if($weeklySalary > 0)
            <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 16px; margin-bottom: 12px;">
                <p style="color: #94a3b8; font-size: 12px; margin: 0 0 4px 0;">Weekly Salary</p>
                <h3 style="color: #22c55e; font-size: 36px; font-weight: 900; margin: 0;">${{ number_format($weeklySalary, 0) }}</h3>
            </div>
            <p style="color: #64748b; font-size: 12px; margin: 0;">Next payment: <span style="color: #e5e7eb; font-weight: 600;">{{ $nextPaymentDate->format('M d, Y') }} (Monday)</span></p>
            @else
            <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 16px;">
                <p style="color: #ef4444; font-size: 14px; font-weight: 600; margin: 0;">Not Eligible for Weekly Salary</p>
                <p style="color: #94a3b8; font-size: 12px; margin: 8px 0 0 0;">Reach Elite Leader rank ($50 earnings) to start earning</p>
            </div>
            @endif
        </div>

        <!-- Stats Grid -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 20px;">
            <div class="stat-card" style="background: linear-gradient(135deg, rgba(15,23,42,0.9), rgba(30,41,59,0.9)); border: 1px solid rgba(56,189,248,0.15); border-radius: 16px; padding: 20px; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.2); animation-delay: 0.1s;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 8px;">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                <p style="color: #64748b; font-size: 11px; margin: 0 0 6px 0; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">Total Referrals</p>
                <h3 style="color: #e5e7eb; font-size: 28px; font-weight: 800; margin: 0;">{{ $totalReferrals }}</h3>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, rgba(15,23,42,0.9), rgba(30,41,59,0.9)); border: 1px solid rgba(34,197,94,0.15); border-radius: 16px; padding: 20px; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.2); animation-delay: 0.2s;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 8px;">
                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                </svg>
                <p style="color: #64748b; font-size: 11px; margin: 0 0 6px 0; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">Active Referrals</p>
                <h3 style="color: #22c55e; font-size: 28px; font-weight: 800; margin: 0;">{{ $activeReferrals }}</h3>
            </div>
        </div>

        <!-- Salary Structure -->
        <div style="background: linear-gradient(135deg, rgba(15,23,42,0.9), rgba(30,41,59,0.9)); border: 1px solid rgba(56,189,248,0.15); border-radius: 20px; padding: 20px; margin-bottom: 20px; box-shadow: 0 4px 16px rgba(0,0,0,0.2);">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
                <h3 style="color: #e5e7eb; font-size: 16px; font-weight: 700; margin: 0;">Weekly Salary Structure</h3>
            </div>
            <div style="display: grid; gap: 10px;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 14px; background: linear-gradient(135deg, rgba(100,116,139,0.12), rgba(100,116,139,0.05)); border: 1px solid rgba(100,116,139,0.25); border-radius: 12px; opacity: 0.6;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 20px;">🌟</span>
                        <span style="color: #64748b; font-size: 14px; font-weight: 700;">Junior Leader</span>
                    </div>
                    <span style="color: #64748b; font-size: 14px; font-weight: 700;">Not Eligible</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 14px; background: linear-gradient(135deg, rgba(56,189,248,0.12), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.25); border-radius: 12px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 20px;">💎</span>
                        <span style="color: #38bdf8; font-size: 14px; font-weight: 700;">Elite Leader (Pro)</span>
                    </div>
                    <span style="color: #e5e7eb; font-size: 14px; font-weight: 700;">$20/week</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 14px; background: linear-gradient(135deg, rgba(245,158,11,0.12), rgba(245,158,11,0.05)); border: 1px solid rgba(245,158,11,0.25); border-radius: 12px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 20px;">⭐</span>
                        <span style="color: #f59e0b; font-size: 14px; font-weight: 700;">Legendary Leader</span>
                    </div>
                    <span style="color: #e5e7eb; font-size: 14px; font-weight: 700;">$30/week</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 14px; background: linear-gradient(135deg, rgba(168,85,247,0.12), rgba(168,85,247,0.05)); border: 1px solid rgba(168,85,247,0.25); border-radius: 12px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 20px;">👑</span>
                        <span style="color: #a855f7; font-size: 14px; font-weight: 700;">Grand Leader</span>
                    </div>
                    <span style="color: #e5e7eb; font-size: 14px; font-weight: 700;">$50/week</span>
                </div>
            </div>
        </div>

        <!-- Info Box -->
        <div style="background: linear-gradient(135deg, rgba(168,85,247,0.1), rgba(168,85,247,0.02)); border: 1px solid rgba(168,85,247,0.25); border-radius: 16px; padding: 20px; box-shadow: 0 4px 12px rgba(168,85,247,0.1);">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 16v-4M12 8h.01"/>
                </svg>
                <h4 style="color: #a855f7; font-size: 15px; font-weight: 700; margin: 0;">How It Works</h4>
            </div>
            <ul style="color: #94a3b8; font-size: 13px; line-height: 1.8; margin: 0; padding-left: 20px;">
                <li>Weekly salary is paid to Elite Leaders (Pro) and above</li>
                <li>Payments are automatically processed every Monday</li>
                <li>Salary amount increases with your rank tier</li>
                <li>Earn referral commissions to increase your rank</li>
            </ul>
        </div>

    </div>
</div>
@endsection
