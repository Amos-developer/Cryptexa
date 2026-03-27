@extends('layouts.app')

@section('title', 'Withdraw Funds | Cryptexa')
@section('hide-header', true)
@section('page-heading', __t('withdraw_funds'))

@section('content')

<link rel="stylesheet" href="{{ asset('css/team.css') }}">

<!-- HEADER BAR -->
<div class="team-header">
    <a href="{{ url()->previous() }}" class="back-btn">
        <i class="icon-left-btn"></i>
    </a>
    <h6 class="header-title">{{ __t('withdraw_funds') }}</h6>
    <span class="placeholder"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80 withdraw-page" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh;">
    <div class="tf-container withdraw-shell" style="max-width: 500px; margin: 0 auto; padding: 0 20px;">

        <section class="withdraw-hero-panel" style="animation: slideDown 0.6s ease;">
            <div class="withdraw-hero-panel__eyebrow">CRYP TEXA PAYOUT DESK</div>
            <div class="withdraw-hero-panel__head">
                <div>
                    <h2>Withdraw with confidence</h2>
                    <p>Your amount is deducted once, the 8% fee stays inside it, and the rest reaches the user's wallet.</p>
                </div>
                <div class="withdraw-hero-panel__pill">Mobile-first flow</div>
            </div>
        </section>

        <!-- BALANCE CARD -->
        <div class="withdraw-balance-wrap" style="text-align: center; animation: slideDown 0.6s ease;">
            <div class="withdraw-balance-card" style="background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(34,197,94,0.1)); border: 1px solid rgba(56,189,248,0.2); border-radius: 20px; padding: 24px; box-shadow: 0 10px 40px rgba(56,189,248,0.15);">
                <p style="color: #94a3b8; font-size: 12px; margin: 0 0 8px 0; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">{{ __t('available_balance') }}</p>
                <h1 style="color: #e5e7eb; font-weight: 900; font-size: 36px; margin: 0 0 4px 0; background: linear-gradient(135deg, #38bdf8, #22d3ee); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">${{ number_format(auth()->user()->balance, 2) }}</h1>
                <p style="color: #64748b; font-size: 11px; margin: 0;">USDT • {{ __t('min_withdrawal') }} $10</p>
            </div>
        </div>

        @php
        $hasCompletedPool = \App\Models\ComputeOrder::where('user_id', auth()->id())->where('status', 'completed')->exists();
        $hasWithdrawalPin = !empty(auth()->user()->withdrawal_pin);
        @endphp

        @if(!$hasWithdrawalPin)
        <!-- NO WITHDRAWAL PIN NOTICE -->
        <div style="
            background: linear-gradient(135deg, rgba(239,68,68,0.15) 0%, rgba(239,68,68,0.05) 100%);
            border: 2px solid rgba(239,68,68,0.3);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 30px;
            animation: slideUp 0.6s ease 0.1s backwards;
        ">
            <div style="text-align: center;">
                <div style="font-size: 48px; margin-bottom: 16px;">🔐</div>
                <h3 style="color: #ef4444; font-weight: 700; font-size: 20px; margin: 0 0 12px 0;">{{ __t('withdrawal_pin_required') }}</h3>
                <p style="color: #e5e7eb; font-size: 14px; line-height: 1.6; margin: 0 0 20px 0;">
                    {{ __t('set_withdrawal_pin_msg') }}
                </p>
                <a href="{{ route('withdrawal-pin.set') }}" style="
                    display: inline-block;
                    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                    color: white;
                    padding: 12px 24px;
                    border-radius: 10px;
                    font-weight: 700;
                    font-size: 14px;
                    text-decoration: none;
                    transition: all 0.3s ease;
                "
                onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 10px 25px rgba(239,68,68,0.3)';"
                onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                    🔒 {{ __t('set_withdrawal_pin') }}
                </a>
            </div>
        </div>
        @endif

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
                <h3 style="color: #fbbf24; font-weight: 700; font-size: 20px; margin: 0 0 12px 0;">{{ __t('withdrawal_locked') }}</h3>
                <p style="color: #e5e7eb; font-size: 14px; line-height: 1.6; margin: 0 0 20px 0;">
                    {{ __t('withdrawal_locked_msg') }}
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
                    🚀 {{ __t('activate_first_pool') }}
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

        <form method="POST" action="{{ route('withdraw.submit') }}" class="withdraw-form-card" @if(!$hasCompletedPool || !$hasWithdrawalPin) style="opacity: 0.5; pointer-events: none;" @endif>
            @csrf

            <!-- NETWORK SELECT -->
            <div class="mb-28" style="animation: slideUp 0.6s ease 0.1s backwards;">
                <h5 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 14px 0;">
                    {{ __t('select_network') }}
                </h5>

                <div style="display: grid; gap: 10px;">

                    <!-- USDT BEP20 -->
                    <div class="network-option" data-network="BEP20" data-pattern="^0x[a-fA-F0-9]{40}$">
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
                                    <p style="color: #94a3b8; font-size: 12px; margin: 0;">Binance Smart Chain</p>
                                </div>
                                <span style="background: rgba(34,197,94,0.15); color: #22c55e; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700;">8%</span>
                            </div>
                        </div>
                    </div>

                    <!-- USDC BEP20 -->
                    <div class="network-option" data-network="USDC_BEP20" data-pattern="^0x[a-fA-F0-9]{40}$">
                        <input type="radio" name="network" value="USDC_BEP20" hidden>
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
                                    <p style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 4px 0;">USDC BEP20</p>
                                    <p style="color: #94a3b8; font-size: 12px; margin: 0;">Binance Smart Chain</p>
                                </div>
                                <span style="background: rgba(56,189,248,0.15); color: #38bdf8; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700;">8%</span>
                            </div>
                        </div>
                    </div>

                    <!-- USDT TRC20 -->
                    <div class="network-option" data-network="TRC20" data-pattern="^T[a-zA-Z0-9]{33}$">
                        <input type="radio" name="network" value="TRC20" hidden>
                        <div style="
                            background: linear-gradient(135deg, rgba(239,68,68,0.08) 0%, rgba(239,68,68,0.02) 100%);
                            border: 1.5px solid rgba(239,68,68,0.15);
                            border-radius: 12px;
                            padding: 14px;
                            cursor: pointer;
                            transition: all 0.3s ease;
                        "
                            onmouseover="this.style.borderColor='rgba(239,68,68,0.3)'; this.style.boxShadow='0 0 15px rgba(239,68,68,0.15)';"
                            onmouseout="this.style.borderColor='rgba(239,68,68,0.15)'; this.style.boxShadow='none';">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <p style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 4px 0;">USDT TRC20</p>
                                    <p style="color: #94a3b8; font-size: 12px; margin: 0;">Tron Network</p>
                                </div>
                                <span style="background: rgba(239,68,68,0.15); color: #ef4444; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700;">8%</span>
                            </div>
                        </div>
                    </div>

                    <!-- BNB BSC -->
                    <div class="network-option" data-network="BNB_BSC" data-pattern="^0x[a-fA-F0-9]{40}$">
                        <input type="radio" name="network" value="BNB_BSC" hidden>
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
                                    <p style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 4px 0;">BNB BSC</p>
                                    <p style="color: #94a3b8; font-size: 12px; margin: 0;">Binance Coin</p>
                                </div>
                                <span style="background: rgba(251,191,36,0.15); color: #fbbf24; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700;">8%</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- WITHDRAWAL AMOUNT -->
            <div class="mb-24" style="animation: slideUp 0.6s ease 0.15s backwards;">
                <h5 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 14px 0;">{{ __t('amount') }}</h5>
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
                    <span class="text-secondary">{{ __t('minimum') }}: <span style="color: #38bdf8; font-weight: 700;">$10</span></span>
                </div>

                <div style="
                    margin-top: 12px;
                    background: rgba(34,197,94,0.08);
                    border: 1px solid rgba(34,197,94,0.18);
                    border-radius: 12px;
                    padding: 12px 14px;
                ">
                    <p style="color: #86efac; font-size: 12px; font-weight: 700; margin: 0 0 4px 0;">8% fee is taken from the amount you enter</p>
                    <p style="color: #94a3b8; font-size: 12px; line-height: 1.6; margin: 0;">If you enter $100, your balance is reduced by $100, you receive $92, and the company keeps $8.</p>
                </div>

                <div class="withdraw-preview-grid">
                    <div class="withdraw-preview-tile">
                        <span>Balance debit</span>
                        <strong id="previewDebit">$0.00</strong>
                    </div>
                    <div class="withdraw-preview-tile">
                        <span>Company fee</span>
                        <strong id="previewFee">$0.00</strong>
                    </div>
                    <div class="withdraw-preview-tile withdraw-preview-tile--accent">
                        <span>User receives</span>
                        <strong id="previewReceive">$0.00</strong>
                    </div>
                </div>
            </div>

            <!-- WALLET ADDRESS -->
            <div class="mb-24" style="animation: slideUp 0.6s ease 0.2s backwards;">
                <h5 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 14px 0;">{{ __t('wallet_address') }}</h5>
                <input type="text"
                    id="addressInput"
                    name="address"
                    placeholder="{{ __t('paste_wallet_address') }}"
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
                    onblur="validateAddress()"
                    oninput="validateAddress()"
                    required>
                <p id="addressHint" class="text-secondary" style="font-size: 12px; margin: 8px 0 0 0;"></p>
            </div>

            <!-- SECURITY SECTION -->
            <div class="mb-24" style="
                background: linear-gradient(135deg, rgba(168,85,247,0.08) 0%, rgba(168,85,247,0.02) 100%);
                border: 1px solid rgba(168,85,247,0.15);
                border-radius: 16px;
                padding: 20px;
                animation: slideUp 0.6s ease 0.25s backwards;
            ">
                <h5 style="color: #a855f7; font-weight: 700; font-size: 15px; margin: 0 0 16px 0;">{{ __t('security_verification') }}</h5>

                <!-- PIN INPUT -->
                <div class="mb-16">
                    <label class="text-secondary" style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;">{{ __t('withdrawal_pin') }}</label>
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
                    <label class="text-secondary" style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;">{{ __t('email_verification_code') }}</label>
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
                            {{ __t('send_code') }}
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
                {{ __t('confirm_withdrawal') }}
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
                    <div style="width: 32px; height: 32px; background: rgba(239,68,68,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 8v4M12 16h.01"/>
                        </svg>
                    </div>
                    <div>
                        <p style="color: #ef4444; font-weight: 700; font-size: 13px; margin: 0 0 6px 0;">{{ __t('withdrawal_limit') }}</p>
                        <p class="text-secondary" style="font-size: 12px; margin: 0; line-height: 1.6;">
                            {{ __t('one_withdrawal_per_day') }}
                        </p>
                    </div>
                </div>
                <div style="display: flex; gap: 12px; margin-bottom: 12px;">
                    <div style="width: 32px; height: 32px; background: rgba(56,189,248,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 16v-4M12 8h.01"/>
                        </svg>
                    </div>
                    <div>
                        <p style="color: #38bdf8; font-weight: 700; font-size: 13px; margin: 0 0 6px 0;">{{ __t('processing_time') }}</p>
                        <p class="text-secondary" style="font-size: 12px; margin: 0; line-height: 1.6;">
                            {{ __t('withdrawals_require_approval') }}
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
                        <p style="color: #fbbf24; font-weight: 700; font-size: 13px; margin: 0 0 6px 0;">{{ __t('security_notice') }}</p>
                        <p class="text-secondary" style="font-size: 12px; margin: 0; line-height: 1.6;">
                            {{ __t('withdrawal_security_review') }}
                        </p>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<!-- ANIMATIONS & STYLES -->
<style>
    .withdraw-page {
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(circle at top right, rgba(56, 189, 248, 0.14), transparent 26%),
            radial-gradient(circle at bottom left, rgba(34, 197, 94, 0.10), transparent 22%),
            linear-gradient(180deg, #020617 0%, #08111f 42%, #0f172a 100%) !important;
    }

    .withdraw-shell {
        position: relative;
        display: grid;
        gap: 18px;
        z-index: 1;
    }

    .withdraw-hero-panel {
        margin-top: 88px;
        padding: 20px;
        border-radius: 24px;
        border: 1px solid rgba(56, 189, 248, 0.14);
        background: linear-gradient(180deg, rgba(9, 17, 30, 0.92), rgba(15, 23, 42, 0.92));
        box-shadow: 0 22px 50px rgba(0, 0, 0, 0.28);
    }

    .withdraw-hero-panel__eyebrow {
        display: inline-flex;
        margin-bottom: 12px;
        color: #6ae3ff;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.14em;
        text-transform: uppercase;
    }

    .withdraw-hero-panel__head {
        display: grid;
        gap: 14px;
    }

    .withdraw-hero-panel__head h2 {
        margin: 0 0 6px;
        color: #f8fbff;
        font-size: 28px;
        line-height: 1.02;
        font-weight: 900;
    }

    .withdraw-hero-panel__head p {
        margin: 0;
        color: #94a3b8;
        font-size: 13px;
        line-height: 1.7;
    }

    .withdraw-hero-panel__pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: fit-content;
        min-height: 36px;
        padding: 0 14px;
        border-radius: 999px;
        border: 1px solid rgba(56, 189, 248, 0.18);
        background: rgba(56, 189, 248, 0.08);
        color: #d8f7ff;
        font-size: 12px;
        font-weight: 700;
    }

    .withdraw-balance-wrap {
        margin-top: -6px;
    }

    .withdraw-balance-card {
        position: relative;
        overflow: hidden;
        border-radius: 26px !important;
        box-shadow: 0 18px 44px rgba(8, 145, 178, 0.16) !important;
    }

    .withdraw-form-card > div[class^="mb-"],
    .withdraw-form-card > button,
    .withdraw-form-card > div[style*="margin-top: 20px"] {
        position: relative;
        overflow: hidden;
        border-radius: 22px;
        box-shadow: 0 18px 44px rgba(0, 0, 0, 0.22);
    }

    .network-option > div {
        border-radius: 18px !important;
        min-height: 88px;
    }

    .withdraw-preview-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 10px;
        margin-top: 14px;
    }

    .withdraw-preview-tile {
        padding: 13px 12px;
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.05);
        background: rgba(255, 255, 255, 0.04);
        text-align: left;
    }

    .withdraw-preview-tile span {
        display: block;
        margin-bottom: 8px;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 600;
    }

    .withdraw-preview-tile strong {
        color: #f8fbff;
        font-size: 16px;
        font-weight: 800;
    }

    .withdraw-preview-tile--accent {
        border-color: rgba(34, 197, 94, 0.18);
        background: rgba(34, 197, 94, 0.08);
    }

    .withdraw-preview-tile--accent strong {
        color: #86efac;
    }

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

        .withdraw-preview-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (min-width: 640px) {
        .withdraw-hero-panel__head {
            grid-template-columns: 1fr auto;
            align-items: end;
        }

        .withdraw-form-card > div:first-child > div:last-child {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        }
    }
</style>

{{-- SCRIPT --}}
<script>
    let selectedNetwork = null;
    let addressPattern = null;
    
    document.querySelectorAll('.network-option').forEach(option => {
        option.addEventListener('click', () => {
            document.querySelectorAll('.network-option')
                .forEach(o => o.classList.remove('active'));

            option.classList.add('active');
            option.querySelector('input').checked = true;
            selectedNetwork = option.dataset.network;
            addressPattern = option.dataset.pattern;
            document.getElementById('addressInput').value = '';
            document.getElementById('addressInput').focus();
            updateAddressHint();
        });
    });

    // Auto-select recommended (BEP20) on page load
    document.querySelector('[data-network="BEP20"]').click();
    
    function updateAddressHint() {
        const hint = document.getElementById('addressHint');
        if (!selectedNetwork) {
            hint.textContent = '';
            return;
        }
        
        const hints = {
            'BEP20': '✓ BEP20 address starts with 0x (42 characters)',
            'USDC_BEP20': '✓ BEP20 address starts with 0x (42 characters)',
            'TRC20': '✓ TRC20 address starts with T (34 characters)',
            'BNB_BSC': '✓ BSC address starts with 0x (42 characters)'
        };
        
        hint.textContent = hints[selectedNetwork] || '';
        hint.style.color = '#94a3b8';
    }
    
    function validateAddress() {
        const input = document.getElementById('addressInput');
        const hint = document.getElementById('addressHint');
        const address = input.value.trim();
        
        if (!address || !addressPattern) {
            input.style.borderColor = 'rgba(56,189,248,0.15)';
            updateAddressHint();
            return true;
        }
        
        const regex = new RegExp(addressPattern);
        const isValid = regex.test(address);
        
        if (isValid) {
            input.style.borderColor = '#22c55e';
            hint.textContent = '✓ Valid address format';
            hint.style.color = '#22c55e';
        } else {
            input.style.borderColor = '#ef4444';
            hint.textContent = '✗ Invalid address format for ' + selectedNetwork;
            hint.style.color = '#ef4444';
        }
        
        return isValid;
    }

    // Real-time validation
    const amountInput = document.querySelector('input[name="amount"]');
    const maxBalance = parseFloat(amountInput.dataset.maxBalance);

    function updateWithdrawalPreview() {
        const amount = parseFloat(amountInput.value) || 0;
        const fee = amount * 0.08;
        const receive = Math.max(amount - fee, 0);

        document.getElementById('previewDebit').textContent = '$' + amount.toFixed(2);
        document.getElementById('previewFee').textContent = '$' + fee.toFixed(2);
        document.getElementById('previewReceive').textContent = '$' + receive.toFixed(2);
    }

    amountInput.addEventListener('input', function() {
        if (parseFloat(this.value) < 10) {
            this.style.borderColor = '#ef4444';
        } else if (parseFloat(this.value) > maxBalance) {
            this.style.borderColor = '#fbbf24';
        } else {
            this.style.borderColor = 'rgba(56,189,248,0.2)';
        }

        updateWithdrawalPreview();
    });

    updateWithdrawalPreview();

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
        
        // Disable button while verifying
        btn.disabled = true;
        btn.style.opacity = '0.6';
        btn.textContent = 'Verifying...';
        
        // Verify code with server
        fetch('{{ route("withdraw.verify-code") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                code: emailInput.value
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
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
            } else {
                // Re-enable button for retry
                btn.disabled = false;
                btn.style.opacity = '1';
                btn.textContent = 'Verify';
                
                Swal.fire({
                    title: 'Verification Failed',
                    text: data.message || 'Invalid or expired code',
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
            btn.textContent = 'Verify';
            
            Swal.fire({
                title: 'Error',
                text: 'Network error. Please try again.',
                icon: 'error',
                confirmButtonColor: '#ef4444',
                background: '#020617',
                color: '#e5e7eb'
            });
        });
    }
</script>

@endsection
