<div class="menubar-footer footer-fixed">
    <ul class="inner-bar">
        {{-- HOME --}}
        <li>
            <a href="{{ route('home') }}" class="footer-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <span class="footer-icon">
                    <img src="{{ asset('images/icons/home.svg') }}" alt="Home">
                </span>
                <span class="footer-label">Home</span>
            </a>
        </li>

        {{-- TRACK --}}
        <li>
            <a href="{{ route('compute.track') }}" class="footer-link {{ request()->routeIs('compute.track') ? 'active' : '' }}">
                <span class="footer-icon">
                    <img src="{{ asset('images/icons/track.svg') }}" alt="Track">
                </span>
                <span class="footer-label">Track</span>
            </a>
        </li>

        {{-- TEAM --}}
        <li>
            <a href="{{ route('team') }}" class="footer-link {{ request()->routeIs('team') ? 'active' : '' }}">
                <span class="footer-icon">
                    <img src="{{ asset('images/icons/team.svg') }}" alt="Team">
                </span>
                <span class="footer-label">Team</span>
            </a>
        </li>

        {{-- ACCOUNT --}}
        <li>
            <a href="{{ route('account.settings') }}" class="footer-link {{ request()->routeIs('account.settings') ? 'active' : '' }}">
                <span class="footer-icon">
                    <img src="{{ asset('images/icons/account.svg') }}" alt="Account">
                </span>
                <span class="footer-label">Account</span>
            </a>
        </li>
    </ul>
</div>