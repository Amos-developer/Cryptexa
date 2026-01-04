<div class="header-style2 fixed-top"
    style="
        background: linear-gradient(180deg, #020617, #0f172a);
        border-bottom: 1px solid rgba(255,255,255,0.08);
        box-shadow: 0 10px 30px rgba(56,189,248,0.15);
        padding: 12px 16px;
        z-index: 1000;
     ">

    <div class="d-flex justify-content-between align-items-center gap-14">

        {{-- USER INFO --}}
        <div class="d-flex align-items-center gap-12">

            <div style="
                width:42px;
                height:42px;
                border-radius:50%;
                overflow:hidden;
                border:2px solid rgba(56,189,248,0.5);
                box-shadow:0 0 12px rgba(56,189,248,0.6);
            ">
                <img src="{{ asset('images/avt/avt2.jpg') }}"
                    style="width:100%;height:100%;object-fit:cover;">
            </div>

            <div>
                <strong style="
                    color:#e5e7eb;
                    font-size:14px;
                    line-height:1.1;
                ">
                    {{ auth()->user()->name }}
                </strong><br>

                <small style="
                    color:#94a3b8;
                    font-size:11px;
                ">
                    {{ auth()->user()->email }}
                </small>
            </div>

        </div>

        {{-- LOGOUT --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                style="
                    background: rgba(239,68,68,0.15);
                    border:1px solid rgba(239,68,68,0.4);
                    color:#f87171;
                    padding:6px 12px;
                    font-size:12px;
                    border-radius:999px;
                    box-shadow:0 0 10px rgba(239,68,68,0.4);
                ">
                Logout
            </button>
        </form>

    </div>
</div>