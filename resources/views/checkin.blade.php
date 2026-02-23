@extends('layouts.app')

@section('title', 'Daily Check-in')
@section('hide-header', true)

@section('content')

<link rel="stylesheet" href="{{ asset('css/checkin.css') }}">

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
        let countdownInterval;
        
        function updateCountdown() {
            const now = new Date();
            const tomorrow = new Date(now);
            tomorrow.setHours(24, 0, 0, 0);
            
            const diff = tomorrow - now;
            
            if (diff <= 1000) {
                clearInterval(countdownInterval);
                window.location.reload();
                return;
            }
            
            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            
            document.getElementById('countdown').textContent = 
                `${hours}h ${minutes}m ${seconds}s`;
        }
        
        updateCountdown();
        countdownInterval = setInterval(updateCountdown, 1000);
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

