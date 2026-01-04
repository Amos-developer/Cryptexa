@extends('layouts.app')

@section('hide-header', true)
@section('title', $plan->name)

@section('content')

<div class="tf-container mt-24 mb-32">

    <!-- CARD -->
    <div
        style="
            background:linear-gradient(135deg,#020617,#0f172a);
            border-radius:22px;
            padding:22px;
            box-shadow:
                0 0 0 1px rgba(56,189,248,.12),
                0 25px 60px rgba(0,0,0,.75),
                inset 0 0 30px rgba(56,189,248,.05);
        ">

        <!-- PLAN NAME -->
        <h2 class="text-white mb-8 fw-bold">
            {{ $plan->name }}
        </h2>

        <!-- DESCRIPTION -->
        <p class="text-secondary mb-20" style="line-height:1.6;">
            {{ $plan->description }}
        </p>

        <!-- INFO BOX -->
        <div
            style="
                background:rgba(2,6,23,.7);
                border:1px solid rgba(255,255,255,.08);
                border-radius:16px;
                padding:16px;
                margin-bottom:20px;
            ">

            <div class="d-flex justify-content-between mb-12">
                <span class="text-secondary">Plan Price</span>
                <span class="text-white fw-semibold">${{ number_format($plan->price, 2) }}</span>
            </div>

            <div class="d-flex justify-content-between mb-12">
                <span class="text-secondary">Duration</span>
                <span class="text-white fw-semibold">
                    {{ $plan->duration_minutes }} minutes
                </span>
            </div>

            <div class="d-flex justify-content-between">
                <span class="text-secondary">Expected Profit</span>
                <span
                    style="
                        color:#22c55e;
                        background:rgba(34,197,94,.12);
                        padding:4px 10px;
                        border-radius:999px;
                        font-weight:600;
                        font-size:13px;
                    ">
                    +{{ $plan->min_profit }}% – {{ $plan->max_profit }}%
                </span>
            </div>

        </div>

        <!-- ACTION BUTTON -->
        <form method="POST" action="{{ route('compute.unlock', $plan->id) }}">
            @csrf
            <button
                style="
                    width:100%;
                    padding:14px;
                    border-radius:16px;
                    background:linear-gradient(90deg,#22c55e,#4ade80);
                    color:#020617;
                    font-size:15px;
                    font-weight:700;
                    border:none;
                    box-shadow:0 0 18px rgba(34,197,94,.45);
                ">
                Activate Compute Plan
            </button>
        </form>

        <!-- FOOT NOTE -->
        <p class="text-secondary text-center mt-12" style="font-size:12px;">
            Funds will be locked until plan completes.
        </p>

    </div>

</div>

@endsection