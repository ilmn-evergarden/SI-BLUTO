@extends('layouts.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Outfit:wght@300;400;500;600;700;800&display=swap');

        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-pale: #eff6ff;
            --primary-border: #bfdbfe;
            --accent: #0ea5e9;
            --dark: #0f172a;
            --ink: #1e293b;
            --ink-light: #475569;
            --ink-faint: #94a3b8;
            --surface: #ffffff;
            --surface-2: #f8fafc;
            --surface-3: #f1f5f9;
            --border: #e2e8f0;
            --border-strong: #cbd5e1;
            --radius: 14px;
            --radius-sm: 8px;
            --shadow-sm: 0 1px 4px rgba(15,23,42,0.06), 0 2px 8px rgba(15,23,42,0.04);
            --shadow: 0 2px 12px rgba(15,23,42,0.08), 0 4px 24px rgba(15,23,42,0.05);
            --shadow-lg: 0 8px 40px rgba(15,23,42,0.12), 0 2px 8px rgba(15,23,42,0.06);
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            color: var(--ink);
            background: var(--surface);
            margin: 0;
            -webkit-font-smoothing: antialiased;
        }

        a { text-decoration: none; color: inherit; }
        p { margin: 0; line-height: 1.75; }
        h1, h2, h3, h4 { margin: 0; }

        /* ===== BREADCRUMB ===== */
        .breadcrumb-bar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 24px;
        }

        .breadcrumb-inner {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: var(--ink-faint);
            font-weight: 500;
            height: 48px;
        }

        .breadcrumb-inner a {
            color: var(--primary);
            font-weight: 600;
            transition: color .2s;
        }

        .breadcrumb-inner a:hover { color: var(--primary-dark); }

        .breadcrumb-sep {
            color: var(--border-strong);
            font-size: 0.75rem;
            user-select: none;
        }

        .breadcrumb-current {
            color: var(--ink);
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 320px;
        }

        /* ===== ARTICLE HEADER ===== */
        .article-header {
            background: var(--dark);
            padding: 72px 24px 64px;
            position: relative;
            overflow: hidden;
        }

        .article-header::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0c2340 100%);
            opacity: 0.95;
        }

        .article-header-noise {
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
            opacity: 0.4;
            pointer-events: none;
            z-index: 1;
        }

        .article-header-line {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            z-index: 3;
        }

        .article-header-inner {
            max-width: 780px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
            animation: fadeUp 0.6s ease forwards;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .article-category {
            display: inline-block;
            background: var(--primary);
            color: white;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 4px;
            margin-bottom: 24px;
        }

        .article-header h1 {
            font-family: 'Lora', serif;
            font-size: clamp(1.75rem, 3.5vw, 2.75rem);
            font-weight: 700;
            color: white;
            line-height: 1.3;
            margin-bottom: 28px;
            letter-spacing: -0.3px;
        }

        .article-meta-bar {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 7px;
            color: rgba(255,255,255,0.6);
            font-size: 0.82rem;
            font-weight: 400;
        }

        .meta-item svg {
            flex-shrink: 0;
            opacity: 0.7;
        }

        .meta-divider {
            width: 1px;
            height: 14px;
            background: rgba(255,255,255,0.2);
        }

        /* ===== FEATURED IMAGE ===== */
        .article-image-wrap {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 24px;
            transform: translateY(-40px);
            position: relative;
            z-index: 5;
        }

        .article-image-wrap img {
            width: 100%;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            display: block;
            max-height: 500px;
            object-fit: cover;
        }

        /* ===== ARTICLE BODY ===== */
        .article-body-wrap {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 24px 80px;
        }

        .article-body-wrap.no-image {
            padding-top: 48px;
        }

        .article-layout {
            display: grid;
            grid-template-columns: 1fr 256px;
            gap: 40px;
            align-items: start;
        }

        /* ===== ARTICLE CONTENT ===== */
        .article-content {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 44px 48px;
            box-shadow: var(--shadow-sm);
            line-height: 1.9;
        }

        .article-content h2,
        .article-content h3 {
            font-family: 'Lora', serif;
            color: var(--dark);
            margin: 36px 0 16px;
            font-weight: 700;
        }

        .article-content h2 { font-size: 1.35rem; }
        .article-content h3 { font-size: 1.15rem; }

        .article-content p {
            margin-bottom: 20px;
            color: var(--ink);
            font-size: 0.975rem;
            line-height: 1.9;
            font-weight: 400;
        }

        .article-content p:last-child { margin-bottom: 0; }

        .article-content ul,
        .article-content ol {
            padding-left: 22px;
            margin-bottom: 20px;
        }

        .article-content li {
            margin-bottom: 8px;
            color: var(--ink);
            font-size: 0.975rem;
        }

        .article-content blockquote {
            border-left: 3px solid var(--primary);
            padding: 18px 24px;
            margin: 28px 0;
            background: var(--primary-pale);
            border-radius: 0 10px 10px 0;
            font-style: italic;
            color: var(--primary-dark);
            font-size: 1rem;
            font-family: 'Lora', serif;
        }

        .article-content img {
            border-radius: var(--radius-sm);
            max-width: 100%;
            margin: 20px 0;
        }

        .article-content a {
            color: var(--primary);
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        /* Gallery link box */
        .gallery-box {
            margin-top: 28px;
            border: 1px solid var(--primary-border);
            border-radius: var(--radius-sm);
            padding: 18px 22px;
            background: var(--primary-pale);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .gallery-box-label {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 2px;
        }

        .gallery-box-sub {
            font-size: 0.78rem;
            color: var(--ink-light);
        }

        .btn-gallery {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--primary);
            color: white;
            padding: 9px 18px;
            border-radius: var(--radius-sm);
            font-size: 0.83rem;
            font-weight: 600;
            white-space: nowrap;
            transition: background .2s, transform .2s;
        }

        .btn-gallery:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        /* Article actions bar */
        .article-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--surface-3);
            border: 1px solid var(--border);
            color: var(--ink);
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            font-weight: 600;
            transition: all .2s;
        }

        .btn-back:hover {
            background: var(--primary-pale);
            border-color: var(--primary-border);
            color: var(--primary);
        }

        .btn-back svg { flex-shrink: 0; }

        .share-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .share-label {
            font-size: 0.8rem;
            color: var(--ink-faint);
            font-weight: 500;
            margin-right: 4px;
        }

        .share-btn {
            width: 36px;
            height: 36px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 1px solid var(--border);
            background: var(--surface);
            transition: all .2s;
            color: var(--ink-light);
        }

        .share-btn:hover {
            background: var(--primary-pale);
            border-color: var(--primary-border);
            color: var(--primary);
        }

        /* ===== SIDEBAR ===== */
        .article-sidebar {
            display: flex;
            flex-direction: column;
            gap: 16px;
            position: sticky;
            top: 80px;
        }

        .sidebar-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 22px 20px;
            box-shadow: var(--shadow-sm);
        }

        .sidebar-section-title {
            font-size: 9.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--ink-faint);
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        .info-row {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .info-item label {
            font-size: 0.72rem;
            color: var(--ink-faint);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .info-item span {
            font-size: 0.88rem;
            color: var(--dark);
            font-weight: 600;
        }

        .info-divider {
            height: 1px;
            background: var(--border);
        }

        .sidebar-back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--primary);
            color: white;
            padding: 12px 20px;
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            font-weight: 600;
            transition: all .2s;
            text-align: center;
        }

        .sidebar-back:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
        }

        /* ===== RELATED ===== */
        .related-section {
            padding: 72px 24px 88px;
            background: var(--surface-2);
            border-top: 1px solid var(--border);
        }

        .related-inner {
            max-width: 1000px;
            margin: 0 auto;
        }

        .related-header {
            margin-bottom: 36px;
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 16px;
        }

        .related-eyebrow {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .related-title {
            font-family: 'Lora', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark);
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .related-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: transform .25s, box-shadow .25s, border-color .2s;
            display: flex;
            flex-direction: column;
        }

        .related-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow);
            border-color: var(--primary-border);
        }

        .related-thumb {
            height: 8px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
        }

        .related-body {
            padding: 22px 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .related-body h4 {
            font-family: 'Lora', serif;
            font-size: 0.98rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.45;
            margin-bottom: 10px;
        }

        .related-body p {
            font-size: 0.83rem;
            color: var(--ink-light);
            flex: 1;
            line-height: 1.65;
        }

        .related-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 14px;
            margin-top: 14px;
            border-top: 1px solid var(--border);
        }

        .related-date {
            font-size: 0.75rem;
            color: var(--ink-faint);
            font-weight: 500;
        }

        .related-link {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: gap .2s;
        }

        .related-link:hover { gap: 8px; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 860px) {
            .article-layout {
                grid-template-columns: 1fr;
            }

            .article-sidebar {
                position: static;
            }

            .article-content {
                padding: 28px 26px;
            }

            .related-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .article-header { padding: 52px 20px 48px; }
            .article-body-wrap { padding: 0 16px 60px; }
            .article-image-wrap { padding: 0 16px; }
            .related-section { padding: 52px 16px 64px; }
            .related-grid { grid-template-columns: 1fr; }
            .article-content { padding: 22px 18px; font-size: 0.94rem; }
            .breadcrumb-bar { padding: 0 16px; }
            .article-header h1 { font-size: 1.6rem; }
            .related-header { flex-direction: column; align-items: flex-start; }
        }
    </style>

    <div class="article-page">

        {{-- ===== BREADCRUMB ===== --}}
        <div class="breadcrumb-bar">
            <div class="breadcrumb-inner">
                <a href="/">Beranda</a>
                <span class="breadcrumb-sep">›</span>
                <a href="{{ route('public.berita.index') }}">Berita</a>
                <span class="breadcrumb-sep">›</span>
                <span class="breadcrumb-current">{{ $news->title }}</span>
            </div>
        </div>

        {{-- ===== ARTICLE HEADER ===== --}}
        <div class="article-header">
            <div class="article-header-noise"></div>
            <div class="article-header-line"></div>
            <div class="article-header-inner">
                <span class="article-category">Berita Desa</span>
                <h1>{{ $news->title }}</h1>
                <div class="article-meta-bar">
                    <div class="meta-item">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        {{ $news->created_at->format('d M Y') }}
                    </div>
                    <div class="meta-divider"></div>
                    <div class="meta-item">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                        {{ $news->author->name ?? 'Admin' }}
                    </div>
                    <div class="meta-divider"></div>
                    <div class="meta-item">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 22V12h6v10"/></svg>
                        Pemerintah Desa Bluto
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== FEATURED IMAGE ===== --}}
        @if ($news->image)
            <div class="article-image-wrap">
                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" loading="lazy">
            </div>
        @endif

        {{-- ===== ARTICLE BODY ===== --}}
        <div class="article-body-wrap {{ !$news->image ? 'no-image' : '' }}">
            <div class="article-layout">

                {{-- Content --}}
                <div>
                    <div class="article-content">
                        {!! $news->content !!}
                    </div>

                    @if ($news->gallery)
                        <div class="gallery-box">
                            <div>
                                <div class="gallery-box-label">Dokumentasi Tersedia</div>
                                <div class="gallery-box-sub">Lihat galeri foto terkait berita ini</div>
                            </div>
                            <a href="{{ route('public.gallery.show', $news->gallery->id) }}" class="btn-gallery">
                                Lihat Galeri
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    @endif

                    <div class="article-actions">
                        <a href="{{ route('public.berita.index') }}" class="btn-back">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                            Kembali ke Berita
                        </a>
                        <div class="share-group">
                            <span class="share-label">Bagikan:</span>
                            <a class="share-btn"
                                href="https://wa.me/?text={{ urlencode($news->title . ' - ' . url()->current()) }}"
                                target="_blank" title="WhatsApp">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </a>
                            <a class="share-btn"
                                href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                target="_blank" title="Facebook">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <button class="share-btn"
                                onclick="navigator.clipboard.writeText(window.location.href).then(()=>alert('Link disalin!'))"
                                title="Salin Link">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <aside class="article-sidebar">
                    <div class="sidebar-card">
                        <div class="sidebar-section-title">Info Artikel</div>
                        <div class="info-row">
                            <div class="info-item">
                                <label>Tanggal Terbit</label>
                                <span>{{ $news->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="info-divider"></div>
                            <div class="info-item">
                                <label>Penulis</label>
                                <span>{{ $news->author->name ?? 'Admin' }}</span>
                            </div>
                            <div class="info-divider"></div>
                            <div class="info-item">
                                <label>Sumber</label>
                                <span>Pemerintah Desa Bluto</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('public.berita.index') }}" class="sidebar-back">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Lihat Semua Berita
                    </a>
                </aside>

            </div>
        </div>

    </div>{{-- end article-page --}}

    {{-- ===== RELATED ===== --}}
    @if ($related->count())
        <section class="related-section">
            <div class="related-inner">
                <div class="related-header">
                    <div>
                        <div class="related-eyebrow">Baca Juga</div>
                        <h2 class="related-title">Berita Lainnya</h2>
                    </div>
                </div>

                <div class="related-grid">
                    @foreach ($related as $item)
                        <a href="{{ route('public.berita.show', $item->slug) }}" class="related-card">
                            <div class="related-thumb"></div>
                            <div class="related-body">
                                <h4>{{ $item->title }}</h4>
                                <p>{{ Str::limit(strip_tags($item->content), 100) }}</p>
                                <div class="related-footer">
                                    <span class="related-date">{{ $item->created_at->format('d M Y') }}</span>
                                    <span class="related-link">
                                        Baca
                                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection