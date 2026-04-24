@extends(Auth::user()->role == 'kepala_desa' ? 'layouts.kepala.app' : 'layouts.aparat.app')

@section('content')

    @php
        $prefix = Auth::user()->role == 'kepala_desa' ? 'kepala' : 'aparat';
    @endphp

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Tambah Galeri</h4>

                    {{-- SUCCESS --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- ERROR --}}
                    @if (session('error'))
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

                    <form action="{{ route($prefix . '.gallery.store') }}" method="POST" enctype="multipart/form-data"
                        id="galleryForm">

                        @csrf

                        {{-- JUDUL --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Judul Galeri <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" required maxlength="255">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- DESKRIPSI --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Deskripsi (opsional)</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3"
                                maxlength="1000">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- RELASI BERITA --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Hubungkan ke Berita (opsional)</label>
                            <select name="news_id" class="form-control @error('news_id') is-invalid @enderror">
                                <option value="">-- Tidak terhubung --</option>

                                @forelse($news as $item)
                                    <option value="{{ $item->id }}" {{ old('news_id') == $item->id ? 'selected' : '' }}>
                                        {{ Str::limit($item->title, 40) }}
                                        ({{ $item->created_at->format('d M Y') }})
                                    </option>
                                @empty
                                    <option disabled>Semua berita sudah memiliki galeri</option>
                                @endforelse
                            </select>

                            <small class="text-muted">
                                Setiap berita hanya bisa memiliki 1 galeri
                            </small>
                            @error('news_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- UPLOAD GAMBAR --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Upload Gambar <span class="text-danger">*</span> (boleh lebih dari
                                1)</label>
                            <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror"
                                id="imageInput" multiple accept="image/*" required onchange="previewImages(event)">
                            @error('images')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Min 1 gambar, max 10 gambar (JPG/PNG, max 5MB)</small>
                        </div>

                        {{-- PREVIEW --}}
                        <div class="row mb-3" id="previewContainer"></div>

                        {{-- BUTTON --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                                Simpan Galeri
                            </button>

                            <a href="{{ route($prefix . '.gallery.index') }}" class="btn btn-light">
                                Batal
                            </a>
                        </div>

                    </form>

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

            const MAX_FILES = 10;
            const MAX_SIZE = 5 * 1024 * 1024; // 5MB

            window.previewImages = function(event) {
                const files = Array.from(event.target.files);
                previewContainer.innerHTML = '';

                // Validate count
                if (files.length > MAX_FILES) {
                    alert(`Maksimal ${MAX_FILES} gambar!`);
                    imageInput.value = '';
                    updateSubmitBtn();
                    return;
                }

                let validCount = 0;
                files.forEach((file, i) => {
                    // Validate type & size
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
                        col.className = 'col-md-3 col-sm-6 col-12 mb-2 position-relative';

                        col.innerHTML = `
                    <img src="${e.target.result}" class="img-fluid rounded shadow-sm w-100" style="height: 150px; object-fit: cover;">
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
                    reader.onerror = () => alert('Gagal membaca file: ' + file.name);
                    reader.readAsDataURL(file);
                });
            };

            function updateSubmitBtn() {
                const previewCount = previewContainer.children.length;
                submitBtn.disabled = previewCount === 0;
            }

            // Form submit protection
            galleryForm.addEventListener('submit', function(e) {
                if (previewContainer.children.length === 0) {
                    e.preventDefault();
                    alert('Pilih minimal 1 gambar!');
                    imageInput.focus();
                    return false;
                }

                // Loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Simpan...';
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
