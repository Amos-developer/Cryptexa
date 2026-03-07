@extends('admin.layouts.app')

@section('title', 'Edit Commission')
@section('page-title', 'Edit Commission')
@section('page-description', 'Update commission details')

@section('content')
<div class="container-fluid" style="padding:20px">
  <div class="card" style="background:#fff;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.08);padding:30px;max-width:800px;margin:0 auto">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:30px">
      <h3 style="margin:0;font-size:24px;font-weight:700;color:#1e293b">Edit Commission #{{ $commission->id }}</h3>
      <a href="{{ route('admin.commissions.show', $commission->id) }}" style="padding:10px 20px;background:#f1f5f9;color:#64748b;border-radius:8px;text-decoration:none;font-weight:600">← Back</a>
    </div>

    <form action="{{ route('admin.commissions.update', $commission->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div style="margin-bottom:20px">
        <label style="display:block;font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px">REFERRER</label>
        <div style="padding:12px;background:#f8fafc;border-radius:8px;font-size:16px;color:#1e293b">{{ $commission->user->username ?? 'N/A' }}</div>
      </div>

      <div style="margin-bottom:20px">
        <label style="display:block;font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px">FROM USER</label>
        <div style="padding:12px;background:#f8fafc;border-radius:8px;font-size:16px;color:#1e293b">{{ $commission->fromUser->username ?? 'N/A' }}</div>
      </div>

      <div style="margin-bottom:20px">
        <label for="amount" style="display:block;font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px">COMMISSION AMOUNT ($)</label>
        <input type="number" name="amount" id="amount" step="0.01" min="0" value="{{ old('amount', $commission->amount) }}" required style="width:100%;padding:12px;border:2px solid #e2e8f0;border-radius:8px;font-size:16px">
        @error('amount')
        <div style="color:#dc2626;font-size:14px;margin-top:5px">{{ $message }}</div>
        @enderror
      </div>

      <div style="margin-bottom:20px">
        <label for="level" style="display:block;font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px">LEVEL</label>
        <select name="level" id="level" required style="width:100%;padding:12px;border:2px solid #e2e8f0;border-radius:8px;font-size:16px">
          <option value="1" {{ old('level', $commission->level) == 1 ? 'selected' : '' }}>Level 1 (2%)</option>
          <option value="2" {{ old('level', $commission->level) == 2 ? 'selected' : '' }}>Level 2 (1%)</option>
          <option value="3" {{ old('level', $commission->level) == 3 ? 'selected' : '' }}>Level 3 (0.5%)</option>
        </select>
        @error('level')
        <div style="color:#dc2626;font-size:14px;margin-top:5px">{{ $message }}</div>
        @enderror
      </div>

      <div style="margin-top:30px;padding-top:30px;border-top:2px solid #f1f5f9;display:flex;gap:10px">
        <button type="submit" style="padding:12px 24px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;border:none;border-radius:8px;font-weight:600;cursor:pointer">Update Commission</button>
        <a href="{{ route('admin.commissions.show', $commission->id) }}" style="padding:12px 24px;background:#f1f5f9;color:#64748b;border-radius:8px;text-decoration:none;font-weight:600;display:inline-block">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
