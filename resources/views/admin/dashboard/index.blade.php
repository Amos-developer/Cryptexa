@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #38bdf8, #0ea5e9);">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-label">Total Users</div>
        <div class="stat-value">{{ number_format($totalUsers) }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #22c55e, #16a34a);">
            <i class="fas fa-arrow-down"></i>
        </div>
        <div class="stat-label">Total Deposits</div>
        <div class="stat-value">${{ number_format($totalDeposits, 2) }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #fbbf24, #f59e0b);">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-label">Pending Deposits</div>
        <div class="stat-value">{{ number_format($pendingDeposits) }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
            <i class="fas fa-arrow-up"></i>
        </div>
        <div class="stat-label">Pending Withdrawals</div>
        <div class="stat-value">{{ number_format($pendingWithdrawals) }}</div>
    </div>
</div>

<!-- Recent Users -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Recent Users</h2>
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm">View All</a>
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Balance</th>
                    <th>Joined</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentUsers as $user)
                <tr>
                    <td>#{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>${{ number_format($user->balance ?? 0, 2) }}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #94a3b8;">No users found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Recent Deposits -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Recent Deposits</h2>
        <a href="{{ route('admin.deposits.index') }}" class="btn btn-primary btn-sm">View All</a>
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentDeposits as $deposit)
                <tr>
                    <td>#{{ $deposit->id }}</td>
                    <td>{{ $deposit->user->name ?? 'N/A' }}</td>
                    <td>${{ number_format($deposit->amount, 2) }}</td>
                    <td>{{ strtoupper($deposit->currency) }}</td>
                    <td>
                        @if($deposit->status == 'completed')
                            <span class="badge badge-success">Completed</span>
                        @elseif($deposit->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($deposit->status == 'confirming')
                            <span class="badge badge-info">Confirming</span>
                        @else
                            <span class="badge badge-danger">{{ ucfirst($deposit->status) }}</span>
                        @endif
                    </td>
                    <td>{{ $deposit->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #94a3b8;">No deposits found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Recent Withdrawals -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Recent Withdrawals</h2>
        <a href="{{ route('admin.withdrawals.index') }}" class="btn btn-primary btn-sm">View All</a>
    </div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Network</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentWithdrawals as $withdrawal)
                <tr>
                    <td>#{{ $withdrawal->id }}</td>
                    <td>{{ $withdrawal->user->name ?? 'N/A' }}</td>
                    <td>${{ number_format($withdrawal->amount, 2) }}</td>
                    <td>{{ strtoupper($withdrawal->network) }}</td>
                    <td>
                        @if($withdrawal->status == 'completed')
                            <span class="badge badge-success">Completed</span>
                        @elseif($withdrawal->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($withdrawal->status == 'approved')
                            <span class="badge badge-info">Approved</span>
                        @else
                            <span class="badge badge-danger">{{ ucfirst($withdrawal->status) }}</span>
                        @endif
                    </td>
                    <td>{{ $withdrawal->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #94a3b8;">No withdrawals found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
