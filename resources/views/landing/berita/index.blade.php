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
            --dark: #0f172a;
            --gray: #f8fafc;
            --gray-mid: #f1f5f9;
            --gray-border: #e2e8f0;
            --text: #1e293b;
            --text-muted: #64748b;
            --white: #ffffff;
            --radius: 16px;
            --radius-sm: 10px;
            --shadow: 0 4px 24px rgba(99, 102, 241, 0.09);
            --shadow-md: 0 8px 32px rgba(99, 102, 241, 0.14);
            --shadow-lg: 0 16px 48px rgba(99, 102, 241, 0.20);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            background: var(--white);
            margin: 0;
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

        /* ===== HERO ===== */
        .hero-news {
            position: relative;
            background: linear-gradient(145deg, var(--primary-deeper) 0%, var(--primary-dark) 45%, var(--primary) 75%, #7c3aed 100%);
            padding: 88px 24px 80px;
            text-align: center;
            overflow: hidden;
        }

        .hero-news::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.07) 1px, transparent 1px);
            background-size: 34px 34px;
            pointer-events: none;
        }

        .hero-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.28;
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
            background: #0ea5e9;
            bottom: -80px;
            left: -60px;
        }

        .hero-news-inner {
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

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: rgba(255, 255, 255, 0.9);
            padding: 7px 18px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 20px;
            letter-spacing: 0.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .hero-badge::before {
            content: '📰';
            font-size: 13px;
        }

        .hero-news h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 5vw, 3.8rem);
            font-weight: 800;
            color: white;
            line-height: 1.18;
            margin: 0 0 14px;
            letter-spacing: -0.3px;
        }

        .hero-news h1 span {
            background: linear-gradient(90deg, #a5b4fc, #e0f2fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-news>.hero-news-inner>p {
            color: rgba(255, 255, 255, 0.75);
            font-size: 1rem;
            margin-bottom: 0;
        }

        /* ===== SEARCH BAR ===== */
        .search-wrap {
            background: var(--white);
            display: flex;
            justify-content: center;
            padding: 0 24px;
            position: relative;
            z-index: 10;
        }

        .search-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            background: white;
            border: 1px solid var(--primary-border);
            border-radius: var(--radius);
            padding: 14px 20px;
            box-shadow: var(--shadow-md);
            max-width: 700px;
            width: 100%;
            transform: translateY(-28px);
            transition: box-shadow .2s;
        }

        .search-bar:focus-within {
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .search-bar input {
            flex: 1;
            min-width: 180px;
            padding: 10px 16px;
            border: 1px solid var(--gray-border);
            border-radius: var(--radius-sm);
            font-size: 0.92rem;
            color: var(--text);
            outline: none;
            font-family: 'DM Sans', sans-serif;
            transition: border-color .2s;
            background: var(--gray);
        }

        .search-bar input:focus {
            border-color: var(--primary);
            background: white;
        }

        .search-bar input::placeholder {
            color: var(--text-muted);
        }

        .search-bar select {
            padding: 10px 16px;
            border: 1px solid var(--gray-border);
            border-radius: var(--radius-sm);
            font-size: 0.92rem;
            color: var(--text);
            outline: none;
            background: var(--gray);
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: border-color .2s;
        }

        .search-bar select:focus {
            border-color: var(--primary);
            background: white;
        }

        .search-bar button {
            padding: 10px 24px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 0.92rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            white-space: nowrap;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .search-bar button:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        /* ===== SECTION SHARED ===== */
        .section-wrap {
            padding: 56px 24px;
        }

        .section-wrap.bg-gray {
            background: var(--gray-mid);
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

        .see-all-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: var(--primary);
            font-size: 0.87rem;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: gap .2s;
        }

        .see-all-link:hover {
            gap: 9px;
        }

        /* ===== FEATURED GRID ===== */
        .featured-grid {
            display: grid;
            grid-template-columns: 3fr 2fr;
            gap: 20px;
        }

        .feat-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            z-index: 0;
        }

        .feat-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.2));
            z-index: 1;
        }

        /* Main featured card */
        .card-featured-main {
            background: none;
            border-radius: var(--radius);
            padding: 40px 36px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            min-height: 280px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: transform .25s, box-shadow .25s;
            text-decoration: none;
        }

        .card-featured-main:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .card-featured-main::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 24px 24px;
        }

        .card-featured-main::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.6) 0%, transparent 60%);
        }

        .card-featured-main .feat-inner {
            position: relative;
            z-index: 1;
        }

        .feat-cat {
            display: inline-block;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            font-size: 10.5px;
            font-weight: 700;
            padding: 3px 12px;
            border-radius: 999px;
            margin-bottom: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card-featured-main h3 {
            font-size: clamp(1.05rem, 2vw, 1.3rem);
            font-weight: 800;
            color: white;
            line-height: 1.4;
            margin-bottom: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .card-featured-main p {
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.87rem;
            margin-bottom: 14px;
        }

        .feat-meta {
            display: flex;
            align-items: center;
            gap: 6px;
            color: rgba(255, 255, 255, 0.52);
            font-size: 0.78rem;
        }

        /* Side featured cards */
        .featured-side {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .card-featured-side {
            background: white;
            border: 1px solid var(--primary-border);
            border-radius: var(--radius);
            padding: 22px 24px;
            box-shadow: var(--shadow);
            flex: 1;
            transition: transform .25s, box-shadow .25s, border-color .2s;
            display: block;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .card-featured-side::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--primary);
            border-radius: 4px 0 0 4px;
        }

        .card-featured-side:hover {
            transform: translateY(-3px) translateX(3px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
        }

        .card-featured-side .side-cat {
            display: inline-block;
            background: var(--primary-pale);
            color: var(--primary);
            font-size: 10px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 999px;
            margin-bottom: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card-featured-side h3 {
            font-size: 0.97rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.45;
            margin-bottom: 8px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .card-featured-side p {
            font-size: 0.85rem;
        }

        .side-meta {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* ===== LATEST / BERITA TERBARU ===== */
        .latest-card {
            background: white;
            border: 1px solid var(--primary-border);
            border-radius: var(--radius);
            padding: 36px 40px;
            box-shadow: var(--shadow);
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 24px;
            align-items: start;
            position: relative;
            overflow: hidden;
            transition: box-shadow .25s;
        }

        .latest-card:hover {
            box-shadow: var(--shadow-md);
        }

        .latest-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background: linear-gradient(to bottom, var(--primary), var(--accent));
        }

        .latest-body {
            flex: 1;
        }

        .latest-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--primary-pale);
            color: var(--primary);
            font-size: 11px;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 999px;
            margin-bottom: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .latest-card h3 {
            font-size: clamp(1.1rem, 2.5vw, 1.4rem);
            font-weight: 800;
            color: var(--dark);
            line-height: 1.4;
            margin-bottom: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .latest-card p {
            font-size: 0.96rem;
            margin-bottom: 16px;
        }

        .latest-meta {
            font-size: 0.82rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .btn-read {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary);
            color: white;
            padding: 11px 24px;
            border-radius: var(--radius-sm);
            font-size: 0.88rem;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all .2s;
        }

        .btn-read:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.35);
        }

        .latest-badge {
            background: var(--primary-pale);
            border: 1px solid var(--primary-border);
            border-radius: 12px;
            padding: 20px 18px;
            text-align: center;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .latest-badge-num {
            font-size: 2rem;
            font-weight: 900;
            color: var(--primary);
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1;
        }

        .latest-badge-label {
            font-size: 0.72rem;
            color: var(--text-muted);
            font-weight: 500;
            text-align: center;
            max-width: 60px;
            line-height: 1.3;
        }

        /* ===== NEWS GRID ===== */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .news-card {
            background: white;
            border: 1px solid var(--gray-border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);

            padding: 20px;
            /* TAMBAH INI */

            display: flex;
            flex-direction: column;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-border);
        }

        .news-card-thumb {
            height: 200px;

            margin: -20px -20px 16px -20px;
            /* sekarang valid karena parent punya padding */

            background: linear-gradient(135deg, var(--primary-pale), var(--primary-border));

            display: flex;
            align-items: center;
            justify-content: center;

            position: relative;
            overflow: hidden;
        }

        .news-card-thumb>div {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .news-card:hover .news-card-thumb {
            transform: scale(1.03);
        }

        .news-card-num {
            position: absolute;
            top: 10px;
            right: 12px;
            font-size: 0.7rem;
            font-weight: 800;
            color: rgba(99, 102, 241, 0.35);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .news-card-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .news-cat {
            display: inline-block;
            background: var(--primary-pale);
            color: var(--primary);
            font-size: 10px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 999px;
            width: fit-content;
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .news-card h3 {
            font-size: 0.97rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.45;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .news-card p {
            font-size: 0.85rem;
            flex: 1;
        }

        .news-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 14px;
            padding-top: 12px;
            border-top: 1px solid var(--gray-border);
        }

        .news-date {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        .read-link {
            color: var(--primary);
            font-size: 0.82rem;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: gap .2s;
        }

        .read-link:hover {
            gap: 8px;
        }

        /* ===== PAGINATION ===== */
        .pagination-wrap {
            margin-top: 44px;
            display: flex;
            justify-content: center;
        }

        /* Override Bootstrap pagination with our style */
        .pagination-wrap .pagination {
            gap: 6px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination-wrap .page-item .page-link {
            border: 1px solid var(--primary-border);
            color: var(--text);
            border-radius: 8px !important;
            font-size: 0.88rem;
            font-weight: 500;
            padding: 8px 14px;
            min-width: 40px;
            text-align: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all .2s;
            background: white;
        }

        .pagination-wrap .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .pagination-wrap .page-item:not(.active) .page-link:hover {
            background: var(--primary-pale);
            border-color: var(--primary-light);
            color: var(--primary);
        }

        .pagination-wrap .page-item.disabled .page-link {
            opacity: 0.45;
            pointer-events: none;
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

        @media (max-width: 640px) {
            .section-wrap {
                padding: 40px 16px;
            }

            .featured-side {
                flex-direction: column;
            }

            .news-grid {
                grid-template-columns: 1fr;
            }

            .latest-card {
                padding: 24px 22px;
                grid-template-columns: 1fr;
            }

            .latest-badge {
                flex-direction: row;
                justify-content: flex-start;
                padding: 14px 16px;
            }

            .card-featured-main {
                min-height: 220px;
                padding: 28px 24px;
            }

            .search-bar {
                padding: 12px 14px;
                gap: 8px;
            }

            .search-bar input {
                min-width: 100%;
            }
        }
    </style>


    {{-- ================= HERO ================= --}}
    <section class="hero-news">
        <div class="hero-orb hero-orb-a"></div>
        <div class="hero-orb hero-orb-b"></div>
        <div class="hero-news-inner">
            <h1>Berita <span>Desa</span></h1>
            <p>Informasi terbaru seputar kegiatan, pengumuman, dan program Desa Bluto</p>
        </div>
    </section>


    {{-- ================= SEARCH ================= --}}
    <div
        style="background: white; padding: 36px 24px 28px; display: flex; flex-direction: column; align-items: center; gap: 16px;">

        <form method="GET" action="{{ route('public.berita.index') }}"
            style="display: flex; flex-direction: column; align-items: center; gap: 14px; width: 100%; max-width: 580px;">

            {{-- Input pill --}}
            <div style="position: relative; width: 100%;">
                <div style="display: flex; align-items: center; border: 1px solid #dfe1e5; border-radius: 24px; padding: 11px 20px; gap: 12px; background: white; transition: box-shadow .2s, border-color .2s;"
                    onfocusin="this.style.boxShadow='0 2px 10px rgba(0,0,0,0.12)'; this.style.borderColor='transparent';"
                    onfocusout="this.style.boxShadow='none'; this.style.borderColor='#dfe1e5';">

                    {{-- Search icon --}}
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#9aa0a6" stroke-width="2"
                        style="flex-shrink:0;">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" />
                    </svg>

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita desa..."
                        style="flex: 1; border: none; background: transparent; font-size: 15px; color: #202124; outline: none; font-family: 'DM Sans', sans-serif; min-width: 0;">
                </div>
            </div>
        </form>
    </div>


    {{-- ================= FEATURED ================= --}}
    <div class="section-wrap" style="padding-top: 16px;">
        <div class="section-inner">
            <div class="section-header-row">
                <div>

                    <h2 class="section-title">Berita Utama</h2>
                </div>
            </div>

            <div class="featured-grid">

                {{-- MAIN --}}
                @if ($featured->count())
                    @php $main = $featured[0]; @endphp

                    <a href="{{ route('public.berita.show', $main->slug) }}" class="card-featured-main">

                        <div class="feat-bg"
                            style="
                background-image: url('{{ $main->image ? asset('storage/' . $main->image) : 'https://via.placeholder.com/800x600' }}');
            ">
                        </div>

                        <div class="feat-overlay"></div>

                        <div class="feat-inner">
                            <span class="feat-cat">Unggulan</span>
                            <h3>{{ $main->title }}</h3>
                            <p>{{ Str::limit(strip_tags($main->content), 120) }}</p>
                            <div class="feat-meta">
                                {{ $main->created_at->format('d M Y') }}
                                &nbsp;•&nbsp;
                                {{ $main->author->name ?? 'Admin' }}
                            </div>
                        </div>

                    </a>
                @endif

                {{-- SIDE --}}
                <div class="featured-side">
                    @foreach ($featured->skip(1) as $item)
                        <a href="{{ route('public.berita.show', $item->slug) }}" class="card-featured-side">
                            <span class="side-cat">📌 Pilihan</span>
                            <h3>{{ $item->title }}</h3>
                            <p>{{ Str::limit(strip_tags($item->content), 85) }}</p>
                            <div class="side-meta">
                                {{ $item->created_at->format('d M Y') }}
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        </div>
    </div>


    {{-- ================= LATEST ================= --}}
    <div class="section-wrap bg-gray">
        <div class="section-inner">
            <div class="section-header-row">
                <div>
                    <div class="section-label-pill">Terkini</div>
                    <h2 class="section-title">Berita Terbaru</h2>
                </div>
            </div>

            @if ($latest)
                <div class="latest-card">
                    <div class="latest-body">
                        <span class="latest-tag">Berita Terbaru</span>
                        <h3>{{ $latest->title }}</h3>
                        <p>{{ Str::limit(strip_tags($latest->content), 200) }}</p>
                        <div class="latest-meta">
                            {{ $latest->created_at->format('d M Y') }}
                            &nbsp;•&nbsp;
                            {{ $latest->author->name ?? 'Admin' }}
                        </div>
                        <a href="{{ route('public.berita.show', $latest->slug) }}" class="btn-read">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>


    {{-- ================= GRID SEMUA BERITA ================= --}}
    <div class="section-wrap">
        <div class="section-inner">
            <div class="section-header-row">
                <div>
                    <h2 class="section-title">Semua Berita</h2>
                </div>
                <span style="font-size:0.85rem; color:var(--text-muted);">
                    {{ $news->total() }} berita ditemukan
                </span>
            </div>

            <div class="news-grid">
                @foreach ($news as $index => $item)
                    <div class="news-card">
                        <div class="news-card-thumb">

                            @if ($item->image)
                                <div
                                    style="
                                width:100%;
                                height:100%;
                                background-image:url('{{ asset('storage/' . $item->image) }}');
                                background-size:cover;
                                background-position:center;
                                ">
                                </div>
                            @else
                                📰
                            @endif

                            <span class="news-card-num">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>

                        </div>
                        <div class="news-card-body">
                            <h3>{{ $item->title }}</h3>
                            <p>{{ Str::limit(strip_tags($item->content), 100) }}</p>
                            <div class="news-card-footer">
                                <span class="news-date">{{ $item->created_at->format('d M Y') }}</span>
                                <a href="{{ route('public.berita.show', $item->slug) }}" class="read-link">
                                    Baca →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination-wrap mt-4">
                {{ $news->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
