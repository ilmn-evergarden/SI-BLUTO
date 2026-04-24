@extends(Auth::user()->role == 'kepala_desa' ? 'layouts.kepala.app' : 'layouts.aparat.app')

@section('content')
    @php
        $prefix = Auth::user()->role == 'kepala_desa' ? 'kepala' : 'aparat';
        $isKepala = Auth::user()->role == 'kepala_desa';
    @endphp

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manajemen Galeri Desa</h4>
                    <a href="{{ route($prefix . '.gallery.create') }}" class="btn btn-primary mb-3">
                        Tambah Galeri
                    </a>

                    <div class="table-responsive">
                        {{-- FILTER FORM - SAMAKAN DENGAN BERITA --}}
                        <form method="GET" action="{{ route($prefix . '.gallery.index') }}" class="mb-4">
                            <div class="row g-3">
                                {{-- SEARCH --}}
                                <div class="col-md-6 col-lg-3">
                                    <label class="form-label">Cari Galeri</label>
                                    <input type="text" name="search" class="form-control" placeholder="Cari judul..."
                                        value="{{ request('search') }}">
                                </div>

                                {{-- STATUS --}}
                                <div class="col-md-6 col-lg-2">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">Semua Status</option>
                                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft
                                        </option>
                                        <option value="review" {{ request('status') == 'review' ? 'selected' : '' }}>Review
                                        </option>
                                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>
                                            Published</option>
                                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                                            Rejected</option>
                                    </select>
                                </div>

                                {{-- SORT --}}
                                <div class="col-md-6 col-lg-2">
                                    <label class="form-label">Urutkan</label>
                                    <select name="sort" class="form-control">
                                        <option value="" {{ !request('sort') ? 'selected' : '' }}>Terbaru</option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama
                                        </option>
                                    </select>
                                </div>

                                {{-- FILTER MILIK SAYA --}}
                                <div class="col-md-6 col-lg-2">
                                    <label class="form-label">Filter</label>
                                    <select name="ownership" class="form-control">
                                        <option value="">Semua</option>
                                        <option value="mine" {{ request('ownership') == 'mine' ? 'selected' : '' }}>Galeri
                                            Saya</option>
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-3 d-flex align-items-end">

                                    <button type="submit" class="btn btn-primary" style="flex:1; margin-right:10px;">
                                        <i class="fas fa-search me-1"></i> Filter
                                    </button>

                                    @if (request('search') || request('status') || request('sort') || request('ownership'))
                                        <a href="{{ route($prefix . '.gallery.index') }}"
                                            class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-1"></i> Reset
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </form>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kepemilikan</th>
                                    <th>Jumlah Gambar</th>
                                    <th>Status</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                    <th>Aksi Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($galleries as $index => $item)
                                    <tr>
                                        <td>{{ $galleries->firstItem() + $index }}</td>
                                        <td>{{ $item->title ?? 'Tanpa Judul' }}</td>
                                        <td>
                                            {{-- KEPEMILIKAN --}}
                                            @if (isset($item->created_by) && Auth::id() == $item->created_by)
                                                <span class="badge badge-info">Milikmu</span>
                                            @else
                                                <span class="badge badge-secondary">Lainnya</span>
                                            @endif
                                        </td>

                                        <td>{{ $item->images->count() ?? 0 }}</td>

                                        <td>
                                            @php $status = $item->status ?? 'draft'; @endphp
                                            @switch($status)
                                                @case('draft')
                                                    <span class="badge badge-secondary">Draft</span>
                                                @break

                                                @case('review')
                                                    <span class="badge badge-warning">Review</span>
                                                @break

                                                @case('published')
                                                    <span class="badge badge-success">Published</span>
                                                @break

                                                @case('rejected')
                                                    <span class="badge badge-danger">Rejected</span>
                                                @break

                                                @default
                                                    <span class="badge badge-secondary">{{ ucfirst($status) }}</span>
                                            @endswitch
                                        </td>

                                        <td>{{ $item->author->name ?? '-' }}</td>
                                        <td>{{ $item->created_at?->format('d M Y') ?? '-' }}</td>

                                        <td>

                                            {{-- LIHAT --}}
                                            <a href="{{ route($prefix . '.gallery.show', $item->id) }}"
                                                class="btn btn-info btn-sm">
                                                Lihat
                                            </a>

                                            {{-- EDIT --}}
                                            @if ($isKepala || (isset($item->created_by) && Auth::id() == $item->created_by))
                                                <a href="{{ route($prefix . '.gallery.edit', $item->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>
                                            @endif

                                            {{-- DELETE --}}
                                            @if ($isKepala || (isset($item->created_by) && Auth::id() == $item->created_by))
                                                <form action="{{ route($prefix . '.gallery.destroy', $item->id) }}"
                                                    method="POST" style="display:inline">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin hapus {{ addslashes($item->title ?? 'galeri ini') }}?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- KEPALA: APPROVE --}}
                                            @if ($isKepala && isset($item->status) && $item->status == 'review')
                                                <form action="{{ route('kepala.gallery.approve', $item->id) }}"
                                                    method="POST" style="display:inline">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm">
                                                        Publish
                                                    </button>
                                                </form>

                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#rejectModal{{ $item->id }}">
                                                    Reject
                                                </button>
                                            @endif

                                            {{-- APARAT: SUBMIT --}}
                                            @if (
                                                !$isKepala &&
                                                    isset($item->created_by) &&
                                                    Auth::id() == $item->created_by &&
                                                    isset($item->status) &&
                                                    $item->status == 'draft')
                                                <form action="{{ route('aparat.gallery.submitReview', $item->id) }}"
                                                    method="POST" style="display:inline">
                                                    @csrf
                                                    <button class="btn btn-primary btn-sm">
                                                        Kirim
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4">
                                                <i class="fas fa-images fa-3x text-muted mb-3 d-block"></i>
                                                Belum ada data galeri
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{-- PAGINATION --}}
                            {{ $galleries->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL REJECT --}}
            @foreach ($galleries as $item)
                @if ($isKepala && isset($item->status) && $item->status == 'review')
                    <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('kepala.gallery.reject', $item->id) }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5>Tolak: {{ $item->title ?? 'Galeri' }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea name="review_note" class="form-control" rows="4" required placeholder="Alasan penolakan..."
                                            maxlength="500"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endsection
