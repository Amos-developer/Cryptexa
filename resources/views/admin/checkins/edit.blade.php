@extends('admin.layouts.app')

@section('title', 'Edit Check-in')
@section('page-title', 'Edit Check-in')
@section('page-description', 'Modify check-in details')

@section('content')
<style>
.edit-card{background:#fff;border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,.08);max-width:600px;margin:0 auto}
.form-group{margin-bottom:20px}
.form-label{font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px;display:block}
.form-input{width:100%;padding:12px 16px;border:2px solid #e2e8f0;border-radius:10px;font-size:15px}
.form-input:focus{outline:0;border-color:#667eea}
.btn{padding:14px 24px;border:none;border-radius:10px;font-weight:600;cursor:pointer;transition:.3s}
.btn-primary{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff}
.btn-secondary{background:#f1f5f9;color:#64748b;margin-right:12px}
</style>

<div class="edit-card">
  <form action="{{ route('admin.checkins.update', $checkIn) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
      <label class="form-label">User</label>
      <input type="text" class="form-input" value="{{ $checkIn->user->username ?? 'N/A' }}" disabled>
    </div>

    <div class="form-group">
      <label class="form-label">Check-in Date</label>
      <input type="text" class="form-input" value="{{ $checkIn->check_in_date->format('M d, Y') }}" disabled>
    </div>

    <div class="form-group">
      <label class="form-label">Streak (Days)</label>
      <input type="number" min="1" name="streak" class="form-input" value="{{ $checkIn->streak }}" required>
    </div>

    <div class="form-group">
      <label class="form-label">Reward ($)</label>
      <input type="number" step="0.01" min="0" name="reward" class="form-input" value="{{ $checkIn->reward }}" required>
    </div>

    <div style="margin-top:32px">
      <a href="{{ route('admin.checkins.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="submit" class="btn btn-primary">Update Check-in</button>
    </div>
  </form>
</div>
@endsection
