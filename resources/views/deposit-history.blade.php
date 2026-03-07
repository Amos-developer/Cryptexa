@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Deposit History | Cryptexa')

@section('content')

<link rel="stylesheet" href="{{ asset('css/team.css') }}">

<!-- HEADER BAR -->
<div class="team-header">
    <a href="{{ route('account.settings') }}" class="back-btn">
        <i class="icon-left-btn"></i>
    </a>
    <h6 class="header-title">Deposit History</h6>
    <span class="placeholder"></span>
</div>

<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh;">
    <div class="tf-container">
        <!-- <div style="margin-bottom: 24px; animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 28px; margin: 0 0 8px 0;">Deposit History</h1>
            <p style="color: #94a3b8; font-size: 14px; margin: 0;">View all your deposit transactions</p>
        </div> -->

        <!-- Portfolio Overview Card -->
        <div class="portfolio-overview" style="
            background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(34,197,94,0.05));
            border: 1px solid rgba(56,189,248,0.3);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
            animation: slideUp 0.6s ease 0.1s backwards;
            box-shadow: 0 8px 32px rgba(56,189,248,0.1);
        ">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="
                    width: 48px;
                    height: 48px;
                    background: linear-gradient(135deg, #22c55e, #16a34a);
                    border-radius: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0 4px 16px rgba(34,197,94,0.4);
                ">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                        <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/>
                        <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/>
                        <path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/>
                    </svg>
                </div>
                <div>
                    <h3 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Deposit Summary</h3>
                    <p style="color: #94a3b8; font-size: 12px; margin: 0;">Your deposit analytics</p>
                </div>
            </div>
            
            <div class="stats-grid" style="display: grid; gap: 12px;">
                <div style="
                    background: linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.05));
                    border: 1px solid rgba(56,189,248,0.3);
                    border-radius: 12px;
                    padding: 16px;
                ">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23"/>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                        </svg>
                        <span style="color: #94a3b8; font-size: 12px; font-weight: 600;">Total Deposited</span>
                    </div>
                    <div style="color: #38bdf8; font-weight: 900; font-size: 28px;">${{ number_format($deposits->where('status', 'completed')->sum('amount'), 2) }}</div>
                    <div style="color: #64748b; font-size: 11px; margin-top: 4px;">Completed deposits</div>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div style="
                        background: linear-gradient(135deg, rgba(34,197,94,0.15), rgba(34,197,94,0.05));
                        border: 1px solid rgba(34,197,94,0.3);
                        border-radius: 12px;
                        padding: 16px;
                    ">
                        <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 8px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2">
                                <path d="M3 3v18h18"/>
                                <path d="m19 9-5 5-4-4-3 3"/>
                            </svg>
                            <span style="color: #94a3b8; font-size: 11px; font-weight: 600;">Transactions</span>
                        </div>
                        <div style="color: #22c55e; font-weight: 900; font-size: 24px;">{{ $deposits->count() }}</div>
                        <div style="color: #64748b; font-size: 10px; margin-top: 4px;">Total deposits</div>
                    </div>
                    
                    <div style="
                        background: linear-gradient(135deg, rgba(168,85,247,0.15), rgba(168,85,247,0.05));
                        border: 1px solid rgba(168,85,247,0.3);
                        border-radius: 12px;
                        padding: 16px;
                    ">
                        <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 8px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            <span style="color: #94a3b8; font-size: 11px; font-weight: 600;">Pending</span>
                        </div>
                        <div style="color: #a855f7; font-weight: 900; font-size: 24px;">{{ $deposits->whereIn('status', ['pending', 'confirming', 'waiting'])->count() }}</div>
                        <div style="color: #64748b; font-size: 10px; margin-top: 4px;">Awaiting confirmation</div>
                    </div>
                </div>
            </div>
        </div>

        @if($deposits->isEmpty())
        <div style="text-align: center; padding: 60px 20px; color: #94a3b8;">
            <div style="font-size: 48px; margin-bottom: 16px;">📭</div>
            <div style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">No Deposits Yet</div>
            <div style="font-size: 14px;">Your deposit history will appear here</div>
        </div>
        @else
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
                        @if($deposit->status === 'completed')
                        <div style="color: #e5e7eb; font-weight: 700; font-size: 18px; margin-bottom: 4px;">${{ number_format($deposit->amount, 2) }}</div>
                        @else
                        <div style="color: #e5e7eb; font-weight: 700; font-size: 18px; margin-bottom: 4px;">---</div>
                        @endif
                        <div style="color: #64748b; font-size: 13px;">{{ strtoupper($deposit->currency) }}</div>
                    </div>
                    @if($deposit->status === 'completed')
                    <div style="background: rgba(34,197,94,0.2); color: #22c55e; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Completed</div>
                    @elseif($deposit->status === 'pending')
                    <div style="background: rgba(251,191,36,0.2); color: #fbbf24; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Pending</div>
                    @else
                    <div style="background: rgba(239,68,68,0.2); color: #ef4444; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">{{ ucfirst($deposit->status) }}</div>
                    @endif
                </div>
                <div style="display: grid; gap: 8px; padding-top: 12px; border-top: 1px solid rgba(255,255,255,0.06);">
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #64748b; font-size: 13px;">Date</span>
                        <span style="color: #94a3b8; font-size: 13px;">{{ $deposit->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                    @if($deposit->payment_id)
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #64748b; font-size: 13px;">Payment ID</span>
                        <span style="color: #38bdf8; font-size: 13px; font-family: monospace;">{{ substr($deposit->payment_id, 0, 8) }}...{{ substr($deposit->payment_id, -4) }}</span>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

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
    
    /* Mobile-first responsive design */
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    @media (min-width: 640px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .pt-80 { padding-top: 80px !important; }
        h1[style*="font-size: 28px"] { font-size: 22px !important; }
        .portfolio-overview { padding: 16px !important; }
        .portfolio-overview [style*="font-size: 28px"] { font-size: 24px !important; }
        .portfolio-overview [style*="font-size: 24px"] { font-size: 20px !important; }
    }
    
    @media (max-width: 480px) {
        .portfolio-overview [style*="font-size: 28px"] { font-size: 22px !important; }
        .portfolio-overview [style*="font-size: 24px"] { font-size: 18px !important; }
    }
</style>

@endsection
