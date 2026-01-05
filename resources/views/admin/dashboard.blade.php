@extends('admin.layout')

@section('content')

{{-- STATS --}}
<div class="stats">
    <div class="card">
        <h3>Total Users</h3>
        <p>{{ $totalUsers }}</p>
    </div>

    <div class="card">
        <h3>Total Deposits</h3>
        <p>${{ number_format($totalDeposits, 2) }}</p>
    </div>

    <div class="card">
        <h3>Pending Deposits</h3>
        <p>{{ $pendingDeposits }}</p>
    </div>

    <div class="card">
        <h3>System Status</h3>
        <p>OK</p>
    </div>
</div>

{{-- RECENT DEPOSITS --}}
<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recentDeposits as $deposit)
            <tr>
                <td>{{ $deposit->user->email }}</td>
                <td>${{ $deposit->amount }}</td>
                <td>
                    <span class="badge {{ $deposit->status }}">
                        {{ ucfirst($deposit->status) }}
                    </span>
                </td>
                <td>{{ $deposit->created_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection