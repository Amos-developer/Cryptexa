@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Choose Network | Cryptexa')

@section('content')

<link rel="stylesheet" href="{{ asset('css/team.css') }}">

<!-- HEADER BAR -->
<div class="team-header">
    <a href="{{ url()->previous() }}" class="back-btn">
        <i class="icon-left-btn"></i>
    </a>
    <h6 class="header-title">Select Network</h6>
    <span class="placeholder"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh;">
    <div class="tf-container" style="max-width: 500px; margin: 0 auto; padding: 0 20px;">

        <!-- PAGE HEADER -->
        <div style="text-align: center; margin-bottom: 32px; animation: slideDown 0.6s ease;">
            <!-- <div style="width: 60px; height: 60px; margin: 0 auto 16px; background: linear-gradient(135deg, #38bdf8, #0ea5e9); border-radius: 16px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(56,189,248,0.3);">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 6v6l4 2"/>
                </svg>
            </div> -->
            <!-- <h1 style="color: #e5e7eb; font-weight: 900; font-size: 28px; margin: 0 0 8px 0; background: linear-gradient(135deg, #38bdf8, #22d3ee); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Select Network</h1> -->
            <p style="color: #94a3b8; font-size: 14px; margin: 0 0 12px 0;">Choose your preferred blockchain network</p>
            <div style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); border-radius: 10px; padding: 10px 16px; display: inline-block;">
                <span style="color: #22c55e; font-size: 12px; font-weight: 600;">✓ Auto-Credited • Min Deposit $50 • Min Withdrawal $10</span>
            </div>
        </div>

        <!-- DEPOSIT FORM -->
        <form method="POST" action="{{ route('deposit.store') }}" id="deposit-form">

            @csrf

            @php
            $coins = [
            ['name'=>'USDT','symbol'=>'BEP20','network'=>'Binance Smart Chain','currency'=>'usdtbsc','badge'=>'Recommended','color'=>'#26A17B','svg'=>'<svg width="48" height="48" viewBox="0 0 48 48"><circle cx="24" cy="24" r="24" fill="#26A17B"/><path d="M27 19.8V16.8h-6v3h-4.8V22.8h4.8v7.8h-4.8V33.6h4.8v3h6v-3h4.8v-3H27v-7.8h4.8v-3H27z" fill="white"/></svg>','fee'=>'~$0.20','time'=>'1-3 min'],
            ['name'=>'USDC','symbol'=>'BEP20','network'=>'Binance Smart Chain','currency'=>'usdcbsc','badge'=>'Fast','color'=>'#2775CA','svg'=>'<svg width="48" height="48" viewBox="0 0 48 48"><circle cx="24" cy="24" r="24" fill="#2775CA"/><circle cx="24" cy="24" r="10" stroke="white" stroke-width="2" fill="none"/><circle cx="24" cy="24" r="5" fill="white"/></svg>','fee'=>'~$0.20','time'=>'1-3 min'],
            ['name'=>'USDT','symbol'=>'TRC20','network'=>'Tron Network','currency'=>'usdttrc20','badge'=>'Secure','color'=>'#EB0029','svg'=>'<svg width="48" height="48" viewBox="0 0 48 48"><circle cx="24" cy="24" r="24" fill="#EB0029"/><path d="M27 19.8V16.8h-6v3h-4.8V22.8h4.8v7.8h-4.8V33.6h4.8v3h6v-3h4.8v-3H27v-7.8h4.8v-3H27z" fill="white"/></svg>','fee'=>'~$1.00','time'=>'2-5 min'],
            ['name'=>'BNB','symbol'=>'BSC','network'=>'Binance Coin','currency'=>'bnbbsc','badge'=>'Native','color'=>'#F3BA2F','svg'=>'<svg width="48" height="48" viewBox="0 0 48 48"><circle cx="24" cy="24" r="24" fill="#F3BA2F"/><path d="M24 14.4l-3 3L24 20.4l3-3-3-3zm-6 6l-3 3 3 3 3-3-3-3zm12 0l-3 3 3 3 3-3-3-3zm-6 6l-3 3 3 3 3-3-3-3z" fill="white"/></svg>','fee'=>'~$0.15','time'=>'1-2 min'],
            ];
            @endphp

            <!-- COINS GRID -->
            <div style="display: grid; gap: 12px; margin-bottom: 24px;">
                @foreach ($coins as $index => $coin)
                <button
                    type="submit"
                    name="currency"
                    value="{{ $coin['currency'] }}"
                    style="
                        width: 100%;
                        background: linear-gradient(135deg, rgba(56,189,248,0.08), rgba(56,189,248,0.02));
                        border: 1.5px solid rgba(56,189,248,0.2);
                        border-radius: 16px;
                        padding: 16px;
                        display: flex;
                        align-items: center;
                        gap: 14px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        position: relative;
                        overflow: hidden;
                        animation: slideUp 0.6s ease {{ 0.1 * $index }}s backwards;
                    "
                    onmouseover="this.style.transform='translateY(-4px)'; this.style.borderColor='rgba(56,189,248,0.5)'; this.style.boxShadow='0 12px 32px rgba(56,189,248,0.2)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(56,189,248,0.2)'; this.style.boxShadow='none'">
                    
                    <!-- Glow Effect -->
                    <div style="position: absolute; top: 0; right: 0; width: 100px; height: 100px; background: radial-gradient(circle, {{ $coin['color'] }}20 0%, transparent 70%); pointer-events: none;"></div>
                    
                    <!-- Icon -->
                    <div style="flex-shrink: 0;">
                        {!! $coin['svg'] !!}
                    </div>

                    <!-- Info -->
                    <div style="flex: 1; text-align: left;">
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                            <span style="color: #e5e7eb; font-weight: 700; font-size: 16px;">{{ $coin['name'] }}</span>
                            <span style="background: {{ $coin['color'] }}20; color: {{ $coin['color'] }}; padding: 2px 8px; border-radius: 6px; font-size: 10px; font-weight: 600;">{{ $coin['badge'] }}</span>
                        </div>
                        <div style="color: #94a3b8; font-size: 12px; margin-bottom: 6px;">{{ $coin['symbol'] }} • {{ $coin['network'] }}</div>
                        <div style="display: flex; gap: 12px; font-size: 11px;">
                            <span style="color: #64748b;">⚡ {{ $coin['time'] }}</span>
                            <span style="color: #64748b;">💰 {{ $coin['fee'] }}</span>
                        </div>
                    </div>

                    <!-- Arrow -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </button>
                @endforeach
            </div>

        </form>

        <!-- FEATURES -->
        <div style="display: grid; gap: 12px; margin-bottom: 24px; animation: slideUp 0.6s ease 0.4s backwards;">
            <div style="background: rgba(56,189,248,0.05); border: 1px solid rgba(56,189,248,0.15); border-radius: 12px; padding: 14px; display: flex; align-items: center; gap: 12px;">
                <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #38bdf8, #0ea5e9); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <div>
                    <div style="color: #e5e7eb; font-weight: 600; font-size: 13px; margin-bottom: 2px;">Bank-Grade Security</div>
                    <div style="color: #64748b; font-size: 11px;">All transactions are encrypted & verified</div>
                </div>
            </div>
            
            <div style="background: rgba(34,197,94,0.05); border: 1px solid rgba(34,197,94,0.15); border-radius: 12px; padding: 14px; display: flex; align-items: center; gap: 12px;">
                <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #22c55e, #16a34a); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </div>
                <div>
                    <div style="color: #e5e7eb; font-weight: 600; font-size: 13px; margin-bottom: 2px;">Instant Processing</div>
                    <div style="color: #64748b; font-size: 11px;">Deposits automatically credited to your account</div>
                </div>
            </div>
        </div>

        <!-- SECURITY BADGE -->
        <div style="text-align: center; padding: 16px; background: rgba(168,85,247,0.05); border: 1px solid rgba(168,85,247,0.15); border-radius: 12px; animation: slideUp 0.6s ease 0.5s backwards;">
            <div style="color: #a855f7; font-weight: 600; font-size: 12px; margin-bottom: 4px;">🔐 Trusted by 10,000+ Users</div>
            <div style="color: #64748b; font-size: 11px;">Audited & secured by industry standards</div>
        </div>

    </div>
</div>

<!-- ANIMATIONS & STYLES -->
<style>
@keyframes slideDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
@keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
@media (max-width: 768px) {
    .pt-80 { padding-top: 80px !important; }
    h1 { font-size: 24px !important; }
}
</style>

@endsection

@section('scripts')
<script>
document.getElementById('deposit-form').addEventListener('submit', function(e) {
    e.target.querySelectorAll('button').forEach(b => b.disabled = true);
});
</script>
@endsection
