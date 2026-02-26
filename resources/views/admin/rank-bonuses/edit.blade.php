@extends('admin.layouts.app')

@section('title', 'Edit Rank Bonuses')
@section('page-title', 'Edit Rank Bonuses')
@section('page-description', 'Modify user rank bonus status')

@section('content')
<style>
.edit-card{background:#fff;border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,.08);max-width:600px;margin:0 auto}
.form-group{margin-bottom:20px}
.form-label{font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px;display:block}
.form-input{width:100%;padding:12px 16px;border:2px solid #e2e8f0;border-radius:10px;font-size:15px}
.form-input:focus{outline:0;border-color:#667eea}
.checkbox-group{display:flex;align-items:center;gap:12px;padding:12px;background:#f8fafc;border-radius:10px;margin-bottom:12px}
.checkbox-group input{width:20px;height:20px;cursor:pointer}
.checkbox-group label{font-size:14px;font-weight:500;cursor:pointer;flex:1}
.btn{padding:14px 24px;border:none;border-radius:10px;font-weight:600;cursor:pointer;transition:.3s}
.btn-primary{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff}
.btn-secondary{background:#f1f5f9;color:#64748b;margin-right:12px}
</style>

<div class="edit-card">
  <form action="{{ route('admin.rank-bonuses.update', $user) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
      <label class="form-label">User</label>
      <input type="text" class="form-input" value="{{ $user->username }}" disabled>
    </div>

    <div class="form-group">
      <label class="form-label">Referrals Count</label>
      <input type="text" class="form-input" value="{{ $user->referrals_count }}" disabled>
    </div>

    <div class="form-group">
      <label class="form-label">Rank Bonuses Paid</label>
      
      <div class="checkbox-group">
        <input type="checkbox" name="junior_leader_bonus_paid" id="junior" {{ $user->junior_leader_bonus_paid ? 'checked' : '' }}>
        <label for="junior">Junior Leader ($5)</label>
      </div>

      <div class="checkbox-group">
        <input type="checkbox" name="elite_leader_bonus_paid" id="elite" {{ $user->elite_leader_bonus_paid ? 'checked' : '' }}>
        <label for="elite">Elite Leader ($20)</label>
      </div>

      <div class="checkbox-group">
        <input type="checkbox" name="legendary_leader_bonus_paid" id="legendary" {{ $user->legendary_leader_bonus_paid ? 'checked' : '' }}>
        <label for="legendary">Legendary Leader ($50)</label>
      </div>

      <div class="checkbox-group">
        <input type="checkbox" name="grand_leader_bonus_paid" id="grand" {{ $user->grand_leader_bonus_paid ? 'checked' : '' }}>
        <label for="grand">Grand Leader ($150)</label>
      </div>
    </div>

    <div style="margin-top:32px">
      <a href="{{ route('admin.rank-bonuses.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="submit" class="btn btn-primary">Update Bonuses</button>
    </div>
  </form>
</div>
@endsection
