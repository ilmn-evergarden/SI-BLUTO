@php
    $isKepala = Auth::user()->role == 'kepala_desa';
    $prefix = $isKepala ? 'kepala' : 'aparat';
@endphp
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('kepala.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class='bx bx-user menu-icon'></i>
                <span class="menu-title">Aparat</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->is('aparat/aparat*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('aparat.index') }}">Kelola Aparat</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class='bx bx-folder menu-icon'></i>
                <span class="menu-title">Konten</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->is("{$prefix}/berita*") ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route($isKepala ? 'kepala.berita.index' : 'aparat.berita.index') }}">Kelola Berita</a>
                    </li>
                    <li class="nav-item {{ request()->is("{$prefix}/galeri*") ? 'active' : '' }}">
                        <a class="nav-link" href="{{ $isKepala ? route('kepala.gallery.index') : route('aparat.gallery.index') }}">Kelola Galeri</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class='bx bx-user-voice menu-icon'></i>
                <span class="menu-title">Tamu</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->is("{$prefix}/tamu*") ? 'active' : '' }}">
                        <a class="nav-link" href="{{ $isKepala ? route('kepala.bukutamu') : route('aparat.bukutamu') }}">Kelola Tamu</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>