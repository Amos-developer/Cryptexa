@extends('admin.layouts.app')

@section('title', 'Withdrawal Details')
@section('page-title', 'Withdrawal Details')
@section('page-description', 'View withdrawal information')

@section('content')
<style>
@media (prefers-color-scheme: dark){:root{--bg-card:#1e293b;--text-primary:#e2e8f0;--text-secondary:#94a3b8;--border-color:#334155}}
@media (prefers-color-scheme: light){:root{--bg-card:#fff;--text-primary:#1e293b;--text-secondary:#64748b;--border-color:#e2e8f0}}
.detail-card{background:var(--bg-card);border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,.08);max-width:800px;margin:0 auto}
.card-header{text-align:center;margin-bottom:32px}
.card-icon{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#f093fb,#f5576c);display:inline-flex;align-items:center;justify-content:center;font-size:36px;margin-bottom:16px;box-shadow:0 8px 24px rgba(240,147,251,.3)}
.card-title{font-size:28px;font-weight:700;color:var(--text-primary);margin-bottom:8px}
.info-grid{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:32px}
.info-item{padding:20px;background:#f8fafc;border-radius:12px}
.info-label{font-size:12px;color:var(--text-secondary);font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px}
.info-value{font-size:18px;font-weight:700;color:var(--text-primary)}
.status-badge{display:inline-block;padding:8px 16px;border-radius:20px;font-size:14px;font-weight:600}
.status-pending{background:#fef3c7;color:#92400e}
.status-approved{background:#dbeafe;color:#1e40af}
.status-completed{background:#d1fae5;color:#065f46}
.status-rejected{background:#fee2e2;color:#991b1b}
.actions{display:flex;gap:12px;padding-top:24px;border-top:2px solid var(--border-color)}
.btn{flex:1;padding:14px 24px;border:none;border-radius:10px;font-weight:600;font-size:15px;cursor:pointer;transition:all .3s;text-decoration:none;text-align:center}
.btn-back{background:#f1f5f9;color:#64748b}
.btn-back:hover{background:#e2e8f0}
.btn-approve{background:linear-gradient(135deg,#11998e,#38ef7d);color:#fff}
.btn-reject{background:linear-gradient(135deg,#f093fb,#f5576c);color:#fff}
@media (prefers-color-scheme: dark){.info-item{background:#334155}.btn-back{background:#334155;color:#e2e8f0}}
@media(max-width:768px){
.info-grid{grid-template-columns:1fr}
.actions{flex-direction:column}
}
</style>

<div class="container-fluid" style="padding:20px">
  <div class="detail-card">
    <div class="card-header">
      <div class="card-icon">💸</div>
      <h2 class="card-title">Withdrawal #{{ $withdrawal->id }}</h2>
      <div>
        @if($withdrawal->status == 'completed')
          <span class="status-badge status-completed">✓ Completed</span>
        @elseif($withdrawal->status == 'approved')
          <span class="status-badge status-approved">👍 Approved</span>
        @elseif($withdrawal->status == 'pending')
          <span class="status-badge status-pending">⏳ Pending</span>
        @else
          <span class="status-badge status-rejected">✗ Rejected</span>
        @endif
      </div>
    </div>

    <div class="info-grid">
      <div class="info-item">
        <div class="info-label">👤 User</div>
        <div class="info-value">{{ $withdrawal->user->username ?? 'Unknown' }}</div>
      </div>
      <div class="info-item">
        <div class="info-label">✉️ Email</div>
        <div class="info-value" style="font-size:14px">{{ $withdrawal->user->email ?? 'N/A' }}</div>
      </div>
      <div class="info-item">
        <div class="info-label">💰 Amount</div>
        <div class="info-value" style="color:#dc2626">${{ number_format($withdrawal->amount, 2) }}</div>
      </div>
      <div class="info-item">
        <div class="info-label">💱 Currency</div>
        <div class="info-value">{{ strtoupper($withdrawal->currency ?? 'USD') }}</div>
      </div>
      <div class="info-item" style="grid-column:1/-1">
        <div class="info-label">📍 Withdrawal Address</div>
        <div class="info-value" style="font-size:14px;word-break:break-all">{{ $withdrawal->address ?? 'N/A' }}</div>
      </div>
      @if($withdrawal->txid)
      <div class="info-item" style="grid-column:1/-1">
        <div class="info-label">🔗 Transaction ID</div>
        <div class="info-value" style="font-size:14px;word-break:break-all">{{ $withdrawal->txid }}</div>
      </div>
      @endif
      <div class="info-item">
        <div class="info-label">📅 Requested At</div>
        <div class="info-value" style="font-size:16px">{{ $withdrawal->created_at->format('M d, Y H:i') }}</div>
      </div>
      <div class="info-item">
        <div class="info-label">🕐 Updated At</div>
        <div class="info-value" style="font-size:16px">{{ $withdrawal->updated_at->format('M d, Y H:i') }}</div>
      </div>
    </div>

    <div class="actions">
      <a href="{{ route('admin.withdrawals.index') }}" class="btn btn-back">← Back to List</a>
      @if($withdrawal->status == 'pending')
        <form action="{{ route('admin.withdrawals.approve', $withdrawal) }}" method="POST" style="flex:1">
          @csrf
          <button type="submit" class="btn btn-approve" style="width:100%" onclick="return confirm('Approve this withdrawal?')">✓ Approve</button>
        </form>
        <form action="{{ route('admin.withdrawals.reject', $withdrawal) }}" method="POST" style="flex:1">
          @csrf
          <button type="submit" class="btn btn-reject" style="width:100%" onclick="return confirm('Reject and refund?')">✗ Reject</button>
        </form>
      @endif
    </div>
  </div>
</div>
@endsection
