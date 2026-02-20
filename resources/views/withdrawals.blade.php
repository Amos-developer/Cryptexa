@extends('layouts.app')

@section('title', 'Withdraw Funds | Cryptexa')

@section('hide-header')@endsection

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
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Withdraw Funds</h6>
    <span style="width: 36px;"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%);">
    <div class="tf-container">

        <!-- PAGE HEADER -->
        <div class="mb-32" style="animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 32px; margin: 0 0 12px 0;">Withdraw Your Funds</h1>
            <p class="text-secondary" style="font-size: 14px; margin: 0;">Secure withdrawal with multiple network options</p>
        </div>

        <!-- ALERTS WITH SWEET ALERT -->
        @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const errors = @json($errors - > all());
                Swal.fire({
                    title: 'Error!',
                    html: errors.join('<br>'),
                    icon: 'error',
                    confirmButtonColor: '#ef4444',
                    background: '#020617',
                    color: '#e5e7eb',
                    customClass: {
                        popup: 'swal-dark-popup'
                    }
                });
            });
        </script>
        @endif

        @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session("success") }}',
                    icon: 'success',
                    confirmButtonColor: '#22c55e',
                    background: '#020617',
                    color: '#e5e7eb',
                    customClass: {
                        popup: 'swal-dark-popup'
                    }
                });
            });
        </script>
        @endif

        <form method="POST" action="{{ route('withdraw.submit') }}">
            @csrf

            <!-- NETWORK SELECT -->
            <div class="mb-28" style="animation: slideUp 0.6s ease 0.1s backwards;">
                <h5 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0 0 12px 0;">
                    🌐 Select Withdrawal Network
                </h5>
                <p class="text-secondary" style="font-size: 12px; margin: 0 0 14px 0;">Choose your preferred blockchain network</p>

                <div style="display: grid; gap: 10px;">

                    <!-- BEP20 -->
                    <div class="network-option" data-network="BEP20">
                        <input type="radio" name="network" value="BEP20" hidden required>
                        <div style="
                            background: linear-gradient(135deg, rgba(34,197,94,0.08) 0%, rgba(34,197,94,0.02) 100%);
                            border: 1.5px solid rgba(34,197,94,0.15);
                            border-radius: 12px;
                            padding: 14px;
                            cursor: pointer;
                            transition: all 0.3s ease;
                        "
                            onmouseover="this.style.borderColor='rgba(34,197,94,0.3)'; this.style.boxShadow='0 0 15px rgba(34,197,94,0.15)';"
                            onmouseout="this.style.borderColor='rgba(34,197,94,0.15)'; this.style.boxShadow='none';">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <div style="display: inline-block; background: rgba(34,197,94,0.2); color: #22c55e; padding: 4px 10px; border-radius: 999px; font-size: 10px; font-weight: 700; margin-bottom: 8px;">✓ RECOMMENDED</div>
                                    <p style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 4px 0;">USDT BEP20</p>
                                    <p style="color: #94a3b8; font-size: 12px; margin: 0;">Binance Smart Chain - Lowest Fees</p>
                                </div>
                                <span style="background: rgba(34,197,94,0.15); color: #22c55e; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700;">~$1</span>
                            </div>
                        </div>
                    </div>

                    <!-- TRC20 -->
                    <div class="network-option" data-network="TRC20">
                        <input type="radio" name="network" value="TRC20" hidden>
                        <div style="
                            background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
                            border: 1.5px solid rgba(56,189,248,0.15);
                            border-radius: 12px;
                            padding: 14px;
                            cursor: pointer;
                            transition: all 0.3s ease;
                        "
                            onmouseover="this.style.borderColor='rgba(56,189,248,0.3)'; this.style.boxShadow='0 0 15px rgba(56,189,248,0.15)';"
                            onmouseout="this.style.borderColor='rgba(56,189,248,0.15)'; this.style.boxShadow='none';">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <p style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 4px 0;">USDT TRC20</p>
                                    <p style="color: #94a3b8; font-size: 12px; margin: 0;">Tron Network - High Security</p>
                                </div>
                                <span style="background: rgba(56,189,248,0.15); color: #38bdf8; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700;">~$2</span>
                            </div>
                        </div>
                    </div>

                    <!-- ERC20 -->
                    <div class="network-option" data-network="ERC20">
                        <input type="radio" name="network" value="ERC20" hidden>
                        <div style="
                            background: linear-gradient(135deg, rgba(251,191,36,0.08) 0%, rgba(251,191,36,0.02) 100%);
                            border: 1.5px solid rgba(251,191,36,0.15);
                            border-radius: 12px;
                            padding: 14px;
                            cursor: pointer;
                            transition: all 0.3s ease;
                        "
                            onmouseover="this.style.borderColor='rgba(251,191,36,0.3)'; this.style.boxShadow='0 0 15px rgba(251,191,36,0.15)';"
                            onmouseout="this.style.borderColor='rgba(251,191,36,0.15)'; this.style.boxShadow='none';">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <p style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 4px 0;">USDT ERC20</p>
                                    <p style="color: #94a3b8; font-size: 12px; margin: 0;">Ethereum Network - Higher Fees</p>
                                </div>
                                <span style="background: rgba(251,191,36,0.15); color: #fbbf24; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700;">~$10</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- WITHDRAWAL AMOUNT -->
            <div class="mb-24" style="animation: slideUp 0.6s ease 0.15s backwards;">
                <h5 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0 0 10px 0;">💰 Withdrawal Amount</h5>
                <div style="
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
                    border: 1px solid rgba(56,189,248,0.15);
                    border-radius: 12px;
                    padding: 14px;
                    transition: all 0.3s ease;
                "
                    onmouseover="this.style.borderColor='rgba(56,189,248,0.3)'"
                    onmouseout="this.style.borderColor='rgba(56,189,248,0.15)'">
                    <span style="color: #94a3b8; font-weight: 700; font-size: 16px;">$</span>
                    <input type="number"
                        step="0.01"
                        min="30"
                        name="amount"
                        placeholder="100.00"
                        class="amount-input"
                        data-max-balance="{{ auth()->user()->balance }}"
                        style="
                        background: transparent;
                        border: none;
                        color: #e5e7eb;
                        font-size: 16px;
                        flex: 1;
                        outline: none;
                        font-weight: 600;
                    " required>
                </div>

                <div style="display: flex; justify-content: space-between; margin-top: 10px; font-size: 12px;">
                    <span class="text-secondary">Minimum: <span style="color: #38bdf8; font-weight: 700;">$30</span></span>
                    <span class="text-secondary">Available: <span style="color: #22c55e; font-weight: 700;">{{ number_format(auth()->user()->balance, 2) }} USDT</span></span>
                </div>
            </div>

            <!-- WALLET ADDRESS -->
            <div class="mb-24" style="animation: slideUp 0.6s ease 0.2s backwards;">
                <h5 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0 0 10px 0;">📮 Wallet Address</h5>
                <input type="text"
                    id="addressInput"
                    name="address"
                    placeholder="Paste your wallet address here..."
                    style="
                    width: 100%;
                    background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
                    border: 1px solid rgba(56,189,248,0.15);
                    border-radius: 12px;
                    color: #e5e7eb;
                    font-size: 14px;
                    padding: 14px;
                    transition: all 0.3s ease;
                    box-sizing: border-box;
                "
                    onfocus="this.style.borderColor='rgba(56,189,248,0.3)'"
                    onblur="this.style.borderColor='rgba(56,189,248,0.15)'"
                    required>
                <p class="text-secondary" style="font-size: 12px; margin: 8px 0 0 0;">✓ Double-check the address to avoid losing funds</p>
            </div>

            <!-- SECURITY SECTION -->
            <div class="mb-24" style="
                background: linear-gradient(135deg, rgba(168,85,247,0.08) 0%, rgba(168,85,247,0.02) 100%);
                border: 1px solid rgba(168,85,247,0.15);
                border-radius: 12px;
                padding: 20px;
                animation: slideUp 0.6s ease 0.25s backwards;
            ">
                <h5 style="color: #a855f7; font-weight: 700; font-size: 15px; margin: 0 0 16px 0;">🔒 Security Verification</h5>

                <!-- PIN INPUT -->
                <div class="mb-16">
                    <label class="text-secondary" style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;">Withdrawal PIN</label>
                    <input type="password"
                        maxlength="4"
                        name="pin"
                        placeholder="••••"
                        style="
                        width: 100%;
                        background: rgba(255,255,255,0.02);
                        border: 1px solid rgba(168,85,247,0.2);
                        border-radius: 10px;
                        color: #e5e7eb;
                        font-size: 18px;
                        letter-spacing: 6px;
                        text-align: center;
                        padding: 12px;
                        transition: all 0.3s ease;
                        box-sizing: border-box;
                    "
                        onfocus="this.style.borderColor='rgba(168,85,247,0.4)'"
                        onblur="this.style.borderColor='rgba(168,85,247,0.2)'"
                        required>
                </div>

                <!-- EMAIL CODE -->
                <div>
                    <label class="text-secondary" style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;">Email Verification Code</label>
                    <div style="display: flex; gap: 10px;">
                        <input type="text"
                            maxlength="6"
                            name="email_code"
                            placeholder="000000"
                            style="
                            flex: 1;
                            background: rgba(255,255,255,0.02);
                            border: 1px solid rgba(168,85,247,0.2);
                            border-radius: 10px;
                            color: #e5e7eb;
                            font-size: 16px;
                            letter-spacing: 4px;
                            text-align: center;
                            padding: 12px;
                            transition: all 0.3s ease;
                            box-sizing: border-box;
                        "
                            onfocus="this.style.borderColor='rgba(168,85,247,0.4)'"
                            onblur="this.style.borderColor='rgba(168,85,247,0.2)'"
                            required>

                        <button type="button"
                            onclick="sendWithdrawCode()"
                            style="
                            background: linear-gradient(135deg, rgba(168,85,247,0.15) 0%, rgba(168,85,247,0.05) 100%);
                            border: 1px solid rgba(168,85,247,0.3);
                            color: #a855f7;
                            font-weight: 700;
                            border-radius: 10px;
                            padding: 12px 14px;
                            white-space: nowrap;
                            transition: all 0.3s ease;
                            font-size: 12px;
                            cursor: pointer;
                        "
                            onmouseover="this.style.background='linear-gradient(135deg, rgba(168,85,247,0.2) 0%, rgba(168,85,247,0.1) 100%)'; this.style.boxShadow='0 0 15px rgba(168,85,247,0.2)';"
                            onmouseout="this.style.background='linear-gradient(135deg, rgba(168,85,247,0.15) 0%, rgba(168,85,247,0.05) 100%)'; this.style.boxShadow='none';">
                            📤 Send
                        </button>
                    </div>
                </div>
            </div>

            <!-- SUBMIT BUTTON -->
            <button type="submit"
                style="
                width: 100%;
                padding: 16px;
                border-radius: 12px;
                background: linear-gradient(135deg, rgba(34,197,94,0.2) 0%, rgba(34,197,94,0.1) 100%);
                border: 1px solid rgba(34,197,94,0.3);
                color: #22c55e;
                font-weight: 700;
                font-size: 15px;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 0 30px rgba(34,197,94,0.0);
                animation: slideUp 0.6s ease 0.3s backwards;
            "
                onmouseover="this.style.background='linear-gradient(135deg, rgba(34,197,94,0.3) 0%, rgba(34,197,94,0.15) 100%)'; this.style.boxShadow='0 0 30px rgba(34,197,94,0.3)'; this.style.transform='translateY(-2px)';"
                onmouseout="this.style.background='linear-gradient(135deg, rgba(34,197,94,0.2) 0%, rgba(34,197,94,0.1) 100%)'; this.style.boxShadow='0 0 30px rgba(34,197,94,0.0)'; this.style.transform='translateY(0)';">
                💸 Confirm Withdrawal
            </button>

            <!-- INFO BOX -->
            <div style="
                background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
                border: 1px solid rgba(56,189,248,0.15);
                border-radius: 12px;
                padding: 16px;
                margin-top: 20px;
                animation: slideUp 0.6s ease 0.35s backwards;
            ">
                <p class="text-secondary" style="font-size: 12px; margin: 0; line-height: 1.6;">
                    <span style="color: #38bdf8; font-weight: 700;">⏱️ Processing Time:</span><br>
                    Withdrawals typically process within 5-12 hours. Network confirmation may take additional time depending on blockchain congestion.
                </p>
            </div>

        </form>
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

    .swal-dark-popup {
        background: linear-gradient(135deg, #0f172a 0%, #020617 100%) !important;
        border: 1px solid rgba(56, 189, 248, 0.2) !important;
    }

    .network-option.active div {
        border-color: #22c55e !important;
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.12) 0%, rgba(34, 197, 94, 0.05) 100%) !important;
        box-shadow: 0 0 20px rgba(34, 197, 94, 0.2) !important;
    }

    .amount-input::placeholder {
        color: #64748b;
    }

    /* MOBILE RESPONSIVE */
    @media (max-width: 768px) {
        .pt-80 {
            padding-top: 80px !important;
        }

        .pb-80 {
            padding-bottom: 60px !important;
        }

        h1 {
            font-size: 24px !important;
        }

        h5 {
            font-size: 14px !important;
        }

        [style*="padding: 20px"] {
            padding: 16px !important;
        }

        [style*="padding: 14px"] {
            padding: 12px !important;
        }

        [style*="gap: 10px"] {
            gap: 8px !important;
        }

        .mb-28 {
            margin-bottom: 20px !important;
        }

        .mb-24 {
            margin-bottom: 18px !important;
        }

        p {
            font-size: 12px !important;
        }
    }

    /* TABLET RESPONSIVE */
    @media (min-width: 769px) and (max-width: 1024px) {
        h1 {
            font-size: 28px !important;
        }

        h5 {
            font-size: 15px !important;
        }
    }
</style>

{{-- SCRIPT --}}
<script>
    document.querySelectorAll('.network-option').forEach(option => {
        option.addEventListener('click', () => {
            document.querySelectorAll('.network-option')
                .forEach(o => o.classList.remove('active'));

            option.classList.add('active');
            option.querySelector('input').checked = true;
            document.getElementById('addressInput').focus();
        });
    });

    // Auto-select recommended (BEP20) on page load
    document.querySelector('[data-network="BEP20"]').click();

    // Real-time validation
    const amountInput = document.querySelector('input[name="amount"]');
    const maxBalance = parseFloat(amountInput.dataset.maxBalance);

    amountInput.addEventListener('input', function() {
        if (parseFloat(this.value) < 30) {
            this.style.borderColor = '#ef4444';
        } else if (parseFloat(this.value) > maxBalance) {
            this.style.borderColor = '#fbbf24';
        } else {
            this.style.borderColor = 'rgba(56,189,248,0.2)';
        }
    });

    // Send verification code
    function sendWithdrawCode() {
        fetch('{{ route("withdraw.send-code") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Success', 'Verification code sent to your email', 'success');
                } else {
                    Swal.fire('Error', data.message || 'Failed to send code', 'error');
                }
            })
            .catch(err => Swal.fire('Error', 'Network error', 'error'));
    }
</script>

@endsection