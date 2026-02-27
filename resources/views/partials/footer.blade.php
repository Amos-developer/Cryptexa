<div class="mobile-footer">
    <ul class="footer-nav">

        {{-- HOME --}}
        <li>
            <a href="{{ route('home') }}" 
               class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <span class="nav-icon">
                    <img src="{{ asset('images/icons/home.svg') }}" alt="Home">
                </span>
                <span class="nav-text">{{ __t('home') }}</span>
            </a>
        </li>

        {{-- TRACK --}}
        <li>
            <a href="{{ route('compute.track') }}" 
               class="nav-link {{ request()->routeIs('compute.track') ? 'active' : '' }}">
                <span class="nav-icon">
                    <img src="{{ asset('images/icons/track.svg') }}" alt="Track">
                </span>
                <span class="nav-text">{{ __t('track') }}</span>
            </a>
        </li>

        {{-- TEAM --}}
        <li>
            <a href="{{ route('team') }}" 
               class="nav-link {{ request()->routeIs('team') ? 'active' : '' }}">
                <span class="nav-icon">
                    <img src="{{ asset('images/icons/team.svg') }}" alt="Team">
                </span>
                <span class="nav-text">{{ __t('team') }}</span>
            </a>
        </li>

        {{-- ACCOUNT --}}
        <li>
            <a href="{{ route('account.settings') }}" 
               class="nav-link {{ request()->routeIs('account.settings') ? 'active' : '' }}">
                <span class="nav-icon">
                    <img src="{{ asset('images/icons/account.svg') }}" alt="Account">
                </span>
                <span class="nav-text">{{ __t('account') }}</span>
            </a>
        </li>

    </ul>
</div>