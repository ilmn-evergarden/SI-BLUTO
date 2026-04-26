@extends(Auth::user()->role == 'kepala_desa' ? 'layouts.kepala.app' : 'layouts.aparat.app')

@section('content')

@php
    $prefix = Auth::user()->role == 'kepala_desa' ? 'kepala' : 'aparat';
@endphp

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                {{-- HEADER --}}
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="card-title mb-1">Tambah Galeri</h4>
                        <p class="text-muted mb-0" style="font-size: 0.85rem;">
                            Upload foto dan hubungkan ke berita yang relevan
                        </p>
                    </div>
                    <a href="{{ route($prefix . '.gallery.index') }}"
                       class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
                        <i class="ti-arrow-left" style="font-size: 12px;"></i>
                        Kembali ke Daftar Galeri
                    </a>
                </div>

                {{-- ALERTS --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2">
                        <i class="ti-check-box"></i>
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2">
                        <i class="ti-alert"></i>
                        <span>{{ session('error') }}</span>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="ti-alert"></i>
                            <strong>Mohon periksa kesalahan berikut:</strong>
                        </div>
                        <ul class="mb-0 ps-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route($prefix . '.gallery.store') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      id="galleryForm">
                    @csrf

                    <div class="row">

                        {{-- KOLOM KIRI --}}
                        <div class="col-lg-8">

                            {{-- JUDUL --}}
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">
                                    Judul Galeri <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}"
                                       placeholder="Contoh: Kegiatan Gotong Royong April 2025"
                                       required
                                       maxlength="255">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- DESKRIPSI --}}
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">
                                    Deskripsi
                                    <span class="text-muted fw-normal">(opsional)</span>
                                </label>
                                <textarea name="description"
                                          class="form-control @error('description') is-invalid @enderror"
                                          rows="3"
                                          maxlength="1000"
                                          placeholder="Tambahkan keterangan singkat tentang galeri ini...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- RELASI BERITA --}}
                            <div class="form-group mb-4">
                                <label class="form-label fw-semibold">
                                    Hubungkan ke Berita
                                    <span class="text-muted fw-normal">(opsional)</span>
                                </label>
                                <select name="news_id"
                                        class="form-control @error('news_id') is-invalid @enderror">
                                    <option value="">-- Tidak dihubungkan ke berita --</option>
                                    @forelse($news as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('news_id') == $item->id ? 'selected' : '' }}>
                                            {{ Str::limit($item->title, 50) }}
                                            ({{ $item->created_at->format('d M Y') }})
                                        </option>
                                    @empty
                                        <option disabled>Semua berita sudah memiliki galeri</option>
                                    @endforelse
                                </select>
                                <small class="text-muted">
                                    <i class="ti-info-alt" style="font-size: 11px;"></i>
                                    Setiap berita hanya bisa dihubungkan ke 1 galeri
                                </small>
                                @error('news_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        {{-- KOLOM KANAN: UPLOAD --}}
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">
                                    Upload Foto <span class="text-danger">*</span>
                                </label>

                                {{-- UPLOAD AREA --}}
                                <label for="imageInput"
                                       id="uploadArea"
                                       class="d-flex flex-column align-items-center justify-content-center text-center p-4 rounded"
                                       style="border: 2px dashed #ced4da; cursor: pointer; min-height: 140px; transition: border-color 0.2s;">
                                    <i class="ti-image mb-2" style="font-size: 28px; color: #adb5bd;"></i>
                                    <span class="fw-semibold" style="font-size: 0.875rem;">Klik untuk pilih foto</span>
                                    <span class="badge bg-light text-secondary mt-2" style="font-size: 0.72rem;">
                                        JPG / PNG &bull; Maks. 5MB per file &bull; Maks. 10 foto
                                    </span>
                                </label>

                                <input type="file"
                                       name="images[]"
                                       class="@error('images') is-invalid @enderror"
                                       id="imageInput"
                                       multiple
                                       accept="image/*"
                                       required
                                       style="display: none;"
                                       onchange="previewImages(event)">

                                @error('images')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    {{-- PREVIEW AREA --}}
                    <div id="previewWrapper" style="display: none;">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <label class="form-label fw-semibold mb-0">
                                Preview Foto
                                <span class="badge bg-primary ms-1" id="photoCount">0</span>
                            </label>
                            <button type="button"
                                    class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1"
                                    onclick="clearAllImages()"
                                    title="Hapus semua foto yang dipilih">
                                <i class="ti-trash" style="font-size: 12px;"></i>
                                Hapus Semua Foto
                            </button>
                        </div>
                        <div class="row" id="previewContainer"></div>
                    </div>

                    <hr class="my-4">

                    {{-- ACTION BUTTONS --}}
                    <div class="d-flex align-items-center gap-2" style="gap:12px;">
                        <button type="submit"
                                class="btn btn-primary d-flex align-items-center gap-2"
                                id="submitBtn"
                                disabled>
                            <i  style="font-size: 14px;"></i>
                            Simpan Galeri
                        </button>

                        <a href="{{ route($prefix . '.gallery.index') }}"
                           class="btn btn-light d-flex align-items-center gap-1">
                            <i  style="font-size: 12px;"></i>
                            Batal
                        </a>

                        <span class="text-muted ms-auto" style="font-size: 0.8rem;">
                            <span class="text-danger">*</span> wajib diisi
                        </span>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<script>
(function () {
    'use strict';

    const imageInput      = document.getElementById('imageInput');
    const previewContainer = document.getElementById('previewContainer');
    const previewWrapper  = document.getElementById('previewWrapper');
    const submitBtn       = document.getElementById('submitBtn');
    const photoCount      = document.getElementById('photoCount');
    const uploadArea      = document.getElementById('uploadArea');
    const galleryForm     = document.getElementById('galleryForm');

    const MAX_FILES = 10;
    const MAX_SIZE  = 5 * 1024 * 1024;

    // Highlight upload area on hover
    uploadArea.addEventListener('mouseenter', () => uploadArea.style.borderColor = '#6c757d');
    uploadArea.addEventListener('mouseleave', () => uploadArea.style.borderColor = '#ced4da');

    window.previewImages = function (event) {
        const files = Array.from(event.target.files);
        previewContainer.innerHTML = '';

        if (files.length > MAX_FILES) {
            alert(`Maksimal ${MAX_FILES} foto yang dapat diunggah.`);
            imageInput.value = '';
            updateUI();
            return;
        }

        files.forEach(file => {
            if (!file.type.startsWith('image/')) {
                alert(`"${file.name}" bukan file gambar yang valid.`);
                return;
            }
            if (file.size > MAX_SIZE) {
                alert(`"${file.name}" melebihi batas ukuran 5MB.`);
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                const col = document.createElement('div');
                col.className = 'col-md-3 col-sm-6 col-12 mb-3';
                col.innerHTML = `
                    <div class="position-relative rounded overflow-hidden"
                         style="height: 140px; border: 1px solid #dee2e6;">
                        <img src="${e.target.result}"
                             class="w-100 h-100"
                             style="object-fit: cover;"
                             alt="preview foto">
                        <button type="button"
                                class="btn btn-danger btn-sm position-absolute d-flex align-items-center gap-1"
                                style="top: 6px; right: 6px; font-size: 11px; padding: 3px 8px;"
                                onclick="removePreview(this)"
                                title="Hapus foto ini">
                            <i class="ti-trash" style="font-size: 11px;"></i>
                            Hapus
                        </button>
                    </div>
                    <p class="text-muted mt-1 mb-0"
                       style="font-size: 0.72rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        ${file.name}
                    </p>
                `;
                previewContainer.appendChild(col);
                updateUI();
            };
            reader.onerror = () => alert('Gagal membaca file: ' + file.name);
            reader.readAsDataURL(file);
        });
    };

    window.removePreview = function (btn) {
        btn.closest('.col-md-3').remove();
        updateUI();
    };

    window.clearAllImages = function () {
        if (!confirm('Hapus semua foto yang dipilih?')) return;
        previewContainer.innerHTML = '';
        imageInput.value = '';
        updateUI();
    };

    function updateUI() {
        const count = previewContainer.children.length;
        submitBtn.disabled = count === 0;
        photoCount.textContent = count;
        previewWrapper.style.display = count > 0 ? 'block' : 'none';
    }

    galleryForm.addEventListener('submit', function (e) {
        if (previewContainer.children.length === 0) {
            e.preventDefault();
            alert('Pilih minimal 1 foto sebelum menyimpan.');
            imageInput.focus();
            return;
        }
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="ti-reload"></i> Menyimpan...';
    });

    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            try { new bootstrap.Alert(el).close(); } catch (_) {}
        });
    }, 5000);

})();
</script>

@endsection