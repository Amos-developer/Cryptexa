<div class="topbar">
    <div>Admin Dashboard</div>

    <div>
        {{ auth()->user()->email }}

        <form method="POST" action="/logout" style="display:inline;">
            @csrf
            <button style="background:none;border:none;color:#38bdf8;cursor:pointer;">
                Logout
            </button>
        </form>
    </div>
</div>