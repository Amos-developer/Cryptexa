@extends('layouts.app')

@section('title', 'Two-Factor Authentication | Cryptexa')
@section('hide-header', true)

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

<!-- HEADER BAR -->
<div class="settings-header" style="
    background: linear-gradient(135deg, #020617, #0f172a);
    border-bottom: 1px solid rgba(56,189,248,0.2);
    backdrop-filter: blur(10px);
    padding: 12px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 100;
">
    <a href="{{ route('login') }}" class="back-btn" style="
        width: 36px;
        height: 36px;
        background: rgba(56,189,248,0.1);
        border: 1px solid rgba(56,189,248,0.2);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    ">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7" />
        </svg>
    </a>
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Verify Login</h6>
    <span style="width: 36px;"></span>
</div>

<!-- MAIN CONTENT -->
<div style="
    background: linear-gradient(135deg, #020617 0%, #0f172a 100%);
    min-height: 100vh;
    padding-top: 80px;
    padding-bottom: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
">
    <div class="tf-container" style="max-width: 500px; margin: 0 auto; padding: 0 16px;">

        <div style="animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 28px; margin: 0 0 12px 0; text-align: center;">Enter Security Code</h1>
            <p style="color: #94a3b8; font-size: 14px; margin: 0 0 28px 0; text-align: center;">Enter the 6-digit code from your authenticator app</p>
        </div>

        <!-- VERIFICATION CARD -->
        <div style="
            background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
            border: 1px solid rgba(56,189,248,0.15);
            border-radius: 16px;
            padding: 32px 24px;
            backdrop-filter: blur(10px);
            animation: slideUp 0.6s ease 0.1s backwards;
        ">

            <!-- ICON -->
            <div style="text-align: center; margin-bottom: 24px;">
                <div style="
                    width: 64px;
                    height: 64px;
                    background: rgba(56,189,248,0.15);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto;
                ">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
            </div>

            <!-- INPUT FIELD -->
            <div style="margin-bottom: 24px;">
                <label style="color: #94a3b8; font-size: 12px; font-weight: 600; display: block; margin-bottom: 8px;">
                    Authenticator Code
                </label>
                <input type="text"
                    id="verificationCode"
                    maxlength="6"
                    inputmode="numeric"
                    placeholder="000000"
                    style="
                        width: 100%;
                        padding: 16px;
                        border-radius: 12px;
                        background: rgba(255,255,255,0.02);
                        border: 1px solid rgba(56,189,248,0.2);
                        color: #e5e7eb;
                        font-size: 24px;
                        letter-spacing: 8px;
                        text-align: center;
                        font-weight: 600;
                        transition: all 0.3s ease;
                    "
                    onfocus="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='rgba(56,189,248,0.05)'; this.style.boxShadow='0 0 20px rgba(56,189,248,0.1)';"
                    onblur="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='rgba(255,255,255,0.02)'; this.style.boxShadow='none';">
                <p id="codeError" style="color: #ef4444; font-size: 12px; margin: 8px 0 0 0; display: none;"></p>
            </div>

            <!-- VERIFY BUTTON -->
            <button onclick="verifyLoginCode()" style="
                width: 100%;
                padding: 14px;
                border-radius: 12px;
                background: linear-gradient(135deg, rgba(56,189,248,0.2) 0%, rgba(56,189,248,0.1) 100%);
                border: 1px solid rgba(56,189,248,0.3);
                color: #38bdf8;
                font-weight: 600;
                font-size: 16px;
                cursor: pointer;
                transition: all 0.3s ease;
                margin-bottom: 12px;
            " onmouseover="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.3) 0%, rgba(56,189,248,0.15) 100%)'; this.style.boxShadow='0 0 20px rgba(56,189,248,0.2)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.2) 0%, rgba(56,189,248,0.1) 100%)'; this.style.boxShadow='none';">
                ✓ Verify & Login
            </button>

            <!-- BACK TO LOGIN -->
            <a href="{{ route('login') }}" style="
                display: block;
                text-align: center;
                color: #94a3b8;
                font-size: 13px;
                text-decoration: none;
                transition: all 0.3s ease;
                padding: 12px;
            " onmouseover="this.style.color='#e5e7eb';" onmouseout="this.style.color='#94a3b8';">
                ← Back to Login
            </a>

        </div>

    </div>
</div>

<!-- STYLES -->
<style>
    .tf-container {
        max-width: 900px;
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
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    input[type="text"]::-webkit-outer-spin-button,
    input[type="text"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<!-- SCRIPTS -->
<script>
    function verifyLoginCode() {
        const code = document.getElementById('verificationCode').value;
        const errorDiv = document.getElementById('codeError');

        if (code.length !== 6) {
            errorDiv.textContent = 'Please enter a 6-digit code';
            errorDiv.style.display = 'block';
            return;
        }

        const btn = event.target;
        btn.disabled = true;
        btn.innerHTML = '⏳ Verifying...';

        fetch('{{ route("two-factor.login.verify") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    code
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Verified!',
                        text: 'Redirecting to dashboard...',
                        confirmButtonColor: '#38bdf8',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then(() => {
                        window.location.href = data.redirect;
                    });
                } else {
                    errorDiv.textContent = data.message || 'Invalid code';
                    errorDiv.style.display = 'block';
                    btn.disabled = false;
                    btn.innerHTML = '✓ Verify & Login';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorDiv.textContent = 'An error occurred. Please try again.';
                errorDiv.style.display = 'block';
                btn.disabled = false;
                btn.innerHTML = '✓ Verify & Login';
            });
    }

    // Auto-format verification code input
    document.getElementById('verificationCode').addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        document.getElementById('codeError').style.display = 'none';
    });

    // Allow Enter key to submit
    document.getElementById('verificationCode').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            verifyLoginCode();
        }
    });
</script>

@endsection