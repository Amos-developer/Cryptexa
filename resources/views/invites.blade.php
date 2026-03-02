@extends('layouts.app')

@section('title', 'Referral Program | Cryptexa')
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
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Referral Program</h6>
    <span style="width: 36px;"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%);">
    <div class="tf-container">

        <!-- HERO SECTION -->
        <div class="mb-32" style="animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 32px; margin: 0 0 12px 0;">Invite & Earn</h1>
            <p class="text-secondary" style="font-size: 14px; margin: 0;">
                Share your referral link and earn <span style="color: #22c55e; font-weight: 600;">20% commission</span> on every order your referrals place
            </p>
        </div>

        <!-- REFERRAL INFO CARD -->
        <div style="
            background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
            border: 1px solid rgba(56,189,248,0.15);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(56,189,248,0.05), inset 0 0 20px rgba(56,189,248,0.03);
            backdrop-filter: blur(10px);
            margin-bottom: 24px;
            animation: slideUp 0.6s ease 0.1s backwards;
        ">
            <!-- REFERRAL CODE -->
            <div class="mb-20">
                <label style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;">Your Referral Code</label>
                <div style="
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    background: rgba(255,255,255,0.02);
                    padding: 12px 14px;
                    border-radius: 12px;
                    border: 1px solid rgba(56,189,248,0.2);
                ">
                    <span style="color: #e5e7eb; font-weight: 700; font-size: 16px; flex: 1; font-family: 'Courier New', monospace;">
                        {{ auth()->user()->referral_code }}
                    </span>
                    <button type="button" onclick="copyCode('{{ auth()->user()->referral_code }}')"
                        style="
                            background: rgba(56,189,248,0.1);
                            border: 1px solid rgba(56,189,248,0.2);
                            color: #38bdf8;
                            padding: 8px 14px;
                            border-radius: 8px;
                            font-size: 12px;
                            font-weight: 600;
                            cursor: pointer;
                            transition: all 0.3s ease;
                        "
                        onmouseover="this.style.background='rgba(56,189,248,0.2)'; this.style.borderColor='rgba(56,189,248,0.4)';"
                        onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.2)';">
                        Copy
                    </button>
                </div>
            </div>

            <!-- REFERRAL LINK -->
            @php
            $refLink = url('/register?ref=' . auth()->user()->referral_code);
            @endphp
            <div>
                <label style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;">Your Referral Link</label>
                <div style="
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    background: rgba(255,255,255,0.02);
                    padding: 12px 14px;
                    border-radius: 12px;
                    border: 1px solid rgba(56,189,248,0.2);
                ">
                    <span style="color: #9ca3af; font-size: 12px; flex: 1; word-break: break-all; font-family: 'Courier New', monospace;">
                        {{ $refLink }}
                    </span>
                    <button type="button" onclick="copyReferralLink()"
                        style="
                            background: rgba(56,189,248,0.1);
                            border: 1px solid rgba(56,189,248,0.2);
                            color: #38bdf8;
                            padding: 8px 14px;
                            border-radius: 8px;
                            font-size: 12px;
                            font-weight: 600;
                            cursor: pointer;
                            transition: all 0.3s ease;
                        "
                        onmouseover="this.style.background='rgba(56,189,248,0.2)'; this.style.borderColor='rgba(56,189,248,0.4)';"
                        onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.2)';">
                        Copy
                    </button>
                </div>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div style="
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 24px;
            animation: slideUp 0.6s ease 0.2s backwards;
        ">
            <button type="button" onclick="copyReferralLink()"
                style="
                    background: linear-gradient(135deg, rgba(56,189,248,0.15) 0%, rgba(56,189,248,0.05) 100%);
                    border: 1px solid rgba(56,189,248,0.3);
                    color: #38bdf8;
                    padding: 14px 20px;
                    border-radius: 12px;
                    font-weight: 600;
                    font-size: 14px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                "
                onmouseover="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.2) 0%, rgba(56,189,248,0.1) 100%)'; this.style.boxShadow='0 0 20px rgba(56,189,248,0.2)';"
                onmouseout="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15) 0%, rgba(56,189,248,0.05) 100%)'; this.style.boxShadow='none';">
                📋 Copy Link
            </button>

            <button type="button" onclick="shareReferralLink()"
                style="
                    background: linear-gradient(135deg, rgba(34,197,94,0.15) 0%, rgba(34,197,94,0.05) 100%);
                    border: 1px solid rgba(34,197,94,0.3);
                    color: #22c55e;
                    padding: 14px 20px;
                    border-radius: 12px;
                    font-weight: 600;
                    font-size: 14px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                "
                onmouseover="this.style.background='linear-gradient(135deg, rgba(34,197,94,0.2) 0%, rgba(34,197,94,0.1) 100%)'; this.style.boxShadow='0 0 20px rgba(34,197,94,0.2)';"
                onmouseout="this.style.background='linear-gradient(135deg, rgba(34,197,94,0.15) 0%, rgba(34,197,94,0.05) 100%)'; this.style.boxShadow='none';">
                📤 Share Now
            </button>
        </div>

        <!-- STATS CARDS -->
        <div style="
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 24px;
            animation: slideUp 0.6s ease 0.3s backwards;
        ">
            <!-- INVITED USERS CARD -->
            <div style="
                background: linear-gradient(135deg, rgba(168,85,247,0.08) 0%, rgba(168,85,247,0.02) 100%);
                border: 1px solid rgba(168,85,247,0.15);
                border-radius: 14px;
                padding: 20px;
                box-shadow: 0 10px 30px rgba(168,85,247,0.05), inset 0 0 20px rgba(168,85,247,0.03);
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            "
                onmouseover="this.style.borderColor='rgba(168,85,247,0.3)'; this.style.boxShadow='0 10px 30px rgba(168,85,247,0.1), inset 0 0 20px rgba(168,85,247,0.05)';"
                onmouseout="this.style.borderColor='rgba(168,85,247,0.15)'; this.style.boxShadow='0 10px 30px rgba(168,85,247,0.05), inset 0 0 20px rgba(168,85,247,0.03)';">
                <p style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 8px 0;">👥 Invited Users</p>
                <h3 style="color: #e5e7eb; font-size: 32px; font-weight: 900; margin: 0;">
                    {{ auth()->user()->referrals()->count() }}
                </h3>
            </div>

            <!-- EARNINGS CARD -->
            <div style="
                background: linear-gradient(135deg, rgba(34,197,94,0.08) 0%, rgba(34,197,94,0.02) 100%);
                border: 1px solid rgba(34,197,94,0.15);
                border-radius: 14px;
                padding: 20px;
                box-shadow: 0 10px 30px rgba(34,197,94,0.05), inset 0 0 20px rgba(34,197,94,0.03);
                backdrop-filter: blur(10px);
                transition: all 0.3s ease;
            "
                onmouseover="this.style.borderColor='rgba(34,197,94,0.3)'; this.style.boxShadow='0 10px 30px rgba(34,197,94,0.1), inset 0 0 20px rgba(34,197,94,0.05)';"
                onmouseout="this.style.borderColor='rgba(34,197,94,0.15)'; this.style.boxShadow='0 10px 30px rgba(34,197,94,0.05), inset 0 0 20px rgba(34,197,94,0.03)';">
                <p style="color: #94a3b8; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin: 0 0 8px 0;">💰 Total Earnings</p>
                <h3 style="color: #22c55e; font-size: 32px; font-weight: 900; margin: 0;">
                    ${{ number_format(auth()->user()->referral_earnings ?? 0, 2) }}
                </h3>
            </div>
        </div>

        <!-- HOW IT WORKS SECTION -->
        <div style="
            background: linear-gradient(135deg, rgba(251,191,36,0.08) 0%, rgba(251,191,36,0.02) 100%);
            border: 1px solid rgba(251,191,36,0.15);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(251,191,36,0.05), inset 0 0 20px rgba(251,191,36,0.03);
            backdrop-filter: blur(10px);
            animation: slideUp 0.6s ease 0.4s backwards;
        ">
            <h5 style="color: #fbbf24; font-weight: 700; font-size: 16px; margin: 0 0 16px 0;">🚀 How It Works</h5>

            <div style="display: grid; gap: 14px;">
                <!-- STEP 1 -->
                <div style="display: flex; gap: 14px;">
                    <div style="
                        width: 32px;
                        height: 32px;
                        border-radius: 8px;
                        background: rgba(251,191,36,0.15);
                        border: 1px solid rgba(251,191,36,0.3);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                    ">
                        <span style="color: #fbbf24; font-weight: 700; font-size: 14px;">1</span>
                    </div>
                    <div>
                        <p style="color: #e5e7eb; font-weight: 600; font-size: 14px; margin: 0 0 4px 0;">Share Your Link</p>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">Send your unique referral link to friends and colleagues</p>
                    </div>
                </div>

                <!-- STEP 2 -->
                <div style="display: flex; gap: 14px;">
                    <div style="
                        width: 32px;
                        height: 32px;
                        border-radius: 8px;
                        background: rgba(251,191,36,0.15);
                        border: 1px solid rgba(251,191,36,0.3);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                    ">
                        <span style="color: #fbbf24; font-weight: 700; font-size: 14px;">2</span>
                    </div>
                    <div>
                        <p style="color: #e5e7eb; font-weight: 600; font-size: 14px; margin: 0 0 4px 0;">They Register & Deposit</p>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">Your referrals sign up using your link and make their first deposit</p>
                    </div>
                </div>

                <!-- STEP 3 -->
                <div style="display: flex; gap: 14px;">
                    <div style="
                        width: 32px;
                        height: 32px;
                        border-radius: 8px;
                        background: rgba(251,191,36,0.15);
                        border: 1px solid rgba(251,191,36,0.3);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                    ">
                        <span style="color: #fbbf24; font-weight: 700; font-size: 14px;">3</span>
                    </div>
                    <div>
                        <p style="color: #e5e7eb; font-weight: 600; font-size: 14px; margin: 0 0 4px 0;">Earn 20% Commission</p>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">Receive 20% commission on every order they complete</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- ANIMATIONS & STYLES -->

<!-- JS -->
<script>
    function copyCode(code) {
        navigator.clipboard.writeText(code);

        Swal.fire({
            icon: 'success',
            title: 'Copied',
            text: 'Referral code copied successfully',
            timer: 1500,
            showConfirmButton: false,
            background: '#020617',
            color: '#e5e7eb'
        });
    }

    function copyReferralLink() {
        navigator.clipboard.writeText("{{ $refLink }}");

        Swal.fire({
            icon: 'success',
            title: 'Copied',
            text: 'Referral link copied successfully',
            timer: 1500,
            showConfirmButton: false,
            background: '#020617',
            color: '#e5e7eb'
        });
    }

    function shareReferralLink() {
        if (navigator.share) {
            navigator.share({
                title: 'Join Cryptexa',
                text: 'Register using my referral link and start earning',
                url: "{{ $refLink }}"
            });
        } else {
            copyReferralLink();
        }
    }
</script>

@endsection
