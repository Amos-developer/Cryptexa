@extends('layouts.app')

@section('title', 'Lucky Box')
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
        --gold: #fbbf24;
        --purple: #a855f7;
    }

    body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; overflow-x: hidden; }

    .luckybox-header {
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

    .balance-badge {
        background: rgba(56, 189, 248, 0.1);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 8px 16px;
        color: var(--primary);
        font-size: 13px;
        font-weight: 700;
    }

    .luckybox-wrapper {
        min-height: 100vh;
        padding: 80px 20px 40px;
        background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-darker) 100%);
        position: relative;
    }

    .stars {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }

    .star {
        position: absolute;
        width: 2px;
        height: 2px;
        background: var(--primary);
        border-radius: 50%;
        animation: twinkle 3s infinite;
    }

    @keyframes twinkle {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 1; }
    }

    .box-container {
        position: relative;
        z-index: 2;
        text-align: center;
        margin-bottom: 40px;
    }

    .box-title {
        color: var(--text-light);
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 12px;
        text-shadow: 0 0 20px rgba(56, 189, 248, 0.5);
    }

    .box-subtitle {
        color: var(--text-muted);
        font-size: 14px;
        margin-bottom: 40px;
    }

    .mystery-box {
        width: 200px;
        height: 200px;
        margin: 0 auto 40px;
        position: relative;
        cursor: pointer;
        transition: transform 0.3s;
    }

    .mystery-box:hover {
        transform: scale(1.05);
    }

    .mystery-box.opening {
        animation: shake 0.5s;
    }

    @keyframes shake {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(-10deg); }
        75% { transform: rotate(10deg); }
    }

    .box-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 250px;
        height: 250px;
        transform: translate(-50%, -50%);
        background: radial-gradient(circle, rgba(56, 189, 248, 0.3), transparent);
        border-radius: 50%;
        animation: pulse-glow 2s ease-in-out infinite;
    }

    @keyframes pulse-glow {
        0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
        50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.8; }
    }

    .box-icon {
        position: relative;
        z-index: 2;
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, var(--primary), var(--purple));
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 20px 60px rgba(56, 189, 248, 0.4);
    }

    .open-btn {
        width: 100%;
        max-width: 300px;
        margin: 0 auto;
        padding: 20px;
        background: linear-gradient(135deg, var(--gold), #f59e0b);
        border: none;
        border-radius: 16px;
        color: white;
        font-size: 18px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 10px 30px rgba(251, 191, 36, 0.4);
        position: relative;
        overflow: hidden;
    }

    .open-btn::before {
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

    .open-btn:hover::before {
        width: 400px;
        height: 400px;
    }

    .open-btn:disabled {
        background: rgba(56, 189, 248, 0.2);
        cursor: not-allowed;
        box-shadow: none;
    }

    .reward-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .reward-modal.show {
        display: flex;
        animation: fadeIn 0.3s;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .reward-content {
        background: linear-gradient(135deg, var(--bg-darker), var(--bg-dark));
        border: 2px solid var(--gold);
        border-radius: 24px;
        padding: 40px 30px;
        text-align: center;
        max-width: 350px;
        width: 90%;
        animation: scaleIn 0.5s;
        box-shadow: 0 0 60px rgba(251, 191, 36, 0.5);
    }

    @keyframes scaleIn {
        from { transform: scale(0.5); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .reward-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, var(--gold), #f59e0b);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: bounce 1s infinite;
    }

    .reward-text {
        color: var(--text-muted);
        font-size: 14px;
        margin-bottom: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .reward-amount {
        font-size: 56px;
        font-weight: 900;
        color: var(--gold);
        margin-bottom: 24px;
        text-shadow: 0 0 30px rgba(251, 191, 36, 0.6);
    }

    .close-modal-btn {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, var(--primary), #0ea5e9);
        border: none;
        border-radius: 12px;
        color: white;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
    }

    .info-cards {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-top: 40px;
    }

    .info-card {
        background: rgba(56, 189, 248, 0.05);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 20px;
        text-align: center;
    }

    .info-label {
        font-size: 11px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .info-value {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-light);
    }

    @media (min-width: 768px) {
        .luckybox-wrapper {
            padding: 100px 40px;
            max-width: 600px;
            margin: auto;
        }
    }
</style>

<div class="luckybox-header">
    <a href="{{ route('home') }}" class="back-btn">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7" />
        </svg>
    </a>
    <h6 class="header-title">Lucky Box</h6>
    <div class="balance-badge" id="balanceDisplay">${{ number_format($user->balance, 2) }}</div>
</div>

<div class="stars" id="stars"></div>

<div class="luckybox-wrapper">

    <div class="box-container">
        <h1 class="box-title">🎁 Mystery Reward</h1>
        <p class="box-subtitle">Open the box to reveal your prize!</p>

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

        <button class="open-btn" id="openBtn" {{ !$canOpen ? 'disabled' : '' }}>{{ $canOpen ? 'Open Lucky Box' : 'Already Opened Today' }}</button>
    </div>

    <div class="info-cards">
        <div class="info-card">
            <div class="info-label">Min Reward</div>
            <div class="info-value">$0.10</div>
        </div>
        <div class="info-card">
            <div class="info-label">Max Reward</div>
            <div class="info-value">$1.50</div>
        </div>
    </div>

    @if(!$canOpen)
    <div class="next-checkin" style="margin-top: 20px;">
        ⏰ Next box available tomorrow
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
        <div class="reward-text">Congratulations!</div>
        <div class="reward-amount" id="rewardAmount">$0.00</div>
        <button class="close-modal-btn" id="closeModal">Claim Reward</button>
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
        openBtn.textContent = 'Opening...';
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
                openBtn.textContent = 'Already Opened Today';
                mysteryBox.classList.remove('opening');
                return;
            }

            setTimeout(() => {
                mysteryBox.classList.remove('opening');
                rewardAmount.textContent = '$' + data.reward.toFixed(2);
                rewardModal.classList.add('show');
                balanceDisplay.textContent = '$' + data.balance.toFixed(2);
                openBtn.textContent = 'Already Opened Today';
            }, 500);

        } catch (error) {
            console.error('Error:', error);
            openBtn.disabled = false;
            openBtn.textContent = 'Open Lucky Box';
            mysteryBox.classList.remove('opening');
        }
    });

    closeModal.addEventListener('click', function() {
        rewardModal.classList.remove('show');
    });
</script>

@endsection
