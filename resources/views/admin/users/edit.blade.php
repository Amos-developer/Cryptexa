@extends('admin.layouts.app')

@section('title', 'Edit User')
@section('page-title', 'Edit User')
@section('page-description', 'Modify user details')

@section('content')
<style>
@media (prefers-color-scheme: dark){:root{--bg-card:#1e293b;--text-primary:#e2e8f0;--text-secondary:#94a3b8;--border-color:#334155;--input-bg:#0f172a}}
@media (prefers-color-scheme: light){:root{--bg-card:#fff;--text-primary:#1e293b;--text-secondary:#64748b;--border-color:#e2e8f0;--input-bg:#fff}}
.edit-card{background:var(--bg-card);border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,.08);max-width:800px;margin:0 auto}
.card-header{text-align:center;margin-bottom:32px}
.card-icon{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#f59e0b,#d97706);display:inline-flex;align-items:center;justify-content:center;font-size:36px;margin-bottom:16px;box-shadow:0 8px 24px rgba(245,158,11,.3)}
.card-title{font-size:28px;font-weight:700;color:var(--text-primary);margin-bottom:8px}
.card-subtitle{font-size:14px;color:var(--text-secondary)}
.form-grid{display:grid;grid-template-columns:1fr;gap:24px}
.form-group{display:flex;flex-direction:column}
.form-label{font-size:13px;font-weight:600;color:var(--text-secondary);margin-bottom:8px;text-transform:uppercase;letter-spacing:.5px}
.form-label .required{color:#ef4444}
.form-label .hint{font-size:11px;font-weight:400;text-transform:none;letter-spacing:0;color:#94a3b8}
.form-input,.form-select{width:100%;padding:12px 16px;border:2px solid var(--border-color);border-radius:10px;font-size:15px;background:var(--input-bg);color:var(--text-primary);transition:all .3s}
.form-input:focus,.form-select:focus{outline:0;border-color:#f59e0b;box-shadow:0 0 0 3px rgba(245,158,11,.1)}
.form-input.error{border-color:#ef4444}
.error-message{font-size:12px;color:#ef4444;margin-top:6px}
.input-group{position:relative}
.input-prefix{position:absolute;left:16px;top:50%;transform:translateY(-50%);font-size:16px;font-weight:600;color:var(--text-secondary)}
.input-group .form-input{padding-left:40px}
.form-actions{display:flex;gap:12px;margin-top:32px;padding-top:24px;border-top:2px solid var(--border-color)}
.btn{flex:1;padding:14px 24px;border:none;border-radius:10px;font-weight:600;font-size:15px;cursor:pointer;transition:all .3s}
.btn-cancel{background:#f1f5f9;color:#64748b}
.btn-cancel:hover{background:#e2e8f0}
.btn-submit{background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff}
.btn-submit:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(245,158,11,.4)}
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
      <div class="card-icon">✏️</div>
      <h2 class="card-title">Edit User</h2>
      <p class="card-subtitle">Update {{ $user->username }}'s information</p>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
      @csrf
      @method('PUT')
      
      <div class="form-grid">
        <div class="form-group">
          <label class="form-label">👤 Username <span class="required">*</span></label>
          <input type="text" name="username" class="form-input @error('username') error @enderror" value="{{ old('username', $user->username) }}" required>
          @error('username')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">✉️ Email Address <span class="required">*</span></label>
          <input type="email" name="email" class="form-input @error('email') error @enderror" value="{{ old('email', $user->email) }}" required>
          @error('email')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">📞 Phone</label>
          <input type="text" name="phone" class="form-input @error('phone') error @enderror" value="{{ old('phone', $user->phone) }}">
          @error('phone')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">🔒 New Password <span class="hint">(leave blank to keep current)</span></label>
          <input type="password" name="password" class="form-input @error('password') error @enderror">
          @error('password')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">🔒 Confirm Password</label>
          <input type="password" name="password_confirmation" class="form-input">
        </div>

        <div class="form-group">
          <label class="form-label">🎭 Role <span class="required">*</span></label>
          <select name="role" class="form-select @error('role') error @enderror" required>
            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
          </select>
          @error('role')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="form-label">💰 Account Balance</label>
          <div class="input-group">
            <span class="input-prefix">$</span>
            <input type="number" step="0.01" min="0" name="balance" class="form-input @error('balance') error @enderror" value="{{ old('balance', $user->balance ?? 0) }}">
          </div>
          @error('balance')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div class="form-actions">
        <a href="{{ route('admin.users.index') }}" class="btn btn-cancel">← Cancel</a>
        <button type="submit" class="btn btn-submit">✔ Update User</button>
      </div>
    </form>
  </div>
</div>
@endsection
