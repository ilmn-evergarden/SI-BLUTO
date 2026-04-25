<!DOCTYPE html>
<html lang="id">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistem Informasi Desa Bluto</title>
<style>

* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: 'Segoe UI', Arial, sans-serif; }

/* ===== NAVBAR ===== */
nav {
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

.nav-brand {
    color: white;
    font-size: 1.2rem;
    font-weight: 800;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    letter-spacing: -0.3px;
    flex-shrink: 0;
}
.nav-brand span {
    background: rgba(255,255,255,0.15);
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 1.1rem;
}

/* Desktop menu */
.nav-links {
    display: flex;
    align-items: center;
    gap: 4px;
}
.nav-links a {
    color: rgba(255,255,255,0.85);
    text-decoration: none;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 500;
    transition: background .2s, color .2s;
    white-space: nowrap;
}
.nav-links a:hover {
    background: rgba(255,255,255,0.15);
    color: white;
}
.nav-links a.active {
    background: rgba(255,255,255,0.2);
    color: white;
}
.nav-links a.btn-login {
    background: white;
    color: #1a56db;
    font-weight: 700;
    margin-left: 6px;
}
.nav-links a.btn-login:hover {
    background: #eff6ff;
}

/* Hamburger button */
.nav-toggle {
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
.nav-toggle:hover { background: rgba(255,255,255,0.1); }
.nav-toggle span {
    display: block;
    width: 24px;
    height: 2.5px;
    background: white;
    border-radius: 99px;
    transition: transform .3s, opacity .3s;
}

/* Hamburger → X animation */
.nav-toggle.open span:nth-child(1) { transform: translateY(7.5px) rotate(45deg); }
.nav-toggle.open span:nth-child(2) { opacity: 0; }
.nav-toggle.open span:nth-child(3) { transform: translateY(-7.5px) rotate(-45deg); }

/* ===== FOOTER ===== */
footer {
    background: #0f172a;
    color: rgba(255,255,255,0.6);
    text-align: center;
    padding: 28px 20px;
    font-size: 0.88rem;
    line-height: 1.8;
    margin-top: 0;
}
footer strong { color: white; }

/* ===== RESPONSIVE ===== */
@media (max-width: 860px) {
    .nav-toggle { display: flex; }

    .nav-links {
        display: none;
        flex-direction: column;
        align-items: stretch;
        gap: 4px;
        position: absolute;
        top: 64px;
        left: 0; right: 0;
        background: linear-gradient(135deg, #1e3a8a, #1a56db);
        padding: 16px 20px 20px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        border-top: 1px solid rgba(255,255,255,0.1);
    }
    .nav-links.open { display: flex; }

    .nav-links a {
        padding: 12px 16px;
        font-size: 0.95rem;
        border-radius: 10px;
    }
    .nav-links a.btn-login {
        margin-left: 0;
        margin-top: 6px;
        text-align: center;
        padding: 12px;
    }
}

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

* { box-sizing: border-box; }
body { font-family: 'Segoe UI', Arial, sans-serif; color: var(--text); background: var(--white); margin: 0; }
a { text-decoration: none; }
p { margin: 0; line-height: 1.7; color: var(--text-muted); font-size: 0.93rem; }
h3 { margin: 0 0 8px; color: var(--dark); }

/* ===== HERO ===== */
.hero-news {
    background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue) 60%, #0ea5e9 100%);
    padding: 80px 24px 72px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.hero-news::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='30' cy='30' r='20' fill='%23ffffff' fill-opacity='0.04'/%3E%3C/svg%3E");
    pointer-events: none;
}
.hero-news-inner { position: relative; z-index: 1; max-width: 600px; margin: 0 auto; }
.hero-badge {
    display: inline-block;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
    padding: 6px 18px;
    border-radius: 999px;
    font-size: 12.5px;
    margin-bottom: 18px;
    letter-spacing: 0.4px;
}
.hero-news h1 {
    font-size: clamp(1.9rem, 5vw, 3rem);
    font-weight: 800;
    color: white;
    margin: 0 0 12px;
    line-height: 1.2;
}
.hero-news h1 span {
    background: linear-gradient(90deg, #93c5fd, #e0f2fe);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.hero-news > .hero-news-inner > p { color: rgba(255,255,255,0.8); font-size: 1rem; }

/* ===== SEARCH + FILTER ===== */
.search-wrap {
    background: var(--white);
    padding: 0 24px;
    display: flex;
    justify-content: center;
}
.search-bar {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    justify-content: center;
    background: white;
    border: 1px solid var(--blue-border);
    border-radius: var(--radius);
    padding: 16px 24px;
    box-shadow: var(--shadow);
    max-width: 700px;
    width: 100%;
    transform: translateY(-28px);
    position: relative;
    z-index: 10;
}
.search-bar input {
    flex: 1;
    min-width: 200px;
    padding: 10px 16px;
    border: 1px solid var(--blue-border);
    border-radius: 8px;
    font-size: 0.93rem;
    color: var(--text);
    outline: none;
    transition: border-color .2s;
}
.search-bar input:focus { border-color: var(--blue); }
.search-bar select {
    padding: 10px 16px;
    border: 1px solid var(--blue-border);
    border-radius: 8px;
    font-size: 0.93rem;
    color: var(--text);
    outline: none;
    background: white;
    cursor: pointer;
}
.search-bar select:focus { border-color: var(--blue); }
.search-bar button {
    padding: 10px 22px;
    background: var(--blue);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 0.93rem;
    font-weight: 600;
    cursor: pointer;
    transition: opacity .2s;
    white-space: nowrap;
}
.search-bar button:hover { opacity: .85; }

/* ===== SECTION WRAPPER ===== */
.section-wrap { padding: 48px 24px; }
.section-wrap.bg-gray { background: var(--gray); }
.section-inner { max-width: 1100px; margin: 0 auto; }

/* ===== SECTION HEADER ===== */
.section-header { margin-bottom: 28px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; }
.section-header-left { display: flex; flex-direction: column; gap: 6px; }
.section-label {
    display: inline-block;
    background: var(--blue-pale);
    color: var(--blue);
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.8px;
    padding: 4px 14px;
    border-radius: 999px;
    width: fit-content;
}
.section-title {
    font-size: clamp(1.2rem, 3vw, 1.6rem);
    font-weight: 800;
    color: var(--dark);
    margin: 0;
}
.see-all {
    color: var(--blue);
    font-size: 0.88rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    white-space: nowrap;
    transition: gap .2s;
}
.see-all:hover { gap: 8px; }

/* ===== FEATURED CAROUSEL ===== */
.featured-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
}
.card-featured-main {
    background: linear-gradient(135deg, var(--blue-dark), var(--blue));
    border-radius: var(--radius);
    padding: 36px 32px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    min-height: 240px;
    position: relative;
    overflow: hidden;
}
.card-featured-main::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='40' cy='40' r='30' fill='%23ffffff' fill-opacity='0.04'/%3E%3C/svg%3E");
}
.card-featured-main .news-cat {
    background: rgba(255,255,255,0.2);
    color: white;
    border: 1px solid rgba(255,255,255,0.3);
}
.card-featured-main h3 { color: white; font-size: 1.15rem; margin-bottom: 8px; position: relative; z-index: 1; }
.card-featured-main p { color: rgba(255,255,255,0.75); position: relative; z-index: 1; }
.card-featured-main .news-meta { color: rgba(255,255,255,0.55); }

.featured-side { display: flex; flex-direction: column; gap: 16px; }
.card-featured-side {
    background: white;
    border: 1px solid var(--blue-border);
    border-radius: var(--radius);
    padding: 20px 22px;
    box-shadow: var(--shadow);
    flex: 1;
    transition: transform .2s, box-shadow .2s;
}
.card-featured-side:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(26,86,219,0.12); }

/* ===== NEWS CARD ===== */
.news-cat {
    display: inline-block;
    background: var(--blue-pale);
    color: var(--blue);
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    padding: 3px 10px;
    border-radius: 999px;
    margin-bottom: 10px;
    width: fit-content;
    position: relative;
    z-index: 1;
}
.news-meta {
    font-size: 0.8rem;
    color: var(--text-muted);
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* ===== BERITA TERBARU ===== */
.latest-card {
    background: white;
    border: 1px solid var(--blue-border);
    border-left: 5px solid var(--blue);
    border-radius: var(--radius);
    padding: 32px 36px;
    box-shadow: var(--shadow);
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.latest-card h3 { font-size: 1.25rem; }
.latest-card p { font-size: 0.96rem; }
.latest-card .news-meta { margin-top: 4px; }
.btn-read {
    display: inline-block;
    margin-top: 8px;
    background: var(--blue);
    color: white;
    padding: 10px 22px;
    border-radius: 8px;
    font-size: 0.88rem;
    font-weight: 600;
    width: fit-content;
    transition: opacity .2s;
}
.btn-read:hover { opacity: .85; }

/* ===== NEWS GRID ===== */
.news-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}
.news-card {
    background: white;
    border: 1px solid var(--blue-border);
    border-radius: var(--radius);
    padding: 24px;
    box-shadow: var(--shadow);
    transition: transform .2s, box-shadow .2s;
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.news-card:hover { transform: translateY(-4px); box-shadow: 0 14px 36px rgba(26,86,219,0.13); }
.news-card h3 { font-size: 1rem; margin: 0; }
.news-card .read-link {
    margin-top: auto;
    padding-top: 12px;
    color: var(--blue);
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: gap .2s;
}
.news-card .read-link:hover { gap: 8px; }

/* ===== PAGINATION ===== */
.pagination-wrap { padding: 16px 24px 56px; display: flex; justify-content: center; }
.pagination {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
    justify-content: center;
}
.pagination a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px; height: 40px;
    border: 1px solid var(--blue-border);
    border-radius: 8px;
    color: var(--text);
    font-size: 0.9rem;
    font-weight: 500;
    transition: all .2s;
    background: white;
}
.pagination a:hover, .pagination a.active {
    background: var(--blue);
    color: white;
    border-color: var(--blue);
}
.pagination a.next {
    width: auto;
    padding: 0 18px;
    gap: 6px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 900px) {
    .featured-grid { grid-template-columns: 1fr; }
    .featured-side { flex-direction: row; }
    .news-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .section-wrap { padding: 36px 16px; }
    .featured-side { flex-direction: column; }
    .news-grid { grid-template-columns: 1fr; }
    .latest-card { padding: 24px 20px; }
    .search-bar { padding: 14px 16px; gap: 10px; }
    .search-bar input { min-width: 100%; }
}

</style>
</head>

<body>

<!-- NAVBAR -->
<nav>
    <a class="nav-brand" href="/">
    Si Bluto
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
<footer>
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

    // Tutup menu saat salah satu link diklik
    links.querySelectorAll('a').forEach(a => {
        a.addEventListener('click', () => {
            toggle.classList.remove('open');
            links.classList.remove('open');
        });
    });
</script>

</body>
</html>