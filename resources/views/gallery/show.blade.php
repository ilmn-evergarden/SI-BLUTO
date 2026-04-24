@extends(Auth::user()->role == 'kepala_desa' 
    ? 'layouts.kepala.app' 
    : 'layouts.aparat.app')

@section('content')

@php
    $prefix = Auth::user()->role == 'kepala_desa' ? 'kepala' : 'aparat';
    $existingImageCount = $gallery->images->count() ?? 0;
    $canEdit = Auth::user()->role == 'kepala_desa' || (isset($gallery->created_by) && Auth::id() == $gallery->created_by);
@endphp

<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">

                {{-- 🔹 JUDUL --}}
                <h3 class="mb-3">{{ $gallery->title ?? 'Galeri Tanpa Judul' }}</h3>

                {{-- 🔹 STATUS --}}
                <p class="mb-3">
                    @php
                        $status = $gallery->status ?? 'draft';
                        $statusBadges = [
                            'draft' => ['badge badge-secondary', 'Draft'],
                            'review' => ['badge badge-warning', 'Review'],
                            'published' => ['badge badge-success', 'Published'],
                            'rejected' => ['badge badge-danger', 'Rejected']
                        ];
                        $badgeClass = $statusBadges[$status][0] ?? 'badge badge-secondary';
                        $badgeText = $statusBadges[$status][1] ?? 'Unknown';
                    @endphp
                    <span class="{{ $badgeClass }}">{{ $badgeText }}</span>
                    
                    @if(isset($gallery->created_at))
                        <small class="text-muted ms-2">
                            Dibuat: {{ $gallery->created_at->format('d M Y H:i') }}
                        </small>
                    @endif
                </p>

                {{-- 🔹 DESKRIPSI --}}
                @if($gallery->description)
                    <p class="mb-4">{{ $gallery->description }}</p>
                @endif

                {{-- 🔹 RELASI BERITA --}}
                @if(isset($gallery->news) && $gallery->news)
                    <div class="alert alert-info mb-4">
                        <i class="fas fa-newspaper me-2"></i>
                        Terhubung dengan berita: 
                        <strong>{{ $gallery->news->title }}</strong>
                    </div>
                @endif

                {{-- 🔹 PREVIEW GAMBAR UTAMA --}}
                @if($existingImageCount > 0)
                    <div class="mb-4 text-center position-relative">
                        <img id="mainImage"
                             src="{{ asset('storage/'.($gallery->images->first()->image ?? '')) }}"
                             class="img-fluid rounded shadow"
                             style="max-height:400px; object-fit: cover;"
                             alt="{{ $gallery->title }} - Gambar utama"
                             onerror="handleMainImageError(this)">
                        
                        {{-- LOADING INDICATOR --}}
                        <div id="imageLoader" class="position-absolute top-50 start-50 translate-middle">
                            <div class="spinner-border spinner-border-sm text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning text-center mb-4">
                        <i class="fas fa-images me-2"></i>
                        Tidak ada gambar pada galeri ini
                    </div>
                @endif

                {{-- 🔹 THUMBNAIL --}}
                @if($existingImageCount > 0)
                    <div class="row g-2">
                        @foreach ($gallery->images ?? [] as $img)
                            <div class="col-md-3 col-sm-4 col-6">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/'.($img->image ?? '')) }}"
                                         class="img-fluid rounded shadow-sm w-100 thumbnail-img"
                                         style="height: 120px; object-fit: cover; cursor:pointer;"
                                         onclick="changeImage('{{ asset('storage/'.$img->image) }}')"
                                         alt="Thumbnail {{ $loop->iteration }}"
                                         loading="lazy"
                                         onerror="handleThumbnailError(this)">
                                    
                                    {{-- SELECTED BORDER --}}
                                    <div class="thumbnail-border"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- 🔹 INFO --}}
                @if($existingImageCount > 0)
                    <div class="mt-3 p-3 bg-light rounded">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Klik thumbnail untuk melihat gambar lainnya ({{ $existingImageCount }} gambar)
                        </small>
                    </div>
                @endif

                {{-- 🔹 BUTTON --}}
                <div class="mt-4">
                    <a href="{{ route($prefix.'.gallery.index') }}" 
                       class="btn btn-light me-2">
                        <i class="fas fa-arrow-left me-1"></i>
                        Kembali
                    </a>

                    {{-- OPTIONAL: EDIT BUTTON --}}
                    @if($canEdit)
                        <a href="{{ route($prefix.'.gallery.edit', $gallery->id) }}" 
                           class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i>
                            Edit
                        </a>
                    @endif
                </div>

            </div>
        </div>

    </div>
</div>

{{-- 🔥 ROBUST JAVASCRIPT --}}
<script>
(function() {
    'use strict';
    
    let currentMainSrc = '';
    
    // Change main image with smooth transition
    window.changeImage = function(src) {
        const mainImage = document.getElementById('mainImage');
        const loader = document.getElementById('imageLoader');
        
        if (!mainImage || mainImage.src === src) return;
        
        // Show loader
        loader.style.display = 'block';
        mainImage.style.opacity = '0.5';
        
        // Preload image
        const img = new Image();
        img.onload = function() {
            currentMainSrc = src;
            mainImage.src = src;
            mainImage.style.opacity = '1';
            loader.style.display = 'none';
            updateThumbnailBorders(src);
        };
        img.onerror = function() {
            loader.style.display = 'none';
            mainImage.style.opacity = '1';
            alert('Gagal memuat gambar');
        };
        img.src = src;
    };
    
    // Update active thumbnail border
    function updateThumbnailBorders(activeSrc) {
        document.querySelectorAll('.thumbnail-img').forEach(thumb => {
            const border = thumb.nextElementSibling;
            if (thumb.src === activeSrc) {
                thumb.style.border = '3px solid #007bff';
                if (border) border.classList.add('active');
            } else {
                thumb.style.border = '1px solid transparent';
                if (border) border.classList.remove('active');
            }
        });
    }
    
    // Handle main image error
    window.handleMainImageError = function(img) {
        img.src = '{{ asset("images/no-image.png") }}';
        img.classList.add('border-warning');
        img.alt = 'Gambar tidak tersedia';
        document.getElementById('imageLoader').style.display = 'none';
    };
    
    // Handle thumbnail error
    window.handleThumbnailError = function(img) {
        img.src = '{{ asset("images/no-image.png") }}';
        img.classList.add('border-warning', 'opacity-50');
    };
    
    // Initialize on load
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('mainImage');
        if (mainImage) {
            currentMainSrc = mainImage.src;
            // Hide loader after load
            mainImage.addEventListener('load', function() {
                document.getElementById('imageLoader').style.display = 'none';
            });
        }
        
        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            const thumbs = document.querySelectorAll('.thumbnail-img');
            if (thumbs.length === 0) return;
            
            let currentIndex = Array.from(thumbs).findIndex(thumb => thumb.src === currentMainSrc);
            
            if (e.key === 'ArrowLeft' && currentIndex > 0) {
                changeImage(thumbs[currentIndex - 1].src);
            } else if (e.key === 'ArrowRight' && currentIndex < thumbs.length - 1) {
                changeImage(thumbs[currentIndex + 1].src);
            }
        });
    });
    
})();
</script>

<style>
.thumbnail-img:hover {
    transform: scale(1.05);
    transition: all 0.2s ease;
    z-index: 10;
}

.thumbnail-border {
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    border: 2px solid transparent;
    border-radius: 8px;
    transition: all 0.2s ease;
    pointer-events: none;
}

.thumbnail-border.active {
    border-color: #007bff !important;
    box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
}

#imageLoader {
    display: none;
    z-index: 20;
}

.opacity-50 {
    opacity: 0.5;
}
</style>

@endsection