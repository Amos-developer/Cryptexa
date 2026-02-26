@extends('admin.layouts.app')

@section('title', 'Edit Lucky Box')
@section('page-title', 'Edit Lucky Box')
@section('page-description', 'Modify lucky box reward')

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
  <form action="{{ route('admin.lucky-boxes.update', $luckyBox) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
      <label class="form-label">User</label>
      <input type="text" class="form-input" value="{{ $luckyBox->user->username ?? 'N/A' }}" disabled>
    </div>

    <div class="form-group">
      <label class="form-label">Open Date</label>
      <input type="text" class="form-input" value="{{ $luckyBox->created_at->format('M d, Y H:i') }}" disabled>
    </div>

    <div class="form-group">
      <label class="form-label">Reward ($)</label>
      <input type="number" step="0.01" min="0" name="reward" class="form-input" value="{{ $luckyBox->reward }}" required>
    </div>

    <div style="margin-top:32px">
      <a href="{{ route('admin.lucky-boxes.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="submit" class="btn btn-primary">Update Reward</button>
    </div>
  </form>
</div>
@endsection
