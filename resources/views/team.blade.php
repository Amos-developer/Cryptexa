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
            <strong>Note:</strong> Commissions are earned from plan activations by members at each level. Active members are those with balance > 0.
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
                <div class="member-item {{ $user->balance > 0 ? 'active' : 'inactive' }}">
                    <div class="member-info">
                        <div class="member-code">{{ $user->referral_code }}</div>
                        <div class="member-joined">Joined {{ $user->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="member-balance">
                        <div class="balance-value">${{ number_format($user->balance, 2) }}</div>
                        <div class="balance-status">
                            @if($user->balance > 0)
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
<style>
    * {
        box-sizing: border-box;
    }

    .team-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 56px;
        background: linear-gradient(135deg, #020617, #0f172a);
        border-bottom: 1px solid rgba(56, 189, 248, 0.2);
        backdrop-filter: blur(10px);
        z-index: 100;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 16px;
    }

    .back-btn {
        width: 36px;
        height: 36px;
        background: rgba(56, 189, 248, 0.1);
        border: 1px solid rgba(56, 189, 248, 0.2);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #38bdf8;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .back-btn:hover {
        background: rgba(56, 189, 248, 0.15);
        border-color: rgba(56, 189, 248, 0.4);
    }

    .header-title {
        color: #e5e7eb;
        font-weight: 700;
        font-size: 14px;
        margin: 0;
    }

    .placeholder {
        width: 36px;
    }

    .team-container {
        background: linear-gradient(135deg, #020617 0%, #0f172a 100%);
        min-height: 100vh;
        padding: 80px 16px 80px;
    }

    .page-header {
        margin-bottom: 28px;
    }

    .page-header h1 {
        color: #e5e7eb;
        font-size: 28px;
        font-weight: 800;
        margin: 0 0 8px;
    }

    .page-header p {
        color: #94a3b8;
        font-size: 13px;
        margin: 0;
    }

    /* Referral Code Card */
    .referral-code-card {
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.05) 0%, rgba(56, 189, 248, 0.02) 100%);
        border: 1px solid rgba(56, 189, 248, 0.2);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 24px;
        backdrop-filter: blur(12px);
    }

    .card-header,
    .card-content {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .card-label {
        color: #38bdf8;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .copy-group {
        display: flex;
        gap: 8px;
        align-items: stretch;
    }

    .code-input {
        flex: 1;
        padding: 12px;
        border-radius: 10px;
        border: 1px solid rgba(56, 189, 248, 0.2);
        background: rgba(15, 23, 42, 0.8);
        color: #e5e7eb;
        font-weight: 600;
        font-size: 12px;
        font-family: 'Courier New', monospace;
    }

    .copy-btn {
        padding: 12px 16px;
        border-radius: 10px;
        border: none;
        background: rgba(56, 189, 248, 0.15);
        color: #38bdf8;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .copy-btn:active {
        transform: scale(0.95);
    }

    .copy-btn-green {
        background: rgba(34, 197, 94, 0.15);
        color: #22c55e;
    }

    .card-divider {
        height: 1px;
        background: rgba(56, 189, 248, 0.1);
        margin: 16px 0;
    }

    .share-buttons {
        display: flex;
        gap: 12px;
        margin-top: 16px;
    }

    .share-btn {
        flex: 1;
        padding: 12px;
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.05);
        color: #fff;
        font-size: 20px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .share-whatsapp:hover {
        background: rgba(37, 211, 102, 0.2);
        border-color: #25d366;
    }

    .share-telegram:hover {
        background: rgba(0, 136, 204, 0.2);
        border-color: #0088cc;
    }

    .share-twitter:hover {
        background: rgba(29, 161, 242, 0.2);
        border-color: #1da1f2;
    }

    /* Commission Section */
    .commission-section {
        background: linear-gradient(135deg, rgba(168, 85, 247, 0.05) 0%, rgba(168, 85, 247, 0.02) 100%);
        border: 1px solid rgba(168, 85, 247, 0.2);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 24px;
    }

    .section-header {
        margin-bottom: 20px;
    }

    .section-header h3 {
        color: #a855f7;
        font-size: 16px;
        font-weight: 700;
        margin: 0 0 4px;
    }

    .section-header p {
        color: #94a3b8;
        font-size: 12px;
        margin: 0;
    }

    .commission-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 12px;
        margin-bottom: 16px;
    }

    .commission-item {
        padding: 16px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
        background: rgba(255, 255, 255, 0.03);
        transition: all 0.3s ease;
    }

    .commission-item:hover {
        border-color: rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.05);
    }

    .commission-item.level-1 {
        border-left: 3px solid #38bdf8;
    }

    .commission-item.level-2 {
        border-left: 3px solid #06b6d4;
    }

    .commission-item.level-3 {
        border-left: 3px solid #22c55e;
    }

    .commission-item.level-4 {
        border-left: 3px solid #fbbf24;
    }

    .commission-item.level-5 {
        border-left: 3px solid #f97316;
    }

    .commission-item.level-6 {
        border-left: 3px solid #ef4444;
    }

    .level-badge {
        color: #94a3b8;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .commission-rate {
        color: #e5e7eb;
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .commission-desc {
        color: #64748b;
        font-size: 11px;
    }

    .commission-note {
        padding: 12px;
        background: rgba(255, 255, 255, 0.03);
        border-left: 2px solid #a855f7;
        border-radius: 6px;
        color: #94a3b8;
        font-size: 12px;
        line-height: 1.5;
    }

    /* Stats Section */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 12px;
        margin-bottom: 28px;
    }

    .stat-card {
        padding: 16px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(255, 255, 255, 0.03);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .stat-icon {
        font-size: 24px;
        margin-bottom: 8px;
    }

    .stat-label {
        color: #94a3b8;
        font-size: 11px;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        color: #e5e7eb;
        font-size: 20px;
        font-weight: 700;
        margin: 4px 0 0;
    }

    .stat-total .stat-value {
        color: #38bdf8;
    }

    .stat-active .stat-value {
        color: #22c55e;
    }

    .stat-earnings .stat-value {
        color: #fbbf24;
    }

    /* Levels Section */
    .levels-section {
        margin-bottom: 20px;
    }

    .section-title {
        color: #e5e7eb;
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 16px;
    }

    .level-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 16px;
        transition: all 0.3s ease;
    }

    .level-card:hover {
        border-color: rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.05);
    }

    .level-header {
        padding: 16px;
        background: rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .level-info {
        flex: 1;
    }

    .level-name {
        color: #e5e7eb;
        font-size: 14px;
        font-weight: 700;
        margin: 0 0 4px;
    }

    .commission-badge {
        color: #94a3b8;
        font-size: 11px;
        background: rgba(255, 255, 255, 0.05);
        padding: 4px 8px;
        border-radius: 4px;
        display: inline-block;
    }

    .level-stats {
        display: flex;
        gap: 12px;
    }

    .stat-mini {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .stat-mini .label {
        color: #94a3b8;
        font-size: 10px;
        text-transform: uppercase;
    }

    .stat-mini .value {
        color: #38bdf8;
        font-size: 16px;
        font-weight: 700;
    }

    .stat-mini .value.active {
        color: #22c55e;
    }

    .empty-state {
        padding: 24px 16px;
        text-align: center;
        color: #94a3b8;
        font-size: 13px;
    }

    .members-list {
        padding: 12px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        max-height: 400px;
        overflow-y: auto;
    }

    .member-item {
        padding: 12px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        transition: all 0.3s ease;
    }

    .member-item.active {
        border-color: rgba(34, 197, 94, 0.2);
        background: rgba(34, 197, 94, 0.05);
    }

    .member-item.inactive {
        border-color: rgba(239, 68, 68, 0.2);
        background: rgba(239, 68, 68, 0.03);
    }

    .member-info {
        flex: 1;
    }

    .member-code {
        color: #e5e7eb;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 4px;
        font-family: 'Courier New', monospace;
    }

    .member-joined {
        color: #94a3b8;
        font-size: 10px;
    }

    .member-balance {
        text-align: right;
    }

    .balance-value {
        color: #22c55e;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .balance-status .badge {
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge.active {
        background: rgba(34, 197, 94, 0.2);
        color: #22c55e;
    }

    .badge.inactive {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
    }

    /* Color variants for level cards */
    .level-card.level-1 {
        border-left: 3px solid #38bdf8;
    }

    .level-card.level-2 {
        border-left: 3px solid #06b6d4;
    }

    .level-card.level-3 {
        border-left: 3px solid #22c55e;
    }

    .level-card.level-4 {
        border-left: 3px solid #fbbf24;
    }

    .level-card.level-5 {
        border-left: 3px solid #f97316;
    }

    .level-card.level-6 {
        border-left: 3px solid #ef4444;
    }

    /* Mobile */
    @media (max-width: 640px) {
        .team-container {
            padding: 70px 12px 80px;
        }

        .page-header h1 {
            font-size: 24px;
        }

        .commission-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .level-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .level-stats {
            width: 100%;
            justify-content: flex-start;
        }
    }
</style>

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