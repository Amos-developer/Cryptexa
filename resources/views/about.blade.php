@extends('layouts.app')

@section('hide-header', true)
@section('title', 'About Cryptexa | Cryptexa')

@section('content')

<div class="header fixed-top d-flex justify-content-between align-items-center px-16"
    style="background: linear-gradient(135deg, #020617, #0f172a); border-bottom: 1px solid rgba(56,189,248,0.2); backdrop-filter: blur(10px); z-index: 100; padding: 12px 16px;">
    <a href="{{ route('account.settings') }}"
        style="width: 36px; height: 36px; background: rgba(56,189,248,0.1); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"
        onmouseover="this.style.background='rgba(56,189,248,0.15)'; this.style.borderColor='rgba(56,189,248,0.4)';"
        onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.2)';">
        <i class="icon-left-btn" style="color: #38bdf8; font-size: 18px;"></i>
    </a>
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">About Cryptexa</h6>
    <span style="width: 36px;"></span>
</div>

<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh;">
    <div class="tf-container">

        <!-- Hero Section -->
        <div style="text-align: center; margin-bottom: 40px; animation: slideDown 0.6s ease;">
            <!-- <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #38bdf8, #0ea5e9); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 20px 60px rgba(56,189,248,0.3); font-size: 40px;">💎</div> -->
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 32px; margin: 0 0 12px 0; line-height: 1.2;">
                Welcome to <span style="background: linear-gradient(135deg, #38bdf8, #0ea5e9); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Cryptexa</span>
            </h1>
            <p style="color: #94a3b8; font-size: 14px; max-width: 500px; margin: 0 auto; line-height: 1.6;">
                Your trusted platform for cryptocurrency investments and cloud mining operations
            </p>
        </div>

        <!-- Stats Grid -->
        <!-- <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 32px; animation: slideUp 0.6s ease 0.1s backwards;">
            <div style="background: linear-gradient(135deg, rgba(56,189,248,0.08), rgba(56,189,248,0.02)); border: 1px solid rgba(56,189,248,0.2); border-radius: 12px; padding: 20px 16px; text-align: center;">
                <h3 style="color: #38bdf8; font-weight: 900; font-size: 28px; margin: 0 0 4px 0;">{{ number_format(\App\Models\User::count()) }}+</h3>
                <p style="color: #94a3b8; font-size: 12px; margin: 0;">Active Users</p>
            </div>
            <div style="background: linear-gradient(135deg, rgba(34,197,94,0.08), rgba(34,197,94,0.02)); border: 1px solid rgba(34,197,94,0.2); border-radius: 12px; padding: 20px 16px; text-align: center;">
                <h3 style="color: #22c55e; font-weight: 900; font-size: 28px; margin: 0 0 4px 0;">${{ number_format(\App\Models\Deposit::where('status', 'completed')->sum('amount'), 0) }}+</h3>
                <p style="color: #94a3b8; font-size: 12px; margin: 0;">Total Deposits</p>
            </div>
            <div style="background: linear-gradient(135deg, rgba(168,85,247,0.08), rgba(168,85,247,0.02)); border: 1px solid rgba(168,85,247,0.2); border-radius: 12px; padding: 20px 16px; text-align: center;">
                <h3 style="color: #a855f7; font-weight: 900; font-size: 28px; margin: 0 0 4px 0;">24/7</h3>
                <p style="color: #94a3b8; font-size: 12px; margin: 0;">Support</p>
            </div>
        </div> -->

        <!-- Mission -->
        <div style="background: linear-gradient(135deg, rgba(56,189,248,0.05), rgba(56,189,248,0.02)); border: 1px solid rgba(56,189,248,0.15); border-radius: 16px; padding: 24px; margin-bottom: 20px; animation: slideUp 0.6s ease 0.2s backwards;">
            <h2 style="color: #38bdf8; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 12px 0;">🎯 Our Mission</h2>
            <h3 style="color: #e5e7eb; font-weight: 800; font-size: 20px; margin: 0 0 12px 0;">Making Crypto Mining Accessible</h3>
            <p style="color: #94a3b8; font-size: 14px; line-height: 1.7; margin: 0;">
                Cryptexa provides a secure and user-friendly platform for cryptocurrency investments. We offer cloud mining services, daily check-in rewards, lucky box prizes, and a comprehensive referral system to help you grow your crypto portfolio.
            </p>
        </div>

        <!-- Features -->
        <div style="background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01)); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; padding: 24px; margin-bottom: 20px; animation: slideUp 0.6s ease 0.3s backwards;">
            <h2 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0 0 20px 0;">✨ Platform Features</h2>
            <div style="display: grid; gap: 16px;">
                <div style="display: flex; gap: 16px; padding: 16px; background: rgba(56,189,248,0.05); border-radius: 12px;">
                    <div style="width: 48px; height: 48px; background: rgba(56,189,248,0.15); border: 1px solid rgba(56,189,248,0.3); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0;">⛏️</div>
                    <div>
                        <h4 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 6px 0;">Cloud Mining Pools</h4>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0; line-height: 1.5;">Invest in high-performance mining pools with daily returns ranging from 1.5% to 3.5%</p>
                    </div>
                </div>
                <div style="display: flex; gap: 16px; padding: 16px; background: rgba(34,197,94,0.05); border-radius: 12px;">
                    <div style="width: 48px; height: 48px; background: rgba(34,197,94,0.15); border: 1px solid rgba(34,197,94,0.3); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0;">✅</div>
                    <div>
                        <h4 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 6px 0;">Daily Check-in Rewards</h4>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0; line-height: 1.5;">Earn daily bonuses with streak multipliers - the longer you check in, the more you earn</p>
                    </div>
                </div>
                <div style="display: flex; gap: 16px; padding: 16px; background: rgba(251,191,36,0.05); border-radius: 12px;">
                    <div style="width: 48px; height: 48px; background: rgba(251,191,36,0.15); border: 1px solid rgba(251,191,36,0.3); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0;">🎁</div>
                    <div>
                        <h4 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 6px 0;">Lucky Box System</h4>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0; line-height: 1.5;">Open mystery boxes for a chance to win bonus rewards and prizes</p>
                    </div>
                </div>
                <div style="display: flex; gap: 16px; padding: 16px; background: rgba(168,85,247,0.05); border-radius: 12px;">
                    <div style="width: 48px; height: 48px; background: rgba(168,85,247,0.15); border: 1px solid rgba(168,85,247,0.3); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0;">👥</div>
                    <div>
                        <h4 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 6px 0;">Referral Program</h4>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0; line-height: 1.5;">Earn 8% commission on direct referrals and 3% on second-level referrals</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security -->
        <div style="background: linear-gradient(135deg, rgba(168,85,247,0.05), rgba(168,85,247,0.02)); border: 1px solid rgba(168,85,247,0.15); border-radius: 16px; padding: 24px; margin-bottom: 20px; animation: slideUp 0.6s ease 0.4s backwards;">
            <h2 style="color: #a855f7; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 16px 0;">🔐 Security First</h2>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
                <div style="text-align: center;">
                    <div style="width: 48px; height: 48px; background: rgba(56,189,248,0.15); border: 1px solid rgba(56,189,248,0.3); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-size: 20px;">🔒</div>
                    <h4 style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 6px 0;">2FA Auth</h4>
                    <p style="color: #94a3b8; font-size: 12px; margin: 0;">Two-factor authentication</p>
                </div>
                <div style="text-align: center;">
                    <div style="width: 48px; height: 48px; background: rgba(34,197,94,0.15); border: 1px solid rgba(34,197,94,0.3); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-size: 20px;">🔑</div>
                    <h4 style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 6px 0;">PIN Protection</h4>
                    <p style="color: #94a3b8; font-size: 12px; margin: 0;">Withdrawal PIN security</p>
                </div>
                <div style="text-align: center;">
                    <div style="width: 48px; height: 48px; background: rgba(251,191,36,0.15); border: 1px solid rgba(251,191,36,0.3); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-size: 20px;">📧</div>
                    <h4 style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 6px 0;">Email Verify</h4>
                    <p style="color: #94a3b8; font-size: 12px; margin: 0;">Account verification</p>
                </div>
            </div>
        </div>

        <!-- Payment Methods -->
        <div style="background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01)); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; padding: 24px; margin-bottom: 20px; animation: slideUp 0.6s ease 0.5s backwards;">
            <h2 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0 0 16px 0;">💳 Supported Cryptocurrencies</h2>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(56,189,248,0.05); border-radius: 10px;">
                    <div style="width: 36px; height: 36px; background: rgba(56,189,248,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 18px;">₿</div>
                    <div>
                        <div style="color: #e5e7eb; font-weight: 600; font-size: 14px;">Bitcoin</div>
                        <div style="color: #64748b; font-size: 11px;">BTC</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(34,197,94,0.05); border-radius: 10px;">
                    <div style="width: 36px; height: 36px; background: rgba(34,197,94,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 18px;">Ξ</div>
                    <div>
                        <div style="color: #e5e7eb; font-weight: 600; font-size: 14px;">Ethereum</div>
                        <div style="color: #64748b; font-size: 11px;">ETH</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(251,191,36,0.05); border-radius: 10px;">
                    <div style="width: 36px; height: 36px; background: rgba(251,191,36,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 18px;">Ł</div>
                    <div>
                        <div style="color: #e5e7eb; font-weight: 600; font-size: 14px;">Litecoin</div>
                        <div style="color: #64748b; font-size: 11px;">LTC</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: rgba(168,85,247,0.05); border-radius: 10px;">
                    <div style="width: 36px; height: 36px; background: rgba(168,85,247,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 18px;">💲</div>
                    <div>
                        <div style="color: #e5e7eb; font-weight: 600; font-size: 14px;">USDT</div>
                        <div style="color: #64748b; font-size: 11px;">TRC20 & BEP20</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact -->
        <div style="background: linear-gradient(135deg, rgba(56,189,248,0.05), rgba(56,189,248,0.02)); border: 1px solid rgba(56,189,248,0.15); border-radius: 16px; padding: 24px; text-align: center; animation: slideUp 0.6s ease 0.6s backwards;">
            <h2 style="color: #38bdf8; font-weight: 700; font-size: 16px; margin: 0 0 12px 0;">📧 Get in Touch</h2>
            <p style="color: #94a3b8; font-size: 14px; margin: 0 0 16px 0;">Have questions? Our support team is here to help 24/7</p>
            <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                <a href="mailto:support@cryptexa.com" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: rgba(56,189,248,0.15); border: 1px solid rgba(56,189,248,0.3); border-radius: 10px; color: #38bdf8; font-size: 14px; font-weight: 600; text-decoration: none; transition: all 0.3s;">
                    📧 Email Support
                </a>
            </div>
        </div>

        <!-- Footer Note -->
        <div style="text-align: center; margin-top: 32px; padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.06);">
            <p style="color: #64748b; font-size: 13px; margin: 0 0 8px 0;">© {{ date('Y') }} Cryptexa. All rights reserved.</p>
            <p style="color: #475569; font-size: 12px; margin: 0;">Version 1.0.0 | Powered by Blockchain Technology</p>
        </div>

    </div>
</div>

<style>
    @keyframes slideDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @media (max-width: 768px) {
        .pt-80 { padding-top: 80px !important; }
        h1[style*="font-size: 32px"] { font-size: 26px !important; }
        [style*="grid-template-columns: repeat(3, 1fr)"] { grid-template-columns: 1fr !important; }
        [style*="grid-template-columns: repeat(2, 1fr)"] { grid-template-columns: 1fr !important; }
        [style*="font-size: 28px"] { font-size: 24px !important; }
    }
</style>

@endsection
