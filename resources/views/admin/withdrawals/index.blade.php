@extends('admin.layouts.app')

@section('title', 'Withdrawals')
@section('page-title', 'Withdrawals')
@section('page-description', 'Manage all withdrawals')

@section('content')
<style>
.stat-box{background:#fff;padding:25px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.08);display:flex;align-items:center;gap:20px;margin-bottom:20px}
.stat-icon{width:60px;height:60px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px;color:#fff}
.stat-icon.blue{background:linear-gradient(135deg,#667eea,#764ba2)}
.stat-icon.green{background:linear-gradient(135deg,#11998e,#38ef7d)}
.stat-icon.yellow{background:linear-gradient(135deg,#f093fb,#f5576c)}
.stat-icon.orange{background:linear-gradient(135deg,#ffa751,#ffe259)}
.stat-info h4{margin:0;font-size:14px;color:#888;font-weight:400}
.stat-info h2{margin:5px 0 0;font-size:28px;font-weight:700;color:#333}
.table-card{background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08);margin-top:24px}
.table-header{padding:20px 24px;border-bottom:2px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center}
.table-title{font-size:20px;font-weight:700;color:#1e293b}
.modern-table{width:100%;border-collapse:separate;border-spacing:0}
.modern-table thead th{background:#f8fafc;padding:16px 20px;text-align:left;font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;border-bottom:2px solid #e2e8f0}
.modern-table tbody td{padding:16px 20px;border-bottom:1px solid #f1f5f9;font-size:14px;color:#334155}
.modern-table tbody tr:hover{background:#f8fafc}
.status-badge{display:inline-block;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600;text-transform:capitalize}
.status-pending{background:#fef3c7;color:#92400e}
.status-approved{background:#dbeafe;color:#1e40af}
.status-completed{background:#d1fae5;color:#065f46}
.status-rejected{background:#fee2e2;color:#991b1b}
.action-btn{width:36px;height:36px;border-radius:8px;border:none;cursor:pointer;transition:all .3s;display:inline-flex;align-items:center;justify-content:center;margin:0 2px}
.action-btn.view{background:#dbeafe;color:#1e40af}
.action-btn.view:hover{background:#bfdbfe}
.action-btn.approve{background:#d1fae5;color:#065f46}
.action-btn.approve:hover{background:#a7f3d0}
.action-btn.reject{background:#fee2e2;color:#991b1b}
.action-btn.reject:hover{background:#fecaca}
.action-btn.complete{background:#fef3c7;color:#92400e}
.action-btn.complete:hover{background:#fde68a}
.pagination-wrapper{padding:20px 24px;display:flex;justify-content:center}
.pagination{display:flex;gap:8px;list-style:none;padding:0;margin:0}
.pagination li a,.pagination li span{display:block;padding:8px 14px;border-radius:8px;font-size:14px;font-weight:600;transition:all .3s}
.pagination li.active span{background:linear-gradient(135deg,#f093fb,#f5576c);color:#fff}
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
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon yellow"><i class="fa fa-arrow-up"></i></div>
        <div class="stat-info">
          <h4>Total Withdrawals</h4>
          <h2>${{ number_format($totalWithdrawals, 2) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon orange"><i class="fa fa-clock"></i></div>
        <div class="stat-info">
          <h4>Pending</h4>
          <h2>${{ number_format($pendingWithdrawals, 2) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon green"><i class="fa fa-check"></i></div>
        <div class="stat-info">
          <h4>Approved</h4>
          <h2>${{ number_format($approvedWithdrawals, 2) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon blue"><i class="fa fa-database"></i></div>
        <div class="stat-info">
          <h4>Total Requests</h4>
          <h2>{{ number_format($totalRequests) }}</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="table-card">
    <div class="table-header">
      <h3 class="table-title">Withdrawal Requests</h3>
      <a href="{{ route('admin.withdrawals.create') }}" class="btn" style="padding:10px 20px;border:none;border-radius:10px;font-weight:600;font-size:14px;background:linear-gradient(135deg,#f093fb,#f5576c);color:#fff;text-decoration:none">➕ Create</a>
    </div>
    <div style="overflow-x:auto">
      <table class="modern-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>User</th>
            <th>Amount</th>
            <th>Currency</th>
            <th>Address</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($withdrawals as $withdrawal)
          <tr>
            <td data-label="ID">#{{ $withdrawal->id }}</td>
            <td data-label="User">
              @if($withdrawal->user)
                <a href="{{ route('admin.users.show', $withdrawal->user) }}" style="color:#667eea;font-weight:600;text-decoration:none">{{ $withdrawal->user->username }}</a>
              @else
                <span style="color:#94a3b8">Unknown</span>
              @endif
            </td>
            <td data-label="Amount" style="font-weight:700;color:#dc2626">${{ number_format($withdrawal->amount, 2) }}</td>
            <td data-label="Currency"><code style="background:#f1f5f9;padding:4px 8px;border-radius:6px;font-size:12px">{{ strtoupper($withdrawal->currency ?? 'USD') }}</code></td>
            <td data-label="Address" style="font-size:12px;max-width:150px;overflow:hidden;text-overflow:ellipsis">{{ $withdrawal->address ?? 'N/A' }}</td>
            <td data-label="Status">
              @if($withdrawal->status == 'completed')
                <span class="status-badge status-completed">✓ Completed</span>
              @elseif($withdrawal->status == 'approved')
                <span class="status-badge status-approved">👍 Approved</span>
              @elseif($withdrawal->status == 'pending')
                <span class="status-badge status-pending">⏳ Pending</span>
              @else
                <span class="status-badge status-rejected">✗ Rejected</span>
              @endif
            </td>
            <td data-label="Date" style="color:#64748b">{{ $withdrawal->created_at->format('M d, Y H:i') }}</td>
            <td data-label="Actions">
              <a href="{{ route('admin.withdrawals.show', $withdrawal) }}" class="action-btn view" title="View">👁️</a>
              @if($withdrawal->status == 'pending')
                <form action="{{ route('admin.withdrawals.approve', $withdrawal) }}" method="POST" style="display:inline">
                  @csrf
                  <button type="submit" class="action-btn approve" title="Approve" onclick="return confirm('Approve this withdrawal?')">✓</button>
                </form>
                <form action="{{ route('admin.withdrawals.reject', $withdrawal) }}" method="POST" style="display:inline">
                  @csrf
                  <button type="submit" class="action-btn reject" title="Reject" onclick="return confirm('Reject and refund?')">✗</button>
                </form>
              @elseif($withdrawal->status == 'approved')
                <button onclick="showCompleteModal({{ $withdrawal->id }})" class="action-btn complete" title="Complete">🏁</button>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8" class="empty-state">
              <div class="empty-icon">📭</div>
              <div style="font-size:18px;font-weight:600;margin-bottom:8px">No Withdrawals Found</div>
              <div style="font-size:14px">No withdrawal requests yet</div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($withdrawals->hasPages())
    <div class="pagination-wrapper">
      <ul class="pagination">
        @if($withdrawals->onFirstPage())
          <li class="disabled"><span>←</span></li>
        @else
          <li><a href="{{ $withdrawals->previousPageUrl() }}">←</a></li>
        @endif
        @foreach($withdrawals->getUrlRange(1, $withdrawals->lastPage()) as $page => $url)
          @if($page == $withdrawals->currentPage())
            <li class="active"><span>{{ $page }}</span></li>
          @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach
        @if($withdrawals->hasMorePages())
          <li><a href="{{ $withdrawals->nextPageUrl() }}">→</a></li>
        @else
          <li class="disabled"><span>→</span></li>
        @endif
      </ul>
    </div>
    @endif
  </div>
</div>

<div id="completeModal" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center">
  <div style="background:#fff;border-radius:16px;padding:32px;max-width:500px;width:90%;box-shadow:0 20px 60px rgba(0,0,0,.3)">
    <h3 style="font-size:24px;font-weight:700;color:#1e293b;margin-bottom:24px">🏁 Complete Withdrawal</h3>
    <form id="completeForm" method="POST">
      @csrf
      <div style="margin-bottom:20px">
        <label style="display:block;font-size:13px;font-weight:600;color:#64748b;margin-bottom:8px">TRANSACTION ID (TXID)</label>
        <input type="text" name="txid" required style="width:100%;padding:12px 16px;border:2px solid #e2e8f0;border-radius:10px;font-size:15px">
      </div>
      <div style="display:flex;gap:12px">
        <button type="button" onclick="closeCompleteModal()" style="flex:1;padding:14px;border:none;border-radius:10px;font-weight:600;background:#f1f5f9;color:#64748b;cursor:pointer">Cancel</button>
        <button type="submit" style="flex:1;padding:14px;border:none;border-radius:10px;font-weight:600;background:linear-gradient(135deg,#11998e,#38ef7d);color:#fff;cursor:pointer">Complete</button>
      </div>
    </form>
  </div>
</div>

<script>
function showCompleteModal(id) {
  document.getElementById('completeForm').action = '/admin/withdrawals/' + id + '/complete';
  document.getElementById('completeModal').style.display = 'flex';
}
function closeCompleteModal() {
  document.getElementById('completeModal').style.display = 'none';
}
</script>
@endsection
