@extends('admin.layouts.app')

@section('title', 'Edit Rank Bonus')
@section('page-title', 'Edit Rank Bonus')
@section('page-description', 'Modify rank bonus record')

@section('content')
<style>
.edit-card{background:#fff;border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,.08);max-width:600px;margin:0 auto}
.form-group{margin-bottom:20px}
.form-label{font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px;display:block}
.form-input{width:100%;padding:12px 16px;border:2px solid #e2e8f0;border-radius:10px;font-size:15px}
.form-input:focus{outline:0;border-color:#667eea}
.form-input:disabled{background:#f8fafc;color:#94a3b8}
.btn{padding:14px 24px;border:none;border-radius:10px;font-weight:600;cursor:pointer;transition:.3s}
.btn-primary{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff}
.btn-secondary{background:#f1f5f9;color:#64748b;margin-right:12px}
</style>

<div class="edit-card">
  <form action="{{ route('admin.rank-bonuses.update', $bonus) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
      <label class="form-label">User</label>
      <input type="text" class="form-input" value="{{ $bonus->user->username }}" disabled>
    </div>

    <div class="form-group">
      <label class="form-label">Rank</label>
      <input type="text" name="rank" class="form-input" value="{{ old('rank', $bonus->rank) }}" required>
    </div>

    <div class="form-group">
      <label class="form-label">Bonus Amount ($)</label>
      <input type="number" step="0.01" name="bonus_amount" id="bonus_amount" class="form-input" value="{{ old('bonus_amount', $bonus->bonus_amount) }}" required>
    </div>

    <div class="form-group">
      <label class="form-label">Balance Before ($)</label>
      <input type="number" step="0.01" name="balance_before" id="balance_before" class="form-input" value="{{ old('balance_before', $bonus->balance_before) }}" required>
    </div>

    <div class="form-group">
      <label class="form-label">Balance After ($)</label>
      <input type="number" step="0.01" name="balance_after" id="balance_after" class="form-input" value="{{ old('balance_after', $bonus->balance_after) }}" readonly style="background:#f8fafc;color:#94a3b8">
    </div>

    <div style="margin-top:32px">
      <a href="{{ route('admin.rewards.index', ['rankbonuses_page' => request('page', 1)]) }}" class="btn btn-secondary">Cancel</a>
      <button type="submit" class="btn btn-primary">Update Bonus</button>
    </div>
  </form>
</div>

<script>
function calculateBalanceAfter() {
  const bonusAmount = parseFloat(document.getElementById('bonus_amount').value) || 0;
  const balanceBefore = parseFloat(document.getElementById('balance_before').value) || 0;
  document.getElementById('balance_after').value = (balanceBefore + bonusAmount).toFixed(2);
}

document.getElementById('bonus_amount').addEventListener('input', calculateBalanceAfter);
document.getElementById('balance_before').addEventListener('input', calculateBalanceAfter);
</script>
@endsection
