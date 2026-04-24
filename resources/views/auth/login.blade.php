<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Si Bluto</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --blue-dark:   #0f3460;
            --blue-mid:    #1a5fa8;
            --blue-light:  #2e86de;
            --blue-pale:   #dbeafe;
            --blue-ghost:  #eff6ff;
            --white:       #ffffff;
            --text:        #1e2d3d;
            --muted:       #6b7e93;
            --border:      #d1dfe9;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--blue-ghost);
            min-height: 100vh;
            display: flex;
            align-items: stretch;
        }

        /* ── Left panel ── */
        .left-panel {
            flex: 1;
            background: linear-gradient(155deg, var(--blue-dark) 0%, var(--blue-mid) 55%, var(--blue-light) 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 48px;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            border: 60px solid rgba(255,255,255,0.05);
            top: -120px;
            right: -120px;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            border: 50px solid rgba(255,255,255,0.05);
            bottom: -80px;
            left: -80px;
        }

        .panel-logo {
            width: 88px;
            height: 88px;
            background: rgba(255,255,255,0.12);
            border: 2px solid rgba(255,255,255,0.25);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 28px;
            backdrop-filter: blur(4px);
        }

        .panel-logo svg {
            width: 48px;
            height: 48px;
            fill: white;
        }

        .panel-title {
            font-size: 30px;
            font-weight: 800;
            color: white;
            text-align: center;
            letter-spacing: -0.5px;
            line-height: 1.2;
            margin-bottom: 12px;
        }

        .panel-sub {
            font-size: 14px;
            color: rgba(255,255,255,0.65);
            text-align: center;
            line-height: 1.6;
            max-width: 280px;
        }

        .badge-list {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
            max-width: 300px;
        }

        .badge {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            font-size: 13px;
            backdrop-filter: blur(4px);
        }

        .badge-icon {
            width: 32px;
            height: 32px;
            background: rgba(255,255,255,0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* ── Right panel ── */
        .right-panel {
            width: 480px;
            flex-shrink: 0;
            background: var(--white);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 48px;
            box-shadow: -8px 0 40px rgba(15,52,96,0.08);
        }

        .form-header {
            width: 100%;
            margin-bottom: 36px;
        }

        .form-header .welcome {
            font-size: 13px;
            font-weight: 600;
            color: var(--blue-light);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .form-header h2 {
            font-size: 28px;
            font-weight: 800;
            color: var(--text);
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .form-header p {
            margin-top: 8px;
            font-size: 14px;
            color: var(--muted);
        }

        /* Alert */
        .alert {
            width: 100%;
            background: #fff0f0;
            border: 1px solid #fca5a5;
            border-left: 4px solid #ef4444;
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 24px;
            font-size: 13.5px;
            color: #b91c1c;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Form */
        .form-body { width: 100%; }

        .form-group { margin-bottom: 20px; }

        label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text);
            letter-spacing: 0.3px;
            margin-bottom: 7px;
        }

        .input-wrap { position: relative; }

        .input-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
            transition: color 0.2s;
        }

        input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14.5px;
            color: var(--text);
            background: var(--white);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input::placeholder { color: #b0bec8; }

        input:focus {
            border-color: var(--blue-light);
            box-shadow: 0 0 0 3.5px rgba(46,134,222,0.12);
        }

        .input-wrap:focus-within svg { color: var(--blue-light); }

        /* Submit */
        .btn {
            width: 100%;
            padding: 13.5px;
            background: linear-gradient(135deg, var(--blue-mid), var(--blue-light));
            border: none;
            border-radius: 10px;
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 16px rgba(26,95,168,0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(26,95,168,0.35);
        }

        .btn:active { transform: translateY(0); }

        hr.divider {
            width: 100%;
            border: none;
            border-top: 1px solid var(--border);
            margin: 28px 0 20px;
        }

        .copyright {
            font-size: 12px;
            color: #b0bec8;
            text-align: center;
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 820px) {
            body { flex-direction: column; }
            .left-panel { padding: 40px 32px; flex: none; }
            .badge-list { display: none; }
            .right-panel { width: 100%; padding: 40px 28px; box-shadow: none; }
        }
    </style>
</head>
<body>

<!-- LEFT PANEL -->
<div class="left-panel">
    <div class="panel-logo">
        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
            <rect x="8" y="30" width="48" height="26" rx="2"/>
            <polygon points="4,32 32,8 60,32"/>
            <rect x="24" y="40" width="16" height="16" rx="1" fill="rgba(255,255,255,0.3)"/>
            <rect x="12" y="36" width="10" height="8" rx="1" fill="rgba(255,255,255,0.3)"/>
            <rect x="42" y="36" width="10" height="8" rx="1" fill="rgba(255,255,255,0.3)"/>
            <rect x="29" y="20" width="6" height="10" fill="rgba(255,255,255,0.6)"/>
        </svg>
    </div>

    <h1 class="panel-title">Sistem Informasi Desa Bluto</h1>
    <p class="panel-sub">Portal layanan administrasi digital Balai Desa yang terintegrasi dan terpercaya.</p>

    <div class="badge-list">
        <div class="badge">
            <div class="badge-icon">
                <svg width="16" height="16" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            Layanan administrasi kependudukan
        </div>
        <div class="badge">
            <div class="badge-icon">
                <svg width="16" height="16" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0119 9.414V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            Pengelolaan surat &amp; dokumen desa
        </div>
        <div class="badge">
            <div class="badge-icon">
                <svg width="16" height="16" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                </svg>
            </div>
            Data warga &amp; profil desa
        </div>
    </div>
</div>

<!-- RIGHT PANEL -->
<div class="right-panel">

    <div class="form-header">
        <p class="welcome">Selamat Datang</p>
        <h2>Masuk ke Akun Anda</h2>
        <p>Silakan login menggunakan username atau email yang terdaftar.</p>
    </div>

    @if($errors->any())
    <div class="alert">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        {{ $errors->first() }}
    </div>
    @endif

    <form class="form-body" method="POST" action="{{ route('login.process') }}">
        @csrf

        <div class="form-group">
            <label for="login">Username atau Email</label>
            <div class="input-wrap">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
                <input
                    type="text"
                    id="login"
                    name="login"
                    placeholder="Masukkan username atau email"
                    value="{{ old('login') }}"
                    required
                    autocomplete="username"
                >
            </div>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrap">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/>
                </svg>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                    autocomplete="current-password"
                >
            </div>
        </div>

        <button type="submit" class="btn">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Masuk
        </button>
    </form>

    <hr class="divider">

    <p class="copyright">
        &copy; {{ date('Y') }} Balai Desa &mdash; Sistem Si Bluto.<br>
        Seluruh hak dilindungi.
    </p>

</div>

</body>
</html>