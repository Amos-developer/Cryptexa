@extends('layouts.app')

@section('title', 'Referral Dashboard | Cryptexa')
@section('hide-header', true)

@section('content')
<!-- HEADER BAR -->
<div class="header fixed-top d-flex justify-content-between align-items-center px-16"
    style="
        background: linear-gradient(135deg, #020617, #0f172a);
        border-bottom: 1px solid rgba(56,189,248,0.2);
        backdrop-filter: blur(10px);
        z-index: 100;
        padding: 12px 16px;
    ">
    <a href="{{ url()->previous() }}"
        style="
            width: 36px;
            height: 36px;
            background: rgba(56,189,248,0.1);
            border: 1px solid rgba(56,189,248,0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        "
        onmouseover="this.style.background='rgba(56,189,248,0.15)'; this.style.borderColor='rgba(56,189,248,0.4)';"
        onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.2)';">
        <i class="icon-left-btn" style="color: #38bdf8; font-size: 18px;"></i>
    </a>
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">My Team</h6>
    <span style="width: 36px;"></span>
</div>

<div style="min-height:100vh;background:linear-gradient(135deg,#020617 0%,#0f172a 100%);padding-top:80px;padding-bottom:80px;">

    <div class="tf-container">

        <!-- PAGE TITLE -->
        <div style="margin-bottom:28px;">
            <h1 style="color:#fff;font-size:26px;font-weight:800;margin-bottom:6px;">
                Referral Program
            </h1>
            <p style="color:#94a3b8;font-size:13px;margin:0;">
                Earn passive income by inviting others
            </p>
        </div>

        <!-- REFERRAL LINK CARD -->
        <div style="
        background:rgba(255,255,255,0.03);
        border:1px solid rgba(56,189,248,0.2);
        border-radius:18px;
        padding:20px;
        margin-bottom:25px;
        backdrop-filter:blur(12px);
    ">

            <p style="color:#38bdf8;font-size:12px;font-weight:600;margin-bottom:6px;">
                Your Referral Code
            </p>

            <div style="display:flex;gap:10px;margin-bottom:14px;">
                <input id="refCode"
                    value="{{ auth()->user()->referral_code }}"
                    readonly
                    style="flex:1;padding:12px;border-radius:12px;border:none;background:#0f172a;color:#fff;font-weight:600;">
                <button onclick="copyText('refCode')" style="padding:12px 14px;border-radius:12px;border:none;background:#38bdf8;color:#000;font-weight:700;cursor:pointer;">
                    Copy
                </button>
            </div>

            <p style="color:#38bdf8;font-size:12px;font-weight:600;margin-bottom:6px;">
                Referral Link
            </p>

            <div style="display:flex;gap:10px;margin-bottom:16px;">
                <input id="refLink"
                    value="{{ url('/register?ref='.auth()->user()->referral_code) }}"
                    readonly
                    style="flex:1;padding:12px;border-radius:12px;border:none;background:#0f172a;color:#fff;font-size:12px;">
                <button onclick="copyText('refLink')" style="padding:12px 14px;border-radius:12px;border:none;background:#22c55e;color:#000;font-weight:700;cursor:pointer;">
                    Copy
                </button>
            </div>

            <!-- SHARE BUTTONS -->
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <a target="_blank"
                    href="https://wa.me/?text={{ urlencode('Join Cryptexa using my link: '.url('/register?ref='.auth()->user()->referral_code)) }}"
                    style="flex:1;padding:10px;border-radius:12px;text-align:center;background:#25D366;color:#000;font-weight:700;text-decoration:none;">
                    WhatsApp
                </a>

                <a target="_blank"
                    href="https://t.me/share/url?url={{ urlencode(url('/register?ref='.auth()->user()->referral_code)) }}"
                    style="flex:1;padding:10px;border-radius:12px;text-align:center;background:#0088cc;color:#fff;font-weight:700;text-decoration:none;">
                    Telegram
                </a>

                <a target="_blank"
                    href="https://twitter.com/intent/tweet?text={{ urlencode('Join Cryptexa and earn passive income! '.url('/register?ref='.auth()->user()->referral_code)) }}"
                    style="flex:1;padding:10px;border-radius:12px;text-align:center;background:#1DA1F2;color:#fff;font-weight:700;text-decoration:none;">
                    Twitter
                </a>
            </div>

        </div>

        <!-- COMMISSION STRUCTURE -->
        <div style="
        background:rgba(168,85,247,0.05);
        border:1px solid rgba(168,85,247,0.2);
        border-radius:18px;
        padding:18px;
        margin-bottom:25px;
    ">
            <h4 style="color:#a855f7;font-size:14px;font-weight:700;margin-bottom:12px;">
                Commission Structure
            </h4>

            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;font-size:13px;color:#e5e7eb;">
                <div>Level 1: <b>16%</b></div>
                <div>Level 2: <b>8%</b></div>
                <div>Level 3: <b>4%</b></div>
                <div>Level 4: <b>2%</b></div>
                <div>Level 5: <b>1%</b></div>
                <div>Level 6: <b>0.5%</b></div>
            </div>
        </div>

        <!-- STATS -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:25px;">

            <div class="statCard">
                <p>Total Members</p>
                <h3>{{ $totalMembers }}</h3>
            </div>

            <div class="statCard green">
                <p>Total Earnings</p>
                <h3>${{ number_format($earnings,2) }}</h3>
            </div>

        </div>

        <!-- LEVEL MEMBERS -->
        @foreach(['Level 1'=>$level1,'Level 2'=>$level2,'Level 3'=>$level3] as $levelName=>$users)

        <div style="margin-bottom:18px;">
            <div style="
            display:flex;
            justify-content:space-between;
            padding:14px;
            border-radius:14px;
            background:rgba(255,255,255,0.03);
            border:1px solid rgba(255,255,255,0.08);
            margin-bottom:10px;
        ">
                <strong style="color:#38bdf8;">{{ $levelName }}</strong>
                <span style="color:#94a3b8;font-size:12px;">
                    {{ $users->count() }} Members
                </span>
            </div>

            @if($users->isEmpty())
            <div style="padding:16px;border-radius:12px;background:rgba(255,255,255,0.02);color:#94a3b8;font-size:12px;">
                No members yet.
            </div>
            @else
            @foreach($users as $u)
            <div style="
                    display:flex;
                    justify-content:space-between;
                    padding:12px;
                    border-radius:12px;
                    background:rgba(255,255,255,0.02);
                    border:1px solid rgba(255,255,255,0.08);
                    margin-bottom:8px;
                ">
                <div>
                    <div style="color:#fff;font-size:13px;font-weight:600;">
                        {{ $u->referral_code }}
                    </div>
                    <div style="color:#94a3b8;font-size:11px;">
                        Joined {{ $u->created_at->diffForHumans() }}
                    </div>
                </div>
                <div style="text-align:right;">
                    <div style="color:#22c55e;font-weight:600;font-size:12px;">
                        ${{ number_format($u->balance,2) }}
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>

        @endforeach

    </div>
</div>

<style>
    .statCard {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(56, 189, 248, 0.15);
        border-radius: 16px;
        padding: 18px;
    }

    .statCard p {
        color: #94a3b8;
        font-size: 12px;
        margin: 0 0 6px;
    }

    .statCard h3 {
        color: #38bdf8;
        font-size: 24px;
        margin: 0;
    }

    .statCard.green h3 {
        color: #22c55e;
    }

    @media(max-width:768px) {
        h1 {
            font-size: 22px !important;
        }

        .tf-container {
            padding: 0 16px;
        }
    }
</style>

<script>
    function copyText(id) {
        let copyText = document.getElementById(id);
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        alert("Copied successfully!");
    }
</script>

@endsection