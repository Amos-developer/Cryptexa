@extends('admin.layouts.app')

@section('title', 'Create Pool')
@section('page-title', 'Create Pool')
@section('page-description', 'Add new compute pool')

@section('content')
<style>
@media (prefers-color-scheme: dark){:root{--bg-card:#1e293b;--text-primary:#e2e8f0;--text-secondary:#94a3b8;--border-color:#334155;--input-bg:#0f172a}}
@media (prefers-color-scheme: light){:root{--bg-card:#fff;--text-primary:#1e293b;--text-secondary:#64748b;--border-color:#e2e8f0;--input-bg:#fff}}
.edit-card{background:var(--bg-card);border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,.08);max-width:800px;margin:0 auto}
.card-header{text-align:center;margin-bottom:32px}
.card-icon{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:inline-flex;align-items:center;justify-content:center;font-size:36px;margin-bottom:16px;box-shadow:0 8px 24px rgba(102,126,234,.3)}
.card-title{font-size:28px;font-weight:700;color:var(--text-primary);margin-bottom:8px}
.card-subtitle{font-size:14px;color:var(--text-secondary)}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:24px}
.form-group{display:flex;flex-direction:column}
.form-group.full{grid-column:1/-1}
.form-label{font-size:13px;font-weight:600;color:var(--text-secondary);margin-bottom:8px;text-transform:uppercase;letter-spacing:.5px}
.form-label .required{color:#ef4444}
.form-input,.form-select{width:100%;padding:12px 16px;border:2px solid var(--border-color);border-radius:10px;font-size:15px;background:var(--input-bg);color:var(--text-primary);transition:all .3s}
.form-input:focus,.form-select:focus{outline:0;border-color:#667eea;box-shadow:0 0 0 3px rgba(102,126,234,.1)}
.form-input.error{border-color:#ef4444}
.error-message{font-size:12px;color:#ef4444;margin-top:6px}
.input-group{position:relative}
.input-prefix{position:absolute;left:16px;top:50%;transform:translateY(-50%);font-size:16px;font-weight:600;color:var(--text-secondary)}
.input-group .form-input{padding-left:40px}
.form-actions{display:flex;gap:12px;margin-top:32px;padding-top:24px;border-top:2px solid var(--border-color)}
.btn{flex:1;padding:14px 24px;border:none;border-radius:10px;font-weight:600;font-size:15px;cursor:pointer;transition:all .3s}
.btn-cancel{background:#f1f5f9;color:#64748b}
.btn-cancel:hover{background:#e2e8f0}
.btn-submit{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff}
.btn-submit:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(102,126,234,.4)}
@media (prefers-color-scheme: dark){.btn-cancel{background:#334155;color:#e2e8f0}.btn-cancel:hover{background:#475569}}
@media(max-width:768px){
.edit-card{padding:24px}
.card-icon{width:64px;height:64px;font-size:28px}
.card-title{font-size:24px}
.form-grid{grid-template-columns:1fr}
.form-actions{flex-direction:column-reverse}
.btn{width:100%}
}
</style>

<div class="container-fluid" style="padding:20px">
  <div class="edit-card">
    <div class="card-header">
      <div class="card-icon">🏊</div>
      <h2 class="card-title">Create Pool</h2>
      <p class="card-subtitle">Add a new compute pool</p>
    </div>

    <form action="{{ route('admin.pools.store') }}" method="POST">
      @csrf
      
      <div class="form-grid">
        <div class="form-group full">
          <label class="form-label">📝 Pool Name <span class="required">*</span></label>
          <input type="text" name="name" class="form-input @error('name') error @enderror" value="{{ old('name') }}" required>
          @error('name')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">🏷️ Type <span class="required">*</span></label>
          <select name="type" class="form-select @error('type') error @enderror" required>
            <option value="">Select Type</option>
            <option value="btc" {{ old('type') == 'btc' ? 'selected' : '' }}>BTC</option>
            <option value="eth" {{ old('type') == 'eth' ? 'selected' : '' }}>ETH</option>
            <option value="usdt" {{ old('type') == 'usdt' ? 'selected' : '' }}>USDT</option>
            <option value="ltc" {{ old('type') == 'ltc' ? 'selected' : '' }}>LTC</option>
          </select>
          @error('type')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">💵 Price <span class="required">*</span></label>
          <div class="input-group">
            <span class="input-prefix">$</span>
            <input type="number" step="0.01" min="0" name="price" class="form-input @error('price') error @enderror" value="{{ old('price') }}" required>
          </div>
          @error('price')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">💰 Max Investment</label>
          <div class="input-group">
            <span class="input-prefix">$</span>
            <input type="number" step="0.01" min="0" name="max_investment" class="form-input @error('max_investment') error @enderror" value="{{ old('max_investment') }}" placeholder="Leave empty for unlimited">
          </div>
          @error('max_investment')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">📈 Daily Profit (%) <span class="required">*</span></label>
          <div class="input-group">
            <span class="input-prefix">%</span>
            <input type="number" step="0.01" min="0" max="100" name="daily_profit" class="form-input @error('daily_profit') error @enderror" value="{{ old('daily_profit') }}" required>
          </div>
          @error('daily_profit')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">⏱️ Duration (Minutes) <span class="required">*</span></label>
          <input type="number" min="1" name="duration_minutes" class="form-input @error('duration_minutes') error @enderror" value="{{ old('duration_minutes') }}" required>
          @error('duration_minutes')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div class="form-actions">
        <a href="{{ route('admin.pools.index') }}" class="btn btn-cancel">← Cancel</a>
        <button type="submit" class="btn btn-submit">✔ Create Pool</button>
      </div>
    </form>
  </div>
</div>
@endsection
