@extends('layouts.app')

@section('title', 'Withdrawal History')
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
        --warning: #f59e0b;
        --danger: #ef4444;
    }

    body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }

    .settings-header {
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

    .history-wrapper {
        min-height: 100vh;
        padding: 80px 20px 40px;
        background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-darker) 100%);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: rgba(56, 189, 248, 0.05);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 16px 12px;
        text-align: center;
    }

    .stat-label {
        font-size: 11px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-light);
    }

    .stat-value.success { color: var(--success); }
    .stat-value.warning { color: var(--warning); }
    .stat-value.danger { color: var(--danger); }

    .section-title {
        color: var(--text-light);
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .empty-box {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-muted);
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: rgba(56, 189, 248, 0.05);
        border: 2px dashed var(--border);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .withdrawal-card {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 18px;
        margin-bottom: 12px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .withdrawal-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--primary);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .withdrawal-card:hover {
        border-color: var(--primary);
        transform: translateX(4px);
        box-shadow: 0 8px 24px rgba(56, 189, 248, 0.15);
    }

    .withdrawal-card:hover::before { opacity: 1; }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 14px;
    }

    .amount-section {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .amount-label {
        font-size: 11px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .amount {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-light);
        letter-spacing: -0.5px;
    }

    .status {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .status::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .status-approved {
        background: rgba(34, 197, 94, 0.15);
        color: var(--success);
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.15);
        color: var(--warning);
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .status-rejected {
        background: rgba(239, 68, 68, 0.15);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .card-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        padding-top: 14px;
        border-top: 1px solid var(--border);
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .detail-label {
        font-size: 10px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-value {
        font-size: 13px;
        color: var(--text-light);
        font-weight: 500;
    }

    @media (min-width: 768px) {
        .history-wrapper {
            padding: 100px 40px;
            max-width: 800px;
            margin: auto;
        }
        .stats-grid { gap: 16px; }
        .stat-card { padding: 20px; }
    }
</style>

<!-- HEADER -->
<div class="settings-header">
    <a href="{{ url()->previous() }}" class="back-btn">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7" />
        </svg>
    </a>
    <h6 class="header-title">Withdrawal History</h6>
    <span class="placeholder"></span>
</div>

<div class="history-wrapper">

    @if(!$withdrawals->isEmpty())
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total</div>
            <div class="stat-value">${{ number_format($withdrawals->sum('amount'), 0) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Approved</div>
            <div class="stat-value success">{{ $withdrawals->where('status', 'approved')->count() }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Pending</div>
            <div class="stat-value warning">{{ $withdrawals->where('status', 'pending')->count() }}</div>
        </div>
    </div>
    @endif

    <h2 class="section-title">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 10h18M3 6h18M3 14h18M3 18h18"/>
        </svg>
        Transaction History
    </h2>

    @if($withdrawals->isEmpty())
    <div class="empty-box">
        <div class="empty-icon">
            <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
            </svg>
        </div>
        <p style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">No Withdrawals Yet</p>
        <p style="font-size: 13px;">Your withdrawal history will appear here</p>
    </div>
    @else

    @foreach($withdrawals as $withdrawal)
    <div class="withdrawal-card">
        <div class="card-header">
            <div class="amount-section">
                <div class="amount-label">Amount</div>
                <div class="amount">${{ number_format($withdrawal->amount, 2) }}</div>
            </div>
            @if($withdrawal->status === 'approved')
            <span class="status status-approved">Approved</span>
            @elseif($withdrawal->status === 'pending')
            <span class="status status-pending">Pending</span>
            @else
            <span class="status status-rejected">Rejected</span>
            @endif
        </div>

        <div class="card-details">
            <div class="detail-item">
                <div class="detail-label">Requested</div>
                <div class="detail-value">{{ $withdrawal->created_at->format('M d, Y') }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Time</div>
                <div class="detail-value">{{ $withdrawal->created_at->format('h:i A') }}</div>
            </div>
        </div>
    </div>
    @endforeach

    @endif

</div>

@endsection