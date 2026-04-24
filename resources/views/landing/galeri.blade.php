@extends('layouts.app')

@section('content')

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

* { box-sizing: border-box; }
body { font-family: 'Segoe UI', Arial, sans-serif; color: var(--text); background: var(--white); margin: 0; }
p { margin: 0; line-height: 1.7; color: var(--text-muted); font-size: 0.93rem; }

/* ===== HERO ===== */
.hero-gallery {
    background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue) 60%, #0ea5e9 100%);
    padding: 80px 24px 72px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.hero-gallery::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='30' cy='30' r='20' fill='%23ffffff' fill-opacity='0.04'/%3E%3C/svg%3E");
    pointer-events: none;
}
.hero-gallery-inner { position: relative; z-index: 1; max-width: 580px; margin: 0 auto; }
.hero-badge {
    display: inline-block;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
    padding: 6px 18px;
    border-radius: 999px;
    font-size: 12.5px;
    margin-bottom: 18px;
}
.hero-gallery h1 {
    font-size: clamp(1.8rem, 5vw, 2.8rem);
    font-weight: 800;
    color: white;
    margin: 0 0 12px;
    line-height: 1.2;
}
.hero-gallery h1 span {
    background: linear-gradient(90deg, #93c5fd, #e0f2fe);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.hero-gallery-inner > p { color: rgba(255,255,255,0.8); font-size: 1rem; }

/* ===== SEARCH BAR ===== */
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
    min-width: 180px;
    padding: 10px 16px;
    border: 1px solid var(--blue-border);
    border-radius: 8px;
    font-size: 0.93rem;
    color: var(--text);
    outline: none;
    transition: border-color .2s;
    font-family: inherit;
}
.search-bar input:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(26,86,219,0.08); }
.search-bar select {
    padding: 10px 16px;
    border: 1px solid var(--blue-border);
    border-radius: 8px;
    font-size: 0.93rem;
    color: var(--text);
    outline: none;
    background: white;
    cursor: pointer;
    font-family: inherit;
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
    font-family: inherit;
}
.search-bar button:hover { opacity: .85; }

/* ===== FILTER TABS ===== */
.filter-wrap {
    padding: 0 24px 32px;
    display: flex;
    justify-content: center;
}
.filter-tabs {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    justify-content: center;
}
.filter-tab {
    padding: 8px 18px;
    border: 1px solid var(--blue-border);
    border-radius: 999px;
    font-size: 0.87rem;
    font-weight: 600;
    color: var(--text-muted);
    background: white;
    cursor: pointer;
    transition: all .2s;
    font-family: inherit;
}
.filter-tab:hover { border-color: var(--blue); color: var(--blue); background: var(--blue-pale); }
.filter-tab.active { background: var(--blue); color: white; border-color: var(--blue); }

/* ===== SECTION INNER ===== */
.section-inner { max-width: 1100px; margin: 0 auto; padding: 0 24px; }

.section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 12px;
}
.section-header-left { display: flex; flex-direction: column; gap: 5px; }
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
.results-count { font-size: 0.87rem; color: var(--text-muted); }

/* ===== GALLERY GRID ===== */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 48px;
}

/* Featured card - spans 2 cols */
.gallery-card { position: relative; border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow); cursor: pointer; }
.gallery-card:hover .gallery-overlay { opacity: 1; }
.gallery-card:hover .gallery-img-placeholder { transform: scale(1.04); }

.gallery-img-placeholder {
    width: 100%;
    height: 200px;
    background: linear-gradient(135deg, var(--blue-pale), #dbeafe);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    transition: transform .35s ease;
}
.gallery-card.featured .gallery-img-placeholder { height: 300px; }
.gallery-card.medium .gallery-img-placeholder { height: 240px; }

.gallery-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(15,23,42,0.85) 0%, rgba(15,23,42,0.2) 55%, transparent 100%);
    opacity: 0;
    transition: opacity .3s ease;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 20px;
}
.gallery-overlay h4 {
    color: white;
    font-size: 0.97rem;
    font-weight: 700;
    margin: 0 0 4px;
}
.gallery-overlay p { color: rgba(255,255,255,0.75); font-size: 0.82rem; margin: 0; }
.gallery-overlay .cat-badge {
    position: absolute;
    top: 14px;
    left: 14px;
    background: var(--blue);
    color: white;
    font-size: 10.5px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
}
.gallery-overlay .zoom-icon {
    position: absolute;
    top: 14px;
    right: 14px;
    width: 32px; height: 32px;
    background: rgba(255,255,255,0.2);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.9rem;
    backdrop-filter: blur(4px);
}

/* Info strip below image (always visible) */
.gallery-info {
    background: white;
    padding: 14px 16px;
    border: 1px solid var(--blue-border);
    border-top: none;
    border-radius: 0 0 var(--radius) var(--radius);
}
.gallery-info h4 {
    font-size: 0.92rem;
    font-weight: 700;
    color: var(--dark);
    margin: 0 0 3px;
}
.gallery-info p { font-size: 0.82rem; color: var(--text-muted); }

/* ===== PAGINATION ===== */
.pagination-wrap { padding: 0 24px 64px; display: flex; justify-content: center; }
.pagination { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; justify-content: center; }
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
    text-decoration: none;
    background: white;
    transition: all .2s;
}
.pagination a:hover,
.pagination a.active { background: var(--blue); color: white; border-color: var(--blue); }
.pagination a.next { width: auto; padding: 0 18px; }

/* ===== LIGHTBOX ===== */
.lightbox {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.85);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 24px;
    backdrop-filter: blur(4px);
}
.lightbox.open { display: flex; }
.lightbox-inner {
    background: white;
    border-radius: var(--radius);
    overflow: hidden;
    max-width: 640px;
    width: 100%;
    box-shadow: 0 32px 80px rgba(0,0,0,0.4);
    animation: popIn .25s ease;
}
@keyframes popIn {
    from { transform: scale(.92); opacity: 0; }
    to   { transform: scale(1);   opacity: 1; }
}
.lightbox-img {
    width: 100%;
    height: 340px;
    background: linear-gradient(135deg, var(--blue-pale), #dbeafe);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
}
.lightbox-body { padding: 24px 28px; }
.lightbox-body h3 { font-size: 1.1rem; font-weight: 800; color: var(--dark); margin: 0 0 6px; }
.lightbox-body p { font-size: 0.9rem; }
.lightbox-close {
    position: absolute;
    top: 16px; right: 16px;
    width: 40px; height: 40px;
    background: rgba(255,255,255,0.15);
    border: none;
    border-radius: 10px;
    color: white;
    font-size: 1.2rem;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: background .2s;
}
.lightbox-close:hover { background: rgba(255,255,255,0.25); }

/* ===== RESPONSIVE ===== */
@media (max-width: 1000px) { .gallery-grid { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 700px)  { .gallery-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px)  {
    .gallery-grid { grid-template-columns: 1fr; }
    .search-bar { padding: 14px 16px; }
    .search-bar input { min-width: 100%; }
}
</style>


<!-- HERO -->
<section class="hero-gallery">
    <div class="hero-gallery-inner">
        <span class="hero-badge">Dokumentasi Kegiatan</span>
        <h1>Galeri <span>Desa Bluto</span></h1>
        <p>Dokumentasi kegiatan dan aktivitas masyarakat Desa Bluto</p>
    </div>
</section>


<!-- SEARCH -->
<div class="search-wrap">
    <div class="search-bar">
        <input type="text" placeholder="🔍  Cari kegiatan...">
        <select>
            <option>Semua Kategori</option>
            <option>Kegiatan Desa</option>
            <option>Musyawarah</option>
            <option>Bantuan Sosial</option>
            <option>Kegiatan Masyarakat</option>
        </select>
        <button>Cari</button>
    </div>
</div>


<!-- FILTER TABS -->
<div class="filter-wrap">
    <div class="filter-tabs">
        <button class="filter-tab active">Semua</button>
        <button class="filter-tab">Kegiatan Desa</button>
        <button class="filter-tab">Musyawarah</button>
        <button class="filter-tab">Bantuan Sosial</button>
        <button class="filter-tab">Kesehatan</button>
        <button class="filter-tab">Pemuda</button>
    </div>
</div>


<!-- GALLERY GRID -->
<div class="section-inner">
    <div class="section-header">
        <div class="section-header-left">
            <span class="section-label">Foto</span>
            <h2 class="section-title">Semua Kegiatan</h2>
        </div>
        <span class="results-count">Menampilkan 6 dari 24 foto</span>
    </div>

    <div class="gallery-grid">

        <div class="gallery-card featured" onclick="openLightbox('Musyawarah Desa', 'Kegiatan musyawarah desa dalam rangka pembangunan.', '🏛️')">
            <div class="gallery-img-placeholder">🏛️</div>
            <div class="gallery-overlay">
                <span class="cat-badge">Musyawarah</span>
                <span class="zoom-icon">🔍</span>
                <h4>Musyawarah Desa Bluto</h4>
                <p>Kegiatan musyawarah desa.</p>
            </div>
            <div class="gallery-info">
                <h4>Musyawarah Desa Bluto</h4>
                <p>📅 12 Juni 2025</p>
            </div>
        </div>

        <div class="gallery-card medium" onclick="openLightbox('Penyaluran BLT', 'Penyaluran bantuan langsung tunai kepada masyarakat.', '💰')">
            <div class="gallery-img-placeholder">💰</div>
            <div class="gallery-overlay">
                <span class="cat-badge">Bantuan Sosial</span>
                <span class="zoom-icon">🔍</span>
                <h4>Penyaluran BLT</h4>
                <p>Bantuan kepada masyarakat.</p>
            </div>
            <div class="gallery-info">
                <h4>Penyaluran BLT</h4>
                <p>📅 10 Juni 2025</p>
            </div>
        </div>

        <div class="gallery-card medium" onclick="openLightbox('Kerja Bakti Desa', 'Kegiatan gotong royong masyarakat desa.', '🧹')">
            <div class="gallery-img-placeholder">🧹</div>
            <div class="gallery-overlay">
                <span class="cat-badge">Kegiatan Desa</span>
                <span class="zoom-icon">🔍</span>
                <h4>Kerja Bakti Desa</h4>
                <p>Gotong royong masyarakat.</p>
            </div>
            <div class="gallery-info">
                <h4>Kerja Bakti Desa</h4>
                <p>📅 8 Juni 2025</p>
            </div>
        </div>

        <div class="gallery-card" onclick="openLightbox('Kegiatan Posyandu', 'Pelayanan kesehatan masyarakat desa.', '🏥')">
            <div class="gallery-img-placeholder">🏥</div>
            <div class="gallery-overlay">
                <span class="cat-badge">Kesehatan</span>
                <span class="zoom-icon">🔍</span>
                <h4>Kegiatan Posyandu</h4>
                <p>Pelayanan kesehatan.</p>
            </div>
            <div class="gallery-info">
                <h4>Kegiatan Posyandu</h4>
                <p>📅 5 Juni 2025</p>
            </div>
        </div>

        <div class="gallery-card" onclick="openLightbox('Kegiatan PKK', 'Pemberdayaan kesejahteraan keluarga desa.', '👩‍👧')">
            <div class="gallery-img-placeholder">👩‍👧</div>
            <div class="gallery-overlay">
                <span class="cat-badge">Pemberdayaan</span>
                <span class="zoom-icon">🔍</span>
                <h4>Kegiatan PKK</h4>
                <p>Pemberdayaan masyarakat.</p>
            </div>
            <div class="gallery-info">
                <h4>Kegiatan PKK</h4>
                <p>📅 3 Juni 2025</p>
            </div>
        </div>

        <div class="gallery-card" onclick="openLightbox('Karang Taruna', 'Kegiatan pemuda desa Bluto.', '🏆')">
            <div class="gallery-img-placeholder">🏆</div>
            <div class="gallery-overlay">
                <span class="cat-badge">Pemuda</span>
                <span class="zoom-icon">🔍</span>
                <h4>Karang Taruna</h4>
                <p>Kegiatan pemuda desa.</p>
            </div>
            <div class="gallery-info">
                <h4>Karang Taruna</h4>
                <p>📅 1 Juni 2025</p>
            </div>
        </div>

    </div>
</div>


<!-- PAGINATION -->
<div class="pagination-wrap">
    <div class="pagination">
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#" class="next">Next →</a>
    </div>
</div>


<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox" onclick="closeLightbox(event)">
    <button class="lightbox-close" onclick="closeLightbox()">✕</button>
    <div class="lightbox-inner">
        <div class="lightbox-img" id="lightbox-img"></div>
        <div class="lightbox-body">
            <h3 id="lightbox-title"></h3>
            <p id="lightbox-desc"></p>
        </div>
    </div>
</div>


<script>
function openLightbox(title, desc, emoji) {
    document.getElementById('lightbox-title').textContent = title;
    document.getElementById('lightbox-desc').textContent = desc;
    document.getElementById('lightbox-img').textContent = emoji;
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeLightbox(e) {
    if (!e || e.target === document.getElementById('lightbox') || e.currentTarget.classList.contains('lightbox-close')) {
        document.getElementById('lightbox').classList.remove('open');
        document.body.style.overflow = '';
    }
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });

// Filter tabs
document.querySelectorAll('.filter-tab').forEach(tab => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
    });
});
</script>

@endsection