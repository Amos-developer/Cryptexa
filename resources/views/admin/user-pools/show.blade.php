@extends('admin.layouts.app')

@section('title', 'User Vault Details')
@section('page-title', 'User Vault Details')
@section('page-description', 'View user Vault information')

@section('content')
<style>
.detail-card{background:#fff;border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,.08);margin-bottom:24px}
.detail-row{display:grid;grid-template-columns:200px 1fr;gap:16px;padding:16px 0;border-bottom:1px solid #f1f5f9}
.detail-row:last-child{border-bottom:none}
.detail-label{font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase}
.detail-value{font-size:15px;color:#1e293b;font-weight:600}
.status-badge{display:inline-block;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600}
.status-active{background:#d1fae5;color:#065f46}
.status-inactive{background:#fee2e2;color:#991b1b}
.btn-back{padding:10px 20px;border:none;border-radius:10px;font-weight:600;font-size:14px;background:#f1f5f9;color:#64748b;text-decoration:none;display:inline-block}
.btn-edit{padding:10px 20px;border:none;border-radius:10px;font-weight:600;font-size:14px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;text-decoration:none;display:inline-block;margin-left:8px}
</style>

<div class="container-fluid" style="padding:20px">
  <div style="margin-bottom:20px">
    <a href="{{ route('admin.user-Vaults.index') }}" class="btn-back">← Back to List</a>
    <a href="{{ route('admin.user-Vaults.edit', $userVault) }}" class="btn-edit">✏️ Edit</a>
  </div>

  <div class="detail-card">
    <h3 style="font-size:24px;font-weight:700;color:#1e293b;margin-bottom:24px">Vault Information</h3>
    
    <div class="detail-row">
      <div class="detail-label">Vault ID</div>
      <div class="detail-value">#{{ $userVault->id }}</div>
    </div>

    <div class="detail-row">
      <div class="detail-label">User</div>
      <div class="detail-value">
        @if($userVault->user)
          <a href="{{ route('admin.users.show', $userVault->user) }}" style="color:#667eea;text-decoration:none">{{ $userVault->user->username }}</a>
        @else
          Unknown
        @endif
      </div>
    </div>

    <div class="detail-row">
      <div class="detail-label">Vault Name</div>
      <div class="detail-value">{{ $userVault->computePlan->name ?? 'N/A' }}</div>
    </div>

    <div class="detail-row">
      <div class="detail-label">Vault Type</div>
      <div class="detail-value"><code style="background:#f1f5f9;padding:4px 8px;border-radius:6px">{{ strtoupper($userVault->computePlan->type ?? 'N/A') }}</code></div>
    </div>

    <div class="detail-row">
      <div class="detail-label">Status</div>
      <div class="detail-value">
        @if($userVault->status == 'running')
          <span class="status-badge status-active">✓ Running</span>
        @else
          <span class="status-badge status-inactive">✗ Completed</span>
        @endif
      </div>
    </div>

    <div class="detail-row">
      <div class="detail-label">Expected Profit</div>
      <div class="detail-value" style="color:#059669;font-size:20px">${{ number_format($userVault->expected_profit ?? 0, 2) }}</div>
    </div>

    <div class="detail-row">
      <div class="detail-label">Started At</div>
      <div class="detail-value">{{ $userVault->started_at ? $userVault->started_at->format('M d, Y H:i:s') : 'N/A' }}</div>
    </div>

    <div class="detail-row">
      <div class="detail-label">End Time</div>
      <div class="detail-value">{{ $userVault->ends_at ? $userVault->ends_at->format('M d, Y H:i:s') : 'N/A' }}</div>
    </div>

    <div class="detail-row">
      <div class="detail-label">Duration</div>
      <div class="detail-value">{{ $userVault->computePlan->duration_minutes ?? 'N/A' }} minutes</div>
    </div>
  </div>
</div>
@endsection
