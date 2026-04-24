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
.hero-contact {
    background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue) 60%, #0ea5e9 100%);
    padding: 80px 24px 72px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.hero-contact::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='30' cy='30' r='20' fill='%23ffffff' fill-opacity='0.04'/%3E%3C/svg%3E");
    pointer-events: none;
}
.hero-contact-inner { position: relative; z-index: 1; max-width: 560px; margin: 0 auto; }
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
.hero-contact h1 {
    font-size: clamp(1.8rem, 5vw, 2.8rem);
    font-weight: 800;
    color: white;
    margin: 0 0 12px;
    line-height: 1.2;
}
.hero-contact h1 span {
    background: linear-gradient(90deg, #93c5fd, #e0f2fe);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.hero-contact-inner > p { color: rgba(255,255,255,0.8); font-size: 1rem; }

/* ===== SECTION WRAP ===== */
.section-wrap { padding: 56px 24px; }
.section-wrap.bg-gray { background: var(--gray); }
.section-inner { max-width: 1040px; margin: 0 auto; }

.section-header { text-align: center; margin-bottom: 36px; }
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
    margin-bottom: 10px;
}
.section-title {
    font-size: clamp(1.3rem, 3vw, 1.8rem);
    font-weight: 800;
    color: var(--dark);
    margin: 0;
}

/* ===== INFO GRID ===== */
.info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}
.info-card {
    background: white;
    border: 1px solid var(--blue-border);
    border-radius: var(--radius);
    padding: 28px 24px;
    box-shadow: var(--shadow);
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 14px;
    transition: transform .2s, box-shadow .2s;
}
.info-card:hover { transform: translateY(-4px); box-shadow: 0 14px 36px rgba(26,86,219,0.12); }
.info-icon-wrap {
    width: 52px; height: 52px;
    background: var(--blue-pale);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}
.info-card-body strong {
    display: block;
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 6px;
}
.info-card-body p { font-size: 0.9rem; line-height: 1.75; }
.info-card-body a {
    color: var(--blue);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
}
.info-card-body a:hover { text-decoration: underline; }

/* ===== JAM PELAYANAN ===== */
.jam-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
    margin-top: 4px;
}
.jam-item {
    background: var(--blue-pale);
    border: 1px solid var(--blue-border);
    border-radius: 10px;
    padding: 14px 16px;
}
.jam-item .hari {
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--blue);
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 4px;
}
.jam-item .waktu {
    font-size: 1rem;
    font-weight: 800;
    color: var(--dark);
}
.jam-item.tutup { background: #fef2f2; border-color: #fecaca; }
.jam-item.tutup .hari { color: #ef4444; }
.jam-item.tutup .waktu { color: #b91c1c; }

/* ===== FORM + JAM LAYOUT ===== */
.contact-layout {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 28px;
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
.form-card-header h2 {
    font-size: 1.3rem;
    font-weight: 800;
    color: var(--dark);
    margin: 0 0 6px;
}
.form-card-header p { font-size: 0.88rem; }

.form-group { margin-bottom: 18px; }
.form-group label {
    display: block;
    font-size: 0.87rem;
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
.form-group textarea { resize: vertical; min-height: 120px; }
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
    letter-spacing: 0.2px;
    margin-top: 4px;
}
.btn-submit:hover { opacity: .88; transform: translateY(-1px); }

/* ===== SIDEBAR JAM ===== */
.sidebar-jam {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.jam-card {
    background: white;
    border: 1px solid var(--blue-border);
    border-radius: var(--radius);
    padding: 26px 24px;
    box-shadow: var(--shadow);
}
.jam-card h3 {
    font-size: 0.97rem;
    font-weight: 700;
    color: var(--dark);
    margin: 0 0 18px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--blue-pale);
    display: flex;
    align-items: center;
    gap: 8px;
}
.sosmed-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.sosmed-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 14px;
    border: 1px solid var(--blue-border);
    border-radius: 10px;
    text-decoration: none;
    transition: background .2s;
}
.sosmed-item:hover { background: var(--blue-pale); }
.sosmed-item span:first-child { font-size: 1.2rem; }
.sosmed-item .sosmed-label {
    font-size: 0.87rem;
    font-weight: 600;
    color: var(--text);
}

/* ===== PETA ===== */
.map-card {
    background: white;
    border: 1px solid var(--blue-border);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
}
.map-card iframe {
    width: 100%;
    height: 400px;
    border: 0;
    display: block;
}
.map-footer {
    padding: 18px 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    border-top: 1px solid var(--blue-border);
    flex-wrap: wrap;
}
.map-footer-icon {
    width: 40px; height: 40px;
    background: var(--blue-pale);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.map-footer-text strong {
    display: block;
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--dark);
}
.map-footer-text span { font-size: 0.83rem; color: var(--text-muted); }
.map-footer a {
    margin-left: auto;
    background: var(--blue);
    color: white;
    padding: 9px 20px;
    border-radius: 8px;
    font-size: 0.87rem;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    transition: opacity .2s;
}
.map-footer a:hover { opacity: .85; }

/* ===== RESPONSIVE ===== */
@media (max-width: 900px) {
    .info-grid { grid-template-columns: 1fr 1fr; }
    .contact-layout { grid-template-columns: 1fr; }
    .sidebar-jam { order: -1; }
    .jam-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .section-wrap { padding: 40px 16px; }
    .info-grid { grid-template-columns: 1fr; }
    .form-card { padding: 24px 20px; }
    .form-row { grid-template-columns: 1fr; gap: 0; }
    .map-card iframe { height: 280px; }
    .map-footer { gap: 10px; }
    .map-footer a { margin-left: 0; width: 100%; text-align: center; }
}
</style>


<!-- HERO -->
<section class="hero-contact">
    <div class="hero-contact-inner">
        <span class="hero-badge">Balai Desa Bluto</span>
        <h1>Kontak <span>Desa Bluto</span></h1>
        <p>Hubungi kami untuk informasi layanan dan kegiatan Desa Bluto</p>
    </div>
</section>


<!-- INFO KONTAK -->
<div class="section-wrap">
    <div class="section-inner">
        <div class="section-header">
            <span class="section-label">Informasi</span>
            <h2 class="section-title">Cara Menghubungi Kami</h2>
        </div>
        <div class="info-grid">
            <div class="info-card">
                <div class="info-icon-wrap">📍</div>
                <div class="info-card-body">
                    <strong>Alamat</strong>
                    <p>Balai Desa Bluto, Kecamatan Bluto,<br>Kabupaten Sumenep, Madura</p>
                </div>
            </div>
            <div class="info-card">
                <div class="info-icon-wrap">📞</div>
                <div class="info-card-body">
                    <strong>Telepon & Email</strong>
                    <p>
                        <a href="tel:08xxxxxxxxxx">08xxxxxxxxxx</a><br>
                        <a href="mailto:desa.bluto@email.com">desa.bluto@email.com</a>
                    </p>
                </div>
            </div>
            <div class="info-card">
                <div class="info-icon-wrap">🕐</div>
                <div class="info-card-body">
                    <strong>Jam Pelayanan</strong>
                    <p>Senin – Jumat<br>07.30 – 12.00 WIB<br>Sabtu & Minggu: Tutup</p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- FORM + SIDEBAR -->
<div class="section-wrap bg-gray">
    <div class="section-inner">
        <div class="contact-layout">

            <!-- FORM -->
            <div class="form-card">
                <div class="form-card-header">
                    <span class="section-label">Pesan</span>
                    <h2>Hubungi Kami</h2>
                    <p>Isi formulir berikut dan kami akan segera merespons pesan Anda.</p>
                </div>
                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Lengkap <span>*</span></label>
                            <input type="text" placeholder="Masukkan nama">
                        </div>
                        <div class="form-group">
                            <label>No. HP <span>*</span></label>
                            <input type="tel" placeholder="08xx-xxxx-xxxx">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email <span>*</span></label>
                        <input type="email" placeholder="contoh@email.com">
                    </div>
                    <div class="form-group">
                        <label>Topik</label>
                        <select>
                            <option value="" disabled selected>Pilih topik pesan</option>
                            <option>Informasi Layanan</option>
                            <option>Bantuan Sosial</option>
                            <option>Pengaduan</option>
                            <option>Saran & Masukan</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pesan <span>*</span></label>
                        <textarea placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>
                    <button type="submit" class="btn-submit">📨 &nbsp;Kirim Pesan</button>
                </form>
            </div>

            <!-- SIDEBAR -->
            <div class="sidebar-jam">
                <div class="jam-card">
                    <h3>🕐 Jam Pelayanan</h3>
                    <div class="jam-grid">
                        <div class="jam-item">
                            <div class="hari">Senin – Kamis</div>
                            <div class="waktu">07.30 – 12.00</div>
                        </div>
                        <div class="jam-item">
                            <div class="hari">Jumat</div>
                            <div class="waktu">07.30 – 11.00</div>
                        </div>
                        <div class="jam-item tutup">
                            <div class="hari">Sabtu</div>
                            <div class="waktu">Tutup</div>
                        </div>
                        <div class="jam-item tutup">
                            <div class="hari">Minggu</div>
                            <div class="waktu">Tutup</div>
                        </div>
                    </div>
                </div>

                <div class="jam-card">
                    <h3>🌐 Media Sosial</h3>
                    <div class="sosmed-list">
                        <a href="#" class="sosmed-item">
                            <span>📘</span>
                            <span class="sosmed-label">Facebook Desa Bluto</span>
                        </a>
                        <a href="#" class="sosmed-item">
                            <span>📸</span>
                            <span class="sosmed-label">Instagram @desabluto</span>
                        </a>
                        <a href="#" class="sosmed-item">
                            <span>💬</span>
                            <span class="sosmed-label">WhatsApp Desa</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- PETA LOKASI -->
<div class="section-wrap">
    <div class="section-inner">
        <div class="section-header">
            <span class="section-label">Lokasi</span>
            <h2 class="section-title">Peta Desa Bluto</h2>
        </div>
        <div class="map-card">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15820!2d113.8!3d-7.05!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMDMnMDAuMCJTIDExM8KwNDgnMDAuMCJF!5e0!3m2!1sid!2sid!4v1234567890"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <div class="map-footer">
                <div class="map-footer-icon">📍</div>
                <div class="map-footer-text">
                    <strong>Balai Desa Bluto</strong>
                    <span>Kecamatan Bluto, Kabupaten Sumenep, Madura, Jawa Timur</span>
                </div>
                <a href="https://maps.google.com/?q=Bluto,Sumenep" target="_blank">Buka di Maps →</a>
            </div>
        </div>
    </div>
</div>

@endsection