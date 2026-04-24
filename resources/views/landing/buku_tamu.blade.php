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
p { margin: 0; line-height: 1.7; color: var(--text-muted); font-size: 0.95rem; }

/* ===== HERO ===== */
.hero-guest {
    background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue) 60%, #0ea5e9 100%);
    padding: 80px 24px 72px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.hero-guest::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='30' cy='30' r='20' fill='%23ffffff' fill-opacity='0.04'/%3E%3C/svg%3E");
    pointer-events: none;
}
.hero-guest-inner { position: relative; z-index: 1; max-width: 580px; margin: 0 auto; }
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
.hero-guest h1 {
    font-size: clamp(1.8rem, 5vw, 2.8rem);
    font-weight: 800;
    color: white;
    margin: 0 0 12px;
    line-height: 1.2;
}
.hero-guest h1 span {
    background: linear-gradient(90deg, #93c5fd, #e0f2fe);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.hero-guest .hero-guest-inner > p { color: rgba(255,255,255,0.8); font-size: 1rem; }

/* ===== LAYOUT ===== */
.page-wrap {
    max-width: 1000px;
    margin: 0 auto;
    padding: 56px 24px 72px;
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 32px;
    align-items: flex-start;
}

/* ===== FORM CARD ===== */
.form-card {
    background: white;
    border: 1px solid var(--blue-border);
    border-radius: var(--radius);
    padding: 36px 40px;
    box-shadow: var(--shadow);
}
.form-card-header { margin-bottom: 28px; }
.form-card-header .section-label {
    display: inline-block;
    background: var(--blue-pale);
    color: var(--blue);
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.8px;
    padding: 4px 14px;
    border-radius: 999px;
    margin-bottom: 10px;
}
.form-card-header h2 {
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--dark);
    margin: 0 0 6px;
}
.form-card-header p { font-size: 0.9rem; }

/* Form Elements */
.form-group { margin-bottom: 20px; }
.form-group label {
    display: block;
    font-size: 0.88rem;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 7px;
}
.form-group label span { color: #ef4444; margin-left: 2px; }
.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 11px 14px;
    border: 1px solid var(--blue-border);
    border-radius: 8px;
    font-size: 0.93rem;
    color: var(--text);
    background: white;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
    font-family: inherit;
}
.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(26, 86, 219, 0.1);
}
.form-group input::placeholder,
.form-group textarea::placeholder { color: #adb5bd; }
.form-group textarea { resize: vertical; min-height: 110px; }

.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

.btn-submit {
    width: 100%;
    padding: 13px;
    background: linear-gradient(135deg, var(--blue-dark), var(--blue));
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 0.97rem;
    font-weight: 700;
    cursor: pointer;
    transition: opacity .2s, transform .2s;
    margin-top: 4px;
    letter-spacing: 0.2px;
}
.btn-submit:hover { opacity: .88; transform: translateY(-1px); }

/* ===== SIDEBAR INFO ===== */
.sidebar { display: flex; flex-direction: column; gap: 20px; }

.info-card {
    background: white;
    border: 1px solid var(--blue-border);
    border-radius: var(--radius);
    padding: 24px;
    box-shadow: var(--shadow);
}
.info-card h3 {
    font-size: 0.97rem;
    font-weight: 700;
    color: var(--dark);
    margin: 0 0 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--blue-pale);
    display: flex;
    align-items: center;
    gap: 8px;
}
.info-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 14px;
}
.info-item:last-child { margin-bottom: 0; }
.info-icon {
    width: 36px; height: 36px;
    background: var(--blue-pale);
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}
.info-text strong {
    display: block;
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 2px;
}
.info-text span { font-size: 0.83rem; color: var(--text-muted); }

.notice-card {
    background: var(--blue-pale);
    border: 1px solid var(--blue-border);
    border-radius: var(--radius);
    padding: 20px 22px;
    display: flex;
    gap: 12px;
    align-items: flex-start;
}
.notice-icon { font-size: 1.3rem; flex-shrink: 0; margin-top: 1px; }
.notice-text p { font-size: 0.85rem; line-height: 1.65; color: var(--text); }

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .page-wrap {
        grid-template-columns: 1fr;
        padding: 36px 16px 56px;
        gap: 24px;
    }
    .sidebar { order: -1; }
    .form-card { padding: 26px 22px; }
    .form-row { grid-template-columns: 1fr; gap: 0; }
}
</style>


<!-- HERO -->
<section class="hero-guest">
    <div class="hero-guest-inner">
        <span class="hero-badge">Balai Desa Bluto</span>
        <h1>Buku Tamu <span>Desa Bluto</span></h1>
        <p>Silakan mengisi buku tamu sebelum melakukan pelayanan di Balai Desa Bluto.</p>
    </div>
</section>


<!-- KONTEN UTAMA -->
<div class="page-wrap">

    <!-- FORM -->
    <div class="form-card">
        <div class="form-card-header">
            <span class="section-label">Formulir</span>
            <h2>Isi Buku Tamu</h2>
            <p>Lengkapi data diri Anda dengan benar sebelum masuk ke balai desa.</p>
        </div>

        <form>
            <div class="form-row">
                <div class="form-group">
                    <label>Nama Lengkap <span>*</span></label>
                    <input type="text" placeholder="Masukkan nama lengkap">
                </div>
                <div class="form-group">
                    <label>No. HP <span>*</span></label>
                    <input type="tel" placeholder="08xx-xxxx-xxxx">
                </div>
            </div>

            <div class="form-group">
                <label>Alamat <span>*</span></label>
                <input type="text" placeholder="Masukkan alamat lengkap">
            </div>

            <div class="form-group">
                <label>Keperluan <span>*</span></label>
                <select>
                    <option value="" disabled selected>Pilih keperluan</option>
                    <option>Surat Pengantar</option>
                    <option>Persetujuan Desa</option>
                    <option>Informasi Bantuan Sosial</option>
                    <option>Musyawarah Desa</option>
                    <option>Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label>Keterangan Tambahan</label>
                <textarea placeholder="Tuliskan keterangan atau detail keperluan Anda (opsional)"></textarea>
            </div>

            <button type="submit" class="btn-submit">✉️ &nbsp;Kirim Buku Tamu</button>
        </form>
    </div>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="info-card">
            <h3>🏛️ Info Balai Desa</h3>
            <div class="info-item">
                <div class="info-icon">📍</div>
                <div class="info-text">
                    <strong>Alamat</strong>
                    <span>Desa Bluto, Kec. Bluto, Kab. Sumenep, Madura</span>
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon">🕐</div>
                <div class="info-text">
                    <strong>Jam Pelayanan</strong>
                    <span>Senin – Jumat, 07.30 – 12.00 WIB</span>
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon">📞</div>
                <div class="info-text">
                    <strong>Kontak</strong>
                    <span>(0328) xxx-xxxx</span>
                </div>
            </div>
        </div>

        <div class="notice-card">
            <div class="notice-icon">ℹ️</div>
            <div class="notice-text">
                <p>Pastikan data yang Anda isi sudah benar. Buku tamu digunakan untuk keperluan administrasi dan keamanan Balai Desa Bluto.</p>
            </div>
        </div>

    </div>
</div>

@endsection