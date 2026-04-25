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

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            color: var(--text);
            background: var(--white);
            margin: 0;
        }

        a {
            text-decoration: none;
        }

        p {
            margin: 0;
            line-height: 1.7;
            color: var(--text-muted);
            font-size: 0.93rem;
        }

        h3 {
            margin: 0 0 8px;
            color: var(--dark);
        }

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

        .hero-news-inner {
            position: relative;
            z-index: 1;
            max-width: 600px;
            margin: 0 auto;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
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

        .hero-news>.hero-news-inner>p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
        }

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

        .search-bar input:focus {
            border-color: var(--blue);
        }

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

        .search-bar select:focus {
            border-color: var(--blue);
        }

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

        .search-bar button:hover {
            opacity: .85;
        }

        /* ===== SECTION WRAPPER ===== */
        .section-wrap {
            padding: 48px 24px;
        }

        .section-wrap.bg-gray {
            background: var(--gray);
        }

        .section-inner {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* ===== SECTION HEADER ===== */
        .section-header {
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .section-header-left {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

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

        .see-all:hover {
            gap: 8px;
        }

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
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .card-featured-main h3 {
            color: white;
            font-size: 1.15rem;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .card-featured-main p {
            color: rgba(255, 255, 255, 0.75);
            position: relative;
            z-index: 1;
        }

        .card-featured-main .news-meta {
            color: rgba(255, 255, 255, 0.55);
        }

        .featured-side {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .card-featured-side {
            background: white;
            border: 1px solid var(--blue-border);
            border-radius: var(--radius);
            padding: 20px 22px;
            box-shadow: var(--shadow);
            flex: 1;
            transition: transform .2s, box-shadow .2s;
        }

        .card-featured-side:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(26, 86, 219, 0.12);
        }

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

        .latest-card h3 {
            font-size: 1.25rem;
        }

        .latest-card p {
            font-size: 0.96rem;
        }

        .latest-card .news-meta {
            margin-top: 4px;
        }

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

        .btn-read:hover {
            opacity: .85;
        }

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

        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 36px rgba(26, 86, 219, 0.13);
        }

        .news-card h3 {
            font-size: 1rem;
            margin: 0;
        }

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

        .news-card .read-link:hover {
            gap: 8px;
        }

        /* ===== PAGINATION ===== */
        .pagination-wrap {
            padding: 16px 24px 56px;
            display: flex;
            justify-content: center;
        }

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
            width: 40px;
            height: 40px;
            border: 1px solid var(--blue-border);
            border-radius: 8px;
            color: var(--text);
            font-size: 0.9rem;
            font-weight: 500;
            transition: all .2s;
            background: white;
        }

        .pagination a:hover,
        .pagination a.active {
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
            .featured-grid {
                grid-template-columns: 1fr;
            }

            .featured-side {
                flex-direction: row;
            }

            .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .section-wrap {
                padding: 36px 16px;
            }

            .featured-side {
                flex-direction: column;
            }

            .news-grid {
                grid-template-columns: 1fr;
            }

            .latest-card {
                padding: 24px 20px;
            }

            .search-bar {
                padding: 14px 16px;
                gap: 10px;
            }

            .search-bar input {
                min-width: 100%;
            }
        }
    </style>


    <!-- HERO -->
    <section class="hero-news">
        <div class="hero-news-inner">
            <span class="hero-badge">Desa Bluto, Kecamatan Bluto</span>
            <h1>Berita <span>Desa Bluto</span></h1>
            <p>Informasi kegiatan dan pengumuman terbaru dari Desa Bluto</p>
        </div>
    </section>


    <!-- SEARCH + FILTER -->
    <div class="search-wrap">
        <div class="search-bar">
            <input type="text" placeholder="🔍  Cari berita...">
            <select>
                <option>Semua Kategori</option>
                <option>Kegiatan Desa</option>
                <option>Pengumuman</option>
                <option>Bantuan Sosial</option>
                <option>Musyawarah</option>
            </select>
            <button>Cari</button>
        </div>
    </div>


    <!-- BERITA PILIHAN -->
    <div class="section-wrap" style="padding-top: 12px;">
        <div class="section-inner">
            <div class="section-header">
                <div class="section-header-left">
                    <span class="section-label">Sorotan</span>
                    <h2 class="section-title">Berita Pilihan</h2>
                </div>
            </div>
            <div class="featured-grid">
                <div class="card-featured-main">
                    <span class="news-cat">Musyawarah</span>
                    <h3>Musyawarah Desa Bluto untuk Rencana Pembangunan</h3>
                    <p>Kegiatan musyawarah desa dalam rangka membahas rencana pembangunan desa bersama masyarakat.</p>
                    <div class="news-meta">📅 12 Juni 2025</div>
                </div>
                <div class="featured-side">
                    <div class="card-featured-side">
                        <span class="news-cat">Bantuan Sosial</span>
                        <h3>Penyaluran BLT kepada Masyarakat</h3>
                        <p>Penyaluran bantuan langsung tunai kepada masyarakat kurang mampu.</p>
                        <div class="news-meta">📅 10 Juni 2025</div>
                    </div>
                    <div class="card-featured-side">
                        <span class="news-cat">Kegiatan Desa</span>
                        <h3>Kegiatan Gotong Royong Desa Bluto</h3>
                        <p>Masyarakat desa bersama-sama melakukan kerja bakti.</p>
                        <div class="news-meta">📅 8 Juni 2025</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- BERITA TERBARU -->
    <div class="section-wrap bg-gray">
        <div class="section-inner">
            <div class="section-header">
                <div class="section-header-left">
                    <span class="section-label">Terkini</span>
                    <h2 class="section-title">Berita Terbaru</h2>
                </div>
                <a class="see-all" href="/berita">Lihat Semua →</a>
            </div>
            <div class="latest-card">
                <span class="news-cat">Bantuan Sosial</span>
                <h3>Program Bantuan Sosial Desa Bluto</h3>
                <p>Pemerintah Desa Bluto menyalurkan bantuan sosial kepada masyarakat yang membutuhkan sebagai bentuk
                    kepedulian terhadap kesejahteraan warga desa.</p>
                <div class="news-meta">📅 14 Juni 2025 &nbsp;·&nbsp; 👤 Admin Desa</div>
                <a class="btn-read" href="/berita/detail">Baca Selengkapnya →</a>
            </div>
        </div>
    </div>


    <!-- GRID BERITA -->
    <div class="section-wrap">
        <div class="section-inner">
            <div class="section-header">
                <div class="section-header-left">
                    <span class="section-label">Semua Berita</span>
                    <h2 class="section-title">Berita Lainnya</h2>
                </div>
            </div>
            <div class="news-grid">
                <div class="news-card">
                    <span class="news-cat">Kesehatan</span>
                    <h3>Kegiatan Posyandu Rutin</h3>
                    <p>Kegiatan pelayanan kesehatan masyarakat desa yang dilaksanakan setiap bulan.</p>
                    <div class="news-meta">7 Juni 2025</div>
                    <a class="read-link" href="#">Baca →</a>
                </div>
                <div class="news-card">
                    <span class="news-cat">Infrastruktur</span>
                    <h3>Pembangunan Jalan Desa</h3>
                    <p>Peningkatan infrastruktur jalan desa untuk mendukung mobilitas masyarakat.</p>
                    <div class="news-meta">5 Juni 2025</div>
                    <a class="read-link" href="#">Baca →</a>
                </div>
                <div class="news-card">
                    <span class="news-cat">Musyawarah</span>
                    <h3>Musyawarah Pembangunan Desa</h3>
                    <p>Rapat desa membahas rencana pembangunan tahun anggaran berikutnya.</p>
                    <div class="news-meta">3 Juni 2025</div>
                    <a class="read-link" href="#">Baca →</a>
                </div>
                <div class="news-card">
                    <span class="news-cat">Pemberdayaan</span>
                    <h3>Kegiatan PKK Desa</h3>
                    <p>Kegiatan pemberdayaan kesejahteraan keluarga di lingkungan desa.</p>
                    <div class="news-meta">1 Juni 2025</div>
                    <a class="read-link" href="#">Baca →</a>
                </div>
                <div class="news-card">
                    <span class="news-cat">Kegiatan Desa</span>
                    <h3>Kerja Bakti Desa Bluto</h3>
                    <p>Masyarakat bersama-sama membersihkan lingkungan desa secara gotong royong.</p>
                    <div class="news-meta">29 Mei 2025</div>
                    <a class="read-link" href="#">Baca →</a>
                </div>
                <div class="news-card">
                    <span class="news-cat">Pemuda</span>
                    <h3>Kegiatan Karang Taruna</h3>
                    <p>Kegiatan pemuda desa dalam mendukung pembangunan masyarakat.</p>
                    <div class="news-meta">27 Mei 2025</div>
                    <a class="read-link" href="#">Baca →</a>
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
@endsection
