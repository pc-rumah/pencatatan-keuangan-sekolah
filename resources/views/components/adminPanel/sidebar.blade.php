<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="#"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="/dashboard" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li
                    class="sidebar-item has-sub {{ request()->is('kelas*') || request()->is('ta*') || request()->is('semester*') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>Akademik</span>
                    </a>
                    <ul
                        class="submenu {{ request()->is('kelas*') || request()->is('ta*') || request()->is('semester*') ? 'show' : '' }}">
                        <li class="submenu-item {{ request()->is('kelas*') ? 'active' : '' }}">
                            <a href="{{ route('kelas.index') }}" class="submenu-link">Kelas</a>
                        </li>

                        <li class="submenu-item {{ request()->is('ta*') ? 'active' : '' }}">
                            <a href="{{ route('ta.index') }}" class="submenu-link">Tahun Ajaran</a>
                        </li>

                        <li class="submenu-item {{ request()->is('semester*') ? 'active' : '' }}">
                            <a href="{{ route('semester.index') }}" class="submenu-link">Semester</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Siswa</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item  ">
                            <a href="{{ route('siswa.index') }}">Data Siswa</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('jenis.index') }}">Jenis</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Keuangan</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('tagihan.index') }}">Tagihan</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-badge.html">Pembayaran</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{ Request::is('pendapatan.*') ? 'active' : '' }}">
                    <a href="/pendapatan" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Pendapatan</span>
                    </a>
                </li>

                @if (auth()->user()->hasrole('admin'))
                    <li class="sidebar-item {{ Request::is('dataUser.*') ? 'active' : '' }}">
                        <a href="/dataUser" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Data User</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
