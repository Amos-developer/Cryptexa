@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Deposit History | Cryptexa')

@section('content')

<div class="header fixed-top d-flex justify-content-between align-items-center px-16"
    style="background: linear-gradient(135deg, #020617, #0f172a); border-bottom: 1px solid rgba(56,189,248,0.2); backdrop-filter: blur(10px); z-index: 100; padding: 12px 16px;">
    <a href="{{ route('account.settings') }}"
        style="width: 36px; height: 36px; background: rgba(56,189,248,0.1); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"
        onmouseover="this.style.background='rgba(56,189,248,0.15)'; this.style.borderColor='rgba(56,189,248,0.4)';"
        onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.2)';">
        <i class="icon-left-btn" style="color: #38bdf8; font-size: 18px;"></i>
    </a>
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Deposit History</h6>
    <span style="width: 36px;"></span>
</div>

<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh;">
    <div class="tf-container">
        <div style="margin-bottom: 24px; animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 28px; margin: 0 0 8px 0;">Deposit History</h1>
            <p style="color: #94a3b8; font-size: 14px; margin: 0;">View all your deposit transactions</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 24px; animation: slideUp 0.6s ease 0.1s backwards;">
            <div style="background: linear-gradient(135deg, rgba(56,189,248,0.08), rgba(56,189,248,0.02)); border: 1px solid rgba(56,189,248,0.2); border-radius: 12px; padding: 16px; text-align: center;">
                <div style="color: #38bdf8; font-weight: 900; font-size: 24px; margin-bottom: 4px;">$12,450</div>
                <div style="color: #94a3b8; font-size: 12px;">Total Deposited</div>
            </div>
            <div style="background: linear-gradient(135deg, rgba(34,197,94,0.08), rgba(34,197,94,0.02)); border: 1px solid rgba(34,197,94,0.2); border-radius: 12px; padding: 16px; text-align: center;">
                <div style="color: #22c55e; font-weight: 900; font-size: 24px; margin-bottom: 4px;">24</div>
                <div style="color: #94a3b8; font-size: 12px;">Transactions</div>
            </div>
            <div style="background: linear-gradient(135deg, rgba(168,85,247,0.08), rgba(168,85,247,0.02)); border: 1px solid rgba(168,85,247,0.2); border-radius: 12px; padding: 16px; text-align: center;">
                <div style="color: #a855f7; font-weight: 900; font-size: 24px; margin-bottom: 4px;">$520</div>
                <div style="color: #94a3b8; font-size: 12px;">Average</div>
            </div>
        </div>

        @php
        $deposits = [
            ['amount' => '$500.00', 'currency' => 'USDT BEP20', 'date' => '2024-01-15 14:30', 'status' => 'completed', 'txid' => '0x7a8b...3f2e'],
            ['amount' => '$1,200.00', 'currency' => 'USDC BEP20', 'date' => '2024-01-14 09:15', 'status' => 'completed', 'txid' => '0x9c4d...8a1b'],
            ['amount' => '$750.00', 'currency' => 'USDT TRC20', 'date' => '2024-01-12 16:45', 'status' => 'completed', 'txid' => '0x2e5f...6d9c'],
            ['amount' => '$300.00', 'currency' => 'BNB BSC', 'date' => '2024-01-10 11:20', 'status' => 'pending', 'txid' => '0x4b7a...2c8e'],
        ];
        @endphp

        <div style="display: grid; gap: 12px; animation: slideUp 0.6s ease 0.2s backwards;">
            @foreach($deposits as $index => $deposit)
            <div style="
                background: linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.02));
                border: 1px solid rgba(255,255,255,0.06);
                border-radius: 12px;
                padding: 16px;
                animation: slideIn 0.5s ease {{ 0.1 * $index }}s backwards;
            ">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 12px;">
                    <div>
                        <div style="color: #e5e7eb; font-weight: 700; font-size: 18px; margin-bottom: 4px;">{{ $deposit['amount'] }}</div>
                        <div style="color: #64748b; font-size: 13px;">{{ $deposit['currency'] }}</div>
                    </div>
                    @if($deposit['status'] === 'completed')
                    <div style="background: rgba(34,197,94,0.2); color: #22c55e; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Completed</div>
                    @else
                    <div style="background: rgba(251,191,36,0.2); color: #fbbf24; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Pending</div>
                    @endif
                </div>
                <div style="display: grid; gap: 8px; padding-top: 12px; border-top: 1px solid rgba(255,255,255,0.06);">
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #64748b; font-size: 13px;">Date</span>
                        <span style="color: #94a3b8; font-size: 13px;">{{ $deposit['date'] }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #64748b; font-size: 13px;">Transaction ID</span>
                        <span style="color: #38bdf8; font-size: 13px; font-family: monospace;">{{ $deposit['txid'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div style="background: linear-gradient(135deg, rgba(56,189,248,0.05), rgba(56,189,248,0.02)); border: 1px solid rgba(56,189,248,0.15); border-radius: 12px; padding: 16px; margin-top: 24px; text-align: center; animation: slideUp 0.6s ease 0.6s backwards;">
            <p style="color: #94a3b8; font-size: 13px; margin: 0;">
                <span style="color: #38bdf8; font-weight: 600;">💡 Tip:</span> All deposits are processed automatically and reflected in your balance within minutes
            </p>
        </div>
    </div>
</div>

<style>
    @keyframes slideDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: translateX(-15px); } to { opacity: 1; transform: translateX(0); } }
    @media (max-width: 768px) {
        .pt-80 { padding-top: 80px !important; }
        h1[style*="font-size: 28px"] { font-size: 24px !important; }
        [style*="grid-template-columns: repeat(3, 1fr)"] { grid-template-columns: 1fr !important; gap: 8px !important; }
        [style*="font-size: 24px"] { font-size: 20px !important; }
    }
</style>

@endsection
