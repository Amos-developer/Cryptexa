@extends('admin.layouts.app')

@section('title', 'Commission Details')
@section('page-title', 'Commission Details')
@section('page-description', 'View commission information')

@section('content')
<div class="container-fluid" style="padding:20px">
  <div class="card" style="background:#fff;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.08);padding:30px">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:30px">
      <h3 style="margin:0;font-size:24px;font-weight:700;color:#1e293b">Commission #{{ $commission->id }}</h3>
      <a href="{{ route('admin.commissions.index') }}" style="padding:10px 20px;background:#f1f5f9;color:#64748b;border-radius:8px;text-decoration:none;font-weight:600">← Back</a>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div style="margin-bottom:20px">
          <label style="display:block;font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px">REFERRER</label>
          <div style="font-size:16px;font-weight:600;color:#1e293b">{{ $commission->user->username ?? 'N/A' }}</div>
          <div style="font-size:14px;color:#64748b">{{ $commission->user->email ?? '' }}</div>
        </div>
      </div>
      <div class="col-md-6">
        <div style="margin-bottom:20px">
          <label style="display:block;font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px">FROM USER</label>
          <div style="font-size:16px;font-weight:600;color:#1e293b">{{ $commission->fromUser->username ?? 'N/A' }}</div>
          <div style="font-size:14px;color:#64748b">{{ $commission->fromUser->email ?? '' }}</div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <div style="margin-bottom:20px">
          <label style="display:block;font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px">LEVEL</label>
          <span style="display:inline-block;padding:8px 16px;border-radius:20px;font-size:14px;font-weight:600;background:#dbeafe;color:#1e40af">Level {{ $commission->level }}</span>
        </div>
      </div>
      <div class="col-md-3">
        <div style="margin-bottom:20px">
          <label style="display:block;font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px">COMMISSION</label>
          <div style="font-size:20px;font-weight:700;color:#059669">${{ number_format($commission->amount, 2) }}</div>
        </div>
      </div>
      <div class="col-md-3">
        <div style="margin-bottom:20px">
          <label style="display:block;font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px">BALANCE BEFORE</label>
          <div style="font-size:16px;font-weight:600;color:#64748b">${{ number_format(($commission->balance_before > 0 ? $commission->balance_before : $commission->user->balance - $commission->amount), 2) }}</div>
        </div>
      </div>
      <div class="col-md-3">
        <div style="margin-bottom:20px">
          <label style="display:block;font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px">BALANCE AFTER</label>
          <div style="font-size:16px;font-weight:600;color:#059669">${{ number_format(($commission->balance_after > 0 ? $commission->balance_after : $commission->user->balance), 2) }}</div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div style="margin-bottom:20px">
          <label style="display:block;font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px">TYPE</label>
          <div style="font-size:16px;color:#1e293b">{{ ucfirst($commission->type) }}</div>
        </div>
      </div>
      <div class="col-md-6">
        <div style="margin-bottom:20px">
          <label style="display:block;font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px">DATE</label>
          <div style="font-size:16px;color:#1e293b">{{ $commission->created_at->format('M d, Y H:i:s') }}</div>
        </div>
      </div>
    </div>

    <div style="margin-top:30px;padding-top:30px;border-top:2px solid #f1f5f9;display:flex;gap:10px">
      <a href="{{ route('admin.commissions.edit', $commission->id) }}" style="padding:12px 24px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;border-radius:8px;text-decoration:none;font-weight:600">Edit Commission</a>
      <form action="{{ route('admin.commissions.destroy', $commission->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this commission?')">
        @csrf
        @method('DELETE')
        <button type="submit" style="padding:12px 24px;background:#fee2e2;color:#991b1b;border:none;border-radius:8px;font-weight:600;cursor:pointer">Delete Commission</button>
      </form>
    </div>
  </div>
</div>
@endsection
