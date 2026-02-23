@extends('layouts.app')

@section('title', 'Daily Check-in')
@section('hide-header', true)

@section('content')

<style>
    :root {
        --primary: #38bdf8;
        --bg-dark: #020617;
        --bg-darker: #0f172a;
        --text-light: #e5e7eb;
        --text-muted: #94a3b8;
        --border: rgba(56, 189, 248, 0.2);
        --success: #22c55e;
    }

    body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }

    .checkin-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 60px;
        background: var(--bg-darker);
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        z-index: 100;
        backdrop-filter: blur(10px);
    }

    .back-btn {
        width: 40px;
        height: 40px;
        background: rgba(56, 189, 248, 0.1);
        border: 1px solid var(--border);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        text-decoration: none;
        transition: all 0.2s;
    }

    .back-btn:hover { background: rgba(56, 189, 248, 0.2); }

    .header-title {
        color: var(--text-light);
        font-size: 18px;
        font-weight: 600;
        letter-spacing: -0.3px;
    }

    .placeholder { width: 40px; }

    .checkin-wrapper {
        min-height: 100vh;
        padding: 80px 20px 40px;
        background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-darker) 100%);
    }

    .reward-card {
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.1), rgba(56, 189, 248, 0.05));
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 32px 24px;
        text-align: center;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .reward-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(56, 189, 248, 0.1) 0%, transparent 70%);
        animation: pulse 3s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    .reward-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, var(--primary), #0ea5e9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .reward-label {
        font-size: 14px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }

    .reward-amount {
        font-size: 48px;
        font-weight: 800;
        color: var(--text-light);
        letter-spacing: -2px;
        margin-bottom: 8px;
        text-shadow: 0 0 20px rgba(56, 189, 248, 0.3);
    }

    .streak-info {
        font-size: 14px;
        margin-top: 28px;
        color: var(--primary);
        font-weight: 600;
    }

    .checkin-btn {
        width: 100%;
        padding: 18px;
        background: linear-gradient(135deg, var(--primary), #0ea5e9);
        border: none;
        border-radius: 16px;
        color: white;
        font-size: 16px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 8px 24px rgba(56, 189, 248, 0.3);
        position: relative;
        overflow: hidden;
    }

    .checkin-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .checkin-btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .checkin-btn:disabled {
        background: rgba(56, 189, 248, 0.2);
        cursor: not-allowed;
        box-shadow: none;
        opacity: 0.6;
    }

    .next-checkin {
        text-align: center;
        margin-top: 16px;
        padding: 12px;
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        border-radius: 12px;
        color: #ef4444;
        font-size: 13px;
        font-weight: 600;
    }

    .success-message {
        text-align: center;
        margin-bottom: 20px;
        padding: 16px;
        background: rgba(34, 197, 94, 0.1);
        border: 1px solid rgba(34, 197, 94, 0.3);
        border-radius: 12px;
        color: var(--success);
        font-size: 14px;
        font-weight: 600;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .history-section {
        margin-top: 32px;
    }

    .section-title {
        color: var(--text-light);
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .history-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
    }

    .day-card {
        aspect-ratio: 1;
        background: rgba(56, 189, 248, 0.05);
        border: 1px solid var(--border);
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
        transition: all 0.3s;
    }

    .day-card.checked {
        background: linear-gradient(135deg, rgba(56, 189, 248, 0.2), rgba(56, 189, 248, 0.1));
        border-color: var(--primary);
        position: relative;
    }

    .day-card.checked::before {
        content: '✓';
        position: absolute;
        top: 4px;
        right: 4px;
        width: 16px;
        height: 16px;
        background: var(--success);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        color: white;
        font-weight: 700;
    }

    .day-number {
        font-size: 11px;
        color: var(--text-muted);
        font-weight: 600;
    }

    .day-reward {
        font-size: 10px;
        color: var(--primary);
        font-weight: 700;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-top: 24px;
    }

    .stat-card {
        background: rgba(56, 189, 248, 0.05);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 20px;
        text-align: center;
    }

    .stat-label {
        font-size: 12px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-light);
    }

    @media (min-width: 768px) {
        .checkin-wrapper {
            padding: 100px 40px;
            max-width: 600px;
            margin: auto;
        }
    }
</style>

<div class="checkin-header">
    <a href="{{ route('home') }}" class="back-btn">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7" />
        </svg>
    </a>
    <h6 class="header-title">Daily Check-in</h6>
    <span class="placeholder"></span>
</div>

<div class="checkin-wrapper">

    @if(session('success'))
    <div class="success-message">
        ✅ {{ session('success') }}
    </div>
    @endif

    <div class="reward-card">
        <div class="reward-icon">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                <path d="M9 11L12 14L22 4" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M21 12V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H16" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="reward-label">Today's Reward</div>
        <div class="reward-amount">${{ number_format($nextReward, 2) }}</div>
        <div class="streak-info">🔥 {{ $currentStreak }} Day Streak</div>
    </div>

    <form method="POST" action="{{ route('checkin.store') }}" id="checkinForm">
        @csrf
        <button type="submit" class="checkin-btn" {{ !$canCheckIn ? 'disabled' : '' }} id="checkinBtn">
            {{ $canCheckIn ? 'Check In Now' : 'Already Checked In' }}
        </button>
    </form>

    @if(!$canCheckIn)
    <div class="next-checkin">
        ⏰ Next check-in available in <span id="countdown"></span>
    </div>
    @endif

    <script>
        @if(!$canCheckIn)
        function updateCountdown() {
            const now = new Date();
            const tomorrow = new Date(now);
            tomorrow.setHours(24, 0, 0, 0);
            
            const diff = tomorrow - now;
            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            
            document.getElementById('countdown').textContent = 
                `${hours}h ${minutes}m ${seconds}s`;
        }
        
        updateCountdown();
        setInterval(updateCountdown, 1000);
        @endif

        document.getElementById('checkinForm')?.addEventListener('submit', function(e) {
            const btn = document.getElementById('checkinBtn');
            if (btn && !btn.disabled) {
                btn.disabled = true;
                btn.textContent = 'Processing...';
            }
        });
    </script>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Current Streak</div>
            <div class="stat-value">{{ $currentStreak }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Earned</div>
            <div class="stat-value">${{ number_format($checkIns->sum('reward'), 2) }}</div>
        </div>
    </div>

    <div class="history-section">
        <h2 class="section-title">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Last 7 Days
        </h2>
        <div class="history-grid">
            @for($i = 6; $i >= 0; $i--)
                @php
                    $date = \Carbon\Carbon::today()->subDays($i);
                    $checkIn = $checkIns->first(function($item) use ($date) {
                        return $item->check_in_date->isSameDay($date);
                    });
                @endphp
                <div class="day-card {{ $checkIn ? 'checked' : '' }}">
                    <div class="day-number">{{ $date->format('D') }}</div>
                    @if($checkIn)
                        <div class="day-reward">${{ number_format($checkIn->reward, 2) }}</div>
                    @endif
                </div>
            @endfor
        </div>
    </div>

</div>

@endsection
