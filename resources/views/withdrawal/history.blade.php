@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Withdrawal History | Cryptexa')

@section('content')

<link rel="stylesheet" href="{{ asset('css/team.css') }}">

<!-- HEADER BAR -->
<div class="team-header">
    <a href="{{ route('account.settings') }}" class="back-btn">
        <i class="icon-left-btn"></i>
    </a>
    <h6 class="header-title">Withdrawal History</h6>
    <span class="placeholder"></span>
</div>

<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh;">
    <div class="tf-container">
        <div style="margin-bottom: 24px; animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 28px; margin: 0 0 8px 0;">Withdrawal History</h1>
            <p style="color: #94a3b8; font-size: 14px; margin: 0;">View all your withdrawal transactions</p>
        </div>

        @if(!$withdrawals->isEmpty())
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 24px; animation: slideUp 0.6s ease 0.1s backwards;">
            <div style="background: linear-gradient(135deg, rgba(56,189,248,0.08), rgba(56,189,248,0.02)); border: 1px solid rgba(56,189,248,0.2); border-radius: 12px; padding: 16px; text-align: center;">
                <div style="color: #38bdf8; font-weight: 900; font-size: 24px; margin-bottom: 4px;">${{ number_format($withdrawals->where('status', 'approved')->sum('amount'), 2) }}</div>
                <div style="color: #94a3b8; font-size: 12px;">Total Withdrawn</div>
            </div>
            <div style="background: linear-gradient(135deg, rgba(34,197,94,0.08), rgba(34,197,94,0.02)); border: 1px solid rgba(34,197,94,0.2); border-radius: 12px; padding: 16px; text-align: center;">
                <div style="color: #22c55e; font-weight: 900; font-size: 24px; margin-bottom: 4px;">{{ $withdrawals->count() }}</div>
                <div style="color: #94a3b8; font-size: 12px;">Transactions</div>
            </div>
            <div style="background: linear-gradient(135deg, rgba(168,85,247,0.08), rgba(168,85,247,0.02)); border: 1px solid rgba(168,85,247,0.2); border-radius: 12px; padding: 16px; text-align: center;">
                <div style="color: #a855f7; font-weight: 900; font-size: 24px; margin-bottom: 4px;">${{ $withdrawals->count() > 0 ? number_format($withdrawals->where('status', 'approved')->avg('amount'), 2) : '0.00' }}</div>
                <div style="color: #94a3b8; font-size: 12px;">Average</div>
            </div>
        </div>
        @endif

        @if($withdrawals->isEmpty())
        <div style="text-align: center; padding: 60px 20px; color: #94a3b8;">
            <div style="font-size: 48px; margin-bottom: 16px;">💸</div>
            <div style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">No Withdrawals Yet</div>
            <div style="font-size: 14px;">Your withdrawal history will appear here</div>
        </div>
        @else
        <div style="display: grid; gap: 12px; animation: slideUp 0.6s ease 0.2s backwards;">
            @foreach($withdrawals as $index => $withdrawal)
            <div style="
                background: linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.02));
                border: 1px solid rgba(255,255,255,0.06);
                border-radius: 12px;
                padding: 16px;
                animation: slideIn 0.5s ease {{ 0.1 * $index }}s backwards;
            ">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 12px;">
                    <div>
                        <div style="color: #e5e7eb; font-weight: 700; font-size: 18px; margin-bottom: 4px;">${{ number_format($withdrawal->amount, 2) }}</div>
                        <div style="color: #64748b; font-size: 13px;">Withdrawal Request</div>
                    </div>
                    @if($withdrawal->status === 'approved')
                    <div style="background: rgba(34,197,94,0.2); color: #22c55e; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Approved</div>
                    @elseif($withdrawal->status === 'pending')
                    <div style="background: rgba(251,191,36,0.2); color: #fbbf24; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Pending</div>
                    @else
                    <div style="background: rgba(239,68,68,0.2); color: #ef4444; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">{{ ucfirst($withdrawal->status) }}</div>
                    @endif
                </div>
                <div style="display: grid; gap: 8px; padding-top: 12px; border-top: 1px solid rgba(255,255,255,0.06);">
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #64748b; font-size: 13px;">Requested</span>
                        <span style="color: #94a3b8; font-size: 13px;">{{ $withdrawal->created_at->format('M d, Y') }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #64748b; font-size: 13px;">Time</span>
                        <span style="color: #94a3b8; font-size: 13px;">{{ $withdrawal->created_at->format('h:i A') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div style="background: linear-gradient(135deg, rgba(56,189,248,0.05), rgba(56,189,248,0.02)); border: 1px solid rgba(56,189,248,0.15); border-radius: 12px; padding: 16px; margin-top: 24px; text-align: center; animation: slideUp 0.6s ease 0.6s backwards;">
            <p style="color: #94a3b8; font-size: 13px; margin: 0 0 8px 0;">
                <span style="color: #38bdf8; font-weight: 600;">⏱️ Processing Time:</span> All withdrawals require admin approval. Processing takes 20 minutes to 24 hours.
            </p>
            <p style="color: #94a3b8; font-size: 13px; margin: 0;">
                <span style="color: #fbbf24; font-weight: 600;">🔒 Security:</span> Your withdrawal is reviewed by our security team before processing.
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

