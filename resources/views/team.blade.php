@extends('layouts.app')

@section('title', 'Referral Program | Cryptexa')
@section('hide-header', true)

@section('content')

<link rel="stylesheet" href="{{ asset('css/team.css') }}">

<!-- HEADER BAR -->
<div class="team-header">
    <a href="{{ url()->previous() }}" class="back-btn">
        <i class="icon-left-btn"></i>
    </a>
    <h6 class="header-title">My Team</h6>
    <span class="placeholder"></span>
</div>

<div class="team-container">

    <!-- PAGE TITLE -->
    <div class="page-header">
        <h1>Referral Program</h1>
        <p>Earn passive income by building your network across 6 levels</p>
    </div>

    <!-- REFERRAL CODE SECTION -->
    <div class="referral-code-card">
        <div class="card-header">
            <span class="card-label">Your Referral Code</span>
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
            <span class="card-label">Referral Link</span>
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
                href="https://wa.me/?text={{ urlencode('Join Cryptexa using my link: '.url('/register?ref='.auth()->user()->referral_code)) }}"
                class="share-btn share-whatsapp"
                title="Share on WhatsApp">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-4.869 1.171l-.346.197-3.57.734.747-2.732-.199-.319A9.9 9.9 0 015.25 2c5.385 0 9.75 4.365 9.75 9.75 0 2.6-.997 5.04-2.799 6.877m8.556-15.113c-1.713-.342-3.529-.333-5.228.039-3.26.707-6.501 2.986-8.023 6.088-1.562 3.149-1.379 6.716.548 9.614 1.921 2.88 5.286 4.827 8.993 4.986.652.034 1.297.034 1.99-.122 1.69-.358 3.242-1.137 4.532-2.235l.456-.378 2.948.771-.772-2.982.36-.287A13.52 13.52 0 0024 12.556c0-3.527-1.397-6.8-3.936-9.21-1.584-1.456-3.509-2.448-5.535-2.712z" />
                </svg>
            </a>
            <a target="_blank"
                href="https://t.me/share/url?url={{ urlencode(url('/register?ref='.auth()->user()->referral_code)) }}"
                class="share-btn share-telegram"
                title="Share on Telegram">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.16.16-.295.295-.605.295-.39 0-.32-.144-.451-.511l-1.003-3.39-2.953-.921c-.641-.194-.657-.472.14-.708l11.385-4.386c.532-.196 1.006.128.832.941z" />
                </svg>
            </a>
            <a target="_blank"
                href="https://twitter.com/intent/tweet?text={{ urlencode('Join Cryptexa and earn passive income! '.url('/register?ref='.auth()->user()->referral_code)) }}"
                class="share-btn share-twitter"
                title="Share on Twitter">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24h-6.657l-5.223-6.821-5.974 6.821h-3.31l7.732-8.835L.424 2.25h6.837l4.822 6.379 5.586-6.379zM17.15 18.738h1.828L6.122 4.146H4.158l13-14.592z" />
                </svg>
            </a>
        </div>
    </div>

    <!-- COMMISSION STRUCTURE -->
    <div class="commission-section">
        <div class="section-header">
            <h3>Commission Structure</h3>
            <p>3-Level Earning System</p>
        </div>

        <div class="commission-grid">
            <div class="commission-item level-1">
                <div class="level-badge">Level 1</div>
                <div class="commission-rate">2%</div>
                <div class="commission-desc">Direct Referrals</div>
            </div>
            <div class="commission-item level-2">
                <div class="level-badge">Level 2</div>
                <div class="commission-rate">1%</div>
                <div class="commission-desc">2nd Generation</div>
            </div>
            <div class="commission-item level-3">
                <div class="level-badge">Level 3</div>
                <div class="commission-rate">0.5%</div>
                <div class="commission-desc">3rd Generation</div>
            </div>
        </div>

        <div class="commission-note">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline; margin-right: 8px; vertical-align: middle;">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
            </svg>
            <strong>Note:</strong> Commissions are earned from deposits made by members at each level. Active members are those who have made at least one deposit.
        </div>
    </div>

    <!-- STATS SECTION -->
    <div class="stats-grid">
        <div class="stat-card stat-total">
            <div class="stat-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <div class="stat-content">
                <p class="stat-label">Total Members</p>
                <h3 class="stat-value">{{ $totalMembers }}</h3>
            </div>
        </div>

        <div class="stat-card stat-active">
            <div class="stat-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
                </svg>
            </div>
            <div class="stat-content">
                <p class="stat-label">Active Members</p>
                <h3 class="stat-value">{{ $totalActiveMembers }}</h3>
            </div>
        </div>

        <div class="stat-card stat-earnings">
            <div class="stat-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="1"></circle>
                    <path d="M12 1v6m0 6v6"></path>
                    <path d="M4.22 4.22l4.24 4.24m5.08 0l4.24-4.24"></path>
                    <path d="M1 12h6m6 0h6"></path>
                    <path d="M4.22 19.78l4.24-4.24m5.08 0l4.24 4.24"></path>
                </svg>
            </div>
            <div class="stat-content">
                <p class="stat-label">Total Earnings</p>
                <h3 class="stat-value">${{ number_format($earnings, 2) }}</h3>
            </div>
        </div>
    </div>

    <!-- REFERRAL LEVELS -->
    <div class="levels-section">
        <h3 class="section-title">Network Levels</h3>

        @php
        $levels = [
        ['name' => 'Level 1', 'users' => $level1, 'active' => $level1Active, 'commission' => '2%', 'color' => 'level-1'],
        ['name' => 'Level 2', 'users' => $level2, 'active' => $level2Active, 'commission' => '1%', 'color' => 'level-2'],
        ['name' => 'Level 3', 'users' => $level3, 'active' => $level3Active, 'commission' => '0.5%', 'color' => 'level-3'],
        ];
        @endphp

        @foreach($levels as $level)
        <div class="level-card {{ $level['color'] }}">
            <div class="level-header">
                <div class="level-info">
                    <h4 class="level-name">{{ $level['name'] }}</h4>
                    <span class="commission-badge">{{ $level['commission'] }} commission</span>
                </div>
                <div class="level-stats">
                    <div class="stat-mini">
                        <span class="label">Total</span>
                        <span class="value">{{ $level['users']->count() }}</span>
                    </div>
                    <div class="stat-mini">
                        <span class="label">Active</span>
                        <span class="value active">{{ $level['active'] }}</span>
                    </div>
                </div>
            </div>

            @if($level['users']->isEmpty())
            <div class="empty-state">
                <p>No members at this level yet</p>
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
                        <div class="member-code">{{ $user->referral_code }}</div>
                        <div class="member-joined">Joined {{ $user->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="member-balance">
                        <div class="balance-value">${{ number_format($totalDeposits, 2) }}</div>
                        <div class="balance-status">
                            @if($hasDeposit)
                            <span class="badge active">Active</span>
                            @else
                            <span class="badge inactive">Inactive</span>
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
<link rel="stylesheet" href="{{ asset('css/$name') }}">

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
