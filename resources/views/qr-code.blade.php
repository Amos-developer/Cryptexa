@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Deposit QR Code')

@section('content')

{{-- HEADER --}}
<div class="header fixed-top d-flex justify-content-between align-items-center px-16"
    style="
        background: linear-gradient(180deg,#020617,#020617);
        border-bottom:1px solid rgba(56,189,248,0.2);
     ">
    <a href="{{ url()->previous() }}" class="left back-btn">
        <i class="icon-left-btn text-white"></i>
    </a>

    <h3 class="text-white">Deposit QR</h3>

    <a href="#" class="right">
        <i class="icon-question text-secondary"></i>
    </a>
</div>

{{-- CONTENT --}}
<div class="pt-45 pb-16">
    <div class="tf-container text-center">

        <h2 class="mt-20"
            style="
                color:#e5e7eb;
                font-weight:600;
                text-shadow:0 0 20px rgba(56,189,248,0.4);
            ">
            Scan to get Deposit Address
        </h2>

        {{-- QR CARD --}}
        <div class="mt-32 mx-auto"
            style="
                max-width:280px;
                background: linear-gradient(180deg,#020617,#0f172a);
                border-radius:20px;
                padding:24px;
                box-shadow:0 20px 40px rgba(56,189,248,0.25);
                border:1px solid rgba(56,189,248,0.25);
             ">

            <img src="{{ asset('images/banner/banner-qrcode.png') }}"
                alt="QR Code"
                style="
                    width:100%;
                    border-radius:12px;
                    background:#fff;
                    padding:10px;
                 ">

        </div>

        {{-- ADDRESS --}}
        <div class="mt-24"
            style="
                background: rgba(15,23,42,0.9);
                border-radius:12px;
                padding:12px;
                border:1px solid rgba(56,189,248,0.2);
             ">

            <small class="text-secondary">Deposit Address</small>

            <p id="walletAddress"
                style="
                    color:#e5e7eb;
                    font-size:13px;
                    word-break:break-all;
               ">
                0xA1B2C3D4E5F678901234567890ABCDEFFEDCBA
            </p>

            <button onclick="copyAddress()"
                class="btn btn-sm mt-8"
                style="
                        background:#38bdf8;
                        color:#020617;
                        font-weight:600;
                        border-radius:8px;
                    ">
                Copy Address
            </button>
        </div>

        {{-- INFO --}}
        <p class="mt-16 text-secondary text-small">
            Send only <strong class="text-white">USDT (BEP20)</strong> to this address.<br>
            Sending other assets may result in permanent loss.
        </p>

    </div>
</div>

{{-- SCRIPT --}}
<script>
    function copyAddress() {
        const text = document.getElementById('walletAddress').innerText;
        navigator.clipboard.writeText(text);

        alert('Deposit address copied!');
    }
</script>

@endsection 


