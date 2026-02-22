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
    <a href="{{ route('account.settings') }}" class="back-btn" style="
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
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Two-Factor Auth</h6>
    <span style="width: 36px;"></span>
</div>

<!-- MAIN CONTENT -->
<div style="
    background: linear-gradient(135deg, #020617 0%, #0f172a 100%);
    min-height: 100vh;
    padding-top: 80px;
    padding-bottom: 60px;
">
    <div class="tf-container" style="max-width: 600px; margin: 0 auto; padding: 0 16px;">

        @if(auth()->user()->two_factor_enabled)
        <!-- ENABLED STATE -->
        <div style="animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 28px; margin: 0 0 12px 0;">Two-Factor Auth</h1>
            <p style="color: #94a3b8; font-size: 14px; margin: 0 0 28px 0;">Your account is protected with 2FA</p>
        </div>

        <!-- STATUS CARD -->
        <div style="
                background: linear-gradient(135deg, rgba(34,197,94,0.08) 0%, rgba(34,197,94,0.02) 100%);
                border: 1px solid rgba(34,197,94,0.15);
                border-radius: 16px;
                padding: 24px;
                margin-bottom: 24px;
                backdrop-filter: blur(10px);
                animation: slideUp 0.6s ease 0.1s backwards;
            ">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <p style="color: #22c55e; font-weight: 600; margin: 0;">Enabled</p>
            </div>
            <p style="color: #94a3b8; font-size: 13px; margin: 0; line-height: 1.6;">
                Your account is secured with two-factor authentication. You'll be asked to enter a code from your authenticator app when logging in.
            </p>
        </div>

        <!-- DISABLE BUTTON -->
        <button onclick="disableTwoFactor()" style="
                width: 100%;
                padding: 14px;
                border-radius: 12px;
                background: linear-gradient(135deg, rgba(239,68,68,0.2) 0%, rgba(239,68,68,0.1) 100%);
                border: 1px solid rgba(239,68,68,0.3);
                color: #ef4444;
                font-weight: 600;
                font-size: 14px;
                cursor: pointer;
                transition: all 0.3s ease;
                margin-bottom: 24px;
            " onmouseover="this.style.background='linear-gradient(135deg, rgba(239,68,68,0.3) 0%, rgba(239,68,68,0.15) 100%)'; this.style.boxShadow='0 0 20px rgba(239,68,68,0.2)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(239,68,68,0.2) 0%, rgba(239,68,68,0.1) 100%)'; this.style.boxShadow='none';">
            🔓 Disable Two-Factor Authentication
        </button>

        @else
        <!-- DISABLED STATE - SETUP -->
        <div style="animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 28px; margin: 0 0 12px 0;">Enable Two-Factor Auth</h1>
            <p style="color: #94a3b8; font-size: 14px; margin: 0 0 28px 0;">Protect your account with an additional security layer</p>
        </div>

        <!-- SETUP STEPS -->
        <div style="
                background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
                border: 1px solid rgba(56,189,248,0.15);
                border-radius: 16px;
                padding: 28px;
                backdrop-filter: blur(10px);
                animation: slideUp 0.6s ease 0.1s backwards;
            ">

            <!-- STEP 1: INSTALL APP -->
            <div style="margin-bottom: 28px; padding-bottom: 28px; border-bottom: 1px solid rgba(56,189,248,0.1);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                    <div style="
                            width: 32px;
                            height: 32px;
                            background: rgba(56,189,248,0.2);
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #38bdf8;
                            font-weight: 700;
                        ">1</div>
                    <h3 style="color: #e5e7eb; font-weight: 600; margin: 0;">Install Authenticator App</h3>
                </div>
                <p style="color: #94a3b8; font-size: 13px; margin: 0; line-height: 1.6; margin-left: 44px;">
                    Download an authenticator app like Google Authenticator, Microsoft Authenticator, or Authy on your phone.
                </p>
            </div>

            <!-- STEP 2: SCAN QR -->
            <div style="margin-bottom: 28px; padding-bottom: 28px; border-bottom: 1px solid rgba(56,189,248,0.1);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div style="
                            width: 32px;
                            height: 32px;
                            background: rgba(56,189,248,0.2);
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #38bdf8;
                            font-weight: 700;
                        ">2</div>
                    <h3 style="color: #e5e7eb; font-weight: 600; margin: 0;">Scan QR Code</h3>
                </div>
                <div style="margin-left: 44px;">
                    <button onclick="generateQRCode()" id="generateBtn" style="
                            padding: 10px 16px;
                            border-radius: 8px;
                            background: rgba(56,189,248,0.2);
                            border: 1px solid rgba(56,189,248,0.3);
                            color: #38bdf8;
                            font-weight: 600;
                            font-size: 13px;
                            cursor: pointer;
                            transition: all 0.3s ease;
                        " onmouseover="this.style.background='rgba(56,189,248,0.3)'" onmouseout="this.style.background='rgba(56,189,248,0.2)'">
                        📱 Generate QR Code
                    </button>
                    <div id="qrContainer" style="margin-top: 16px;"></div>
                </div>
            </div>

            <!-- STEP 3: VERIFY CODE -->
            <div>
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div style="
                            width: 32px;
                            height: 32px;
                            background: rgba(56,189,248,0.2);
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #38bdf8;
                            font-weight: 700;
                        ">3</div>
                    <h3 style="color: #e5e7eb; font-weight: 600; margin: 0;">Verify Code</h3>
                </div>
                <div style="margin-left: 44px;">
                    <label style="color: #94a3b8; font-size: 12px; font-weight: 600; display: block; margin-bottom: 8px;">
                        Enter the 6-digit code from your authenticator app:
                    </label>
                    <input type="text"
                        id="verificationCode"
                        maxlength="6"
                        inputmode="numeric"
                        placeholder="000000"
                        style="
                                width: 100%;
                                padding: 14px;
                                border-radius: 12px;
                                background: rgba(255,255,255,0.02);
                                border: 1px solid rgba(56,189,248,0.2);
                                color: #e5e7eb;
                                font-size: 18px;
                                letter-spacing: 8px;
                                text-align: center;
                                font-weight: 600;
                                transition: all 0.3s ease;
                                margin-bottom: 16px;
                            "
                        onfocus="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='rgba(56,189,248,0.05)';"
                        onblur="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='rgba(255,255,255,0.02)';">
                    <p id="codeError" style="color: #ef4444; font-size: 12px; margin: 8px 0 16px 0; display: none;"></p>
                    <button onclick="verifyTwoFactor()" style="
                            width: 100%;
                            padding: 12px;
                            border-radius: 12px;
                            background: linear-gradient(135deg, rgba(56,189,248,0.2) 0%, rgba(56,189,248,0.1) 100%);
                            border: 1px solid rgba(56,189,248,0.3);
                            color: #38bdf8;
                            font-weight: 600;
                            font-size: 14px;
                            cursor: pointer;
                            transition: all 0.3s ease;
                        " onmouseover="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.3) 0%, rgba(56,189,248,0.15) 100%)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.2) 0%, rgba(56,189,248,0.1) 100%)';">
                        ✓ Verify & Enable
                    </button>
                </div>
            </div>

        </div>

        @endif

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
    let currentSecret = null;

    function generateQRCode() {
        const btn = document.getElementById('generateBtn');
        btn.disabled = true;
        btn.innerHTML = '⏳ Generating...';

        fetch('{{ route("two-factor.generate") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                currentSecret = data.secret;
                const container = document.getElementById('qrContainer');
                container.innerHTML = `
                <div style="text-align: center;">
                    <img src="${data.qr_code}" alt="QR Code" style="width: 200px; height: 200px; border-radius: 12px; border: 2px solid rgba(56,189,248,0.2);">
                    <p style="color: #94a3b8; font-size: 12px; margin-top: 12px;">
                        Can't scan? Enter manually:<br>
                        <code style="color: #38bdf8; font-family: monospace; word-break: break-all;">${data.secret}</code>
                    </p>
                </div>
            `;
                btn.disabled = false;
                btn.innerHTML = '📱 Regenerate QR Code';
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to generate QR code',
                    confirmButtonColor: '#ef4444'
                });
                btn.disabled = false;
                btn.innerHTML = '📱 Generate QR Code';
            });
    }

    function verifyTwoFactor() {
        const code = document.getElementById('verificationCode').value;
        const errorDiv = document.getElementById('codeError');

        if (code.length !== 6) {
            errorDiv.textContent = 'Please enter a 6-digit code';
            errorDiv.style.display = 'block';
            return;
        }

        fetch('{{ route("two-factor.verify") }}', {
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
                        title: 'Two-Factor Enabled!',
                        html: `<p>Your account is now protected with 2FA.</p>
                           <p style="font-size: 12px; color: #f59e0b; margin-top: 12px;">
                               <strong>Save your recovery codes:</strong><br>
                               ${data.recovery_codes.map(code => `<code style="display: block; background: rgba(0,0,0,0.3); padding: 4px 8px; margin: 4px 0; font-family: monospace;">${code}</code>`).join('')}
                           </p>`,
                        confirmButtonColor: '#38bdf8',
                        confirmButtonText: 'OK, I\'ve saved them'
                    }).then(() => {
                        window.location.href = '{{ route("account.settings") }}';
                    });
                } else {
                    errorDiv.textContent = data.message || 'Invalid code';
                    errorDiv.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorDiv.textContent = 'An error occurred';
                errorDiv.style.display = 'block';
            });
    }

    function disableTwoFactor() {
        Swal.fire({
            icon: 'warning',
            title: 'Disable Two-Factor Auth?',
            text: 'You\'ll need to provide your password and a verification code.',
            showCancelButton: true,
            confirmButtonText: 'Continue',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#ef4444'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Verify Your Identity',
                    html: `
                        <div style="text-align: left;">
                            <label style="display: block; margin-bottom: 12px;">
                                <strong style="color: #e5e7eb;">Password</strong><br>
                                <input type="password" id="disablePassword" placeholder="Enter your password" style="
                                    width: 100%;
                                    padding: 10px;
                                    border: 1px solid rgba(56,189,248,0.2);
                                    border-radius: 8px;
                                    background: rgba(255,255,255,0.02);
                                    color: #e5e7eb;
                                    margin-top: 6px;
                                    box-sizing: border-box;
                                ">
                            </label>
                            <label style="display: block;">
                                <strong style="color: #e5e7eb;">Authenticator Code</strong><br>
                                <input type="text" id="disableCode" maxlength="6" placeholder="000000" inputmode="numeric" style="
                                    width: 100%;
                                    padding: 10px;
                                    border: 1px solid rgba(56,189,248,0.2);
                                    border-radius: 8px;
                                    background: rgba(255,255,255,0.02);
                                    color: #e5e7eb;
                                    margin-top: 6px;
                                    text-align: center;
                                    letter-spacing: 4px;
                                    box-sizing: border-box;
                                ">
                            </label>
                        </div>
                    `,
                    confirmButtonText: 'Disable',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#ef4444',
                    showCancelButton: true,
                    preConfirm: () => {
                        const password = document.getElementById('disablePassword').value;
                        const code = document.getElementById('disableCode').value;

                        if (!password || !code) {
                            Swal.showValidationMessage('Please enter both password and code');
                            return false;
                        }

                        return fetch('{{ route("two-factor.disable") }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    password,
                                    code
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (!data.success) {
                                    throw new Error(data.message);
                                }
                                return data;
                            });
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Two-Factor Disabled',
                            text: 'Your account is no longer protected with 2FA.',
                            confirmButtonColor: '#38bdf8'
                        }).then(() => {
                            window.location.href = '{{ route("account.settings") }}';
                        });
                    }
                }).catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message,
                        confirmButtonColor: '#ef4444'
                    });
                });
            }
        });
    }

    // Auto-format verification code input
    document.getElementById('verificationCode').addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        document.getElementById('codeError').style.display = 'none';
    });
</script>

@endsection