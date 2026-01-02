@extends('layouts.app')

@section('title', 'Home | Cryptexa')

@section('content')

<!-- PRELOADER -->
<div class="preload preload-container">
    <div class="preload-logo" style="background-image: url('{{ asset('images/logo/144.png') }}')">
        <div class="spinner"></div>
    </div>
</div>

<!-- HEADER CONTENT -->
<div class="header-style2 fixed-top bg-menuDark">
    <div class="d-flex justify-content-between align-items-center gap-14">
        <div class="box-account style-2">
            <a href="#">
                <img src="{{ asset('images/avt/avt2.jpg') }}" class="avt">
            </a>

            <div>
                <strong class="text-white">{{ auth()->user()->name }}</strong><br>
                <small>{{ auth()->user()->email }}</small>
            </div>
        </div>

        <div class="d-flex align-items-center gap-8">
            <a href="#" class="icon-gift"></a>
            <a href="#notification" class="icon-noti box-noti" data-bs-toggle="modal"></a>
        </div>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="pt-58 pb-80">

    <!-- WALLET -->
    <div class="bg-menuDark tf-container">
        <div class="pt-12 pb-12 mt-4">
            <h5>
                <span class="text-primary">Balance</span>
                <!-- <a href="#" class="choose-account" data-bs-toggle="modal" data-bs-target="#accountWallet">
                    <span class="dom-text">balance </span>
                    <i class="icon-select-down"></i>
                </a> -->
            </h5>

            <h1 class="mt-16">$2,159.34</h1>

            <ul class="mt-16 grid-4 m--16">
                <li><a href="#" class="tf-list-item d-flex flex-column gap-8 align-items-center"><span class="box-round bg-surface"><i class="icon icon-way"></i></span>Send</a></li>
                <li><a href="#" class="tf-list-item d-flex flex-column gap-8 align-items-center"><span class="box-round bg-surface"><i class="icon icon-way2"></i></span>Receive</a></li>
                <li><a href="#" class="tf-list-item d-flex flex-column gap-8 align-items-center"><span class="box-round bg-surface"><i class="icon icon-wallet"></i></span>Buy</a></li>
                <li><a href="#" class="tf-list-item d-flex flex-column gap-8 align-items-center"><span class="box-round bg-surface"><i class="icon icon-exchange"></i></span>Earn</a></li>
            </ul>
        </div>
    </div>

    <!-- MARKET -->
    <div class="bg-menuDark tf-container">
        <div class="pt-12 pb-12 mt-4">
            <h5>Market</h5>

            <div class="swiper market-swiper mt-16">
                <div class="swiper-wrapper">

                    <!-- SLIDE 1 -->
                    <div class="swiper-slide">
                        <a href="#" class="coin-box d-block">
                            <div class="coin-logo">
                                <img src="{{ asset('images/coin/market-1.jpg') }}" class="logo">
                                <div class="title">
                                    <p>Bitcoin</p>
                                    <span>BTC</span>
                                </div>
                            </div>
                            <div class="coin-price d-flex justify-content-between">
                                <span>$30780</span>
                                <span class="text-primary d-flex align-items-center gap-2">
                                    <i class="icon-select-up"></i> 11,75%
                                </span>
                            </div>
                        </a>
                    </div>

                    <!-- SLIDE 2 -->
                    <div class="swiper-slide">
                        <a href="#" class="coin-box d-block">
                            <div class="coin-logo">
                                <img src="{{ asset('images/coin/market-3.jpg') }}" class="logo">
                                <div class="title">
                                    <p>Binance</p>
                                    <span>BNB</span>
                                </div>
                            </div>
                            <div class="coin-price d-flex justify-content-between">
                                <span>$270.10</span>
                                <span class="text-primary d-flex align-items-center gap-2">
                                    <i class="icon-select-up"></i> 21,59%
                                </span>
                            </div>
                        </a>
                    </div>

                    <!-- SLIDE 3 -->
                    <div class="swiper-slide">
                        <a href="#" class="coin-box d-block">
                            <div class="coin-logo">
                                <img src="{{ asset('images/coin/coin-3.jpg') }}" class="logo">
                                <div class="title">
                                    <p>Ethereum</p>
                                    <span>ETH</span>
                                </div>
                            </div>
                            <div class="coin-price d-flex justify-content-between">
                                <span>$1478.10</span>
                                <span class="text-primary d-flex align-items-center gap-2">
                                    <i class="icon-select-up"></i> 4,75%
                                </span>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.market-swiper', {
                slidesPerView: 2.8,
                spaceBetween: 16,
                freeMode: true,
                grabCursor: true,
                breakpoints: {
                    768: {
                        slidesPerView: 3
                    }
                }
            });
        });
    </script>


    @endsection