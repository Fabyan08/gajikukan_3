<div class="main-wrapper main-wrapper-1">
    <div style="background-color: rgba(5, 5, 5, 0.7); width: 100%; height: 115px; position: absolute; ">
        <div class="navbar-bg"
            style="background: url({{ asset('img/bg-main.jpg') }});background-size: 100%; object-fit: cover; object-position: bottom">
        </div>
    </div>

    {{-- <div class="navbar-b" style="background-color: url({{ asset('img/bg-main.jpg') }});"></div> --}}

    <nav class="navbar navbar-expand-lg main-navbar">
        @if (Auth::user()->status == 'Aktif')
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                class="fas fa-search"></i></a></li>
                </ul>

            </form>
        @endif
        <ul class="navbar-nav navbar-right">
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="../img/avatar/avatar-1.png" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->nama }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @if (Auth::user()->status == 'Aktif')
                        <a href="/profile" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Profile
                        </a>
                    @endif


                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                            <button type="submit" class="btn btn-danger btn-lg btn-block btn-icon-split">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </div>
                    </form>

                </div>
            </li>
        </ul>
    </nav>
</div>
