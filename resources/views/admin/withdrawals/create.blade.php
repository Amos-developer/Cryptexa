@extends('admin.layouts.app')

@section('title', 'Create Withdrawal')
@section('page-title', 'Create Withdrawal')
@section('page-description', 'Create manual withdrawal')

@section('content')
<style>
@media (prefers-color-scheme: dark){:root{--bg-card:#1e293b;--text-primary:#e2e8f0;--text-secondary:#94a3b8;--border-color:#334155;--input-bg:#0f172a}}
@media (prefers-color-scheme: light){:root{--bg-card:#fff;--text-primary:#1e293b;--text-secondary:#64748b;--border-color:#e2e8f0;--input-bg:#fff}}
.edit-card{background:var(--bg-card);border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,.08);max-width:800px;margin:0 auto}
.card-header{text-align:center;margin-bottom:32px}
.card-icon{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#f093fb,#f5576c);display:inline-flex;align-items:center;justify-content:center;font-size:36px;margin-bottom:16px;box-shadow:0 8px 24px rgba(240,147,251,.3)}
.card-title{font-size:28px;font-weight:700;color:var(--text-primary);margin-bottom:8px}
.card-subtitle{font-size:14px;color:var(--text-secondary)}
.form-grid{display:grid;grid-template-columns:1fr;gap:24px}
.form-group{display:flex;flex-direction:column}
.form-label{font-size:13px;font-weight:600;color:var(--text-secondary);margin-bottom:8px;text-transform:uppercase;letter-spacing:.5px}
.form-label .required{color:#ef4444}
.form-input,.form-select,.form-textarea{width:100%;padding:12px 16px;border:2px solid var(--border-color);border-radius:10px;font-size:15px;background:var(--input-bg);color:var(--text-primary);transition:all .3s}
.form-textarea{min-height:100px;resize:vertical;font-family:inherit}
.form-input:focus,.form-select:focus,.form-textarea:focus{outline:0;border-color:#f093fb;box-shadow:0 0 0 3px rgba(240,147,251,.1)}
.form-input.error{border-color:#ef4444}
.error-message{font-size:12px;color:#ef4444;margin-top:6px}
.input-group{position:relative}
.input-prefix{position:absolute;left:16px;top:50%;transform:translateY(-50%);font-size:16px;font-weight:600;color:var(--text-secondary)}
.input-group .form-input{padding-left:40px}
.form-actions{display:flex;gap:12px;margin-top:32px;padding-top:24px;border-top:2px solid var(--border-color)}
.btn{flex:1;padding:14px 24px;border:none;border-radius:10px;font-weight:600;font-size:15px;cursor:pointer;transition:all .3s}
.btn-cancel{background:#f1f5f9;color:#64748b}
.btn-cancel:hover{background:#e2e8f0}
.btn-submit{background:linear-gradient(135deg,#f093fb,#f5576c);color:#fff}
.btn-submit:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(240,147,251,.4)}
@media (prefers-color-scheme: dark){.btn-cancel{background:#334155;color:#e2e8f0}.btn-cancel:hover{background:#475569}}
@media(max-width:768px){
.edit-card{padding:24px}
.card-icon{width:64px;height:64px;font-size:28px}
.card-title{font-size:24px}
.form-actions{flex-direction:column-reverse}
.btn{width:100%}
}
</style>

<div class="container-fluid" style="padding:20px">
  <div class="edit-card">
    <div class="card-header">
      <div class="card-icon">💸</div>
      <h2 class="card-title">Create Withdrawal</h2>
      <p class="card-subtitle">Process manual withdrawal request</p>
    </div>

    <form action="{{ route('admin.withdrawals.store') }}" method="POST">
      @csrf
      
      <div class="form-grid">
        <div class="form-group">
          <label class="form-label">👤 User <span class="required">*</span></label>
          <select name="user_id" class="form-select @error('user_id') error @enderror" required>
            <option value="">Select User</option>
            @foreach($users as $user)
              <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->username }} ({{ $user->email }})</option>
            @endforeach
          </select>
          @error('user_id')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">💵 Amount <span class="required">*</span></label>
          <div class="input-group">
            <span class="input-prefix">$</span>
            <input type="number" step="0.01" min="0.01" name="amount" class="form-input @error('amount') error @enderror" value="{{ old('amount') }}" required>
          </div>
          @error('amount')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">💱 Currency <span class="required">*</span></label>
          <select name="currency" class="form-select @error('currency') error @enderror" required>
            <option value="usd" {{ old('currency') == 'usd' ? 'selected' : '' }}>USD</option>
            <option value="btc" {{ old('currency') == 'btc' ? 'selected' : '' }}>BTC</option>
            <option value="eth" {{ old('currency') == 'eth' ? 'selected' : '' }}>ETH</option>
            <option value="usdt" {{ old('currency') == 'usdt' ? 'selected' : '' }}>USDT</option>
          </select>
          @error('currency')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">📍 Withdrawal Address <span class="required">*</span></label>
          <textarea name="address" class="form-textarea @error('address') error @enderror" required>{{ old('address') }}</textarea>
          @error('address')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">📊 Status <span class="required">*</span></label>
          <select name="status" class="form-select @error('status') error @enderror" required>
            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
          </select>
          @error('status')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">🔗 Transaction ID</label>
          <input type="text" name="txid" class="form-input @error('txid') error @enderror" value="{{ old('txid') }}" placeholder="Optional">
          @error('txid')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div class="form-actions">
        <a href="{{ route('admin.withdrawals.index') }}" class="btn btn-cancel">← Cancel</a>
        <button type="submit" class="btn btn-submit">✔ Create Withdrawal</button>
      </div>
    </form>
  </div>
</div>
@endsection
