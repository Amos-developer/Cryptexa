@extends('layouts.app')

@section('title', 'Change Withdrawal PIN | Cryptexa')
@section('hide-header', true)

@section('content')

<link rel="stylesheet" href="{{ asset('css/withdrawal-pin.css') }}">

<!-- HEADER BAR -->
<div class="pin-header">
    <a href="{{ route('account.settings') }}" class="back-btn">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7" />
        </svg>
    </a>
    <h6 class="header-title">Change Withdrawal PIN</h6>
    <span class="placeholder"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pin-container">

    <!-- CARD SECTION -->
    <div class="pin-card">
        <div class="card-header">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="1"></circle>
                <circle cx="19" cy="12" r="1"></circle>
                <circle cx="5" cy="12" r="1"></circle>
            </svg>
            <h2 class="card-title">Update Your Withdrawal PIN</h2>
            <p class="card-desc">Change your withdrawal PIN to a new secure 4-digit number</p>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('withdrawal-pin.update') }}" class="pin-form">
            @csrf
            @method('PUT')

            <!-- CURRENT PIN INPUT -->
            <div class="form-group">
                <label for="current_pin" class="form-label">Current PIN</label>
                <div class="pin-input-wrapper">
                    <input
                        type="password"
                        id="current_pin"
                        name="current_pin"
                        class="form-control pin-input @error('current_pin') is-invalid @enderror"
                        placeholder="••••"
                        maxlength="4"
                        inputmode="numeric"
                        required>
                    <button type="button" class="toggle-pin" onclick="togglePin('current_pin')">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                @error('current_pin')
                <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            <!-- NEW PIN INPUT -->
            <div class="form-group">
                <label for="new_pin" class="form-label">New PIN</label>
                <div class="pin-input-wrapper">
                    <input
                        type="password"
                        id="new_pin"
                        name="new_pin"
                        class="form-control pin-input @error('new_pin') is-invalid @enderror"
                        placeholder="••••"
                        maxlength="4"
                        inputmode="numeric"
                        required>
                    <button type="button" class="toggle-pin" onclick="togglePin('new_pin')">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                @error('new_pin')
                <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            <!-- NEW PIN CONFIRMATION INPUT -->
            <div class="form-group">
                <label for="new_pin_confirmation" class="form-label">Confirm New PIN</label>
                <div class="pin-input-wrapper">
                    <input
                        type="password"
                        id="new_pin_confirmation"
                        name="new_pin_confirmation"
                        class="form-control pin-input @error('new_pin_confirmation') is-invalid @enderror"
                        placeholder="••••"
                        maxlength="4"
                        inputmode="numeric"
                        required>
                    <button type="button" class="toggle-pin" onclick="togglePin('new_pin_confirmation')">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                @error('new_pin_confirmation')
                <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            <!-- PIN RULES -->
            <div class="pin-rules">
                <h4 class="rules-title">PIN Requirements</h4>
                <ul class="rules-list">
                    <li class="rule-item" id="rule-length">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Exactly 4 digits</span>
                    </li>
                    <li class="rule-item" id="rule-numeric">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Numbers only (0-9)</span>
                    </li>
                    <li class="rule-item" id="rule-different">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>New PIN must be different</span>
                    </li>
                    <li class="rule-item" id="rule-match">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Both new PINs must match</span>
                    </li>
                </ul>
            </div>

            <!-- SUBMIT BUTTON -->
            <button type="submit" class="btn-submit">Change PIN</button>
        </form>

        <!-- INFO BOX -->
        <div class="info-box">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
            <div>
                <p><strong>Keep your PIN safe:</strong> Never share your PIN with anyone. You'll need it to confirm all withdrawal requests.</p>
            </div>
        </div>
    </div>

</div>

<script>
    function togglePin(fieldId) {
        const input = document.getElementById(fieldId);
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
    }

    // PIN validation rules
    const currentPinInput = document.getElementById('current_pin');
    const newPinInput = document.getElementById('new_pin');
    const newPinConfirm = document.getElementById('new_pin_confirmation');

    function validatePin() {
        const newPin = newPinInput.value;
        const confirm = newPinConfirm.value;
        const currentPin = currentPinInput.value;

        // Check length
        const lengthValid = newPin.length === 4;
        document.getElementById('rule-length').classList.toggle('valid', lengthValid);

        // Check numeric
        const numericValid = /^\d{4}$/.test(newPin);
        document.getElementById('rule-numeric').classList.toggle('valid', numericValid);

        // Check different from current
        const differentValid = newPin !== currentPin && newPin.length > 0;
        document.getElementById('rule-different').classList.toggle('valid', differentValid);

        // Check match
        const matchValid = newPin === confirm && newPin.length > 0;
        document.getElementById('rule-match').classList.toggle('valid', matchValid);
    }

    newPinInput.addEventListener('input', validatePin);
    newPinConfirm.addEventListener('input', validatePin);
    currentPinInput.addEventListener('input', validatePin);

    // Only allow numbers
    [currentPinInput, newPinInput, newPinConfirm].forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^\d]/g, '').slice(0, 4);
        });
    });
</script>

@endsection