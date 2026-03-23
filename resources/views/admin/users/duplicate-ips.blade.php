@extends('admin.layouts.app')

@section('title', 'Duplicate IPs')
@section('page-title', 'Duplicate IP Clusters')
@section('page-description', 'Review accounts sharing the same tracked IP address')

@section('content')
<style>
.toolbar{display:flex;justify-content:space-between;align-items:end;gap:12px;flex-wrap:wrap;margin-bottom:24px}
.search-form{display:flex;gap:10px;flex-wrap:wrap}
.search-input{min-width:260px;padding:10px 14px;border:1px solid #dbe2ea;border-radius:10px;font-size:14px}
.btn-ui{padding:10px 16px;border:none;border-radius:10px;font-weight:600;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;justify-content:center}
.btn-ui.primary{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff}
.btn-ui.secondary{background:#eef2f7;color:#475569}
.cluster-grid{display:grid;gap:18px}
.cluster-card{background:#fff;border:1px solid #e2e8f0;border-radius:18px;box-shadow:0 4px 20px rgba(0,0,0,.06);overflow:hidden}
.cluster-head{display:flex;justify-content:space-between;align-items:center;gap:12px;padding:18px 20px;border-bottom:1px solid #eef2f7;background:linear-gradient(135deg,#f8fbff,#f1f5f9)}
.cluster-ip{font-size:18px;font-weight:700;color:#1e293b}
.cluster-sub{font-size:13px;color:#64748b;margin-top:4px}
.cluster-badge{display:inline-flex;align-items:center;padding:8px 12px;border-radius:999px;background:#fef3c7;color:#92400e;font-size:12px;font-weight:700}
.cluster-body{padding:16px 20px}
.user-list{display:grid;gap:12px}
.user-row{display:grid;grid-template-columns:minmax(0,1.1fr) minmax(0,.9fr) auto auto;gap:12px;align-items:center;padding:14px 16px;border:1px solid #e2e8f0;border-radius:14px;background:#fafcff}
.user-main{min-width:0}
.user-name{font-size:15px;font-weight:700;color:#1e293b}
.user-meta{font-size:12px;color:#64748b;margin-top:4px;word-break:break-word}
.user-device{font-size:13px;color:#334155}
.user-balance{font-size:14px;font-weight:700;color:#059669}
.user-actions a{color:#4f46e5;font-weight:600;text-decoration:none}
.empty-panel{text-align:center;padding:60px 20px;background:#fff;border:1px solid #e2e8f0;border-radius:18px;color:#64748b}
.pagination-wrap{margin-top:24px;display:flex;justify-content:center}
@media (max-width:768px){
.search-input{min-width:100%}
.user-row{grid-template-columns:1fr}
.cluster-head{align-items:flex-start;flex-direction:column}
}
</style>

<div class="toolbar">
  <form method="GET" action="{{ route('admin.users.duplicate-ips') }}" class="search-form">
    <input type="text" name="search" class="search-input" placeholder="Filter by IP address" value="{{ request('search') }}">
    <button type="submit" class="btn-ui primary">Filter</button>
    <a href="{{ route('admin.users.duplicate-ips') }}" class="btn-ui secondary">Reset</a>
  </form>
  <a href="{{ route('admin.users.index', ['risk' => 'shared_ip']) }}" class="btn-ui secondary">Open Shared-IP User Table</a>
</div>

@if($clusters->isEmpty())
  <div class="empty-panel">
    <div style="font-size:42px;margin-bottom:12px;">No duplicate IP clusters</div>
    <div>No tracked non-admin accounts are currently sharing the same IP address.</div>
  </div>
@else
  <div class="cluster-grid">
    @foreach($clusters as $cluster)
      <section class="cluster-card">
        <div class="cluster-head">
          <div>
            <div class="cluster-ip">{{ $cluster->tracked_ip }}</div>
            <div class="cluster-sub">All non-admin accounts currently linked to this tracked IP</div>
          </div>
          <span class="cluster-badge">{{ $cluster->account_count }} accounts</span>
        </div>

        <div class="cluster-body">
          <div class="user-list">
            @foreach($cluster->users as $user)
              <div class="user-row">
                <div class="user-main">
                  <div class="user-name">{{ $user->username }}</div>
                  <div class="user-meta">{{ $user->email }} | {{ $user->account_id }}</div>
                </div>
                <div class="user-device">
                  <div><strong>{{ $user->device_label }}</strong></div>
                  <div class="user-meta">{{ \Illuminate\Support\Str::limit($user->tracked_user_agent ?: 'No user agent recorded', 70) }}</div>
                </div>
                <div class="user-balance">${{ number_format($user->balance ?? 0, 2) }}</div>
                <div class="user-actions">
                  <a href="{{ route('admin.users.show', $user->id) }}">View User</a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </section>
    @endforeach
  </div>

  @if($clusters->hasPages())
    <div class="pagination-wrap">
      {{ $clusters->links() }}
    </div>
  @endif
@endif
@endsection
