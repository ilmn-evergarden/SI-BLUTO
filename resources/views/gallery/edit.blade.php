@extends(Auth::user()->role == 'kepala_desa' 
    ? 'layouts.kepala.app' 
    : 'layouts.aparat.app')

@section('content')

@php
    $prefix = Auth::user()->role == 'kepala_desa' ? 'kepala' : 'aparat';
    $existingImageCount = $gallery->images->count() ?? 0;
@endphp

<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Edit Galeri</h4>

                {{-- SUCCESS --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- ERROR --}}
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- VALIDATION ERRORS --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- ===================== --}}
                {{-- 🔥 FORM UPDATE --}}
                {{-- ===================== --}}
                <form action="{{ route($prefix.'.gallery.update', $gallery->id) }}" 
                      method="POST" 
                      enctype="multipart/form-data"
                      id="galleryForm">

                    @csrf
                    @method('PUT')

                    {{-- JUDUL --}}
                    <div class="form-group mb-3">
                        <label class="form-label">Judul Galeri <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="title" 
                               class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title', $gallery->title) }}" 
                               required
                               maxlength="255">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="form-group mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  rows="3"
                                  maxlength="1000">{{ old('description', $gallery->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- RELASI BERITA --}}
                    <div class="form-group mb-3">
                        <label class="form-label">Hubungkan ke Berita</label>
                        <select name="news_id" class="form-control @error('news_id') is-invalid @enderror">
                            <option value="">-- Tidak terhubung --</option>
                            @if(isset($news) && $news->count() > 0)
                                @foreach($news as $item)
                                    <option value="{{ $item->id }}" 
                                        {{ old('news_id', $gallery->news_id ?? '') == $item->id ? 'selected' : '' }}>
                                        {{ Str::limit($item->title, 50) }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('news_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TAMBAH GAMBAR --}}
                    <div class="form-group mb-3">
                        <label class="form-label">Tambah Gambar Baru</label>
                        <input type="file" 
                               name="images[]" 
                               class="form-control @error('images') is-invalid @enderror"
                               id="imageInput"
                               multiple
                               accept="image/*"
                               onchange="previewImages(event)">
                        @error('images')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Opsional - tambah gambar baru (max 10, 5MB)</small>
                    </div>

                    {{-- PREVIEW --}}
                    <div class="row mb-3" id="previewContainer"></div>

                    {{-- BUTTON --}}
                    <div class="d-flex gap-2 mb-4">
                        <button type="submit" 
                                class="btn btn-primary" 
                                id="submitBtn"
                                {{ $existingImageCount == 0 ? 'disabled' : '' }}>
                            Update Galeri
                        </button>

                        <a href="{{ route($prefix.'.gallery.index') }}" class="btn btn-light">
                            Batal
                        </a>
                    </div>

                </form>

                {{-- ===================== --}}
                {{-- 🔥 GAMBAR (LUAR FORM) --}}
                {{-- ===================== --}}
                <hr>

                <div class="form-group">
                    <label class="form-label">Gambar Saat Ini ({{ $existingImageCount }})</label>

                    @if($existingImageCount == 0)
                        <div class="alert alert-warning">
                            Tidak ada gambar. Tambahkan minimal 1 gambar sebelum menyimpan.
                        </div>
                    @endif

                    @if($existingImageCount > 0)
                        <div class="row">
                            @foreach ($gallery->images ?? [] as $img)
                                <div class="col-md-3 mb-3 text-center">
                                    <img src="{{ asset('storage/'.($img->image ?? '')) }}" 
                                         class="img-fluid rounded mb-2"
                                         style="max-height: 150px; object-fit: cover;"
                                         onerror="this.src='{{ asset('images/no-image.png') }}'"
                                         alt="Gambar {{ $img->id }}">

                                    {{-- 🔥 DELETE IMAGE --}}
                                    <form action="{{ route($prefix.'.gallery.deleteImage', $img->id) }}" 
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Hapus gambar ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>

                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>

            </div>
        </div>

    </div>
</div>

{{-- 🔥 FIXED PREVIEW SCRIPT --}}
<script>
(function() {
    'use strict';
    
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('previewContainer');
    const submitBtn = document.getElementById('submitBtn');
    const galleryForm = document.getElementById('galleryForm');
    const existingImageCount = {{ $existingImageCount }};
    
    const MAX_FILES = 10;
    const MAX_SIZE = 5 * 1024 * 1024; // 5MB
    
    window.previewImages = function(event) {
        const files = Array.from(event.target.files);
        previewContainer.innerHTML = '';
        
        if (files.length > MAX_FILES) {
            alert(`Maksimal ${MAX_FILES} gambar!`);
            imageInput.value = '';
            updateSubmitBtn();
            return;
        }
        
        let validCount = 0;
        files.forEach((file) => {
            if (!file.type.startsWith('image/')) {
                alert(`File ${file.name} bukan gambar!`);
                return;
            }
            if (file.size > MAX_SIZE) {
                alert(`File ${file.name} terlalu besar (max 5MB)!`);
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-md-3 mb-2 position-relative';
                
                col.innerHTML = `
                    <img src="${e.target.result}" class="img-fluid rounded shadow-sm">
                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" 
                            onclick="this.parentElement.remove(); updateSubmitBtn();" 
                            title="Hapus preview">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                
                previewContainer.appendChild(col);
                validCount++;
                updateSubmitBtn();
            };
            reader.onerror = () => alert('Gagal membaca file');
            reader.readAsDataURL(file);
        });
    };
    
    function updateSubmitBtn() {
        const previewCount = previewContainer.children.length;
        const totalImages = existingImageCount + previewCount;
        submitBtn.disabled = totalImages === 0;
    }
    
    // Form submit protection
    galleryForm.addEventListener('submit', function(e) {
        const previewCount = previewContainer.children.length;
        const totalImages = existingImageCount + previewCount;
        
        if (totalImages === 0) {
            e.preventDefault();
            alert('Minimal 1 gambar diperlukan!');
            imageInput.focus();
            return false;
        }
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Update...';
    });
    
    // Auto-dismiss alerts
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
    
})();
</script>

@endsection