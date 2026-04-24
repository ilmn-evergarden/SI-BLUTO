@php
    $isKepala = Auth::user()->role == 'kepala_desa';
    $prefix = $isKepala ? 'kepala' : 'aparat';
@endphp<nav class="sidebar sidebar-offcanvas" id="sidebar">

    <ul class="nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('aparat.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('aparat.berita.index') }}">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Berita</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('guest.index') }}">
                <i class="icon-book menu-icon"></i>
                <span class="menu-title">Buku Tamu</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('kepala/galeri*') || request()->is('aparat/galeri*') ? 'active' : '' }}">
            <a class="nav-link"
                href="{{ Auth::user()->role == 'kepala_desa' ? route('kepala.gallery.index') : route('aparat.gallery.index') }}">

                <i class="icon-image menu-icon"></i>
                <span class="menu-title">Galeri Desa</span>

            </a>
        </li>

    </ul>

</nav>
