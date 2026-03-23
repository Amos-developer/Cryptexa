@extends('admin.layouts.app')

@section('title', 'Users')
@section('page-title', 'Users')
@section('page-description', 'Manage all users')

@section('content')
<style>
@media (prefers-color-scheme: dark){:root{--bg-card:#1e293b;--bg-filter:#0f172a;--text-primary:#e2e8f0;--text-secondary:#94a3b8;--border-color:#334155;--hover-bg:#334155}}
@media (prefers-color-scheme: light){:root{--bg-card:#fff;--bg-filter:#fff;--text-primary:#1e293b;--text-secondary:#64748b;--border-color:#e2e8f0;--hover-bg:#f8fafc}}
.stat-box{background:#fff;padding:25px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.08);display:flex;align-items:center;gap:20px;margin-bottom:20px}
.stat-icon{width:60px;height:60px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px;color:#fff}
.stat-icon.blue{background:linear-gradient(135deg,#667eea,#764ba2)}
.stat-icon.green{background:linear-gradient(135deg,#11998e,#38ef7d)}
.stat-icon.yellow{background:linear-gradient(135deg,#f093fb,#f5576c)}
.stat-icon.purple{background:linear-gradient(135deg,#667eea,#764ba2)}
.stat-icon.red{background:linear-gradient(135deg,#fa709a,#fee140)}
.stat-icon.orange{background:linear-gradient(135deg,#f59e0b,#d97706)}
.stat-info h4{margin:0;font-size:14px;color:#888;font-weight:400}
.stat-info h2{margin:5px 0 0;font-size:28px;font-weight:700;color:#333}
.filter-card{background:var(--bg-filter);border-radius:16px;padding:20px;box-shadow:0 4px 20px rgba(0,0,0,.08);margin-bottom:24px}
.filter-row{display:flex;flex-wrap:wrap;gap:12px;align-items:end}
.filter-group{flex:1;min-width:200px}
.filter-group label{display:block;font-size:13px;font-weight:600;color:var(--text-secondary);margin-bottom:6px}
.filter-input,.filter-select{width:100%;padding:10px 14px;border:2px solid var(--border-color);border-radius:10px;font-size:14px;transition:all .3s;background:var(--bg-card);color:var(--text-primary)}
.filter-input:focus,.filter-select:focus{outline:0;border-color:#667eea;box-shadow:0 0 0 3px rgba(102,126,234,.1)}
.btn-filter{padding:10px 20px;border:none;border-radius:10px;font-weight:600;font-size:14px;cursor:pointer;transition:all .3s}
.btn-primary{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff}
.btn-primary:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(102,126,234,.4)}
.btn-secondary{background:#f1f5f9;color:#64748b}
.btn-secondary:hover{background:#e2e8f0}
.table-card{background:var(--bg-card);border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08)}
.table-header{padding:20px 24px;border-bottom:2px solid var(--border-color)}
.table-title{font-size:20px;font-weight:700;color:var(--text-primary)}
.modern-table{width:100%;border-collapse:separate;border-spacing:0}
.modern-table thead th{background:var(--hover-bg);padding:16px 20px;text-align:left;font-size:13px;font-weight:700;color:var(--text-secondary);text-transform:uppercase;letter-spacing:.5px;border-bottom:2px solid var(--border-color)}
.modern-table tbody td{padding:16px 20px;border-bottom:1px solid var(--border-color);font-size:14px;color:var(--text-primary)}
.modern-table tbody tr:hover{background:var(--hover-bg)}
.user-avatar{width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:inline-flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:16px;margin-right:12px;vertical-align:middle}
.role-badge{display:inline-block;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600}
.role-admin{background:#fee2e2;color:#991b1b}
.role-user{background:#dbeafe;color:#1e40af}
.meta-stack{display:flex;flex-direction:column;gap:4px}
.meta-main{font-weight:600;color:var(--text-primary)}
.meta-sub{font-size:12px;color:var(--text-secondary);word-break:break-word}
.risk-badge{display:inline-flex;align-items:center;padding:4px 8px;border-radius:999px;font-size:10px;font-weight:700;letter-spacing:.04em}
.risk-badge.warn{background:#fef3c7;color:#92400e}
.action-btn{width:36px;height:36px;border-radius:8px;border:none;cursor:pointer;transition:all .3s;display:inline-flex;align-items:center;justify-content:center;margin:0 4px}
.action-btn.view{background:#dbeafe;color:#1e40af}
.action-btn.view:hover{background:#bfdbfe}
.action-btn.edit{background:#fef3c7;color:#92400e}
.action-btn.edit:hover{background:#fde68a}
.action-btn.delete{background:#fee2e2;color:#991b1b}
.action-btn.delete:hover{background:#fecaca}
.pagination-wrapper{padding:20px 24px;display:flex;justify-content:center}
.pagination{display:flex;gap:8px;list-style:none;padding:0;margin:0}
.pagination li a,.pagination li span{display:block;padding:8px 14px;border-radius:8px;font-size:14px;font-weight:600;transition:all .3s}
.pagination li.active span{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff}
.pagination li:not(.active):not(.disabled) a{background:#f1f5f9;color:#64748b}
.pagination li:not(.active):not(.disabled) a:hover{background:#e2e8f0}
.pagination li.disabled span{background:#f8fafc;color:#cbd5e1}
.empty-state{text-align:center;padding:60px 20px;color:var(--text-secondary)}
.empty-icon{font-size:64px;margin-bottom:16px;opacity:.5}
@media (prefers-color-scheme: dark){.btn-secondary{background:#334155;color:#e2e8f0}.btn-secondary:hover{background:#475569}.pagination li:not(.active):not(.disabled) a{background:#334155;color:#e2e8f0}.pagination li:not(.active):not(.disabled) a:hover{background:#475569}.pagination li.disabled span{background:#1e293b;color:#64748b}}
@media(max-width:768px){
.stat-box{padding:20px}
.stat-info h2{font-size:24px}
.filter-row{flex-direction:column}
.filter-group{min-width:100%}
.table-card{border-radius:12px}
.modern-table{font-size:13px}
.modern-table thead{display:none}
.modern-table tbody td{display:block;text-align:right;padding:12px 16px;position:relative;padding-left:50%}
.modern-table tbody td:before{content:attr(data-label);position:absolute;left:16px;font-weight:700;color:var(--text-secondary);text-align:left}
.modern-table tbody tr{border:2px solid var(--border-color);border-radius:12px;margin-bottom:12px;display:block}
.user-avatar{margin-right:8px}
}
</style>

<div class="container-fluid" style="padding:20px">
  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12">
      <div class="stat-box">
        <div class="stat-icon blue"><i class="fa fa-users"></i></div>
        <div class="stat-info">
          <h4>Total Users</h4>
          <h2>{{ number_format($users->total()) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
      <div class="stat-box">
        <div class="stat-icon yellow"><i class="fa fa-dollar"></i></div>
        <div class="stat-info">
          <h4>Total Balance</h4>
          <h2>${{ number_format($users->sum('balance'), 2) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
      <div class="stat-box">
        <div class="stat-icon green"><i class="fa fa-user-circle"></i></div>
        <div class="stat-info">
          <h4>With Referrals</h4>
          <h2>{{ number_format($users->where('referrals_count', '>', 0)->count()) }}</h2>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12">
      <div class="stat-box">
        <div class="stat-icon purple"><i class="fa fa-clock"></i></div>
        <div class="stat-info">
          <h4>Active Today</h4>
          <h2>{{ number_format($users->where('created_at', '>=', today())->count()) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
      <div class="stat-box">
        <div class="stat-icon red"><i class="fa fa-check-circle"></i></div>
        <div class="stat-info">
          <h4>Verified</h4>
          <h2>{{ number_format($users->whereNotNull('email_verified_at')->count()) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
      <div class="stat-box">
        <div class="stat-icon orange"><i class="fa fa-user-plus"></i></div>
        <div class="stat-info">
          <h4>This Week</h4>
          <h2>{{ number_format($users->where('created_at', '>=', now()->startOfWeek())->count()) }}</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="filter-card">
    <form id="filterForm" action="{{ url('/admin/users') }}" method="GET">
      <div class="filter-row">
        <div class="filter-group">
          <label>🔍 Search</label>
          <input type="text" name="search" id="searchInput" class="filter-input" placeholder="Name, email, or ID" value="{{ request('search') }}">
        </div>
        <div class="filter-group">
          <label>🎭 Role</label>
          <select name="role" id="roleSelect" class="filter-select">
            <option value="">All Roles</option>
            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
          </select>
        </div>
        <div class="filter-group">
          <label>Risk</label>
          <select name="risk" id="riskSelect" class="filter-select">
            <option value="">All Users</option>
            <option value="shared_ip" {{ request('risk') == 'shared_ip' ? 'selected' : '' }}>Shared IP Only</option>
          </select>
        </div>
        <div style="display:flex;gap:8px">
          <button type="submit" class="btn-filter btn-primary">🔍 Filter</button>
          <button type="button" id="resetBtn" class="btn-filter btn-secondary">↻ Reset</button>
        </div>
      </div>
    </form>
  </div>

  <div id="contentArea">

  <div class="table-card">
    <div class="table-header">
      <h3 class="table-title">Users List</h3>
    </div>
    <div style="overflow-x:auto">
      <table class="modern-table">
        <thead>
          <tr>
            <th>#</th>
            <th>User</th>
            <th>Account ID</th>
            <th>Email</th>
            <th>IP Address</th>
            <th>Device</th>
            <th>Balance</th>
            <th>Role</th>
            <th>Referrals</th>
            <th>Joined</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
          <tr>
            <td data-label="#">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
            <td data-label="User">
              <span class="user-avatar">{{ strtoupper(substr($user->username ?? $user->email, 0, 1)) }}</span>
              <span style="font-weight:600">{{ $user->username }}</span>
            </td>
            <td data-label="Account ID"><code style="background:var(--hover-bg);padding:4px 8px;border-radius:6px;font-size:12px">{{ $user->account_id }}</code></td>
            <td data-label="Email" style="color:var(--text-secondary)">{{ $user->email }}</td>
            <td data-label="IP Address">
              <div class="meta-stack">
                <span class="meta-main">{{ $user->tracked_ip_address ?: 'N/A' }}</span>
                @if($user->same_ip_users_count > 0)
                  <span class="risk-badge warn">Shared IP Risk</span>
                @endif
                @if($user->same_ip_users_count > 0)
                  <span class="meta-sub">
                    Shared with {{ $user->same_ip_users_count }} other account(s)
                    @if($user->shared_ip_usernames)
                      : {{ $user->shared_ip_usernames }}{{ $user->same_ip_users_count > 3 ? ' +' . ($user->same_ip_users_count - 3) . ' more' : '' }}
                    @endif
                  </span>
                @else
                  <span class="meta-sub">Unique so far</span>
                @endif
              </div>
            </td>
            <td data-label="Device">
              <div class="meta-stack">
                <span class="meta-main">{{ $user->device_label }}</span>
                <span class="meta-sub">{{ \Illuminate\Support\Str::limit($user->tracked_user_agent ?: 'No tracking data yet', 55) }}</span>
              </div>
            </td>
            <td data-label="Balance" style="font-weight:700;color:#059669">${{ number_format($user->balance ?? 0, 2) }}</td>
            <td data-label="Role">
              @if($user->role == 'admin')
                <span class="role-badge role-admin">👑 Admin</span>
              @else
                <span class="role-badge role-user">👤 User</span>
              @endif
            </td>
            <td data-label="Referrals" style="font-weight:600">{{ $user->referrals_count }}</td>
            <td data-label="Joined" style="color:var(--text-secondary)">{{ $user->created_at->format('M d, Y') }}</td>
            <td data-label="Actions">
              <a href="{{ route('admin.users.show', $user) }}" class="action-btn view" title="View">👁️</a>
              <a href="{{ route('admin.users.edit', $user) }}" class="action-btn edit" title="Edit">✏️</a>
              <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this user?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-btn delete" title="Delete">🗑️</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="11" class="empty-state">
              <div class="empty-icon">👥</div>
              <div style="font-size:18px;font-weight:600;margin-bottom:8px">No Users Found</div>
              <div style="font-size:14px">Try adjusting your filters</div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($users->hasPages())
    <div class="pagination-wrapper">
      <ul class="pagination">
        @if($users->onFirstPage())
          <li class="disabled"><span>←</span></li>
        @else
          <li><a href="{{ $users->previousPageUrl() }}">←</a></li>
        @endif
        @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
          @if($page == $users->currentPage())
            <li class="active"><span>{{ $page }}</span></li>
          @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach
        @if($users->hasMorePages())
          <li><a href="{{ $users->nextPageUrl() }}">→</a></li>
        @else
          <li class="disabled"><span>→</span></li>
        @endif
      </ul>
    </div>
    @endif
  </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('filterForm');
  const searchInput = document.getElementById('searchInput');
  const roleSelect = document.getElementById('roleSelect');
  const riskSelect = document.getElementById('riskSelect');
  const resetBtn = document.getElementById('resetBtn');
  const contentArea = document.getElementById('contentArea');
  
  let debounceTimer;
  
  function loadUsers(url) {
    fetch(url, {
      headers: {'X-Requested-With': 'XMLHttpRequest'}
    })
    .then(response => response.text())
    .then(html => {
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      const newContent = doc.getElementById('contentArea');
      if (newContent) {
        contentArea.innerHTML = newContent.innerHTML;
        attachPaginationListeners();
      }
    });
  }
  
  function attachPaginationListeners() {
    document.querySelectorAll('.pagination a').forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        loadUsers(this.href);
      });
    });
  }
  
  searchInput.addEventListener('input', function() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
      const formData = new FormData(form);
      const params = new URLSearchParams(formData);
      loadUsers('{{ route('admin.users.index') }}?' + params.toString());
    }, 500);
  });
  
  roleSelect.addEventListener('change', function() {
    const formData = new FormData(form);
    const params = new URLSearchParams(formData);
    loadUsers('{{ route('admin.users.index') }}?' + params.toString());
  });

  riskSelect.addEventListener('change', function() {
    const formData = new FormData(form);
    const params = new URLSearchParams(formData);
    loadUsers('{{ route('admin.users.index') }}?' + params.toString());
  });
  
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(form);
    const params = new URLSearchParams(formData);
    loadUsers('{{ route('admin.users.index') }}?' + params.toString());
  });
  
  resetBtn.addEventListener('click', function() {
    searchInput.value = '';
    roleSelect.value = '';
    riskSelect.value = '';
    loadUsers('{{ route('admin.users.index') }}');
  });
  
  attachPaginationListeners();
});
</script>
@endsection
