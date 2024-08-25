<div class="main-sidebar sidebar-style-2">
    @if (Auth::user()->status == 'Aktif')
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="/"> <img src="{{ asset('img/logo.jpg') }}" alt="logo"
                        style="width: 60px; margin-top:10px"></a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="/"><img src="{{ asset('img/logo.jpg') }}" alt="logo" style="width: 30px"></a>
            </div>
                        <p class="px-4 pt-2 text-center">Koperasi Agro Niaga Indonesia Syariah Malang Jawa Timur</p>

            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>

                <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a class="nav-link" href="/dashboard"><i
                            class="fas fa-home"></i>
                        <span>Dashboard</span></a>
                </li>

                <li class="menu-header">Kantor Pusat</li>

                <li
                    class="{{ Request::is('karyawan*') || Request::is('pengurus-pengawas*') || Request::is('tidak-aktif*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown active"><i class="fas fa-users"></i>
                        <span>Data Karyawan</span></a>
                    <ul class="dropdown-menu" style="display: none;">
                        <li class="{{ Request::is('karyawan*') ? 'active' : '' }}"><a href="/karyawan">HR Karyawan</a>
                        </li>
                        <li class="{{ Request::is('pengurus-pengawas*') ? 'active' : '' }}"><a
                                href="/pengurus-pengawas">HR Pengurus & Pengawas</a></li>
                        <li class="{{ Request::is('tidak-aktif*') ? 'active' : '' }}"><a href="/tidak-aktif">Data Tidak
                                Aktif</a></li>
                    </ul>
                </li>
                <li class="{{ Request::is('upload*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown active"><i class="fas fa-upload"></i>
                        <span>Data Penggajian</span></a>
                    <ul class="dropdown-menu" style="display: none;">
                        <li class="{{ Request::is('upload/gaji-karyawan*') ? 'active' : '' }}"><a
                                href="/upload/gaji-karyawan">Gaji
                                Karyawan</a></li>
                        <li class="{{ Request::is('upload/gaji-pengurus*') ? 'active' : '' }}"><a
                                href="/upload/gaji-pengurus">Gaji Pengurus & Pengawas</a></li>
                    </ul>
                </li>
                <li class="menu-header">Kantor Cabang</li>
                <li class="{{ Request::is('tambah-kantor') || Request::is('detail-kantor-cabang*') || Request::is('kantor-cabang*')  ? 'active' : '' }}"><a class="nav-link"
                        href="/tambah-kantor"><i class="fas fa-building"></i>
                        <span>Kantor Cabang</span></a>
                </li>
                <li class="menu-header">Laporaan</li>
                <li class="{{ Request::is('laporan') ? 'active' : '' }}"><a class="nav-link" href="/laporan"><i
                            class="fas fa-print"></i>
                        <span>Laporan</span></a>
                </li>
                <li class="menu-header">Admin</li>
                <li class="{{ Request::is('admin') ? 'active' : '' }}"><a class="nav-link" href="/admin"><i
                            class="fas fa-users-cog"></i>
                        <span>Tambahkan Admin</span></a>
                </li>

            </ul>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                    <button type="submit" class="btn btn-danger btn-lg btn-block btn-icon-split">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </div>
            </form>

        </aside>
    @endif
</div>
