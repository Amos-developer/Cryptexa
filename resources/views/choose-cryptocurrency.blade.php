@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Choose cryptocurrency')

@section('content')

<!-- {{-- HEADER --}}
<div class="header fixed-top bg-surface d-flex justify-content-center align-items-center border-bottom">
    <a href="{{ url()->previous() }}" class="left back-btn">
        <i class="icon-left-btn"></i>
    </a>
    <h3>Choose cryptocurrency</h3>
</div> -->

{{-- PAGE CONTENT --}}
<div class="pb-16 pt-40">
    <div class="tf-container">

        <h5 class="mt-12 mb-8">Available  Methods</h5>

        @php
        $coins = [
        [
        'name' => 'USDT',
        'symbol' => 'BEP20 (BSC)',
        'badge' => 'Recommended',
        'badge_color' => '#16a34a',
        'img' => 'usdt.png'
        ],
        [
        'name' => 'USDC',
        'symbol' => 'BEP20 (BSC)',
        'badge' => 'Fast',
        'badge_color' => '#2563eb',
        'img' => 'usdc.png'
        ],
        [
        'name' => 'USDT',
        'symbol' => 'TRC20',
        'badge' => 'Alternative',
        'badge_color' => '#ca8a04',
        'img' => 'usdt.png'
        ],
        [
        'name' => 'BNB',
        'symbol' => 'BSC',
        'badge' => 'Alternative',
        'badge_color' => '#ca8a04',
        'img' => 'bnb.svg'
        ],
        ];
        @endphp

        <ul class="mt-16">

            @foreach ($coins as $coin)
            <li class="{{ !$loop->first ? 'mt-12' : '' }}">
                <a href="{{ route('qr.code') }}"
                    class="coin-item style-2 d-flex align-items-center gap-12"
                    style="
                        padding:14px;
                        border-radius:14px;
                        background:linear-gradient(135deg,#0f172a,#020617);
                        box-shadow:0 6px 20px rgba(0,0,0,.35);
                   ">

                    {{-- ICON --}}
                    <div style="
                        width:52px;
                        height:52px;
                        border-radius:50%;
                        background:#020617;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        border:1px solid rgba(255,255,255,.08);
                    ">
                        <img src="{{ asset('images/coin/'.$coin['img']) }}"
                            alt="{{ $coin['name'] }}"
                            style="width:28px;height:28px;object-fit:contain;">
                    </div>

                    {{-- CONTENT --}}
                    <div class="content d-flex justify-content-between align-items-center w-100">

                        <div>
                            <p class="mb-2 fw-semibold text-white">
                                {{ $coin['name'] }}
                            </p>
                            <span class="text-secondary text-small">
                                {{ $coin['symbol'] }}
                            </span>
                        </div>

                        {{-- BADGE --}}
                        <span style="
                            padding:4px 10px;
                            font-size:11px;
                            border-radius:999px;
                            background:{{ $coin['badge_color'] }};
                            color:#fff;
                            font-weight:500;
                        ">
                            {{ $coin['badge'] }}
                        </span>
                    </div>
                </a>
            </li>
            @endforeach

        </ul>

        {{-- DEPOSIT INSTRUCTIONS --}}
        <div class="mt-24 p-16"
            style="
                border-radius:16px;
                background:linear-gradient(135deg,#020617,#0f172a);
                border:1px solid rgba(255,255,255,.08);
             ">

            <h5 class="mb-12">How to deposit</h5>

            <ol class="text-secondary text-small" style="padding-left:18px;">
                <li class="mb-8">
                    Select your preferred network above.
                </li>
                <li class="mb-8">
                    Copy the generated deposit address or scan the QR code.
                </li>
                <li class="mb-8">
                    Send funds from your wallet using the selected network.
                </li>
                <li>
                    Funds will be credited after network confirmation.
                </li>
            </ol>

            </div>

        </div>

    </div>
</div>

@endsection