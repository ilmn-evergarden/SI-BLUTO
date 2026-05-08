<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('kepala.dashboard') }}"><img src="{{ asset('images/logo.png') }}" class="mr-2" alt="logo" style="height:50px; width:auto;"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('kepala.dashboard') }}"><img src="{{ asset('images/logo-mini.png') }}"/></a>
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

        {{-- REALTIME CLOCK WIDGET --}}
        <div id="navbar-clock-kepala" class="d-none d-md-flex align-items-center" style="
            margin-right: auto;
            margin-left: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 6px 16px;
            gap: 10px;
            box-shadow: 0 2px 12px rgba(102, 126, 234, 0.3);
            color: #fff;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            transition: all 0.3s ease;
            cursor: default;
            position: relative;
            overflow: hidden;
        ">
            {{-- Shimmer overlay --}}
            <div style="
                position: absolute;
                top: 0; left: -100%; width: 100%; height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
                animation: clockShimmerKepala 3s infinite;
            "></div>

            {{-- Calendar icon + Date --}}
            <div style="display: flex; align-items: center; gap: 6px; position: relative; z-index: 1;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.9; flex-shrink: 0;">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <span id="clock-date-kepala" style="font-size: 0.8rem; font-weight: 500; letter-spacing: 0.3px; white-space: nowrap;"></span>
            </div>

            {{-- Separator dot --}}
            <div style="width: 4px; height: 4px; border-radius: 50%; background: rgba(255,255,255,0.5); flex-shrink: 0; position: relative; z-index: 1;"></div>

            {{-- Clock icon + Time --}}
            <div style="display: flex; align-items: center; gap: 6px; position: relative; z-index: 1;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.9; flex-shrink: 0; animation: clockPulseKepala 2s ease-in-out infinite;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <span id="clock-time-kepala" style="font-size: 0.85rem; font-weight: 700; letter-spacing: 1px; font-variant-numeric: tabular-nums; white-space: nowrap;"></span>
            </div>
        </div>

<ul class="navbar-nav navbar-nav-right">

    {{-- USER INFO --}}
    <li class="nav-item d-flex align-items-center" style="gap: 8px; margin-right: 8px;">
        <img src="{{ asset('images/faces/face29.png') }}"
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
           onclick="event.preventDefault(); document.getElementById('logout-form-kepala').submit();">
            <i style="font-size: 14px;"></i>
            Logout
        </a>

        <form id="logout-form-kepala"
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

{{-- Clock animations --}}
<style>
@keyframes clockShimmerKepala {
    0%   { left: -100%; }
    50%  { left: 100%; }
    100% { left: 100%; }
}
@keyframes clockPulseKepala {
    0%, 100% { opacity: 0.9; transform: scale(1); }
    50%      { opacity: 1;   transform: scale(1.08); }
}
#navbar-clock-kepala:hover {
    box-shadow: 0 4px 20px rgba(102, 126, 234, 0.5);
    transform: translateY(-1px);
}
</style>

{{-- Realtime clock script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const bulan = ['Januari','Februari','Maret','April','Mei','Juni',
                   'Juli','Agustus','September','Oktober','November','Desember'];

    function updateClockKepala() {
        const now = new Date();
        const dayName   = hari[now.getDay()];
        const day       = now.getDate();
        const monthName = bulan[now.getMonth()];
        const year      = now.getFullYear();
        const hours     = String(now.getHours()).padStart(2, '0');
        const minutes   = String(now.getMinutes()).padStart(2, '0');
        const seconds   = String(now.getSeconds()).padStart(2, '0');

        const dateEl = document.getElementById('clock-date-kepala');
        const timeEl = document.getElementById('clock-time-kepala');

        if (dateEl) dateEl.textContent = dayName + ', ' + day + ' ' + monthName + ' ' + year;
        if (timeEl) timeEl.textContent = hours + ':' + minutes + ':' + seconds + ' WIB';
    }

    updateClockKepala();
    setInterval(updateClockKepala, 1000);
});
</script>