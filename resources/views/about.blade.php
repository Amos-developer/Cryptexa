@extends('layouts.app')

@section('hide-header', true)
@section('title', 'About Cryptexa | Cryptexa')

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
    <a href="{{ route('account.settings') }}"
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
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">About Cryptexa</h6>
    <span style="width: 36px;"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh;">
    <div class="tf-container">

        <!-- HERO SECTION -->
        <div style="text-align: center; margin-bottom: 48px; animation: slideDown 0.6s ease;">
            <div style="
                width: 80px;
                height: 80px;
                background: linear-gradient(135deg, #38bdf8, #0ea5e9);
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 24px;
                box-shadow: 0 20px 60px rgba(56,189,248,0.3);
                font-size: 40px;
            ">💎</div>
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 36px; margin: 0 0 16px 0; line-height: 1.2;">
                Empowering the Future of <br><span style="background: linear-gradient(135deg, #38bdf8, #0ea5e9); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Decentralized Computing</span>
            </h1>
            <p style="color: #94a3b8; font-size: 15px; max-width: 600px; margin: 0 auto; line-height: 1.6;">
                Building the next generation of blockchain-based compute infrastructure where transparency and innovation drive everything we do.
            </p>
        </div>

        <!-- STATS GRID -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 40px; animation: slideUp 0.6s ease 0.1s backwards;">
            <div style="
                background: linear-gradient(135deg, rgba(56,189,248,0.08), rgba(56,189,248,0.02));
                border: 1px solid rgba(56,189,248,0.2);
                border-radius: 16px;
                padding: 24px;
                text-align: center;
            ">
                <h3 style="color: #38bdf8; font-weight: 900; font-size: 32px; margin: 0 0 8px 0;">150K+</h3>
                <p style="color: #94a3b8; font-size: 13px; margin: 0;">Active Users</p>
            </div>
            <div style="
                background: linear-gradient(135deg, rgba(34,197,94,0.08), rgba(34,197,94,0.02));
                border: 1px solid rgba(34,197,94,0.2);
                border-radius: 16px;
                padding: 24px;
                text-align: center;
            ">
                <h3 style="color: #22c55e; font-weight: 900; font-size: 32px; margin: 0 0 8px 0;">$80M+</h3>
                <p style="color: #94a3b8; font-size: 13px; margin: 0;">Total Volume</p>
            </div>
            <div style="
                background: linear-gradient(135deg, rgba(168,85,247,0.08), rgba(168,85,247,0.02));
                border: 1px solid rgba(168,85,247,0.2);
                border-radius: 16px;
                padding: 24px;
                text-align: center;
            ">
                <h3 style="color: #a855f7; font-weight: 900; font-size: 32px; margin: 0 0 8px 0;">99.9%</h3>
                <p style="color: #94a3b8; font-size: 13px; margin: 0;">Uptime</p>
            </div>
        </div>

        <!-- MISSION SECTION -->
        <div style="
            background: linear-gradient(135deg, rgba(56,189,248,0.05), rgba(56,189,248,0.02));
            border: 1px solid rgba(56,189,248,0.15);
            border-radius: 20px;
            padding: 32px;
            margin-bottom: 24px;
            animation: slideUp 0.6s ease 0.2s backwards;
        ">
            <h2 style="color: #38bdf8; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 16px 0;">🎯 Our Mission</h2>
            <h3 style="color: #e5e7eb; font-weight: 800; font-size: 24px; margin: 0 0 16px 0;">Democratizing Access to Computing Power</h3>
            <p style="color: #94a3b8; font-size: 14px; line-height: 1.7; margin: 0;">
                Cryptexa revolutionizes how compute resources are distributed and monetized. By leveraging blockchain technology, we create a transparent, trustless marketplace where users can lease AI and cloud computing resources globally. Our platform eliminates intermediaries, reduces costs, and ensures fair compensation for resource providers.
            </p>
        </div>

        <!-- VALUES SECTION -->
        <div style="
            background: linear-gradient(135deg, rgba(168,85,247,0.05), rgba(168,85,247,0.02));
            border: 1px solid rgba(168,85,247,0.15);
            border-radius: 20px;
            padding: 32px;
            margin-bottom: 24px;
            animation: slideUp 0.6s ease 0.3s backwards;
        ">
            <h2 style="color: #a855f7; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 24px 0;">⚡ Core Values</h2>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                <div style="text-align: center;">
                    <div style="
                        width: 56px;
                        height: 56px;
                        background: rgba(56,189,248,0.15);
                        border: 1px solid rgba(56,189,248,0.3);
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: 0 auto 12px;
                        font-size: 24px;
                    ">🔍</div>
                    <h4 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 8px 0;">Transparency</h4>
                    <p style="color: #94a3b8; font-size: 13px; margin: 0;">Full visibility into all transactions</p>
                </div>
                <div style="text-align: center;">
                    <div style="
                        width: 56px;
                        height: 56px;
                        background: rgba(168,85,247,0.15);
                        border: 1px solid rgba(168,85,247,0.3);
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: 0 auto 12px;
                        font-size: 24px;
                    ">⚡</div>
                    <h4 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 8px 0;">Innovation</h4>
                    <p style="color: #94a3b8; font-size: 13px; margin: 0;">Cutting-edge blockchain technology</p>
                </div>
                <div style="text-align: center;">
                    <div style="
                        width: 56px;
                        height: 56px;
                        background: rgba(34,197,94,0.15);
                        border: 1px solid rgba(34,197,94,0.3);
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: 0 auto 12px;
                        font-size: 24px;
                    ">🔐</div>
                    <h4 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 8px 0;">Security</h4>
                    <p style="color: #94a3b8; font-size: 13px; margin: 0;">Enterprise-grade protection</p>
                </div>
            </div>
        </div>

        <!-- FEATURES SECTION -->
        <div style="
            background: linear-gradient(135deg, rgba(34,197,94,0.05), rgba(34,197,94,0.02));
            border: 1px solid rgba(34,197,94,0.15);
            border-radius: 20px;
            padding: 32px;
            margin-bottom: 24px;
            animation: slideUp 0.6s ease 0.4s backwards;
        ">
            <h2 style="color: #22c55e; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 24px 0;">✨ Why Choose Us</h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div style="display: flex; gap: 12px;">
                    <span style="
                        width: 36px;
                        height: 36px;
                        background: rgba(56,189,248,0.2);
                        border-radius: 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                        color: #38bdf8;
                        font-weight: 700;
                    ">✓</span>
                    <div>
                        <h5 style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 4px 0;">Global Network</h5>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">Access resources worldwide</p>
                    </div>
                </div>
                <div style="display: flex; gap: 12px;">
                    <span style="
                        width: 36px;
                        height: 36px;
                        background: rgba(34,197,94,0.2);
                        border-radius: 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                        color: #22c55e;
                        font-weight: 700;
                    ">✓</span>
                    <div>
                        <h5 style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 4px 0;">Best Pricing</h5>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">No middleman markup</p>
                    </div>
                </div>
                <div style="display: flex; gap: 12px;">
                    <span style="
                        width: 36px;
                        height: 36px;
                        background: rgba(168,85,247,0.2);
                        border-radius: 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                        color: #a855f7;
                        font-weight: 700;
                    ">✓</span>
                    <div>
                        <h5 style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 4px 0;">24/7 Support</h5>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">Round-the-clock assistance</p>
                    </div>
                </div>
                <div style="display: flex; gap: 12px;">
                    <span style="
                        width: 36px;
                        height: 36px;
                        background: rgba(251,191,36,0.2);
                        border-radius: 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                        color: #fbbf24;
                        font-weight: 700;
                    ">✓</span>
                    <div>
                        <h5 style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 4px 0;">Easy Integration</h5>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">Seamless API access</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA SECTION -->
        <div style="
            background: linear-gradient(135deg, rgba(56,189,248,0.08), rgba(56,189,248,0.03));
            border: 1px solid rgba(56,189,248,0.2);
            border-radius: 20px;
            padding: 32px;
            text-align: center;
            animation: slideUp 0.6s ease 0.5s backwards;
        ">
            <h2 style="color: #e5e7eb; font-weight: 800; font-size: 24px; margin: 0 0 12px 0;">Ready to Get Started?</h2>
            <p style="color: #94a3b8; font-size: 14px; margin: 0 0 24px 0;">Join thousands of users leveraging decentralized compute power</p>
            <a href="{{ route('home') }}"
                style="
                background: linear-gradient(135deg, #38bdf8, #0ea5e9);
                color: #020617;
                padding: 14px 32px;
                border-radius: 12px;
                font-weight: 700;
                font-size: 14px;
                text-decoration: none;
                display: inline-block;
                box-shadow: 0 0 30px rgba(56,189,248,0.4);
                transition: all 0.3s ease;
            "
                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 0 40px rgba(56,189,248,0.6)';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 0 30px rgba(56,189,248,0.4)';">
                Start Now →
            </a>
        </div>

        <!-- FOOTER -->
        <div style="text-align: center; margin-top: 40px; padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.08);">
            <p style="color: #64748b; font-size: 12px; margin: 0;">
                © {{ date('Y') }} Cryptexa. All rights reserved.
            </p>
        </div>

    </div>
</div>

<style>
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .pt-80 { padding-top: 80px !important; }
        .pb-80 { padding-bottom: 60px !important; }
        
        h1[style*="font-size: 36px"] { font-size: 28px !important; }
        h2[style*="font-size: 24px"] { font-size: 20px !important; }
        h3[style*="font-size: 24px"] { font-size: 20px !important; }
        
        [style*="grid-template-columns: repeat(3, 1fr)"] {
            grid-template-columns: 1fr !important;
            gap: 12px !important;
        }
        
        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
            gap: 16px !important;
        }
        
        [style*="padding: 32px"] { padding: 20px !important; }
        [style*="padding: 24px"] { padding: 16px !important; }
        [style*="margin-bottom: 48px"] { margin-bottom: 32px !important; }
        [style*="margin-bottom: 40px"] { margin-bottom: 24px !important; }
    }

    @media (min-width: 769px) and (max-width: 1024px) {
        [style*="grid-template-columns: repeat(3, 1fr)"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
</style>

@endsection
