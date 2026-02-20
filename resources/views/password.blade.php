@extends('layouts.app')

@section('title', 'Change Password | Cryptexa')
@section('hide-header', true)

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
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Change Password</h6>
    <span style="width: 36px;"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%);">
    <div class="tf-container">

        <!-- PAGE HEADER -->
        <div class="mb-32" style="animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 32px; margin: 0 0 12px 0;">Update Password</h1>
            <p class="text-secondary" style="font-size: 14px; margin: 0;">Keep your account secure by changing your password regularly</p>
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
                        🔓 Current Password
                    </label>
                    <input type="password"
                        name="current_password"
                        placeholder="Enter your current password"
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
                        🔐 New Password
                    </label>
                    <input type="password"
                        name="password"
                        placeholder="Enter your new password"
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
                        ✓ Confirm Password
                    </label>
                    <input type="password"
                        name="password_confirmation"
                        placeholder="Confirm your new password"
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
                    🔒 Update Password
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
            <h6 style="color: #22c55e; font-weight: 700; font-size: 14px; margin: 0 0 12px 0;">💡 Password Security Tips</h6>
            <ul style="color: #94a3b8; font-size: 12px; padding-left: 16px; margin: 0; line-height: 1.8;">
                <li>Use at least 8 characters with uppercase, lowercase, and numbers</li>
                <li>Never share your password with anyone, including support staff</li>
                <li>Avoid using personal information or common words</li>
                <li>Change your password regularly for enhanced security</li>
            </ul>
        </div>

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

    input::placeholder {
        color: #64748b !important;
    }

    /* MOBILE RESPONSIVE */
    @media (max-width: 768px) {
        .pt-80 {
            padding-top: 80px !important;
        }

        .pb-80 {
            padding-bottom: 60px !important;
        }

        .mb-32 h1 {
            font-size: 24px !important;
        }

        .mb-32 {
            margin-bottom: 20px !important;
        }

        [style*="padding: 28px"] {
            padding: 20px !important;
        }

        [style*="padding: 14px"] {
            padding: 12px !important;
        }

        .mb-20 {
            margin-bottom: 16px !important;
        }

        .mb-24 {
            margin-bottom: 20px !important;
        }

        ul {
            font-size: 11px !important;
        }
    }

    /* TABLET RESPONSIVE */
    @media (min-width: 769px) and (max-width: 1024px) {
        .mb-32 h1 {
            font-size: 28px !important;
        }

        [style*="padding: 28px"] {
            padding: 24px !important;
        }
    }
</style>

@endsection