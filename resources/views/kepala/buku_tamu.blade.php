@extends('layouts.kepala.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="fas fa-book me-2"></i>Data Buku Tamu
                    </h4>
                    <p class="card-description text-muted mb-4">Monitoring kunjungan masyarakat</p>
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                        <a href="{{ route('kepala.guest.export', request()->query()) }}"
                            class="btn rounded-pill px-4 py-2 fw-semibold" style="background-color:#10b981; color:#fff;">
                            Export File
                        </a>
                    </div>
                    <form method="GET" action="{{ route('kepala.bukutamu') }}" class="mb-4">
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

                                <button class="btn text-white" style="background:#4f46e5; margin-right:10px;">
                                    <i class="fas fa-search me-1"></i> Filter
                                </button>

                                @if (request()->hasAny(['search', 'from', 'to', 'sort']))
                                    <a href="{{ route('kepala.bukutamu') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-1"></i> Reset
                                    </a>
                                @endif

                            </div>

                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="60">No</th>
                                    <th width="250">Nama</th>
                                    <th width="">Nomor Telepon</th>
                                    <th width="180">Instansi</th>
                                    <th width="140">Jenis Surat</th>
                                    <th width="140">Nomor Surat</th>
                                    <th>Tujuan</th>
                                    <th width="130">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guests as $index => $guest)
                                    <tr>
                                        <td><strong>{{ $guests->firstItem() + $index }}</strong></td>
                                        <td>
                                            <strong class="text-truncate d-inline-block" style="max-width: 220px;"
                                                title="{{ $guest->name }}">
                                                {{ $guest->name }}
                                            </strong>
                                        </td>
                                        <td>{{ $guest->phone ?? '-' }} </td>
                                        <td>{{ $guest->institution ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark px-2 py-1 small">
                                                @if ($guest->letterType)
                                                    {{ $guest->letterType->name }}
                                                @else
                                                    {{ $guest->custom_letter_type ?? '-' }}
                                                @endif
                                            </span>
                                        </td>
                                        <td>{{ $guest->letter_number ?? '-' }}</td>
                                        <td class="text-truncate" style="max-width: 280px;" title="{{ $guest->purpose }}">
                                            {{ $guest->purpose }}
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">
                                                {{ \Carbon\Carbon::parse($guest->visit_date)->format('d-m-Y') }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION --}}
                    @if ($guests->hasPages())
                        <div class="mt-4">
                            {{ $guests->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
