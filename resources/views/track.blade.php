@extends('layouts.app')

@section('title', 'Track Compute Order')
@section('hide-header', true)

@section('content')
<div class="tf-container mt-20">

    @if(!$order)
    <div class="text-center text-secondary mt-40">
        <i class="icon-warning mb-8" style="font-size:32px;"></i>
        <p>No active compute orders</p>
    </div>
    @else

    <div
        style="
        background:linear-gradient(135deg,#020617,#0f172a);
        border-radius:22px;
        padding:22px;
        box-shadow:
            0 0 0 1px rgba(56,189,248,.08),
            0 20px 45px rgba(0,0,0,.65);
    ">

        <!-- HEADER -->
        <div class="mb-16">
            <h4 class="text-white mb-6">
                {{ optional($order->plan)->name ?? 'Compute Plan' }}
            </h4>

            <span
                style="
                font-size:12px;
                padding:4px 12px;
                border-radius:999px;
                font-weight:600;
                {{ $order->status === 'completed'
                    ? 'background:rgba(34,197,94,.15);color:#22c55e;'
                    : 'background:rgba(251,191,36,.15);color:#fbbf24;' }}
            ">
                {{ strtoupper($order->status) }}
            </span>
        </div>

        <!-- PROGRESS -->
        <div class="mb-12">
            <div
                style="
                background:#020617;
                border-radius:999px;
                height:12px;
                overflow:hidden;
                border:1px solid rgba(255,255,255,.06);
            ">
                <div
                    style="
                    width:{{ $order->progress_percentage }}%;
                    height:100%;
                    background:linear-gradient(90deg,#38bdf8,#0ea5e9);
                    transition:width .6s ease;
                ">
                </div>
            </div>

            <div class="d-flex justify-content-between text-small mt-6 text-secondary">
                <span>{{ $order->progress_percentage }}% completed</span>
                <span>
                    {{ $order->status === 'completed' ? 'Completed' : 'Processing' }}
                </span>
            </div>
        </div>

        <!-- TIME INFO -->
        <div class="d-flex justify-content-between text-small text-secondary mb-16">
            <span>Started: {{ $order->started_at->diffForHumans() }}</span>
            <span>Ends: {{ $order->ends_at->diffForHumans() }}</span>
        </div>

        <hr style="border-color:rgba(255,255,255,.08);margin:16px 0;">

        <!-- FINANCIAL DETAILS -->
        <div class="d-flex justify-content-between mb-10">
            <span class="text-secondary">Capital</span>
            <span class="text-white fw-semibold">${{ number_format($order->amount, 2) }}</span>
        </div>

        <div class="d-flex justify-content-between mb-10">
            <span class="text-secondary">Profit</span>
            <span class="text-success fw-semibold">
                +${{ number_format($order->expected_profit, 2) }}
            </span>
        </div>

        <div class="d-flex justify-content-between">
            <span class="text-secondary">Total Return</span>
            <span class="fw-bold text-primary">
                ${{ number_format($order->amount + $order->expected_profit, 2) }}
            </span>
        </div>

        <!-- COMPLETED MESSAGE -->
        @if($order->status === 'completed')
        <div
            class="mt-16 text-center"
            style="
                padding:14px;
                border-radius:14px;
                background:rgba(34,197,94,.12);
                border:1px solid rgba(34,197,94,.35);
                color:#22c55e;
                font-weight:600;
            ">
            ✅ Compute completed successfully
            <br>
            Profit added to your balance
        </div>
        @endif

    </div>

    @endif
</div>

@if($order && $order->status !== 'completed')
<script>
    setInterval(() => {
        location.reload();
    }, 15000); // refresh every 15 seconds
</script>
@endif

@endsection