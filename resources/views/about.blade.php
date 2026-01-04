@extends('layouts.app')

@section('title', 'About Us')
@section('hide-header', true)

@section('content')
<div class="tf-container mt-20">

    <div style="
        background:linear-gradient(135deg,#020617,#0f172a);
        border-radius:20px;
        padding:20px;
        box-shadow:0 20px 40px rgba(0,0,0,.6);
    ">

        <h4 class="text-white mb-12">About Us</h4>

        <p class="text-secondary text-small">
            We are a digital asset and compute platform focused on
            transparency, automation, and long-term value creation.
        </p>

        <p class="text-secondary text-small mt-8">
            © {{ date('Y') }} Cryptexa. All rights reserved.
        </p>

    </div>
</div>
@endsection