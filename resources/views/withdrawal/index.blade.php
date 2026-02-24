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
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh;">
    <div class="tf-container" style="max-width: 500px; margin: 0 auto; padding: 0 20px;">

        <!-- BALANCE CARD -->
        <div style="text-align: center; margin-bottom: 24px; animation: slideDown 0.6s ease;">
            <div style="background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(34,197,94,0.1)); border: 1px solid rgba(56,189,248,0.2); border-radius: 20px; padding: 24px; box-shadow: 0 10px 40px rgba(56,189,248,0.15);">
                <p style="color: #94a3b8; font-size: 12px; margin: 0 0 8px 0; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Available Balance</p>
                <h1 style="color: #e5e7eb; font-weight: 900; font-size: 36px; margin: 0 0 4px 0; background: linear-gradient(135deg, #38bdf8, #22d3ee); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">${{ number_format(auth()->user()->balance, 2) }}</h1>
                <p style="color: #64748b; font-size: 11px; margin: 0;">USDT • Min Withdrawal $10</p>
            </div>
        </div>

        @php
        $hasCompletedPool = true; // Temporarily unlocked for testing
        // $hasCompletedPool = \App\Models\ComputeOrder::where('user_id', auth()->id())->where('status', 'completed')->exists();
        @endphp

        @if(!$hasCompletedPool)
        <!-- WITHDRAWAL LOCKED NOTICE -->
        <div style="
            background: linear-gradient(135deg, rgba(251,191,36,0.15) 0%, rgba(251,191,36,0.05) 100%);
            border: 2px solid rgba(251,191,36,0.3);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 30px;
            animation: slideUp 0.6s ease 0.1s backwards;
        ">
            <div style="text-align: center;">
                <div style="font-size: 48px; margin-bottom: 16px;">🔒</div>
                <h3 style="color: #fbbf24; font-weight: 700; font-size: 20px; margin: 0 0 12px 0;">Withdrawal Locked</h3>
                <p style="color: #e5e7eb; font-size: 14px; line-height: 1.6; margin: 0 0 20px 0;">
                    To unlock withdrawals, you must first activate and complete at least one liquidity pool.
                    This ensures platform security and prevents abuse.
                </p>
                <a href="{{ route('home') }}" style="
                    display: inline-block;
                    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
                    color: #0f172a;
                    padding: 12px 24px;
                    border-radius: 10px;
                    font-weight: 700;
                    font-size: 14px;
                    text-decoration: none;
                    transition: all 0.3s ease;
                "
                onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 10px 25px rgba(251,191,36,0.3)';"
                onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                    🚀 Activate Your First Pool
                </a>
            </div>
        </div>
        @endif

        <!-- ALERTS WITH SWEET ALERT -->
        @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const errors = @json($errors -> all());
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

        <form method="POST" action="{{ route('withdraw.submit') }}" @if(!$hasCompletedPool) style="opacity: 0.5; pointer-events: none;" @endif>
            @csrf

            <!-- NETWORK SELECT -->
            <div class="mb-28" style="animation: slideUp 0.6s ease 0.1s backwards;">
                <h5 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 14px 0;">
                    Select Network
                </h5>

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
                <h5 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 14px 0;">Amount</h5>
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
                        min="10"
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

                <div style="margin-top: 10px; font-size: 12px; text-align: center;">
                    <span class="text-secondary">Minimum: <span style="color: #38bdf8; font-weight: 700;">$10</span></span>
                </div>
            </div>

            <!-- WALLET ADDRESS -->
            <div class="mb-24" style="animation: slideUp 0.6s ease 0.2s backwards;">
                <h5 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 14px 0;">Wallet Address</h5>
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
                <p class="text-secondary" style="font-size: 12px; margin: 8px 0 0 0;">✓ Check your email for the 6-digit verification code</p>
            </div>

            <!-- SECURITY SECTION -->
            <div class="mb-24" style="
                background: linear-gradient(135deg, rgba(168,85,247,0.08) 0%, rgba(168,85,247,0.02) 100%);
                border: 1px solid rgba(168,85,247,0.15);
                border-radius: 16px;
                padding: 20px;
                animation: slideUp 0.6s ease 0.25s backwards;
            ">
                <h5 style="color: #a855f7; font-weight: 700; font-size: 15px; margin: 0 0 16px 0;">Security Verification</h5>

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
                    <div style="display: flex; gap: 8px;">
                        <input type="text"
                            id="emailCodeInput"
                            maxlength="6"
                            name="email_code"
                            placeholder="000000"
                            disabled
                            style="
                            flex: 1;
                            background: rgba(255,255,255,0.02);
                            border: 1px solid rgba(168,85,247,0.2);
                            border-radius: 10px;
                            color: #e5e7eb;
                            font-size: 18px;
                            letter-spacing: 3px;
                            text-align: center;
                            padding: 12px;
                            transition: all 0.3s ease;
                            box-sizing: border-box;
                            font-weight: 600;
                            opacity: 0.5;
                        "
                            onfocus="this.style.borderColor='rgba(168,85,247,0.4)'"
                            onblur="this.style.borderColor='rgba(168,85,247,0.2)'"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            required>

                        <button type="button"
                            id="sendCodeBtn"
                            onclick="sendWithdrawCode()"
                            style="
                            background: linear-gradient(135deg, #a855f7, #9333ea);
                            border: none;
                            width: 50px;
                            color: white;
                            font-weight: 700;
                            border-radius: 10px;
                            white-space: nowrap;
                            transition: all 0.3s ease;
                            font-size: 12px;
                            cursor: pointer;
                            box-shadow: 0 4px 12px rgba(168,85,247,0.3);
                        "
                            onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 16px rgba(168,85,247,0.4)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(168,85,247,0.3)';">
                            Send Code
                        </button>
                    </div>
                </div>
            </div>

            <!-- SUBMIT BUTTON -->
            <button type="submit"
                id="submitBtn"
                disabled
                style="
                width: 100%;
                padding: 18px;
                border-radius: 16px;
                background: linear-gradient(135deg, #38bdf8, #0ea5e9);
                border: none;
                color: white;
                font-weight: 700;
                font-size: 16px;
                cursor: not-allowed;
                transition: all 0.3s ease;
                box-shadow: 0 10px 30px rgba(56,189,248,0.3);
                animation: slideUp 0.6s ease 0.3s backwards;
                opacity: 0.5;
            "
                onmouseover="if(!this.disabled) { this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 40px rgba(56,189,248,0.4)'; }"
                onmouseout="if(!this.disabled) { this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(56,189,248,0.3)'; }">
                Confirm Withdrawal
            </button>

            <!-- INFO BOX -->
            <div style="
                background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
                border: 1px solid rgba(56,189,248,0.15);
                border-radius: 16px;
                padding: 18px;
                margin-top: 20px;
                animation: slideUp 0.6s ease 0.35s backwards;
            ">
                <div style="display: flex; gap: 12px; margin-bottom: 12px;">
                    <div style="width: 32px; height: 32px; background: rgba(56,189,248,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 16v-4M12 8h.01"/>
                        </svg>
                    </div>
                    <div>
                        <p style="color: #38bdf8; font-weight: 700; font-size: 13px; margin: 0 0 6px 0;">Processing Time</p>
                        <p class="text-secondary" style="font-size: 12px; margin: 0; line-height: 1.6;">
                            Withdrawals require admin approval. Processing takes 20 minutes to 24 hours.
                        </p>
                    </div>
                </div>
                <div style="display: flex; gap: 12px;">
                    <div style="width: 32px; height: 32px; background: rgba(251,191,36,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <div>
                        <p style="color: #fbbf24; font-weight: 700; font-size: 13px; margin: 0 0 6px 0;">Security Notice</p>
                        <p class="text-secondary" style="font-size: 12px; margin: 0; line-height: 1.6;">
                            Your withdrawal will be reviewed by our security team before processing.
                        </p>
                    </div>
                </div>
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
        .tf-container {
            padding: 0 16px !important;
        }

        h1 {
            font-size: 28px !important;
        }

        h5 {
            font-size: 14px !important;
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
        if (parseFloat(this.value) < 10) {
            this.style.borderColor = '#ef4444';
        } else if (parseFloat(this.value) > maxBalance) {
            this.style.borderColor = '#fbbf24';
        } else {
            this.style.borderColor = 'rgba(56,189,248,0.2)';
        }
    });

    // Send verification code with cooldown
    let cooldownTimer = null;
    let isVerified = false;
    
    function sendWithdrawCode() {
        const btn = document.getElementById('sendCodeBtn');
        const emailInput = document.getElementById('emailCodeInput');
        const submitBtn = document.getElementById('submitBtn');
        
        if (btn.disabled) return;

        btn.disabled = true;
        btn.style.opacity = '0.6';
        btn.style.cursor = 'not-allowed';
        btn.textContent = 'Sending...';

        fetch('{{ route("withdraw.send-code") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(res => {
                if (!res.ok) {
                    throw new Error('HTTP error ' + res.status);
                }
                return res.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Code Sent!',
                        html: data.message,
                        icon: 'success',
                        confirmButtonColor: '#22c55e',
                        background: '#020617',
                        color: '#e5e7eb'
                    });
                    
                    // Enable email input
                    emailInput.disabled = false;
                    emailInput.style.opacity = '1';
                    emailInput.focus();
                    
                    // Change button to Verify
                    btn.textContent = 'Verify';
                    btn.style.background = 'linear-gradient(135deg, #22c55e, #16a34a)';
                    btn.onclick = verifyCode;
                    btn.disabled = false;
                    btn.style.opacity = '1';
                    btn.style.cursor = 'pointer';
                } else {
                    btn.disabled = false;
                    btn.style.opacity = '1';
                    btn.style.cursor = 'pointer';
                    btn.textContent = 'Send Code';
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Failed to send code',
                        icon: 'error',
                        confirmButtonColor: '#ef4444',
                        background: '#020617',
                        color: '#e5e7eb'
                    });
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.style.opacity = '1';
                btn.style.cursor = 'pointer';
                btn.textContent = 'Send Code';
                Swal.fire({
                    title: 'Error!',
                    text: 'Network error: ' + err.message,
                    icon: 'error',
                    confirmButtonColor: '#ef4444',
                    background: '#020617',
                    color: '#e5e7eb'
                });
            });
    }
    
    function verifyCode() {
        const emailInput = document.getElementById('emailCodeInput');
        const submitBtn = document.getElementById('submitBtn');
        const btn = document.getElementById('sendCodeBtn');
        
        if (emailInput.value.length !== 6) {
            Swal.fire({
                title: 'Invalid Code',
                text: 'Please enter a 6-digit verification code',
                icon: 'warning',
                confirmButtonColor: '#fbbf24',
                background: '#020617',
                color: '#e5e7eb'
            });
            return;
        }
        
        // Mark as verified and enable submit
        isVerified = true;
        submitBtn.disabled = false;
        submitBtn.style.opacity = '1';
        submitBtn.style.cursor = 'pointer';
        
        // Lock the code input and button
        emailInput.disabled = true;
        emailInput.style.opacity = '0.7';
        btn.disabled = true;
        btn.style.opacity = '0.5';
        btn.textContent = '✓ Verified';
        
        Swal.fire({
            title: 'Verified!',
            text: 'You can now confirm your withdrawal',
            icon: 'success',
            confirmButtonColor: '#22c55e',
            background: '#020617',
            color: '#e5e7eb',
            timer: 2000
        });
    }
</script>

@endsection