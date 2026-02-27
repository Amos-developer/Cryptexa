@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Deposit QR Code | Cryptexa')

@section('content')

<link rel="stylesheet" href="{{ asset('css/team.css') }}">

<!-- HEADER BAR -->
<div class="team-header">
    <a href="{{ url()->previous() }}" class="back-btn">
        <i class="icon-left-btn"></i>
    </a>
    <h6 class="header-title">{{ __t('deposit_address') }}</h6>
    <span class="placeholder"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); display: flex; align-items: center; justify-content: center; min-height: 100vh;">
    <div class="tf-container" style="max-width: 400px;">

        <!-- PAGE HEADER -->
        <div class="text-center mb-32" style="animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 28px; margin: 0 0 12px 0;">
                📱 {{ __t('scan_and_send') }}
            </h1>
            <p class="text-secondary" style="font-size: 14px; margin: 0;">
                {{ __t('scan_qr_wallet') }}
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
                    {{ __t('generating_address') }}
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
                💳 {{ __t('deposit_address') }}
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
                    {{ $deposit->pay_address ?? __t('generating_address') }}
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
                ✓ {{ __t('copy_address') }}
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
                ⏳ {{ __t('copy_address') }}
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
                    <span id="statusText">{{ __t('checking') }}</span>
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
            🔄 {{ __t('check_payment_status') }}
        </button>

        <!-- DEPOSIT RULES -->
        <div style="
            background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
            border: 1px solid rgba(56,189,248,0.15);
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 20px;
            animation: slideUp 0.6s ease 0.25s backwards;
        ">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 14px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 16v-4M12 8h.01"/>
                </svg>
                <h3 style="color: #38bdf8; font-size: 15px; font-weight: 700; margin: 0;">{{ __t('important_deposit_rules') }}</h3>
            </div>
            <div style="display: grid; gap: 10px;">
                <div style="display: flex; gap: 10px;">
                    <span style="color: #ef4444; font-size: 16px; flex-shrink: 0;">❌</span>
                    <p style="color: #94a3b8; font-size: 12px; margin: 0; line-height: 1.6;">
                        <strong style="color: #e5e7eb;">{{ __t('below_min_lost_funds') }}:</strong> {{ __t('deposits_under_rejected') }}
                    </p>
                </div>
                <div style="display: flex; gap: 10px;">
                    <span style="color: #22c55e; font-size: 16px; flex-shrink: 0;">✓</span>
                    <p style="color: #94a3b8; font-size: 12px; margin: 0; line-height: 1.6;">
                        <strong style="color: #e5e7eb;">{{ __t('minimum_deposit') }}:</strong> {{ __t('usd_equivalent') }}
                    </p>
                </div>
                <div style="display: flex; gap: 10px;">
                    <span style="color: #fbbf24; font-size: 16px; flex-shrink: 0;">⚠️</span>
                    <p style="color: #94a3b8; font-size: 12px; margin: 0; line-height: 1.6;">
                        <strong style="color: #e5e7eb;">{{ __t('exact_address') }}:</strong> {{ __t('send_only_address') }}
                    </p>
                </div>

                <div style="display: flex; gap: 10px;">
                    <span style="color: #a855f7; font-size: 16px; flex-shrink: 0;">⏱️</span>
                    <p style="color: #94a3b8; font-size: 12px; margin: 0; line-height: 1.6;">
                        <strong style="color: #e5e7eb;">{{ __t('processing_time') }}:</strong> {{ __t('few_minutes_confirmation') }}
                    </p>
                </div>
                <div style="display: flex; gap: 10px;">
                    <span style="color: #22c55e; font-size: 16px; flex-shrink: 0;">🤖</span>
                    <p style="color: #94a3b8; font-size: 12px; margin: 0; line-height: 1.6;">
                        <strong style="color: #e5e7eb;">{{ __t('auto_credit') }}:</strong> {{ __t('funds_auto_added') }}
                    </p>
                </div>
                <div style="display: flex; gap: 10px;">
                    <span style="color: #ef4444; font-size: 16px; flex-shrink: 0;">❌</span>
                    <p style="color: #94a3b8; font-size: 12px; margin: 0; line-height: 1.6;">
                        <strong style="color: #e5e7eb;">{{ __t('no_refunds') }}:</strong> {{ __t('double_check_address') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- INFO BOXES
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
        </div> -->

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
                        title: '{{ __t('deposit_address') }}',
                        text: '{{ __t('generating_address') }}',
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
                        title: '{{ __t('connection_error') }}',
                        text: '{{ __t('check_internet') }}',
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
            title: '{{ __t('copied') }}',
            text: '{{ __t('copy_address') }}',
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
        btn.innerHTML = '⏳ {{ __t('checking') }}';
        statusSection.style.display = 'block';
        statusIcon.innerHTML = '🔄';
        statusText.innerHTML = '{{ __t('checking') }}';

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
                    statusText.innerHTML = `{{ __t('payment_confirmed') }}! {{ __t('payment_received') }}`;

                    Swal.fire({
                        icon: 'success',
                        title: '{{ __t('payment_received') }}',
                        text: '{{ __t('balance_updated') }}',
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
                    statusText.innerHTML = '{{ __t('payment_detected') }}';
                    btn.disabled = false;
                    btn.innerHTML = '🔄 {{ __t('check_again') }}';

                    Swal.fire({
                        icon: 'info',
                        title: '{{ __t('payment_detected') }}',
                        text: '{{ __t('check_again') }}',
                        background: '#020617',
                        color: '#e5e7eb',
                        confirmButtonColor: '#38bdf8'
                    });
                } else {
                    // No payment yet
                    statusIcon.innerHTML = '⚠️';
                    statusText.innerHTML = '{{ __t('no_payment_detected') }}';
                    btn.disabled = false;
                    btn.innerHTML = '🔄 {{ __t('check_payment_status') }}';

                    Swal.fire({
                        icon: 'warning',
                        title: '{{ __t('no_payment_yet') }}',
                        text: '{{ __t('send_payment_first') }}',
                        background: '#020617',
                        color: '#e5e7eb',
                        confirmButtonColor: '#fbbf24'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                statusIcon.innerHTML = '❌';
                statusText.innerHTML = '{{ __t('connection_error') }}';
                btn.disabled = false;
                btn.innerHTML = '🔄 {{ __t('check_payment_status') }}';

                Swal.fire({
                    icon: 'error',
                    title: '{{ __t('connection_error') }}',
                    text: '{{ __t('check_internet') }}',
                    background: '#020617',
                    color: '#e5e7eb',
                    confirmButtonColor: '#ef4444'
                });
            });
    }
</script>

@endsection