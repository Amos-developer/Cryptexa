@extends('layouts.app')

@section('title', 'About Us | Cryptexa')
@section('hide-header', true)

@section('content')

<!-- MAIN CONTENT -->
<div class="pt-40 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%);">
    <div class="tf-container">

        <!-- PAGE HEADER -->
        <div class="mb-40" style="animation: slideDown 0.6s ease; text-align: center;">
            <h6 class="text-secondary mb-3" style="font-size: 13px; letter-spacing: 0.5px; text-transform: uppercase;">About Cryptexa</h6>
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 42px; margin: 0; line-height: 1.2;">
                Empowering the Future of <span style="background: linear-gradient(135deg, #38bdf8, #0ea5e9); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Decentralized Compute</span>
            </h1>
            <p class="text-secondary mt-16" style="font-size: 14px; max-width: 600px; margin-left: auto; margin-right: auto;">
                We're building the next generation of blockchain-based compute infrastructure, where transparency and innovation drive everything we do.
            </p>
        </div>

        <!-- MISSION SECTION -->
        <div style="
            background: linear-gradient(135deg, rgba(56,189,248,0.05) 0%, rgba(56,189,248,0.02) 100%);
            border: 1px solid rgba(56,189,248,0.15);
            border-radius: 24px;
            padding: 36px;
            margin-bottom: 32px;
            box-shadow: 0 20px 60px rgba(56,189,248,0.08), inset 0 0 30px rgba(56,189,248,0.04);
            backdrop-filter: blur(10px);
            animation: slideUp 0.6s ease 0.1s backwards;
        ">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">
                <!-- Left Content -->
                <div>
                    <h5 style="color: #38bdf8; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 16px 0;">Our Mission</h5>
                    <h2 style="color: #e5e7eb; font-weight: 800; font-size: 28px; margin: 0 0 20px 0; line-height: 1.3;">
                        Democratizing Access to Computing Power
                    </h2>
                    <p class="text-secondary" style="font-size: 14px; line-height: 1.6; margin-bottom: 16px;">
                        Cryptexa is revolutionizing how compute resources are distributed and monetized. By leveraging blockchain technology, we're creating a transparent, trustless marketplace where users can lease AI and cloud computing resources globally.
                    </p>
                    <p class="text-secondary" style="font-size: 14px; line-height: 1.6;">
                        Our platform eliminates intermediaries, reduces costs, and ensures fair compensation for resource providers while delivering reliable compute power to enterprises and developers worldwide.
                    </p>
                </div>
                <!-- Right Stats -->
                <div style="display: grid; grid-template-rows: 1fr 1fr; gap: 20px;">
                    <div style="
                        background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
                        border: 1px solid rgba(56,189,248,0.2);
                        border-radius: 16px;
                        padding: 24px;
                        text-align: center;
                    ">
                        <h3 style="color: #38bdf8; font-weight: 900; font-size: 32px; margin: 0 0 8px 0;">100K+</h3>
                        <p class="text-secondary" style="font-size: 13px; margin: 0;">Active Users</p>
                    </div>
                    <div style="
                        background: linear-gradient(135deg, rgba(34,197,94,0.08) 0%, rgba(34,197,94,0.02) 100%);
                        border: 1px solid rgba(34,197,94,0.2);
                        border-radius: 16px;
                        padding: 24px;
                        text-align: center;
                    ">
                        <h3 style="color: #22c55e; font-weight: 900; font-size: 32px; margin: 0 0 8px 0;">$50M+</h3>
                        <p class="text-secondary" style="font-size: 13px; margin: 0;">Total Compute Volume</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- VALUES SECTION -->
        <div style="
            background: linear-gradient(135deg, rgba(56,189,248,0.05) 0%, rgba(56,189,248,0.02) 100%);
            border: 1px solid rgba(56,189,248,0.15);
            border-radius: 24px;
            padding: 36px;
            margin-bottom: 32px;
            box-shadow: 0 20px 60px rgba(56,189,248,0.08), inset 0 0 30px rgba(56,189,248,0.04);
            backdrop-filter: blur(10px);
            animation: slideUp 0.6s ease 0.2s backwards;
        ">
            <h5 style="color: #38bdf8; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 24px 0;">Our Values</h5>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
                <!-- Transparency -->
                <div style="
                    background: rgba(255,255,255,0.02);
                    border: 1px solid rgba(255,255,255,0.08);
                    border-radius: 16px;
                    padding: 24px;
                    text-align: center;
                    transition: all 0.3s ease;
                    animation: slideIn 0.6s ease 0.3s backwards;
                "
                    onmouseover="this.style.borderColor='rgba(56,189,248,0.3)'; this.style.background='rgba(56,189,248,0.05)';"
                    onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'; this.style.background='rgba(255,255,255,0.02)';">
                    <div style="
                        width: 60px;
                        height: 60px;
                        background: rgba(56,189,248,0.15);
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: 0 auto 16px;
                        border: 1px solid rgba(56,189,248,0.3);
                        font-size: 24px;
                    ">🔍</div>
                    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 10px 0;">Transparency</h6>
                    <p class="text-secondary" style="font-size: 13px; margin: 0;">Full visibility into all transactions and compute metrics</p>
                </div>

                <!-- Innovation -->
                <div style="
                    background: rgba(255,255,255,0.02);
                    border: 1px solid rgba(255,255,255,0.08);
                    border-radius: 16px;
                    padding: 24px;
                    text-align: center;
                    transition: all 0.3s ease;
                    animation: slideIn 0.6s ease 0.4s backwards;
                "
                    onmouseover="this.style.borderColor='rgba(168,85,247,0.3)'; this.style.background='rgba(168,85,247,0.05)';"
                    onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'; this.style.background='rgba(255,255,255,0.02)';">
                    <div style="
                        width: 60px;
                        height: 60px;
                        background: rgba(168,85,247,0.15);
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: 0 auto 16px;
                        border: 1px solid rgba(168,85,247,0.3);
                        font-size: 24px;
                    ">⚡</div>
                    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 10px 0;">Innovation</h6>
                    <p class="text-secondary" style="font-size: 13px; margin: 0;">Cutting-edge technology at the forefront of blockchain</p>
                </div>

                <!-- Security -->
                <div style="
                    background: rgba(255,255,255,0.02);
                    border: 1px solid rgba(255,255,255,0.08);
                    border-radius: 16px;
                    padding: 24px;
                    text-align: center;
                    transition: all 0.3s ease;
                    animation: slideIn 0.6s ease 0.5s backwards;
                "
                    onmouseover="this.style.borderColor='rgba(34,197,94,0.3)'; this.style.background='rgba(34,197,94,0.05)';"
                    onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'; this.style.background='rgba(255,255,255,0.02)';">
                    <div style="
                        width: 60px;
                        height: 60px;
                        background: rgba(34,197,94,0.15);
                        border-radius: 12px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: 0 auto 16px;
                        border: 1px solid rgba(34,197,94,0.3);
                        font-size: 24px;
                    ">🔐</div>
                    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin: 0 0 10px 0;">Security</h6>
                    <p class="text-secondary" style="font-size: 13px; margin: 0;">Enterprise-grade security protecting user assets</p>
                </div>
            </div>
        </div>

        <!-- TEAM SECTION -->
        <div style="
            background: linear-gradient(135deg, rgba(56,189,248,0.05) 0%, rgba(56,189,248,0.02) 100%);
            border: 1px solid rgba(56,189,248,0.15);
            border-radius: 24px;
            padding: 36px;
            margin-bottom: 32px;
            box-shadow: 0 20px 60px rgba(56,189,248,0.08), inset 0 0 30px rgba(56,189,248,0.04);
            backdrop-filter: blur(10px);
            animation: slideUp 0.6s ease 0.3s backwards;
        ">
            <h5 style="color: #38bdf8; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 24px 0;">Why Choose Us</h5>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <div style="display: flex; gap: 16px; animation: slideIn 0.6s ease 0.4s backwards;">
                    <span style="
                        width: 40px;
                        height: 40px;
                        background: rgba(56,189,248,0.2);
                        border-radius: 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                        color: #38bdf8;
                        font-weight: 700;
                        font-size: 16px;
                    ">✓</span>
                    <div>
                        <h6 style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 6px 0;">Global Network</h6>
                        <p class="text-secondary" style="font-size: 13px; margin: 0;">Access compute resources from providers worldwide</p>
                    </div>
                </div>

                <div style="display: flex; gap: 16px; animation: slideIn 0.6s ease 0.5s backwards;">
                    <span style="
                        width: 40px;
                        height: 40px;
                        background: rgba(34,197,94,0.2);
                        border-radius: 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                        color: #22c55e;
                        font-weight: 700;
                        font-size: 16px;
                    ">✓</span>
                    <div>
                        <h6 style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 6px 0;">Competitive Pricing</h6>
                        <p class="text-secondary" style="font-size: 13px; margin: 0;">Get the best rates without middleman markup</p>
                    </div>
                </div>

                <div style="display: flex; gap: 16px; animation: slideIn 0.6s ease 0.6s backwards;">
                    <span style="
                        width: 40px;
                        height: 40px;
                        background: rgba(168,85,247,0.2);
                        border-radius: 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                        color: #a855f7;
                        font-weight: 700;
                        font-size: 16px;
                    ">✓</span>
                    <div>
                        <h6 style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 6px 0;">24/7 Support</h6>
                        <p class="text-secondary" style="font-size: 13px; margin: 0;">Round-the-clock assistance for all your needs</p>
                    </div>
                </div>

                <div style="display: flex; gap: 16px; animation: slideIn 0.6s ease 0.7s backwards;">
                    <span style="
                        width: 40px;
                        height: 40px;
                        background: rgba(251,191,36,0.2);
                        border-radius: 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                        color: #fbbf24;
                        font-weight: 700;
                        font-size: 16px;
                    ">✓</span>
                    <div>
                        <h6 style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 6px 0;">API Integration</h6>
                        <p class="text-secondary" style="font-size: 13px; margin: 0;">Seamless integration with your existing infrastructure</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA SECTION -->
        <div style="
            background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.03) 100%);
            border: 1px solid rgba(56,189,248,0.2);
            border-radius: 24px;
            padding: 40px;
            text-align: center;
            animation: slideUp 0.6s ease 0.4s backwards;
        ">
            <h2 style="color: #e5e7eb; font-weight: 800; font-size: 28px; margin: 0 0 16px 0;">Ready to Join Our Community?</h2>
            <p class="text-secondary" style="font-size: 14px; margin: 0 0 24px 0;">Start leasing or providing compute resources today</p>
            <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('login') }}"
                    style="
                    background: linear-gradient(135deg, #38bdf8, #0ea5e9);
                    color: #020617;
                    padding: 12px 28px;
                    border-radius: 12px;
                    font-weight: 700;
                    font-size: 14px;
                    text-decoration: none;
                    border: none;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    box-shadow: 0 0 20px rgba(56,189,248,0.3);
                    display: inline-block;
                "
                    onmouseover="this.style.boxShadow='0 0 30px rgba(56,189,248,0.5)'; this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.boxShadow='0 0 20px rgba(56,189,248,0.3)'; this.style.transform='translateY(0)';">
                    Get Started
                </a>
                <a href="{{ route('contact') }}"
                    style="
                    background: rgba(56,189,248,0.1);
                    color: #38bdf8;
                    padding: 12px 28px;
                    border-radius: 12px;
                    font-weight: 700;
                    font-size: 14px;
                    text-decoration: none;
                    border: 1px solid rgba(56,189,248,0.3);
                    cursor: pointer;
                    transition: all 0.3s ease;
                    display: inline-block;
                "
                    onmouseover="this.style.background='rgba(56,189,248,0.15)'; this.style.borderColor='rgba(56,189,248,0.5)';"
                    onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.3)';">
                    Contact Us
                </a>
            </div>
        </div>

        <!-- Footer Text -->
        <div style="text-align: center; margin-top: 40px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.08);">
            <p class="text-secondary" style="font-size: 12px; margin: 0;">
                © {{ date('Y') }} Cryptexa. All rights reserved. |
                <a href="#" style="color: #38bdf8; text-decoration: none;">Privacy Policy</a> |
                <a href="#" style="color: #38bdf8; text-decoration: none;">Terms of Service</a>
            </p>
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

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-15px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
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

    /* MOBILE RESPONSIVE */
    @media (max-width: 768px) {
        .pt-40 {
            padding-top: 20px !important;
        }

        .pb-80 {
            padding-bottom: 60px !important;
        }

        .mb-40 {
            margin-bottom: 24px !important;
        }

        .mb-40 h1 {
            font-size: 28px !important;
        }

        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
            gap: 20px !important;
        }

        [style*="grid-template-columns: repeat(3, 1fr)"] {
            grid-template-columns: 1fr !important;
            gap: 16px !important;
        }

        [style*="padding: 36px"] {
            padding: 20px !important;
        }

        [style*="padding: 40px"] {
            padding: 24px !important;
        }

        h2[style*="font-size: 28px"] {
            font-size: 22px !important;
        }

        [style*="gap: 40px"] {
            gap: 24px !important;
        }

        [style*="gap: 30px"] {
            gap: 18px !important;
        }

        .mt-16 {
            margin-top: 12px !important;
        }
    }

    /* TABLET RESPONSIVE */
    @media (min-width: 769px) and (max-width: 1024px) {
        [style*="grid-template-columns: repeat(3, 1fr)"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }

        .mb-40 h1 {
            font-size: 32px !important;
        }
    }
</style>

@endsection