<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="{{ asset('images/logo.png') }}" class="mr-2" alt="logo" style="height:50px; width:auto;"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('images/logo-mini.png') }}"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
            </div>
          </li>
        </ul>
<ul class="navbar-nav navbar-nav-right">

    {{-- USER INFO --}}
    <li class="nav-item d-flex align-items-center" style="gap: 8px; margin-right: 8px;">
        <img src="{{ asset('images/faces/face28.jpg') }}"
             alt="profile"
             style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
        <div style="line-height: 1.2;">
            <span style="font-weight: 600; font-size: 0.875rem; display: block; color: inherit;">
                {{ Auth::user()->name }}
            </span>
            <span style="font-size: 0.75rem; opacity: 0.6;">
                {{ Auth::user()->email }}
            </span>
        </div>
    </li>

    {{-- DIVIDER --}}
    <li class="nav-item d-flex align-items-center">
        <div style="width: 1px; height: 24px; background: currentColor; opacity: 0.15;"></div>
    </li>

    {{-- LOGOUT --}}
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-1"
           href="{{ route('logout') }}"
           style="color: #e74c3c; font-size: 0.875rem;"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i style="font-size: 14px;"></i>
            Logout
        </a>

        <form id="logout-form"
              action="{{ route('logout') }}"
              method="POST"
              style="display: none;">
            @csrf
        </form>
    </li>

</ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>