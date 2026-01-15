@extends('layouts.app')

@section('title', 'Home | Cryptexa')

@section('content')

<!-- PRELOADER -->
<!-- <div class="preload preload-container">
    <div class="preload-logo" style="background-image: url('{{ asset('images/logo/144.png') }}')">
        <div class="spinner"></div>
    </div>
</div> -->

<!-- HEADER CONTENT -->


<!-- MAIN CONTENT -->
<div class="pt-58 pb-80">

    <!-- WALLET -->
    <div class="tf-container mt-60"
        style="
        background: linear-gradient(180deg, #020617, #0f172a);
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(56,189,248,0.15);
        padding: 16px;
     ">

        {{-- BALANCE --}}
        <div class="pt-12 pb-12">

            <h5 class="text-secondary">
                <span style="
                color:#38bdf8;
                font-weight:600;
            ">
                    Balance
                </span>
            </h5>

            <h1 class="mt-12"
                style="
                color:#e5e7eb;
                font-weight:700;
                letter-spacing:0.5px;
                text-shadow:0 0 24px rgba(56,189,248,0.4);
            ">
                ${{ number_format(auth()->user()->balance, 2) }}
            </h1>

            {{-- ACTIONS --}}
            <ul class="mt-20 grid-4 gap-12">

                {{-- Deposit --}}
                <li>
                    <a href="{{ route('choose.cryptocurrency') }}"
                        class="d-flex flex-column align-items-center gap-8 text-decoration-none">

                        <span style="
                        width:48px;
                        height:48px;
                        border-radius:50%;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        background: rgba(56,189,248,0.12);
                        border:1px solid rgba(56,189,248,0.5);
                        box-shadow:0 0 16px rgba(56,189,248,0.6);
                    ">
                            <i class="icon icon-way text-primary"></i>
                        </span>

                        <span style="color:#e5e7eb;font-size:12px;">Deposit</span>
                    </a>
                </li>

                {{-- Withdraw --}}
                <li>
                    <a href="#"
                        class="d-flex flex-column align-items-center gap-8 text-decoration-none">

                        <span style="
                        width:48px;
                        height:48px;
                        border-radius:50%;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        background: rgba(34,197,94,0.12);
                        border:1px solid rgba(34,197,94,0.5);
                        box-shadow:0 0 16px rgba(34,197,94,0.6);
                    ">
                            <i class="icon icon-way2 text-success"></i>
                        </span>

                        <span style="color:#e5e7eb;font-size:12px;">Withdraw</span>
                    </a>
                </li>

                {{-- Invites --}}
                <li>
                    <a href="{{ route('invites') }}"
                        class="d-flex flex-column align-items-center gap-8 text-decoration-none">

                        <span style="
                        width:48px;
                        height:48px;
                        border-radius:50%;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        background: rgba(168,85,247,0.12);
                        border:1px solid rgba(168,85,247,0.5);
                        box-shadow:0 0 16px rgba(168,85,247,0.6);
                    ">
                            <i class="icon icon-wallet text-purple"></i>
                        </span>

                        <span style="color:#e5e7eb;font-size:12px;">Invites</span>
                    </a>
                </li>

                <!-- Community -->
                <li>
                    <a href="javascript:void(0)"
                        onclick="openCommunityModal()"
                        class="d-flex flex-column align-items-center gap-8 text-decoration-none">

                        <span style="
                            width:48px;
                            height:48px;
                            border-radius:50%;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            background: rgba(251,191,36,0.12);
                            border:1px solid rgba(251,191,36,0.5);
                            box-shadow:0 0 16px rgba(251,191,36,0.6);
                        ">
                            <i class="icon icon-exchange text-warning"></i>
                        </span>

                        <span style="color:#e5e7eb;font-size:12px;">Community</span>
                    </a>
                </li>


            </ul>

        </div>
    </div>


    <!-- COMPUTE ACTIVITY -->
    <div class="tf-container mt-12"
        style="
        background: linear-gradient(135deg, #0f172a, #020617);
        border-radius: 20px;
        padding: 16px;
        box-shadow:
            0 0 0 1px rgba(56,189,248,0.08),
            0 10px 30px rgba(0,0,0,0.6),
            inset 0 0 30px rgba(56,189,248,0.04);
        ">

        <h5 class="mb-12 text-white">History</h5>

        <div class="swiper compute-swiper activity-swiper">
            <div class="swiper-wrapper">

                @forelse ($orders as $order)
                <div class="swiper-slide market-swiper">

                    <div
                        style="
                        width:260px;
                        padding:14px;
                        border-radius:16px;
                        background:linear-gradient(135deg,#020617,#020617);
                        border:1px solid rgba(255,255,255,.06);
                        box-shadow:0 8px 24px rgba(0,0,0,.45);
                    ">

                        <!-- PLAN -->
                        <p class="fw-semibold text-white mb-6">
                            {{ $order->computePlan->name }}
                        </p>

                        <!-- AMOUNT -->
                        <span class="text-secondary text-small d-block mb-8">
                            Invested: ${{ number_format($order->amount, 2) }}
                        </span>

                        <!-- STATUS -->
                        @php
                        $running = now()->lt($order->ends_at);
                        @endphp

                        <span
                            style="
                            font-size:12px;
                            padding:4px 12px;
                            border-radius:999px;
                            font-weight:600;
                            {{ $running 
                                ? 'color:#38bdf8;background:rgba(56,189,248,.15);' 
                                : 'color:#22c55e;background:rgba(34,197,94,.15);' }}
                        ">
                            {{ $running ? 'Running' : 'Completed' }}
                        </span>

                        <!-- TIME -->
                        <div class="mt-10 text-secondary text-small">
                            {{ $order->created_at->diffForHumans() }}
                        </div>

                    </div>

                </div>
                @empty
                <div class="text-secondary">No compute orders yet</div>
                @endforelse

            </div>
        </div>
    </div>
    <!-- END COMPU -->



    <!-- AI COMPUTE PLANS -->
    <div class="tf-container mt-12"
        style="
    background:linear-gradient(135deg,#020617,#0f172a);
    border-radius:20px;
    box-shadow:
        0 0 0 1px rgba(56,189,248,.08),
        0 15px 40px rgba(0,0,0,.6),
        inset 0 0 30px rgba(56,189,248,.04);
">

        <div class="pt-16 pb-16">

            <!-- HEADER -->
            <div class="mb-16">
                <h5 class="d-flex align-items-center gap-8 mb-8 text-white">
                    <i class="icon-cpu" style="color:#38bdf8;"></i>
                    <span class="fw-semibold">AI Compute Plans</span>
                </h5>
                <small style="color:#94a3b8;">
                    Lease decentralized AI & cloud compute resources
                </small>
            </div>

            <!-- TABLE HEADER -->
            <div class="d-flex justify-content-between align-items-center text-small mb-12"
                style="color:#94a3b8;">
                <span>Plan</span>
                <div class="d-flex gap-24">
                    <span>Cost</span>
                    <span>Yield</span>
                </div>
            </div>

            <!-- PLAN LIST -->
            <ul class="d-flex flex-column gap-12">



                @foreach ($plans as $plan)
                <li>
                    <div class="d-flex align-items-center gap-12 p-12 rounded"
                        style="
                    background:linear-gradient(135deg,#020617,#020617);
                    border:1px solid rgba(255,255,255,.06);
                    box-shadow:0 8px 24px rgba(0,0,0,.45);
                ">

                        <!-- ICON -->
                        <div style="
                        width:46px;
                        height:46px;
                        border-radius:50%;
                        background:rgba(56,189,248,.08);
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        border:1px solid rgba(56,189,248,.2);
                    ">
                            <img src="{{ asset('images/coin/'.$plan['icon']) }}"
                                style="width:22px;height:22px;object-fit:contain;">
                        </div>

                        <!-- INFO -->
                        <div class="flex-grow-1">
                            <p class="mb-2 fw-semibold text-white">
                                {{ $plan['name'] }}
                            </p>
                            <span class="text-secondary text-small">
                                {{ $plan['type'] }} · {{ $plan['duration'] }}
                            </span>
                        </div>

                        <!-- ACTION -->
                        <div class="text-end">

                            <span class="d-block text-white text-small">
                                {{ $plan['price'] }} USDT
                            </span>

                            <span
                                class="mt-2 d-inline-block"
                                style="
                            font-size:12px;
                            padding:3px 10px;
                            border-radius:999px;
                            font-weight:600;
                            color:#22c55e;
                            background:rgba(34,197,94,.15);
                        ">
                                {{ $plan['yield'] }}
                            </span>

                            <a href="{{ route('compute.show', $plan->id) }}"
                                style="
                                display:block;
                                width:100%;
                                text-align:center;
                                padding:8px 14px;
                                border-radius:12px;
                                font-size:13px;
                                font-weight:600;
                                color:#020617;
                                background:linear-gradient(135deg,#38bdf8,#0ea5e9);
                                box-shadow:0 0 14px rgba(56,189,248,.45);
                                text-decoration:none;
                               ">
                                Unlock Plan
                            </a>


                        </div>

                    </div>
                </li>
                @endforeach

            </ul>

        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.market-swiper', {
                slidesPerView: 2.8,
                spaceBetween: 16,
                freeMode: true,
                grabCursor: true,
                breakpoints: {
                    768: {
                        slidesPerView: 3
                    }
                }
            });
        });
    </script>


    @endsection