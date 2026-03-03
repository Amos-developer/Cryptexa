@extends('layouts.app')

@section('title', 'Account Settings | Cryptexa')
@section('hide-header', true)

@section('content')

<link rel="stylesheet" href="{{ asset('css/settings.css') }}">

<!-- HEADER BAR -->
<div class="settings-header">
    <a href="{{ url()->previous() }}" class="back-btn">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7" />
        </svg>
    </a>
    <h6 class="header-title">{{ __t('settings') }}</h6>
    <span class="placeholder"></span>
</div>

<!-- MAIN CONTENT -->
<div class="settings-container">

    <!-- USER PORTFOLIO CARD -->
    <div style="
        position: relative;
        background: linear-gradient(135deg, rgba(15,23,42,0.95) 0%, rgba(30,41,59,0.95) 100%);
        border: 1px solid rgba(56,189,248,0.3);
        border-radius: 20px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3), 0 0 0 1px rgba(56,189,248,0.1) inset;
        overflow: hidden;
    ">
        <!-- Animated Background Gradient -->
        <div style="
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(56,189,248,0.15) 0%, transparent 70%);
            pointer-events: none;
        "></div>
        
        <div style="position: relative; z-index: 1;">
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                <div style="
                    width: 64px;
                    height: 64px;
                    border-radius: 50%;
                    background: linear-gradient(135deg, #38bdf8 0%, #a855f7 100%);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 28px;
                    font-weight: 900;
                    color: white;
                    flex-shrink: 0;
                    box-shadow: 0 8px 24px rgba(56,189,248,0.4), 0 0 0 3px rgba(56,189,248,0.2);
                    position: relative;
                ">
                    {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
                    <div style="
                        position: absolute;
                        inset: -2px;
                        border-radius: 50%;
                        background: linear-gradient(135deg, #38bdf8, #a855f7);
                        opacity: 0.3;
                        filter: blur(8px);
                        z-index: -1;
                    "></div>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <h3 style="color: #f8fafc; font-size: 20px; font-weight: 800; margin: 0 0 6px 0; letter-spacing: -0.5px;">{{ auth()->user()->username }}</h3>
                    <p style="color: #94a3b8; font-size: 14px; margin: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ auth()->user()->email }}</p>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                <div style="
                    background: linear-gradient(135deg, rgba(56,189,248,0.1) 0%, rgba(56,189,248,0.05) 100%);
                    border: 1px solid rgba(56,189,248,0.3);
                    border-radius: 14px;
                    padding: 14px;
                    backdrop-filter: blur(10px);
                    position: relative;
                    overflow: hidden;
                ">
                    <div style="
                        position: absolute;
                        top: 0;
                        left: 0;
                        right: 0;
                        height: 2px;
                        background: linear-gradient(90deg, transparent, #38bdf8, transparent);
                    "></div>
                    <p style="color: #94a3b8; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 8px 0; font-weight: 600;">Account</p>
                    <p style="color: #38bdf8; font-size: 15px; font-weight: 800; margin: 0; font-family: monospace; letter-spacing: 0.5px;">{{ auth()->user()->account_id }}</p>
                </div>
                <div style="
                    background: linear-gradient(135deg, {{ auth()->user()->email_verified_at ? 'rgba(34,197,94,0.1)' : 'rgba(251,191,36,0.1)' }} 0%, {{ auth()->user()->email_verified_at ? 'rgba(34,197,94,0.05)' : 'rgba(251,191,36,0.05)' }} 100%);
                    border: 1px solid {{ auth()->user()->email_verified_at ? 'rgba(34,197,94,0.4)' : 'rgba(251,191,36,0.4)' }};
                    border-radius: 14px;
                    padding: 14px;
                    backdrop-filter: blur(10px);
                    position: relative;
                    overflow: hidden;
                ">
                    <div style="
                        position: absolute;
                        top: 0;
                        left: 0;
                        right: 0;
                        height: 2px;
                        background: linear-gradient(90deg, transparent, {{ auth()->user()->email_verified_at ? '#22c55e' : '#fbbf24' }}, transparent);
                    "></div>
                    <p style="color: #94a3b8; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 8px 0; font-weight: 600;">Status</p>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="
                            width: 20px;
                            height: 20px;
                            border-radius: 50%;
                            background: {{ auth()->user()->email_verified_at ? '#22c55e' : '#fbbf24' }};
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 12px;
                            color: white;
                            font-weight: 700;
                            box-shadow: 0 0 12px {{ auth()->user()->email_verified_at ? 'rgba(34,197,94,0.5)' : 'rgba(251,191,36,0.5)' }};
                        ">{{ auth()->user()->email_verified_at ? '✓' : '!' }}</div>
                        <span style="color: {{ auth()->user()->email_verified_at ? '#22c55e' : '#fbbf24' }}; font-size: 14px; font-weight: 700;">{{ auth()->user()->email_verified_at ? 'Verified' : 'Unverified' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
    $sections = [
    [
    'title' => __t('security_access'),
    'icon' => '🔐',
    'items' => [
    [
    'icon' => 'lock',
    'title' => __t('password'),
    'desc' => __t('change_login_password'),
    'color' => '#ec4899',
    'link' => route('account.password')
    ],
    [
    'icon' => 'shield',
    'title' => __t('two_factor_auth'),
    'desc' => auth()->user()->two_factor_enabled ? '✓ ' . __t('enabled') . ' - Click to manage' : __t('add_extra_security'),
    'color' => auth()->user()->two_factor_enabled ? '#10b981' : '#06b6d4',
    'link' => route('two-factor.show'),
    'badge' => auth()->user()->two_factor_enabled ? strtoupper(__t('enabled')) : null
    ],
    [
    'icon' => 'key',
    'title' => __t('withdrawal_pin'),
    'desc' => auth()->user()->withdrawal_pin ? __t('change_withdrawal_pin') : __t('create_withdrawal_pin'),
    'color' => '#f59e0b',
    'link' => auth()->user()->withdrawal_pin ? route('withdrawal-pin.change') : route('withdrawal-pin.set')
    ],
    [
    'icon' => 'credit-card',
    'title' => __t('withdrawal_method'),
    'desc' => __t('set_withdrawal_address'),
    'color' => '#22c55e',
    'link' => route('withdrawal-method')
    ]
    ]
    ],
    [
    'title' => __t('preferences'),
    'icon' => '⚙️',
    'items' => [
    // [
    // 'icon' => 'globe',
    // 'title' => __t('language'),
    // 'desc' => __t('choose_language'),
    // 'color' => '#3b82f6',
    // 'link' => route('settings.language'),
    // 'action' => 'language'
    // ],
    [
    'icon' => 'bell',
    'title' => __t('view_notifications'),
    'desc' => __t('see_all_notifications'),
    'color' => '#38bdf8',
    'link' => route('notifications')
    ],
    [
    'icon' => 'bell',
    'title' => __t('notifications'),
    'desc' => __t('manage_notifications'),
    'color' => '#22c55e',
    'link' => route('settings.notifications')
    ]
    ]
    ],
    [
    'title' => __t('transaction_management'),
    'icon' => '📊',
    'items' => [
    [
    'icon' => 'download',
    'title' => __t('deposit_history'),
    'desc' => __t('view_all_deposits'),
    'color' => '#10b981',
    'link' => route('deposit.history')
    ],
    [
    'icon' => 'upload',
    'title' => __t('withdrawal_history'),
    'desc' => __t('view_all_withdrawals'),
    'color' => '#f59e0b',
    'link' => route('withdraw.history')
    ]
    ]
    ],
    [
    'title' => __t('system_information'),
    'icon' => '📱',
    'items' => [
    [
    'icon' => 'clock',
    'title' => __t('system_time'),
    'desc' => now()->timezone(config('app.timezone'))->format('Y-m-d H:i:s'),
    'color' => '#38bdf8',
    'link' => route('settings.system-time')
    ],
    [
    'icon' => 'download',
    'title' => __t('download_app'),
    'desc' => __t('get_android_apk'),
    'color' => '#10b981',
    'link' => asset('downloads/cryptexa.apk'),
    'action' => 'download-apk'
    ],
    [
    'icon' => 'info',
    'title' => __t('about_cryptexa'),
    'desc' => __t('company_information'),
    'color' => '#94a3b8',
    'link' => route('about')
    ]
    ]
    ]
    ];
    @endphp

    @foreach($sections as $sectionIndex => $section)
    <!-- SECTION HEADER -->
    <div class="settings-section">
        <div class="section-header">
            <h3 class="section-title">{{ $section['title'] }}</h3>
        </div>

        <!-- SETTINGS CARDS GRID -->
        <div class="settings-grid">
            @foreach($section['items'] as $itemIndex => $item)
            <a href="{{ $item['link'] }}"
                class="settings-card"
                data-action="{{ $item['action'] ?? '' }}"
                style="--card-color: {{ $item['color'] }}">

                <!-- ICON -->
                <div class="card-icon">
                    @switch($item['icon'])
                    @case('lock')
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    @break
                    @case('shield')
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                    @break
                    @case('key')
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="7.5" cy="15.5" r="5.5"></circle>
                        <path d="M21 2l-9.6 9.6"></path>
                    </svg>
                    @break
                    @case('globe')
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                    </svg>
                    @break
                    @case('moon')
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                    @break
                    @case('bell')
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    @break
                    @case('check-circle')
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    @break
                    @case('user-check')
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <polyline points="17 11 19 13 23 9"></polyline>
                    </svg>
                    @break
                    @case('credit-card')
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                    @break
                    @case('clock')
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    @break
                    @case('download')
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    @break
                    @case('upload')
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                    @break
                    @case('info')
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    @break
                    @default
                    <span>{{ $item['icon'] }}</span>
                    @endswitch
                </div>

                <!-- CONTENT -->
                <div class="card-content">
                    <p class="card-title">{{ $item['title'] }}</p>
                    <p class="card-desc">{{ $item['desc'] }}</p>
                </div>

                <!-- BADGE & ARROW -->
                <div class="card-action">
                    @if(isset($item['badge']))
                    <span class="badge">{{ $item['badge'] }}</span>
                    @endif
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endforeach

    <!-- LOGOUT SECTION -->
    <div class="logout-section">
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                <span>{{ __t('logout') }}</span>
            </button>
        </form>
    </div>

</div>

<!-- LANGUAGE MODAL -->
<div id="languageModal" class="modal hidden">
    <div class="modal-content">
        <div class="modal-header">
            <h3>{{ __t('select_language') }}</h3>
            <button class="modal-close" onclick="closeLanguageModal()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="language-grid">
                <button class="language-btn active" data-lang="en">
                    <span class="flag">🇬🇧</span>
                    <span>English</span>
                </button>
                <button class="language-btn" data-lang="es">
                    <span class="flag">🇪🇸</span>
                    <span>Español</span>
                </button>
                <button class="language-btn" data-lang="fr">
                    <span class="flag">🇫🇷</span>
                    <span>Français</span>
                </button>
                <button class="language-btn" data-lang="de">
                    <span class="flag">🇩🇪</span>
                    <span>Deutsch</span>
                </button>
                <button class="language-btn" data-lang="pt">
                    <span class="flag">🇵🇹</span>
                    <span>Português</span>
                </button>
                <button class="language-btn" data-lang="zh">
                    <span class="flag">🇨🇳</span>
                    <span>中文</span>
                </button>
            </div>
        </div>
    </div>
</div>


<!-- SCRIPTS -->
<script>
    // PWA Install functionality
    let deferredPrompt;
    const installAppCard = document.querySelector('[data-action="install-app"]');

    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
        if (installAppCard) {
            installAppCard.style.display = 'flex';
        }
    });

    if (installAppCard) {
        installAppCard.addEventListener('click', async (e) => {
            e.preventDefault();
            
            if (!deferredPrompt) {
                // Show manual instructions
                alert('To install:\n\niOS: Tap Share button → Add to Home Screen\n\nAndroid: Tap Menu (⋮) → Install App or Add to Home Screen');
                return;
            }
            
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;
            
            if (outcome === 'accepted') {
                console.log('App installed');
            }
            deferredPrompt = null;
        });
    }

    // Language modal functionality
    const languageCard = document.querySelector('[data-action="language"]');
    const languageModal = document.getElementById('languageModal');
    const languageBtns = document.querySelectorAll('.language-btn');

    if (languageCard) {
        languageCard.addEventListener('click', (e) => {
            e.preventDefault();
            languageModal.classList.remove('hidden');
        });
    }

    function closeLanguageModal() {
        languageModal.classList.add('hidden');
    }

    languageBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            languageBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            console.log('Language selected:', btn.dataset.lang);
            setTimeout(() => closeLanguageModal(), 300);
        });
    });

    languageModal.addEventListener('click', (e) => {
        if (e.target === languageModal) {
            closeLanguageModal();
        }
    });
</script>

@endsection