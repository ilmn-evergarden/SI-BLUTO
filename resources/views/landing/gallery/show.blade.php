@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&family=Outfit:wght@300;400;500;600;700&display=swap');

:root {
    --primary: #2563eb;
    --primary-dark: #1d4ed8;
    --dark: #0f172a;
    --text-muted: #94a3b8;
    --radius: 14px;
    --radius-sm: 10px;
    --shadow-sm: 0 2px 8px rgba(0,0,0,.05);
    --shadow: 0 6px 24px rgba(0,0,0,.08);
    --shadow-lg: 0 12px 40px rgba(0,0,0,.15);
}

/* ===== CONTAINER ===== */
.container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 40px 24px 80px;
    font-family: 'Outfit', sans-serif;
}

/* ===== HEADER ===== */
.gallery-header {
    background: linear-gradient(135deg, #0f172a, #1e3a5f);
    padding: 60px 40px;
    border-radius: var(--radius);
    color: white;
    margin-bottom: 30px;
    box-shadow: var(--shadow);
}

.gallery-header h1 {
    font-family: 'Lora', serif;
    font-size: 2rem;
    margin-bottom: 12px;
}

.gallery-header p {
    opacity: 0.85;
    margin-bottom: 6px;
}

/* DATE STYLE */
.date-text {
    font-size: 0.9rem;
    color: var(--text-muted);
    margin-top: 10px;
}

/* ===== BUTTON ===== */
.news-btn-container {
    margin-bottom: 30px;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--primary);
    color: white;
    padding: 10px 18px;
    border-radius: var(--radius-sm);
    font-weight: 600;
    text-decoration: none;
    font-size: 0.9rem;
    transition: 0.2s;
}

.btn:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

/* ===== GRID ===== */
.gallery-images {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

/* ===== IMAGE ===== */
.gallery-images img {
    width: 100%;
    height: 230px;
    object-fit: cover;
    border-radius: var(--radius-sm);
    cursor: pointer;
    transition: all .25s ease;
    box-shadow: var(--shadow-sm);
}

.gallery-images img:hover {
    transform: scale(1.03);
    box-shadow: var(--shadow-lg);
}

/* ===== LIGHTBOX ===== */
.lightbox {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.9);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.lightbox.open {
    display: flex;
}

.lightbox img {
    max-width: 90%;
    max-height: 85%;
    border-radius: var(--radius);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 900px) {
    .gallery-images {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .gallery-header {
        padding: 40px 24px;
    }

    .gallery-images {
        grid-template-columns: 1fr;
    }

    .gallery-images img {
        height: 260px;
    }
}
</style>


<div class="container">

    <!-- HEADER -->
    <div class="gallery-header">
        <h1>{{ $gallery->title }}</h1>
        <p>{{ $gallery->description ?? '-' }}</p>
        <p class="date-text">{{ $gallery->created_at->format('d M Y') }}</p>
    </div>

    <!-- BUTTON -->
    @if ($gallery->news && $gallery->news->status == 'published')
        <div class="news-btn-container">
            <a href="{{ route('public.berita.show', $gallery->news->slug) }}" class="btn">
                Baca Berita Terkait
            </a>
        </div>
    @endif

    <!-- GRID -->
    <div class="gallery-images">
        @foreach ($gallery->images as $img)
            <img src="{{ asset('storage/' . $img->image) }}"
                 onclick="openLightbox('{{ asset('storage/' . $img->image) }}')">
        @endforeach
    </div>

</div>


<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox" onclick="closeLightbox()">
    <img id="lightbox-img">
</div>


<script>
function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLightbox();
});
</script>

@endsection