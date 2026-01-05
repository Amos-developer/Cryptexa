@extends('admin.layout')

@section('content')

<h2 style="margin-bottom:20px;">💰 Deposits</h2>

{{-- FILTER BAR (UI READY) --}}
<div class="card" style="margin-bottom:20px;">
    <form style="display:flex;gap:12px;flex-wrap:wrap;">
        <input type="text" placeholder="Search user email..."
            style="flex:1;min-width:220px;padding:10px;border-radius:8px;
               background:#020617;border:1px solid rgba(255,255,255,.06);color:#e5e7eb;">

        <select style="padding:10px;border-radius:8px;background:#020617;
                border:1px solid rgba(255,255,255,.06);color:#e5e7eb;">
            <option>Status: All</option>
            <option>Pending</option>
            <option>Completed</option>
            <option>Failed</option>
        </select>

        <button type="submit"
            style="padding:10px 16px;border-radius:8px;
                background:#38bdf8;color:#020617;border:none;font-weight:600;">
            Filter
        </button>
    </form>
</div>

{{-- DEPOSITS TABLE --}}
<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($deposits as $deposit)
            <tr>
                <td>#{{ $deposit->id }}</td>

                <td>
                    <div style="font-weight:600;">{{ $deposit->user->email }}</div>
                    <div style="font-size:12px;color:#9ca3af;">
                        UID: {{ $deposit->user->id }}
                    </div>
                </td>

                <td>
                    <strong>${{ number_format($deposit->amount, 2) }}</strong>
                </td>

                <td>
                    <span class="badge {{ $deposit->status }}">
                        {{ ucfirst($deposit->status) }}
                    </span>
                </td>

                <td>
                    {{ $deposit->created_at->format('Y-m-d H:i') }}
                </td>

                <td>
                    @if($deposit->status === 'pending')
                    <div style="display:flex;gap:8px;">
                        <form method="POST" action="#">
                            @csrf
                            <button
                                style="padding:6px 12px;border-radius:6px;
                                    background:rgba(34,197,94,.15);
                                    color:#22c55e;border:1px solid rgba(34,197,94,.3);">
                                Approve
                            </button>
                        </form>

                        <form method="POST" action="#">
                            @csrf
                            <button
                                style="padding:6px 12px;border-radius:6px;
                                    background:rgba(239,68,68,.15);
                                    color:#ef4444;border:1px solid rgba(239,68,68,.3);">
                                Reject
                            </button>
                        </form>
                    </div>
                    @else
                    <span style="font-size:12px;color:#9ca3af;">No action</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:30px;color:#9ca3af;">
                    No deposits found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- PAGINATION --}}
<div style="margin-top:20px;">
    {{ $deposits->links() }}
</div>

@endsection