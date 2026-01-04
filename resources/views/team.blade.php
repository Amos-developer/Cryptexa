@extends('layouts.app')

@section('title', 'My Team')
@section('hide-header', true)

@section('content')
<div class="tf-container mt-20">

    <!-- HEADER CARD -->
    <div style="
        background:linear-gradient(135deg,#020617,#0f172a);
        border-radius:20px;
        padding:20px;
        box-shadow:0 20px 40px rgba(0,0,0,.6);
    ">

        <h4 class="text-white mb-12">Referral Dashboard</h4>

        <!-- STATS -->
        <div class="d-grid" style="grid-template-columns:repeat(2,1fr);gap:12px;">

            <div class="p-12 rounded"
                style="background:rgba(56,189,248,.08);border:1px solid rgba(56,189,248,.25);">
                <span class="text-secondary text-small">Total Members</span>
                <h5 class="text-white mt-4">{{ $totalMembers }}</h5>
            </div>

            <div class="p-12 rounded"
                style="background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.25);">
                <span class="text-secondary text-small">My Earnings</span>
                <h5 class="text-success mt-4">${{ number_format($earnings,2) }}</h5>
            </div>

            <div class="p-12 rounded"
                style="background:rgba(251,191,36,.08);border:1px solid rgba(251,191,36,.25);">
                <span class="text-secondary text-small">Active</span>
                <h5 class="text-white mt-4">{{ $activeMembers }}</h5>
            </div>

            <div class="p-12 rounded"
                style="background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.25);">
                <span class="text-secondary text-small">Inactive</span>
                <h5 class="text-white mt-4">{{ $inactiveMembers }}</h5>
            </div>

        </div>

    </div>
    <!-- LEVEL ANALYTICS -->
    <div class="mt-24">

        @foreach([
        'Level 1' => $level1,
        'Level 2' => $level2,
        'Level 3' => $level3
        ] as $level => $users)

        <div class="mb-16"
            style="
            background:linear-gradient(135deg,#020617,#0f172a);
            border-radius:18px;
            padding:16px;
            border:1px solid rgba(255,255,255,.06);
            box-shadow:0 10px 30px rgba(0,0,0,.6);
        ">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-12">
                <span class="fw-semibold text-white">{{ $level }}</span>
                <span class="text-secondary text-small">
                    {{ $users->count() }} members
                </span>
            </div>

            @if($users->isEmpty())
            <div class="text-secondary text-small">
                No members yet
            </div>
            @else
            <ul class="d-flex flex-column gap-10">

                @foreach($users as $u)
                <li class="d-flex justify-content-between align-items-center"
                    style="
                        padding:10px 12px;
                        border-radius:12px;
                        background:#020617;
                        border:1px solid rgba(255,255,255,.05);
                    ">

                    <!-- LEFT -->
                    <div class="d-flex flex-column">
                        <span class="text-white text-small fw-medium">
                            Ref ID: {{ $u->referral_code }}
                        </span>
                        <span class="text-secondary text-xs">
                            Joined {{ $u->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <!-- RIGHT -->
                    <div class="text-end">
                        @if($u->balance > 3)
                        <span class="text-success text-small fw-semibold">
                            Active
                        </span>
                        @else
                        <span class="text-warning text-small fw-semibold">
                            Inactive
                        </span>
                        @endif
                        <div class="text-secondary text-xs">
                            Balance: ${{ number_format($u->balance, 2) }}
                        </div>
                    </div>

                </li>
                @endforeach

            </ul>
            @endif

        </div>

        @endforeach

    </div>


</div>
@endsection