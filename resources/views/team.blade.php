@extends('layouts.app')

@section('title', 'My Team | Cryptexa')
@section('hide-header', true)

@section('content')

<!-- HEADER BAR -->
<div class="header fixed-top d-flex justify-content-between align-items-center px-16"
    style="
        background: linear-gradient(135deg, #020617, #0f172a);
        border-bottom: 1px solid rgba(56,189,248,0.2);
        backdrop-filter: blur(10px);
        z-index: 100;
        padding: 12px 16px;
    ">
    <a href="{{ url()->previous() }}"
        style="
            width: 36px;
            height: 36px;
            background: rgba(56,189,248,0.1);
            border: 1px solid rgba(56,189,248,0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        "
        onmouseover="this.style.background='rgba(56,189,248,0.15)'; this.style.borderColor='rgba(56,189,248,0.4)';"
        onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.2)';">
        <i class="icon-left-btn" style="color: #38bdf8; font-size: 18px;"></i>
    </a>
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">My Team</h6>
    <span style="width: 36px;"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%);">
    <div class="tf-container">

        <!-- PAGE HEADER -->
        <div class="mb-32" style="animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 32px; margin: 0 0 12px 0;">Referral Dashboard</h1>
            <p class="text-secondary" style="font-size: 14px; margin: 0;">Track your team growth and referral earnings</p>
        </div>

        <!-- STATS GRID -->
        <div style="
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 32px;
            animation: slideUp 0.6s ease 0.1s backwards;
        ">

            <!-- TOTAL MEMBERS -->
            <div style="
                background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
                border: 1px solid rgba(56,189,248,0.15);
                border-radius: 14px;
                padding: 18px;
                box-shadow: 0 10px 30px rgba(56,189,248,0.05), inset 0 0 20px rgba(56,189,248,0.03);
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            "
                onmouseover="this.style.borderColor='rgba(56,189,248,0.3)'; this.style.boxShadow='0 10px 30px rgba(56,189,248,0.1), inset 0 0 20px rgba(56,189,248,0.05)';"
                onmouseout="this.style.borderColor='rgba(56,189,248,0.15)'; this.style.boxShadow='0 10px 30px rgba(56,189,248,0.05), inset 0 0 20px rgba(56,189,248,0.03)';">
                <p style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 8px 0;">👥 Total Members</p>
                <h3 style="color: #38bdf8; font-size: 32px; font-weight: 900; margin: 0;">{{ $totalMembers }}</h3>
            </div>

            <!-- MY EARNINGS -->
            <div style="
                background: linear-gradient(135deg, rgba(34,197,94,0.08) 0%, rgba(34,197,94,0.02) 100%);
                border: 1px solid rgba(34,197,94,0.15);
                border-radius: 14px;
                padding: 18px;
                box-shadow: 0 10px 30px rgba(34,197,94,0.05), inset 0 0 20px rgba(34,197,94,0.03);
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            "
                onmouseover="this.style.borderColor='rgba(34,197,94,0.3)'; this.style.boxShadow='0 10px 30px rgba(34,197,94,0.1), inset 0 0 20px rgba(34,197,94,0.05)';"
                onmouseout="this.style.borderColor='rgba(34,197,94,0.15)'; this.style.boxShadow='0 10px 30px rgba(34,197,94,0.05), inset 0 0 20px rgba(34,197,94,0.03)';">
                <p style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 8px 0;">💰 My Earnings</p>
                <h3 style="color: #22c55e; font-size: 32px; font-weight: 900; margin: 0;">${{ number_format($earnings, 2) }}</h3>
            </div>

            <!-- ACTIVE MEMBERS -->
            <div style="
                background: linear-gradient(135deg, rgba(251,191,36,0.08) 0%, rgba(251,191,36,0.02) 100%);
                border: 1px solid rgba(251,191,36,0.15);
                border-radius: 14px;
                padding: 18px;
                box-shadow: 0 10px 30px rgba(251,191,36,0.05), inset 0 0 20px rgba(251,191,36,0.03);
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            "
                onmouseover="this.style.borderColor='rgba(251,191,36,0.3)'; this.style.boxShadow='0 10px 30px rgba(251,191,36,0.1), inset 0 0 20px rgba(251,191,36,0.05)';"
                onmouseout="this.style.borderColor='rgba(251,191,36,0.15)'; this.style.boxShadow='0 10px 30px rgba(251,191,36,0.05), inset 0 0 20px rgba(251,191,36,0.03)';">
                <p style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 8px 0;">✓ Active Members</p>
                <h3 style="color: #fbbf24; font-size: 32px; font-weight: 900; margin: 0;">{{ $activeMembers }}</h3>
            </div>

            <!-- INACTIVE MEMBERS -->
            <div style="
                background: linear-gradient(135deg, rgba(239,68,68,0.08) 0%, rgba(239,68,68,0.02) 100%);
                border: 1px solid rgba(239,68,68,0.15);
                border-radius: 14px;
                padding: 18px;
                box-shadow: 0 10px 30px rgba(239,68,68,0.05), inset 0 0 20px rgba(239,68,68,0.03);
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            "
                onmouseover="this.style.borderColor='rgba(239,68,68,0.3)'; this.style.boxShadow='0 10px 30px rgba(239,68,68,0.1), inset 0 0 20px rgba(239,68,68,0.05)';"
                onmouseout="this.style.borderColor='rgba(239,68,68,0.15)'; this.style.boxShadow='0 10px 30px rgba(239,68,68,0.05), inset 0 0 20px rgba(239,68,68,0.03)';">
                <p style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 8px 0;">✗ Inactive Members</p>
                <h3 style="color: #ef4444; font-size: 32px; font-weight: 900; margin: 0;">{{ $inactiveMembers }}</h3>
            </div>

        </div>

        <!-- LEVEL ANALYTICS -->
        @foreach([
        'Level 1' => $level1,
        'Level 2' => $level2,
        'Level 3' => $level3
        ] as $levelIndex => $users)

        <div style="
            animation: slideUp 0.6s ease {{ (0.2 + ($loop->index * 0.1)) }}s backwards;
            margin-bottom: 20px;
        ">
            <!-- LEVEL HEADER -->
            <div style="
                background: linear-gradient(135deg, rgba(168,85,247,0.08) 0%, rgba(168,85,247,0.02) 100%);
                border: 1px solid rgba(168,85,247,0.15);
                border-radius: 14px;
                padding: 16px;
                box-shadow: 0 10px 30px rgba(168,85,247,0.05), inset 0 0 20px rgba(168,85,247,0.03);
                backdrop-filter: blur(10px);
                margin-bottom: 12px;
            ">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h5 style="color: #a855f7; font-weight: 700; font-size: 16px; margin: 0;">
                        {{ $loop->index === 0 ? '🥇' : ($loop->index === 1 ? '🥈' : '🥉') }} {{ $levelIndex }}
                    </h5>
                    <span style="color: #94a3b8; font-size: 12px; font-weight: 600;">
                        {{ $users->count() }} member{{ $users->count() !== 1 ? 's' : '' }}
                    </span>
                </div>
            </div>

            @if($users->isEmpty())
            <div style="
                background: rgba(255,255,255,0.02);
                border: 1px solid rgba(255,255,255,0.08);
                border-radius: 12px;
                padding: 20px;
                text-align: center;
                color: #94a3b8;
                font-size: 13px;
            ">
                No members yet - Invite more people to build your team!
            </div>
            @else
            <div style="display: grid; gap: 10px;">
                @foreach($users as $u)
                <div style="
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 14px;
                    border-radius: 10px;
                    background: rgba(255,255,255,0.02);
                    border: 1px solid rgba(255,255,255,0.08);
                    transition: all 0.3s ease;
                "
                    onmouseover="this.style.background='rgba(255,255,255,0.04)'; this.style.borderColor='rgba(56,189,248,0.2)';"
                    onmouseout="this.style.background='rgba(255,255,255,0.02)'; this.style.borderColor='rgba(255,255,255,0.08)';">

                    <!-- LEFT INFO -->
                    <div>
                        <p style="color: #e5e7eb; font-weight: 600; font-size: 13px; margin: 0 0 4px 0;">
                            ID: <span style="font-family: 'Courier New', monospace;">{{ $u->referral_code }}</span>
                        </p>
                        <p style="color: #94a3b8; font-size: 11px; margin: 0;">
                            Joined {{ $u->created_at->diffForHumans() }}
                        </p>
                    </div>

                    <!-- RIGHT STATUS -->
                    <div style="text-align: right;">
                        @if($u->balance > 3)
                        <span style="
                            display: inline-block;
                            background: rgba(34,197,94,0.15);
                            color: #22c55e;
                            padding: 4px 10px;
                            border-radius: 999px;
                            font-size: 11px;
                            font-weight: 700;
                            margin-bottom: 4px;
                        ">
                            ✓ Active
                        </span>
                        @else
                        <span style="
                            display: inline-block;
                            background: rgba(251,191,36,0.15);
                            color: #fbbf24;
                            padding: 4px 10px;
                            border-radius: 999px;
                            font-size: 11px;
                            font-weight: 700;
                            margin-bottom: 4px;
                        ">
                            ⏳ Inactive
                        </span>
                        @endif
                        <p style="color: #94a3b8; font-size: 11px; margin: 0;">
                            Balance: <span style="color: #e5e7eb; font-weight: 600;">${{ number_format($u->balance, 2) }}</span>
                        </p>
                    </div>

                </div>
                @endforeach
            </div>
            @endif

        </div>

        @endforeach

    </div>
</div>

<!-- ANIMATIONS & STYLES -->
<style>
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* MOBILE RESPONSIVE */
    @media (max-width: 768px) {
        .pt-80 {
            padding-top: 80px !important;
        }

        .pb-80 {
            padding-bottom: 60px !important;
        }

        h1 {
            font-size: 24px !important;
        }

        h3 {
            font-size: 24px !important;
        }

        h5 {
            font-size: 14px !important;
        }

        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
            gap: 12px !important;
        }

        [style*="padding: 18px"] {
            padding: 14px !important;
        }

        [style*="padding: 16px"] {
            padding: 12px !important;
        }

        [style*="padding: 14px"] {
            padding: 12px !important;
        }

        [style*="gap: 14px"] {
            gap: 10px !important;
        }

        [style*="gap: 10px"] {
            gap: 8px !important;
        }

        .mb-32 {
            margin-bottom: 20px !important;
        }

        .mb-20 {
            margin-bottom: 16px !important;
        }

        p {
            font-size: 12px !important;
        }
    }

    /* TABLET RESPONSIVE */
    @media (min-width: 769px) and (max-width: 1024px) {
        h1 {
            font-size: 28px !important;
        }

        h3 {
            font-size: 28px !important;
        }

        [style*="gap: 14px"] {
            gap: 12px !important;
        }
    }
</style>

@endsection