@extends('layouts.app')

@section('title', 'Account')

@section('content')
<div class="tf-container mt-20">

    <!-- ACCOUNT LIST -->
    <div style="
        margin-top: 80px;
        background:linear-gradient(135deg,#020617,#0f172a);
        border-radius:20px;
        overflow:hidden;
        box-shadow:0 20px 40px rgba(0,0,0,.6);
        border: 2px solid rgba(0,0,0,.6);
    ">

        @php
        $items = [
        [
        'icon' => 'icon-wallet',
        'color' => '#8b5cf6',
        'title' => 'Account Mode',
        'desc' => 'Tap to switch Demo / Live',
        'badge' => 'LIVE',
        'link' => '#'
        ],
        [
        'icon' => 'icon-shield',
        'color' => '#facc15',
        'title' => 'KYC Verification',
        'desc' => 'ID Verification',
        'link' => '#'
        ],
        [
        'icon' => 'icon-lock',
        'color' => '#22d3ee',
        'title' => 'Two-Factor Authentication',
        'desc' => 'Extra security protection',
        'link' => '#'
        ],
        [
        'icon' => 'icon-card',
        'color' => '#22c55e',
        'title' => 'Withdrawal Method',
        'desc' => 'Bank or wallet address',
        'link' => '#'
        ],
        [
        'icon' => 'icon-key',
        'color' => '#f59e0b',
        'title' => 'Withdrawal Password',
        'desc' => 'Update withdrawal password',
        'link' => '#'
        ],
        [
        'icon' => 'icon-lock',
        'color' => '#ec4899',
        'title' => 'Account Password',
        'desc' => 'Change login password',
        'link' => route('account.password')
        ],
        [
        'icon' => 'icon-time',
        'color' => '#38bdf8',
        'title' => 'System Time',
        'desc' => now()->timezone(config('app.timezone'))->format('Y-m-d H:i:s'),
        'link' => '#'
        ],
        [
        'icon' => 'icon-download',
        'color' => '#34d399',
        'title' => 'Download App',
        'desc' => 'Android & iOS',
        'link' => '#'
        ],
        [
        'icon' => 'icon-info',
        'color' => '#94a3b8',
        'title' => 'About Us',
        'desc' => 'Company information',
        'link' => route('about')
        ],
        ];
        
        @endphp

        @foreach($items as $item)
        <a href="{{ $item['link'] }}"
            style="
                display:flex;
                align-items:center;
                justify-content:space-between;
                padding:14px 16px;
                border-bottom:1px solid rgba(255,255,255,.05);
                text-decoration:none;
           ">

            <!-- LEFT -->
            <div class="d-flex align-items-center gap-12">
                <span style="
                    width:42px;
                    height:42px;
                    border-radius:12px;
                    background:{{ $item['color'] }}22;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                ">
                    <i class="icon {{ $item['icon'] }}" style="color:{{ $item['color'] }}"></i>
                </span>

                <div>
                    <div class="text-white text-small fw-semibold">
                        {{ $item['title'] }}
                    </div>
                    <div class="text-secondary text-xs">
                        {{ $item['desc'] }}
                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="d-flex align-items-center gap-8">
                @if(isset($item['badge']))
                <span style="
                        font-size:10px;
                        padding:2px 8px;
                        border-radius:999px;
                        background:#22c55e22;
                        color:#22c55e;
                        font-weight:600;
                    ">
                    {{ $item['badge'] }}
                </span>
                @endif
                <i class="icon icon-right-arrow text-secondary"></i>
            </div>

        </a>
        @endforeach

    </div>
</div>
@endsection