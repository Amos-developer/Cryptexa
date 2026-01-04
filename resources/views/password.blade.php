@extends('layouts.app')

@section('title', 'Change Password')
@section('hide-header', true)

@section('content')
<div class="tf-container mt-20">

    <div style="
        background:linear-gradient(135deg,#020617,#0f172a);
        border-radius:20px;
        padding:20px;
        box-shadow:0 20px 40px rgba(0,0,0,.6);
    ">

        <h4 class="text-white mb-16">Change Password</h4>

        <form method="POST" action="{{ route('account.password.update') }}">
            @csrf

            <fieldset class="mb-12">
                <input type="password" name="current_password" placeholder="Current password" required>
            </fieldset>

            <fieldset class="mb-12">
                <input type="password" name="password" placeholder="New password" required>
            </fieldset>

            <fieldset class="mb-12">
                <input type="password" name="password_confirmation" placeholder="Confirm password" required>
            </fieldset>

            <button style="
                width:100%;
                padding:12px;
                border-radius:12px;
                background:linear-gradient(135deg,#38bdf8,#0ea5e9);
                border:none;
                font-weight:600;
                color:#020617;
            ">
                Update Password
            </button>
        </form>

    </div>
</div>
@endsection