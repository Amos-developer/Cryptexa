@extends('admin.layouts.app')

@section('title', 'Duplicate IPs')
@section('page-title', 'Duplicate IP Clusters')
@section('page-description', 'Review accounts sharing the same tracked IP address')

@section('content')
<style>
:root{--page-bg:#f3f7fb;--card-bg:#ffffff;--card-edge:#dbe7f3;--text-main:#122033;--text-soft:#607086;--cyan:#1fb6ff;--cyan-deep:#2563eb;--amber:#f59e0b;--green:#10b981;--shadow:0 18px 45px rgba(15,23,42,.08)}
.dup-shell{display:grid;gap:22px}
.dup-hero{position:relative;overflow:hidden;padding:24px;border:1px solid rgba(37,99,235,.14);border-radius:24px;background:linear-gradient(135deg,#0f172a 0%,#13253f 52%,#1e3a5f 100%);box-shadow:0 24px 60px rgba(15,23,42,.18)}
.dup-hero::before{content:"";position:absolute;inset:-20% auto auto -10%;width:220px;height:220px;background:radial-gradient(circle,rgba(31,182,255,.28),transparent 68%)}
.dup-hero::after{content:"";position:absolute;inset:auto -8% -35% auto;width:240px;height:240px;background:radial-gradient(circle,rgba(16,185,129,.18),transparent 70%)}
.dup-hero__content{position:relative;z-index:1;display:grid;gap:18px}
.dup-hero__top{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap}
.dup-kicker{display:inline-flex;align-items:center;padding:7px 12px;border-radius:999px;background:rgba(31,182,255,.12);border:1px solid rgba(31,182,255,.18);color:#b7eeff;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase}
.dup-title{margin:10px 0 6px;color:#f8fbff;font-size:clamp(1.5rem,4vw,2.35rem);line-height:.95;letter-spacing:-.05em;font-weight:800}
.dup-sub{max-width:720px;color:rgba(226,232,240,.72);font-size:14px;line-height:1.7}
.dup-stats{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px}
.dup-stat{padding:14px 16px;border-radius:18px;border:1px solid rgba(255,255,255,.08);background:rgba(255,255,255,.06);backdrop-filter:blur(14px)}
.dup-stat span{display:block;color:rgba(226,232,240,.66);font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase}
.dup-stat strong{display:block;margin-top:6px;color:#fff;font-size:22px;font-weight:800;letter-spacing:-.04em}
.dup-toolbar{display:grid;gap:16px;padding:20px;border:1px solid var(--card-edge);border-radius:22px;background:var(--card-bg);box-shadow:var(--shadow)}
.dup-toolbar__row{display:flex;justify-content:space-between;align-items:end;gap:14px;flex-wrap:wrap}
.dup-search{display:flex;gap:10px;flex-wrap:wrap;flex:1}
.dup-search__field{flex:1;min-width:260px}
.dup-search label,.dup-actions__label{display:block;margin-bottom:7px;color:var(--text-soft);font-size:12px;font-weight:700;letter-spacing:.06em;text-transform:uppercase}
.dup-input{width:100%;padding:13px 15px;border:1px solid #d6e2ef;border-radius:14px;background:#fbfdff;color:var(--text-main);font-size:14px;transition:border-color .2s ease,box-shadow .2s ease}
.dup-input:focus{outline:0;border-color:#60a5fa;box-shadow:0 0 0 4px rgba(96,165,250,.14)}
.dup-button,.dup-link{display:inline-flex;align-items:center;justify-content:center;min-height:46px;padding:0 16px;border-radius:14px;border:none;text-decoration:none;font-size:14px;font-weight:700;cursor:pointer;transition:transform .2s ease,box-shadow .2s ease,background .2s ease}
.dup-button.primary{background:linear-gradient(135deg,#2563eb,#1d4ed8);color:#fff;box-shadow:0 10px 24px rgba(37,99,235,.22)}
.dup-button.secondary,.dup-link{background:#eef4fa;color:#355070}
.dup-button:hover,.dup-link:hover{transform:translateY(-2px)}
.dup-clusters{display:grid;gap:18px}
.cluster-card{overflow:hidden;border:1px solid var(--card-edge);border-radius:24px;background:var(--card-bg);box-shadow:var(--shadow)}
.cluster-head{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;padding:20px 22px;border-bottom:1px solid #edf2f7;background:linear-gradient(135deg,#fbfdff 0%,#f1f7ff 100%)}
.cluster-head__left{min-width:0}
.cluster-label{display:inline-flex;align-items:center;padding:6px 10px;border-radius:999px;background:rgba(37,99,235,.08);color:#2563eb;font-size:10px;font-weight:700;letter-spacing:.1em;text-transform:uppercase}
.cluster-ip{margin-top:10px;color:var(--text-main);font-size:22px;font-weight:800;letter-spacing:-.04em;word-break:break-word}
.cluster-sub{margin-top:6px;color:var(--text-soft);font-size:13px}
.cluster-badge{display:inline-flex;align-items:center;padding:9px 13px;border-radius:999px;background:#fef3c7;color:#92400e;font-size:12px;font-weight:800;white-space:nowrap}
.cluster-body{padding:18px}
.user-list{display:grid;gap:12px}
.user-row{display:grid;grid-template-columns:minmax(0,1.05fr) minmax(0,.95fr) auto auto;gap:14px;align-items:center;padding:16px;border:1px solid #e7eef6;border-radius:18px;background:linear-gradient(180deg,#ffffff,#f9fbfd)}
.user-main,.user-device{min-width:0}
.user-name{color:var(--text-main);font-size:15px;font-weight:800}
.user-meta{margin-top:4px;color:var(--text-soft);font-size:12px;line-height:1.55;word-break:break-word}
.user-account{display:inline-flex;align-items:center;margin-top:7px;padding:5px 9px;border-radius:999px;background:#eef4fa;color:#355070;font-size:11px;font-weight:700}
.user-device strong{display:block;color:#1e293b;font-size:14px}
.user-balance{display:grid;justify-items:end}
.user-balance span{color:var(--text-soft);font-size:11px;font-weight:700;letter-spacing:.07em;text-transform:uppercase}
.user-balance strong{margin-top:5px;color:#059669;font-size:16px;font-weight:800}
.user-actions{display:flex;justify-content:flex-end}
.user-actions a{display:inline-flex;align-items:center;justify-content:center;min-height:40px;padding:0 14px;border-radius:12px;background:rgba(37,99,235,.08);color:#1d4ed8;text-decoration:none;font-size:13px;font-weight:700}
.empty-panel{padding:64px 24px;border:1px dashed #c9d7e6;border-radius:24px;background:linear-gradient(180deg,#ffffff,#f8fbfe);text-align:center;color:var(--text-soft)}
.empty-panel__title{margin-bottom:10px;color:var(--text-main);font-size:26px;font-weight:800;letter-spacing:-.04em}
.empty-panel__copy{max-width:520px;margin:0 auto;font-size:14px;line-height:1.7}
.pagination-wrap{display:flex;justify-content:center;margin-top:6px}
@media (max-width:768px){
.dup-hero{padding:20px 16px}
.dup-stats{grid-template-columns:1fr}
.dup-toolbar{padding:16px}
.dup-search__field{min-width:100%}
.cluster-head{padding:18px 16px;flex-direction:column}
.cluster-body{padding:14px}
.user-row{grid-template-columns:1fr;padding:14px}
.user-balance,.user-actions{justify-items:start;justify-content:flex-start}
}
</style>

@php
  $totalClusters = $clusters->total();
  $totalAccounts = $clusters->getCollection()->sum('account_count');
  $largestCluster = $clusters->getCollection()->max('account_count') ?? 0;
@endphp

<div class="dup-shell">
  <section class="dup-hero">
    <div class="dup-hero__content">
      <div class="dup-hero__top">
        <div>
          <span class="dup-kicker">Risk Review Console</span>
          <h2 class="dup-title">Duplicate IP Clusters</h2>
          <p class="dup-sub">Track groups of non-admin accounts sharing the same stored IP and review them as linked clusters instead of isolated rows.</p>
        </div>
      </div>

      <div class="dup-stats">
        <div class="dup-stat">
          <span>Visible Clusters</span>
          <strong>{{ number_format($totalClusters) }}</strong>
        </div>
        <div class="dup-stat">
          <span>Accounts In View</span>
          <strong>{{ number_format($totalAccounts) }}</strong>
        </div>
        <div class="dup-stat">
          <span>Largest Cluster</span>
          <strong>{{ number_format($largestCluster) }}</strong>
        </div>
      </div>
    </div>
  </section>

  <section class="dup-toolbar">
    <div class="dup-toolbar__row">
      <form method="GET" action="{{ route('admin.users.duplicate-ips') }}" class="dup-search">
        <div class="dup-search__field">
          <label for="cluster-search">IP Filter</label>
          <input id="cluster-search" type="text" name="search" class="dup-input" placeholder="Filter by tracked IP address" value="{{ request('search') }}">
        </div>
        <div>
          <label>&nbsp;</label>
          <button type="submit" class="dup-button primary">Apply Filter</button>
        </div>
        <div>
          <label>&nbsp;</label>
          <a href="{{ route('admin.users.duplicate-ips') }}" class="dup-link">Reset</a>
        </div>
      </form>

      <div class="dup-actions">
        <span class="dup-actions__label">Quick View</span>
        <a href="{{ route('admin.users.index', ['risk' => 'shared_ip']) }}" class="dup-link">Open Shared-IP User Table</a>
      </div>
    </div>
  </section>

  @if($clusters->isEmpty())
    <section class="empty-panel">
      <div class="empty-panel__title">No Duplicate IP Clusters</div>
      <div class="empty-panel__copy">No tracked non-admin accounts are currently sharing the same IP address in the stored audit data.</div>
    </section>
  @else
    <div class="dup-clusters">
      @foreach($clusters as $cluster)
        <section class="cluster-card">
          <div class="cluster-head">
            <div class="cluster-head__left">
              <span class="cluster-label">Tracked IP</span>
              <div class="cluster-ip">{{ $cluster->tracked_ip }}</div>
              <div class="cluster-sub">All non-admin accounts currently linked to this tracked IP.</div>
            </div>
            <span class="cluster-badge">{{ $cluster->account_count }} accounts</span>
          </div>

          <div class="cluster-body">
            <div class="user-list">
              @foreach($cluster->users as $user)
                <div class="user-row">
                  <div class="user-main">
                    <div class="user-name">{{ $user->username }}</div>
                    <div class="user-meta">{{ $user->email }}</div>
                    <div class="user-account">{{ $user->account_id }}</div>
                  </div>

                  <div class="user-device">
                    <strong>{{ $user->device_label }}</strong>
                    <div class="user-meta">{{ \Illuminate\Support\Str::limit($user->tracked_user_agent ?: 'No user agent recorded', 85) }}</div>
                  </div>

                  <div class="user-balance">
                    <span>Balance</span>
                    <strong>${{ number_format($user->balance ?? 0, 2) }}</strong>
                  </div>

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
</div>
@endsection
