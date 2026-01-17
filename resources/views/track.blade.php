@extends('layouts.app')

@section('title', 'My Compute Orders')
@section('hide-header', true)

@section('content')

<div class="tf-container mt-20">

    <!-- TABS -->
    <div class="d-flex gap-8 mb-16">
        <button class="tab-btn active" onclick="showTab('active')">Active Orders</button>
        <button class="tab-btn" onclick="showTab('completed')">Completed Orders</button>
    </div>

    <!-- ACTIVE ORDERS -->
    <div id="active-orders">

        @forelse($activeOrders as $order)
        <div class="order-card mb-16">

            <div class="d-flex justify-content-between mb-8">
                {{ optional($order->computePlan)->name ?? 'Compute Plan' }}
                <span class="badge-running">RUNNING</span>
            </div>

            <!-- COUNTDOWN -->
            @php
            $remaining = max(0, now()->diffInSeconds($order->ends_at, false));
            @endphp

            <div class="countdown text-primary mb-8"
                data-remaining="{{ $remaining }}">
            </div>

            <div class="d-flex justify-content-between text-small text-secondary">
                <span>Capital</span>
                <span>${{ number_format($order->amount, 2) }}</span>
            </div>

            <div class="d-flex justify-content-between text-small text-success">
                <span>Expected Profit</span>
                <span>+${{ number_format($order->expected_profit, 2) }}</span>
            </div>

        </div>
        @empty
        <div class="text-center text-secondary mt-40">
            No active orders
        </div>
        @endforelse

    </div>

    <!-- COMPLETED ORDERS -->
    <div id="completed-orders" style="display:none;">

        @forelse($completedOrders as $order)
        <div class="order-card mb-16">

            <div class="d-flex justify-content-between mb-8">
                {{ optional($order->computePlan)->name ?? 'Compute Plan' }}
                <span class="badge-completed">COMPLETED</span>
            </div>

            <div class="d-flex justify-content-between text-small text-secondary">
                <span>Capital</span>
                <span>${{ number_format($order->amount, 2) }}</span>
            </div>

            <div class="d-flex justify-content-between text-small text-success">
                <span>Profit</span>
                <span>+${{ number_format($order->expected_profit, 2) }}</span>
            </div>

            <div class="d-flex justify-content-between text-small text-primary mt-6">
                <span>Total Return</span>
                <span>${{ number_format($order->amount + $order->expected_profit, 2) }}</span>
            </div>

            <div class="text-secondary text-small mt-6">
                Finished {{ $order->ends_at->diffForHumans() }}
            </div>

        </div>
        @empty
        <div class="text-center text-secondary mt-40">
            No completed orders
        </div>
        @endforelse

    </div>

</div>

{{-- STYLES --}}
<style>
    .tab-btn {
        flex: 1;
        padding: 10px;
        border-radius: 999px;
        border: none;
        background: #020617;
        color: #94a3b8;
        font-weight: 600;
    }

    .tab-btn.active {
        background: linear-gradient(135deg, #38bdf8, #0ea5e9);
        color: #020617;
    }

    .order-card {
        background: linear-gradient(135deg, #020617, #0f172a);
        border-radius: 18px;
        padding: 18px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .6);
    }

    .badge-running {
        background: rgba(251, 191, 36, .15);
        color: #fbbf24;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-completed {
        background: rgba(34, 197, 94, .15);
        color: #22c55e;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .countdown {
        font-size: 18px;
        font-weight: 700;
    }
</style>

{{-- SCRIPTS --}}
<script>
    function showTab(tab) {
        document.getElementById('active-orders').style.display = tab === 'active' ? 'block' : 'none';
        document.getElementById('completed-orders').style.display = tab === 'completed' ? 'block' : 'none';

        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
    }

    /* COUNTDOWN TIMER */
    document.querySelectorAll('.countdown').forEach(el => {
        let seconds = parseInt(el.dataset.remaining);
        let hasRefreshed = false;

        function tick() {
            if (seconds <= 0) {
                el.innerText = 'Completed';
                el.style.color = '#22c55e';

                // Refresh ONLY once when countdown reaches 0
                if (!hasRefreshed) {
                    hasRefreshed = true;
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }

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