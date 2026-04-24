@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600&display=swap');

:root {
    --primary: #6366f1;
    --primary-dark: #4338ca;
    --primary-deeper: #312e81;
    --primary-light: #a5b4fc;
    --primary-pale: #eef2ff;
    --primary-border: #c7d2fe;
    --accent: #8b5cf6;
    --sky: #0ea5e9;
    --dark: #0f172a;
    --gray: #f8fafc;
    --gray-mid: #f1f5f9;
    --gray-border: #e2e8f0;
    --text: #1e293b;
    --text-muted: #64748b;
    --white: #ffffff;
    --radius: 16px;
    --radius-sm: 10px;
    --shadow: 0 4px 24px rgba(99,102,241,0.09);
    --shadow-md: 0 8px 32px rgba(99,102,241,0.14);
    --shadow-lg: 0 16px 48px rgba(99,102,241,0.20);
}

* { box-sizing: border-box; }
body { font-family: 'DM Sans', sans-serif; color: var(--text); margin: 0; background: var(--white); }
a { text-decoration: none; color: inherit; }
p { margin: 0; line-height: 1.8; color: var(--text-muted); font-size: 0.95rem; }
h1,h2,h3,h4 { font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; }
ul { margin: 0; padding-left: 20px; }
ul li { margin-bottom: 10px; line-height: 1.7; color: var(--text-muted); font-size: 0.94rem; }


/* ================================================================
   HERO
================================================================ */
.hero-profil {
    position: relative;
    background: linear-gradient(145deg, var(--primary-deeper) 0%, var(--primary-dark) 45%, var(--primary) 75%, #7c3aed 100%);
    padding: 96px 24px 88px;
    text-align: center;
    overflow: hidden;
}
.hero-profil::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.07) 1px, transparent 1px);
    background-size: 34px 34px;
    pointer-events: none;
}
.hero-orb {
    position: absolute; border-radius: 50%; filter: blur(88px); opacity: 0.28; pointer-events: none;
}
.hero-orb-1 { width: 460px; height: 460px; background: #7c3aed; top: -120px; right: -80px; }
.hero-orb-2 { width: 320px; height: 320px; background: var(--sky); bottom: -80px; left: -60px; }

.hero-profil-inner {
    position: relative; z-index: 1;
    max-width: 640px; margin: 0 auto;
    animation: fadeUp 0.7s ease forwards;
}
@keyframes fadeUp { from{opacity:0;transform:translateY(18px)} to{opacity:1;transform:translateY(0)} }

.hero-badge {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.26);
    color: rgba(255,255,255,0.9); padding: 7px 20px; border-radius: 999px;
    font-size: 12.5px; font-weight: 600; margin-bottom: 22px;
    letter-spacing: 0.4px; font-family: 'Plus Jakarta Sans', sans-serif;
}
.hero-badge::before { content: '🏡'; font-size: 13px; }

.hero-profil h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.2rem, 5vw, 3.6rem);
    font-weight: 800; color: white;
    margin: 0 0 14px; line-height: 1.18; letter-spacing: -0.3px;
}
.hero-profil h1 span {
    background: linear-gradient(90deg, #a5b4fc, #e0f2fe);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.hero-profil > .hero-profil-inner > p {
    color: rgba(255,255,255,0.75); font-size: 1rem; margin: 0;
}

/* Hero anchor nav */
.hero-nav {
    display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;
    margin-top: 32px;
}
.hero-nav a {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.22);
    color: rgba(255,255,255,0.88); padding: 8px 18px; border-radius: 999px;
    font-size: 0.83rem; font-weight: 600; transition: all .2s;
    font-family: 'Plus Jakarta Sans', sans-serif; backdrop-filter: blur(6px);
}
.hero-nav a:hover { background: rgba(255,255,255,0.22); color: white; transform: translateY(-2px); }


/* ================================================================
   SHARED SECTION
================================================================ */
.section-wrap { padding: 76px 24px; }
.section-wrap.bg-gray { background: var(--gray-mid); }
.section-wrap.bg-dark {
    background: linear-gradient(145deg, var(--primary-deeper) 0%, var(--primary-dark) 50%, #5b21b6 100%);
}
.section-inner { max-width: 960px; margin: 0 auto; }

.section-header { text-align: center; margin-bottom: 40px; }
.section-label {
    display: inline-block;
    background: var(--primary-pale); color: var(--primary);
    font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px;
    padding: 5px 16px; border-radius: 999px; margin-bottom: 12px;
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.section-label.light {
    background: rgba(255,255,255,0.14); color: rgba(255,255,255,0.9);
    border: 1px solid rgba(255,255,255,0.2);
}
.section-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.5rem, 3vw, 2.2rem);
    font-weight: 800; color: var(--dark); margin: 0;
}
.section-title.light { color: white; }


/* ================================================================
   TENTANG DESA
================================================================ */
.tentang-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    align-items: start;
}

.tentang-main {
    background: white; border: 1px solid var(--primary-border);
    border-left: 5px solid var(--primary);
    border-radius: var(--radius); padding: 36px 36px;
    box-shadow: var(--shadow);
    display: flex; flex-direction: column; gap: 18px;
}
.tentang-main h3 {
    font-size: 1.05rem; font-weight: 800; color: var(--dark);
    font-family: 'Plus Jakarta Sans', sans-serif;
    display: flex; align-items: center; gap: 8px; margin-bottom: 0;
}
.tentang-main p { font-size: 0.95rem; }
.tentang-divider { height: 1px; background: var(--primary-pale); }

.tentang-side { display: flex; flex-direction: column; gap: 16px; }
.info-chip {
    background: white; border: 1px solid var(--primary-border);
    border-radius: var(--radius); padding: 20px 22px;
    box-shadow: var(--shadow);
    display: flex; align-items: center; gap: 14px;
    transition: transform .2s, box-shadow .2s;
}
.info-chip:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }
.chip-icon {
    width: 44px; height: 44px; border-radius: 12px;
    background: var(--primary-pale); border: 1px solid var(--primary-border);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.25rem; flex-shrink: 0;
}
.chip-body label {
    font-size: 0.73rem; color: var(--text-muted); display: block;
    font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px;
    margin-bottom: 3px; font-family: 'Plus Jakarta Sans', sans-serif;
}
.chip-body span {
    font-size: 0.97rem; font-weight: 700; color: var(--dark);
    font-family: 'Plus Jakarta Sans', sans-serif;
}


/* ================================================================
   SEJARAH
================================================================ */
.sejarah-card {
    background: white; border: 1px solid var(--primary-border);
    border-radius: var(--radius); padding: 40px 44px;
    box-shadow: var(--shadow);
    display: grid; grid-template-columns: 72px 1fr;
    gap: 28px; align-items: flex-start;
    position: relative; overflow: hidden;
    transition: box-shadow .25s;
}
.sejarah-card:hover { box-shadow: var(--shadow-md); }
.sejarah-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--accent));
}
.sejarah-icon {
    width: 72px; height: 72px;
    background: var(--primary-pale); border: 1px solid var(--primary-border);
    border-radius: 18px;
    display: flex; align-items: center; justify-content: center;
    font-size: 2rem; flex-shrink: 0;
}
.sejarah-body h3 {
    font-size: 1.15rem; font-weight: 800; color: var(--dark);
    font-family: 'Plus Jakarta Sans', sans-serif; margin-bottom: 14px;
}
.sejarah-body p + p { margin-top: 14px; }

.highlight-word {
    display: inline-block;
    background: var(--primary-pale); color: var(--primary-dark);
    padding: 2px 10px; border-radius: 6px;
    font-weight: 700; font-style: italic;
    border: 1px solid var(--primary-border);
}


/* ================================================================
   VISI MISI
================================================================ */
.visimisi-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

.card-visi, .card-misi {
    background: white; border: 1px solid var(--primary-border);
    border-radius: var(--radius); padding: 32px 34px;
    box-shadow: var(--shadow);
    transition: transform .25s, box-shadow .25s;
}
.card-visi:hover, .card-misi:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }
.card-visi { border-top: 4px solid var(--primary); }
.card-misi { border-top: 4px solid var(--accent); }

.vm-header {
    display: flex; align-items: center; gap: 12px; margin-bottom: 18px;
}
.vm-icon {
    width: 44px; height: 44px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.25rem; flex-shrink: 0;
}
.vm-icon.visi { background: var(--primary-pale); border: 1px solid var(--primary-border); }
.vm-icon.misi { background: var(--accent-light, #ede9fe); border: 1px solid #c4b5fd; }
.vm-header h3 { font-size: 1.05rem; font-weight: 800; color: var(--dark); }

.card-misi ul { list-style: none; padding: 0; }
.card-misi ul li {
    display: flex; align-items: flex-start; gap: 10px;
    padding: 10px 0; border-bottom: 1px solid var(--gray-border);
    font-size: 0.93rem; margin: 0;
}
.card-misi ul li:last-child { border-bottom: none; }
.misi-num {
    width: 22px; height: 22px; border-radius: 6px;
    background: var(--primary-pale); color: var(--primary);
    font-size: 0.72rem; font-weight: 800; display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; margin-top: 1px; font-family: 'Plus Jakarta Sans', sans-serif;
}


/* ================================================================
   PETA
================================================================ */
.peta-card {
    background: white; border: 1px solid var(--primary-border);
    border-radius: var(--radius);
    box-shadow: var(--shadow); overflow: hidden;
    transition: box-shadow .25s;
}
.peta-card:hover { box-shadow: var(--shadow-md); }
.peta-card iframe { display: block; width: 100%; height: 420px; border: 0; }
.peta-footer {
    padding: 20px 28px;
    border-top: 1px solid var(--primary-border);
    display: flex; align-items: center; gap: 14px;
    flex-wrap: wrap;
}
.peta-info { display: flex; align-items: center; gap: 12px; flex: 1; min-width: 0; }
.peta-pin {
    width: 42px; height: 42px; border-radius: 11px;
    background: var(--primary-pale); border: 1px solid var(--primary-border);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem; flex-shrink: 0;
}
.peta-address p:first-child {
    font-weight: 700; color: var(--dark); font-size: 0.95rem; margin-bottom: 2px;
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.peta-address p:last-child { font-size: 0.83rem; }
.btn-maps {
    display: inline-flex; align-items: center; gap: 7px;
    background: var(--primary); color: white;
    padding: 10px 22px; border-radius: var(--radius-sm);
    font-size: 0.87rem; font-weight: 700; white-space: nowrap;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: all .2s;
}
.btn-maps:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(99,102,241,0.35); }


/* ================================================================
   STATISTIK
================================================================ */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: var(--radius);
    overflow: hidden;
    max-width: 820px;
    margin: 0 auto;
    backdrop-filter: blur(10px);
}
.stat-box {
    text-align: center; padding: 48px 24px;
    border-right: 1px solid rgba(255,255,255,0.1);
    transition: background .2s;
}
.stat-box:last-child { border-right: none; }
.stat-box:hover { background: rgba(255,255,255,0.1); }
.stat-box h3 {
    font-size: clamp(1.9rem, 4vw, 2.8rem);
    font-weight: 900; color: white;
    margin: 0 0 8px; letter-spacing: -1.5px;
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.stat-box p { color: rgba(255,255,255,0.6); font-size: 0.87rem; margin: 0; }
.stat-emoji { font-size: 1.4rem; margin-bottom: 12px; }


/* ================================================================
   PERANGKAT DESA (STRUKTUR)
================================================================ */
.struktur-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}
.struktur-card {
    background: white; border: 1px solid var(--primary-border);
    border-radius: var(--radius); padding: 24px 20px;
    box-shadow: var(--shadow); text-align: center;
    transition: transform .25s, box-shadow .25s;
}
.struktur-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
.struktur-avatar {
    width: 56px; height: 56px; border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-pale), var(--primary-border));
    border: 2px solid var(--primary-border);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; margin: 0 auto 14px;
}
.struktur-card h4 {
    font-size: 0.97rem; font-weight: 700; color: var(--dark);
    margin-bottom: 5px; font-family: 'Plus Jakarta Sans', sans-serif;
}
.struktur-role {
    display: inline-block;
    background: var(--primary-pale); color: var(--primary);
    font-size: 0.75rem; font-weight: 700; padding: 3px 12px;
    border-radius: 999px; font-family: 'Plus Jakarta Sans', sans-serif;
}


/* ================================================================
   RESPONSIVE
================================================================ */
@media (max-width: 860px) {
    .tentang-grid { grid-template-columns: 1fr; }
    .visimisi-grid { grid-template-columns: 1fr; }
    .stats-grid { grid-template-columns: 1fr; }
    .stat-box { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.1); }
    .stat-box:last-child { border-bottom: none; }
    .struktur-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
    .section-wrap { padding: 52px 16px; }
    .hero-profil { padding: 72px 16px 64px; }
    .sejarah-card { grid-template-columns: 1fr; padding: 28px 22px; }
    .sejarah-icon { width: 56px; height: 56px; font-size: 1.6rem; border-radius: 14px; }
    .tentang-main { padding: 26px 22px; }
    .card-visi, .card-misi { padding: 24px 22px; }
    .peta-footer { flex-direction: column; align-items: flex-start; }
    .btn-maps { width: 100%; justify-content: center; }
    .hero-nav { flex-direction: column; align-items: center; }
    .struktur-grid { grid-template-columns: 1fr; }
}
</style>


<!-- ================================================================
     HERO
================================================================ -->
<section class="hero-profil">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="hero-profil-inner">
        <h1>Profil Desa <span>Bluto</span></h1>
        <p>Kecamatan Bluto, Kabupaten Sumenep, Madura, Jawa Timur</p>
    </div>
</section>


<!-- ================================================================
     TENTANG DESA
================================================================ -->
<div class="section-wrap" id="tentang">
    <div class="section-inner">
        <div class="section-header">
            <span class="section-label">Gambaran Umum</span>
            <h2 class="section-title">Tentang Desa</h2>
        </div>

        <div class="tentang-grid">
            <div class="tentang-main">
                <h3>Desa Bluto</h3>
                <div class="tentang-divider"></div>
                <p>
                    Desa Bluto merupakan salah satu desa yang terletak di Kecamatan Bluto,
                    Kabupaten Sumenep, Madura, Jawa Timur. Desa ini memiliki jumlah penduduk
                    sekitar <strong>2.241 jiwa</strong> yang tersebar dalam wilayah administrasi desa.
                </p>
                <div class="tentang-divider"></div>
                <p>
                    Balai Desa Bluto berfungsi sebagai pusat penyelenggaraan pemerintahan desa
                    serta pelayanan administrasi bagi masyarakat. Pelayanan tersedia setiap hari
                    kerja mulai pukul <strong>07.30 hingga 12.00 WIB</strong>.
                </p>
            </div>

            <div class="tentang-side">
                <div class="info-chip">
                    <div class="chip-icon">📍</div>
                    <div class="chip-body">
                        <label>Kecamatan</label>
                        <span>Bluto, Kabupaten Sumenep</span>
                    </div>
                </div>
                <div class="info-chip">
                    <div class="chip-icon">🗺️</div>
                    <div class="chip-body">
                        <label>Provinsi</label>
                        <span>Jawa Timur, Madura</span>
                    </div>
                </div>
                <div class="info-chip">
                    <div class="chip-icon">👥</div>
                    <div class="chip-body">
                        <label>Jumlah Penduduk</label>
                        <span>± 2.241 Jiwa</span>
                    </div>
                </div>
                <div class="info-chip">
                    <div class="chip-icon">⏰</div>
                    <div class="chip-body">
                        <label>Jam Pelayanan</label>
                        <span>07.30 – 12.00 WIB</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ================================================================
     SEJARAH
================================================================ -->
<div class="section-wrap bg-gray" id="sejarah">
    <div class="section-inner">
        <div class="section-header">
            <span class="section-label">Latar Belakang</span>
            <h2 class="section-title">Sejarah Desa</h2>
        </div>

        <div class="sejarah-card">
            <div class="sejarah-icon">📜</div>
            <div class="sejarah-body">
                <h3>Asal Usul Nama Bluto</h3>
                <p>
                    Nama Bluto berasal dari kata <span class="highlight-word">abulu beto</span>
                    yang memiliki arti <em>daerah yang penuh bebatuan</em>. Nama tersebut
                    menggambarkan kondisi wilayah desa pada masa awal terbentuknya yang
                    banyak terdapat area berbatu.
                </p>
                <p>
                    Seiring perkembangan waktu, Desa Bluto berkembang menjadi desa yang aktif
                    dalam kegiatan sosial masyarakat serta penyelenggaraan pemerintahan desa
                    yang transparan dan akuntabel demi kesejahteraan seluruh warganya.
                </p>
            </div>
        </div>
    </div>
</div>


<!-- ================================================================
     VISI & MISI
================================================================ -->
<div class="section-wrap" id="visimisi">
    <div class="section-inner">
        <div class="section-header">
            <span class="section-label">Arah & Tujuan</span>
            <h2 class="section-title">Visi dan Misi</h2>
        </div>

        <div class="visimisi-grid">
            <div class="card-visi">
                <div class="vm-header">
                    <h3>Visi</h3>
                </div>
                <p>
                    Mewujudkan pelayanan pemerintahan desa yang transparan, efektif,
                    dan berorientasi pada kesejahteraan masyarakat Desa Bluto yang
                    maju dan berdaya saing.
                </p>
            </div>

            <div class="card-misi">
                <div class="vm-header">
                    <h3>Misi</h3>
                </div>
                <ul>
                    <li>
                        <span class="misi-num">1</span>
                        Meningkatkan kualitas pelayanan administrasi desa kepada masyarakat.
                    </li>
                    <li>
                        <span class="misi-num">2</span>
                        Mendorong partisipasi aktif masyarakat dalam pembangunan desa.
                    </li>
                    <li>
                        <span class="misi-num">3</span>
                        Mengelola program desa secara transparan dan akuntabel.
                    </li>
                    <li>
                        <span class="misi-num">4</span>
                        Meningkatkan kesejahteraan dan taraf hidup masyarakat desa.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- ================================================================
     PETA LOKASI
================================================================ -->
<div class="section-wrap bg-gray" id="peta">
    <div class="section-inner">
        <div class="section-header">
            <span class="section-label">Lokasi</span>
            <h2 class="section-title">Peta Desa Bluto</h2>
        </div>

        <div class="peta-card">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15820.123456789!2d113.8!3d-7.05!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6e5b3b3b3b3b3%3A0x1234567890abcdef!2sBluto%2C%20Sumenep%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1234567890"
                width="100%"
                height="420"
                style="border:0; display:block;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <div class="peta-footer">
                <div class="peta-info">
                    <div class="peta-pin">📍</div>
                    <div class="peta-address">
                        <p>Balai Desa Bluto</p>
                        <p>Kecamatan Bluto, Kabupaten Sumenep, Madura, Jawa Timur</p>
                    </div>
                </div>
                <a class="btn-maps" href="https://maps.google.com/?q=Bluto,Sumenep" target="_blank">
                    Buka di Google Maps →
                </a>
            </div>
        </div>
    </div>
</div>


<!-- ================================================================
     STATISTIK DESA
================================================================ -->
<div class="section-wrap bg-dark" id="statistik">
    <div class="section-inner">
        <div class="section-header">
            <span class="section-label light">Data & Fakta</span>
            <h2 class="section-title light">Statistik Desa</h2>
        </div>

        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-emoji"></div>
                <h3>2.241</h3>
                <p>Jumlah Penduduk</p>
            </div>
            <div class="stat-box">
                <div class="stat-emoji"></div>
                <h3>20</h3>
                <p>Desa di Kecamatan Bluto</p>
            </div>
            <div class="stat-box">
                <div class="stat-emoji"></div>
                <h3>07.30–12.00</h3>
                <p>Jam Pelayanan Desa</p>
            </div>
        </div>
    </div>
</div>


<!-- ================================================================
     PERANGKAT DESA
================================================================ -->
<div class="section-wrap" id="perangkat">
    <div class="section-inner">
        <div class="section-header">
            <span class="section-label">Organisasi</span>
            <h2 class="section-title">Perangkat Desa</h2>
        </div>

        <div class="struktur-grid">
            <div class="struktur-card">
                <div class="struktur-avatar">👨‍💼</div>
                <h4>Kepala Desa</h4>
                <span class="struktur-role">Pimpinan Desa</span>
            </div>
            <div class="struktur-card">
                <div class="struktur-avatar">📋</div>
                <h4>Sekretaris Desa</h4>
                <span class="struktur-role">Administrasi</span>
            </div>
            <div class="struktur-card">
                <div class="struktur-avatar">💰</div>
                <h4>Kaur Keuangan</h4>
                <span class="struktur-role">Keuangan</span>
            </div>
            <div class="struktur-card">
                <div class="struktur-avatar">🏗️</div>
                <h4>Kasi Pembangunan</h4>
                <span class="struktur-role">Pembangunan</span>
            </div>
            <div class="struktur-card">
                <div class="struktur-avatar">👥</div>
                <h4>Kasi Pelayanan</h4>
                <span class="struktur-role">Pelayanan Publik</span>
            </div>
            <div class="struktur-card">
                <div class="struktur-avatar">📊</div>
                <h4>Kasi Pemerintahan</h4>
                <span class="struktur-role">Pemerintahan</span>
            </div>
        </div>
    </div>
</div>

@endsection