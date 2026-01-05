@extends('admin.layout')

@section('content')

<h2 style="margin-bottom:20px;">🏧 Withdrawals</h2>

{{-- FILTER BAR --}}
<div class="card" style="margin-bottom:20px;">
    <form style="display:flex;gap:12px;flex-wrap:wrap;">
        <input type="text" placeholder="Search user email..."
            style="flex:1;min-width:220px;padding:10px;border-radius:8px;
               background:#020617;border:1px solid rgba(255,255,255,.06);color:#e5e7eb;">

        <select style="padding:10px;border-radius:8px;background:#020617;
                border:1px solid rgba(255,255,255,.06);color:#e5e7eb;">
            <option>Status: All</option>
            <option>Pending</option>
            <option>Approved</option>
            <option>Completed</option>
            <option>Rejected</option>
        </select>

        <button type="submit"
            style="padding:10px 16px;border-radius:8px;
                background:#38bdf8;color:#020617;border:none;font-weight:600;">
            Filter
        </button>
    </form>
</div>

{{-- WITHDRAWALS TABLE --}}
<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Amount</th>
                <th>Wallet Address</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($withdrawals as $withdrawal)
            <tr>
                <td>#{{ $withdrawal->id }}</td>

                <td>
                    <div style="font-weight:600;">{{ $withdrawal->user->email }}</div>
                    <div style="font-size:12px;color:#9ca3af;">
                        UID: {{ $withdrawal->user->id }}
                    </div>
                </td>

                <td>
                    <strong>
                        {{ number_format($withdrawal->amount, 2) }}
                        {{ strtoupper($withdrawal->currency ?? 'USDT') }}
                    </strong>
                </td>

                <td style="max-width:240px;word-break:break-all;">
                    <span style="font-size:13px;color:#9ca3af;">
                        {{ $withdrawal->address }}
                    </span>
                </td>

                <td>
                    <span class="badge {{ $withdrawal->status }}">
                        {{ ucfirst($withdrawal->status) }}
                    </span>
                </td>

                <td>
                    {{ $withdrawal->created_at->format('Y-m-d H:i') }}
                </td>

                <td>
                    @if($withdrawal->status === 'pending')
                    <div style="display:flex;gap:8px;flex-wrap:wrap;">
                        {{-- APPROVE --}}
                        <form method="POST" action="/admin/withdrawals/{{ $withdrawal->id }}/approve">
                            @csrf
                            <button
                                style="padding:6px 12px;border-radius:6px;
                                    background:rgba(34,197,94,.15);
                                    color:#22c55e;border:1px solid rgba(34,197,94,.3);">
                                Approve
                            </button>
                        </form>

                        {{-- REJECT --}}
                        <form method="POST" action="/admin/withdrawals/{{ $withdrawal->id }}/reject">
                            @csrf
                            <button
                                style="padding:6px 12px;border-radius:6px;
                                    background:rgba(239,68,68,.15);
                                    color:#ef4444;border:1px solid rgba(239,68,68,.3);">
                                Reject
                            </button>
                        </form>
                    </div>

                    @elseif($withdrawal->status === 'approved')
                    <form method="POST" action="#">
                        @csrf
                        <button
                            style="padding:6px 12px;border-radius:6px;
                                background:rgba(56,189,248,.15);
                                color:#38bdf8;border:1px solid rgba(56,189,248,.3);">
                            Mark as Sent
                        </button>
                    </form>

                    @else
                    <span style="font-size:12px;color:#9ca3af;">No action</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;padding:30px;color:#9ca3af;">
                    No withdrawals found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- PAGINATION --}}
<div style="margin-top:20px;">
    {{ $withdrawals->links() }}
</div>

@endsection