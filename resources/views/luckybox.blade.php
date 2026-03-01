@extends('layouts.app')

@section('title', __t('lucky_box'))
@section('hide-header', true)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/luckybox.css') }}">
@endpush

@section('content')

<div class="luckybox-header">
    <a href="{{ route('home') }}" class="back-btn">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7" />
        </svg>
    </a>
    <h6 class="header-title">{{ __t('lucky_box') }}</h6>
    <div class="balance-badge" id="balanceDisplay">${{ number_format($user->balance, 2) }}</div>
</div>

<div class="stars" id="stars"></div>

<div class="luckybox-wrapper">

    <div class="box-container">
        <h1 class="box-title">🎁 {{ __t('mystery_reward') }}</h1>
        <p class="box-subtitle">{{ __t('open_box_reveal_prize') }}</p>

        <div class="mystery-box" id="mysteryBox">
            <div class="box-glow"></div>
            <div class="box-icon">
                <svg width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                    <path d="M20 7H4C2.89543 7 2 7.89543 2 9V10C2 11.1046 2.89543 12 4 12H20C21.1046 12 22 11.1046 22 10V9C22 7.89543 21.1046 7 20 7Z"/>
                    <path d="M20 12H4V19C4 20.1046 4.89543 21 6 21H18C19.1046 21 20 20.1046 20 19V12Z"/>
                    <path d="M12 7V21"/>
                    <path d="M12 7C12 5.93913 12.4214 4.92172 13.1716 4.17157C13.9217 3.42143 14.9391 3 16 3"/>
                    <path d="M12 7C12 5.93913 11.5786 4.92172 10.8284 4.17157C10.0783 3.42143 9.06087 3 8 3"/>
                </svg>
            </div>
        </div>

        <button class="open-btn" id="openBtn" {{ !$canOpen ? 'disabled' : '' }}>{{ $canOpen ? __t('open_lucky_box') : __t('already_opened_today') }}</button>
    </div>

    <div class="info-cards">
        <div class="info-card">
            <div class="info-label">{{ __t('min_reward') }}</div>
            <div class="info-value">$0.10</div>
        </div>
        <div class="info-card">
            <div class="info-label">{{ __t('max_reward') }}</div>
            <div class="info-value">$1.50</div>
        </div>
    </div>

    @if(!$canOpen)
    <div class="next-checkin" style="margin-top: 20px;">
        ⏰ {{ __t('next_box_available_tomorrow') }}
    </div>
    @endif

</div>

<div class="reward-modal" id="rewardModal">
    <div class="reward-content">
        <div class="reward-icon">
            <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
            </svg>
        </div>
        <div class="reward-text">{{ __t('congratulations') }}</div>
        <div class="reward-amount" id="rewardAmount">$0.00</div>
        <button class="close-modal-btn" id="closeModal">{{ __t('claim_reward') }}</button>
    </div>
</div>

<script>
    // Generate stars
    const starsContainer = document.getElementById('stars');
    for (let i = 0; i < 50; i++) {
        const star = document.createElement('div');
        star.className = 'star';
        star.style.left = Math.random() * 100 + '%';
        star.style.top = Math.random() * 100 + '%';
        star.style.animationDelay = Math.random() * 3 + 's';
        starsContainer.appendChild(star);
    }

    const openBtn = document.getElementById('openBtn');
    const mysteryBox = document.getElementById('mysteryBox');
    const rewardModal = document.getElementById('rewardModal');
    const rewardAmount = document.getElementById('rewardAmount');
    const closeModal = document.getElementById('closeModal');
    const balanceDisplay = document.getElementById('balanceDisplay');

    openBtn.addEventListener('click', async function() {
        if (openBtn.disabled) return;
        
        openBtn.disabled = true;
        openBtn.textContent = '{{ __t('opening') }}';
        mysteryBox.classList.add('opening');

        try {
            const response = await fetch('{{ route("luckybox.open") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            const data = await response.json();

            if (!data.success) {
                alert(data.message);
                openBtn.textContent = '{{ __t('already_opened_today') }}';
                mysteryBox.classList.remove('opening');
                return;
            }

            setTimeout(() => {
                mysteryBox.classList.remove('opening');
                rewardAmount.textContent = '$' + data.reward.toFixed(2);
                rewardModal.classList.add('show');
                balanceDisplay.textContent = '$' + data.balance.toFixed(2);
                openBtn.textContent = '{{ __t('already_opened_today') }}';
            }, 500);

        } catch (error) {
            console.error('Error:', error);
            openBtn.disabled = false;
            openBtn.textContent = '{{ __t('open_lucky_box') }}';
            mysteryBox.classList.remove('opening');
        }
    });

    closeModal.addEventListener('click', function() {
        rewardModal.classList.remove('show');
    });
</script>

@endsection

