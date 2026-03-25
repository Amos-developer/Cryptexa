@extends('admin.layouts.app')

@section('title', 'Edit User Vault')
@section('page-title', 'Edit User Vault')
@section('page-description', 'Update user Vault information')

@section('content')
<style>
.form-card{background:#fff;border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,.08);max-width:800px}
.form-group{margin-bottom:24px}
.form-label{display:block;font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase;margin-bottom:8px}
.form-input,.form-select{width:100%;padding:12px 16px;border:2px solid #e2e8f0;border-radius:10px;font-size:15px;transition:all .3s}
.form-input:focus,.form-select:focus{outline:0;border-color:#667eea;box-shadow:0 0 0 3px rgba(102,126,234,.1)}
.btn-back{padding:10px 20px;border:none;border-radius:10px;font-weight:600;font-size:14px;background:#f1f5f9;color:#64748b;text-decoration:none;display:inline-block}
.btn-submit{padding:12px 32px;border:none;border-radius:10px;font-weight:600;font-size:14px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;cursor:pointer;margin-left:8px}
</style>

<div class="container-fluid" style="padding:20px">
  <div style="margin-bottom:20px">
    <a href="{{ route('admin.user-pools.index') }}" class="btn-back">← Back to List</a>
  </div>

  <div class="form-card">
    <h3 style="font-size:24px;font-weight:700;color:#1e293b;margin-bottom:24px">Edit User Vault #{{ $userPool->id }}</h3>
    
    <form action="{{ route('admin.user-pools.update', $userPool) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label class="form-label">User</label>
        <input type="text" class="form-input" value="{{ $userPool->user->username ?? 'Unknown' }}" disabled>
      </div>

      <div class="form-group">
        <label class="form-label">Vault Name</label>
        <input type="text" class="form-input" value="{{ $userPool->computePlan->name ?? 'N/A' }}" disabled>
        <small style="color:#64748b;font-size:12px;margin-top:4px;display:block">
          Range: ${{ number_format($userPool->computePlan->price ?? 0, 2) }} - ${{ $userPool->computePlan->max_investment ? number_format($userPool->computePlan->max_investment, 2) : 'Unlimited' }}
        </small>
      </div>

      <div class="form-group">
        <label class="form-label">Amount Invested ($)</label>
        <input type="number" name="amount" class="form-input" step="0.01" 
               min="{{ $userPool->computePlan->price ?? 0 }}" 
               max="{{ $userPool->computePlan->max_investment ?? '' }}" 
               value="{{ $userPool->principal_amount }}" required>
        @error('amount')
          <small style="color:#ef4444;font-size:12px;margin-top:4px;display:block">{{ $message }}</small>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
          <option value="running" {{ $userPool->status == 'running' ? 'selected' : '' }}>Running</option>
          <option value="completed" {{ $userPool->status == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
      </div>

      <div class="form-group">
        <label class="form-label">Expected Profit ($)</label>
        <input type="number" name="expected_profit" class="form-input" step="0.01" min="0" value="{{ $userPool->expected_profit ?? 0 }}">
      </div>

      <div style="margin-top:32px">
        <button type="submit" class="btn-submit">💾 Update Vault</button>
      </div>
    </form>
  </div>
</div>
@endsection
