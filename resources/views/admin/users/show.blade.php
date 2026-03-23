@extends('admin.layouts.app')

@section('title', 'User Details')
@section('page-title', 'User Details')
@section('page-description', $user->name)

@section('content')
<style>
@media (prefers-color-scheme: dark){:root{--bg-card:#1e293b;--bg-filter:#0f172a;--text-primary:#e2e8f0;--text-secondary:#94a3b8;--border-color:#334155;--hover-bg:#334155}}
@media (prefers-color-scheme: light){:root{--bg-card:#fff;--bg-filter:#fff;--text-primary:#1e293b;--text-secondary:#64748b;--border-color:#e2e8f0;--hover-bg:#f8fafc}}
.profile-card{background:var(--bg-card);border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,.08);margin-bottom:24px}
.profile-header{text-align:center;margin-bottom:32px}
.profile-avatar{width:120px;height:120px;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:inline-flex;align-items:center;justify-content:center;color:#fff;font-size:48px;font-weight:700;margin-bottom:16px;box-shadow:0 8px 24px rgba(102,126,234,.3)}
.profile-name{font-size:28px;font-weight:700;color:var(--text-primary);margin-bottom:8px}
.role-badge{display:inline-block;padding:8px 16px;border-radius:20px;font-size:13px;font-weight:600}
.role-admin{background:#fee2e2;color:#991b1b}
.role-user{background:#dbeafe;color:#1e40af}
.info-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:24px}
.info-item{background:var(--hover-bg);padding:16px;border-radius:12px;border:2px solid var(--border-color)}
.info-label{font-size:12px;font-weight:600;color:var(--text-secondary);text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px}
.info-value{font-size:18px;font-weight:700;color:var(--text-primary)}
.info-value.balance{color:#059669}
.info-value code{background:rgba(102,126,234,.1);padding:4px 8px;border-radius:6px;font-size:14px;color:#667eea}
.btn-edit{width:100%;padding:14px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;border:none;border-radius:12px;font-weight:600;font-size:15px;cursor:pointer;transition:all .3s}
.btn-edit:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(102,126,234,.4)}
.balance-card{background:var(--bg-card);border-radius:16px;padding:24px;box-shadow:0 4px 20px rgba(0,0,0,.08);margin-bottom:24px}
.card-title{font-size:20px;font-weight:700;color:var(--text-primary);margin-bottom:20px}
.balance-form{display:flex;gap:12px;align-items:end}
.balance-input-group{flex:1}
.balance-input-group label{display:block;font-size:13px;font-weight:600;color:var(--text-secondary);margin-bottom:6px}
.balance-input{width:100%;padding:12px 16px;border:2px solid var(--border-color);border-radius:10px;font-size:16px;font-weight:600;background:var(--bg-card);color:var(--text-primary)}
.balance-input:focus{outline:0;border-color:#667eea;box-shadow:0 0 0 3px rgba(102,126,234,.1)}
.btn-update{padding:12px 24px;background:#22c55e;color:#fff;border:none;border-radius:10px;font-weight:600;cursor:pointer;transition:all .3s}
.btn-update:hover{background:#16a34a;transform:translateY(-2px)}
.risk-card{background:var(--bg-card);border-radius:16px;padding:24px;box-shadow:0 4px 20px rgba(0,0,0,.08);margin-bottom:24px}
.risk-head{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap;margin-bottom:18px}
.risk-kicker{display:inline-flex;align-items:center;padding:7px 12px;border-radius:999px;background:#fef3c7;color:#92400e;font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase}
.risk-copy{font-size:14px;color:var(--text-secondary);line-height:1.7}
.risk-list{display:grid;gap:12px}
.risk-item{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;padding:16px;border-radius:12px;border:2px solid var(--border-color);background:var(--hover-bg)}
.risk-item-main{min-width:0}
.risk-item-name{font-size:16px;font-weight:700;color:var(--text-primary)}
.risk-item-meta{margin-top:6px;font-size:13px;color:var(--text-secondary);line-height:1.6;word-break:break-word}
.risk-link{display:inline-flex;align-items:center;justify-content:center;padding:11px 14px;border-radius:12px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;text-decoration:none;font-weight:600;font-size:14px;white-space:nowrap}
.risk-empty{padding:16px;border-radius:12px;border:2px dashed var(--border-color);background:var(--hover-bg);color:var(--text-secondary);font-size:14px}
.activity-card{background:var(--bg-card);border-radius:16px;padding:24px;box-shadow:0 4px 20px rgba(0,0,0,.08)}
.timeline{position:relative;padding-left:40px}
.timeline-item{position:relative;padding-bottom:32px}
.timeline-item:before{content:'';position:absolute;left:-40px;top:0;width:2px;height:100%;background:var(--border-color)}
.timeline-icon{position:absolute;left:-52px;top:0;width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;z-index:1}
.timeline-icon.created{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff}
.timeline-icon.verified{background:linear-gradient(135deg,#22c55e,#16a34a);color:#fff}
.timeline-time{font-size:12px;color:var(--text-secondary);margin-bottom:8px}
.timeline-title{font-size:16px;font-weight:700;color:var(--text-primary);margin-bottom:4px}
.timeline-desc{font-size:14px;color:var(--text-secondary)}
@media (prefers-color-scheme: dark){.btn-update{background:#16a34a}.btn-update:hover{background:#15803d}}
@media(max-width:768px){
.profile-avatar{width:100px;height:100px;font-size:40px}
.profile-name{font-size:24px}
.info-grid{grid-template-columns:1fr}
.balance-form{flex-direction:column}
.balance-input-group{width:100%}
.btn-update{width:100%}
.risk-item{flex-direction:column}
.risk-link{width:100%}
}
</style>

<div class="container-fluid" style="padding:20px">
  <div class="row">
    <div class="col-lg-4 col-md-5">
      <div class="profile-card">
        <div class="profile-header">
          <div class="profile-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
          <h2 class="profile-name">{{ $user->name }}</h2>
          @if($user->role == 'admin')
            <span class="role-badge role-admin">👑 Administrator</span>
          @else
            <span class="role-badge role-user">👤 User</span>
          @endif
        </div>

        <div class="info-grid">
          <div class="info-item">
            <div class="info-label">🆔 Account ID</div>
            <div class="info-value"><code>{{ $user->account_id }}</code></div>
          </div>
          <div class="info-item">
            <div class="info-label">✉️ Email</div>
            <div class="info-value" style="font-size:14px;word-break:break-all">{{ $user->email }}</div>
          </div>
          <div class="info-item">
            <div class="info-label">💰 Balance</div>
            <div class="info-value balance">${{ number_format($user->balance ?? 0, 2) }}</div>
          </div>
          <div class="info-item">
            <div class="info-label">🎫 Referral Code</div>
            <div class="info-value"><code>{{ $user->referral_code }}</code></div>
          </div>
          <div class="info-item">
            <div class="info-label">👥 Referrals</div>
            <div class="info-value">{{ $user->referrals()->count() }}</div>
          </div>
          <div class="info-item">
            <div class="info-label">📅 Joined</div>
            <div class="info-value" style="font-size:14px">{{ $user->created_at->format('M d, Y') }}</div>
          </div>
          <div class="info-item">
            <div class="info-label">IP Address</div>
            <div class="info-value" style="font-size:14px">{{ $user->tracked_ip_address ?: 'N/A' }}</div>
          </div>
          <div class="info-item">
            <div class="info-label">Device</div>
            <div class="info-value" style="font-size:14px">{{ $user->device_label }}</div>
          </div>
        </div>

        <a href="{{ route('admin.users.edit', $user) }}" class="btn-edit">✏️ Edit User</a>
      </div>

      <div class="balance-card">
        <h3 class="card-title">💳 Balance Management</h3>
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="balance-form">
            <div class="balance-input-group">
              <label>New Balance</label>
              <input type="number" step="0.01" min="0" name="balance" class="balance-input" value="{{ $user->balance }}" required>
            </div>
            <button type="submit" class="btn-update">✔ Update</button>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-8 col-md-7">
      <div class="risk-card">
        <div class="risk-head">
          <div>
            <span class="risk-kicker">Shared IP Review</span>
            <h3 class="card-title" style="margin:12px 0 8px">Linked Accounts On Same IP</h3>
            <div class="risk-copy">
              @if($user->tracked_ip_address)
                Tracked IP: <strong>{{ $user->tracked_ip_address }}</strong>
              @else
                No tracked IP has been recorded for this user yet.
              @endif
            </div>
          </div>
          @if($user->tracked_ip_address)
            <a href="{{ route('admin.users.duplicate-ips', ['search' => $user->tracked_ip_address]) }}" class="risk-link">Open Duplicate IP Cluster</a>
          @endif
        </div>

        @if($sharedIpUsers->isEmpty())
          <div class="risk-empty">No other non-admin account currently shares this tracked IP.</div>
        @else
          <div class="risk-list">
            @foreach($sharedIpUsers as $sharedUser)
              <div class="risk-item">
                <div class="risk-item-main">
                  <div class="risk-item-name">{{ $user->username ?: $user->name }} shares with {{ $sharedUser->username ?: $sharedUser->name }}</div>
                  <div class="risk-item-meta">
                    {{ $sharedUser->email }}<br>
                    Account ID: {{ $sharedUser->account_id }}<br>
                    Joined: {{ $sharedUser->created_at->format('M d, Y H:i') }}
                  </div>
                </div>
                <a href="{{ route('admin.users.show', $sharedUser->id) }}" class="risk-link">View User</a>
              </div>
            @endforeach
          </div>
        @endif
      </div>

      <div class="activity-card">
        <h3 class="card-title">📈 Account Activity</h3>
        <div class="timeline">
          <div class="timeline-item">
            <div class="timeline-icon created">👤</div>
            <div class="timeline-time">{{ $user->created_at->diffForHumans() }}</div>
            <div class="timeline-title">Account Created</div>
            <div class="timeline-desc">User registered on {{ $user->created_at->format('F d, Y \a\t H:i') }}</div>
          </div>
          @if($user->email_verified_at)
          <div class="timeline-item">
            <div class="timeline-icon verified">✔</div>
            <div class="timeline-time">{{ $user->email_verified_at->diffForHumans() }}</div>
            <div class="timeline-title">Email Verified</div>
            <div class="timeline-desc">Email address confirmed</div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
