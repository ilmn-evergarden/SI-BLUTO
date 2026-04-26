@extends('layouts.aparat.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                {{-- HEADER --}}
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="card-title mb-1">Tambah Buku Tamu</h4>
                        <p class="text-muted mb-0" style="font-size: 0.85rem;">
                            Catat data pengunjung dan keperluan surat
                        </p>
                    </div>
                    <a href="{{ route('guest.index') }}"
                       class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
                        <i class="ti-arrow-left" style="font-size: 12px;"></i>
                        Kembali ke Daftar Tamu
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

                <form action="{{ route('guest.store') }}" method="POST" id="guestForm">
                    @csrf

                    <div class="row">

                        {{-- KOLOM KIRI: Data Pengunjung --}}
                        <div class="col-lg-6">

                            <p class="fw-semibold text-muted mb-3" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em;">
                                Data Pengunjung
                            </p>

                            {{-- NAMA --}}
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">
                                    Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}"
                                       placeholder="Contoh: Budi Santoso"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- INSTANSI --}}
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">
                                    Instansi / Asal
                                    <span class="text-muted fw-normal">(opsional)</span>
                                </label>
                                <input type="text"
                                       name="institution"
                                       class="form-control @error('institution') is-invalid @enderror"
                                       value="{{ old('institution') }}"
                                       placeholder="Contoh: Dinas Pertanian Kab. XYZ">
                                @error('institution')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- NO HP --}}
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">
                                    Nomor HP
                                    <span class="text-muted fw-normal">(opsional)</span>
                                </label>
                                <input type="text"
                                       name="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone') }}"
                                       placeholder="Contoh: 08123456789">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- TANGGAL KUNJUNGAN --}}
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">
                                    Tanggal Kunjungan <span class="text-danger">*</span>
                                </label>
                                <input type="date"
                                       name="visit_date"
                                       class="form-control @error('visit_date') is-invalid @enderror"
                                       value="{{ old('visit_date', date('Y-m-d')) }}"
                                       required>
                                @error('visit_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- TUJUAN --}}
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">
                                    Tujuan / Keperluan <span class="text-danger">*</span>
                                </label>
                                <textarea name="purpose"
                                          class="form-control @error('purpose') is-invalid @enderror"
                                          rows="3"
                                          placeholder="Tuliskan keperluan kunjungan..."
                                          required>{{ old('purpose') }}</textarea>
                                @error('purpose')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        {{-- KOLOM KANAN: Data Surat --}}
                        <div class="col-lg-6">

                            <p class="fw-semibold text-muted mb-3" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em;">
                                Data Surat
                            </p>

                            {{-- JENIS SURAT --}}
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">
                                    Jenis Surat
                                    <span class="text-muted fw-normal">(opsional)</span>
                                </label>
                                <div class="d-flex gap-2" style="gap:12px;">
                                    <select name="letter_type_id"
                                            id="letterTypeSelect"
                                            class="form-control @error('letter_type_id') is-invalid @enderror"
                                            style="flex: 1;">
                                        <option value="">-- Pilih jenis surat --</option>
                                        @foreach ($letterTypes as $type)
                                            <option value="{{ $type->id }}"
                                                {{ old('letter_type_id') == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <a href="{{ route('letter-types.manage') }}"
                                       class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1"
                                       style="white-space: nowrap;"
                                       title="Tambah atau ubah jenis surat">
                                        <i style="font-size: 12px;"></i>
                                        Kelola Jenis Surat
                                    </a>
                                </div>
                                @error('letter_type_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ATAU INPUT MANUAL --}}
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">
                                    Atau Tulis Jenis Surat Sendiri
                                    <span class="text-muted fw-normal">(jika tidak ada di daftar)</span>
                                </label>
                                <input type="text"
                                       name="custom_letter_type"
                                       id="customLetterType"
                                       class="form-control @error('custom_letter_type') is-invalid @enderror"
                                       value="{{ old('custom_letter_type') }}"
                                       placeholder="Contoh: Surat Keterangan Usaha">
                                <small class="text-muted">
                                    <i class="ti-info-alt" style="font-size: 11px;"></i>
                                    Pilih dari daftar <strong>atau</strong> tulis manual — tidak perlu keduanya
                                </small>
                                @error('custom_letter_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- NOMOR SURAT --}}
                            <div class="form-group mb-3">
                                <label class="form-label fw-semibold">
                                    Nomor Surat
                                    <span class="text-muted fw-normal">(opsional)</span>
                                </label>
                                <input type="text"
                                       name="letter_number"
                                       class="form-control @error('letter_number') is-invalid @enderror"
                                       value="{{ old('letter_number') }}"
                                       placeholder="Contoh: 474/123/2025">
                                @error('letter_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- INFO BOX --}}
                            <div class="p-3 rounded mt-2"
                                 style="background: var(--color-background-info, #e8f4fd); border: 0.5px solid #b8d9f5; font-size: 0.82rem;">
                                <div class="d-flex gap-2">
                                    <i style="font-size: 13px; flex-shrink: 0;"></i>
                                    <div style="color: #1a5276;">
                                        <strong>Catatan pengisian surat:</strong><br>
                                        Data surat bersifat opsional. Jika tamu tidak membawa surat, kolom ini bisa dikosongkan.
                                        Jenis surat dari daftar dan isian manual tidak perlu diisi bersamaan.
                                    </div>
                                </div>
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
                            Simpan Data Tamu
                        </button>

                        <a href="{{ route('guest.index') }}"
                           class="btn btn-light d-flex align-items-center gap-1">
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    const select = document.getElementById('letterTypeSelect');
    const manual = document.getElementById('customLetterType');
    const submitBtn = document.getElementById('submitBtn');

    if (select && manual) {

        // Pilih dari dropdown → kosongkan & disable manual
        select.addEventListener('change', function () {
            if (this.value !== '') {
                manual.value = '';
                manual.disabled = true;
                manual.placeholder = 'Tidak diperlukan jika memilih dari daftar';
                manual.style.background = '#f8f9fa';
            } else {
                manual.disabled = false;
                manual.placeholder = 'Contoh: Surat Keterangan Usaha';
                manual.style.background = '';
            }
        });

        // Tulis manual → kosongkan & disable dropdown
        manual.addEventListener('input', function () {
            if (this.value !== '') {
                select.value = '';
                select.disabled = true;
                select.style.background = '#f8f9fa';
            } else {
                select.disabled = false;
                select.style.background = '';
            }
        });
    }

    // Loading state saat submit
    document.getElementById('guestForm').addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="ti-reload"></i> Menyimpan...';
    });

    // Auto-dismiss alerts
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            try { new bootstrap.Alert(el).close(); } catch (_) {}
        });
    }, 5000);

});
</script>

@endsection