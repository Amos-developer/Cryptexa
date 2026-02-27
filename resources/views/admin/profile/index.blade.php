@extends('admin.layouts.app')

@section('title', 'My Account')
@section('page-title', 'My Account')
@section('page-description', 'Manage Your Profile')

@section('content')
<style>
.profile-card{background:#fff;border-radius:16px;padding:32px;box-shadow:0 2px 12px rgba(0,0,0,.08);max-width:600px;margin:0 auto}
.form-group{margin-bottom:24px}
.form-label{display:block;font-size:14px;font-weight:600;color:#374151;margin-bottom:8px}
.form-input{width:100%;padding:12px 16px;border:2px solid #e5e7eb;border-radius:10px;font-size:14px;transition:.3s}
.form-input:focus{outline:0;border-color:#667eea;box-shadow:0 0 0 3px rgba(102,126,234,.1)}
.btn-save{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;padding:12px 32px;border:none;border-radius:10px;font-weight:600;font-size:14px;cursor:pointer;transition:.3s;width:100%}
.btn-save:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(102,126,234,.4)}
.divider{border-top:2px solid #e5e7eb;margin:32px 0;position:relative}
.divider::after{content:'Change Password';position:absolute;top:-12px;left:50%;transform:translateX(-50%);background:#fff;padding:0 16px;color:#9ca3af;font-size:13px;font-weight:600}
</style>

<div class="profile-card">
  <form action="{{ route('admin.profile.update') }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-input" value="{{ auth()->user()->username }}" required>
    </div>

    <div class="form-group">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-input" value="{{ auth()->user()->email }}" required>
    </div>

    <div class="divider"></div>

    <div class="form-group">
      <label class="form-label">Current Password</label>
      <input type="password" name="current_password" class="form-input" placeholder="Required to change password">
    </div>

    <div class="form-group">
      <label class="form-label">New Password</label>
      <input type="password" name="password" class="form-input" placeholder="Leave blank to keep current">
    </div>

    <div class="form-group">
      <label class="form-label">Confirm New Password</label>
      <input type="password" name="password_confirmation" class="form-input" placeholder="Confirm new password">
    </div>

    <button type="submit" class="btn-save">💾 Update Profile</button>
  </form>
</div>
@endsection
