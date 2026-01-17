@extends('layouts.app')

@section('title', 'Withdraw')
@section('hide-header', true)

@section('content')

{{-- HEADER --}}
<div class="header fixed-top d-flex align-items-center px-16"
    style="background:#020617;border-bottom:1px solid rgba(56,189,248,.2);">
    <a href="{{ url()->previous() }}" class="me-10">
        <i class="icon-left-btn text-white"></i>
    </a>
    <h5 class="text-white mb-0">Withdraw</h5>
</div>

<div class="pt-45 pb-20">
    <div class="tf-container">

        <form method="POST" action="{{ route('withdraw.submit') }}">
            @csrf

            {{-- NETWORK SELECT --}}
            <div class="mb-18">
                <label class="text-secondary text-small mb-8 d-block">
                    Select Network
                </label>

                <div class="d-grid gap-10">

                    {{-- BEP20 --}}
                    <div class="network-option" data-network="BEP20">
                        <input type="radio" name="network" value="BEP20" hidden>
                        <div class="network-card">
                            <strong>USDT BEP20</strong>
                            <small>Binance Smart Chain</small>
                            <span class="fee">Fee: $1</span>
                        </div>
                    </div>

                    {{-- TRC20 --}}
                    <div class="network-option" data-network="TRC20">
                        <input type="radio" name="network" value="TRC20" hidden>
                        <div class="network-card">
                            <strong>USDT TRC20</strong>
                            <small>Tron Network</small>
                            <span class="fee">Fee: $1</span>
                        </div>
                    </div>

                    {{-- ERC20 --}}
                    <div class="network-option" data-network="ERC20">
                        <input type="radio" name="network" value="ERC20" hidden>
                        <div class="network-card">
                            <strong>USDT ERC20</strong>
                            <small>Ethereum Network</small>
                            <span class="fee high">Fee: $10</span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ADDRESS --}}
            <div class="mb-16">
                <label class="text-secondary text-small mb-6 d-block">
                    Withdrawal Address
                </label>

                <input type="text"
                    id="addressInput"
                    name="address"
                    disabled
                    placeholder="Select network first"
                    class="form-control"
                    style="
                background:#020617;
                border-radius:14px;
                border:1px solid rgba(56,189,248,.25);
                color:#e5e7eb;
           ">
            </div>

            {{-- AMOUNT --}}
            <div class="mb-16">
                <label class="text-secondary text-small mb-6 d-block">
                    Withdrawal Amount
                </label>

                <input type="number"
                    step="0.01"
                    min="30"
                    name="amount"
                    placeholder="0.00"
                    class="form-control"
                    style="
                background:#020617;
                border-radius:14px;
                border:1px solid rgba(56,189,248,.25);
                color:#e5e7eb;
           ">

                <small class="text-secondary mt-6 d-block">
                    Minimum: <span class="text-white">$30</span>
                </small>
            </div>

            {{-- PIN --}}
            <div class="mb-16">
                <label class="text-secondary text-small mb-6 d-block">
                    Withdrawal PIN
                </label>

                <input type="password"
                    maxlength="4"
                    name="pin"
                    placeholder="4-digit PIN"
                    class="form-control"
                    style="
                background:#020617;
                border-radius:14px;
                border:1px solid rgba(56,189,248,.25);
                color:#e5e7eb;
           ">
            </div>

            {{-- EMAIL CODE --}}
            <div class="mb-20">
                <label class="text-secondary text-small mb-6 d-block">
                    Email Verification
                </label>

                <div class="d-flex gap-8">
                    <input type="text"
                        maxlength="6"
                        name="email_code"
                        placeholder="6-digit code"
                        class="form-control"
                        style="
                    background:#020617;
                    border-radius:14px;
                    border:1px solid rgba(56,189,248,.25);
                    color:#e5e7eb;
               ">

                    <button type="button"
                        onclick="sendWithdrawCode()"
                        class="btn"
                        style="
                    background:#38bdf8;
                    color:#020617;
                    font-weight:600;
                    border-radius:14px;
                ">
                        Send Code
                    </button>
                </div>
            </div>

            <button type="submit"
                class="btn w-100"
                style="
            background:linear-gradient(90deg,#38bdf8,#0ea5e9);
            color:#020617;
            font-weight:700;
            border-radius:16px;
            padding:14px;
        ">
                Confirm Withdrawal
            </button>

        </form>

    </div>
</div>

{{-- STYLES --}}
<style>
    .network-card {
        background: linear-gradient(135deg, #020617, #0f172a);
        border: 1px solid rgba(56, 189, 248, .2);
        border-radius: 14px;
        padding: 14px;
        cursor: pointer;
    }

    .network-card strong {
        color: #e5e7eb
    }

    .network-card small {
        display: block;
        color: #94a3b8
    }

    .network-card .fee {
        color: #38bdf8;
        font-size: 12px
    }

    .network-card .fee.high {
        color: #fbbf24
    }

    .network-option.active .network-card {
        border-color: #38bdf8;
        box-shadow: 0 0 18px rgba(56, 189, 248, .35);
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

            const addressInput = document.getElementById('addressInput');
            addressInput.disabled = false;
            addressInput.placeholder = 'Enter ' + option.dataset.network + ' address';
        });
    });
</script>

@endsection