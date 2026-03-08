@extends('admin.layouts.app')

@section('title', 'Weekly Salary History')
@section('page-title', 'Weekly Salary Payment History')
@section('page-description', 'View all weekly salary payment records')

@section('content')
<style>
.table-card{background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08)}
.table-header{padding:20px 24px;border-bottom:2px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center}
.table-title{font-size:20px;font-weight:700;color:#1e293b}
.modern-table{width:100%;border-collapse:separate;border-spacing:0}
.modern-table thead th{background:#f8fafc;padding:16px 20px;text-align:left;font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;border-bottom:2px solid #e2e8f0}
.modern-table tbody td{padding:16px 20px;border-bottom:1px solid #f1f5f9;font-size:14px;color:#334155}
.modern-table tbody tr:hover{background:#f8fafc}
.action-btn{width:36px;height:36px;border-radius:8px;border:none;cursor:pointer;transition:all .3s;display:inline-flex;align-items:center;justify-content:center;margin-right:4px}
.action-btn.info{background:#dbeafe;color:#1e40af}
.action-btn.danger{background:#fee2e2;color:#991b1b}
.btn-primary{padding:10px 20px;border:none;border-radius:10px;font-weight:600;font-size:14px;cursor:pointer;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;text-decoration:none;display:inline-block}
.btn-primary:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(102,126,234,.4)}
.pagination-wrapper{padding:20px 24px;display:flex;justify-content:center}
.pagination{display:flex;gap:8px;list-style:none;padding:0;margin:0}
.pagination li a,.pagination li span{display:block;padding:8px 14px;border-radius:8px;font-size:14px;font-weight:600;transition:all .3s}
.pagination li.active span{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff}
.pagination li:not(.active):not(.disabled) a{background:#f1f5f9;color:#64748b}
.pagination li:not(.active):not(.disabled) a:hover{background:#e2e8f0}
.pagination li.disabled span{background:#f8fafc;color:#cbd5e1}
</style>

<div class="container-fluid" style="padding:20px">
  @if(session('success'))
  <div style="background:#d1fae5;border:2px solid #10b981;color:#065f46;padding:16px 20px;border-radius:12px;margin-bottom:20px;font-weight:600">
    ✓ {{ session('success') }}
  </div>
  @endif

  <div class="table-card">
    <div class="table-header">
      <h3 class="table-title">Payment History</h3>
      <div style="display:flex;gap:8px">
        <a href="{{ route('admin.weekly-salary.create') }}" class="btn-primary">➕ Create Payment</a>
        <a href="{{ route('admin.weekly-salary.index') }}" class="btn-primary" style="background:linear-gradient(135deg,#11998e,#38ef7d)">👥 Eligible Users</a>
      </div>
    </div>
    <div style="overflow-x:auto">
      <table class="modern-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Date</th>
            <th>Username</th>
            <th>Rank</th>
            <th>Active Members</th>
            <th>Amount</th>
            <th>Paid By</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($payments as $payment)
          <tr>
            <td>{{ $payments->firstItem() + $loop->index }}</td>
            <td style="color:#64748b">{{ $payment->created_at->format('M d, Y H:i') }}</td>
            <td>
              <a href="{{ route('admin.users.show', $payment->user) }}" style="color:#667eea;font-weight:600;text-decoration:none">
                {{ $payment->user->username }}
              </a>
            </td>
            <td style="font-weight:600;color:#475569">{{ $payment->rank }}</td>
            <td style="font-weight:600;color:#059669">{{ $payment->active_members }}</td>
            <td style="font-weight:700;color:#059669;font-size:16px">${{ number_format($payment->amount, 2) }}</td>
            <td style="color:#64748b">{{ $payment->admin->username }}</td>
            <td>
              <a href="{{ route('admin.weekly-salary.show', $payment) }}" class="action-btn info" title="View">👁️</a>
              <form action="{{ route('admin.weekly-salary.destroy', $payment) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this payment record?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-btn danger" title="Delete">🗑️</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8" style="text-align:center;padding:60px 20px;color:#94a3b8">
              <div style="font-size:64px;margin-bottom:16px;opacity:.5">📭</div>
              <div style="font-size:18px;font-weight:600;margin-bottom:8px">No Payment Records</div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($payments->hasPages())
    <div class="pagination-wrapper">
      {{ $payments->links() }}
    </div>
    @endif
  </div>
</div>
@endsection
