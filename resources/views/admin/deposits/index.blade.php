@extends('admin.layouts.app')

@section('title', 'Deposits')
@section('page-title', 'Deposits')
@section('page-description', 'Manage all deposits')

@section('content')
<style>
.stat-box{background:#fff;padding:25px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.08);display:flex;align-items:center;gap:20px;margin-bottom:20px}
.stat-icon{width:60px;height:60px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px;color:#fff}
.stat-icon.blue{background:linear-gradient(135deg,#667eea,#764ba2)}
.stat-icon.green{background:linear-gradient(135deg,#11998e,#38ef7d)}
.stat-icon.yellow{background:linear-gradient(135deg,#f093fb,#f5576c)}
.stat-icon.red{background:linear-gradient(135deg,#fa709a,#fee140)}
.stat-info h4{margin:0;font-size:14px;color:#888;font-weight:400}
.stat-info h2{margin:5px 0 0;font-size:28px;font-weight:700;color:#333}
.filter-card{background:#fff;border-radius:16px;padding:20px;box-shadow:0 4px 20px rgba(0,0,0,.08);margin-bottom:24px}
.filter-row{display:flex;flex-wrap:wrap;gap:12px;align-items:end}
.filter-group{flex:1;min-width:200px}
.filter-group label{display:block;font-size:13px;font-weight:600;color:#64748b;margin-bottom:6px}
.filter-input,.filter-select{width:100%;padding:10px 14px;border:2px solid #e2e8f0;border-radius:10px;font-size:14px;transition:all .3s}
.filter-input:focus,.filter-select:focus{outline:0;border-color:#667eea;box-shadow:0 0 0 3px rgba(102,126,234,.1)}
.btn-filter{padding:10px 20px;border:none;border-radius:10px;font-weight:600;font-size:14px;cursor:pointer;transition:all .3s}
.btn-primary{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff}
.btn-primary:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(102,126,234,.4)}
.btn-secondary{background:#f1f5f9;color:#64748b}
.btn-secondary:hover{background:#e2e8f0}
.table-card{background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08)}
.table-header{padding:20px 24px;border-bottom:2px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center}
.table-title{font-size:20px;font-weight:700;color:#1e293b}
.modern-table{width:100%;border-collapse:separate;border-spacing:0}
.modern-table thead th{background:#f8fafc;padding:16px 20px;text-align:left;font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;border-bottom:2px solid #e2e8f0}
.modern-table tbody td{padding:16px 20px;border-bottom:1px solid #f1f5f9;font-size:14px;color:#334155}
.modern-table tbody tr:hover{background:#f8fafc}
.status-badge{display:inline-block;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600;text-transform:capitalize}
.status-success{background:#d1fae5;color:#065f46}
.status-warning{background:#fef3c7;color:#92400e}
.status-info{background:#dbeafe;color:#1e40af}
.status-danger{background:#fee2e2;color:#991b1b}
.action-btn{width:36px;height:36px;border-radius:8px;border:none;cursor:pointer;transition:all .3s;display:inline-flex;align-items:center;justify-content:center}
.action-btn.info{background:#dbeafe;color:#1e40af}
.action-btn.info:hover{background:#bfdbfe}
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
.filter-row{flex-direction:column}
.filter-group{min-width:100%}
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
        <div class="stat-icon green"><i class="fa fa-arrow-down"></i></div>
        <div class="stat-info">
          <h4>Total Deposits</h4>
          <h2>${{ number_format($totalDeposits, 2) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon yellow"><i class="fa fa-clock"></i></div>
        <div class="stat-info">
          <h4>Pending Deposits</h4>
          <h2>${{ number_format($pendingDeposits, 2) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon blue"><i class="fa fa-calendar"></i></div>
        <div class="stat-info">
          <h4>Today's Deposits</h4>
          <h2>${{ number_format($todayDeposits, 2) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon red"><i class="fa fa-database"></i></div>
        <div class="stat-info">
          <h4>Total Transactions</h4>
          <h2>{{ number_format($deposits->total()) }}</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="filter-card">
    <form action="{{ route('admin.deposits.index') }}" method="GET">
      <div class="filter-row">
        <div class="filter-group">
          <label>Status</label>
          <select name="status" class="filter-select">
            <option value="">All Statuses</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="waiting" {{ request('status') == 'waiting' ? 'selected' : '' }}>Waiting</option>
            <option value="confirming" {{ request('status') == 'confirming' ? 'selected' : '' }}>Confirming</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
          </select>
        </div>
        <div class="filter-group">
          <label>User</label>
          <select name="user_id" class="filter-select">
            <option value="">All Users</option>
            @foreach($users as $user)
              <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="filter-group">
          <label>From Date</label>
          <input type="date" name="from_date" class="filter-input" value="{{ request('from_date') }}">
        </div>
        <div class="filter-group">
          <label>To Date</label>
          <input type="date" name="to_date" class="filter-input" value="{{ request('to_date') }}">
        </div>
        <div style="display:flex;gap:8px">
          <button type="submit" class="btn-filter btn-primary">🔍 Filter</button>
          <a href="{{ route('admin.deposits.index') }}" class="btn-filter btn-secondary">↻ Reset</a>
        </div>
      </div>
    </form>
  </div>

  <div class="table-card">
    <div class="table-header">
      <h3 class="table-title">Deposits List</h3>
      <a href="{{ route('admin.deposits.create') }}" class="btn-filter btn-primary" style="text-decoration:none">➕ Create Deposit</a>
    </div>
    <div style="overflow-x:auto">
      <table class="modern-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>User</th>
            <th>Amount</th>
            <th>Currency</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($deposits as $deposit)
          <tr>
            <td data-label="ID">#{{ $deposit->id }}</td>
            <td data-label="User">
              @if($deposit->user)
                <a href="{{ route('admin.users.show', $deposit->user) }}" style="color:#667eea;font-weight:600;text-decoration:none">{{ $deposit->user->name }}</a>
              @else
                <span style="color:#94a3b8">Unknown</span>
              @endif
            </td>
            <td data-label="Amount" style="font-weight:700;color:#059669">${{ number_format($deposit->amount, 2) }}</td>
            <td data-label="Currency"><code style="background:#f1f5f9;padding:4px 8px;border-radius:6px;font-size:12px">{{ strtoupper($deposit->currency) }}</code></td>
            <td data-label="Status">
              @if($deposit->status == 'completed')
                <span class="status-badge status-success">✓ Completed</span>
              @elseif(in_array($deposit->status, ['pending', 'waiting', 'confirming']))
                <span class="status-badge status-warning">⏳ {{ ucfirst($deposit->status) }}</span>
              @else
                <span class="status-badge status-danger">✗ {{ ucfirst($deposit->status) }}</span>
              @endif
            </td>
            <td data-label="Date" style="color:#64748b">{{ $deposit->created_at->format('M d, Y H:i') }}</td>
            <td data-label="Action">
              <button onclick="showDepositDetails({{ $deposit->id }}, '{{ $deposit->user->username ?? 'Unknown' }}', '{{ number_format($deposit->amount, 2) }}', '{{ strtoupper($deposit->currency) }}', '{{ ucfirst($deposit->status) }}', '{{ $deposit->created_at->format('M d, Y H:i') }}', '{{ $deposit->payment_id ?? 'N/A' }}')" class="action-btn info" title="View Details" style="margin-right:4px">👁️</button>
              <a href="{{ route('admin.deposits.edit', $deposit) }}" class="action-btn" style="background:#fef3c7;color:#92400e" title="Edit">✏️</a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="empty-state">
              <div class="empty-icon">📭</div>
              <div style="font-size:18px;font-weight:600;margin-bottom:8px">No Deposits Found</div>
              <div style="font-size:14px">Try adjusting your filters</div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($deposits->hasPages())
    <div class="pagination-wrapper">
      <ul class="pagination">
        @if($deposits->onFirstPage())
          <li class="disabled"><span>←</span></li>
        @else
          <li><a href="{{ $deposits->previousPageUrl() }}">←</a></li>
        @endif
        @foreach($deposits->getUrlRange(1, $deposits->lastPage()) as $page => $url)
          @if($page == $deposits->currentPage())
            <li class="active"><span>{{ $page }}</span></li>
          @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach
        @if($deposits->hasMorePages())
          <li><a href="{{ $deposits->nextPageUrl() }}">→</a></li>
        @else
          <li class="disabled"><span>→</span></li>
        @endif
      </ul>
    </div>
    @endif
  </div>
</div>

<div id="depositModal" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center">
  <div style="background:var(--bg-card,#fff);border-radius:16px;padding:32px;max-width:500px;width:90%;box-shadow:0 20px 60px rgba(0,0,0,.3)">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px">
      <h3 style="font-size:24px;font-weight:700;color:var(--text-primary,#1e293b);margin:0">💰 Deposit Details</h3>
      <button onclick="closeModal()" style="background:none;border:none;font-size:24px;cursor:pointer;color:#64748b">×</button>
    </div>
    <div id="depositDetails" style="display:grid;gap:16px"></div>
  </div>
</div>

<script>
function showDepositDetails(id, user, amount, currency, status, date, paymentId) {
  const details = `
    <div style="padding:12px;background:#f8fafc;border-radius:8px">
      <div style="font-size:12px;color:#64748b;margin-bottom:4px">DEPOSIT ID</div>
      <div style="font-size:16px;font-weight:700;color:#1e293b">#${id}</div>
    </div>
    <div style="padding:12px;background:#f8fafc;border-radius:8px">
      <div style="font-size:12px;color:#64748b;margin-bottom:4px">USER</div>
      <div style="font-size:16px;font-weight:700;color:#1e293b">${user}</div>
    </div>
    <div style="padding:12px;background:#f8fafc;border-radius:8px">
      <div style="font-size:12px;color:#64748b;margin-bottom:4px">AMOUNT</div>
      <div style="font-size:20px;font-weight:700;color:#059669">$${amount}</div>
    </div>
    <div style="padding:12px;background:#f8fafc;border-radius:8px">
      <div style="font-size:12px;color:#64748b;margin-bottom:4px">CURRENCY</div>
      <div style="font-size:16px;font-weight:700;color:#1e293b">${currency}</div>
    </div>
    <div style="padding:12px;background:#f8fafc;border-radius:8px">
      <div style="font-size:12px;color:#64748b;margin-bottom:4px">STATUS</div>
      <div style="font-size:16px;font-weight:700;color:#1e293b">${status}</div>
    </div>
    <div style="padding:12px;background:#f8fafc;border-radius:8px">
      <div style="font-size:12px;color:#64748b;margin-bottom:4px">DATE</div>
      <div style="font-size:16px;font-weight:700;color:#1e293b">${date}</div>
    </div>
    <div style="padding:12px;background:#f8fafc;border-radius:8px">
      <div style="font-size:12px;color:#64748b;margin-bottom:4px">PAYMENT ID</div>
      <div style="font-size:14px;font-weight:600;color:#1e293b;word-break:break-all">${paymentId}</div>
    </div>
  `;
  document.getElementById('depositDetails').innerHTML = details;
  document.getElementById('depositModal').style.display = 'flex';
}

function closeModal() {
  document.getElementById('depositModal').style.display = 'none';
}

document.getElementById('depositModal').addEventListener('click', function(e) {
  if (e.target === this) closeModal();
});
</script>
@endsection
