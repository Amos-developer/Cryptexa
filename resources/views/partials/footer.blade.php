<div class="menubar-footer footer-fixed">
    <ul class="inner-bar">
        <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}">
                <i class="icon icon-home2"></i>
                Home
            </a>
        </li>
        <li>
            <a href="#">
                <i class="icon icon-exchange"></i>
                Exchange
            </a>
        </li>
        <li>
            <a href="#">
                <i class="icon icon-wallet"></i>
                Wallet
            </a>
        </li>
        <li>
            <a href="#">
                <i class="icon icon-wallet"></i>
                Account
            </a>
        </li>
    </ul>
</div>