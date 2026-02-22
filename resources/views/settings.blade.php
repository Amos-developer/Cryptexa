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
    <h6 class="header-title">Settings</h6>
    <span class="placeholder"></span>
</div>

<!-- MAIN CONTENT -->
<div class="settings-container">

    <!-- USER PROFILE SECTION -->
    <!-- <div class="profile-section">
        <div class="profile-card">
            <div class="profile-avatar">
                <img src="{{ asset('images/avt/avt2.jpg') }}" alt="Profile">
            </div>
            <div class="profile-info">
                <h3 class="profile-name">{{ auth()->user()->name }}</h3>
                <p class="profile-email">{{ auth()->user()->email }}</p>
                <span class="profile-badge">{{ auth()->user()->role ?? 'User' }}</span>
            </div>
        </div>
    </div> -->

    @php
    $sections = [
    [
    'title' => 'Security & Access',
    'icon' => '🔐',
    'items' => [
    [
    'icon' => 'lock',
    'title' => 'Password',
    'desc' => 'Change your login password',
    'color' => '#ec4899',
    'link' => route('account.password')
    ],
    [
    'icon' => 'shield',
    'title' => 'Two-Factor Auth',
    'desc' => 'Add extra security layer',
    'color' => '#06b6d4',
    'link' => route('two-factor.show')
    ],
    [
    'icon' => 'key',
    'title' => 'Withdrawal PIN',
    'desc' => auth()->user()->withdrawal_pin ? 'Change your withdrawal PIN' : 'Create a withdrawal PIN',
    'color' => '#f59e0b',
    'link' => auth()->user()->withdrawal_pin ? route('withdrawal-pin.change') : route('withdrawal-pin.set')
    ],
    [
    'icon' => 'credit-card',
    'title' => 'Withdrawal Method',
    'desc' => 'Set or bind your withdrawal address',
    'color' => '#22c55e',
    'link' => '#'
    ]
    ]
    ],
    [
    'title' => 'Preferences',
    'icon' => '⚙️',
    'items' => [
    [
    'icon' => 'globe',
    'title' => 'Language',
    'desc' => 'Choose your preferred language',
    'color' => '#3b82f6',
    'link' => '#',
    'action' => 'language'
    ],
    [
    'icon' => 'moon',
    'title' => 'Theme',
    'desc' => 'Dark mode is enabled',
    'color' => '#8b5cf6',
    'link' => '#'
    ],
    [
    'icon' => 'bell',
    'title' => 'Notifications',
    'desc' => 'Manage notification settings',
    'color' => '#22c55e',
    'link' => '#'
    ]
    ]
    ],
    [
    'title' => 'Account Verification',
    'icon' => '✓',
    'items' => [
    [
    'icon' => 'check-circle',
    'title' => 'KYC Verification',
    'desc' => 'Identity verification',
    'color' => '#fbbf24',
    'link' => '#'
    ],
    [
    'icon' => 'user-check',
    'title' => 'Account Mode',
    'desc' => 'Current: LIVE Mode',
    'color' => '#a855f7',
    'link' => '#',
    'badge' => 'LIVE'
    ]
    ]
    ],
    [
    'title' => 'Transaction Management',
    'icon' => '📊',
    'items' => [
    [
    'icon' => 'download',
    'title' => 'Deposit History',
    'desc' => 'View all your deposits',
    'color' => '#10b981',
    'link' => '#'
    ],
    [
    'icon' => 'upload',
    'title' => 'Withdrawal History',
    'desc' => 'View all your withdrawals',
    'color' => '#f59e0b',
    'link' => route('withdraw.history')
    ]
    ]
    ],
    [
    'title' => 'System Information',
    'icon' => '📱',
    'items' => [
    [
    'icon' => 'clock',
    'title' => 'System Time',
    'desc' => now()->timezone(config('app.timezone'))->format('Y-m-d H:i:s'),
    'color' => '#38bdf8',
    'link' => '#'
    ],
    [
    'icon' => 'download',
    'title' => 'Download App',
    'desc' => 'iOS & Android available',
    'color' => '#10b981',
    'link' => '#'
    ],
    [
    'icon' => 'info',
    'title' => 'About Cryptexa',
    'desc' => 'Company information',
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
                <span>Logout</span>
            </button>
        </form>
    </div>

</div>

<!-- LANGUAGE MODAL -->
<div id="languageModal" class="modal hidden">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Select Language</h3>
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
            // Here you can add logic to change the language
            console.log('Language selected:', btn.dataset.lang);
            setTimeout(() => closeLanguageModal(), 300);
        });
    });

    // Close modal when clicking outside
    languageModal.addEventListener('click', (e) => {
        if (e.target === languageModal) {
            closeLanguageModal();
        }
    });
</script>

@endsection