@extends('layouts.app')

@section('hide-header', true)
@section('title', $plan->name . ' | Cryptexa')

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
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">{{ $plan->name }}</h6>
    <span style="width: 36px;"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%);">
    <div class="tf-container">

        <!-- HERO SECTION -->
        <div class="mb-32" style="animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 32px; margin: 0 0 12px 0;">
                {{ $plan->name }}
            </h1>
            <p class="text-secondary" style="font-size: 14px; margin: 0; line-height: 1.6;">
                {{ $plan->description }}
            </p>
        </div>

        <!-- PLAN DETAILS CARD -->
        <div style="
            background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
            border: 1px solid rgba(56,189,248,0.15);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(56,189,248,0.05), inset 0 0 20px rgba(56,189,248,0.03);
            backdrop-filter: blur(10px);
            margin-bottom: 24px;
            animation: slideUp 0.6s ease 0.1s backwards;
        ">

            <!-- DETAILS GRID -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">

                <!-- PRICE -->
                <div style="
                    background: rgba(255,255,255,0.02);
                    padding: 16px;
                    border-radius: 12px;
                    border: 1px solid rgba(56,189,248,0.2);
                ">
                    <p style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 8px 0;">💰 Pool Price</p>
                    <h3 style="color: #38bdf8; font-size: 24px; font-weight: 900; margin: 0;">
                        ${{ number_format($plan->price, 2) }}
                    </h3>
                </div>

                <!-- DURATION -->
                <div style="
                    background: rgba(255,255,255,0.02);
                    padding: 16px;
                    border-radius: 12px;
                    border: 1px solid rgba(56,189,248,0.2);
                ">
                    <p style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 8px 0;">⏱️ Duration</p>
                    <h3 style="color: #e5e7eb; font-size: 24px; font-weight: 900; margin: 0;">
                        {{ $plan->duration_minutes }} min <span style="font-size: 14px; color: #94a3b8;">({{ $plan->duration_minutes / 1440 }} Days)</span>
                    </h3>
                </div>

            </div>

            <!-- PROFIT SECTION -->
            <div style="
                background: linear-gradient(135deg, rgba(34,197,94,0.08) 0%, rgba(34,197,94,0.02) 100%);
                border: 1px solid rgba(34,197,94,0.15);
                border-radius: 12px;
                padding: 16px;
            ">
                <p style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 8px 0;">📈 Daily Return (Fixed)</p>
                <h3 style="color: #22c55e; font-size: 28px; font-weight: 900; margin: 0;">
                    {{ number_format($plan->daily_profit, 1) }}%
                </h3>
                <p style="color: #86efac; font-size: 12px; margin: 8px 0 0 0;">
                    Daily compounding returns on your investment
                </p>
            </div>

        </div>

        <!-- FEATURES SECTION -->
        <div style="
            background: linear-gradient(135deg, rgba(251,191,36,0.08) 0%, rgba(251,191,36,0.02) 100%);
            border: 1px solid rgba(251,191,36,0.15);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(251,191,36,0.05), inset 0 0 20px rgba(251,191,36,0.03);
            backdrop-filter: blur(10px);
            margin-bottom: 24px;
            animation: slideUp 0.6s ease 0.2s backwards;
        ">
            <h5 style="color: #fbbf24; font-weight: 700; font-size: 16px; margin: 0 0 16px 0;">💡 Pool Features</h5>

            <div style="display: grid; gap: 12px;">
                <div style="display: flex; gap: 12px; align-items: flex-start;">
                    <span style="color: #fbbf24; font-size: 18px; margin-top: 2px;">✓</span>
                    <div>
                        <p style="color: #e5e7eb; font-weight: 600; font-size: 13px; margin: 0 0 2px 0;">Compound Interest</p>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">Daily compounding for maximum returns</p>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; align-items: flex-start;">
                    <span style="color: #fbbf24; font-size: 18px; margin-top: 2px;">✓</span>
                    <div>
                        <p style="color: #e5e7eb; font-weight: 600; font-size: 13px; margin: 0 0 2px 0;">Auto-Completion</p>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">Pool automatically completes and profits are credited</p>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; align-items: flex-start;">
                    <span style="color: #fbbf24; font-size: 18px; margin-top: 2px;">✓</span>
                    <div>
                        <p style="color: #e5e7eb; font-weight: 600; font-size: 13px; margin: 0 0 2px 0;">Real-time Tracking</p>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">Monitor your investment progress in real-time</p>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; align-items: flex-start;">
                    <span style="color: #fbbf24; font-size: 18px; margin-top: 2px;">✓</span>
                    <div>
                        <p style="color: #e5e7eb; font-weight: 600; font-size: 13px; margin: 0 0 2px 0;">Secure & Audited</p>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">All pools are thoroughly audited and verified</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ACTIVATION BUTTON -->
        <form method="POST" action="{{ route('pools.activate', $plan->id) }}" style="animation: slideUp 0.6s ease 0.3s backwards;">
            @csrf
            <button type="submit"
                style="
                    width: 100%;
                    padding: 16px;
                    border-radius: 12px;
                    background: linear-gradient(135deg, rgba(34,197,94,0.2) 0%, rgba(34,197,94,0.1) 100%);
                    border: 1px solid rgba(34,197,94,0.3);
                    color: #22c55e;
                    font-weight: 700;
                    font-size: 15px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    box-shadow: 0 0 30px rgba(34,197,94,0.0);
                "
                onmouseover="this.style.background='linear-gradient(135deg, rgba(34,197,94,0.3) 0%, rgba(34,197,94,0.15) 100%)'; this.style.boxShadow='0 0 30px rgba(34,197,94,0.3)';"
                onmouseout="this.style.background='linear-gradient(135deg, rgba(34,197,94,0.2) 0%, rgba(34,197,94,0.1) 100%)'; this.style.boxShadow='0 0 30px rgba(34,197,94,0.0)';">
                🚀 Activate Pool
            </button>
        </form>

        <!-- INFO MESSAGE -->
        <div style="
            background: linear-gradient(135deg, rgba(168,85,247,0.08) 0%, rgba(168,85,247,0.02) 100%);
            border: 1px solid rgba(168,85,247,0.15);
            border-radius: 12px;
            padding: 14px;
            text-align: center;
            margin-top: 16px;
            animation: slideUp 0.6s ease 0.4s backwards;
        ">
            <p class="text-secondary" style="font-size: 12px; margin: 0;">
                <span style="color: #a855f7; font-weight: 600;">🔒 Locked Funds</span> - Your investment will be locked until the plan completes
            </p>
        </div>

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
            font-size: 20px !important;
        }

        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
            gap: 12px !important;
        }

        [style*="padding: 24px"] {
            padding: 16px !important;
        }

        [style*="padding: 16px"] {
            padding: 12px !important;
        }

        [style*="gap: 16px"] {
            gap: 12px !important;
        }

        .mb-32 {
            margin-bottom: 20px !important;
        }

        .mb-24 {
            margin-bottom: 18px !important;
        }
    }

    /* TABLET RESPONSIVE */
    @media (min-width: 769px) and (max-width: 1024px) {
        h1 {
            font-size: 28px !important;
        }

        h3 {
            font-size: 22px !important;
        }
    }
</style>

@endsection
