@extends('layouts.app')

@section('title', 'Account Settings | Cryptexa')
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
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Account Settings</h6>
    <span style="width: 36px;"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-32 pb-24" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%);">
    <div class="tf-container">

        @php
        $sections = [
        [
        'title' => 'Security & Access',
        'items' => [
        [
        'icon' => '🔐',
        'title' => 'Account Password',
        'desc' => 'Change login password',
        'color' => 'rgba(236,72,153,',
        'link' => route('account.password')
        ],
        [
        'icon' => '🔒',
        'title' => 'Two-Factor Authentication',
        'desc' => 'Add extra security layer',
        'color' => 'rgba(34,211,238,',
        'link' => '#'
        ],
        [
        'icon' => '🛡️',
        'title' => 'Withdrawal Password',
        'desc' => 'Secure withdrawal requests',
        'color' => 'rgba(245,158,11,',
        'link' => '#'
        ]
        ]
        ],
        [
        'title' => 'Account Verification',
        'items' => [
        [
        'icon' => '✓',
        'title' => 'KYC Verification',
        'desc' => 'Identity verification',
        'color' => 'rgba(250,204,21,',
        'link' => '#'
        ],
        [
        'icon' => '👤',
        'title' => 'Account Mode',
        'desc' => 'Switch between Demo / Live',
        'color' => 'rgba(139,92,246,',
        'link' => '#',
        'badge' => 'LIVE'
        ]
        ]
        ],
        [
        'title' => 'Withdrawal Management',
        'items' => [
        [
        'icon' => '💳',
        'title' => 'Withdrawal Method',
        'desc' => 'Bank account or wallet',
        'color' => 'rgba(34,197,94,',
        'link' => '#'
        ]
        ]
        ],
        [
        'title' => 'System Information',
        'items' => [
        [
        'icon' => '⏰',
        'title' => 'System Time',
        'desc' => now()->timezone(config('app.timezone'))->format('Y-m-d H:i:s'),
        'color' => 'rgba(56,189,248,',
        'link' => '#'
        ],
        [
        'icon' => '📱',
        'title' => 'Download App',
        'desc' => 'iOS & Android',
        'color' => 'rgba(52,211,153,',
        'link' => '#'
        ],
        [
        'icon' => 'ℹ️',
        'title' => 'About Us',
        'desc' => 'Company information',
        'color' => 'rgba(148,163,184,',
        'link' => route('about')
        ]
        ]
        ]
        ];
        @endphp

        @foreach($sections as $sectionIndex => $section)
        <!-- SECTION HEADER -->
        <div style="
            margin-bottom: 12px;
            margin-top: {{ $sectionIndex === 0 ? '0' : '24px' }};
            animation: slideDown 0.6s ease {{ $sectionIndex * 0.1 }}s backwards;
        ">
            <h3 style="color: #e5e7eb; font-size: 16px; font-weight: 700; margin: 0 0 12px 0;">
                {{ $section['title'] }}
            </h3>

            <!-- SETTINGS CARDS GRID -->
            <div style="display: grid; gap: 10px;">
                @foreach($section['items'] as $itemIndex => $item)
                <a href="{{ $item['link'] }}"
                    style="
                        display: flex;
                        align-items: center;
                        gap: 14px;
                        padding: 16px;
                        background: linear-gradient(135deg, {{ $item['color'] }}0.08) 0%, {{ $item['color'] }}0.02) 100%);
                        border: 1px solid {{ $item['color'] }}0.15);
                        border-radius: 12px;
                        text-decoration: none;
                        transition: all 0.3s ease;
                        animation: slideUp 0.6s ease {{ (0.2 + ($sectionIndex * 0.1) + ($itemIndex * 0.08)) }}s backwards;
                    "
                    onmouseover="this.style.borderColor='{{ $item['color'] }}0.3)'; this.style.background='linear-gradient(135deg, {{ $item['color'] }}0.12) 0%, {{ $item['color'] }}0.05) 100%)'; this.style.boxShadow='0 0 20px {{ $item['color'] }}0.15)';"
                    onmouseout="this.style.borderColor='{{ $item['color'] }}0.15)'; this.style.background='linear-gradient(135deg, {{ $item['color'] }}0.08) 0%, {{ $item['color'] }}0.02) 100%)'; this.style.boxShadow='none';">

                    <!-- ICON -->
                    <div style="
                        width: 44px;
                        height: 44px;
                        border-radius: 10px;
                        background: {{ $item['color'] }}0.1);
                        border: 1px solid {{ $item['color'] }}0.2);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                        font-size: 20px;
                    ">
                        {{ $item['icon'] }}
                    </div>

                    <!-- INFO -->
                    <div style="flex: 1;">
                        <p style="color: #e5e7eb; font-weight: 600; font-size: 14px; margin: 0 0 4px 0;">
                            {{ $item['title'] }}
                        </p>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">
                            {{ $item['desc'] }}
                        </p>
                    </div>

                    <!-- BADGE & ARROW -->
                    <div style="display: flex; align-items: center; gap: 8px;">
                        @if(isset($item['badge']))
                        <span style="
                            background: rgba(34,197,94,0.15);
                            color: #22c55e;
                            padding: 4px 10px;
                            border-radius: 999px;
                            font-size: 10px;
                            font-weight: 700;
                        ">
                            {{ $item['badge'] }}
                        </span>
                        @endif
                        <i class="icon icon-right-arrow" style="color: #64748b; font-size: 14px;"></i>
                    </div>

                </a>
                @endforeach
            </div>
        </div>
        @endforeach

        <!-- LOGOUT BUTTON AT BOTTOM -->
        <!-- <div style="margin-top: 40px; padding: 0 16px; display: flex; justify-content: center; animation: slideUp 0.6s ease 0.5s backwards;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    padding: 14px 24px;
                    background: linear-gradient(135deg, rgba(236,72,153,0.15), rgba(34,211,238,0.15));
                    color: #ffffff;
                    font-weight: 700;
                    font-size: 14px;
                    border: none;
                    border-radius: 12px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                "
                    onmouseover="this.style.background='linear-gradient(135deg, rgba(236,72,153,0.25), rgba(34,211,238,0.25))'; this.style.boxShadow='0 6px 16px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.background='linear-gradient(135deg, rgba(236,72,153,0.15), rgba(34,211,238,0.15))'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.15)';">
                    <span>🚪</span>
                    <span>Logout</span>
                </button>
            </form>
        </div> -->

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

    /* MOBILE RESPONSIVE */
    @media (max-width: 768px) {
        .pt-32 {
            padding-top: 20px !important;
        }

        .pb-24 {
            padding-bottom: 60px !important;
        }

        h1 {
            font-size: 24px !important;
        }

        h3 {
            font-size: 14px !important;
        }

        [style*="padding: 16px"] {
            padding: 14px !important;
        }

        [style*="gap: 14px"] {
            gap: 12px !important;
        }

        [style*="gap: 10px"] {
            gap: 8px !important;
        }

        [style*="width: 44px"] {
            width: 40px !important;
            height: 40px !important;
            font-size: 18px !important;
        }

        p {
            font-size: 12px !important;
        }

        button[type="submit"] {
            width: 100%;
            justify-content: center;
            padding: 14px;
            font-size: 13px;
        }
    }

    /* TABLET RESPONSIVE */
    @media (min-width: 769px) and (max-width: 1024px) {
        h1 {
            font-size: 26px !important;
        }

        h3 {
            font-size: 15px !important;
        }
    }
</style>

@endsection