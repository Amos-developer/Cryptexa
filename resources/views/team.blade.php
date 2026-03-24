@extends('layouts.app')

@section('title', 'Referral Program | Cryptexa')
@section('hide-header', true)

@section('content')

<link rel="stylesheet" href="{{ asset('css/team.css') }}?v={{ filemtime(public_path('css/team.css')) }}">

<div class="team-container">
    <!-- HEADER BAR -->
    <div class="team-topbar">
        <a href="{{ url()->previous() }}" class="team-back">
            <span aria-hidden="true">‹</span>
        </a>
        <h1>{{ __t('my_team') }}</h1>
        <span class="placeholder"></span>
    </div>

    <!-- HERO STATS SECTION -->
    <section class="team-hero">
        <div class="team-hero__glow team-hero__glow--one"></div>
        <div class="team-hero__glow team-hero__glow--two"></div>
        <div class="team-hero__heading">
           
            <p class="team-hero__subtitle">{{ __t('earn_passive_income') }}</p>
        </div>



        <div class="team-hero__grid row g-3">
            <div class="col-6">
                <div class="team-stat-card team-stat-card--cyan">
                    <div class="team-stat-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <p class="team-stat-card__label">{{ __t('total_members') }}</p>
                    <h3 class="team-stat-card__value">{{ $totalMembers }}</h3>
                </div>
            </div>

            <div class="col-6">
                <div class="team-stat-card team-stat-card--green">
                    <div class="team-stat-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
                        </svg>
                    </div>
                    <p class="team-stat-card__label">{{ __t('active') }}</p>
                    <h3 class="team-stat-card__value">{{ $totalActiveMembers }}</h3>
                </div>
            </div>

            <div class="col-6">
                <div class="team-stat-card team-stat-card--violet">
                    <div class="team-stat-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <p class="team-stat-card__label">Team Deposits</p>
                    <h3 class="team-stat-card__value">${{ number_format($totalTeamDeposits, 2) }}</h3>
                </div>
            </div>

            <div class="col-6">
                <div class="team-stat-card team-stat-card--amber">
                    <div class="team-stat-card__icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <p class="team-stat-card__label">{{ __t('total_earnings') }}</p>
                    <h3 class="team-stat-card__value">${{ number_format($earnings, 2) }}</h3>
                </div>
            </div>
        </div>
    </section>

    <div class="team-panels">
        <!-- REFERRAL CODE SECTION -->
        <div class="referral-code-card">
            <div class="panel-head">
                <div>
                    <h3 class="panel-title">{{ __t('referral_code') }}</h3>
                    <p class="panel-text">Distribute your invite credentials and onboard new traders into your network.</p>
                </div>
            </div>

            <div class="card-content">
                <span class="card-label">{{ __t('referral_code') }}</span>
                <div class="copy-group">
                    <input id="refCode"
                        class="code-input"
                        value="{{ auth()->user()->referral_code }}"
                        readonly>
                    <button onclick="copyText(event, 'refCode')" class="copy-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="card-divider"></div>

            <div class="card-content">
                <span class="card-label">{{ __t('referral_link') }}</span>
                <div class="copy-group">
                    <input id="refLink"
                        class="code-input"
                        value="{{ url('/register?ref='.auth()->user()->referral_code) }}"
                        readonly>
                    <button onclick="copyText(event, 'refLink')" class="copy-btn copy-btn-green">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3.46-3.46a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3.46 3.46a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- SHARE BUTTONS -->
            <div class="share-head">
                <span class="card-label">Distribution Channels</span>
                <p>Push your signup link through the fastest client communication channels.</p>
            </div>
            <div class="share-buttons">
                <a target="_blank"
                    href="whatsapp://send?text={{ urlencode(__t('join_cryptexa_link').' '.url('/register?ref='.auth()->user()->referral_code)) }}"
                    class="share-btn share-whatsapp"
                    onclick="openShareApp(event, 'whatsapp://send?text={{ urlencode(__t('join_cryptexa_link').' '.url('/register?ref='.auth()->user()->referral_code)) }}', 'https://wa.me/?text={{ urlencode(__t('join_cryptexa_link').' '.url('/register?ref='.auth()->user()->referral_code)) }}')"
                    title="{{ __t('share_on_whatsapp') }}">
                    <svg width="20" height="20" viewBox="0 0 32 32" fill="none" aria-hidden="true">
                        <circle cx="16" cy="16" r="16" fill="#25D366" />
                        <path fill="#fff" d="M23.12 8.86A9.9 9.9 0 0 0 16.08 6c-5.48 0-9.94 4.45-9.95 9.94 0 1.75.46 3.46 1.32 4.97L6 26l5.26-1.37a9.95 9.95 0 0 0 4.77 1.21h.01c5.48 0 9.94-4.46 9.95-9.95A9.87 9.87 0 0 0 23.12 8.86Zm-7.08 15.3h-.01a8.27 8.27 0 0 1-4.21-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.25 8.25 0 0 1-1.28-4.37c0-4.56 3.71-8.27 8.28-8.27 2.2 0 4.28.86 5.83 2.42a8.2 8.2 0 0 1 2.42 5.84c0 4.56-3.71 8.27-8.24 8.24Zm4.54-6.2c-.25-.13-1.5-.74-1.72-.82-.23-.08-.4-.13-.57.13-.17.25-.65.82-.8.98-.14.17-.29.19-.54.07-.25-.13-1.06-.39-2.01-1.25-.74-.66-1.24-1.48-1.38-1.73-.15-.25-.02-.39.11-.52.11-.11.25-.29.37-.43.13-.15.17-.25.25-.42.09-.17.05-.31-.02-.43-.07-.13-.57-1.37-.78-1.88-.2-.48-.41-.42-.57-.42h-.48c-.17 0-.43.06-.66.31-.23.25-.87.85-.87 2.08 0 1.22.89 2.41 1.01 2.57.12.17 1.76 2.69 4.26 3.76.59.26 1.06.41 1.42.52.6.19 1.14.17 1.58.1.48-.07 1.49-.61 1.7-1.2.21-.58.21-1.08.15-1.18-.07-.1-.23-.17-.48-.3Z" />
                    </svg>
                    <span>WhatsApp</span>
                </a>
                <a target="_blank"
                    href="tg://msg_url?url={{ urlencode(url('/register?ref='.auth()->user()->referral_code)) }}&text={{ urlencode(__t('join_cryptexa_link')) }}"
                    class="share-btn share-telegram"
                    onclick="openShareApp(event, 'tg://msg_url?url={{ urlencode(url('/register?ref='.auth()->user()->referral_code)) }}&text={{ urlencode(__t('join_cryptexa_link')) }}', 'https://t.me/share/url?url={{ urlencode(url('/register?ref='.auth()->user()->referral_code)) }}&text={{ urlencode(__t('join_cryptexa_link')) }}')"
                    title="{{ __t('share_on_telegram') }}">
                    <svg width="20" height="20" viewBox="0 0 32 32" fill="none" aria-hidden="true">
                        <circle cx="16" cy="16" r="16" fill="#229ED9" />
                        <path fill="#fff" d="M23.84 9.27c.12-.77-.66-1.38-1.37-1.06L8.2 14.04c-.8.32-.75 1.48.08 1.73l2.96.89 1.15 3.61c.23.74 1.16.96 1.7.41l1.65-1.69 3.23 2.38c.62.45 1.49.11 1.62-.62l3.25-12.48ZM13 15.96l5.8-4.56c.28-.22.56.18.32.42l-4.79 5.08a1.3 1.3 0 0 0-.32.61l-.16 1.21-.85-2.76Zm1.86 3.56.24-1.78 1.32.97-1.56.81Z" />
                    </svg>
                    <span>Telegram</span>
                </a>
                <a target="_blank"
                    href="mailto:?subject={{ rawurlencode('Cryptexa Referral Invitation') }}&body={{ rawurlencode(__t('join_cryptexa_earn').' '.url('/register?ref='.auth()->user()->referral_code)) }}"
                    class="share-btn share-email"
                    title="Share via Email">
                    <svg width="20" height="20" viewBox="0 0 32 32" fill="none" aria-hidden="true">
                        <circle cx="16" cy="16" r="16" fill="#2563EB" />
                        <path fill="#fff" d="M9 10.5A2.5 2.5 0 0 1 11.5 8h9A2.5 2.5 0 0 1 23 10.5v11a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 9 21.5v-11Zm2 .43v.2l5 3.9 5-3.9v-.2a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5Zm10 2.73-4.39 3.42a1 1 0 0 1-1.22 0L11 13.66v7.84c0 .28.22.5.5.5h9a.5.5 0 0 0 .5-.5v-7.84Z" />
                    </svg>
                    <span>Email</span>
                </a>
            </div>
        </div>
    
        <!-- DEPOSIT BONUS STRUCTURE -->
        <div class="commission-section">
            <div class="panel-head">
                <div>
                    <span class="panel-kicker">Commission Board</span>
                    <h3 class="panel-title">{{ __t('commission_structure') }}</h3>
                </div>
            </div>

            <div class="section-header">
                <p>{{ __t('level_earning_system') }}</p>
            </div>

            <div class="commission-grid">
                <div class="commission-item level-1">
                    <div class="level-badge">{{ __t('level') }} 1</div>
                    <div class="commission-rate">2%</div>
                    <div class="commission-desc">{{ __t('direct_referrals') }}</div>
                </div>
                <div class="commission-item level-2">
                    <div class="level-badge">{{ __t('level') }} 2</div>
                    <div class="commission-rate">1%</div>
                    <div class="commission-desc">{{ __t('second_generation') }}</div>
                </div>
                <div class="commission-item level-3">
                    <div class="level-badge">{{ __t('level') }} 3</div>
                    <div class="commission-rate">0.5%</div>
                    <div class="commission-desc">{{ __t('third_generation') }}</div>
                </div>
            </div>

            <div class="commission-note">
                <svg class="commission-note__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                <strong>{{ __t('note') }}:</strong> {{ __t('commission_note_text') }}
            </div>
        </div>
    </div>

    <!-- REFERRAL LEVELS -->
    <div class="levels-section">
        <div class="panel-head panel-head--levels">
            <div>
                <span class="panel-kicker">Team Ledger</span>
                <h3 class="section-title">{{ __t('network_levels') }}</h3>
            </div>
        </div>

        @php
        $levels = [
        ['name' => 'Level 1', 'users' => $level1, 'active' => $level1Active, 'bonus' => '2%', 'color' => 'level-1'],
        ['name' => 'Level 2', 'users' => $level2, 'active' => $level2Active, 'bonus' => '1%', 'color' => 'level-2'],
        ['name' => 'Level 3', 'users' => $level3, 'active' => $level3Active, 'bonus' => '0.5%', 'color' => 'level-3'],
        ];
        @endphp

        @foreach($levels as $level)
        <div class="level-card {{ $level['color'] }}">
            <div class="level-header">
                <div class="level-info">
                    <h4 class="level-name">{{ $level['name'] }}</h4>
                    <span class="commission-badge">{{ $level['bonus'] }} {{ __t('commission') }}</span>
                </div>
                <div class="level-stats">
                    <div class="stat-mini">
                        <span class="label">{{ __t('total') }}</span>
                        <span class="value">{{ $level['users']->count() }}</span>
                    </div>
                    <div class="stat-mini">
                        <span class="label">{{ __t('active') }}</span>
                        <span class="value active">{{ $level['active'] }}</span>
                    </div>
                </div>
            </div>

            @if($level['users']->isEmpty())
            <div class="empty-state">
                <p>{{ __t('no_members_yet') }}</p>
            </div>
            @else
            <div class="members-list">
                @foreach($level['users'] as $user)
                @php
                $hasDeposit = DB::table('deposits')->where('user_id', $user->id)->where('status', 'completed')->exists();
                @endphp
                <div class="member-item {{ $hasDeposit ? 'active' : 'inactive' }}">
                    <div class="member-info">
                        <span class="member-avatar">{{ strtoupper(substr($user->account_id, 0, 1)) }}</span>
                        <div class="member-code-wrap">
                            <div class="member-code">{{ $user->account_id }}</div>
                            <div class="member-id-label">Referrer ID</div>
                        </div>
                    </div>
                    @if($hasDeposit)
                    <span class="badge active">{{ __t('active') }}</span>
                    @else
                    <span class="badge inactive">{{ __t('inactive') }}</span>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    </div>

</div>

<!-- STYLES -->

<!-- SCRIPTS -->
<script>
    function openShareApp(event, appUrl, fallbackUrl) {
        event.preventDefault();

        const now = Date.now();
        window.location.href = appUrl;

        setTimeout(() => {
            if (Date.now() - now < 1600) {
                window.open(fallbackUrl, '_blank', 'noopener');
            }
        }, 900);
    }

    function copyText(event, id) {
        const element = document.getElementById(id);

        // Create a temporary textarea
        const textarea = document.createElement('textarea');
        textarea.value = element.value;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);

        // Show feedback
        const btn = event.target.closest('.copy-btn');
        const originalText = btn.innerHTML;
        btn.textContent = '✓';
        setTimeout(() => {
            btn.innerHTML = originalText;
        }, 2000);
    }
</script>

@endsection
