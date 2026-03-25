@extends('layouts.app')

@section('title', 'Change Withdrawal PIN | Cryptexa')
@section('hide-header', true)
@section('page-heading', 'Change Withdrawal PIN')
@section('page-back-url', route('account.settings'))

@section('content')

<style>
    :root {
        --primary: #38bdf8;
        --bg-dark: #020617;
        --bg-darker: #0f172a;
        --text-light: #e5e7eb;
        --text-muted: #94a3b8;
        --border: rgba(56, 189, 248, 0.2);
        --success: #22c55e;
        --danger: #ef4444;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* HEADER */
    .pin-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 55px;
        background: linear-gradient(135deg, var(--bg-dark), var(--bg-darker));
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 16px;
        z-index: 100;
    }

    .back-btn {
        width: 36px;
        height: 36px;
        background: rgba(56, 189, 248, 0.1);
        border: 1px solid var(--border);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        text-decoration: none;
    }

    .header-title {
        color: var(--text-light);
        font-size: 15px;
        font-weight: 600;
    }

    .placeholder {
        width: 36px;
    }

    /* WRAPPER */
    .pin-container {
        min-height: 100vh;
        padding: 80px 16px 40px;
        background: linear-gradient(135deg, var(--bg-dark), var(--bg-darker));
        display: flex;
        justify-content: center;
    }

    /* CARD */
    .pin-card {
        width: 100%;
        max-width: 420px;
        background: rgba(56, 189, 248, 0.05);
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 28px 20px;
        animation: fadeIn 0.5s ease;
    }

    .card-header {
        text-align: center;
        margin-bottom: 28px;
    }

    .card-header svg {
        color: var(--primary);
        margin-bottom: 12px;
    }

    .card-title {
        color: var(--text-light);
        font-size: 20px;
        margin-bottom: 6px;
    }

    .card-desc {
        color: var(--text-muted);
        font-size: 13px;
    }

    /* PIN SECTIONS */
    .pin-section {
        margin-bottom: 24px;
    }

    .pin-section label {
        color: var(--text-light);
        font-size: 13px;
        margin-bottom: 8px;
        display: block;
    }

    .pin-group {
        display: flex;
        gap: 12px;
        justify-content: center;
    }

    .pin-box {
        width: 55px;
        height: 55px;
        background: var(--bg-dark);
        border: 1px solid var(--border);
        border-radius: 12px;
        text-align: center;
        font-size: 22px;
        color: var(--text-light);
        transition: 0.2s;
    }

    .pin-box:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
    }

    /* BUTTON */
    .btn-submit {
        width: 100%;
        padding: 14px;
        border-radius: 12px;
        border: none;
        background: linear-gradient(90deg, #38bdf8, #0ea5e9);
        color: white;
        font-weight: 600;
        margin-top: 10px;
        cursor: pointer;
    }

    /* ALERTS */
    .alert-success {
        background: rgba(34, 197, 94, 0.1);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: var(--success);
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 13px;
    }

    .alert-error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: var(--danger);
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 13px;
    }

    /* INFO BOX */
    .info-box {
        margin-top: 25px;
        background: rgba(100, 116, 139, 0.1);
        border: 1px solid rgba(100, 116, 139, 0.2);
        padding: 14px;
        border-radius: 10px;
        font-size: 12px;
        color: var(--text-muted);
        line-height: 1.6;
    }

    .info-box strong {
        color: var(--text-light);
    }

    /* DESKTOP */
    @media (min-width: 768px) {
        .pin-card {
            padding: 40px;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- HEADER -->
<div class="pin-header">
    <a href="{{ route('account.settings') }}" class="back-btn">←</a>
    <h6 class="header-title">Change Withdrawal PIN</h6>
    <span class="placeholder"></span>
</div>

<div class="pin-container">

    <div class="pin-card">

        <div class="card-header">
            <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="12" cy="12" r="1"></circle>
                <circle cx="19" cy="12" r="1"></circle>
                <circle cx="5" cy="12" r="1"></circle>
            </svg>
            <h2 class="card-title">Update Your Withdrawal PIN</h2>
            <p class="card-desc">Enter your current PIN and choose a new secure 4-digit PIN.</p>
        </div>

        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('withdrawal-pin.update') }}">
            @csrf
            @method('PUT')

            <!-- CURRENT PIN -->
            <div class="pin-section">
                <label>Current PIN</label>
                <div class="pin-group current-group">
                    @for($i=1;$i<=4;$i++)
                        <input type="password" maxlength="1" class="pin-box current-box" required>
                        @endfor
                </div>
                <input type="hidden" name="current_pin" id="currentPin">
            </div>

            <!-- NEW PIN -->
            <div class="pin-section">
                <label>New PIN</label>
                <div class="pin-group new-group">
                    @for($i=1;$i<=4;$i++)
                        <input type="password" maxlength="1" class="pin-box new-box" required>
                        @endfor
                </div>
                <input type="hidden" name="new_pin" id="newPin">
            </div>

            <!-- CONFIRM -->
            <div class="pin-section">
                <label>Confirm New PIN</label>
                <div class="pin-group confirm-group">
                    @for($i=1;$i<=4;$i++)
                        <input type="password" maxlength="1" class="pin-box confirm-box" required>
                        @endfor
                </div>
                <input type="hidden" name="new_pin_confirmation" id="confirmPin">
            </div>

            <button type="submit" class="btn-submit">Change PIN</button>

        </form>

        <div class="info-box">
            <strong>Security Notice:</strong>
            Your PIN is encrypted and required for all withdrawals.
            Avoid predictable combinations and never share your PIN with anyone.
        </div>

    </div>

</div>

<script>
    function setupPin(boxClass, hiddenInputId) {
        const boxes = document.querySelectorAll(boxClass);
        const hidden = document.getElementById(hiddenInputId);

        boxes.forEach((box, index) => {
            box.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');

                if (this.value && index < boxes.length - 1) {
                    boxes[index + 1].focus();
                }

                updateHidden();
            });

            box.addEventListener('keydown', function(e) {
                if (e.key === "Backspace" && !this.value && index > 0) {
                    boxes[index - 1].focus();
                }
            });
        });

        function updateHidden() {
            let value = '';
            boxes.forEach(b => value += b.value);
            hidden.value = value;
        }
    }

    setupPin('.current-box', 'currentPin');
    setupPin('.new-box', 'newPin');
    setupPin('.confirm-box', 'confirmPin');
</script>

@endsection
