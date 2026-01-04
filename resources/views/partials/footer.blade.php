<div class="menubar-footer footer-fixed"
    style="
        background: linear-gradient(180deg, #0f172a, #020617);
        border-top: 1px solid rgba(255,255,255,0.08);
        box-shadow: 0 -10px 30px rgba(56,189,248,0.15);
        padding: 10px 0;
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
        <li style="flex:1; text-align:center;">
            <a href="{{ route('home') }}"
                style="
                    display:flex;
                    flex-direction:column;
                    align-items:center;
                    gap:4px;
                    color: {{ request()->routeIs('home') ? '#38bdf8' : '#94a3b8' }};
                    text-decoration:none;
               ">
                <i class="icon icon-home2"
                    style="
                        font-size:20px;
                        {{ request()->routeIs('home') ? 'text-shadow:0 0 10px rgba(56,189,248,0.8);' : '' }}
                   ">
                </i>
                <span style="font-size:11px;">Home</span>
            </a>
        </li>

        {{-- TRACK --}}
        <li style="flex:1; text-align:center;" class="{{ request()->routeIs('compute.track') ? 'active' : '' }}">
            <a href="{{ route('compute.track') }}"
                style="display:flex;flex-direction:column;align-items:center;gap:4px;color:#94a3b8;text-decoration:none;">
                <i class="icon icon-exchange" style="font-size:20px;"></i>
                <span style="font-size:11px;">Track</span>
            </a>
        </li>

        {{-- TEAM --}}
        <li style="flex:1; text-align:center;">
            <a href="{{ route('team') }}"
                style="display:flex;flex-direction:column;align-items:center;gap:4px;color:#94a3b8;text-decoration:none;">
                <i class="icon icon-wallet" style="font-size:20px;"></i>
                <span style="font-size:11px;">Team</span>
            </a>
        </li>

        {{-- ACCOUNT --}}
        <li style="flex:1; text-align:center;">
        <a href="{{ route('account.settings') }}"
                style="display:flex;flex-direction:column;align-items:center;gap:4px;color:#94a3b8;text-decoration:none;">
                <i class="icon icon-user" style="font-size:20px;"></i>
                <span style="font-size:11px;">Account</span>
            </a>
        </li>

    </ul>
</div>