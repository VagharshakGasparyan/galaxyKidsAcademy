<header class="admin-header">
    <div class="admin-header-sidebar d-flex">
        <div style="flex: 1" class="ps-2 text-center">Galaxy Kids Academy</div>
        <i class="fa fa-2x fa-bars" id="admin_header_bar"></i>
    </div>
    <div style="flex: 1">

    </div>
    @auth
        <div class="pe-3">{{auth()->user()->name}}, {{auth()->user()->email}}</div>
    @endauth

    <div class="pe-2">
        <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Account
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{route('admin.account')}}">Edit Account</a></li>
                <li><a class="dropdown-item" href="{{route('admin.logout')}}"><i class="fa fa-sign-out me-2"></i>Logout</a></li>
            </ul>
        </div>
    </div>

</header>
