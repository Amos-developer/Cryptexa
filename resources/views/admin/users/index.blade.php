@extends('admin.layouts.app')

@section('title', 'Users')
@section('page-title', 'Users')
@section('page-description', 'Manage all users')

@section('content')
<style>
@media (prefers-color-scheme: dark){:root{--bg-card:#1e293b;--bg-filter:#0f172a;--text-primary:#e2e8f0;--text-secondary:#94a3b8;--border-color:#334155;--hover-bg:#334155}}
@media (prefers-color-scheme: light){:root{--bg-card:#fff;--bg-filter:#fff;--text-primary:#1e293b;--text-secondary:#64748b;--border-color:#e2e8f0;--hover-bg:#f8fafc}}
.stat-card{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);border-radius:16px;padding:24px;color:#fff;box-shadow:0 10px 30px rgba(102,126,234,.3);margin-bottom:20px;transition:transform .3s}
.stat-card:hover{transform:translateY(-5px)}
.stat-card.green{background:linear-gradient(135deg,#11998e 0%,#38ef7d 100%)}
.stat-card.orange{background:linear-gradient(135deg,#fa709a 0%,#fee140 100%)}
.stat-card.blue{background:linear-gradient(135deg,#4facfe 0%,#00f2fe 100%)}
.stat-icon{width:56px;height:56px;background:rgba(255,255,255,.2);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:28px;margin-bottom:16px}
.stat-label{font-size:13px;opacity:.9;margin-bottom:8px;font-weight:500}
.stat-value{font-size:32px;font-weight:700;line-height:1}
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
.stat-card{padding:20px}
.stat-value{font-size:28px}
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
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-card green">
        <div class="stat-icon">👥</div>
        <div class="stat-label">Total Users</div>
        <div class="stat-value">{{ $users->total() }}</div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-card orange">
        <div class="stat-icon">👑</div>
        <div class="stat-label">Admin Users</div>
        <div class="stat-value">{{ $users->where('role', 'admin')->count() }}</div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-card blue">
        <div class="stat-icon">👤</div>
        <div class="stat-label">Regular Users</div>
        <div class="stat-value">{{ $users->where('role', '!=', 'admin')->count() }}</div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-card">
        <div class="stat-icon">⭐</div>
        <div class="stat-label">Active Today</div>
        <div class="stat-value">{{ $users->where('created_at', '>=', today())->count() }}</div>
      </div>
    </div>
  </div>

  <div class="filter-card">
    <form action="{{ route('admin.users.index') }}" method="GET">
      <div class="filter-row">
        <div class="filter-group">
          <label>🔍 Search</label>
          <input type="text" name="search" class="filter-input" placeholder="Name, email, or ID" value="{{ request('search') }}">
        </div>
        <div class="filter-group">
          <label>🎭 Role</label>
          <select name="role" class="filter-select">
            <option value="">All Roles</option>
            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
          </select>
        </div>
        <div style="display:flex;gap:8px">
          <button type="submit" class="btn-filter btn-primary">🔍 Filter</button>
          <a href="{{ route('admin.users.index') }}" class="btn-filter btn-secondary">↻ Reset</a>
        </div>
      </div>
    </form>
  </div>

  <div class="table-card">
    <div class="table-header">
      <h3 class="table-title">Users List</h3>
    </div>
    <div style="overflow-x:auto">
      <table class="modern-table">
        <thead>
          <tr>
            <th>User</th>
            <th>Account ID</th>
            <th>Email</th>
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
            <td data-label="User">
              <span class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
              <span style="font-weight:600">{{ $user->name }}</span>
            </td>
            <td data-label="Account ID"><code style="background:var(--hover-bg);padding:4px 8px;border-radius:6px;font-size:12px">{{ $user->account_id }}</code></td>
            <td data-label="Email" style="color:var(--text-secondary)">{{ $user->email }}</td>
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
            <td colspan="8" class="empty-state">
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
@endsection