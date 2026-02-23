@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Withdrawal Method | Cryptexa')

<link rel="stylesheet" href="{{ asset('css/withdrawal-method.css') }}">

@section('content')

<div class="withdrawal-header">
    <a href="{{ route('account.settings') }}" class="back-btn">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7" />
        </svg>
    </a>
    <h6 class="header-title">Withdrawal Method</h6>
    <span class="placeholder"></span>
</div>

<div class="withdrawal-wrapper">

    @php
        $hasAddress = auth()->user()->withdrawal_address;
        $currentNetwork = auth()->user()->withdrawal_network;
    @endphp

    <h1 class="page-title">{{ $hasAddress ? 'Change' : 'Set' }} Withdrawal Address</h1>
    <p class="page-subtitle">{{ $hasAddress ? 'Update your wallet address' : 'Select network and bind your wallet address' }}</p>

    @if($hasAddress)
    <div style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 16px; padding: 20px; margin-bottom: 24px;">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <div style="width: 32px; height: 32px; background: rgba(34, 197, 94, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="3">
                    <path d="M20 6L9 17l-5-5"/>
                </svg>
            </div>
            <div>
                <div style="color: var(--text-light); font-weight: 700; font-size: 14px;">Current Withdrawal Address</div>
                <div style="color: var(--text-muted); font-size: 12px; text-transform: uppercase;">{{ strtoupper($currentNetwork) }}</div>
            </div>
        </div>
        <div style="background: rgba(15, 23, 42, 0.6); border: 1px solid var(--border); border-radius: 12px; padding: 12px; word-break: break-all;">
            <code style="color: var(--primary); font-size: 13px;">{{ auth()->user()->withdrawal_address }}</code>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 16px; padding: 20px; margin-bottom: 24px;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 32px; height: 32px; background: rgba(239, 68, 68, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="3">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="15" y1="9" x2="9" y2="15"/>
                    <line x1="9" y1="9" x2="15" y2="15"/>
                </svg>
            </div>
            <div style="color: #ef4444; font-weight: 700; font-size: 14px;">{{ $errors->first() }}</div>
        </div>
    </div>
    @endif

    <form method="POST" action="{{ route('withdrawal-method.store') }}" id="withdrawalForm">
        @csrf
        
        <div class="network-grid">
            <div class="network-card" data-network="usdtbsc" data-name="USDT (BEP20)">
                <div class="network-icon">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <circle cx="16" cy="16" r="16" fill="#26A17B"/>
                        <path d="M17.9 15.8V13.5h4.7v-2.4H9.4v2.4h4.7v2.3c-3.6.2-6.3 1-6.3 2 0 1.1 3.1 2 7 2s7-.9 7-2c0-1-2.7-1.8-6.3-2zm-2.8 3.7c-3.2 0-5.8-.6-5.8-1.4s2.6-1.4 5.8-1.4 5.8.6 5.8 1.4-2.6 1.4-5.8 1.4z" fill="white"/>
                    </svg>
                </div>
                <div class="network-name">USDT</div>
                <div class="network-type">BEP20 (BSC)</div>
                <span class="network-badge">Recommended</span>
            </div>

            <div class="network-card" data-network="usdcbsc" data-name="USDC (BEP20)">
                <div class="network-icon">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <circle cx="16" cy="16" r="16" fill="#2775CA"/>
                        <path d="M16 24c-4.4 0-8-3.6-8-8s3.6-8 8-8 8 3.6 8 8-3.6 8-8 8zm0-14.5c-3.6 0-6.5 2.9-6.5 6.5s2.9 6.5 6.5 6.5 6.5-2.9 6.5-6.5-2.9-6.5-6.5-6.5z" fill="white"/>
                        <path d="M16 20c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4zm0-6.5c-1.4 0-2.5 1.1-2.5 2.5s1.1 2.5 2.5 2.5 2.5-1.1 2.5-2.5-1.1-2.5-2.5-2.5z" fill="white"/>
                    </svg>
                </div>
                <div class="network-name">USDC</div>
                <div class="network-type">BEP20 (BSC)</div>
                <span class="network-badge" style="background: rgba(37, 99, 235, 0.15); color: #2563eb;">Fast</span>
            </div>

            <div class="network-card" data-network="usdttrc20" data-name="USDT (TRC20)">
                <div class="network-icon">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <circle cx="16" cy="16" r="16" fill="#EB0029"/>
                        <path d="M17.9 15.8V13.5h4.7v-2.4H9.4v2.4h4.7v2.3c-3.6.2-6.3 1-6.3 2 0 1.1 3.1 2 7 2s7-.9 7-2c0-1-2.7-1.8-6.3-2zm-2.8 3.7c-3.2 0-5.8-.6-5.8-1.4s2.6-1.4 5.8-1.4 5.8.6 5.8 1.4-2.6 1.4-5.8 1.4z" fill="white"/>
                    </svg>
                </div>
                <div class="network-name">USDT</div>
                <div class="network-type">TRC20 (Tron)</div>
                <span class="network-badge" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b;">Alternative</span>
            </div>

            <div class="network-card" data-network="bnbbsc" data-name="BNB (BSC)">
                <div class="network-icon">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <circle cx="16" cy="16" r="16" fill="#F3BA2F"/>
                        <path d="M12.5 16l-2.5 2.5L8 16l2-2 2.5 2.5zm3.5-3.5L19.5 16 16 19.5 12.5 16 16 12.5zm7.5 3.5l-2.5 2.5L19 16l2.5-2.5L24 16zm-8 8l-2.5-2.5L16 19l2.5 2.5L16 24zm0-16L13.5 10.5 16 13l2.5-2.5L16 8z" fill="white"/>
                    </svg>
                </div>
                <div class="network-name">BNB</div>
                <div class="network-type">BSC Network</div>
                <span class="network-badge" style="background: rgba(124, 58, 237, 0.15); color: #7c3aed;">Native</span>
            </div>
        </div>

        <input type="hidden" name="network" id="selectedNetwork">

        <div class="address-section" id="addressSection">
            <label class="input-label">Wallet Address</label>
            <div class="input-wrapper">
                <input 
                    type="text" 
                    name="address" 
                    id="walletAddress"
                    class="address-input" 
                    placeholder="Enter your wallet address"
                    required>
            </div>
            <p style="color: var(--text-muted); font-size: 12px; margin-top: 8px;">
                Network: <span id="selectedNetworkName" style="color: var(--primary); font-weight: 600;"></span>
            </p>
        </div>

        <button type="submit" class="save-btn" id="saveBtn" disabled>
            {{ $hasAddress ? 'Update' : 'Save' }} Withdrawal Address
        </button>
    </form>

    <div class="info-box" style="margin-top: 24px;">
        <div class="info-icon">!</div>
        <div class="info-text">
            <strong style="color: #a855f7;">Important:</strong> Ensure your wallet address matches the selected network to avoid loss of funds. Double-check before saving.
        </div>
    </div>

</div>

<script>
    const networkCards = document.querySelectorAll('.network-card');
    const addressSection = document.getElementById('addressSection');
    const selectedNetworkInput = document.getElementById('selectedNetwork');
    const selectedNetworkName = document.getElementById('selectedNetworkName');
    const walletAddress = document.getElementById('walletAddress');
    const saveBtn = document.getElementById('saveBtn');

    networkCards.forEach(card => {
        card.addEventListener('click', function() {
            // Remove selected class from all cards
            networkCards.forEach(c => c.classList.remove('selected'));
            
            // Add selected class to clicked card
            this.classList.add('selected');
            
            // Get network data
            const network = this.dataset.network;
            const networkName = this.dataset.name;
            
            // Update hidden input and display
            selectedNetworkInput.value = network;
            selectedNetworkName.textContent = networkName;
            
            // Clear address input when network changes
            walletAddress.value = '';
            saveBtn.disabled = true;
            
            // Update placeholder based on network
            if (['usdtbsc', 'usdcbsc', 'bnbbsc'].includes(network)) {
                walletAddress.placeholder = 'Enter BEP20/BSC address (starts with 0x)';
            } else if (network === 'usdttrc20') {
                walletAddress.placeholder = 'Enter TRC20 address (starts with T)';
            }
            
            // Show address section
            addressSection.classList.add('show');
            
            // Focus on address input
            setTimeout(() => walletAddress.focus(), 300);
        });
    });

    // Enable/disable save button based on address input
    walletAddress.addEventListener('input', function() {
        const address = this.value.trim();
        const network = selectedNetworkInput.value;
        let isValid = false;
        
        if (network && address) {
            if (['usdtbsc', 'usdcbsc', 'bnbbsc'].includes(network)) {
                // BEP20/BSC: starts with 0x, 42 chars total
                isValid = /^0x[a-fA-F0-9]{40}$/.test(address);
            } else if (network === 'usdttrc20') {
                // TRC20: starts with T, 34 chars total
                isValid = /^T[a-zA-Z0-9]{33}$/.test(address);
            }
        }
        
        saveBtn.disabled = !isValid;
    });

    // Form validation
    document.getElementById('withdrawalForm').addEventListener('submit', function(e) {
        const address = walletAddress.value.trim();
        const network = selectedNetworkInput.value;
        
        if (!network || !address) {
            e.preventDefault();
            alert('Please select a network and enter your wallet address');
            return;
        }
        
        // Validate address format based on network
        if (['usdtbsc', 'usdcbsc', 'bnbbsc'].includes(network)) {
            if (!/^0x[a-fA-F0-9]{40}$/.test(address)) {
                e.preventDefault();
                alert('Invalid BEP20/BSC address. Must start with 0x and be 42 characters.');
                return;
            }
        } else if (network === 'usdttrc20') {
            if (!/^T[a-zA-Z0-9]{33}$/.test(address)) {
                e.preventDefault();
                alert('Invalid TRC20 address. Must start with T and be 34 characters.');
                return;
            }
        }
    });
</script>

@endsection