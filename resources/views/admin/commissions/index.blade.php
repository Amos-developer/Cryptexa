@extends('admin.layouts.app')

@section('title', 'Referral Commissions')
@section('page-title', 'Referral Commissions')
@section('page-description', 'View all referral commission payments')

@section('content')
<style>
.stat-box{background:#fff;padding:25px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.08);display:flex;align-items:center;gap:20px;margin-bottom:20px}
.stat-icon{width:60px;height:60px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px;color:#fff}
.stat-icon.blue{background:linear-gradient(135deg,#667eea,#764ba2)}
.stat-icon.green{background:linear-gradient(135deg,#11998e,#38ef7d)}
.stat-icon.yellow{background:linear-gradient(135deg,#f093fb,#f5576c)}
.stat-icon.purple{background:linear-gradient(135deg,#fa709a,#fee140)}
.stat-info h4{margin:0;font-size:14px;color:#888;font-weight:400}
.stat-info h2{margin:5px 0 0;font-size:28px;font-weight:700;color:#333}
.table-card{background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08);margin-top:24px}
.table-header{padding:20px 24px;border-bottom:2px solid #f1f5f9}
.table-title{font-size:20px;font-weight:700;color:#1e293b}
.modern-table{width:100%;border-collapse:separate;border-spacing:0}
.modern-table thead th{background:#f8fafc;padding:16px 20px;text-align:left;font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;border-bottom:2px solid #e2e8f0}
.modern-table tbody td{padding:16px 20px;border-bottom:1px solid #f1f5f9;font-size:14px;color:#334155}
.modern-table tbody tr:hover{background:#f8fafc}
.level-badge{display:inline-block;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600}
.level-1{background:#dbeafe;color:#1e40af}
.level-2{background:#d1fae5;color:#065f46}
.level-3{background:#fef3c7;color:#92400e}
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
        <div class="stat-icon blue"><i class="fa fa-dollar"></i></div>
        <div class="stat-info">
          <h4>Total Commissions</h4>
          <h2>${{ number_format($totalCommissions, 2) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon green"><i class="fa fa-layer-group"></i></div>
        <div class="stat-info">
          <h4>Level 1 (2%)</h4>
          <h2>${{ number_format($level1Total, 2) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon yellow"><i class="fa fa-layer-group"></i></div>
        <div class="stat-info">
          <h4>Level 2 (1%)</h4>
          <h2>${{ number_format($level2Total, 2) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon purple"><i class="fa fa-layer-group"></i></div>
        <div class="stat-info">
          <h4>Level 3 (0.5%)</h4>
          <h2>${{ number_format($level3Total, 2) }}</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="table-card">
    <div class="table-header">
      <h3 class="table-title">Commission History</h3>
    </div>
    <div style="overflow-x:auto">
      <table class="modern-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Referrer</th>
            <th>From User</th>
            <th>Level</th>
            <th>Commission</th>
            <th>Balance Before</th>
            <th>Balance After</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($commissions as $commission)
          <tr>
            <td data-label="ID">#{{ $commission->id }}</td>
            <td data-label="Referrer" style="font-weight:600">{{ $commission->user->username ?? 'N/A' }}</td>
            <td data-label="From User">{{ $commission->fromUser->username ?? 'N/A' }}</td>
            <td data-label="Level">
              <span class="level-badge level-{{ $commission->level }}">Level {{ $commission->level }}</span>
            </td>
            <td data-label="Commission" style="font-weight:700;color:#059669">${{ number_format($commission->amount, 2) }}</td>
            <td data-label="Balance Before" style="color:#64748b">${{ number_format(($commission->balance_before > 0 ? $commission->balance_before : $commission->user->balance - $commission->amount), 2) }}</td>
            <td data-label="Balance After" style="color:#059669;font-weight:600">${{ number_format(($commission->balance_after > 0 ? $commission->balance_after : $commission->user->balance), 2) }}</td>
            <td data-label="Date" style="color:#64748b">{{ $commission->created_at->format('M d, Y H:i') }}</td>
            <td data-label="Actions">
              <a href="{{ route('admin.commissions.show', $commission->id) }}" class="action-btn" style="background:#dbeafe;color:#1e40af" title="View"><i class="fa fa-eye"></i></a>
              <a href="{{ route('admin.commissions.edit', $commission->id) }}" class="action-btn edit" title="Edit"><i class="fa fa-edit"></i></a>
              <form action="{{ route('admin.commissions.destroy', $commission->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this commission?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-btn delete" title="Delete"><i class="fa fa-trash"></i></button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="9" class="empty-state">
              <div style="font-size:64px;margin-bottom:16px;opacity:.5">💰</div>
              <div style="font-size:18px;font-weight:600;margin-bottom:8px">No Commissions Found</div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($commissions->hasPages())
    <div class="pagination-wrapper">
      <ul class="pagination">
        @if($commissions->onFirstPage())
          <li class="disabled"><span>←</span></li>
        @else
          <li><a href="{{ $commissions->previousPageUrl() }}">←</a></li>
        @endif
        @foreach($commissions->getUrlRange(1, $commissions->lastPage()) as $page => $url)
          @if($page == $commissions->currentPage())
            <li class="active"><span>{{ $page }}</span></li>
          @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach
        @if($commissions->hasMorePages())
          <li><a href="{{ $commissions->nextPageUrl() }}">→</a></li>
        @else
          <li class="disabled"><span>→</span></li>
        @endif
      </ul>
    </div>
    @endif
  </div>
</div>
@endsection
