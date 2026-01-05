@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Deposit QR Code')

@section('content')

{{-- HEADER --}}
<div class="header fixed-top d-flex justify-content-between align-items-center px-16"
    style="background:#020617;border-bottom:1px solid rgba(56,189,248,0.2);">
    <a href="{{ url()->previous() }}" class="left back-btn">
        <i class="icon-left-btn text-white"></i>
    </a>

    <h3 class="text-white">Deposit</h3>
    <span></span>
</div>

{{-- CONTENT --}}
<div class="pt-45 pb-16">
    <div class="tf-container text-center">

        <h2 class="mt-20"
            style="color:#e5e7eb;font-weight:600;text-shadow:0 0 20px rgba(56,189,248,0.4);">
            Send Crypto to This Address
        </h2>

        {{-- QR CARD --}}
        <div class="mt-32 mx-auto"
            style="
                max-width:280px;
                background:linear-gradient(180deg,#020617,#0f172a);
                border-radius:20px;
                padding:24px;
                box-shadow:0 20px 40px rgba(56,189,248,0.25);
                border:1px solid rgba(56,189,248,0.25);
             ">

            @if(!empty($deposit->pay_address))
            <img
                src="https://api.qrserver.com/v1/create-qr-code/?size=260x260&data={{ urlencode($deposit->pay_address) }}"
                alt="QR Code"
                style="width:100%;border-radius:12px;background:#fff;padding:10px;">
            @else
            <div style="padding:60px 0;color:#94a3b8;font-size:14px;">
                Generating deposit address…
            </div>
            @endif

        </div>

        {{-- ADDRESS --}}
        <div class="mt-24"
            style="
                background:rgba(15,23,42,0.9);
                border-radius:12px;
                padding:12px;
                border:1px solid rgba(56,189,248,0.2);
             ">

            <small class="text-secondary">Deposit Address</small>

            <p id="walletAddress"
                style="color:#e5e7eb;font-size:13px;word-break:break-all;">
                {{ $deposit->pay_address ?? 'Waiting for deposit address…' }}
            </p>

            <button
                onclick="copyAddress()"
                class="btn btn-sm mt-8"
                style="
                    background:{{ $deposit->pay_address ? '#38bdf8' : '#64748b' }};
                    color:#020617;
                    font-weight:600;
                    border-radius:8px;
                "
                {{ empty($deposit->pay_address) ? 'disabled' : '' }}>
                Copy Address
            </button>

        </div>

        {{-- AMOUNT (optional) --}}
        @if(!empty($deposit->pay_amount))
        <p class="mt-16 text-secondary text-small">
            Send exactly
            <strong class="text-white">
                {{ $deposit->pay_amount }}
                {{ strtoupper($deposit->pay_currency ?? $deposit->currency) }}
            </strong>
        </p>
        @endif

        {{-- INFO --}}
        <p class="mt-8 text-secondary text-small">
            Funds will be credited automatically after network confirmation.
        </p>

    </div>
</div>

{{-- SCRIPTS --}}
<script>
    function copyAddress() {
        const text = document.getElementById('walletAddress').innerText;
        if (!text || text.includes('Waiting')) return;

        navigator.clipboard.writeText(text);
        alert('Deposit address copied!');
    }

    // 🔄 Auto-refresh ONLY while address is missing
    @if(empty($deposit->pay_address))
    setTimeout(() => {
        location.reload();
    }, 4000);
    @endif
</script>

@endsection