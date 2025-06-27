<header class="admin-header">
    <div class="admin-header-sidebar d-flex">
        <div style="flex: 1" class="ps-2 text-center"><a class="neutral-anchor" href="{{route('admin.dashboard')}}">Galaxy Kids Academy</a></div>
        <i class="fa fa-2x fa-bars" id="admin_header_bar"></i>
    </div>
    <div style="flex: 1">

    </div>
    @auth
        <div class="pe-3">{{auth()->user()->name}}, {{auth()->user()->email}}</div>
    @endauth

    <div class="pe-2">
        <div class="btn-group">
            <div class="dropdown-toggle1" style="cursor: pointer; user-select: none;" data-bs-toggle="dropdown" aria-expanded="false">
                @if(auth()->user()->photo)
                    <div style="background-image: url('{{asset('storage/' . auth()->user()->photo)}}');
                     background-size: cover; background-position: center; width: 38px;height: 38px;border-radius: 50%;"></div>
                @else
                    <div style="width: 38px;height: 38px; border-radius: 50%;background-color: var(--c);color:var(--bg);display: flex;align-items: center;justify-content: center;"><i class="fa fa-2x fa-user"></i></div>
                @endif
            </div>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{route('admin.account')}}">Edit Account</a></li>
                <li><a class="dropdown-item" href="{{route('admin.logout')}}"><i class="fa fa-sign-out me-2"></i>Logout</a></li>
            </ul>
        </div>
    </div>

</header>
