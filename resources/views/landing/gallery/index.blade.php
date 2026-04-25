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
            --shadow: 0 2px 16px rgba(99, 102, 241, 0.07);
            --shadow-md: 0 6px 28px rgba(99, 102, 241, 0.13);
            --shadow-lg: 0 14px 44px rgba(99, 102, 241, 0.20);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            margin: 0;
            background: var(--white);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        p {
            margin: 0;
            line-height: 1.75;
            color: var(--text-muted);
            font-size: 0.93rem;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
        }

        /* ================================================================
           HERO
        ================================================================ */
        .hero-gallery {
            position: relative;
            background-image: url('/images/balai/desa.jpg');
            background-size: cover;
            /* isi penuh tanpa distorsi */
            background-position: center;
            /* fokus tengah */
            background-repeat: no-repeat;

            padding: 100px 24px;
            text-align: center;
            color: white;
            overflow: hidden;
        }

        .hero-gallery::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.06) 1px, transparent 1px);
            background-size: 34px 34px;
            pointer-events: none;
        }

        .hero-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(88px);
            opacity: 0.22;
            pointer-events: none;
        }

        .hero-orb-a {
            width: 420px;
            height: 420px;
            background: #7c3aed;
            top: -120px;
            right: -80px;
        }

        .hero-orb-b {
            width: 320px;
            height: 320px;
            background: var(--sky);
            bottom: -80px;
            left: -60px;
        }

        .hero-gallery-inner {
            position: relative;
            z-index: 1;
            max-width: 600px;
            margin: 0 auto;
            animation: fadeUp 0.7s ease forwards;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .hero-gallery h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 5vw, 3.6rem);
            font-weight: 800;
            color: white;
            margin: 0 0 12px;
            line-height: 1.18;
            letter-spacing: -0.3px;
        }

        .hero-gallery h1 span {
            background: linear-gradient(90deg, #a5b4fc, #e0f2fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-gallery p {
            color: rgba(255, 255, 255, 0.72);
            font-size: 1rem;
            margin: 0;
        }

        /* ================================================================
           SEARCH — Google style
        ================================================================ */
        .search-wrap {
            background: white;
            padding: 36px 24px 28px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }

        .search-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
            width: 100%;
            max-width: 560px;
        }

        .search-pill {
            display: flex;
            align-items: center;
            border: 1px solid #dfe1e5;
            border-radius: 24px;
            padding: 11px 20px;
            gap: 12px;
            background: white;
            width: 100%;
            transition: box-shadow .2s, border-color .2s;
        }

        .search-pill:focus-within {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.12);
            border-color: transparent;
        }

        .search-pill input {
            flex: 1;
            border: none;
            background: transparent;
            font-size: 15px;
            color: #202124;
            outline: none;
            font-family: 'DM Sans', sans-serif;
            min-width: 0;
        }

        .search-pill input::placeholder {
            color: #9aa0a6;
        }

        .search-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .search-btn {
            background: #f8f9fa;
            border: 1px solid #f8f9fa;
            border-radius: 6px;
            padding: 9px 18px;
            font-size: 13px;
            color: #3c4043;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: all .15s;
            white-space: nowrap;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .search-btn:hover {
            border-color: #dadce0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* ================================================================
           SECTION
        ================================================================ */
        .section-wrap {
            padding: 56px 24px;
        }

        .section-inner {
            max-width: 1100px;
            margin: 0 auto;
        }

        .section-header-row {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 28px;
        }

        .section-label-pill {
            display: inline-block;
            background: var(--primary-pale);
            color: var(--primary);
            font-size: 10.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 4px 14px;
            border-radius: 999px;
            margin-bottom: 8px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .section-title {
            font-size: clamp(1.3rem, 2.5vw, 1.7rem);
            font-weight: 800;
            color: var(--dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
            letter-spacing: -0.2px;
        }

        .total-label {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        /* ================================================================
           GALLERY GRID
        ================================================================ */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .gallery-card {
            background: white;
            border: 1px solid var(--gray-border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            cursor: pointer;
            transition: transform .25s, box-shadow .25s, border-color .2s;
            display: flex;
            flex-direction: column;
        }

        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-border);
        }

        .gallery-thumb {
            height: 210px;
            background-size: cover;
            background-position: center;
            background-color: var(--primary-pale);
            position: relative;
            overflow: hidden;
            transition: transform .35s ease;
        }

        .gallery-card:hover .gallery-thumb {
            transform: scale(1.04);
        }

        .gallery-thumb-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.45) 0%, transparent 55%);
            opacity: 0;
            transition: opacity .25s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gallery-card:hover .gallery-thumb-overlay {
            opacity: 1;
        }

        .overlay-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            border: 1.5px solid rgba(255, 255, 255, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }

        .overlay-icon svg {
            width: 20px;
            height: 20px;
            stroke: white;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .gallery-info {
            padding: 16px 18px 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .gallery-info h4 {
            font-size: 0.96rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.4;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .gallery-meta {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: auto;
            padding-top: 10px;
            border-top: 1px solid var(--gray-border);
        }

        .gallery-meta svg {
            width: 13px;
            height: 13px;
            stroke: var(--text-muted);
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }

        /* ================================================================
           EMPTY STATE
        ================================================================ */
        .empty-state {
            text-align: center;
            padding: 72px 24px;
            grid-column: 1 / -1;
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            background: var(--primary-pale);
            border: 1px solid var(--primary-border);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .empty-icon svg {
            width: 28px;
            height: 28px;
            stroke: var(--primary);
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .empty-state h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .empty-state p {
            font-size: 0.9rem;
        }

        /* ================================================================
           PAGINATION
        ================================================================ */
        /* ===== PAGINATION GALLERY FIX ===== */

        /* wrapper */
        .pagination-wrap {
            margin-top: 44px;
            display: flex;
            justify-content: center;
        }

        /* reset pagination */
        .pagination-wrap .pagination {
            list-style: none;
            padding: 0;
            margin: 0;

            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: center;
        }

        /* tombol */
        .pagination-wrap .page-link {
            display: flex;
            align-items: center;
            justify-content: center;

            min-width: 42px;
            height: 42px;

            background: white !important;
            color: var(--text) !important;

            border: 1px solid var(--primary-border) !important;
            border-radius: 10px !important;

            font-size: 0.85rem;
            font-weight: 600;

            transition: all 0.2s ease;
        }

        /* hover */
        .pagination-wrap .page-link:hover {
            background: var(--primary-pale) !important;
            color: var(--primary) !important;
            border-color: var(--primary-light) !important;
        }

        /* active */
        .pagination-wrap .page-item.active .page-link {
            background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
            color: white !important;
            border: none !important;
            box-shadow: 0 6px 18px rgba(99, 102, 241, 0.35);
        }

        /* disabled */
        .pagination-wrap .page-item.disabled .page-link {
            opacity: 0.4;
            pointer-events: none;
        }

        /* HAPUS TEXT */
        .pagination-wrap p {
            display: none;
        }

        /* ================================================================
           LIGHTBOX
        ================================================================ */
        .lightbox {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.82);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            padding: 20px;
            backdrop-filter: blur(4px);
        }

        .lightbox.open {
            display: flex;
            animation: lbFade .2s ease;
        }

        @keyframes lbFade {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        .lightbox-inner {
            background: white;
            border-radius: var(--radius);
            max-width: 540px;
            width: 100%;
            box-shadow: 0 24px 64px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: lbUp .25s ease;
        }

        @keyframes lbUp {
            from {
                transform: translateY(20px);
                opacity: 0
            }

            to {
                transform: translateY(0);
                opacity: 1
            }
        }

        .lightbox-img {
            height: 280px;
            background-size: cover;
            background-position: center;
            background-color: var(--primary-pale);
            position: relative;
        }

        .lightbox-close {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.4);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s;
        }

        .lightbox-close:hover {
            background: rgba(0, 0, 0, 0.65);
        }

        .lightbox-close svg {
            width: 16px;
            height: 16px;
            stroke: white;
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
        }

        .lightbox-body {
            padding: 24px 26px 28px;
        }

        .lightbox-body h3 {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin-bottom: 8px;
        }

        .lightbox-body p {
            font-size: 0.88rem;
        }

        .lightbox-footer {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .lb-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-size: 0.87rem;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all .2s;
        }

        .lb-btn-primary:hover {
            background: var(--primary-dark);
        }

        .lb-btn-ghost {
            display: inline-flex;
            align-items: center;
            background: var(--gray);
            color: var(--text-muted);
            padding: 10px 18px;
            border-radius: var(--radius-sm);
            font-size: 0.87rem;
            font-weight: 600;
            border: 1px solid var(--gray-border);
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all .2s;
        }

        .lb-btn-ghost:hover {
            background: var(--gray-mid);
            color: var(--text);
        }

        /* ================================================================
           RESPONSIVE
        ================================================================ */
        @media (max-width: 900px) {
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 560px) {
            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .section-wrap {
                padding: 40px 16px;
            }

            .lightbox-img {
                height: 220px;
            }
        }
    </style>


    {{-- ================================================================
     HERO
================================================================ --}}
    <section class="hero-gallery">
        <div class="hero-orb hero-orb-a"></div>
        <div class="hero-orb hero-orb-b"></div>
        <div class="hero-gallery-inner">
            <h1>Galeri Desa Bluto</h1>
            <p>Dokumentasi kegiatan dan momen bersama masyarakat desa</p>
        </div>
    </section>


    {{-- ================================================================
     SEARCH
================================================================ --}}
    <div class="search-wrap">
        <form method="GET" action="{{ route('public.gallery.index') }}" class="search-form">
            <div class="search-pill">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#9aa0a6" stroke-width="2"
                    style="flex-shrink:0;">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.35-4.35" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari galeri...">
            </div>
        </form>
    </div>


    {{-- ================================================================
     GALLERY GRID
================================================================ --}}
    <div class="section-wrap">
        <div class="section-inner">

            <div class="section-header-row">
                <div>
                    <div class="section-label-pill">Dokumentasi</div>
                    <h2 class="section-title">Semua Galeri</h2>
                </div>
                <span class="total-label">{{ $galleries->total() }} foto ditemukan</span>
            </div>

            <div class="gallery-grid">
                @forelse ($galleries as $item)
                    @php
                        $img = $item->images->first();
                        $url = $img ? asset('storage/' . $img->image) : '';
                    @endphp

                    <div class="gallery-card"
                        onclick="openLightbox('{{ addslashes($item->title) }}', '{{ $item->created_at->format('d M Y') }}', '{{ $url }}', '{{ route('public.gallery.show', $item->id) }}')">

                        <div class="gallery-thumb" style="background-image: url('{{ $url }}');">
                            <div class="gallery-thumb-overlay">
                                <div class="overlay-icon">
                                    <svg viewBox="0 0 24 24">
                                        <circle cx="11" cy="11" r="8" />
                                        <path d="m21 21-4.35-4.35" />
                                        <line x1="11" y1="8" x2="11" y2="14" />
                                        <line x1="8" y1="11" x2="14" y2="11" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-info">
                            <h4>{{ $item->title }}</h4>
                            <div class="gallery-meta">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" />
                                    <line x1="8" y1="2" x2="8" y2="6" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                                {{ $item->created_at->format('d M Y') }}
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                <circle cx="8.5" cy="8.5" r="1.5" />
                                <polyline points="21 15 16 10 5 21" />
                            </svg>
                        </div>
                        <h3>Belum ada galeri</h3>
                        <p>Galeri foto akan segera ditampilkan di sini.</p>
                    </div>
                @endforelse
            </div>

            <div class="pagination-wrap">
                {{ $galleries->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>


    {{-- ================================================================
     LIGHTBOX
================================================================ --}}
    <div class="lightbox" id="lightbox" onclick="closeLightbox(event)">
        <div class="lightbox-inner">
            <div class="lightbox-img" id="lightbox-img">
                <button class="lightbox-close" onclick="forceClose()">
                    <svg viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
            <div class="lightbox-body">
                <h3 id="lightbox-title"></h3>
                <p id="lightbox-date"></p>
                <div class="lightbox-footer">
                    <a id="lightbox-link" href="#" class="lb-btn-primary">
                        Lihat Detail &rarr;
                    </a>
                    <button class="lb-btn-ghost" onclick="forceClose()">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function openLightbox(title, date, image, link) {
            document.getElementById('lightbox-title').innerText = title;
            document.getElementById('lightbox-date').innerText = date;
            document.getElementById('lightbox-img').style.backgroundImage = `url(${image})`;
            document.getElementById('lightbox-link').href = link;
            document.getElementById('lightbox').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox(e) {
            if (e.target.id === 'lightbox') forceClose();
        }

        function forceClose() {
            document.getElementById('lightbox').classList.remove('open');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') forceClose();
        });
    </script>
@endsection
