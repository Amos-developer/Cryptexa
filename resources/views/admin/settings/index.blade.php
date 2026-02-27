@extends('admin.layouts.app')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('page-description', 'Manage System Settings')

@section('content')
<style>
.tabs{display:flex;gap:8px;margin-bottom:24px;border-bottom:2px solid #e5e7eb}
.tab{padding:12px 24px;background:none;border:none;font-size:14px;font-weight:600;color:#6b7280;cursor:pointer;border-bottom:3px solid transparent;transition:.3s}
.tab.active{color:#667eea;border-bottom-color:#667eea}
.tab-content{display:none}
.tab-content.active{display:block}
.settings-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(400px,1fr));gap:24px}
.settings-card{background:#fff;border-radius:16px;padding:28px;box-shadow:0 2px 12px rgba(0,0,0,.08)}
.settings-card h3{font-size:18px;font-weight:700;color:#1f2937;margin-bottom:20px;display:flex;align-items:center;gap:10px}
.form-group{margin-bottom:20px}
.form-label{display:block;font-size:14px;font-weight:600;color:#374151;margin-bottom:8px}
.form-input{width:100%;padding:12px 16px;border:2px solid #e5e7eb;border-radius:10px;font-size:14px;transition:.3s}
.form-input:focus{outline:0;border-color:#667eea;box-shadow:0 0 0 3px rgba(102,126,234,.1)}
.btn-save{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;padding:12px 32px;border:none;border-radius:10px;font-weight:600;font-size:14px;cursor:pointer;transition:.3s}
.btn-save:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(102,126,234,.4)}
.btn-add{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;padding:10px 20px;border:none;border-radius:8px;font-weight:600;font-size:13px;cursor:pointer;text-decoration:none;display:inline-block}
.admin-list{background:#fff;border-radius:12px;overflow:hidden}
.admin-item{display:flex;justify-content:space-between;align-items:center;padding:16px;border-bottom:1px solid #f3f4f6}
.btn-delete{background:#fee2e2;color:#991b1b;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;font-size:12px;font-weight:600}
.divider{border-top:2px solid #e5e7eb;margin:24px 0}
@media(max-width:768px){.settings-grid{grid-template-columns:1fr}.tabs{overflow-x:auto}}
</style>

<div class="tabs">
  <button class="tab active" onclick="switchTab('system')">⚙️ System</button>
  <button class="tab" onclick="switchTab('profile')">👤 My Account</button>
  <button class="tab" onclick="switchTab('admins')">👥 Admins</button>
</div>

<div id="system" class="tab-content active">
  <form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="settings-grid">
      <div class="settings-card">
        <h3>⚙️ General Settings</h3>
        <div class="form-group">
          <label class="form-label">Site Name</label>
          <input type="text" name="site_name" class="form-input" value="{{ env('APP_NAME', 'Cryptexa') }}" placeholder="Cryptexa">
        </div>
        <div class="form-group">
          <label class="form-label">Site Email</label>
          <input type="email" name="site_email" class="form-input" value="{{ env('MAIL_FROM_ADDRESS', 'admin@cryptexa.com') }}" placeholder="admin@cryptexa.com">
        </div>
      </div>

      <div class="settings-card">
        <h3>💰 Referral Commissions</h3>
        <div class="form-group">
          <label class="form-label">Level 1 Commission (%)</label>
          <input type="number" name="referral_commission_level1" class="form-input" value="2" step="0.01" min="0" max="100">
        </div>
        <div class="form-group">
          <label class="form-label">Level 2 Commission (%)</label>
          <input type="number" name="referral_commission_level2" class="form-input" value="1" step="0.01" min="0" max="100">
        </div>
        <div class="form-group">
          <label class="form-label">Level 3 Commission (%)</label>
          <input type="number" name="referral_commission_level3" class="form-input" value="0.5" step="0.01" min="0" max="100">
        </div>
      </div>

      <div class="settings-card">
        <h3>💵 Transaction Limits</h3>
        <div class="form-group">
          <label class="form-label">Minimum Deposit ($)</label>
          <input type="number" name="min_deposit" class="form-input" value="10" step="0.01" min="0">
        </div>
        <div class="form-group">
          <label class="form-label">Minimum Withdrawal ($)</label>
          <input type="number" name="min_withdrawal" class="form-input" value="10" step="0.01" min="0">
        </div>
      </div>

      <div class="settings-card">
        <h3>🔐 Security Settings</h3>
        <div class="form-group">
          <label class="form-label">Enable 2FA for Admin</label>
          <select name="admin_2fa_required" class="form-input">
            <option value="0">Disabled</option>
            <option value="1">Enabled</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Session Timeout (minutes)</label>
          <input type="number" name="session_timeout" class="form-input" value="120" min="5">
        </div>
      </div>
    </div>

    <div style="margin-top:24px;text-align:center">
      <button type="submit" class="btn-save">💾 Save Settings</button>
    </div>
  </form>
</div>

<div id="profile" class="tab-content">
  <div style="max-width:600px;margin:0 auto">
    <div class="settings-card">
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

        <button type="submit" class="btn-save" style="width:100%">💾 Update Profile</button>
      </form>
    </div>
  </div>
</div>

<div id="admins" class="tab-content">
  <div style="max-width:800px;margin:0 auto">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
      <h3 style="font-size:18px;font-weight:700">Admin Users</h3>
      <a href="{{ route('admin.admins.create') }}" class="btn-add">➕ Add Admin</a>
    </div>
    
    <div class="admin-list">
      @php
        $admins = \App\Models\User::where('role', 'admin')->latest()->get();
      @endphp
      @foreach($admins as $admin)
      <div class="admin-item">
        <div>
          <strong>{{ $admin->username }}</strong>
          <div style="font-size:13px;color:#6b7280">{{ $admin->email }}</div>
        </div>
        <div>
          @if($admin->id !== auth()->id())
          <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this admin?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">🗑️ Delete</button>
          </form>
          @else
          <span style="font-size:12px;color:#667eea;font-weight:600">Current User</span>
          @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<script>
function switchTab(tab) {
  document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
  event.target.classList.add('active');
  document.getElementById(tab).classList.add('active');
}
</script>
@endsection
