@extends('layouts.app')

@section('title', 'Compute Orders | Cryptexa')
@section('hide-header', true)

@section('content')

<link rel="stylesheet" href="{{ asset('css/team.css') }}">

<!-- HEADER BAR -->
<div class="team-header">
    <a href="{{ url()->previous() }}" class="back-btn">
        <i class="icon-left-btn"></i>
    </a>
    <h6 class="header-title">{{ __t('my_pools') }}</h6>
    <span class="placeholder"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%);">
    <div class="tf-container">

        <!-- PAGE HEADER -->
        <div class="mb-24" style="animation: slideDown 0.6s ease;">
            <!-- <h1 style="color: #e5e7eb; font-weight: 900; font-size: 32px; margin: 0 0 8px 0;">{{ __t('my_pools') }}</h1> -->
            <p class="text-secondary" style="font-size: 14px; margin: 0;">{{ __t('track_orders') }}</p>
        </div>

        <!-- TABS -->
        <div style="
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
            animation: slideUp 0.6s ease 0.1s backwards;
        ">
            <button class="tab-btn active" onclick="showTab('active')"
                style="
                    flex: 1;
                    padding: 12px;
                    border-radius: 12px;
                    border: 1px solid rgba(56,189,248,0.2);
                    background: linear-gradient(135deg, rgba(56,189,248,0.15) 0%, rgba(56,189,248,0.05) 100%);
                    color: #38bdf8;
                    font-weight: 700;
                    font-size: 14px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                "
                onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.2) 0%, rgba(56,189,248,0.1) 100%)';"
                onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15) 0%, rgba(56,189,248,0.05) 100%)';">
                🚀 {{ __t('active_orders') }}
            </button>

            <button class="tab-btn" onclick="showTab('completed')"
                style="
                    flex: 1;
                    padding: 12px;
                    border-radius: 12px;
                    border: 1px solid rgba(255,255,255,0.08);
                    background: rgba(255,255,255,0.02);
                    color: #94a3b8;
                    font-weight: 700;
                    font-size: 14px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                "
                onmouseover="this.style.borderColor='rgba(255,255,255,0.12)'; this.style.background='rgba(255,255,255,0.04)';"
                onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'; this.style.background='rgba(255,255,255,0.02)';">
                ✓ {{ __t('completed_orders') }}
            </button>
        </div>

        <!-- ACTIVE ORDERS TAB -->
        <div id="active-orders" style="animation: slideUp 0.6s ease 0.15s backwards;">

            @forelse($activeOrders as $order)
            <div style="
                background: linear-gradient(135deg, rgba(251,191,36,0.1) 0%, rgba(251,191,36,0.03) 100%);
                border: 1px solid rgba(251,191,36,0.2);
                border-radius: 16px;
                padding: 20px;
                box-shadow: 0 8px 32px rgba(251,191,36,0.08);
                backdrop-filter: blur(10px);
                margin-bottom: 16px;
                transition: all 0.3s ease;
            "
                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 12px 40px rgba(251,191,36,0.15)';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 32px rgba(251,191,36,0.08)';">

                <!-- HEADER -->
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px;">
                    <div>
                        <h4 style="color: #e5e7eb; font-weight: 800; font-size: 16px; margin: 0 0 4px 0;">
                            {{ optional($order->computePlan)->name ?? 'Compute Plan' }}
                        </h4>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">Order #{{ $order->id }}</p>
                    </div>
                    <span style="
                        background: linear-gradient(135deg, rgba(251,191,36,0.25) 0%, rgba(251,191,36,0.15) 100%);
                        color: #fbbf24;
                        padding: 8px 14px;
                        border-radius: 999px;
                        font-size: 11px;
                        font-weight: 800;
                        border: 1px solid rgba(251,191,36,0.3);
                        white-space: nowrap;
                    ">
                        ⚡ ACTIVE
                    </span>
                </div>

                <!-- END DATE/TIME CARD -->
                <div style="
                    background: linear-gradient(135deg, rgba(56,189,248,0.12) 0%, rgba(56,189,248,0.04) 100%);
                    border: 1px solid rgba(56,189,248,0.25);
                    border-radius: 12px;
                    padding: 14px;
                    margin-bottom: 16px;
                ">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                        <span style="font-size: 18px;">🎯</span>
                        <p style="color: #94a3b8; font-size: 11px; font-weight: 700; text-transform: uppercase; margin: 0; letter-spacing: 0.5px;">{{ __t('pool_ends_on') }}</p>
                    </div>
                    <p style="color: #38bdf8; font-size: 15px; font-weight: 800; margin: 0 0 4px 0;">
                        {{ $order->ends_at->format('l, F j, Y') }}
                    </p>
                    <p style="color: #38bdf8; font-size: 13px; font-weight: 600; margin: 0;">
                        {{ $order->ends_at->format('g:i A') }} ({{ $order->ends_at->timezone->getName() }})
                    </p>
                </div>

                <!-- COUNTDOWN TIMER -->
                @php
                $remaining = max(0, now()->diffInSeconds($order->ends_at, false));
                @endphp

                <div style="
                    background: rgba(0,0,0,0.3);
                    border-radius: 12px;
                    padding: 16px;
                    text-align: center;
                    margin-bottom: 16px;
                    border: 1px solid rgba(251,191,36,0.2);
                ">
                    <p style="color: #94a3b8; font-size: 11px; font-weight: 700; text-transform: uppercase; margin: 0 0 8px 0; letter-spacing: 0.5px;">Time Remaining</p>
                    <div class="countdown"
                        data-remaining="{{ $remaining }}"
                        style="
                            color: #fbbf24;
                            font-size: 22px;
                            font-weight: 900;
                            letter-spacing: 1px;
                        ">
                    </div>
                </div>

                <!-- PROGRESS BAR -->
                @php
                $totalDuration = $order->created_at->diffInSeconds($order->ends_at);
                $elapsed = $order->created_at->diffInSeconds(now());
                $progress = min(100, ($elapsed / $totalDuration) * 100);
                @endphp
                <div style="margin-bottom: 16px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                        <span style="color: #94a3b8; font-size: 11px; font-weight: 600;">Progress</span>
                        <span style="color: #fbbf24; font-size: 11px; font-weight: 700;">{{ number_format($progress, 1) }}%</span>
                    </div>
                    <div style="
                        width: 100%;
                        height: 8px;
                        background: rgba(255,255,255,0.08);
                        border-radius: 999px;
                        overflow: hidden;
                        border: 1px solid rgba(255,255,255,0.1);
                    ">
                        <div style="
                            width: {{ $progress }}%;
                            height: 100%;
                            background: linear-gradient(90deg, #fbbf24, #f59e0b, #fbbf24);
                            background-size: 200% 100%;
                            animation: shimmer 2s infinite;
                            transition: width 1s ease;
                        "></div>
                    </div>
                </div>

                <!-- STATS GRID -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 12px;">
                    <div style="
                        background: rgba(0,0,0,0.3);
                        padding: 12px;
                        border-radius: 10px;
                        border: 1px solid rgba(255,255,255,0.1);
                    ">
                        <p style="color: #94a3b8; font-size: 10px; font-weight: 700; text-transform: uppercase; margin: 0 0 6px 0; letter-spacing: 0.5px;">💰 Capital</p>
                        <p style="color: #e5e7eb; font-size: 16px; font-weight: 800; margin: 0;">${{ number_format($order->amount, 2) }}</p>
                    </div>

                    <div style="
                        background: rgba(0,0,0,0.3);
                        padding: 12px;
                        border-radius: 10px;
                        border: 1px solid rgba(34,197,94,0.3);
                    ">
                        <p style="color: #94a3b8; font-size: 10px; font-weight: 700; text-transform: uppercase; margin: 0 0 6px 0; letter-spacing: 0.5px;">📈 Expected</p>
                        <p style="color: #22c55e; font-size: 16px; font-weight: 800; margin: 0;">+${{ number_format($order->expected_profit, 2) }}</p>
                    </div>
                </div>

                <!-- TOTAL RETURN -->
                <div style="
                    background: linear-gradient(135deg, rgba(34,197,94,0.15) 0%, rgba(34,197,94,0.05) 100%);
                    border: 1px solid rgba(34,197,94,0.3);
                    padding: 14px;
                    border-radius: 10px;
                    text-align: center;
                ">
                    <p style="color: #94a3b8; font-size: 10px; font-weight: 700; text-transform: uppercase; margin: 0 0 6px 0; letter-spacing: 0.5px;">🎁 Total Return</p>
                    <p style="color: #22c55e; font-size: 20px; font-weight: 900; margin: 0;">${{ number_format($order->amount + $order->expected_profit, 2) }}</p>
                </div>

            </div>
            @empty
            <div style="
                text-align: center;
                padding: 40px 20px;
                color: #94a3b8;
                font-size: 14px;
            ">
                <p style="font-size: 32px; margin: 0 0 8px 0;">📭</p>
                <p style="margin: 0;">{{ __t('no_active_orders') }}</p>
            </div>
            @endforelse

        </div>

        <!-- COMPLETED ORDERS TAB -->
        <div id="completed-orders" style="display: none;">

            @forelse($completedOrders as $order)
            <div style="
                background: linear-gradient(135deg, rgba(34,197,94,0.08) 0%, rgba(34,197,94,0.02) 100%);
                border: 1px solid rgba(34,197,94,0.15);
                border-radius: 14px;
                padding: 18px;
                box-shadow: 0 10px 30px rgba(34,197,94,0.05), inset 0 0 20px rgba(34,197,94,0.03);
                backdrop-filter: blur(10px);
                margin-bottom: 14px;
                transition: all 0.3s ease;
            "
                onmouseover="this.style.borderColor='rgba(34,197,94,0.3)'; this.style.boxShadow='0 10px 30px rgba(34,197,94,0.1), inset 0 0 20px rgba(34,197,94,0.05)';"
                onmouseout="this.style.borderColor='rgba(34,197,94,0.15)'; this.style.boxShadow='0 10px 30px rgba(34,197,94,0.05), inset 0 0 20px rgba(34,197,94,0.03)';">

                <!-- HEADER -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                    <h4 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0;">
                        {{ optional($order->computePlan)->name ?? 'Compute Plan' }}
                    </h4>
                    <span style="
                        background: rgba(34,197,94,0.2);
                        color: #22c55e;
                        padding: 6px 12px;
                        border-radius: 999px;
                        font-size: 11px;
                        font-weight: 700;
                    ">
                        ✓ {{ __t('completed') }}
                    </span>
                </div>

                <!-- STATS GRID -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px;">
                    <div style="
                        background: rgba(255,255,255,0.02);
                        padding: 10px;
                        border-radius: 10px;
                        border: 1px solid rgba(34,197,94,0.2);
                    ">
                        <p style="color: #94a3b8; font-size: 11px; font-weight: 600; text-transform: uppercase; margin: 0 0 4px 0;">Capital</p>
                        <p style="color: #e5e7eb; font-size: 13px; font-weight: 700; margin: 0;">${{ number_format($order->amount, 2) }}</p>
                    </div>

                    <div style="
                        background: rgba(255,255,255,0.02);
                        padding: 10px;
                        border-radius: 10px;
                        border: 1px solid rgba(34,197,94,0.2);
                    ">
                        <p style="color: #94a3b8; font-size: 11px; font-weight: 600; text-transform: uppercase; margin: 0 0 4px 0;">{{ __t('profit') }}</p>
                        <p style="color: #22c55e; font-size: 13px; font-weight: 700; margin: 0;">+${{ number_format($order->expected_profit, 2) }}</p>
                    </div>
                </div>

                <!-- TOTAL RETURN -->
                <div style="
                    background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
                    border: 1px solid rgba(56,189,248,0.15);
                    padding: 12px;
                    border-radius: 10px;
                    margin-bottom: 10px;
                ">
                    <p style="color: #94a3b8; font-size: 11px; font-weight: 600; text-transform: uppercase; margin: 0 0 4px 0;">Total Return</p>
                    <p style="color: #38bdf8; font-size: 15px; font-weight: 900; margin: 0;">${{ number_format($order->amount + $order->expected_profit, 2) }}</p>
                </div>

                <!-- COMPLETION TIME -->
                <p style="color: #94a3b8; font-size: 11px; margin: 0;">
                    ✓ Finished {{ $order->ends_at->diffForHumans() }}
                </p>

            </div>
            @empty
            <div style="
                text-align: center;
                padding: 40px 20px;
                color: #94a3b8;
                font-size: 14px;
            ">
                <p style="font-size: 32px; margin: 0 0 8px 0;">📭</p>
                <p style="margin: 0;">{{ __t('no_completed_orders') }}</p>
            </div>
            @endforelse

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

    @keyframes shimmer {
        0% {
            background-position: 200% 0;
        }
        100% {
            background-position: -200% 0;
        }
    }

    /* MOBILE RESPONSIVE */
    @media (max-width: 768px) {
        .pt-80 {
            padding-top: 80px !important;
        }

        .pb-80 {
            padding-bottom: 80px !important;
        }

        h1 {
            font-size: 26px !important;
        }

        .countdown {
            font-size: 18px !important;
        }
    }

    /* TABLET RESPONSIVE */
    @media (min-width: 769px) and (max-width: 1024px) {
        h1 {
            font-size: 28px !important;
        }

        h4 {
            font-size: 14px !important;
        }
    }
</style>

<!-- SCRIPTS -->
<script>
    function showTab(tab) {
        const activeBtn = event.target;
        const allButtons = document.querySelectorAll('.tab-btn');

        document.getElementById('active-orders').style.display = tab === 'active' ? 'block' : 'none';
        document.getElementById('completed-orders').style.display = tab === 'completed' ? 'block' : 'none';

        allButtons.forEach(btn => {
            btn.classList.remove('active');
            if (tab === 'active') {
                allButtons[0].style.background = 'linear-gradient(135deg, rgba(56,189,248,0.15) 0%, rgba(56,189,248,0.05) 100%)';
                allButtons[0].style.color = '#38bdf8';
                allButtons[0].style.borderColor = 'rgba(56,189,248,0.2)';
                allButtons[1].style.background = 'rgba(255,255,255,0.02)';
                allButtons[1].style.color = '#94a3b8';
                allButtons[1].style.borderColor = 'rgba(255,255,255,0.08)';
            } else {
                allButtons[0].style.background = 'rgba(255,255,255,0.02)';
                allButtons[0].style.color = '#94a3b8';
                allButtons[0].style.borderColor = 'rgba(255,255,255,0.08)';
                allButtons[1].style.background = 'linear-gradient(135deg, rgba(34,197,94,0.15) 0%, rgba(34,197,94,0.05) 100%)';
                allButtons[1].style.color = '#22c55e';
                allButtons[1].style.borderColor = 'rgba(34,197,94,0.2)';
            }
        });

        activeBtn.classList.add('active');
    }

    /* COUNTDOWN TIMER */
    document.querySelectorAll('.countdown').forEach(el => {
        let seconds = parseInt(el.dataset.remaining);

        function tick() {
            if (seconds <= 0) {
                el.innerText = 'Completed!';
                el.style.color = '#22c55e';

                // Soft refresh after 2s
                setTimeout(() => {
                    window.location.href = window.location.href;
                }, 2000);

                return;
            }

            let d = Math.floor(seconds / 86400);
            let h = Math.floor((seconds % 86400) / 3600);
            let m = Math.floor((seconds % 3600) / 60);
            let s = seconds % 60;

            el.innerText = d > 0 ? `${d}d ${h}h ${m}m ${s}s remaining` : `${h}h ${m}m ${s}s remaining`;
            seconds--;
        }

        tick();
        setInterval(tick, 1000);
    });
</script>

@endsection