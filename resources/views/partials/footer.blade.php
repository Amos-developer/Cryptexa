<div class="menubar-footer footer-fixed"
    style="
        background: linear-gradient(135deg, #020617, #0f172a);
        border-top: 1px solid rgba(56,189,248,0.2);
        backdrop-filter: blur(10px);
        padding: 8px 0;
        z-index: 99;
     ">

    <ul class="inner-bar"
        style="
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 0;
            padding: 0;
            list-style: none;
            width: 100%;
        ">

        {{-- HOME --}}
        <li style="flex: 1; text-align: center;">
            <a href="{{ route('home') }}"
                style="
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    gap: 6px;
                    padding: 8px;
                    color: {{ request()->routeIs('home') ? '#38bdf8' : '#64748b' }};
                    text-decoration: none;
                    transition: all 0.3s ease;
                    border-radius: 10px;
               "
                onmouseover="this.style.background='rgba(56,189,248,0.1)'; this.style.color='#38bdf8';"
                onmouseout="this.style.background='transparent'; this.style.color='{{ request()->routeIs('home') ? '#38bdf8' : '#64748b' }}';">
                <span style="
                    font-size: 20px;
                    {{ request()->routeIs('home') ? 'text-shadow: 0 0 10px rgba(56,189,248,0.6);' : '' }}
                ">
                    <img src="{{ asset('images/icons/home.svg') }}" alt="Home" style="width: 20px; height: 20px;">
                </span>
                <span style="font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Home</span>
            </a>
        </li>

        {{-- TRACK --}}
        <li style="flex: 1; text-align: center;">
            <a href="{{ route('compute.track') }}"
                style="
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    gap: 6px;
                    padding: 8px;
                    color: {{ request()->routeIs('compute.track') ? '#fbbf24' : '#64748b' }};
                    text-decoration: none;
                    transition: all 0.3s ease;
                    border-radius: 10px;
                "
                onmouseover="this.style.background='rgba(251,191,36,0.1)'; this.style.color='#fbbf24';"
                onmouseout="this.style.background='transparent'; this.style.color='{{ request()->routeIs('compute.track') ? '#fbbf24' : '#64748b' }}';">
                <span style="
                    font-size: 20px;
                    {{ request()->routeIs('compute.track') ? 'text-shadow: 0 0 10px rgba(251,191,36,0.6);' : '' }}
                ">
                    <img src="{{ asset('images/icons/track.svg') }}" alt="Track" style="width: 20px; height: 20px;">
                </span>
                <span style="font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Track</span>
            </a>
        </li>

        {{-- TEAM --}}
        <li style="flex: 1; text-align: center;">
            <a href="{{ route('team') }}"
                style="
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    gap: 6px;
                    padding: 8px;
                    color: {{ request()->routeIs('team') ? '#22c55e' : '#64748b' }};
                    text-decoration: none;
                    transition: all 0.3s ease;
                    border-radius: 10px;
                "
                onmouseover="this.style.background='rgba(34,197,94,0.1)'; this.style.color='#22c55e';"
                onmouseout="this.style.background='transparent'; this.style.color='{{ request()->routeIs('team') ? '#22c55e' : '#64748b' }}';">
                <span style="
                    font-size: 20px;
                    {{ request()->routeIs('team') ? 'text-shadow: 0 0 10px rgba(34,197,94,0.6);' : '' }}
                ">
                    <img src="{{ asset('images/icons/team.svg') }}" alt="Team" style="width: 20px; height: 20px;">
                </span>
                <span style="font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Team</span>
            </a>
        </li>

        {{-- ACCOUNT --}}
        <li style="flex: 1; text-align: center;">
            <a href="{{ route('account.settings') }}"
                style="
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    gap: 6px;
                    padding: 8px;
                    color: {{ request()->routeIs('account.settings') ? '#a855f7' : '#64748b' }};
                    text-decoration: none;
                    transition: all 0.3s ease;
                    border-radius: 10px;
                "
                onmouseover="this.style.background='rgba(168,85,247,0.1)'; this.style.color='#a855f7';"
                onmouseout="this.style.background='transparent'; this.style.color='{{ request()->routeIs('account.settings') ? '#a855f7' : '#64748b' }}';">
                <span style="
                    font-size: 20px;
                    {{ request()->routeIs('account.settings') ? 'text-shadow: 0 0 10px rgba(168,85,247,0.6);' : '' }}
                ">
                    <img src="{{ asset('images/icons/account.svg') }}" alt="Account" style="width: 20px; height: 20px;">
                </span>
                <span style="font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Account</span>
            </a>
        </li>

    </ul>
</div>