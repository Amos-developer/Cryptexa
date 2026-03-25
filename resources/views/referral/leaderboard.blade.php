@extends('layouts.app')

@section('title', 'Leaderboard')
@section('hide-header', true)
@section('page-heading', __t('leaders_rank'))
@section('page-back-url', route('home'))

@section('content')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    .rank-card {
        animation: fadeInUp 0.5s ease;
    }

    .podium-item {
        animation: fadeInUp 0.6s ease;
    }

    .leader-item {
        animation: fadeInUp 0.4s ease;
    }

    .trophy-icon {
        animation: pulse 2s infinite;
    }
</style>

<div style="min-height: 100vh; background: linear-gradient(135deg, #0f172a 0%, #1a1f3a 50%, #0d1726 100%); padding: 80px 16px 80px;">
    <div style="max-width: 480px; margin: 0 auto;">

        <link rel="stylesheet" href="{{ asset('css/team.css') }}">

        <!-- HEADER BAR -->
        <div class="team-header">
            <a href="{{ route('home') }}" class="back-btn">
                <i class="icon-left-btn"></i>
            </a>
            <h6 class="header-title">Leaders Rank</h6>
            <span class="placeholder"></span>
        </div>

        <!-- Your Rank Card -->
        @php
        if ($activeMembers >= 100) {
        $rankName = 'Grand Leader';
        $rankColor = '#a855f7';
        $rankBg = 'rgba(168,85,247,0.15)';
        $rankBorder = 'rgba(168,85,247,0.3)';
        } elseif ($activeMembers >= 30) {
        $rankName = 'Legendary Leader';
        $rankColor = '#f59e0b';
        $rankBg = 'rgba(245,158,11,0.15)';
        $rankBorder = 'rgba(245,158,11,0.3)';
        } elseif ($activeMembers >= 10) {
        $rankName = 'Elite Leader';
        $rankColor = '#38bdf8';
        $rankBg = 'rgba(56,189,248,0.15)';
        $rankBorder = 'rgba(56,189,248,0.3)';
        } elseif ($activeMembers >= 3) {
        $rankName = 'Junior Leader';
        $rankColor = '#22c55e';
        $rankBg = 'rgba(34,197,94,0.15)';
        $rankBorder = 'rgba(34,197,94,0.3)';
        } else {
        $rankName = 'No Rank';
        $rankColor = '#64748b';
        $rankBg = 'rgba(100,116,139,0.15)';
        $rankBorder = 'rgba(100,116,139,0.3)';
        }
        @endphp
        <div class="rank-card" style=" margin-top: 50px; background: linear-gradient(135deg, {{ $rankBg }}, {{ str_replace('0.15', '0.05', $rankBg) }}); border: 1px solid {{ $rankBorder }}; border-radius: 20px; padding: 24px; margin-bottom: 20px; text-align: center; box-shadow: 0 8px 24px {{ str_replace('0.3', '0.15', $rankBorder) }}; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -50px; right: -50px; width: 150px; height: 150px; background: radial-gradient(circle, {{ str_replace('0.15', '0.1', $rankBg) }}, transparent); pointer-events: none;"></div>
            <p style="color: #94a3b8; font-size: 13px; margin: 0 0 8px 0; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Your Current Rank</p>
            <h2 style="color: {{ $rankColor }}; font-size: 32px; font-weight: 900; margin: 0 0 8px 0; letter-spacing: -0.5px;">{{ $rankName }}</h2>
            <p style="color: #22c55e; font-size: 24px; font-weight: 700; margin: 0;">{{ $activeMembers }}</p>
            <p style="color: #64748b; font-size: 11px; margin: 4px 0 0 0;">Active Members</p>
        </div>

        <!-- Rank Tiers -->
        <div style="background: linear-gradient(135deg, rgba(15,23,42,0.9), rgba(30,41,59,0.9)); border: 1px solid rgba(56,189,248,0.15); border-radius: 20px; padding: 20px; margin-bottom: 20px; box-shadow: 0 4px 16px rgba(0,0,0,0.2);">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    <h3 style="color: #e5e7eb; font-size: 16px; font-weight: 700; margin: 0;">Rank Requirements & Bonuses</h3>
                </div>
                <a href="{{ route('rank-guide') }}" style="color: #38bdf8; font-size: 12px; text-decoration: none; font-weight: 600;">View Full Guide →</a>
            </div>
            <p style="color: #94a3b8; font-size: 12px; margin-bottom: 16px;">Your Active Members: <strong style="color: #22c55e;">{{ $activeMembers }}</strong></p>
            <div style="display: grid; gap: 10px;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 14px; background: linear-gradient(135deg, rgba(34,197,94,0.12), rgba(34,197,94,0.05)); border: 1px solid rgba(34,197,94,0.25); border-radius: 12px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform='translateX(0)'">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 20px;">🌟</span>
                        <div>
                            <span style="color: #22c55e; font-size: 14px; font-weight: 700; display: block;">Junior Leader</span>
                            <span style="color: #94a3b8; font-size: 11px;">3 active members required</span>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <span style="color: #e5e7eb; font-size: 13px; font-weight: 600; display: block;">+$5 Bonus</span>
                        @if($rankBonuses['junior_leader']['paid'])
                        <span style="color: #22c55e; font-size: 10px;">✓ Claimed</span>
                        @else
                        <span style="color: #64748b; font-size: 10px;">Unclaimed</span>
                        @endif
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 14px; background: linear-gradient(135deg, rgba(56,189,248,0.12), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.25); border-radius: 12px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform='translateX(0)'">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 20px;">💎</span>
                        <div>
                            <span style="color: #38bdf8; font-size: 14px; font-weight: 700; display: block;">Elite Leader</span>
                            <span style="color: #94a3b8; font-size: 11px;">10 active members required</span>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <span style="color: #e5e7eb; font-size: 13px; font-weight: 600; display: block;">+$20 Bonus</span>
                        @if($rankBonuses['elite_leader']['paid'])
                        <span style="color: #22c55e; font-size: 10px;">✓ Claimed</span>
                        @else
                        <span style="color: #64748b; font-size: 10px;">Unclaimed</span>
                        @endif
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 14px; background: linear-gradient(135deg, rgba(245,158,11,0.12), rgba(245,158,11,0.05)); border: 1px solid rgba(245,158,11,0.25); border-radius: 12px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform='translateX(0)'">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 20px;">⭐</span>
                        <div>
                            <span style="color: #f59e0b; font-size: 14px; font-weight: 700; display: block;">Legendary Leader</span>
                            <span style="color: #94a3b8; font-size: 11px;">30 active members required</span>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <span style="color: #e5e7eb; font-size: 13px; font-weight: 600; display: block;">+$50 Bonus</span>
                        @if($rankBonuses['legendary_leader']['paid'])
                        <span style="color: #22c55e; font-size: 10px;">✓ Claimed</span>
                        @else
                        <span style="color: #64748b; font-size: 10px;">Unclaimed</span>
                        @endif
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 14px; background: linear-gradient(135deg, rgba(168,85,247,0.12), rgba(168,85,247,0.05)); border: 1px solid rgba(168,85,247,0.25); border-radius: 12px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform='translateX(0)'">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 20px;">👑</span>
                        <div>
                            <span style="color: #a855f7; font-size: 14px; font-weight: 700; display: block;">Grand Leader</span>
                            <span style="color: #94a3b8; font-size: 11px;">100 active members required</span>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <span style="color: #e5e7eb; font-size: 13px; font-weight: 600; display: block;">+$150 Bonus</span>
                        @if($rankBonuses['grand_leader']['paid'])
                        <span style="color: #22c55e; font-size: 10px;">✓ Claimed</span>
                        @else
                        <span style="color: #64748b; font-size: 10px;">Unclaimed</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Top 3 Podium -->
        @if($leaderboard->count() >= 3)
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; margin-bottom: 20px; align-items: end;">
            <!-- 2nd Place -->
            <div class="podium-item" style="background: linear-gradient(135deg, rgba(192,192,192,0.2), rgba(192,192,192,0.05)); border: 1px solid rgba(192,192,192,0.35); border-radius: 16px; padding: 16px 12px; text-align: center; box-shadow: 0 4px 12px rgba(192,192,192,0.15); animation-delay: 0.1s;">
                <div style="width: 44px; height: 44px; background: linear-gradient(135deg, #c0c0c0, #a8a8a8); border-radius: 50%; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 20px; box-shadow: 0 4px 12px rgba(192,192,192,0.4);">2</div>
                <p style="color: #e5e7eb; font-size: 13px; font-weight: 700; margin: 0 0 6px 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $leaderboard[1]->username }}</p>
                <p style="color: #22c55e; font-size: 15px; font-weight: 800; margin: 0;">${{ number_format($leaderboard[1]->referral_earnings ?? 0, 0) }}</p>
            </div>
            <!-- 1st Place -->
            <div class="podium-item" style="background: linear-gradient(135deg, rgba(251,191,36,0.2), rgba(251,191,36,0.05)); border: 1px solid rgba(251,191,36,0.4); border-radius: 16px; padding: 20px 12px; text-align: center; box-shadow: 0 8px 24px rgba(251,191,36,0.25); animation-delay: 0s;">
                <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #fbbf24, #f59e0b); border-radius: 50%; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 28px; box-shadow: 0 6px 16px rgba(251,191,36,0.5);">1</div>
                <p style="color: #e5e7eb; font-size: 14px; font-weight: 700; margin: 0 0 6px 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $leaderboard[0]->username }}</p>
                <p style="color: #22c55e; font-size: 18px; font-weight: 800; margin: 0;">${{ number_format($leaderboard[0]->referral_earnings ?? 0, 0) }}</p>
            </div>
            <!-- 3rd Place -->
            <div class="podium-item" style="background: linear-gradient(135deg, rgba(205,127,50,0.2), rgba(205,127,50,0.05)); border: 1px solid rgba(205,127,50,0.35); border-radius: 16px; padding: 16px 12px; text-align: center; box-shadow: 0 4px 12px rgba(205,127,50,0.15); animation-delay: 0.2s;">
                <div style="width: 44px; height: 44px; background: linear-gradient(135deg, #cd7f32, #b87333); border-radius: 50%; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 20px; box-shadow: 0 4px 12px rgba(205,127,50,0.4);">3</div>
                <p style="color: #e5e7eb; font-size: 13px; font-weight: 700; margin: 0 0 6px 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $leaderboard[2]->username }}</p>
                <p style="color: #22c55e; font-size: 15px; font-weight: 800; margin: 0;">${{ number_format($leaderboard[2]->referral_earnings ?? 0, 0) }}</p>
            </div>
        </div>
        @endif

        <!-- Leaderboard List -->
        <div style="background: linear-gradient(135deg, rgba(15,23,42,0.9), rgba(30,41,59,0.9)); border: 1px solid rgba(56,189,248,0.15); border-radius: 20px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.2);">
            <div style="padding: 18px 20px; border-bottom: 1px solid rgba(56,189,248,0.1); background: rgba(56,189,248,0.05);">
                <h3 style="color: #e5e7eb; font-size: 16px; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    Top 5 Leaders
                </h3>
            </div>
            <div style="max-height: 500px; overflow-y: auto;">
                @foreach($leaderboard as $index => $user)
                @php
                // Calculate active members for this user
                $level1Ids = \App\Models\User::where('referred_by', $user->id)->where('role', '!=', 'admin')->pluck('id');
                $level1Active = \App\Models\User::where('referred_by', $user->id)
                ->where('role', '!=', 'admin')
                ->whereHas('deposits', fn($q) => $q->where('status', 'completed'))
                ->count();
                $level2Active = \App\Models\User::whereIn('referred_by', $level1Ids)
                ->where('role', '!=', 'admin')
                ->whereHas('deposits', fn($q) => $q->where('status', 'completed'))
                ->count();
                $level2Ids = \App\Models\User::whereIn('referred_by', $level1Ids)->where('role', '!=', 'admin')->pluck('id');
                $level3Active = \App\Models\User::whereIn('referred_by', $level2Ids)
                ->where('role', '!=', 'admin')
                ->whereHas('deposits', fn($q) => $q->where('status', 'completed'))
                ->count();
                $userActiveMembers = $level1Active + $level2Active + $level3Active;

                if ($userActiveMembers >= 100) {
                $badge = 'Grand';
                $badgeColor = '#a855f7';
                $badgeIcon = '👑';
                } elseif ($userActiveMembers >= 30) {
                $badge = 'Legendary';
                $badgeColor = '#f59e0b';
                $badgeIcon = '⭐';
                } elseif ($userActiveMembers >= 10) {
                $badge = 'Elite';
                $badgeColor = '#38bdf8';
                $badgeIcon = '💎';
                } elseif ($userActiveMembers >= 3) {
                $badge = 'Junior';
                $badgeColor = '#22c55e';
                $badgeIcon = '🌟';
                } else {
                $badge = '';
                $badgeColor = '#64748b';
                $badgeIcon = '';
                }
                @endphp
                <div class="leader-item" style="display: flex; align-items: center; gap: 12px; padding: 14px 20px; border-bottom: 1px solid rgba(56,189,248,0.05); {{ $user->id === auth()->id() ? 'background: linear-gradient(90deg, rgba(56,189,248,0.15), rgba(56,189,248,0.05));' : '' }} transition: all 0.3s ease; animation-delay: {{ $index * 0.05 }}s;" onmouseover="this.style.background='rgba(56,189,248,0.08)'" onmouseout="this.style.background='{{ $user->id === auth()->id() ? 'linear-gradient(90deg, rgba(56,189,248,0.15), rgba(56,189,248,0.05))' : 'transparent' }}'">
                    <div style="width: 36px; height: 36px; background: {{ $index < 3 ? 'linear-gradient(135deg, #38bdf8, #0ea5e9)' : 'rgba(56,189,248,0.12)' }}; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: {{ $index < 3 ? 'white' : '#64748b' }}; font-weight: 800; font-size: 14px; flex-shrink: 0; box-shadow: {{ $index < 3 ? '0 4px 12px rgba(56,189,248,0.3)' : 'none' }};">{{ $index + 1 }}</div>
                    <div style="flex: 1; min-width: 0;">
                        <p style="color: #e5e7eb; font-size: 14px; font-weight: 700; margin: 0 0 2px 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $user->username }}</p>
                        @if($badge)
                        <p style="color: {{ $badgeColor }}; font-size: 11px; margin: 0; font-weight: 700; display: flex; align-items: center; gap: 4px;">
                            <span>{{ $badgeIcon }}</span>
                            <span>{{ $badge }} Leader</span>
                        </p>
                        @else
                        <p style="color: #64748b; font-size: 11px; margin: 0;">{{ $userActiveMembers }} active members</p>
                        @endif
                    </div>
                    <div style="text-align: right;">
                        <p style="color: #22c55e; font-size: 15px; font-weight: 800; margin: 0;">${{ number_format($user->referral_earnings ?? 0, 0) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
