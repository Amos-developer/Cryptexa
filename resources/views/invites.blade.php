@extends('layouts.app')

@section('title', 'Referral Program')
@section('hide-header', true)

@section('content')

<div class="tf-container mt-20">

    <!-- HEADER -->
    <div class="d-flex align-items-center gap-12 mb-16">
        <a href="{{ url()->previous() }}" class="back-btn">
            <i class="icon-left-btn"></i>
        </a>
        <h5 class="text-white mb-0">Referral Program</h5>
    </div>

    <!-- INFO CARD -->
    <div
        style="
            background:linear-gradient(135deg,#020617,#0f172a);
            border-radius:18px;
            padding:20px;
            box-shadow:0 15px 35px rgba(0,0,0,.6);
            border:1px solid rgba(255,255,255,.06);
        ">

        <h4 class="text-white mb-8">Invite & Earn</h4>

        <p class="text-secondary text-small mb-16">
            Invite new users using your referral link.
            You earn <strong class="text-white">20% commission</strong> on every completed order they make.
        </p>

        <!-- REFERRAL CODE -->
        <div class="mb-12">
            <p class="text-secondary text-small mb-4">Your Referral Code</p>
            <div
                style="
                    background:#020617;
                    padding:12px;
                    border-radius:12px;
                    border:1px dashed rgba(255,255,255,.2);
                    color:#e5e7eb;
                    font-weight:600;
                    letter-spacing:1px;
                ">
                {{ auth()->user()->referral_code }}
            </div>
        </div>

        <!-- REFERRAL LINK -->
        @php
        $refLink = url('/register?ref=' . auth()->user()->referral_code);
        @endphp

        <div class="mb-16">
            <p class="text-secondary text-small mb-4">Your Referral Link</p>
            <div
                style="
                    background:#020617;
                    padding:12px;
                    border-radius:12px;
                    border:1px solid rgba(255,255,255,.08);
                    font-size:12px;
                    color:#9ca3af;
                    word-break:break-all;
                ">
                {{ $refLink }}
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="d-flex gap-12">
            <button onclick="copyReferralLink()" class="flex-fill">
                Copy Link
            </button>

            <button onclick="shareReferralLink()" class="flex-fill">
                Share
            </button>
        </div>

    </div>

    <!-- STATS -->
    <div class="row mt-16">

        <div class="col-6">
            <div
                style="
                    background:#020617;
                    padding:14px;
                    border-radius:14px;
                    border:1px solid rgba(255,255,255,.08);
                ">
                <p class="text-secondary text-small mb-4">Invited Users</p>
                <h4 class="text-white mb-0">
                    {{ auth()->user()->referrals()->count() }}
                </h4>
            </div>
        </div>

        <div class="col-6">
            <div
                style="
                    background:#020617;
                    padding:14px;
                    border-radius:14px;
                    border:1px solid rgba(255,255,255,.08);
                ">
                <p class="text-secondary text-small mb-4">Referral Earnings</p>
                <h4 class="text-success mb-0">
                    ${{ number_format(auth()->user()->referral_earnings ?? 0, 2) }}
                </h4>
            </div>
        </div>

    </div>

</div>

<!-- JS -->
<script>
    function copyReferralLink() {
        navigator.clipboard.writeText("{{ $refLink }}");

        Swal.fire({
            icon: 'success',
            title: 'Copied',
            text: 'Referral link copied successfully',
            timer: 1500,
            showConfirmButton: false,
            background: '#020617',
            color: '#e5e7eb'
        });
    }

    function shareReferralLink() {
        if (navigator.share) {
            navigator.share({
                title: 'Join me',
                text: 'Register using my referral link',
                url: "{{ $refLink }}"
            });
        } else {
            copyReferralLink();
        }
    }
</script>

@endsection