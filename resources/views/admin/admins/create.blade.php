@extends('admin.layouts.app')

@section('title', 'Add Admin')
@section('page-title', 'Add Admin')
@section('page-description', 'Create New Admin User')

@section('content')
<style>
.form-card{background:#fff;border-radius:16px;padding:32px;box-shadow:0 2px 12px rgba(0,0,0,.08);max-width:600px;margin:0 auto}
.form-group{margin-bottom:24px}
.form-label{display:block;font-size:14px;font-weight:600;color:#374151;margin-bottom:8px}
.form-input{width:100%;padding:12px 16px;border:2px solid #e5e7eb;border-radius:10px;font-size:14px;transition:.3s}
.form-input:focus{outline:0;border-color:#667eea;box-shadow:0 0 0 3px rgba(102,126,234,.1)}
.btn-submit{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;padding:12px 32px;border:none;border-radius:10px;font-weight:600;font-size:14px;cursor:pointer;transition:.3s;width:100%}
.btn-submit:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(102,126,234,.4)}
.btn-back{background:#f3f4f6;color:#6b7280;padding:12px 32px;border:none;border-radius:10px;font-weight:600;font-size:14px;cursor:pointer;text-decoration:none;display:inline-block;margin-bottom:24px}
</style>

<a href="{{ route('admin.admins.index') }}" class="btn-back">← Back to Admins</a>

<div class="form-card">
  <form action="{{ route('admin.admins.store') }}" method="POST">
    @csrf
    
    <div class="form-group">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-input" value="{{ old('username') }}" required>
    </div>

    <div class="form-group">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-input" required>
    </div>

    <div class="form-group">
      <label class="form-label">Confirm Password</label>
      <input type="password" name="password_confirmation" class="form-input" required>
    </div>

    <button type="submit" class="btn-submit">➕ Create Admin</button>
  </form>
</div>
@endsection
