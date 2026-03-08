@extends('admin.layouts.app')

@section('title', 'Create Weekly Salary Payment')
@section('page-title', 'Create Weekly Salary Payment')
@section('page-description', 'Manually create a weekly salary payment')

@section('content')
<style>
.form-card{background:#fff;border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,.08);max-width:600px}
.form-group{margin-bottom:24px}
.form-label{display:block;font-size:14px;font-weight:700;color:#334155;margin-bottom:8px}
.form-input,.form-select,.form-textarea{width:100%;padding:12px 16px;border:2px solid #e2e8f0;border-radius:10px;font-size:14px;transition:all .3s}
.form-input:focus,.form-select:focus,.form-textarea:focus{outline:0;border-color:#667eea;box-shadow:0 0 0 3px rgba(102,126,234,.1)}
.form-textarea{resize:vertical;min-height:100px}
.btn-submit{padding:12px 32px;border:none;border-radius:10px;font-weight:600;font-size:14px;cursor:pointer;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;transition:all .3s}
.btn-submit:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(102,126,234,.4)}
.btn-cancel{padding:12px 32px;border:none;border-radius:10px;font-weight:600;font-size:14px;cursor:pointer;background:#f1f5f9;color:#64748b;text-decoration:none;display:inline-block;transition:all .3s}
.btn-cancel:hover{background:#e2e8f0}
</style>

<div class="container-fluid" style="padding:20px">
  <div class="form-card">
    <form action="{{ route('admin.weekly-salary.store') }}" method="POST">
      @csrf
      
      <div class="form-group">
        <label class="form-label">User *</label>
        <select name="user_id" class="form-select" required>
          <option value="">Select User</option>
          @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
              {{ $user->username }} ({{ $user->account_id }})
            </option>
          @endforeach
        </select>
        @error('user_id')
          <div style="color:#ef4444;font-size:12px;margin-top:4px">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label">Amount ($) *</label>
        <input type="number" name="amount" class="form-input" step="0.01" min="0" value="{{ old('amount') }}" required placeholder="Enter amount">
        @error('amount')
          <div style="color:#ef4444;font-size:12px;margin-top:4px">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label">Note (Optional)</label>
        <textarea name="note" class="form-textarea" placeholder="Add a note about this payment">{{ old('note') }}</textarea>
        @error('note')
          <div style="color:#ef4444;font-size:12px;margin-top:4px">{{ $message }}</div>
        @enderror
      </div>

      <div style="display:flex;gap:12px">
        <button type="submit" class="btn-submit">💰 Create Payment</button>
        <a href="{{ route('admin.weekly-salary.history') }}" class="btn-cancel">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
