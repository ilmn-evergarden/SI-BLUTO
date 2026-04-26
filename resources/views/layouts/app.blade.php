<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistem Informasi Desa Bluto</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="shortcut icon" href="{{ asset('images/logo-mini.png') }}">
<style>

:root {
    --blue: #1a56db;
    --blue-dark: #1e3a8a;
    --blue-light: #3b82f6;
    --blue-pale: #eff6ff;
    --blue-border: #bfdbfe;
    --gray: #f8fafc;
    --dark: #0f172a;
    --text: #1e293b;
    --text-muted: #64748b;
    --white: #ffffff;
    --radius: 14px;
    --shadow: 0 4px 24px rgba(26, 86, 219, 0.08);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Segoe UI', Arial, sans-serif; color: var(--text); background: var(--white); }
a { text-decoration: none; }
p { line-height: 1.7; color: var(--text-muted); font-size: 0.93rem; }
h3 { margin: 0 0 8px; color: var(--dark); }

/* ===== NAVBAR ===== */
nav.site-nav {
    background: linear-gradient(135deg, #1e3a8a, #1a56db);
    padding: 0 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 2px 16px rgba(26, 86, 219, 0.25);
    min-height: 64px;
}

nav.site-nav .nav-brand {
    font-size: 1.1rem;
    font-weight: 800;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    letter-spacing: -0.3px;
    flex-shrink: 0;
}

nav.site-nav .nav-brand img {
    height: 44px;        /* tinggi tetap */
    width: auto;         /* lebar mengikuti */
    object-fit: contain; /* tidak kepotong */
    border-radius: 0;    /* logo biasanya tidak perlu rounded */
    background: none;
}

nav.site-nav .nav-brand span {
    line-height: 1.2;
}

nav.site-nav .nav-brand .brand-sub {
    display: block;
    font-size: 0.65rem;
    font-weight: 400;
    opacity: 0.7;
    letter-spacing: 0.2px;
}

nav.site-nav .nav-links {
    display: flex;
    align-items: center;
    gap: 4px;
}

nav.site-nav .nav-links a {
    color: rgba(255,255,255,0.85);
    text-decoration: none;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 500;
    transition: background .2s, color .2s;
    white-space: nowrap;
}

nav.site-nav .nav-links a:hover {
    background: rgba(255,255,255,0.15);
    color: white;
}

nav.site-nav .nav-links a.active {
    background: rgba(255,255,255,0.2);
    color: white;
}

nav.site-nav .nav-links a.btn-login {
    background: white;
    color: #1a56db;
    font-weight: 700;
    margin-left: 6px;
}

nav.site-nav .nav-links a.btn-login:hover {
    background: #eff6ff;
}

nav.site-nav .nav-toggle {
    display: none;
    flex-direction: column;
    gap: 5px;
    cursor: pointer;
    padding: 8px;
    border-radius: 8px;
    transition: background .2s;
    background: none;
    border: none;
}

nav.site-nav .nav-toggle:hover {
    background: rgba(255,255,255,0.1);
}

nav.site-nav .nav-toggle span {
    display: block;
    width: 24px;
    height: 2.5px;
    background: white;
    border-radius: 99px;
    transition: transform .3s, opacity .3s;
}

nav.site-nav .nav-toggle.open span:nth-child(1) { transform: translateY(7.5px) rotate(45deg); }
nav.site-nav .nav-toggle.open span:nth-child(2) { opacity: 0; }
nav.site-nav .nav-toggle.open span:nth-child(3) { transform: translateY(-7.5px) rotate(-45deg); }

/* ===== FOOTER ===== */
footer.site-footer {
    background: #0f172a;
    color: rgba(255,255,255,0.6);
    text-align: center;
    padding: 28px 20px;
    font-size: 0.88rem;
    line-height: 1.8;
}

footer.site-footer strong { color: white; }

/* ===== PAGINATION ISOLATION ===== */
.pagination-wrap nav p { display: none; }
.pagination-wrap nav { background: none !important; padding: 0 !important; box-shadow: none !important; min-height: unset !important; position: static !important; }

/* ===== RESPONSIVE ===== */
@media (max-width: 860px) {
    nav.site-nav .nav-toggle { display: flex; }

    nav.site-nav .nav-links {
        display: none;
        flex-direction: column;
        align-items: stretch;
        gap: 4px;
        position: absolute;
        top: 64px;
        left: 0;
        right: 0;
        background: linear-gradient(135deg, #1e3a8a, #1a56db);
        padding: 16px 20px 20px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        border-top: 1px solid rgba(255,255,255,0.1);
    }

    nav.site-nav .nav-links.open { display: flex; }

    nav.site-nav .nav-links a {
        padding: 12px 16px;
        font-size: 0.95rem;
        border-radius: 10px;
    }

    nav.site-nav .nav-links a.btn-login {
        margin-left: 0;
        margin-top: 6px;
        text-align: center;
        padding: 12px;
    }
}

</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="site-nav">
    <a class="nav-brand" href="/">
        <img src="{{ asset('images/logo1.png') }}" alt="Logo Desa Bluto">
    </a>

    <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <div class="nav-links" id="navLinks">
        <a href="/">Beranda</a>
        <a href="/profil-desa">Profil Desa</a>
        <a href="{{ route('public.berita.index') }}">Berita</a>
        <a href="{{ route('public.gallery.index') }}">Galeri</a>
        <a href="/login" class="btn-login">Login</a>
    </div>
</nav>


<!-- KONTEN HALAMAN -->
@yield('content')


<!-- FOOTER -->
<footer class="site-footer">
    <p><strong>Sistem Informasi Desa Bluto</strong></p>
    <p>Kecamatan Bluto, Kabupaten Sumenep, Madura, Jawa Timur</p>
    <p>© 2025 Si Bluto. All rights reserved.</p>
</footer>

<script>
    const toggle = document.getElementById('navToggle');
    const links  = document.getElementById('navLinks');

    toggle.addEventListener('click', () => {
        toggle.classList.toggle('open');
        links.classList.toggle('open');
    });

    links.querySelectorAll('a').forEach(a => {
        a.addEventListener('click', () => {
            toggle.classList.remove('open');
            links.classList.remove('open');
        });
    });
</script>

</body>
</html>