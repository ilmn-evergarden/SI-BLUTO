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
            --shadow-md: 0 6px 28px rgba(99, 102, 241, 0.12);
            --shadow-lg: 0 14px 44px rgba(99, 102, 241, 0.18);
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
            line-height: 1.8;
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
        }

        ul {
            margin: 0;
            padding-left: 20px;
        }

        ul li {
            margin-bottom: 10px;
            line-height: 1.7;
            color: var(--text-muted);
            font-size: 0.94rem;
        }

        /* ================================================================
       HERO
    ================================================================ */
        .hero-profil {
            position: relative;
            background-image: url('/images/balai/desa.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            padding: 96px 24px 88px;
            text-align: center;
            overflow: hidden;
        }

        .hero-profil::before {
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

        .hero-orb-1 {
            width: 460px;
            height: 460px;
            background: #7c3aed;
            top: -120px;
            right: -80px;
        }

        .hero-orb-2 {
            width: 320px;
            height: 320px;
            background: var(--sky);
            bottom: -80px;
            left: -60px;
        }

        .hero-profil-inner {
            position: relative;
            z-index: 1;
            max-width: 640px;
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

        .hero-profil h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 5vw, 3.6rem);
            font-weight: 800;
            color: white;
            margin: 0 0 14px;
            line-height: 1.18;
            letter-spacing: -0.3px;
        }

        .hero-profil h1 span {
            background: linear-gradient(90deg, #a5b4fc, #e0f2fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-profil>.hero-profil-inner>p {
            color: rgba(255, 255, 255, 0.72);
            font-size: 1rem;
            margin: 0;
        }

        /* ================================================================
       SHARED SECTION
    ================================================================ */
        .section-wrap {
            padding: 72px 24px;
        }

        .section-wrap.bg-gray {
            background: var(--gray-mid);
        }

        .section-wrap.bg-dark {
            background: linear-gradient(145deg, var(--primary-deeper) 0%, var(--primary-dark) 50%, #5b21b6 100%);
        }

        .section-inner {
            max-width: 960px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-label {
            display: inline-block;
            background: var(--primary-pale);
            color: var(--primary);
            font-size: 10.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 5px 16px;
            border-radius: 999px;
            margin-bottom: 12px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .section-label.light {
            background: rgba(255, 255, 255, 0.14);
            color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            font-weight: 800;
            color: var(--dark);
            margin: 0;
        }

        .section-title.light {
            color: white;
        }

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
            background: white;
            border: 1px solid var(--gray-border);
            border-left: 4px solid var(--primary);
            border-radius: var(--radius);
            padding: 36px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .tentang-main h3 {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .tentang-main p {
            font-size: 0.95rem;
        }

        .tentang-divider {
            height: 1px;
            background: var(--gray-border);
        }

        .tentang-side {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .info-chip {
            background: white;
            border: 1px solid var(--gray-border);
            border-radius: var(--radius-sm);
            padding: 16px 20px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 14px;
            transition: transform .2s, box-shadow .2s, border-color .2s;
        }

        .info-chip:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-border);
        }

        .chip-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--primary-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* SVG icon inside chip */
        .chip-icon svg {
            width: 18px;
            height: 18px;
            stroke: var(--primary);
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .chip-body label {
            font-size: 0.72rem;
            color: var(--text-muted);
            display: block;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 3px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .chip-body span {
            font-size: 0.96rem;
            font-weight: 700;
            color: var(--dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* ================================================================
       SEJARAH
    ================================================================ */
        .sejarah-card {
            background: white;
            border: 1px solid var(--gray-border);
            border-radius: var(--radius);
            padding: 40px 44px;
            box-shadow: var(--shadow);
            display: grid;
            grid-template-columns: 64px 1fr;
            gap: 28px;
            align-items: flex-start;
            position: relative;
            overflow: hidden;
            transition: box-shadow .25s;
        }

        .sejarah-card:hover {
            box-shadow: var(--shadow-md);
        }

        .sejarah-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
        }

        .sejarah-icon {
            width: 64px;
            height: 64px;
            background: var(--primary-pale);
            border: 1px solid var(--primary-border);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sejarah-icon svg {
            width: 26px;
            height: 26px;
            stroke: var(--primary);
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .sejarah-body h3 {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin-bottom: 14px;
        }

        .sejarah-body p+p {
            margin-top: 14px;
        }

        .highlight-word {
            display: inline-block;
            background: var(--primary-pale);
            color: var(--primary-dark);
            padding: 1px 10px;
            border-radius: 6px;
            font-weight: 700;
            font-style: italic;
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

        .card-visi,
        .card-misi {
            background: white;
            border: 1px solid var(--gray-border);
            border-radius: var(--radius);
            padding: 32px 34px;
            box-shadow: var(--shadow);
            transition: transform .25s, box-shadow .25s;
        }

        .card-visi:hover,
        .card-misi:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .card-visi {
            border-top: 3px solid var(--primary);
        }

        .card-misi {
            border-top: 3px solid var(--accent);
        }

        .vm-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }

        .vm-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .vm-icon.visi {
            background: var(--primary-pale);
        }

        .vm-icon.misi {
            background: #ede9fe;
        }

        .vm-icon svg {
            width: 17px;
            height: 17px;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .vm-icon.visi svg {
            stroke: var(--primary);
        }

        .vm-icon.misi svg {
            stroke: var(--accent);
        }

        .vm-header h3 {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--dark);
        }

        .card-misi ul {
            list-style: none;
            padding: 0;
        }

        .card-misi ul li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid var(--gray-border);
            font-size: 0.93rem;
            margin: 0;
            color: var(--text-muted);
        }

        .card-misi ul li:last-child {
            border-bottom: none;
        }

        .misi-num {
            width: 22px;
            height: 22px;
            border-radius: 6px;
            background: var(--primary-pale);
            color: var(--primary);
            font-size: 0.72rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* ================================================================
       PETA
    ================================================================ */
        .peta-card {
            background: white;
            border: 1px solid var(--gray-border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: box-shadow .25s;
        }

        .peta-card:hover {
            box-shadow: var(--shadow-md);
        }

        .peta-card iframe {
            display: block;
            width: 100%;
            height: 420px;
            border: 0;
        }

        .peta-footer {
            padding: 20px 28px;
            border-top: 1px solid var(--gray-border);
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .peta-info {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
            min-width: 0;
        }

        .peta-pin {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--primary-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .peta-pin svg {
            width: 18px;
            height: 18px;
            stroke: var(--primary);
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .peta-address p:first-child {
            font-weight: 700;
            color: var(--dark);
            font-size: 0.95rem;
            margin-bottom: 2px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .peta-address p:last-child {
            font-size: 0.83rem;
        }

        .btn-maps {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--primary);
            color: white;
            padding: 10px 22px;
            border-radius: var(--radius-sm);
            font-size: 0.87rem;
            font-weight: 700;
            white-space: nowrap;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all .2s;
        }

        .btn-maps:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.32);
        }

        /* ================================================================
       STATISTIK
    ================================================================ */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.13);
            border-radius: var(--radius);
            overflow: hidden;
            max-width: 820px;
            margin: 0 auto;
        }

        .stat-box {
            text-align: center;
            padding: 48px 24px;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            transition: background .2s;
        }

        .stat-box:last-child {
            border-right: none;
        }

        .stat-box:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
        }

        .stat-icon svg {
            width: 18px;
            height: 18px;
            stroke: rgba(255, 255, 255, 0.75);
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .stat-box h3 {
            font-size: clamp(1.8rem, 4vw, 2.7rem);
            font-weight: 900;
            color: white;
            margin: 0 0 8px;
            letter-spacing: -1.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .stat-box p {
            color: rgba(255, 255, 255, 0.55);
            font-size: 0.87rem;
            margin: 0;
        }

        /* ================================================================
       PERANGKAT DESA
    ================================================================ */
        .struktur-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .struktur-card {
            background: white;
            border: 1px solid var(--gray-border);
            border-radius: var(--radius);
            padding: 28px 20px;
            box-shadow: var(--shadow);
            text-align: center;
            transition: transform .25s, box-shadow .25s, border-color .2s;
        }

        .struktur-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-border);
        }

        .struktur-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: var(--primary-pale);
            border: 1px solid var(--primary-border);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
        }

        .struktur-avatar svg {
            width: 22px;
            height: 22px;
            stroke: var(--primary);
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .struktur-card h4 {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .struktur-role {
            display: inline-block;
            background: var(--primary-pale);
            color: var(--primary);
            font-size: 0.73rem;
            font-weight: 700;
            padding: 3px 12px;
            border-radius: 999px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* ================================================================
       RESPONSIVE
    ================================================================ */
        @media (max-width: 860px) {
            .tentang-grid {
                grid-template-columns: 1fr;
            }

            .visimisi-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stat-box {
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            }

            .stat-box:last-child {
                border-bottom: none;
            }

            .struktur-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .section-wrap {
                padding: 52px 16px;
            }

            .hero-profil {
                padding: 72px 16px 64px;
            }

            .sejarah-card {
                grid-template-columns: 1fr;
                padding: 28px 22px;
            }

            .tentang-main {
                padding: 26px 22px;
            }

            .card-visi,
            .card-misi {
                padding: 24px 22px;
            }

            .peta-footer {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-maps {
                width: 100%;
                justify-content: center;
            }

            .struktur-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>


    {{-- ================================================================
     HERO
================================================================ --}}
    <section class="hero-profil">
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="hero-profil-inner">
            <h1>Profil Desa Bluto</h1>
            <p>Kecamatan Bluto, Kabupaten Sumenep, Madura, Jawa Timur</p>
        </div>
    </section>


    {{-- ================================================================
     TENTANG DESA
================================================================ --}}
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
                        <div class="chip-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                        </div>
                        <div class="chip-body">
                            <label>Kecamatan</label>
                            <span>Bluto, Kabupaten Sumenep</span>
                        </div>
                    </div>
                    <div class="info-chip">
                        <div class="chip-icon">
                            <svg viewBox="0 0 24 24">
                                <polygon points="3 11 22 2 13 21 11 13 3 11" />
                            </svg>
                        </div>
                        <div class="chip-body">
                            <label>Provinsi</label>
                            <span>Jawa Timur, Madura</span>
                        </div>
                    </div>
                    <div class="info-chip">
                        <div class="chip-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>
                        <div class="chip-body">
                            <label>Jumlah Penduduk</label>
                            <span>± 2.241 Jiwa</span>
                        </div>
                    </div>
                    <div class="info-chip">
                        <div class="chip-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                        </div>
                        <div class="chip-body">
                            <label>Jam Pelayanan</label>
                            <span>07.30 – 12.00 WIB</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ================================================================
     SEJARAH
================================================================ --}}
    <div class="section-wrap bg-gray" id="sejarah">
        <div class="section-inner">
            <div class="section-header">
                <span class="section-label">Latar Belakang</span>
                <h2 class="section-title">Sejarah Desa</h2>
            </div>

            <div class="sejarah-card">
                <div class="sejarah-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                    </svg>
                </div>
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


    {{-- ================================================================
     VISI & MISI
================================================================ --}}
    <div class="section-wrap" id="visimisi">
        <div class="section-inner">
            <div class="section-header">
                <span class="section-label">Arah & Tujuan</span>
                <h2 class="section-title">Visi dan Misi</h2>
            </div>

            <div class="visimisi-grid">
                <div class="card-visi">
                    <div class="vm-header">
                        <div class="vm-icon visi">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                        </div>
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
                        <div class="vm-icon misi">
                            <svg viewBox="0 0 24 24">
                                <polyline points="9 11 12 14 22 4" />
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                            </svg>
                        </div>
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


    {{-- ================================================================
     PETA LOKASI
================================================================ --}}
    <div class="section-wrap bg-gray" id="peta">
        <div class="section-inner">
            <div class="section-header">
                <span class="section-label">Lokasi</span>
                <h2 class="section-title">Peta Desa Bluto</h2>
            </div>

            <div class="peta-card">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15820.123456789!2d113.8!3d-7.05!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6e5b3b3b3b3b3%3A0x1234567890abcdef!2sBluto%2C%20Sumenep%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1234567890"
                    width="100%" height="420" style="border:0; display:block;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <div class="peta-footer">
                    <div class="peta-info">
                        <div class="peta-pin">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                        </div>
                        <div class="peta-address">
                            <p>Balai Desa Bluto</p>
                            <p>Kecamatan Bluto, Kabupaten Sumenep, Madura, Jawa Timur</p>
                        </div>
                    </div>
                    <a class="btn-maps" href="https://maps.google.com/?q=Bluto,Sumenep" target="_blank">
                        Buka di Google Maps &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>


    {{-- ================================================================
     STATISTIK DESA
================================================================ --}}
    <div class="section-wrap bg-dark" id="statistik">
        <div class="section-inner">
            <div class="section-header">
                <span class="section-label light">Data & Fakta</span>
                <h2 class="section-title light">Statistik Desa</h2>
            </div>

            <div class="stats-grid">
                <div class="stat-box">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <h3>2.241</h3>
                    <p>Jumlah Penduduk</p>
                </div>
                <div class="stat-box">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>
                    </div>
                    <h3>20</h3>
                    <p>Desa di Kecamatan Bluto</p>
                </div>
                <div class="stat-box">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                    </div>
                    <h3>07.30–12.00</h3>
                    <p>Jam Pelayanan Desa</p>
                </div>
            </div>
        </div>
    </div>


    {{-- ================================================================
     PERANGKAT DESA
================================================================ --}}
    <div class="section-wrap" id="perangkat">
        <div class="section-inner">
            <div class="section-header">
                <span class="section-label">Organisasi</span>
                <h2 class="section-title">Perangkat Desa</h2>
            </div>

            <div class="struktur-grid">
                <div class="struktur-card">
                    <div class="struktur-avatar">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </div>
                    <h4>Kepala Desa</h4>
                    <span class="struktur-role">Pimpinan Desa</span>
                </div>
                <div class="struktur-card">
                    <div class="struktur-avatar">
                        <svg viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                            <polyline points="10 9 9 9 8 9" />
                        </svg>
                    </div>
                    <h4>Sekretaris Desa</h4>
                    <span class="struktur-role">Administrasi</span>
                </div>
                <div class="struktur-card">
                    <div class="struktur-avatar">
                        <svg viewBox="0 0 24 24">
                            <line x1="12" y1="1" x2="12" y2="23" />
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                    </div>
                    <h4>Kaur Keuangan</h4>
                    <span class="struktur-role">Keuangan</span>
                </div>
                <div class="struktur-card">
                    <div class="struktur-avatar">
                        <svg viewBox="0 0 24 24">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2" />
                            <line x1="8" y1="21" x2="16" y2="21" />
                            <line x1="12" y1="17" x2="12" y2="21" />
                        </svg>
                    </div>
                    <h4>Kasi Pembangunan</h4>
                    <span class="struktur-role">Pembangunan</span>
                </div>
                <div class="struktur-card">
                    <div class="struktur-avatar">
                        <svg viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <h4>Kasi Pelayanan</h4>
                    <span class="struktur-role">Pelayanan Publik</span>
                </div>
                <div class="struktur-card">
                    <div class="struktur-avatar">
                        <svg viewBox="0 0 24 24">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
                        </svg>
                    </div>
                    <h4>Kasi Pemerintahan</h4>
                    <span class="struktur-role">Pemerintahan</span>
                </div>
            </div>
        </div>
    </div>
@endsection
