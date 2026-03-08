@extends('admin.layouts.app')

@section('title', 'Weekly Salary')
@section('page-title', 'Weekly Salary Management')
@section('page-description', 'Manage weekly salary payments for eligible users')

@section('content')
<style>
.stat-box{background:#fff;padding:25px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.08);display:flex;align-items:center;gap:20px;margin-bottom:20px}
.stat-icon{width:60px;height:60px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px;color:#fff}
.stat-icon.green{background:linear-gradient(135deg,#11998e,#38ef7d)}
.stat-icon.blue{background:linear-gradient(135deg,#667eea,#764ba2)}
.stat-info h4{margin:0;font-size:14px;color:#888;font-weight:400}
.stat-info h2{margin:5px 0 0;font-size:28px;font-weight:700;color:#333}
.table-card{background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08)}
.table-header{padding:20px 24px;border-bottom:2px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center}
.table-title{font-size:20px;font-weight:700;color:#1e293b}
.modern-table{width:100%;border-collapse:separate;border-spacing:0}
.modern-table thead th{background:#f8fafc;padding:16px 20px;text-align:left;font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;border-bottom:2px solid #e2e8f0}
.modern-table tbody td{padding:16px 20px;border-bottom:1px solid #f1f5f9;font-size:14px;color:#334155}
.modern-table tbody tr:hover{background:#f8fafc}
.rank-badge{display:inline-flex;align-items:center;gap:6px;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600}
.rank-elite{background:#dbeafe;color:#1e40af}
.rank-master{background:#fef3c7;color:#92400e}
.rank-supreme{background:#f3e8ff;color:#6b21a8}
.btn-pay{padding:8px 16px;border:none;border-radius:8px;font-weight:600;font-size:13px;cursor:pointer;transition:all .3s;background:linear-gradient(135deg,#11998e,#38ef7d);color:#fff}
.btn-pay:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(17,153,142,.4)}
.btn-pay:disabled{background:#cbd5e1;cursor:not-allowed;transform:none}
.btn-pay-all{padding:12px 24px;border:none;border-radius:10px;font-weight:600;font-size:14px;cursor:pointer;transition:all .3s;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff}
.btn-pay-all:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(102,126,234,.4)}
.empty-state{text-align:center;padding:60px 20px;color:#94a3b8}
.empty-icon{font-size:64px;margin-bottom:16px;opacity:.5}
</style>

<div class="container-fluid" style="padding:20px">
  @if(session('success'))
  <div style="background:#d1fae5;border:2px solid #10b981;color:#065f46;padding:16px 20px;border-radius:12px;margin-bottom:20px;font-weight:600">
    ✓ {{ session('success') }}
  </div>
  @endif

  @if(session('error'))
  <div style="background:#fee2e2;border:2px solid #ef4444;color:#991b1b;padding:16px 20px;border-radius:12px;margin-bottom:20px;font-weight:600">
    ✗ {{ session('error') }}
  </div>
  @endif

  <div class="row">
    <div class="col-lg-6 col-md-6">
      <div class="stat-box">
        <div class="stat-icon green"><i class="fa fa-users"></i></div>
        <div class="stat-info">
          <h4>Eligible Users</h4>
          <h2>{{ count($eligibleUsers) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6">
      <div class="stat-box">
        <div class="stat-icon blue"><i class="fa fa-dollar"></i></div>
        <div class="stat-info">
          <h4>Unpaid This Week</h4>
          <h2>{{ count(array_filter($eligibleUsers, fn($u) => !$u['paid_this_week'])) }}</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="table-card">
    <div class="table-header">
      <h3 class="table-title">Eligible Users for Weekly Salary</h3>
      <div style="display:flex;gap:8px">
        <a href="{{ route('admin.weekly-salary.history') }}" class="btn-pay-all" style="background:linear-gradient(135deg,#f59e0b,#d97706);text-decoration:none">📋 Payment History</a>
        @php
          $unpaidUsers = array_filter($eligibleUsers, fn($u) => !$u['paid_this_week']);
          $unpaidCount = count($unpaidUsers);
          $unpaidTotal = array_sum(array_column($unpaidUsers, 'weekly_salary'));
        @endphp
        @if($unpaidCount > 0)
        <form action="{{ route('admin.weekly-salary.pay-all') }}" method="POST" onsubmit="return confirm('Pay weekly salary to {{ $unpaidCount }} unpaid users?')" style="display:inline">
          @csrf
          <button type="submit" class="btn-pay-all">💰 Pay Unpaid ({{ $unpaidCount }}) - ${{ number_format($unpaidTotal, 2) }}</button>
        </form>
        @endif
      </div>
    </div>
    <div style="overflow-x:auto">
      <table class="modern-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Username</th>
            <th>Account ID</th>
            <th>Rank</th>
            <th>Active Members</th>
            <th>Current Balance</th>
            <th>Weekly Salary</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($eligibleUsers as $index => $item)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>
              <a href="{{ route('admin.users.show', $item['user']) }}" style="color:#667eea;font-weight:600;text-decoration:none">
                {{ $item['user']->username }}
              </a>
            </td>
            <td>
              <code style="background:#f1f5f9;padding:4px 8px;border-radius:6px;font-size:12px;color:#475569">
                {{ $item['user']->account_id }}
              </code>
            </td>
            <td>
              @if($item['rank'] == 'Elite Leader')
                <span class="rank-badge rank-elite">💎 {{ $item['rank'] }}</span>
              @elseif($item['rank'] == 'Master Leader')
                <span class="rank-badge rank-master">⭐ {{ $item['rank'] }}</span>
              @elseif($item['rank'] == 'Supreme Leader')
                <span class="rank-badge rank-supreme">👑 {{ $item['rank'] }}</span>
              @endif
            </td>
            <td style="font-weight:600;color:#059669">{{ $item['active_members'] }}</td>
            <td style="font-weight:700;color:#1e293b;font-size:15px">${{ number_format($item['user']->balance, 2) }}</td>
            <td style="font-weight:700;color:#059669;font-size:16px">${{ number_format($item['weekly_salary'], 2) }}</td>
            <td>
              @if($item['paid_this_week'])
                <span style="display:inline-block;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600;background:#d1fae5;color:#065f46">✓ Paid</span>
              @else
                <span style="display:inline-block;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600;background:#fef3c7;color:#92400e">⏳ Pending</span>
              @endif
            </td>
            <td>
              @if($item['paid_this_week'])
                <button class="btn-pay" disabled style="opacity:0.5;cursor:not-allowed">✓ Paid</button>
              @else
                <form action="{{ route('admin.weekly-salary.pay', $item['user']) }}" method="POST" style="display:inline" onsubmit="return confirm('Pay ${{ number_format($item['weekly_salary'], 2) }} to {{ $item['user']->username }}?')">
                  @csrf
                  <button type="submit" class="btn-pay">💵 Pay Now</button>
                </form>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="9" class="empty-state">
              <div class="empty-icon">📭</div>
              <div style="font-size:18px;font-weight:600;margin-bottom:8px">No Eligible Users</div>
              <div style="font-size:14px">Users need at least 10 active referrals to qualify for weekly salary</div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div style="background:#fff;border-radius:16px;padding:24px;margin-top:20px;box-shadow:0 4px 20px rgba(0,0,0,.08)">
    <h3 style="font-size:18px;font-weight:700;color:#1e293b;margin:0 0 16px">💡 Weekly Salary Structure</h3>
    <div style="display:grid;gap:12px">
      <div style="display:flex;justify-content:space-between;padding:12px;background:#f8fafc;border-radius:8px">
        <span style="font-weight:600;color:#64748b">💎 Elite Leader (10 active)</span>
        <span style="font-weight:700;color:#059669">$10/week</span>
      </div>
      <div style="display:flex;justify-content:space-between;padding:12px;background:#f8fafc;border-radius:8px">
        <span style="font-weight:600;color:#64748b">⭐ Master Leader (30 active)</span>
        <span style="font-weight:700;color:#059669">$30/week</span>
      </div>
      <div style="display:flex;justify-content:space-between;padding:12px;background:#f8fafc;border-radius:8px">
        <span style="font-weight:600;color:#64748b">👑 Supreme Leader (100 active)</span>
        <span style="font-weight:700;color:#059669">$100/week</span>
      </div>
    </div>
  </div>
</div>
@endsection
