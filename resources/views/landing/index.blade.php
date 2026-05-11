@extends('layouts.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap');

        :root {
            --primary: #6366f1;
            --primary-dark: #4338ca;
            --primary-deeper: #312e81;
            --primary-light: #a5b4fc;
            --primary-pale: #eef2ff;
            --primary-border: #c7d2fe;
            --accent: #8b5cf6;
            --dark: #0f172a;
            --dark-mid: #1e293b;
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

        /* ======================== SHARED ======================== */
        .section-inner {
            max-width: 1100px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .section-label {
            display: inline-block;
            background: var(--primary-pale);
            color: var(--primary);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 5px 16px;
            border-radius: 999px;
            margin-bottom: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.7rem, 3vw, 2.4rem);
            color: var(--dark);
            margin-bottom: 12px;
        }

        .section-desc {
            color: var(--text-muted);
            max-width: 500px;
            margin: 0 auto;
            font-size: 0.95rem;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: white;
            color: var(--primary-dark);
            padding: 14px 30px;
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 0.95rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all .25s;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.18);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.24);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: 1.5px solid rgba(255, 255, 255, 0.35);
            color: white;
            padding: 13px 28px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.95rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all .25s;
            backdrop-filter: blur(6px);
        }

        .btn-ghost:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            border: 1.5px solid var(--primary);
            color: var(--primary);
            padding: 12px 28px;
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 0.9rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all .2s;
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            color: white;
        }

        .btn-white {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: white;
            color: var(--primary-dark);
            padding: 12px 26px;
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 0.9rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all .2s;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.28);
        }


        /* ======================== 1. HERO ======================== */
        .hero {
            position: relative;
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background:

                url('/images/balai/desa.jpg') center/cover no-repeat;
        }

        .hero-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.3;
            display: none;
        }

        .hero-orb-1 {
            width: 520px;
            height: 520px;
            background: #7c3aed;
            top: -120px;
            right: -100px;
            animation: floatA 9s ease-in-out infinite;
        }

        .hero-orb-2 {
            width: 420px;
            height: 420px;
            background: #0ea5e9;
            bottom: -100px;
            left: -80px;
            animation: floatA 11s ease-in-out infinite reverse;
        }

        .hero-orb-3 {
            width: 300px;
            height: 300px;
            background: var(--primary-light);
            top: 50%;
            left: 35%;
            animation: floatA 7s ease-in-out infinite;
        }

        @keyframes floatA {

            0%,
            100% {
                transform: translate(0, 0) scale(1)
            }

            50% {
                transform: translate(18px, -18px) scale(1.04)
            }
        }

        .hero::before {
            display: none;
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.07) 1px, transparent 1px);
            background-size: 36px 36px;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 720px;
            padding: 0 24px;
            animation: fadeUp 0.8s ease forwards;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(22px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.11);
            border: 1px solid rgba(255, 255, 255, 0.26);
            color: rgba(255, 255, 255, 0.9);
            padding: 8px 20px;
            border-radius: 999px;
            font-size: 12.5px;
            font-weight: 600;
            margin-bottom: 28px;
            letter-spacing: 0.5px;
            backdrop-filter: blur(8px);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .hero-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #86efac;
            animation: blink 2s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: 0.4
            }
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.6rem, 6vw, 4.4rem);
            font-weight: 800;
            color: white;
            line-height: 1.15;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }

        .hero h1 span {
            background: linear-gradient(90deg, #a5b4fc 0%, #e0f2fe 60%, #c4b5fd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-desc {
            color: rgba(255, 255, 255, 0.75);
            font-size: 1.08rem;
            margin-bottom: 40px;
            max-width: 520px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-cta {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 52px;
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: var(--radius);
            overflow: hidden;
            backdrop-filter: blur(12px);
            max-width: 560px;
            margin: 0 auto;
        }

        .hero-stat {
            flex: 1;
            text-align: center;
            padding: 18px 20px;
            border-right: 1px solid rgba(255, 255, 255, 0.12);
        }

        .hero-stat:last-child {
            border-right: none;
        }

        .hero-stat-num {
            font-size: 1.5rem;
            font-weight: 900;
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            letter-spacing: -0.5px;
            line-height: 1;
            margin-bottom: 4px;
        }

        .hero-stat-label {
            font-size: 0.74rem;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 500;
        }

        .scroll-hint {
            position: absolute;
            bottom: 32px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            color: rgba(255, 255, 255, 0.45);
            font-size: 0.72rem;
            letter-spacing: 0.5px;
            animation: bounce 2.2s ease-in-out infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateX(-50%) translateY(0)
            }

            50% {
                transform: translateX(-50%) translateY(7px)
            }
        }

        .scroll-arrow {
            width: 28px;
            height: 28px;
            border: 1.5px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }


        /* ======================== 2. ABOUT ======================== */
        .about-section {
            padding: 96px 24px;
            background: var(--white);
        }

        .about-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 72px;
            align-items: center;
        }

        .about-label {
            display: inline-block;
            background: var(--primary-pale);
            color: var(--primary);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 5px 16px;
            border-radius: 999px;
            margin-bottom: 16px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .about-left h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 3vw, 2.6rem);
            color: var(--dark);
            line-height: 1.3;
            margin-bottom: 18px;
        }

        .about-left>p {
            margin-bottom: 32px;
            font-size: 0.96rem;
        }

        .about-points {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .about-point {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .point-icon {
            width: 42px;
            height: 42px;
            background: var(--primary-pale);
            border: 1px solid var(--primary-border);
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .point-body h4 {
            font-size: 0.96rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 3px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .point-body p {
            font-size: 0.87rem;
        }

        .about-right {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .about-image {
            width: 100%;
            max-width: 420px;
            aspect-ratio: 4/3;
            object-fit: cover;

            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);

            margin: 20px 0;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--primary-border);
            border-radius: var(--radius);
            padding: 28px 22px;
            box-shadow: var(--shadow);
            text-align: center;
            transition: transform .25s, box-shadow .25s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .stat-card.featured {
            grid-column: 1 / -1;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            border-color: transparent;
        }

        .stat-card.featured .stat-num {
            color: white;
        }

        .stat-card.featured .stat-label {
            color: rgba(255, 255, 255, 0.68);
        }

        .stat-num {
            font-size: 2.4rem;
            font-weight: 900;
            color: var(--primary);
            font-family: 'Plus Jakarta Sans', sans-serif;
            letter-spacing: -1px;
            line-height: 1;
            margin-bottom: 6px;
        }

        .stat-label {
            font-size: 0.82rem;
            color: var(--text-muted);
            font-weight: 500;
        }


        /* ======================== 3. HIGHLIGHTS ======================== */
        .highlights-section {
            padding: 80px 24px;
            background: var(--gray-mid);
        }

        .highlights-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
            margin-top: 30px;
        }

        .highlight-card {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid var(--gray-border);
            transition: transform .25s, box-shadow .25s;
            display: flex;
            flex-direction: column;
        }

        .highlight-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .highlight-img {
            height: 200px;
            position: relative;
            overflow: hidden;
        }

        .highlight-img-inner {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.2rem;
            transition: transform .4s;
        }

        .highlight-card:hover .highlight-img-inner {
            transform: scale(1.07);
        }

        .highlight-cat {
            position: absolute;
            top: 14px;
            left: 14px;
            background: var(--primary);
            color: white;
            font-size: 10.5px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 999px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .highlight-body {
            padding: 22px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .highlight-body h3 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.45;
            margin-bottom: 8px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .highlight-body p {
            font-size: 0.87rem;
            flex: 1;
        }

        .highlight-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 14px;
            padding-top: 12px;
            border-top: 1px solid var(--gray-border);
        }

        .highlight-date {
            font-size: 0.79rem;
            color: var(--text-muted);
        }

        .highlight-link {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--primary);
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap .2s;
        }

        .highlight-link:hover {
            gap: 8px;
        }


        /* ======================== 4. SPOTLIGHT ======================== */
        .spotlight-section {
            position: relative;
            padding: 88px 24px;
            background: linear-gradient(145deg, var(--primary-deeper) 0%, var(--primary-dark) 55%, #5b21b6 100%);
            overflow: hidden;
        }

        .spotlight-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        .spotlight-inner {
            max-width: 1100px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            align-items: center;
        }

        .spotlight-label {
            display: inline-block;
            background: rgba(255, 255, 255, 0.14);
            color: rgba(255, 255, 255, 0.9);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 5px 16px;
            border-radius: 999px;
            margin-bottom: 18px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .spotlight-content h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.9rem, 3vw, 3rem);
            color: white;
            line-height: 1.25;
            margin-bottom: 16px;
        }

        .spotlight-content h2 em {
            font-style: normal;
            background: linear-gradient(90deg, #a5b4fc, #c4b5fd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .spotlight-content p {
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.97rem;
            margin-bottom: 28px;
        }

        .spotlight-card {
            background: rgba(255, 255, 255, 0.09);
            border: 1px solid rgba(255, 255, 255, 0.17);
            border-radius: var(--radius);
            padding: 32px;
            backdrop-filter: blur(12px);
        }

        .spotlight-img {
            height: 220px;
            background: rgba(165, 180, 252, 0.15);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .spotlight-card h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .spotlight-card p {
            color: rgba(255, 255, 255, 0.65);
            font-size: 0.9rem;
        }

        .spotlight-dots {
            display: flex;
            gap: 8px;
            margin-top: 28px;
        }

        .sdot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all .2s;
        }

        .sdot.active {
            background: white;
            width: 24px;
            border-radius: 4px;
        }


        /* ======================== 5. LAYANAN UNGGULAN ======================== */
        .attractions-section {
            padding: 96px 24px;
            background: var(--white);
        }

        .attractions-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .attraction-card {
            background: white;
            border: 1px solid var(--primary-border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform .25s, box-shadow .25s;
            display: flex;
            flex-direction: column;
        }

        .attraction-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .attraction-thumb {
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.8rem;
            position: relative;
        }

        .t1 {
            background: linear-gradient(135deg, #eef2ff, #c7d2fe);
        }

        .t2 {
            background: linear-gradient(135deg, #ede9fe, #c4b5fd);
        }

        .t3 {
            background: linear-gradient(135deg, #ecfdf5, #6ee7b7);
        }

        .t4 {
            background: linear-gradient(135deg, #fffbeb, #fcd34d);
        }

        .t5 {
            background: linear-gradient(135deg, #fef2f2, #fca5a5);
        }

        .t6 {
            background: linear-gradient(135deg, #f0f9ff, #7dd3fc);
        }


        .attractions-grid.clean {
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
        }

        .attraction-card.clean {
            background: transparent;
            border: none;
            box-shadow: none;
            text-align: center;
            padding: 0;
        }

        .attraction-num {
            position: absolute;
            top: 10px;
            right: 12px;
            font-size: 0.75rem;
            font-weight: 800;
            color: rgba(0, 0, 0, 0.2);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .attraction-body {
            padding: 0;
            align-items: center;
            text-align: center;
        }

        .attraction-body h3 {
            font-size: 1rem;
            margin-bottom: 6px;
        }

        .attraction-thumb {
            height: auto;
            background: none !important;
            font-size: 42px;
            margin-bottom: 12px;
        }

        .attraction-body p {
            font-size: 0.85rem;
            max-width: 180px;
            margin: 0 auto;
        }

        .attraction-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .attraction-tag {
            font-size: 0.74rem;
            background: var(--primary-pale);
            color: var(--primary);
            padding: 3px 10px;
            border-radius: 999px;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .attraction-link {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--primary);
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: gap .2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .attraction-link:hover {
            gap: 7px;
        }

        .see-all-wrap {
            text-align: center;
        }


        /* ======================== 6. EVENTS ======================== */
        .events-section {
            padding: 80px 24px;
            background: var(--gray-mid);
        }

        .events-list {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .event-card {
            background: white;
            border: 1px solid var(--gray-border);
            border-radius: var(--radius);
            padding: 22px 26px;
            box-shadow: var(--shadow);
            display: grid;
            grid-template-columns: 80px 1fr auto;
            gap: 24px;
            align-items: center;
            transition: transform .2s, box-shadow .2s, border-color .2s;
        }

        .event-card:hover {
            transform: translateX(5px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-border);
        }

        .event-date-box {
            text-align: center;
            background: var(--primary-pale);
            border: 1px solid var(--primary-border);
            border-radius: 12px;
            padding: 14px 8px;
        }

        .event-day {
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--primary);
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1;
            margin-bottom: 2px;
        }

        .event-mon {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .event-body h3 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 6px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .event-body p {
            font-size: 0.87rem;
            margin-bottom: 10px;
        }

        .event-meta {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .event-meta-item {
            font-size: 0.8rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .event-badge {
            background: var(--primary);
            color: white;
            font-size: 0.78rem;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: var(--radius-sm);
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: opacity .2s;
            white-space: nowrap;
        }

        .event-badge:hover {
            opacity: 0.85;
        }

        .event-badge.outline {
            background: var(--primary-pale);
            color: var(--primary);
        }


        /* ======================== 7. GALLERY ======================== */
        .gallery-section {
            padding: 80px 24px;
            background: var(--gray-mid);
        }

        .gallery-header-row {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .gallery-header-row .section-title {
            text-align: left;
            margin-bottom: 4px;
        }

        .gallery-header-row .section-desc {
            text-align: left;
            margin: 0;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: 200px 200px;
            gap: 14px;
        }

        .gallery-item {
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }

        .gallery-item:first-child {
            grid-column: span 2;
            grid-row: span 2;
        }

        .gallery-item:nth-child(4) {
            grid-column: span 2;
        }

        .g-img {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            transition: transform .4s;
        }

        .gallery-item:hover .g-img {
            transform: scale(1.08);
        }

        .gi1 {
            background: linear-gradient(135deg, #c7d2fe, #818cf8);
        }

        .gi2 {
            background: linear-gradient(135deg, #a7f3d0, #34d399);
        }

        .gi3 {
            background: linear-gradient(135deg, #fde68a, #f59e0b);
        }

        .gi4 {
            background: linear-gradient(135deg, #fecaca, #f87171);
        }

        .gi5 {
            background: linear-gradient(135deg, #bae6fd, #38bdf8);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.72) 0%, transparent 55%);
            opacity: 0;
            transition: opacity .3s;
            display: flex;
            align-items: flex-end;
            padding: 16px;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay span {
            color: white;
            font-size: 0.82rem;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .gallery-cta {
            text-align: center;
            margin-top: 36px;
        }


        /* ======================== 8. CTA BANNER ======================== */
        .cta-section {
            position: relative;
            padding: 108px 24px;
            background: linear-gradient(145deg, var(--primary-deeper) 0%, var(--primary-dark) 42%, var(--accent) 100%);
            overflow: hidden;
            text-align: center;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.06) 1px, transparent 1px);
            background-size: 30px 30px;
        }

        .cta-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
        }

        .cta-orb-1 {
            width: 420px;
            height: 420px;
            background: rgba(139, 92, 246, 0.3);
            top: -120px;
            right: -60px;
        }

        .cta-orb-2 {
            width: 320px;
            height: 320px;
            background: rgba(14, 165, 233, 0.22);
            bottom: -90px;
            left: -50px;
        }

        .cta-inner {
            position: relative;
            z-index: 1;
            max-width: 620px;
            margin: 0 auto;
        }

        .cta-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3.2rem);
            color: white;
            margin-bottom: 16px;
            line-height: 1.22;
        }

        .cta-section p {
            color: rgba(255, 255, 255, 0.72);
            font-size: 1.05rem;
            margin-bottom: 40px;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-actions {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
        }


        /* ======================== RESPONSIVE ======================== */
        @media (max-width: 1024px) {
            .about-inner {
                grid-template-columns: 1fr;
                gap: 48px;
            }

            .about-right {
                grid-template-columns: repeat(3, 1fr);
            }

            .about-right .stat-card.featured {
                grid-column: auto;
            }

            .spotlight-inner {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }

        @media (max-width: 900px) {
            .highlights-grid {
                grid-template-columns: 1fr 1fr;
            }

            .attractions-grid {
                grid-template-columns: 1fr 1fr;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: repeat(3, 180px);
            }

            .gallery-item:first-child {
                grid-column: auto;
                grid-row: auto;
            }

            .gallery-item:nth-child(4) {
                grid-column: auto;
            }
        }

        @media (max-width: 500px) {
            .attractions-grid.clean {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .hero {
                min-height: 100dvh;
            }

            .hero-stats {
                flex-direction: column;
            }

            .hero-stat {
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            }

            .hero-stat:last-child {
                border-bottom: none;
            }

            .about-section {
                padding: 64px 16px;
            }

            .about-right {
                grid-template-columns: 1fr 1fr;
            }

            .highlights-grid,
            .attractions-grid {
                grid-template-columns: 1fr;
            }

            .gallery-grid {
                grid-template-columns: 1fr 1fr;
                grid-template-rows: repeat(3, 160px);
            }

            .event-card {
                grid-template-columns: 68px 1fr;
            }

            .event-badge {
                display: none;
            }

            .highlights-section,
            .events-section,
            .attractions-section,
            .gallery-section,
            .spotlight-section {
                padding: 60px 16px;
            }

            .hero-cta {
                flex-direction: column;
                align-items: center;
            }

            .btn-primary,
            .btn-ghost {
                width: 100%;
                max-width: 320px;
                justify-content: center;
            }

            .gallery-header-row {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>


    <!-- ================================================================
                                                                                     1. HERO
                                                                                ================================================================ -->
    <section class="hero">
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="hero-orb hero-orb-3"></div>

        <div class="hero-content">
            <div class="hero-eyebrow">
                Kecamatan Bluto, Kabupaten Sumenep, Madura
            </div>
            <h1>Selamat Datang di<br>Desa Bluto</h1>
            <p class="hero-desc">
                Pusat Informasi dan Layanan Masyarakat yang Transparan, Cepat, dan Terpercaya.
            </p>
        </div>
    </section>


    <!-- ================================================================
                                                                                     2. ABOUT US
                                                                                ================================================================ -->
    <section class="about-section">
        <div class="about-inner">
            <div class="about-left">
                <span class="about-label">Tentang Desa</span>
                <h2>Mengenal Lebih Dekat<br>Desa Bluto</h2>
                <p>
                    Desa Bluto terletak di Kecamatan Bluto, Kabupaten Sumenep, Madura, Jawa Timur. Dengan komitmen pelayanan
                    prima, kami hadir untuk memudahkan akses informasi dan layanan bagi seluruh masyarakat desa. Kecamatan
                    Bluto sendiri terdiri dari lebih dari 20 desa aktif yang terus berkembang bersama. Desa Bluto memiliki
                    lebih dari 2.241 penduduk yang berperan aktif dalam berbagai program pembangunan. Untuk mendukung
                    kebutuhan masyarakat, pelayanan administrasi disediakan secara cepat dan mudah setiap hari kerja mulai
                    pukul 07.30 hingga 12.00 WIB.
                </p>
                <div style="margin-top: 28px;">
                    <a href="/profil-desa" class="btn-outline-primary">
                        Selengkapnya →
                    </a>
                </div>
            </div>
            <div class="about-right">
                <img src="/images/balai/desa1.jpg" alt="Balai Desa Bluto" class="about-image">
            </div>
        </div>
        </div>
    </section>


    <!-- ================================================================
                                                                                     3. LATEST HIGHLIGHTS
                                                                                ================================================================ -->
    <section class="highlights-section">
        <div class="section-inner">

            <div class="section-header header-flex">
                <h2 class="section-title">Berita Terbaru</h2>
                <a href="{{ route('public.berita.index') }}" class="btn-outline-primary header-link">
                    Lihat Semua Berita→
                </a>
            </div>

            <div class="highlights-grid">

                @forelse($latestNews as $item)
                    <div class="highlight-card">

                        <div class="highlight-img">

                            @if ($item->image)
                                <div class="highlight-img-inner"
                                    style="background-image:url('{{ asset('storage/' . $item->image) }}');
                                        background-size:cover;
                                        background-position:center;">
                                </div>
                            @else
                                <div class="highlight-img-inner"
                                    style="background:linear-gradient(135deg,#eef2ff,#a5b4fc);">
                                </div>
                            @endif

                            <span class="highlight-cat">
                                {{ $item->category ?? 'Berita' }}
                            </span>
                        </div>

                        <div class="highlight-body">

                            <h3>{{ $item->title }}</h3>

                            <p>
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 100) }}
                            </p>

                            <div class="highlight-meta">
                                <span class="highlight-date">
                                    {{ $item->created_at->format('d M Y') }}
                                </span>

                                <a class="highlight-link" href="{{ route('public.berita.show', $item->slug) }}">
                                    Baca →
                                </a>
                            </div>

                        </div>

                    </div>

                @empty
                    <p style="text-align:center;">Belum ada berita</p>
                @endforelse

            </div>
        </div>
    </section>


    <!-- ================================================================
                                                                                     5. LAYANAN UNGGULAN
                                                                                ================================================================ -->
    <section class="attractions-section">
        <div class="section-inner">
            <div class="section-header">
                <span class="section-label">Layanan</span>
                <h2 class="section-title">Layanan Unggulan Desa</h2>
                <p class="section-desc">Berbagai layanan administrasi dan informasi yang tersedia untuk masyarakat Desa
                    Bluto.</p>
            </div>
            <div class="attractions-grid clean">

                <div class="attraction-card clean">
                    <div class="attraction-thumb t1">📄</div>
                    <div class="attraction-body">
                        <h3>Surat Pengantar</h3>
                        <p>Pembuatan surat pengantar untuk berbagai keperluan administrasi masyarakat desa.</p>
                    </div>
                </div>

                <div class="attraction-card clean">
                    <div class="attraction-thumb t2">✅</div>
                    <div class="attraction-body">
                        <h3>Persetujuan Desa</h3>
                        <p>Layanan administrasi persetujuan dan rekomendasi resmi dari pemerintah desa.</p>
                    </div>
                </div>

                <div class="attraction-card clean">
                    <div class="attraction-thumb t3">💰</div>
                    <div class="attraction-body">
                        <h3>Bantuan Sosial</h3>
                        <p>Informasi dan pendaftaran program PKH, BLT, dan bantuan sosial lainnya.</p>
                    </div>
                </div>

                <div class="attraction-card clean">
                    <div class="attraction-thumb t5">📰</div>
                    <div class="attraction-body">
                        <h3>Berita & Pengumuman</h3>
                        <p>Informasi terkini seputar kegiatan dan pengumuman resmi dari desa.</p>
                    </div>
                </div>

            </div>
            <div class="see-all-wrap">
                <a class="btn-outline-primary" href="/profil-desa">Lihat Semua Layanan →</a>
            </div>
        </div>
    </section>

    <!-- ================================================================
                                                                                     7. GALERI DIARIES
                                                                                ================================================================ -->
    <section class="gallery-section">
        <div class="section-inner">

            <div class="gallery-header-row">
                <div>
                    <span class="section-label" style="margin-bottom:10px;">
                        #DesaBlutoDiaries
                    </span>

                    <h2 class="section-title">Galeri Momen Desa</h2>

                    <p class="section-desc">
                        Abadikan dan bagikan momen indah bersama masyarakat Desa Bluto.
                    </p>
                </div>
            </div>

            <div class="gallery-grid">

                @forelse($latestGalleries as $item)
                    @php
                        $img = $item->images->first();
                        $imageUrl = $img
                            ? asset('storage/' . $img->image)
                            : 'https://via.placeholder.com/400x300?text=No+Image';
                    @endphp

                    <a href="{{ route('public.gallery.show', $item->id) }}" class="gallery-item">

                        <div class="g-img"
                            style="background-image:url('{{ $imageUrl }}');
                                background-size:cover;
                                background-position:center;">
                        </div>

                        <div class="gallery-overlay">
                            <span>{{ $item->title }}</span>
                        </div>

                    </a>

                @empty
                    <p style="text-align:center;">Belum ada galeri</p>
                @endforelse

            </div>

            <div class="gallery-cta">
                <a class="btn-outline-primary" href="{{ route('public.gallery.index') }}">
                    Lihat Seluruh Galeri →
                </a>
            </div>

        </div>
    </section>

    <!-- ================================================================
                                                                                     8. CTA BANNER
                                                                                ================================================================ -->
    <section class="cta-section">
        <div class="cta-orb cta-orb-1"></div>
        <div class="cta-orb cta-orb-2"></div>
        <div class="cta-inner">
            <h2>Siap Melayani Masyarakat<br>Desa Bluto?</h2>
            <p>Sampaikan aspirasi, akses layanan, dan jadilah bagian dari kemajuan Desa Bluto bersama-sama.</p>
            <div class="cta-actions">
                <a class="btn-ghost" href="{{ route('public.berita.index') }}">Baca Berita Terbaru</a>
            </div>
        </div>
    </section>
@endsection
