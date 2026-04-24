@extends('layouts.app')

@section('content')

<style>
/* ===== BASE ===== */
:root {
    --blue: #1a56db;
    --blue-dark: #1e3a8a;
    --blue-pale: #eff6ff;
    --blue-border: #bfdbfe;
    --gray: #f8fafc;
    --dark: #0f172a;
    --text-muted: #64748b;
    --radius: 14px;
    --shadow: 0 4px 24px rgba(26,86,219,0.08);
}

/* ===== HERO ===== */
.hero-gallery {
    background: linear-gradient(135deg, var(--blue-dark), var(--blue));
    padding: 80px 24px;
    text-align: center;
    color: white;
}
.hero-gallery h1 {
    font-size: 2.2rem;
    font-weight: 800;
}
.hero-gallery p {
    opacity: .8;
}

/* ===== SEARCH ===== */
.search-wrap {
    display: flex;
    justify-content: center;
    margin-top: -30px;
}
.search-bar {
    background: white;
    padding: 14px 20px;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    display: flex;
    gap: 10px;
    width: 90%;
    max-width: 600px;
}
.search-bar input {
    flex: 1;
    padding: 10px;
    border: 1px solid var(--blue-border);
    border-radius: 8px;
}
.search-bar button {
    background: var(--blue);
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 8px;
}

/* ===== GRID ===== */
.section-inner {
    max-width: 1100px;
    margin: 40px auto;
    padding: 0 20px;
}
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(3,1fr);
    gap: 20px;
}

/* ===== CARD ===== */
.gallery-card {
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    cursor: pointer;
}
.gallery-img {
    height: 200px;
    background-size: cover;
    background-position: center;
}
.gallery-info {
    padding: 14px;
    background: white;
}
.gallery-info h4 {
    font-size: 0.95rem;
    margin-bottom: 4px;
}
.gallery-info p {
    font-size: 0.8rem;
    color: var(--text-muted);
}

/* ===== LIGHTBOX ===== */
.lightbox {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.8);
    justify-content: center;
    align-items: center;
}
.lightbox.open {
    display: flex;
}
.lightbox-inner {
    background: white;
    border-radius: var(--radius);
    max-width: 500px;
    width: 90%;
}
.lightbox-img {
    height: 250px;
    background-size: cover;
}
.lightbox-body {
    padding: 20px;
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){
    .gallery-grid {
        grid-template-columns: repeat(2,1fr);
    }
}
@media(max-width:500px){
    .gallery-grid {
        grid-template-columns: 1fr;
    }
}
</style>


<!-- HERO -->
<section class="hero-gallery">
    <h1>Galeri Desa Bluto</h1>
    <p>Dokumentasi kegiatan masyarakat</p>
</section>


<!-- SEARCH -->
<div class="search-wrap">
    <form method="GET" action="{{ route('public.gallery.index') }}" class="search-bar">
        <input type="text" name="search" placeholder="Cari galeri..." value="{{ request('search') }}">
        <button>Cari</button>
    </form>
</div>


<!-- GRID -->
<div class="section-inner">

    <div class="gallery-grid">

        @foreach($galleries as $item)

            @php
                $img = $item->images->first();
                $url = $img ? asset('storage/'.$img->image) : 'https://via.placeholder.com/400';
            @endphp

            <div class="gallery-card"
                 onclick="window.location='{{ route('public.gallery.show', $item->id) }}'">

                <div class="gallery-img" style="background-image:url('{{ $url }}')"></div>

                <div class="gallery-info">
                    <h4>{{ $item->title }}</h4>
                    <p>{{ $item->created_at->format('d M Y') }}</p>
                </div>

            </div>

        @endforeach

    </div>

    <div style="margin-top:30px; text-align:center;">
        {{ $galleries->links() }}
    </div>

</div>


<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox" onclick="closeLightbox(event)">
    <div class="lightbox-inner">
        <div class="lightbox-img" id="lightbox-img"></div>
        <div class="lightbox-body">
            <h3 id="lightbox-title"></h3>
            <p id="lightbox-desc"></p>
        </div>
    </div>
</div>


<script>
function openLightbox(title, desc, image){
    document.getElementById('lightbox-title').innerText = title;
    document.getElementById('lightbox-desc').innerText = desc;

    let img = document.getElementById('lightbox-img');
    img.style.backgroundImage = `url(${image})`;

    document.getElementById('lightbox').classList.add('open');
}

function closeLightbox(e){
    if(e.target.id === 'lightbox'){
        document.getElementById('lightbox').classList.remove('open');
    }
}
</script>

@endsection