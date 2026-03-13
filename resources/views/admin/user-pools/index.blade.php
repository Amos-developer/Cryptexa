@extends('admin.layouts.app')

@section('title', 'User Vaults')
@section('page-title', 'User Vaults')
@section('page-description', 'Manage user activated Vaults')

@section('content')
<style>
.stat-box{background:#fff;padding:25px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.08);display:flex;align-items:center;gap:20px;margin-bottom:20px}
.stat-icon{width:60px;height:60px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px;color:#fff}
.stat-icon.blue{background:linear-gradient(135deg,#667eea,#764ba2)}
.stat-icon.green{background:linear-gradient(135deg,#11998e,#38ef7d)}
.stat-icon.red{background:linear-gradient(135deg,#fa709a,#fee140)}
.stat-info h4{margin:0;font-size:14px;color:#888;font-weight:400}
.stat-info h2{margin:5px 0 0;font-size:28px;font-weight:700;color:#333}
.table-card{background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08);margin-top:24px}
.table-header{padding:20px 24px;border-bottom:2px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center}
.table-title{font-size:20px;font-weight:700;color:#1e293b}
.modern-table{width:100%;border-collapse:separate;border-spacing:0}
.modern-table thead th{background:#f8fafc;padding:16px 20px;text-align:left;font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;border-bottom:2px solid #e2e8f0}
.modern-table tbody td{padding:16px 20px;border-bottom:1px solid #f1f5f9;font-size:14px;color:#334155}
.modern-table tbody tr:hover{background:#f8fafc}
.status-badge{display:inline-block;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600}
.status-active{background:#fef3c7;color:#92400e}
.status-completed{background:#d1fae5;color:#065f46}
.status-inactive{background:#fee2e2;color:#991b1b}
.action-btn{width:36px;height:36px;border-radius:8px;border:none;cursor:pointer;transition:all .3s;display:inline-flex;align-items:center;justify-content:center;margin:0 2px}
.action-btn.view{background:#dbeafe;color:#1e40af}
.action-btn.view:hover{background:#bfdbfe}
.action-btn.edit{background:#fef3c7;color:#92400e}
.action-btn.edit:hover{background:#fde68a}
.pagination-wrapper{padding:20px 24px;display:flex;justify-content:center}
.pagination{display:flex;gap:8px;list-style:none;padding:0;margin:0}
.pagination li a,.pagination li span{display:block;padding:8px 14px;border-radius:8px;font-size:14px;font-weight:600;transition:all .3s}
.pagination li.active span{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff}
.pagination li:not(.active):not(.disabled) a{background:#f1f5f9;color:#64748b}
.pagination li:not(.active):not(.disabled) a:hover{background:#e2e8f0}
.pagination li.disabled span{background:#f8fafc;color:#cbd5e1}
.empty-state{text-align:center;padding:60px 20px;color:#94a3b8}
.empty-icon{font-size:64px;margin-bottom:16px;opacity:.5}
@media(max-width:768px){
.stat-box{padding:20px}
.stat-info h2{font-size:24px}
.table-card{border-radius:12px}
.modern-table{font-size:13px}
.modern-table thead{display:none}
.modern-table tbody td{display:block;text-align:right;padding:12px 16px;position:relative;padding-left:50%}
.modern-table tbody td:before{content:attr(data-label);position:absolute;left:16px;font-weight:700;color:#64748b;text-align:left}
.modern-table tbody tr{border:2px solid #f1f5f9;border-radius:12px;margin-bottom:12px;display:block}
}
</style>

<div class="container-fluid" style="padding:20px">
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon green"><i class="fa fa-play-circle"></i></div>
        <div class="stat-info">
          <h4>Active Vaults</h4>
          <h2>{{ number_format($totalRunning) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon blue"><i class="fa fa-check-circle"></i></div>
        <div class="stat-info">
          <h4>Completed Vaults</h4>
          <h2>{{ number_format($totalCompleted) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon red"><i class="fa fa-coins"></i></div>
        <div class="stat-info">
          <h4>Total Invested</h4>
          <h2>${{ number_format($totalInvested, 2) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon red"><i class="fa fa-dollar"></i></div>
        <div class="stat-info">
          <h4>Total Revenue</h4>
          <h2>${{ number_format($totalRevenue, 2) }}</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="table-card">
    <div class="table-header">
      <h3 class="table-title">User Activated Vaults</h3>
    </div>
    <div style="overflow-x:auto">
      <table class="modern-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>User</th>
            <th>Vault</th>
            <th>Amount Invested</th>
            <th>Status</th>
            <th>Profit Earned</th>
            <th>Balance Before</th>
            <th>Balance After</th>
            <th>Started</th>
            <th>Ends</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($userPools as $userPool)
          <tr>
            <td data-label="ID">#{{ $userPool->id }}</td>
            <td data-label="User">
              @if($userPool->user)
                <a href="{{ route('admin.users.show', $userPool->user) }}" style="color:#667eea;font-weight:600;text-decoration:none">{{ $userPool->user->username }}</a>
              @else
                <span style="color:#94a3b8">Unknown</span>
              @endif
            </td>
            <td data-label="Vault" style="font-weight:700;color:#667eea">{{ $userPool->computePlan->name ?? 'N/A' }}</td>
            <td data-label="Amount Invested" style="font-weight:700;color:#dc2626">${{ number_format($userPool->amount ?? 0, 2) }}</td>
            <td data-label="Status">
              @if($userPool->status == 'running')
                <span class="status-badge status-active">✓ Running</span>
              @else
                <span class="status-badge status-completed">✓ Completed</span>
              @endif
            </td>
            <td data-label="Profit Earned" style="font-weight:700;color:#059669">${{ number_format($userPool->expected_profit ?? 0, 2) }}</td>
            <td data-label="Balance Before" style="font-weight:600;color:#059669">${{ number_format($userPool->balance_before ?? 0, 2) }}</td>
            <td data-label="Balance After" style="font-weight:600;color:#0284c7">${{ number_format($userPool->balance_after ?? 0, 2) }}</td>
            <td data-label="Started" style="color:#64748b">{{ $userPool->started_at ? $userPool->started_at->format('M d, Y H:i') : 'N/A' }}</td>
            <td data-label="Ends" style="color:#64748b">{{ $userPool->ends_at ? $userPool->ends_at->format('M d, Y H:i') : 'N/A' }}</td>
            <td data-label="Actions">
              <a href="{{ route('admin.user-pools.show', $userPool) }}" class="action-btn view" title="View">👁️</a>
              <a href="{{ route('admin.user-pools.edit', $userPool) }}" class="action-btn edit" title="Edit">✏️</a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="11" class="empty-state">
              <div class="empty-icon">🏊</div>
              <div style="font-size:18px;font-weight:600;margin-bottom:8px">No User Vaults Found</div>
              <div style="font-size:14px">No Vaults have been activated yet</div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($userPools->hasPages())
    <div class="pagination-wrapper">
      <ul class="pagination">
        @if($userPools->onFirstPage())
          <li class="disabled"><span>←</span></li>
        @else
          <li><a href="{{ $userPools->previousPageUrl() }}">←</a></li>
        @endif
        @foreach($userPools->getUrlRange(1, $userPools->lastPage()) as $page => $url)
          @if($page == $userPools->currentPage())
            <li class="active"><span>{{ $page }}</span></li>
          @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach
        @if($userPools->hasMorePages())
          <li><a href="{{ $userPools->nextPageUrl() }}">→</a></li>
        @else
          <li class="disabled"><span>→</span></li>
        @endif
      </ul>
    </div>
    @endif
  </div>
</div>
@endsection
