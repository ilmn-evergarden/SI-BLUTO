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
                        <h4 class="card-title mb-1">Tambah Berita</h4>
                        <p class="text-muted mb-0" style="font-size: 0.85rem;">
                            Isi form berikut untuk mempublikasikan berita baru
                        </p>
                    </div>
                    <a href="{{ route($prefix . '.berita.index') }}"
                       class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
                        <i class="ti-arrow-left" style="font-size: 12px;"></i>
                        Kembali ke Daftar Berita
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

                <form action="{{ route($prefix . '.berita.store') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      id="beritaForm">
                    @csrf

                    <div class="row">

                        {{-- KOLOM KIRI: Konten --}}
                        <div class="col-lg-8">

                            {{-- JUDUL --}}
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">
                                    Judul Berita <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}"
                                       placeholder="Contoh: Musyawarah Desa Pembangunan Jalan 2025"
                                       required
                                       maxlength="255">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ISI BERITA --}}
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">
                                    Isi Berita <span class="text-danger">*</span>
                                </label>
                                <textarea name="content"
                                          id="editor"
                                          class="form-control @error('content') is-invalid @enderror"
                                          rows="8">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        {{-- KOLOM KANAN: Foto --}}
                        <div class="col-lg-4">

                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">
                                    Foto Sampul
                                    <span class="text-muted fw-normal">(opsional)</span>
                                </label>

                                {{-- UPLOAD AREA --}}
                                <label for="imageInput"
                                       id="uploadArea"
                                       class="d-flex flex-column align-items-center justify-content-center text-center p-4 rounded"
                                       style="border: 2px dashed #ced4da; cursor: pointer; min-height: 160px; transition: border-color 0.2s;">
                                    <i class="ti-image mb-2" style="font-size: 28px; color: #adb5bd;"></i>
                                    <span class="fw-semibold" style="font-size: 0.875rem;">Klik untuk pilih foto</span>
                                    <span class="badge bg-light text-secondary mt-2" style="font-size: 0.72rem;">
                                        JPG / PNG &bull; Maks. 2MB
                                    </span>
                                </label>

                                <input type="file"
                                       name="image"
                                       id="imageInput"
                                       accept="image/*"
                                       class="@error('image') is-invalid @enderror"
                                       style="display: none;"
                                       onchange="previewCover(event)">

                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- PREVIEW COVER --}}
                            <div id="coverPreviewWrapper" style="display: none;">
                                <div class="position-relative rounded overflow-hidden mb-1"
                                     style="height: 160px; border: 1px solid #dee2e6;">
                                    <img id="coverPreview"
                                         src=""
                                         class="w-100 h-100"
                                         style="object-fit: cover;"
                                         alt="preview foto sampul">
                                    <button type="button"
                                            class="btn btn-danger btn-sm position-absolute d-flex align-items-center gap-1"
                                            style="top: 6px; right: 6px; font-size: 11px; padding: 3px 8px;"
                                            onclick="removeCover()"
                                            title="Hapus foto sampul">
                                        <i class="ti-trash" style="font-size: 11px;"></i>
                                        Hapus Foto
                                    </button>
                                </div>
                                <p id="coverFileName"
                                   class="text-muted mb-0"
                                   style="font-size: 0.72rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                </p>
                            </div>

                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- ACTION BUTTONS --}}
                    <div class="d-flex align-items-center gap-2" style="gap:12px;">
                        <button type="submit"
                                class="btn btn-primary d-flex align-items-center gap-2"
                                id="submitBtn">
                            <i style="font-size: 14px;"></i>
                            Simpan & Publikasikan
                        </button>

                        <a href="{{ route($prefix . '.berita.index') }}"
                           class="btn btn-light d-flex align-items-center gap-1" >
                            <i style="font-size: 12px;"></i>
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

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
(function () {
    'use strict';

    const MAX_SIZE = 2 * 1024 * 1024; // 2MB
    const uploadArea    = document.getElementById('uploadArea');
    const imageInput    = document.getElementById('imageInput');
    const previewWrapper = document.getElementById('coverPreviewWrapper');
    const coverPreview  = document.getElementById('coverPreview');
    const coverFileName = document.getElementById('coverFileName');
    const submitBtn     = document.getElementById('submitBtn');
    const beritaForm    = document.getElementById('beritaForm');

    // Upload area hover effect
    uploadArea.addEventListener('mouseenter', () => uploadArea.style.borderColor = '#6c757d');
    uploadArea.addEventListener('mouseleave', () => uploadArea.style.borderColor = '#ced4da');

    window.previewCover = function (event) {
        const file = event.target.files[0];
        if (!file) return;

        if (!file.type.startsWith('image/')) {
            alert('"' + file.name + '" bukan file gambar yang valid.');
            imageInput.value = '';
            return;
        }
        if (file.size > MAX_SIZE) {
            alert('"' + file.name + '" melebihi batas ukuran 2MB.');
            imageInput.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            coverPreview.src = e.target.result;
            coverFileName.textContent = file.name;
            previewWrapper.style.display = 'block';
            uploadArea.style.display = 'none';
        };
        reader.readAsDataURL(file);
    };

    window.removeCover = function () {
        imageInput.value = '';
        coverPreview.src = '';
        coverFileName.textContent = '';
        previewWrapper.style.display = 'none';
        uploadArea.style.display = 'flex';
    };

    beritaForm.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="ti-reload"></i> Menyimpan...';
    });

    // CKEditor
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => console.error(error));

    // Auto-dismiss alerts
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            try { new bootstrap.Alert(el).close(); } catch (_) {}
        });
    }, 5000);

})();
</script>

@endsection