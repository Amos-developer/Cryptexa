@extends('layouts.app')

@section('title', 'Referral Program | Cryptexa')
@section('hide-header', true)

@section('content')

<link rel="stylesheet" href="{{ asset('css/team.css') }}">

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
        <div class="team-hero__heading">
            <span class="team-hero__eyebrow">Referral Desk</span>
            <h2 class="team-hero__title">{{ __t('my_team') }}</h2>
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
                    <span class="panel-kicker">Invite Flow</span>
                    <h3 class="panel-title">{{ __t('referral_code') }}</h3>
                </div>
            </div>

            <div class="card-header">
                <span class="card-label">{{ __t('referral_code') }}</span>
                <div class="copy-group">
                    <input id="refCode"
                        class="code-input"
                        value="{{ auth()->user()->referral_code }}"
                        readonly>
                    <button onclick="copyText('refCode')" class="copy-btn">
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
                    <button onclick="copyText('refLink')" class="copy-btn copy-btn-green">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3.46-3.46a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3.46 3.46a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- SHARE BUTTONS -->
            <div class="share-buttons">
                <a target="_blank"
                    href="https://wa.me/?text={{ urlencode(__t('join_cryptexa_link').' '.url('/register?ref='.auth()->user()->referral_code)) }}"
                    class="share-btn share-whatsapp"
                    title="{{ __t('share_on_whatsapp') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-4.869 1.171l-.346.197-3.57.734.747-2.732-.199-.319A9.9 9.9 0 015.25 2c5.385 0 9.75 4.365 9.75 9.75 0 2.6-.997 5.04-2.799 6.877m8.556-15.113c-1.713-.342-3.529-.333-5.228.039-3.26.707-6.501 2.986-8.023 6.088-1.562 3.149-1.379 6.716.548 9.614 1.921 2.88 5.286 4.827 8.993 4.986.652.034 1.297.034 1.99-.122 1.69-.358 3.242-1.137 4.532-2.235l.456-.378 2.948.771-.772-2.982.36-.287A13.52 13.52 0 0024 12.556c0-3.527-1.397-6.8-3.936-9.21-1.584-1.456-3.509-2.448-5.535-2.712z" />
                    </svg>
                </a>
                <a target="_blank"
                    href="https://t.me/share/url?url={{ urlencode(url('/register?ref='.auth()->user()->referral_code)) }}"
                    class="share-btn share-telegram"
                    title="{{ __t('share_on_telegram') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.16.16-.295.295-.605.295-.39 0-.32-.144-.451-.511l-1.003-3.39-2.953-.921c-.641-.194-.657-.472.14-.708l11.385-4.386c.532-.196 1.006.128.832.941z" />
                    </svg>
                </a>
                <a target="_blank"
                    href="https://twitter.com/intent/tweet?text={{ urlencode(__t('join_cryptexa_earn').' '.url('/register?ref='.auth()->user()->referral_code)) }}"
                    class="share-btn share-twitter"
                    title="{{ __t('share_on_twitter') }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24h-6.657l-5.223-6.821-5.974 6.821h-3.31l7.732-8.835L.424 2.25h6.837l4.822 6.379 5.586-6.379zM17.15 18.738h1.828L6.122 4.146H4.158l13-14.592z" />
                    </svg>
                </a>
            </div>
        </div>
    
        <!-- DEPOSIT BONUS STRUCTURE -->
        <div class="commission-section">
            <div class="panel-head">
                <div>
                    <span class="panel-kicker">Payout Matrix</span>
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
                <span class="panel-kicker">Network Map</span>
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
                $totalDeposits = DB::table('deposits')->where('user_id', $user->id)->where('status', 'completed')->sum('amount');
                @endphp
                <div class="member-item {{ $hasDeposit ? 'active' : 'inactive' }}">
                    <div class="member-info">
                        <div class="member-code">{{ $user->account_id }}</div>
                        <div class="member-joined">{{ __t('joined') }} {{ $user->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="member-balance">
                        <div class="balance-value">${{ number_format($totalDeposits, 2) }}</div>
                        <div class="balance-status">
                            @if($hasDeposit)
                            <span class="badge active">{{ __t('active') }}</span>
                            @else
                            <span class="badge inactive">{{ __t('inactive') }}</span>
                            @endif
                        </div>
                    </div>
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
    function copyText(id) {
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
        const originalText = btn.textContent;
        btn.textContent = '✓';
        setTimeout(() => {
            btn.innerHTML = originalText;
        }, 2000);
    }
</script>

@endsection
