@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Choose Network')

@section('content')

<div class="pb-16 pt-40">
    <div class="tf-container">

        <h4 class="mb-20 text-white">Select Network</h4>

        <form method="POST" action="{{ route('deposit.store') }}">
            @csrf

            @php
            $coins = [
            ['name'=>'USDT','symbol'=>'BEP20 (BSC)','currency'=>'usdtbsc','badge'=>'Recommended','color'=>'#16a34a','img'=>'usdt.png'],
            ['name'=>'USDC','symbol'=>'BEP20 (BSC)','currency'=>'usdcbsc','badge'=>'Fast','color'=>'#2563eb','img'=>'usdc.png'],
            ['name'=>'USDT','symbol'=>'TRC20','currency'=>'usdttrc20','badge'=>'Alternative','color'=>'#ca8a04','img'=>'usdt.png'],
            ['name'=>'BNB','symbol'=>'BSC','currency'=>'bnbbsc','badge'=>'Alternative','color'=>'#ca8a04','img'=>'bnb.svg'],
            ];
            @endphp

            <div class="d-grid gap-12">
                @foreach ($coins as $coin)
                <button
                    type="submit"
                    name="currency"
                    value="{{ $coin['currency'] }}"
                    class="d-flex align-items-center gap-12 w-100"
                    style="
                            padding:16px;
                            border-radius:16px;
                            background:linear-gradient(135deg,#0f172a,#020617);
                            border:1px solid rgba(255,255,255,.08);
                            text-align:left;
                            color:#e5e7eb;
                        ">

                    {{-- ICON --}}
                    <div style="
                            width:48px;
                            height:48px;
                            border-radius:50%;
                            background:#020617;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            border:1px solid rgba(255,255,255,.1);
                        ">
                        <img src="{{ asset('images/coin/'.$coin['img']) }}"
                            style="width:26px;height:26px;">
                    </div>

                    {{-- INFO --}}
                    <div class="flex-grow-1">
                        <div class="fw-semibold">{{ $coin['name'] }}</div>
                        <small class="text-secondary">{{ $coin['symbol'] }}</small>
                    </div>

                    {{-- BADGE --}}
                    <span style="
                            background:{{ $coin['color'] }};
                            color:#fff;
                            padding:4px 10px;
                            font-size:11px;
                            border-radius:999px;
                        ">
                        {{ $coin['badge'] }}
                    </span>
                </button>
                @endforeach
            </div>
        </form>

        {{-- INFO --}}
        <div class="mt-24 p-16"
            style="
                border-radius:16px;
                background:linear-gradient(135deg,#020617,#0f172a);
                border:1px solid rgba(255,255,255,.08);
            ">

            <h6 class="mb-8 text-white">How it works</h6>
            <ol class="text-secondary text-small ps-3">
                <li>Select network</li>
                <li>Scan QR & send funds</li>
                <li>Balance updates automatically</li>
            </ol>
        </div>

    </div>
</div>

@endsection