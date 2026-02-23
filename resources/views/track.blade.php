@extends('layouts.app')

@section('title', 'Compute Orders | Cryptexa')

@section('hide-header')
@endsection

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
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Compute Orders</h6>
    <span style="width: 36px;"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%);">
    <div class="tf-container">

        <!-- PAGE HEADER -->
        <div class="mb-24" style="animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 32px; margin: 0 0 8px 0;">Order History</h1>
            <p class="text-secondary" style="font-size: 14px; margin: 0;">Track your active and completed compute orders</p>
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
                🚀 Active Orders
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
                ✓ Completed Orders
            </button>
        </div>

        <!-- ACTIVE ORDERS TAB -->
        <div id="active-orders" style="animation: slideUp 0.6s ease 0.15s backwards;">

            @forelse($activeOrders as $order)
            <div style="
                background: linear-gradient(135deg, rgba(251,191,36,0.08) 0%, rgba(251,191,36,0.02) 100%);
                border: 1px solid rgba(251,191,36,0.15);
                border-radius: 14px;
                padding: 18px;
                box-shadow: 0 10px 30px rgba(251,191,36,0.05), inset 0 0 20px rgba(251,191,36,0.03);
                backdrop-filter: blur(10px);
                margin-bottom: 14px;
                transition: all 0.3s ease;
            "
                onmouseover="this.style.borderColor='rgba(251,191,36,0.3)'; this.style.boxShadow='0 10px 30px rgba(251,191,36,0.1), inset 0 0 20px rgba(251,191,36,0.05)';"
                onmouseout="this.style.borderColor='rgba(251,191,36,0.15)'; this.style.boxShadow='0 10px 30px rgba(251,191,36,0.05), inset 0 0 20px rgba(251,191,36,0.03)';">

                <!-- HEADER -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                    <h4 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0;">
                        {{ optional($order->computePlan)->name ?? 'Compute Plan' }}
                    </h4>
                    <span style="
                        background: rgba(251,191,36,0.2);
                        color: #fbbf24;
                        padding: 6px 12px;
                        border-radius: 999px;
                        font-size: 11px;
                        font-weight: 700;
                    ">
                        ⚡ RUNNING
                    </span>
                </div>

                <!-- COUNTDOWN TIMER -->
                @php
                $remaining = max(0, now()->diffInSeconds($order->ends_at, false));
                @endphp

                <div class="countdown"
                    data-remaining="{{ $remaining }}"
                    style="
                        color: #fbbf24;
                        font-size: 20px;
                        font-weight: 900;
                        margin-bottom: 14px;
                    ">
                </div>

                <!-- STATS GRID -->
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; margin-bottom: 12px;">
                    <div style="
                        background: rgba(255,255,255,0.02);
                        padding: 10px;
                        border-radius: 10px;
                        border: 1px solid rgba(251,191,36,0.2);
                    ">
                        <p style="color: #94a3b8; font-size: 11px; font-weight: 600; text-transform: uppercase; margin: 0 0 4px 0;">Capital</p>
                        <p style="color: #e5e7eb; font-size: 13px; font-weight: 700; margin: 0;">${{ number_format($order->amount, 2) }}</p>
                    </div>

                    <div style="
                        background: rgba(255,255,255,0.02);
                        padding: 10px;
                        border-radius: 10px;
                        border: 1px solid rgba(251,191,36,0.2);
                    ">
                        <p style="color: #94a3b8; font-size: 11px; font-weight: 600; text-transform: uppercase; margin: 0 0 4px 0;">Current</p>
                        <p style="color: #22c55e; font-size: 13px; font-weight: 700; margin: 0;">+${{ number_format($order->amount - $order->investment_amount, 2) }}</p>
                    </div>

                    <div style="
                        background: rgba(255,255,255,0.02);
                        padding: 10px;
                        border-radius: 10px;
                        border: 1px solid rgba(251,191,36,0.2);
                    ">
                        <p style="color: #94a3b8; font-size: 11px; font-weight: 600; text-transform: uppercase; margin: 0 0 4px 0;">Expected</p>
                        <p style="color: #22c55e; font-size: 13px; font-weight: 700; margin: 0;">+${{ number_format($order->expected_profit, 2) }}</p>
                    </div>
                </div>

                <!-- PROGRESS BAR -->
                @php
                $totalDuration = $order->created_at->diffInSeconds($order->ends_at);
                $elapsed = $order->created_at->diffInSeconds(now());
                $progress = min(100, ($elapsed / $totalDuration) * 100);
                @endphp
                <div style="
                    width: 100%;
                    height: 6px;
                    background: rgba(255,255,255,0.1);
                    border-radius: 999px;
                    overflow: hidden;
                ">
                    <div style="
                        width: {{ $progress }}%;
                        height: 100%;
                        background: linear-gradient(90deg, #fbbf24, #f59e0b);
                        transition: width 1s linear;
                    "></div>
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
                <p style="margin: 0;">No active orders at the moment</p>
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
                        ✓ COMPLETED
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
                        <p style="color: #94a3b8; font-size: 11px; font-weight: 600; text-transform: uppercase; margin: 0 0 4px 0;">Profit</p>
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
                <p style="margin: 0;">No completed orders yet</p>
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

        h4 {
            font-size: 13px !important;
        }

        [style*="flex: 1"] {
            flex: 1 !important;
            font-size: 12px !important;
            padding: 10px !important;
        }

        [style*="padding: 18px"] {
            padding: 14px !important;
        }

        [style*="gap: 12px"] {
            gap: 10px !important;
        }

        .countdown {
            font-size: 18px !important;
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

            let h = Math.floor(seconds / 3600);
            let m = Math.floor((seconds % 3600) / 60);
            let s = seconds % 60;

            el.innerText = `${h}h ${m}m ${s}s remaining`;
            seconds--;
        }

        tick();
        setInterval(tick, 1000);
    });
</script>

@endsection