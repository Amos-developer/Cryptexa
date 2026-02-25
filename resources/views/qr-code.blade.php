@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Deposit QR Code | Cryptexa')

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
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Deposit Address</h6>
    <span style="width: 36px;"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); display: flex; align-items: center; justify-content: center; min-height: 100vh;">
    <div class="tf-container" style="max-width: 400px;">

        <!-- PAGE HEADER -->
        <div class="text-center mb-32" style="animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 28px; margin: 0 0 12px 0;">
                📱 Scan & Send
            </h1>
            <p class="text-secondary" style="font-size: 14px; margin: 0;">
                Scan the QR code with your wallet to send funds
            </p>
        </div>

        <!-- QR CODE CARD -->
        <div style="
            background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
            border: 1px solid rgba(56,189,248,0.15);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 10px 40px rgba(56,189,248,0.1), inset 0 0 20px rgba(56,189,248,0.03);
            backdrop-filter: blur(10px);
            margin-bottom: 24px;
            text-align: center;
            animation: slideUp 0.6s ease 0.1s backwards;
        ">
            @if(!empty($deposit->pay_address))
            <div style="
                background: #fff;
                padding: 16px;
                border-radius: 14px;
                display: inline-block;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            ">
                <img
                    src="https://api.qrserver.com/v1/create-qr-code/?size=260x260&format=svg&data={{ urlencode(trim($deposit->pay_address)) }}"
                    alt="QR Code"
                    style="width: 260px; height: 260px; border-radius: 8px;"
                    loading="lazy"
                    referrerpolicy="no-referrer">
            </div>
            @else
            <div style="
                width: 260px;
                height: 260px;
                background: rgba(255,255,255,0.02);
                border: 1px solid rgba(56,189,248,0.2);
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto;
            ">
                <div style="color: #94a3b8; font-size: 14px; text-align: center;">
                    <div style="font-size: 24px; margin-bottom: 8px;">⏳</div>
                    Generating address…
                </div>
            </div>
            @endif
        </div>

        <!-- ADDRESS SECTION -->
        <div style="
            background: linear-gradient(135deg, rgba(34,197,94,0.08) 0%, rgba(34,197,94,0.02) 100%);
            border: 1px solid rgba(34,197,94,0.15);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(34,197,94,0.05), inset 0 0 20px rgba(34,197,94,0.03);
            backdrop-filter: blur(10px);
            margin-bottom: 20px;
            animation: slideUp 0.6s ease 0.2s backwards;
        ">
            <label style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 10px;">
                💳 Deposit Address
            </label>

            <div style="
                background: rgba(255,255,255,0.02);
                padding: 12px;
                border-radius: 10px;
                border: 1px solid rgba(34,197,94,0.2);
                margin-bottom: 12px;
            ">
                <p id="walletAddress"
                    style="
                        color: #e5e7eb;
                        font-size: 12px;
                        word-break: break-all;
                        margin: 0;
                        font-family: 'Courier New', monospace;
                        line-height: 1.6;
                    ">
                    {{ $deposit->pay_address ?? 'Waiting for deposit address…' }}
                </p>
            </div>

            @if($deposit->pay_address)
            <button type="button"
                onclick="copyAddress()"
                style="
                    width: 100%;
                    padding: 12px;
                    border-radius: 10px;
                    background: linear-gradient(135deg, rgba(34,197,94,0.15) 0%, rgba(34,197,94,0.05) 100%);
                    border: 1px solid rgba(34,197,94,0.3);
                    color: #22c55e;
                    font-weight: 600;
                    font-size: 13px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                "
                onmouseover="this.style.background='linear-gradient(135deg, rgba(34,197,94,0.2) 0%, rgba(34,197,94,0.1) 100%)'; this.style.boxShadow='0 0 20px rgba(34,197,94,0.2)';"
                onmouseout="this.style.background='linear-gradient(135deg, rgba(34,197,94,0.15) 0%, rgba(34,197,94,0.05) 100%)'; this.style.boxShadow='none';">
                ✓ Copy Address
            </button>
            @else
            <button type="button"
                style="
                    width: 100%;
                    padding: 12px;
                    border-radius: 10px;
                    background: rgba(148,163,184,0.1);
                    border: 1px solid rgba(148,163,184,0.2);
                    color: #94a3b8;
                    font-weight: 600;
                    font-size: 13px;
                    cursor: not-allowed;
                "
                disabled>
                ⏳ Copy Address
            </button>
            @endif
        </div>

        <!-- PAYMENT STATUS INDICATOR -->
        <div id="statusSection" style="display: none;">
            <div style="
                background: linear-gradient(135deg, rgba(34,197,94,0.08) 0%, rgba(34,197,94,0.02) 100%);
                border: 1px solid rgba(34,197,94,0.15);
                border-radius: 16px;
                padding: 16px;
                margin-bottom: 20px;
                animation: slideUp 0.6s ease backwards;
            ">
                <p style="color: #22c55e; font-size: 13px; font-weight: 600; margin: 0 0 8px 0; display: flex; align-items: center;">
                    <span id="statusIcon" style="margin-right: 8px; font-size: 16px;">⏳</span>
                    <span id="statusText">Checking payment status...</span>
                </p>
            </div>
        </div>

        <!-- MANUAL CHECK BUTTON -->
        <button id="checkPaymentBtn" onclick="checkPaymentStatus()" style="
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            background: linear-gradient(135deg, #38bdf8, #0ea5e9);
            border: none;
            color: white;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(56,189,248,0.3);
        "
        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(56,189,248,0.4)';"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(56,189,248,0.3)';">
            🔄 Check Payment Status
        </button>

        <!-- INFO BOXES -->
        <div style="
            background: linear-gradient(135deg, rgba(251,191,36,0.08) 0%, rgba(251,191,36,0.02) 100%);
            border: 1px solid rgba(251,191,36,0.15);
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 10px 30px rgba(251,191,36,0.05), inset 0 0 20px rgba(251,191,36,0.03);
            backdrop-filter: blur(10px);
            animation: slideUp 0.6s ease 0.3s backwards;
        ">
            @if(!empty($deposit->pay_amount))
            <p style="color: #fbbf24; font-size: 12px; font-weight: 600; margin: 0 0 8px 0;">
                ⚠️ Amount Required
            </p>
            <p style="color: #94a3b8; font-size: 12px; margin: 0;">
                Send exactly <span style="color: #e5e7eb; font-weight: 600;">{{ strtoupper($deposit->pay_currency ?? $deposit->currency) }}</span> to this address
            </p>
            @endif

            <p style="color: #94a3b8; font-size: 12px; margin: {{ !empty($deposit->pay_amount) ? '8px 0 0 0' : '0' }};">
                ✓ Funds automatically credited after network confirmation
            </p>
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

    @keyframes loading {
        0% {
            width: 30%;
            background-position: 0 0;
        }

        50% {
            width: 80%;
        }

        100% {
            width: 30%;
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

        .mb-32 h1 {
            font-size: 24px !important;
        }

        [style*="width: 260px"] {
            width: 200px !important;
            height: 200px !important;
        }

        [style*="padding: 24px"] {
            padding: 16px !important;
        }

        [style*="padding: 20px"] {
            padding: 14px !important;
        }

        .mb-24 {
            margin-bottom: 18px !important;
        }

        .mb-20 {
            margin-bottom: 16px !important;
        }
    }

    /* TABLET RESPONSIVE */
    @media (min-width: 769px) and (max-width: 1024px) {
        .mb-32 h1 {
            font-size: 26px !important;
        }
    }
</style>

<!-- SCRIPTS -->
@if(empty($deposit->pay_address))
<script>
    let retryCount = 0;
    const maxRetries = 30; // 5 minutes with 10-second intervals

    // 🔄 Auto-refresh address via AJAX
    function refreshPaymentAddress() {
        if (document.getElementById('walletAddress').innerText.includes('Waiting') === false) {
            return; // Address already loaded, stop refreshing
        }

        fetch('{{ route("deposit.refresh-address", $deposit->id) }}')
            .then(response => response.json())
            .then(data => {
                if (data.pay_address) {
                    // Address received, update UI
                    document.getElementById('walletAddress').innerText = data.pay_address;

                    // Update QR code
                    const qrContainer = document.querySelector('[style*="background: #fff"]');
                    if (qrContainer) {
                        const img = qrContainer.querySelector('img');
                        if (img) {
                            img.src = 'https://api.qrserver.com/v1/create-qr-code/?size=260x260&format=svg&data=' + encodeURIComponent(data.pay_address);
                        }
                    }

                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Address Ready',
                        text: 'Your deposit address has been generated',
                        timer: 2000,
                        showConfirmButton: false,
                        background: '#020617',
                        color: '#e5e7eb'
                    });
                } else if (retryCount < maxRetries) {
                    // Keep retrying
                    retryCount++;
                    setTimeout(refreshPaymentAddress, 10000); // Retry every 10 seconds
                } else {
                    // Max retries reached
                    Swal.fire({
                        icon: 'error',
                        title: 'Address Generation Timeout',
                        text: 'Please reload the page to try again',
                        background: '#020617',
                        color: '#e5e7eb',
                        confirmButtonColor: '#ef4444'
                    });
                }
            })
            .catch(error => {
                console.error('Error refreshing address:', error);
                if (retryCount < maxRetries) {
                    retryCount++;
                    setTimeout(refreshPaymentAddress, 10000);
                }
            });
    }

    // Wait 30s before first check to give provider time to allocate address, then every 10s
    setTimeout(refreshPaymentAddress, 30000);
</script>
@endif

<script>
    function copyAddress() {
        const text = document.getElementById('walletAddress').innerText;
        if (!text || text.includes('Waiting')) return;

        navigator.clipboard.writeText(text);

        Swal.fire({
            icon: 'success',
            title: 'Copied',
            text: 'Deposit address copied to clipboard',
            timer: 1500,
            showConfirmButton: false,
            background: '#020617',
            color: '#e5e7eb'
        });
    }
</script>

<!-- PAYMENT STATUS CHECK -->
<script>
    function checkPaymentStatus() {
        const btn = document.getElementById('checkPaymentBtn');
        const statusSection = document.getElementById('statusSection');
        const statusIcon = document.getElementById('statusIcon');
        const statusText = document.getElementById('statusText');

        // Disable button and show loading
        btn.disabled = true;
        btn.innerHTML = '⏳ Checking...';
        statusSection.style.display = 'block';
        statusIcon.innerHTML = '🔄';
        statusText.innerHTML = 'Checking payment status...';

        fetch('{{ route("deposit.check-status", $deposit->id) }}', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const status = data.provider_status || data.status || '';

                if (status === 'finished' || status === 'completed' || data.status === 'completed') {
                    // Payment confirmed
                    statusIcon.innerHTML = '✅';
                    statusText.innerHTML = `Payment Confirmed! Received ${data.received || data.amount}`;

                    Swal.fire({
                        icon: 'success',
                        title: 'Payment Received!',
                        text: 'Your balance has been updated',
                        timer: 2000,
                        showConfirmButton: false,
                        background: '#020617',
                        color: '#e5e7eb'
                    }).then(() => {
                        window.location.href = '{{ route("home") }}';
                    });
                } else if (status === 'confirming') {
                    // Payment detected, confirming
                    statusIcon.innerHTML = '⏳';
                    statusText.innerHTML = 'Payment detected! Waiting for blockchain confirmation...';
                    btn.disabled = false;
                    btn.innerHTML = '🔄 Check Again';

                    Swal.fire({
                        icon: 'info',
                        title: 'Payment Detected',
                        text: 'Waiting for blockchain confirmation. Check again in a few minutes.',
                        background: '#020617',
                        color: '#e5e7eb',
                        confirmButtonColor: '#38bdf8'
                    });
                } else {
                    // No payment yet
                    statusIcon.innerHTML = '⚠️';
                    statusText.innerHTML = 'No payment detected yet. Please send payment to the address above.';
                    btn.disabled = false;
                    btn.innerHTML = '🔄 Check Payment Status';

                    Swal.fire({
                        icon: 'warning',
                        title: 'No Payment Yet',
                        text: 'Please send payment to the address above, then check again.',
                        background: '#020617',
                        color: '#e5e7eb',
                        confirmButtonColor: '#fbbf24'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                statusIcon.innerHTML = '❌';
                statusText.innerHTML = 'Error checking status. Please try again.';
                btn.disabled = false;
                btn.innerHTML = '🔄 Check Payment Status';

                Swal.fire({
                    icon: 'error',
                    title: 'Connection Error',
                    text: 'Please check your internet connection and try again.',
                    background: '#020617',
                    color: '#e5e7eb',
                    confirmButtonColor: '#ef4444'
                });
            });
    }
</script>

@endsection