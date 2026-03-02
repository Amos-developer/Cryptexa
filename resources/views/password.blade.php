@extends('layouts.app')

@section('title', 'Change Password | Cryptexa')
@section('hide-header', true)

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('content')

@php
    // Force set locale from user language
    if (auth()->check() && auth()->user()->language) {
        app()->setLocale(auth()->user()->language);
    }
@endphp

<!-- HEADER BAR -->
<div class="header fixed-top d-flex justify-content-between align-items-center"
    style="
        height: 56px;
        background: linear-gradient(135deg, #020617, #0f172a);
        border-bottom: 1px solid rgba(56,189,248,0.2);
        backdrop-filter: blur(10px);
        z-index: 100;
        padding: 0 16px;
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
            color: #38bdf8;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        "
        onmouseover="this.style.background='rgba(56,189,248,0.15)'; this.style.borderColor='rgba(56,189,248,0.4)';"
        onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.2)';">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7" />
        </svg>
    </a>
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">{{ __t('change_password') }}</h6>
    <span style="width: 36px;"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="margin-top:60px; background: linear-gradient(135deg, #020617 0%, #0f172a 100%);">
    <div class="tf-container">

        <!-- PAGE HEADER -->
        <div class="mb-32" style="animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 32px; margin: 0 0 12px 0;">{{ __t('update_password') }}</h1>
            <p class="text-secondary" style="font-size: 14px; margin: 0;">{{ __t('keep_account_secure') }}</p>
        </div>

        <!-- PASSWORD FORM CARD -->
        <div style="
            background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
            border: 1px solid rgba(56,189,248,0.15);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(56,189,248,0.05), inset 0 0 20px rgba(56,189,248,0.03);
            backdrop-filter: blur(10px);
            animation: slideUp 0.6s ease 0.1s backwards;
        ">

            <form method="POST" action="{{ route('account.password.update') }}">
                @csrf

                <!-- CURRENT PASSWORD -->
                <div class="mb-20">
                    <label style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;">
                        🔓 {{ __t('current_password') }}
                    </label>
                    <input type="password"
                        name="current_password"
                        placeholder="{{ __t('enter_current_password') }}"
                        required
                        style="
                            width: 100%;
                            padding: 14px;
                            border-radius: 12px;
                            background: rgba(255,255,255,0.02);
                            border: 1px solid rgba(56,189,248,0.2);
                            color: #e5e7eb;
                            font-size: 14px;
                            transition: all 0.3s ease;
                        "
                        onfocus="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='rgba(56,189,248,0.05)';"
                        onblur="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='rgba(255,255,255,0.02)';">
                    @error('current_password')
                    <small style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- NEW PASSWORD -->
                <div class="mb-20">
                    <label style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;">
                        🔐 {{ __t('new_password') }}
                    </label>
                    <input type="password"
                        name="password"
                        placeholder="{{ __t('enter_new_password') }}"
                        required
                        style="
                            width: 100%;
                            padding: 14px;
                            border-radius: 12px;
                            background: rgba(255,255,255,0.02);
                            border: 1px solid rgba(56,189,248,0.2);
                            color: #e5e7eb;
                            font-size: 14px;
                            transition: all 0.3s ease;
                        "
                        onfocus="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='rgba(56,189,248,0.05)';"
                        onblur="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='rgba(255,255,255,0.02)';">
                    @error('password')
                    <small style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- CONFIRM PASSWORD -->
                <div class="mb-24">
                    <label style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;">
                        ✓ {{ __t('confirm_password') }}
                    </label>
                    <input type="password"
                        name="password_confirmation"
                        placeholder="{{ __t('confirm_new_password') }}"
                        required
                        style="
                            width: 100%;
                            padding: 14px;
                            border-radius: 12px;
                            background: rgba(255,255,255,0.02);
                            border: 1px solid rgba(56,189,248,0.2);
                            color: #e5e7eb;
                            font-size: 14px;
                            transition: all 0.3s ease;
                        "
                        onfocus="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='rgba(56,189,248,0.05)';"
                        onblur="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='rgba(255,255,255,0.02)';">
                    @error('password_confirmation')
                    <small style="color: #ef4444; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</small>
                    @enderror
                </div>

                <!-- SUBMIT BUTTON -->
                <button type="submit"
                    style="
                        width: 100%;
                        margin-top: 12px;
                        padding: 14px;
                        border-radius: 12px;
                        background: linear-gradient(135deg, rgba(56,189,248,0.2) 0%, rgba(56,189,248,0.1) 100%);
                        border: 1px solid rgba(56,189,248,0.3);
                        color: #38bdf8;
                        font-weight: 600;
                        font-size: 14px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    "
                    onmouseover="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.3) 0%, rgba(56,189,248,0.15) 100%)'; this.style.boxShadow='0 0 20px rgba(56,189,248,0.2)';"
                    onmouseout="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.2) 0%, rgba(56,189,248,0.1) 100%)'; this.style.boxShadow='none';">
                    🔒 {{ __t('update_password_btn') }}
                </button>

            </form>

        </div>

        <!-- SECURITY TIPS -->
        <div style="
            background: linear-gradient(135deg, rgba(34,197,94,0.08) 0%, rgba(34,197,94,0.02) 100%);
            border: 1px solid rgba(34,197,94,0.15);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(34,197,94,0.05), inset 0 0 20px rgba(34,197,94,0.03);
            backdrop-filter: blur(10px);
            margin-top: 24px;
            animation: slideUp 0.6s ease 0.2s backwards;
        ">
            <h6 style="color: #22c55e; font-weight: 700; font-size: 14px; margin: 0 0 12px 0;">💡 {{ __t('password_security_tips') }}</h6>
            <ul style="color: #94a3b8; font-size: 12px; padding-left: 16px; margin: 0; line-height: 1.8;">
                <li>{{ __t('password_tip_1') }}</li>
                <li>{{ __t('password_tip_2') }}</li>
                <li>{{ __t('password_tip_3') }}</li>
                <li>{{ __t('password_tip_4') }}</li>
            </ul>
        </div>

    </div>
</div>

<!-- ANIMATIONS & STYLES -->
<script>
    // Validate password requirements in real-time
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.querySelector('input[name="password"]');

        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;

                // Check length (8+)
                const lengthCheck = password.length >= 8;
                updateRequirement('req-length', lengthCheck);

                // Check uppercase
                const uppercaseCheck = /[A-Z]/.test(password);
                updateRequirement('req-uppercase', uppercaseCheck);

                // Check lowercase
                const lowercaseCheck = /[a-z]/.test(password);
                updateRequirement('req-lowercase', lowercaseCheck);

                // Check number
                const numberCheck = /\d/.test(password);
                updateRequirement('req-number', numberCheck);

                // Check special character
                const specialCheck = /[!@#$%^&*()_+\-=\[\]{};:\'",.<>?\/\\|`~]/.test(password);
                updateRequirement('req-special', specialCheck);
            });
        }

        function updateRequirement(id, isValid) {
            const element = document.getElementById(id);
            if (isValid) {
                element.style.color = '#22c55e';
                element.textContent = element.textContent.replace('✗', '✓');
            } else {
                element.style.color = '#94a3b8';
                element.textContent = element.textContent.replace('✓', '✗');
            }
        }
    });

    // Handle form submission with SweetAlert
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form[action*="account.password.update"]');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerHTML;

                // Disable button
                submitBtn.disabled = true;
                submitBtn.innerHTML = '⏳ {{ __t('updating') }}';

                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            // Clear form
                            form.reset();

                            // Show success alert
                            Swal.fire({
                                icon: 'success',
                                title: '{{ __t('password_updated') }}',
                                text: '{{ __t('password_changed_successfully') }}',
                                confirmButtonText: '{{ __t('ok') }}',
                                confirmButtonColor: '#38bdf8',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then(() => {
                                // Page stays on same URL
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = originalBtnText;
                            });
                        } else {
                            return response.json().then(data => {
                                throw new Error(data.message || 'An error occurred');
                            });
                        }
                    })
                    .catch(error => {
                        // Show error alert
                        const errors = error.message || '{{ __t('error_occurred_try_again') }}';

                        Swal.fire({
                            icon: 'error',
                            title: '{{ __t('update_failed') }}',
                            text: errors,
                            confirmButtonText: '{{ __t('ok') }}',
                            confirmButtonColor: '#ef4444',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        }).then(() => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalBtnText;
                        });
                    });
            });
        }
    });
</script>

@endsection
