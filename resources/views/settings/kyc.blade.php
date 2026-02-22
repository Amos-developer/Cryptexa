@extends('layouts.app')

@section('hide-header', true)
@section('title', 'KYC Verification | Cryptexa')

@section('content')

<div class="header fixed-top d-flex justify-content-between align-items-center px-16"
    style="background: linear-gradient(135deg, #020617, #0f172a); border-bottom: 1px solid rgba(56,189,248,0.2); backdrop-filter: blur(10px); z-index: 100; padding: 12px 16px;">
    <a href="{{ route('account.settings') }}"
        style="width: 36px; height: 36px; background: rgba(56,189,248,0.1); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"
        onmouseover="this.style.background='rgba(56,189,248,0.15)'; this.style.borderColor='rgba(56,189,248,0.4)';"
        onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.2)';">
        <i class="icon-left-btn" style="color: #38bdf8; font-size: 18px;"></i>
    </a>
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">KYC Verification</h6>
    <span style="width: 36px;"></span>
</div>

<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh;">
    <div class="tf-container">
        <div style="text-align: center; margin-bottom: 32px; animation: slideDown 0.6s ease;">
            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #fbbf24, #f59e0b); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 40px;">🔐</div>
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 28px; margin: 0 0 8px 0;">Identity Verification</h1>
            <p style="color: #94a3b8; font-size: 14px; margin: 0;">Complete KYC to unlock full features</p>
        </div>

        <div style="background: linear-gradient(135deg, rgba(251,191,36,0.05), rgba(251,191,36,0.02)); border: 1px solid rgba(251,191,36,0.15); border-radius: 16px; padding: 24px; margin-bottom: 24px; animation: slideUp 0.6s ease 0.1s backwards;">
            <div style="display: flex; gap: 12px; margin-bottom: 16px;">
                <span style="color: #fbbf24; font-size: 20px;">⚠️</span>
                <div>
                    <h3 style="color: #fbbf24; font-weight: 700; font-size: 15px; margin: 0 0 8px 0;">Verification Required</h3>
                    <p style="color: #94a3b8; font-size: 13px; margin: 0; line-height: 1.6;">To comply with regulations and ensure platform security, please complete identity verification.</p>
                </div>
            </div>
        </div>

        @php
        $steps = [
            ['title' => 'Personal Information', 'desc' => 'Full name, date of birth, address', 'icon' => '👤', 'status' => 'pending'],
            ['title' => 'Identity Document', 'desc' => 'Passport, ID card, or driver license', 'icon' => '📄', 'status' => 'pending'],
            ['title' => 'Selfie Verification', 'desc' => 'Take a photo holding your ID', 'icon' => '📸', 'status' => 'pending'],
            ['title' => 'Review & Approval', 'desc' => 'We will review within 24-48 hours', 'icon' => '✅', 'status' => 'pending'],
        ];
        @endphp

        <div style="margin-bottom: 24px;">
            <h3 style="color: #38bdf8; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 16px 0;">Verification Steps</h3>
            <div style="display: grid; gap: 12px;">
                @foreach($steps as $index => $step)
                <div style="
                    display: flex;
                    align-items: center;
                    gap: 16px;
                    padding: 16px;
                    background: linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.02));
                    border: 1px solid rgba(255,255,255,0.06);
                    border-radius: 12px;
                    animation: slideIn 0.5s ease {{ 0.1 * $index }}s backwards;
                ">
                    <div style="width: 48px; height: 48px; background: rgba(56,189,248,0.1); border: 1px solid rgba(56,189,248,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0;">{{ $step['icon'] }}</div>
                    <div style="flex: 1;">
                        <div style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin-bottom: 4px;">{{ $index + 1 }}. {{ $step['title'] }}</div>
                        <div style="color: #64748b; font-size: 13px;">{{ $step['desc'] }}</div>
                    </div>
                    <div style="background: rgba(148,163,184,0.2); color: #94a3b8; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Pending</div>
                </div>
                @endforeach
            </div>
        </div>

        <div style="background: linear-gradient(135deg, rgba(56,189,248,0.08), rgba(56,189,248,0.03)); border: 1px solid rgba(56,189,248,0.2); border-radius: 16px; padding: 24px; margin-bottom: 24px; animation: slideUp 0.6s ease 0.5s backwards;">
            <h3 style="color: #38bdf8; font-weight: 700; font-size: 15px; margin: 0 0 12px 0;">Benefits of Verification</h3>
            <div style="display: grid; gap: 12px;">
                <div style="display: flex; gap: 12px; align-items: start;">
                    <span style="color: #22c55e; font-weight: 700; font-size: 16px;">✓</span>
                    <span style="color: #94a3b8; font-size: 13px;">Higher withdrawal limits</span>
                </div>
                <div style="display: flex; gap: 12px; align-items: start;">
                    <span style="color: #22c55e; font-weight: 700; font-size: 16px;">✓</span>
                    <span style="color: #94a3b8; font-size: 13px;">Access to premium features</span>
                </div>
                <div style="display: flex; gap: 12px; align-items: start;">
                    <span style="color: #22c55e; font-weight: 700; font-size: 16px;">✓</span>
                    <span style="color: #94a3b8; font-size: 13px;">Enhanced account security</span>
                </div>
                <div style="display: flex; gap: 12px; align-items: start;">
                    <span style="color: #22c55e; font-weight: 700; font-size: 16px;">✓</span>
                    <span style="color: #94a3b8; font-size: 13px;">Priority customer support</span>
                </div>
            </div>
        </div>

        <button style="
            width: 100%;
            background: linear-gradient(135deg, #38bdf8, #0ea5e9);
            color: #020617;
            padding: 16px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            border: none;
            cursor: pointer;
            box-shadow: 0 0 30px rgba(56,189,248,0.4);
            transition: all 0.3s ease;
            animation: slideUp 0.6s ease 0.6s backwards;
        "
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 0 40px rgba(56,189,248,0.6)';"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 0 30px rgba(56,189,248,0.4)';">
            Start Verification Process
        </button>
    </div>
</div>

<style>
    @keyframes slideDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: translateX(-15px); } to { opacity: 1; transform: translateX(0); } }
    @media (max-width: 768px) {
        .pt-80 { padding-top: 80px !important; }
        h1[style*="font-size: 28px"] { font-size: 24px !important; }
    }
</style>

@endsection
