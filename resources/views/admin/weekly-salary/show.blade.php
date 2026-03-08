@extends('admin.layouts.app')

@section('title', 'Payment Details')
@section('page-title', 'Weekly Salary Payment Details')
@section('page-description', 'View payment information')

@section('content')
<style>
.detail-card{background:#fff;border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,.08);max-width:700px}
.detail-row{display:flex;justify-content:space-between;padding:16px 0;border-bottom:1px solid #f1f5f9}
.detail-row:last-child{border-bottom:none}
.detail-label{font-size:14px;font-weight:600;color:#64748b}
.detail-value{font-size:14px;font-weight:700;color:#1e293b}
.btn-back{padding:10px 20px;border:none;border-radius:10px;font-weight:600;font-size:14px;background:#f1f5f9;color:#64748b;text-decoration:none;display:inline-block;transition:all .3s}
.btn-back:hover{background:#e2e8f0}
.btn-delete{padding:10px 20px;border:none;border-radius:10px;font-weight:600;font-size:14px;background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff;cursor:pointer;transition:all .3s}
.btn-delete:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(239,68,68,.4)}
</style>

<div class="container-fluid" style="padding:20px">
  <div class="detail-card">
    <div style="margin-bottom:24px">
      <h3 style="font-size:24px;font-weight:700;color:#1e293b;margin:0 0 8px">Payment Information</h3>
      <p style="color:#64748b;margin:0">Payment ID: #{{ $payment->id }}</p>
    </div>

    <div class="detail-row">
      <span class="detail-label">Date & Time</span>
      <span class="detail-value">{{ $payment->created_at->format('M d, Y H:i:s') }}</span>
    </div>

    <div class="detail-row">
      <span class="detail-label">Username</span>
      <span class="detail-value">
        <a href="{{ route('admin.users.show', $payment->user) }}" style="color:#667eea;text-decoration:none">
          {{ $payment->user->username }}
        </a>
      </span>
    </div>

    <div class="detail-row">
      <span class="detail-label">Account ID</span>
      <span class="detail-value">
        <code style="background:#f1f5f9;padding:4px 8px;border-radius:6px">{{ $payment->user->account_id }}</code>
      </span>
    </div>

    <div class="detail-row">
      <span class="detail-label">Rank</span>
      <span class="detail-value">{{ $payment->rank }}</span>
    </div>

    <div class="detail-row">
      <span class="detail-label">Active Members</span>
      <span class="detail-value" style="color:#059669">{{ $payment->active_members }}</span>
    </div>

    <div class="detail-row">
      <span class="detail-label">Amount Paid</span>
      <span class="detail-value" style="color:#059669;font-size:20px">${{ number_format($payment->amount, 2) }}</span>
    </div>

    <div class="detail-row">
      <span class="detail-label">Paid By</span>
      <span class="detail-value">{{ $payment->admin->username }}</span>
    </div>

    @if($payment->note)
    <div class="detail-row">
      <span class="detail-label">Note</span>
      <span class="detail-value">{{ $payment->note }}</span>
    </div>
    @endif

    <div style="display:flex;gap:12px;margin-top:32px">
      <a href="{{ route('admin.weekly-salary.history') }}" class="btn-back">← Back to History</a>
      <form action="{{ route('admin.weekly-salary.destroy', $payment) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this payment record?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">🗑️ Delete Record</button>
      </form>
    </div>
  </div>
</div>
@endsection
