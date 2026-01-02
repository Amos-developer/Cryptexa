<div class="header-style2 fixed-top bg-menuDark">
    <div class="d-flex justify-content-between align-items-center gap-14">
        <div class="box-account style-2">
            <img src="{{ asset('images/avt/avt2.jpg') }}" class="avt">

            <div>
                <strong class="text-white">
                    {{ auth()->user()->name }}
                </strong><br>
                <small>{{ auth()->user()->email }}</small>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm btn-danger">Logout</button>
        </form>
    </div>
</div>