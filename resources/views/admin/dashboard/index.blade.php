@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Control Panel')

@section('content')
<style>
.dash-stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:20px;margin-bottom:30px}
.stat-box{background:#fff;padding:25px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.08);display:flex;align-items:center;gap:20px}
.stat-icon{width:60px;height:60px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px;color:#fff}
.stat-icon.blue{background:linear-gradient(135deg,#667eea,#764ba2)}
.stat-icon.green{background:linear-gradient(135deg,#11998e,#38ef7d)}
.stat-icon.yellow{background:linear-gradient(135deg,#f093fb,#f5576c)}
.stat-icon.red{background:linear-gradient(135deg,#fa709a,#fee140)}
.stat-icon.purple{background:linear-gradient(135deg,#667eea,#764ba2)}
.stat-info h4{margin:0;font-size:14px;color:#888;font-weight:400}
.stat-info h2{margin:5px 0 0;font-size:28px;font-weight:700;color:#333}
.dash-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(400px,1fr));gap:20px}
.dash-card{background:#fff;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.08);overflow:hidden}
.dash-card-header{padding:20px;border-bottom:1px solid #eee;display:flex;justify-content:space-between;align-items:center}
.dash-card-header h3{margin:0;font-size:18px;font-weight:600}
.dash-card-header a{color:#667eea;text-decoration:none;font-size:14px}
.dash-table{width:100%;border-collapse:collapse}
.dash-table th,.dash-table td{padding:15px 20px;text-align:left;border-bottom:1px solid #f5f5f5}
.dash-table th{background:#f9f9f9;font-weight:600;font-size:13px;color:#666}
.dash-table td{font-size:14px}
.badge{padding:5px 12px;border-radius:20px;font-size:12px;font-weight:500}
.badge.success{background:#d1fae5;color:#065f46}
.badge.warning{background:#fef3c7;color:#92400e}
.badge.danger{background:#fee2e2;color:#991b1b}
.badge.info{background:#dbeafe;color:#1e40af}
@media(max-width:768px){.dash-stats,.dash-grid{grid-template-columns:1fr}}
</style>

<div class="dash-stats">
  <div class="stat-box">
    <div class="stat-icon blue"><i class="fa fa-users"></i></div>
    <div class="stat-info">
      <h4>Total Users</h4>
      <h2>{{ number_format($totalUsers) }}</h2>
    </div>
  </div>
  <div class="stat-box">
    <div class="stat-icon green"><i class="fa fa-database"></i></div>
    <div class="stat-info">
      <h4>Total Vaults</h4>
      <h2>{{ number_format($totalPools) }}</h2>
    </div>
  </div>
  <div class="stat-box">
    <div class="stat-icon yellow"><i class="fa fa-arrow-down"></i></div>
    <div class="stat-info">
      <h4>Total Deposits</h4>
      <h2>${{ number_format($totalDeposits, 2) }}</h2>
    </div>
  </div>
  <div class="stat-box">
    <div class="stat-icon purple"><i class="fa fa-clock"></i></div>
    <div class="stat-info">
      <h4>Pending Deposits</h4>
      <h2>${{ number_format($totalPendingDeposits, 2) }}</h2>
    </div>
  </div>
  <div class="stat-box">
    <div class="stat-icon red"><i class="fa fa-arrow-up"></i></div>
    <div class="stat-info">
      <h4>Total Withdrawals</h4>
      <h2>${{ number_format($totalWithdrawals, 2) }}</h2>
    </div>
  </div>
  <div class="stat-box">
    <div class="stat-icon purple"><i class="fa fa-hourglass-half"></i></div>
    <div class="stat-info">
      <h4>Pending Withdrawals</h4>
      <h2>${{ number_format($totalPendingWithdrawals, 2) }}</h2>
    </div>
  </div>
</div>

<div class="dash-grid">
  <div class="dash-card">
    <div class="dash-card-header">
      <h3>Recent Users</h3>
      <a href="{{ route('admin.users.index') }}">View All →</a>
    </div>
    <table class="dash-table">
      <thead>
        <tr>
          <th>Username</th>
          <th>Email</th>
          <th>Joined</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recentUsers as $user)
        <tr>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->created_at->diffForHumans() }}</td>
        </tr>
        @empty
        <tr><td colspan="3" style="text-align:center;color:#999">No users found</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="dash-card">
    <div class="dash-card-header">
      <h3>Recent Deposits</h3>
      <a href="{{ route('admin.deposits.index') }}">View All →</a>
    </div>
    <table class="dash-table">
      <thead>
        <tr>
          <th>User</th>
          <th>Amount</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recentDeposits as $deposit)
        <tr>
          <td>{{ $deposit->user->username ?? 'N/A' }}</td>
          <td>${{ number_format($deposit->amount, 2) }}</td>
          <td>
            @if($deposit->status == 'completed')
              <span class="badge success">Completed</span>
            @elseif(in_array($deposit->status, ['pending', 'waiting', 'confirming']))
              <span class="badge warning">{{ ucfirst($deposit->status) }}</span>
            @else
              <span class="badge danger">{{ ucfirst($deposit->status) }}</span>
            @endif
          </td>
        </tr>
        @empty
        <tr><td colspan="3" style="text-align:center;color:#999">No deposits found</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="dash-card">
    <div class="dash-card-header">
      <h3>Recent Vaults</h3>
      <a href="{{ route('admin.pools.index') }}">View All →</a>
    </div>
    <table class="dash-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Type</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recentPools as $pool)
        <tr>
          <td>{{ $pool->name }}</td>
          <td><span class="badge info">{{ strtoupper($pool->type) }}</span></td>
          <td>${{ number_format($pool->price, 2) }}</td>
        </tr>
        @empty
        <tr><td colspan="3" style="text-align:center;color:#999">No vaults found</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="dash-card">
    <div class="dash-card-header">
      <h3>Recent Withdrawals</h3>
      <a href="{{ route('admin.withdrawals.index') }}">View All →</a>
    </div>
    <table class="dash-table">
      <thead>
        <tr>
          <th>User</th>
          <th>Amount</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recentWithdrawals as $withdrawal)
        <tr>
          <td>{{ $withdrawal->user->username ?? 'N/A' }}</td>
          <td>${{ number_format($withdrawal->amount, 2) }}</td>
          <td>
            @if($withdrawal->status == 'completed')
              <span class="badge success">Completed</span>
            @elseif($withdrawal->status == 'approved')
              <span class="badge info">Approved</span>
            @elseif($withdrawal->status == 'pending')
              <span class="badge warning">Pending</span>
            @else
              <span class="badge danger">Rejected</span>
            @endif
          </td>
        </tr>
        @empty
        <tr><td colspan="3" style="text-align:center;color:#999">No withdrawals found</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection