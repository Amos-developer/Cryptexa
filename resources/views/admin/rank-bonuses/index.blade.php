@extends('admin.layouts.app')

@section('title', 'Rank Bonuses')
@section('page-title', 'Rank Bonuses')
@section('page-description', 'View rank bonus payments')

@section('content')
<style>
.stat-box{background:#fff;padding:25px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.08);display:flex;align-items:center;gap:20px;margin-bottom:20px}
.stat-icon{width:60px;height:60px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px;color:#fff}
.stat-icon.blue{background:linear-gradient(135deg,#667eea,#764ba2)}
.stat-icon.green{background:linear-gradient(135deg,#11998e,#38ef7d)}
.stat-icon.yellow{background:linear-gradient(135deg,#f093fb,#f5576c)}
.stat-icon.purple{background:linear-gradient(135deg,#fa709a,#fee140)}
.stat-icon.red{background:linear-gradient(135deg,#fa709a,#fee140)}
.stat-info h4{margin:0;font-size:14px;color:#888;font-weight:400}
.stat-info h2{margin:5px 0 0;font-size:28px;font-weight:700;color:#333}
.table-card{background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08);margin-top:24px}
.table-header{padding:20px 24px;border-bottom:2px solid #f1f5f9}
.table-title{font-size:20px;font-weight:700;color:#1e293b}
.modern-table{width:100%;border-collapse:separate;border-spacing:0}
.modern-table thead th{background:#f8fafc;padding:16px 20px;text-align:left;font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;border-bottom:2px solid #e2e8f0}
.modern-table tbody td{padding:16px 20px;border-bottom:1px solid #f1f5f9;font-size:14px;color:#334155}
.modern-table tbody tr:hover{background:#f8fafc}
.rank-badge{display:inline-block;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600}
.rank-junior{background:#dbeafe;color:#1e40af}
.rank-elite{background:#d1fae5;color:#065f46}
.rank-legendary{background:#fef3c7;color:#92400e}
.rank-grand{background:#fee2e2;color:#991b1b}
.action-btn{width:36px;height:36px;border-radius:8px;border:none;cursor:pointer;transition:all .3s;display:inline-flex;align-items:center;justify-content:center;margin:0 2px}
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
</style>

<div class="container-fluid" style="padding:20px">
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon blue"><i class="fa fa-trophy"></i></div>
        <div class="stat-info">
          <h4>Junior Leaders</h4>
          <h2>{{ number_format($totalJunior) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon green"><i class="fa fa-trophy"></i></div>
        <div class="stat-info">
          <h4>Elite Leaders</h4>
          <h2>{{ number_format($totalElite) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon yellow"><i class="fa fa-trophy"></i></div>
        <div class="stat-info">
          <h4>Legendary Leaders</h4>
          <h2>{{ number_format($totalLegendary) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon red"><i class="fa fa-crown"></i></div>
        <div class="stat-info">
          <h4>Grand Leaders</h4>
          <h2>{{ number_format($totalGrand) }}</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="table-card">
    <div class="table-header">
      <h3 class="table-title">Users with Rank Bonuses (Total Paid: ${{ number_format($totalPaid, 2) }})</h3>
    </div>
    <div style="overflow-x:auto">
      <table class="modern-table">
        <thead>
          <tr>
            <th>User</th>
            <th>Referrals</th>
            <th>Junior ($5)</th>
            <th>Elite ($20)</th>
            <th>Legendary ($50)</th>
            <th>Grand ($150)</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
          <tr>
            <td data-label="User" style="font-weight:600">{{ $user->username }}</td>
            <td data-label="Referrals">{{ $user->referrals_count }}</td>
            <td>{{ $user->junior_leader_bonus_paid ? '✅' : '❌' }}</td>
            <td>{{ $user->elite_leader_bonus_paid ? '✅' : '❌' }}</td>
            <td>{{ $user->legendary_leader_bonus_paid ? '✅' : '❌' }}</td>
            <td>{{ $user->grand_leader_bonus_paid ? '✅' : '❌' }}</td>
            <td data-label="Actions">
              <a href="{{ route('admin.rank-bonuses.edit', $user) }}" class="action-btn edit" title="Edit">✏️</a>
              <form action="{{ route('admin.rank-bonuses.destroy', $user) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-btn delete" title="Reset" onclick="return confirm('Reset all bonuses for this user?')">🗑️</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="empty-state">
              <div style="font-size:64px;margin-bottom:16px;opacity:.5">🏆</div>
              <div style="font-size:18px;font-weight:600;margin-bottom:8px">No Rank Bonuses Paid</div>
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
