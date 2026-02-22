@extends('layouts.app')

@section('title', 'Set Withdrawal PIN | Cryptexa')

@section('content')
<link rel="stylesheet" href="{{ asset('css/withdrawal-pin.css') }}">

<div style="
    background: linear-gradient(135deg, #020617, #0f172a);
    min-height: 100vh;
    padding: 80px 20px;
">

    <div style="max-width: 460px; margin: 0 auto;">

        <div style="
            background: #0f172a;
            border: 1px solid rgba(56,189,248,0.2);
            border-radius: 16px;
            padding: 40px 35px;
            box-shadow: 0 0 40px rgba(56,189,248,0.08);
        ">

            <h2 style="
                text-align:center;
                color:#ffffff;
                font-weight:600;
                margin-bottom:10px;
            ">
                Secure Withdrawal PIN
            </h2>

            <p style="
                text-align:center;
                color:#94a3b8;
                font-size:14px;
                margin-bottom:35px;
            ">
                Add an extra layer of protection to your Cryptexa account.
            </p>

            @if(session('success'))
            <div class="success-box">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="error-box">
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('withdrawal-pin.store') }}" autocomplete="off">
                @csrf

                <label class="label-text">Enter 4-Digit PIN</label>

                <div class="pin-group">
                    @for($i=1; $i<=4; $i++)
                        <input type="password"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        maxlength="1"
                        class="pin-input"
                        required>
                        @endfor
                </div>

                <input type="hidden" name="pin" id="realPin">

                <label class="label-text">Confirm PIN</label>

                <div class="pin-group">
                    @for($i=1; $i<=4; $i++)
                        <input type="password"
                        inputmode="numeric"
                        pattern="[0-9]*"
                        maxlength="1"
                        class="confirm-pin-input"
                        required>
                        @endfor
                </div>

                <input type="hidden" name="pin_confirmation" id="realConfirmPin">

                <button type="submit" class="submit-btn">
                    Activate Security PIN
                </button>
            </form>

            <!-- INFO BOX -->
            <div class="info-box">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>

                <div>
                    <p>
                        <strong>Security Notice:</strong> Your Withdrawal PIN is encrypted and securely stored.
                        Never share it with anyone — including Cryptexa support.
                        This PIN will be required to authorize every withdrawal request,
                        adding an additional verification layer to protect your funds
                        against unauthorized access and fraud attempts.
                    </p>

                    <p style="margin-top:8px;">
                        For maximum protection, avoid predictable combinations
                        such as <strong>1234</strong>, <strong>0000</strong>, or birth years.
                        Choose a unique number known only to you.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .label-text {
        color: #cbd5e1;
        font-size: 14px;
    }

    .pin-group {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin: 20px 0 30px;
    }

    .pin-input,
    .confirm-pin-input {
        width: 60px;
        height: 60px;
        background: #020617;
        border: 1px solid rgba(56, 189, 248, 0.3);
        border-radius: 12px;
        text-align: center;
        font-size: 22px;
        color: #ffffff;
        outline: none;
        transition: 0.25s;
    }

    .pin-input:focus,
    .confirm-pin-input:focus {
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
    }

    .submit-btn {
        width: 100%;
        padding: 14px;
        background: linear-gradient(90deg, #38bdf8, #0ea5e9);
        border: none;
        border-radius: 12px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        margin-bottom: 30px;
    }

    .submit-btn:hover {
        opacity: 0.9;
    }

    .info-box {
        display: flex;
        gap: 12px;
        background: rgba(56, 189, 248, 0.08);
        border: 1px solid rgba(56, 189, 248, 0.25);
        padding: 16px;
        border-radius: 12px;
        color: #cbd5e1;
        font-size: 13px;
        line-height: 1.6;
    }

    .info-box svg {
        color: #38bdf8;
        flex-shrink: 0;
        margin-top: 3px;
    }

    .success-box {
        background: rgba(34, 197, 94, 0.1);
        color: #22c55e;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .error-box {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }
</style>

<script>
    const pinInputs = document.querySelectorAll('.pin-input');
    const confirmInputs = document.querySelectorAll('.confirm-pin-input');
    const realPin = document.getElementById('realPin');
    const realConfirmPin = document.getElementById('realConfirmPin');

    function handleInputs(inputs, hiddenInput) {
        inputs.forEach((input, index) => {

            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');

                if (this.value && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }

                updateHidden(inputs, hiddenInput);
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === "Backspace" && !this.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
    }

    function updateHidden(inputs, hiddenInput) {
        let value = '';
        inputs.forEach(input => value += input.value);
        hiddenInput.value = value;
    }

    handleInputs(pinInputs, realPin);
    handleInputs(confirmInputs, realConfirmPin);
</script>

@endsection