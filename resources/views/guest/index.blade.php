@extends('layouts.aparat.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">Buku Tamu</h4>

                    {{-- HEADER BUTTON --}}
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                        <a href="{{ route('guest.create') }}" class="btn btn-primary mb-3">
                            <i class="fas fa-plus me-1"></i> Tambah Tamu
                        </a>

                        <a href="{{ route('guest.export', request()->query()) }}"
                            class="btn rounded-pill px-4 py-2 fw-semibold" style="background-color:#10b981; color:#fff;">
                            Export File
                        </a>
                    </div>

                    {{-- FILTER --}}
                    <form method="GET" action="{{ route('guest.index') }}" class="mb-4">
                        <div class="row g-3 align-items-end">

                            <div class="col-md-6 col-lg-3">
                                <label class="form-label small text-muted">Cari</label>
                                <input type="text" name="search" class="form-control" placeholder="Nama / tujuan"
                                    value="{{ request('search') }}">
                            </div>

                            <div class="col-md-6 col-lg-2">
                                <label class="form-label small text-muted">Dari</label>
                                <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                            </div>

                            <div class="col-md-6 col-lg-2">
                                <label class="form-label small text-muted">Sampai</label>
                                <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                            </div>

                            <div class="col-md-6 col-lg-2">
                                <label class="form-label small text-muted">Urutkan</label>
                                <select name="sort" class="form-control">
                                    <option value="latest" {{ request('sort') != 'oldest' ? 'selected' : '' }}>Terbaru
                                    </option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 col-lg-3 d-flex align-items-end">

                                <button class="btn text-white" style="background:#4f46e5; margin-right:10px; margin-top: 0.9rem;">
                                    <i class="fas fa-search me-1"></i> Filter
                                </button>

                                @if (request()->hasAny(['search', 'from', 'to', 'sort']))
                                    <a href="{{ route('guest.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-1"></i> Reset
                                    </a>
                                @endif

                            </div>

                        </div>
                    </form>

                    {{-- INFO --}}
                    @if ($guests->count() > 0)
                        <p class="text-muted small mb-3">
                            Menampilkan {{ $guests->firstItem() }}–{{ $guests->lastItem() }}
                            dari {{ $guests->total() }} data
                        </p>
                    @endif

                    {{-- TABLE --}}
                    <div class="table-responsive">
                        <table class="table align-middle">

                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nomor Telepon</th>
                                    <th>Instansi</th>
                                    <th>Jenis Surat</th>
                                    <th>No. Surat</th>
                                    <th>Tujuan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($guests as $index => $guest)
                                    <tr class="table-row-hover">

                                        <td class="text-muted small">
                                            {{ $guests->firstItem() + $index }}
                                        </td>

                                        {{-- NAMA --}}
                                        <td>
                                            <div class="text-muted">
                                                {{ $guest->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-muted">
                                                {{ $guest->phone ?? '-' }}
                                            </div>
                                        </td>

                                        {{-- INSTANSI --}}
                                        <td class="text-muted">
                                            {{ $guest->institution ?? '-' }}
                                        </td>

                                        {{-- JENIS --}}
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                {{ $guest->letterType->name ?? ($guest->custom_letter_type ?? 'Umum') }}
                                            </span>
                                        </td>

                                        {{-- NOMOR --}}
                                        <td class="text-muted">
                                            {{ $guest->letter_number ?? '-' }}
                                        </td>

                                        {{-- TUJUAN --}}
                                        <td>
                                            {{ \Illuminate\Support\Str::limit($guest->purpose ?? '-', 40) }}
                                        </td>

                                        {{-- TANGGAL --}}
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary">
                                                {{ \Carbon\Carbon::parse($guest->visit_date)->format('d M Y') }}
                                            </span>
                                        </td>

                                        {{-- AKSI --}}
                                        <td>
                                            <a href="{{ route('guest.edit', $guest->id) }}" class="btn btn-warning btn-sm">
                                                Edit
                                            </a>
                                        </td>

                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <i class="fas fa-users fa-3x text-muted mb-3 d-block"></i>
                                            <p class="fw-semibold mb-1">Belum ada data tamu</p>
                                            <small class="text-muted">Tambahkan data pertama</small>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>

                        {{-- PAGINATION --}}
                        <div class="mt-4">
                            {{ $guests->appends(request()->all())->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- STYLE --}}
    <style>
        .table-row-hover:hover {
            background-color: #f8fafc;
            transition: 0.2s;
        }

        .table td {
            vertical-align: middle;
        }
    </style>
@endsection
