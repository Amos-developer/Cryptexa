@extends('layouts.app')

@section('title', 'Home | Cryptexa')

@section('content')

<!-- MAIN CONTENT -->
<div class="pt-40 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%);">
    <div class="tf-container">

        <!-- HEADER GREETING -->
        <div class="mb-32" style="animation: slideDown 0.6s ease;">
            <h6 class="text-secondary mb-2" style="font-size: 13px; letter-spacing: 0.5px;">Welcome Back</h6>
            <h1 style="color: #e5e7eb; font-weight: 800; font-size: 32px; margin: 0;">Dashboard</h1>
        </div>

        <!-- TOP SECTION: Balance + Actions + Market -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 32px;">

            <!-- LEFT: BALANCE CARD -->
            <div style="
                background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.03) 100%);
                border: 1px solid rgba(56,189,248,0.2);
                border-radius: 20px;
                padding: 28px;
                box-shadow: 0 20px 60px rgba(56,189,248,0.1), inset 0 0 30px rgba(56,189,248,0.05);
                backdrop-filter: blur(10px);
                animation: slideIn 0.6s ease;
            ">
                <span style="font-size: 12px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">Your Balance</span>

                <h2 style="
                    color: #e5e7eb;
                    font-weight: 900;
                    font-size: 36px;
                    margin: 12px 0 24px 0;
                    text-shadow: 0 0 30px rgba(56,189,248,0.3);
                ">
                    ${{ number_format(auth()->user()->balance, 2) }}
                </h2>

                <!-- Quick Actions -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                    <!-- Deposit Button -->
                    <a href="{{ route('choose.cryptocurrency') }}"
                        style="
                        background: linear-gradient(135deg, #38bdf8, #0ea5e9);
                        padding: 12px 16px;
                        border-radius: 12px;
                        text-align: center;
                        color: #020617;
                        font-weight: 700;
                        font-size: 13px;
                        text-decoration: none;
                        transition: all 0.3s ease;
                        box-shadow: 0 0 20px rgba(56,189,248,0.4);
                        border: none;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 6px;
                    "
                        onmouseover="this.style.boxShadow='0 0 30px rgba(56,189,248,0.6)'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.boxShadow='0 0 20px rgba(56,189,248,0.4)'; this.style.transform='translateY(0)';">
                        <i class="icon icon-way" style="font-size: 14px;"></i> Deposit
                    </a>

                    <!-- Withdraw Button -->
                    <a href="{{ route('withdraw') }}"
                        style="
                        background: linear-gradient(135deg, rgba(34,197,94,0.15), rgba(34,197,94,0.08));
                        padding: 12px 16px;
                        border-radius: 12px;
                        text-align: center;
                        color: #22c55e;
                        font-weight: 700;
                        font-size: 13px;
                        text-decoration: none;
                        transition: all 0.3s ease;
                        border: 1px solid rgba(34,197,94,0.3);
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 6px;
                    "
                        onmouseover="this.style.background='linear-gradient(135deg, rgba(34,197,94,0.25), rgba(34,197,94,0.15))'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.background='linear-gradient(135deg, rgba(34,197,94,0.15), rgba(34,197,94,0.08))'; this.style.transform='translateY(0)';">
                        <i class="icon icon-way2" style="font-size: 14px;"></i> Withdraw
                    </a>
                </div>
            </div>

            <!-- RIGHT: Quick Links -->
            <div style="display: grid; grid-template-rows: 1fr 1fr; gap: 16px;">
                <!-- Invites Card -->
                <a href="{{ route('invites') }}"
                    style="
                    background: linear-gradient(135deg, rgba(168,85,247,0.08) 0%, rgba(168,85,247,0.03) 100%);
                    border: 1px solid rgba(168,85,247,0.2);
                    border-radius: 16px;
                    padding: 18px;
                    text-decoration: none;
                    display: flex;
                    align-items: center;
                    gap: 16px;
                    transition: all 0.3s ease;
                    animation: slideIn 0.6s ease 0.1s backwards;
                "
                    onmouseover="this.style.borderColor='rgba(168,85,247,0.4)'; this.style.boxShadow='0 0 20px rgba(168,85,247,0.2)';"
                    onmouseout="this.style.borderColor='rgba(168,85,247,0.2)'; this.style.boxShadow='none';">
                    <span style="
                        width: 50px;
                        height: 50px;
                        border-radius: 12px;
                        background: rgba(168,85,247,0.15);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                    ">
                        <i class="icon icon-wallet" style="color: #a855f7; font-size: 20px;"></i>
                    </span>
                    <div>
                        <h6 style="color: #e5e7eb; font-weight: 700; margin: 0; font-size: 14px;">Referrals</h6>
                        <small style="color: #94a3b8; font-size: 11px;">Earn from invites</small>
                    </div>
                </a>

                <!-- Community Card -->
                <a href="javascript:void(0)" onclick="openCommunityModal()"
                    style="
                    background: linear-gradient(135deg, rgba(251,191,36,0.08) 0%, rgba(251,191,36,0.03) 100%);
                    border: 1px solid rgba(251,191,36,0.2);
                    border-radius: 16px;
                    padding: 18px;
                    text-decoration: none;
                    display: flex;
                    align-items: center;
                    gap: 16px;
                    transition: all 0.3s ease;
                    animation: slideIn 0.6s ease 0.2s backwards;
                    cursor: pointer;
                "
                    onmouseover="this.style.borderColor='rgba(251,191,36,0.4)'; this.style.boxShadow='0 0 20px rgba(251,191,36,0.2)';"
                    onmouseout="this.style.borderColor='rgba(251,191,36,0.2)'; this.style.boxShadow='none';">
                    <span style="
                        width: 50px;
                        height: 50px;
                        border-radius: 12px;
                        background: rgba(251,191,36,0.15);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                    ">
                        <i class="icon icon-exchange" style="color: #fbbf24; font-size: 20px;"></i>
                    </span>
                    <div>
                        <h6 style="color: #e5e7eb; font-weight: 700; margin: 0; font-size: 14px;">Community</h6>
                        <small style="color: #94a3b8; font-size: 11px;">Join the network</small>
                    </div>
                </a>
            </div>

        </div>


        <!-- MARKET TRENDS SECTION -->
        <div style="
            background: linear-gradient(135deg, rgba(56,189,248,0.05) 0%, rgba(56,189,248,0.02) 100%);
            border: 1px solid rgba(56,189,248,0.15);
            border-radius: 24px;
            padding: 28px;
            margin-bottom: 32px;
            box-shadow: 0 20px 60px rgba(56,189,248,0.08), inset 0 0 30px rgba(56,189,248,0.04);
            backdrop-filter: blur(10px);
            animation: slideUp 0.6s ease 0.1s backwards;
        ">

            <div style="margin-bottom: 24px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <h5 style="color: #e5e7eb; font-weight: 800; font-size: 18px; margin: 0;">📈 Market Trends</h5>
                    <span style="display: inline-flex; align-items: center; gap: 8px; font-size: 12px; color: #22c55e; background: rgba(34,197,94,0.1); padding: 6px 12px; border-radius: 999px; border: 1px solid rgba(34,197,94,0.2);">
                        <span style="width: 8px; height: 8px; border-radius: 50%; background: #22c55e; animation: pulse 2s infinite;"></span>
                        Live Updates
                    </span>
                </div>
                <small style="color: #94a3b8; font-size: 12px;">Real-time cryptocurrency market data</small>
            </div>

            <!-- Charts Grid -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

                <!-- BTC Chart Card -->
                <div class="chart-card" data-asset="BTC"
                    style="
                    background: linear-gradient(135deg, rgba(56,189,248,0.08) 0%, rgba(56,189,248,0.02) 100%);
                    border: 1px solid rgba(56,189,248,0.2);
                    border-radius: 16px;
                    padding: 20px;
                    transition: all 0.3s ease;
                    animation: slideIn 0.6s ease 0.2s backwards;
                "
                    onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.boxShadow='0 0 20px rgba(56,189,248,0.15)';"
                    onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.boxShadow='none';">

                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 14px;">
                        <div>
                            <p class="text-white mb-0" style="font-weight: 800; font-size: 15px;">Bitcoin</p>
                            <small class="text-secondary" style="font-size: 11px;">BTC/USD</small>
                        </div>
                        <span style="font-size: 12px; color: #22c55e; font-weight: 700; background: rgba(34,197,94,0.1); padding: 4px 10px; border-radius: 6px; border: 1px solid rgba(34,197,94,0.2);">+2.45%</span>
                    </div>

                    <div style="height: 100px; background: rgba(56,189,248,0.05); border-radius: 8px; display: flex; align-items: flex-end; gap: 2px; padding: 8px; margin-bottom: 14px;" id="btc-chart">
                        <div style="flex: 1; height: 30%; background: linear-gradient(to top, #38bdf8, #0ea5e9); border-radius: 2px; transition: all 0.2s;"></div>
                        <div style="flex: 1; height: 45%; background: linear-gradient(to top, #38bdf8, #0ea5e9); border-radius: 2px; transition: all 0.2s;"></div>
                        <div style="flex: 1; height: 35%; background: linear-gradient(to top, #38bdf8, #0ea5e9); border-radius: 2px; transition: all 0.2s;"></div>
                        <div style="flex: 1; height: 60%; background: linear-gradient(to top, #38bdf8, #0ea5e9); border-radius: 2px; transition: all 0.2s;"></div>
                        <div style="flex: 1; height: 50%; background: linear-gradient(to top, #38bdf8, #0ea5e9); border-radius: 2px; transition: all 0.2s;"></div>
                        <div style="flex: 1; height: 70%; background: linear-gradient(to top, #38bdf8, #0ea5e9); border-radius: 2px; transition: all 0.2s;"></div>
                        <div style="flex: 1; height: 55%; background: linear-gradient(to top, #38bdf8, #0ea5e9); border-radius: 2px; transition: all 0.2s;"></div>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="text-secondary" style="font-size: 12px;">Price: <span class="btc-price" style="color: #38bdf8; font-weight: 800;">$42,580</span></span>
                    </div>
                </div>

                <!-- ETH Chart Card -->
                <div class="chart-card" data-asset="ETH"
                    style="
                    background: linear-gradient(135deg, rgba(168,85,247,0.08) 0%, rgba(168,85,247,0.02) 100%);
                    border: 1px solid rgba(168,85,247,0.2);
                    border-radius: 16px;
                    padding: 20px;
                    transition: all 0.3s ease;
                    animation: slideIn 0.6s ease 0.3s backwards;
                "
                    onmouseover="this.style.borderColor='rgba(168,85,247,0.4)'; this.style.boxShadow='0 0 20px rgba(168,85,247,0.15)';"
                    onmouseout="this.style.borderColor='rgba(168,85,247,0.2)'; this.style.boxShadow='none';">

                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 14px;">
                        <div>
                            <p class="text-white mb-0" style="font-weight: 800; font-size: 15px;">Ethereum</p>
                            <small class="text-secondary" style="font-size: 11px;">ETH/USD</small>
                        </div>
                        <span style="font-size: 12px; color: #ef4444; font-weight: 700; background: rgba(239,68,68,0.1); padding: 4px 10px; border-radius: 6px; border: 1px solid rgba(239,68,68,0.2);">-1.23%</span>
                    </div>

                    <div style="height: 100px; background: rgba(168,85,247,0.05); border-radius: 8px; display: flex; align-items: flex-end; gap: 2px; padding: 8px; margin-bottom: 14px;" id="eth-chart">
                        <div style="flex: 1; height: 50%; background: linear-gradient(to top, #a855f7, #9333ea); border-radius: 2px; transition: all 0.2s;"></div>
                        <div style="flex: 1; height: 55%; background: linear-gradient(to top, #a855f7, #9333ea); border-radius: 2px; transition: all 0.2s;"></div>
                        <div style="flex: 1; height: 40%; background: linear-gradient(to top, #a855f7, #9333ea); border-radius: 2px; transition: all 0.2s;"></div>
                        <div style="flex: 1; height: 35%; background: linear-gradient(to top, #a855f7, #9333ea); border-radius: 2px; transition: all 0.2s;"></div>
                        <div style="flex: 1; height: 45%; background: linear-gradient(to top, #a855f7, #9333ea); border-radius: 2px; transition: all 0.2s;"></div>
                        <div style="flex: 1; height: 30%; background: linear-gradient(to top, #a855f7, #9333ea); border-radius: 2px; transition: all 0.2s;"></div>
                        <div style="flex: 1; height: 25%; background: linear-gradient(to top, #a855f7, #9333ea); border-radius: 2px; transition: all 0.2s;"></div>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="text-secondary" style="font-size: 12px;">Price: <span class="eth-price" style="color: #a855f7; font-weight: 800;">$2,245</span></span>
                    </div>
                </div>

            </div>

        </div>

        <style>
            @keyframes pulse {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.5;
                }
            }

            .chart-card {
                animation: slideIn 0.3s ease;
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateX(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .price-update {
                animation: priceFlash 0.4s ease;
            }

            @keyframes priceFlash {

                0%,
                100% {
                    color: inherit;
                }

                50% {
                    color: #22c55e;
                    text-shadow: 0 0 8px rgba(34, 197, 94, 0.6);
                }
            }
        </style>

        <script>
            // WebSocket for real-time market data
            let marketWs = null;
            const marketData = {
                BTC: {
                    price: 42580,
                    change: 2.45,
                    high: 43200,
                    low: 41800
                },
                ETH: {
                    price: 2245,
                    change: -1.23,
                    high: 2310,
                    low: 2180
                }
            };

            function connectMarketWebSocket() {
                // Try to connect to WebSocket server
                const wsUrl = `ws://localhost:8080/market`;

                try {
                    marketWs = new WebSocket(wsUrl);

                    marketWs.onopen = function() {
                        console.log('Market WebSocket connected');
                        // Subscribe to market updates
                        marketWs.send(JSON.stringify({
                            action: 'subscribe',
                            assets: ['BTC', 'ETH']
                        }));
                    };

                    marketWs.onmessage = function(event) {
                        try {
                            const data = JSON.parse(event.data);
                            updateMarketData(data);
                        } catch (e) {
                            console.error('Error parsing market data:', e);
                        }
                    };

                    marketWs.onerror = function(error) {
                        console.error('Market WebSocket error:', error);
                        startMarketPolling(); // Fallback to polling
                    };

                    marketWs.onclose = function() {
                        console.log('Market WebSocket disconnected, reconnecting...');
                        setTimeout(connectMarketWebSocket, 3000);
                    };

                } catch (error) {
                    console.log('Market WebSocket not available, using polling');
                    startMarketPolling();
                }
            }

            // Polling fallback for market data
            function startMarketPolling() {
                setInterval(() => {
                    // Simulate live price updates with random fluctuations
                    updateMarketData({
                        BTC: {
                            price: marketData.BTC.price + (Math.random() - 0.5) * 100,
                            change: marketData.BTC.change + (Math.random() - 0.5) * 0.5
                        },
                        ETH: {
                            price: marketData.ETH.price + (Math.random() - 0.5) * 10,
                            change: marketData.ETH.change + (Math.random() - 0.5) * 0.3
                        }
                    });
                }, 2000); // Poll every 2 seconds
            }

            // Update market data on the page
            function updateMarketData(data) {
                // Update BTC
                if (data.BTC) {
                    const btcCard = document.querySelector('[data-asset="BTC"]');
                    if (btcCard) {
                        const btcPrice = btcCard.querySelector('.btc-price');
                        if (btcPrice) {
                            btcPrice.textContent = '$' + Math.round(data.BTC.price).toLocaleString();
                            btcPrice.classList.add('price-update');
                            setTimeout(() => btcPrice.classList.remove('price-update'), 400);
                        }

                        // Update percentage
                        const changeSpan = btcCard.querySelector('span[style*="color: #22c55e"]') ||
                            btcCard.querySelector('span[style*="color: #ef4444"]');
                        if (changeSpan) {
                            const isPositive = data.BTC.change >= 0;
                            changeSpan.textContent = (isPositive ? '+' : '') + data.BTC.change.toFixed(2) + '%';
                            changeSpan.style.color = isPositive ? '#22c55e' : '#ef4444';
                        }

                        // Update chart bars
                        updateChartBars('btc-chart', data.BTC.price);
                    }
                    marketData.BTC = data.BTC;
                }

                // Update ETH
                if (data.ETH) {
                    const ethCard = document.querySelector('[data-asset="ETH"]');
                    if (ethCard) {
                        const ethPrice = ethCard.querySelector('.eth-price');
                        if (ethPrice) {
                            ethPrice.textContent = '$' + Math.round(data.ETH.price).toLocaleString();
                            ethPrice.classList.add('price-update');
                            setTimeout(() => ethPrice.classList.remove('price-update'), 400);
                        }

                        // Update percentage
                        const changeSpans = ethCard.querySelectorAll('span[style*="color:"]');
                        if (changeSpans.length > 0) {
                            const isPositive = data.ETH.change >= 0;
                            changeSpans[changeSpans.length - 1].textContent = (isPositive ? '+' : '') + data.ETH.change.toFixed(2) + '%';
                            changeSpans[changeSpans.length - 1].style.color = isPositive ? '#22c55e' : '#ef4444';
                        }

                        // Update chart bars
                        updateChartBars('eth-chart', data.ETH.price);
                    }
                    marketData.ETH = data.ETH;
                }
            }

            // Helper function to update chart bars
            function updateChartBars(chartId, price) {
                const chart = document.getElementById(chartId);
                if (!chart) return;

                const bars = chart.querySelectorAll('div[style*="flex:"]');
                bars.forEach(bar => {
                    const randomHeight = Math.random() * 100;
                    bar.style.height = randomHeight + '%';
                });
            }

            // Initialize market data on page load
            document.addEventListener('DOMContentLoaded', connectMarketWebSocket);

            // Cleanup on page unload
            window.addEventListener('beforeunload', () => {
                if (marketWs) marketWs.close();
            });
        </script>



        <!-- AI COMPUTE PLANS SECTION -->
        <div style="
            background: linear-gradient(135deg, rgba(56,189,248,0.05) 0%, rgba(56,189,248,0.02) 100%);
            border: 1px solid rgba(56,189,248,0.15);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 20px 60px rgba(56,189,248,0.08), inset 0 0 30px rgba(56,189,248,0.04);
            backdrop-filter: blur(10px);
            animation: slideUp 0.6s ease 0.2s backwards;
        ">

            <!-- Header -->
            <div style="margin-bottom: 24px;">
                <h5 style="color: #e5e7eb; font-weight: 800; font-size: 18px; margin: 0 0 6px 0; display: flex; align-items: center; gap: 10px;">
                    <i class="icon-cpu" style="color: #38bdf8; font-size: 18px;"></i>
                    AI Compute Plans
                </h5>
                <small style="color: #94a3b8; font-size: 12px;">Lease decentralized AI & cloud compute resources</small>
            </div>

            <!-- Plans List -->
            <div style="display: grid; gap: 14px;">

                @foreach ($plans->take(2) as $plan)
                <div style="
                    background: linear-gradient(135deg, rgba(255,255,255,0.02) 0%, rgba(255,255,255,0.01) 100%);
                    border: 1px solid rgba(255,255,255,0.08);
                    border-radius: 16px;
                    padding: 18px;
                    display: flex;
                    align-items: center;
                    gap: 16px;
                    transition: all 0.3s ease;
                    animation: slideIn 0.6s ease 0.3s backwards;
                "
                    onmouseover="this.style.borderColor='rgba(56,189,248,0.3)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.05) 0%, rgba(56,189,248,0.02) 100%)'; this.style.boxShadow='0 0 20px rgba(56,189,248,0.1)';"
                    onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'; this.style.background='linear-gradient(135deg, rgba(255,255,255,0.02) 0%, rgba(255,255,255,0.01) 100%)'; this.style.boxShadow='none';">

                    <!-- Icon -->
                    <div style="
                        width: 50px;
                        height: 50px;
                        border-radius: 12px;
                        background: rgba(56,189,248,0.1);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border: 1px solid rgba(56,189,248,0.2);
                        flex-shrink: 0;
                    ">
                        <img src="{{ asset('images/coin/'.$plan['icon']) }}"
                            style="width: 26px; height: 26px; object-fit: contain;">
                    </div>

                    <!-- Info -->
                    <div style="flex: 1;">
                        <p style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 4px 0;">
                            {{ $plan['name'] }}
                        </p>
                        <small style="color: #94a3b8; font-size: 11px;">
                            {{ $plan['type'] }} · {{ $plan['duration'] }}
                        </small>
                    </div>

                    <!-- Stats -->
                    <div style="display: flex; gap: 20px; align-items: center;">
                        <div style="text-align: right;">
                            <small style="color: #94a3b8; font-size: 11px; display: block;">Cost</small>
                            <span style="color: #e5e7eb; font-weight: 700; font-size: 13px;">{{ $plan['price'] }} USDT</span>
                        </div>
                        <div style="text-align: right;">
                            <small style="color: #94a3b8; font-size: 11px; display: block;">Yield</small>
                            <span style="color: #22c55e; font-weight: 700; font-size: 13px; background: rgba(34,197,94,0.1); padding: 2px 8px; border-radius: 4px; display: inline-block;">{{ $plan['yield'] }}</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <a href="{{ route('compute.show', $plan->id) }}"
                        style="
                        background: linear-gradient(135deg, #38bdf8, #0ea5e9);
                        color: #020617;
                        padding: 10px 18px;
                        border-radius: 10px;
                        font-weight: 700;
                        font-size: 12px;
                        text-decoration: none;
                        border: none;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        box-shadow: 0 0 15px rgba(56,189,248,0.3);
                        white-space: nowrap;
                    "
                        onmouseover="this.style.boxShadow='0 0 25px rgba(56,189,248,0.5)'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.boxShadow='0 0 15px rgba(56,189,248,0.3)'; this.style.transform='translateY(0)';">
                        Unlock →
                    </a>
                </div>
                @endforeach

            </div>

            <!-- View All Link -->
            @if ($plans->count() > 2)
            <div style="margin-top: 20px; text-align: center; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 20px;">
                <a href="{{ route('compute.track') }}"
                    style="
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    padding: 10px 20px;
                    border-radius: 10px;
                    font-size: 13px;
                    font-weight: 700;
                    color: #38bdf8;
                    background: rgba(56,189,248,0.1);
                    border: 1px solid rgba(56,189,248,0.3);
                    text-decoration: none;
                    transition: all 0.3s ease;
                "
                    onmouseover="this.style.background='rgba(56,189,248,0.15)'; this.style.borderColor='rgba(56,189,248,0.5)';"
                    onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.3)';">
                    View All Plans
                    <span style="font-size: 12px;">→</span>
                </a>
            </div>
            @endif

        </div>

    </div>
</div>

<!-- ANIMATIONS & STYLES -->
<style>
    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-15px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .price-update {
        animation: priceFlash 0.4s ease !important;
    }

    @keyframes priceFlash {

        0%,
        100% {
            color: inherit;
            text-shadow: none;
        }

        50% {
            color: #22c55e;
            text-shadow: 0 0 10px rgba(34, 197, 94, 0.6);
        }
    }

    /* MOBILE RESPONSIVE STYLES */
    @media (max-width: 768px) {

        /* Main container padding adjustments */
        .pt-40 {
            padding-top: 24px !important;
        }

        .pb-80 {
            padding-bottom: 60px !important;
        }

        /* Header greeting responsive */
        .mb-32 h1 {
            font-size: 24px !important;
        }

        /* Two column grid to single column */
        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
            gap: 16px !important;
        }

        /* Margin bottom adjustments */
        .mb-32 {
            margin-bottom: 20px !important;
        }

        /* Balance card padding */
        [style*="padding: 28px"] {
            padding: 20px !important;
        }

        /* Balance font size */
        h2[style*="font-size: 36px"] {
            font-size: 28px !important;
        }

        /* Button sizing */
        a[style*="padding: 12px 16px"] {
            padding: 10px 12px !important;
            font-size: 12px !important;
        }

        /* Quick action buttons flex */
        [style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }

        /* Quick links grid to stack */
        [style*="grid-template-rows: 1fr 1fr"] {
            grid-template-rows: unset !important;
            grid-template-columns: 1fr !important;
        }

        /* Chart grid responsive */
        [style*="grid-template-columns: 1fr 1fr"][style*="gap: 20px"] {
            grid-template-columns: 1fr !important;
            gap: 16px !important;
        }

        /* Plan cards responsive */
        [style*="display: flex"][style*="gap: 16px"][style*="gap: 16px"] {
            flex-wrap: wrap;
        }

        /* Stats display responsive */
        [style*="display: flex"][style*="gap: 20px"][style*="align-items: center"] {
            flex-wrap: wrap;
            gap: 12px !important;
        }

        /* Icon sizing */
        [style*="width: 50px"][style*="height: 50px"] {
            width: 40px !important;
            height: 40px !important;
        }

        /* Section padding */
        [style*="padding: 28px"] {
            padding: 18px !important;
        }

        /* Reduced gaps */
        [style*="gap: 24px"] {
            gap: 16px !important;
        }

        [style*="gap: 14px"] {
            gap: 10px !important;
        }

        /* Text size adjustments */
        small {
            font-size: 10px !important;
        }

        /* Button responsive */
        [style*="padding: 10px 18px"] {
            padding: 8px 14px !important;
            font-size: 11px !important;
            min-width: auto;
        }

        /* Chart height */
        [style*="height: 100px"] {
            height: 80px !important;
        }

        [style*="height: 120px"] {
            height: 100px !important;
        }

        /* Hide/adjust animations on mobile */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    }

    /* TABLET RESPONSIVE (768px - 1024px) */
    @media (min-width: 769px) and (max-width: 1024px) {
        [style*="grid-template-columns: 1fr 1fr"] {
            gap: 18px !important;
        }

        .mb-32 h1 {
            font-size: 28px !important;
        }

        h2[style*="font-size: 36px"] {
            font-size: 32px !important;
        }

        [style*="padding: 28px"] {
            padding: 24px !important;
        }
    }

    /* LARGE SCREENS (1024px+) - Keep original */
    @media (min-width: 1025px) {
        /* Original desktop styles maintained */
    }

    /* Touch device optimizations */
    @media (hover: none) and (pointer: coarse) {

        a,
        button,
        [onclick] {
            padding-top: 12px !important;
            padding-bottom: 12px !important;
        }

        [style*="onmouseover"] {
            /* Remove hover effects on touch devices */
        }
    }
</style>

@endsection