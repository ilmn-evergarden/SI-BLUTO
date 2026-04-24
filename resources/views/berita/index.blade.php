@extends(Auth::user()->role == 'kepala_desa' ? 'layouts.kepala.app' : 'layouts.aparat.app')

@section('content')
    @php
        $prefix = Auth::user()->role == 'kepala_desa' ? 'kepala' : 'aparat';
    @endphp

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">

                    <h4 class="card-title">Manajemen Berita Desa</h4>

                    <a href="{{ route($prefix . '.berita.create') }}" class="btn btn-primary mb-3">
                        Tambah Berita
                    </a>
                    <form method="GET" action="{{ route($prefix . '.berita.index') }}" class="mb-4">
                        <div class="row g-3">
                            {{-- SEARCH --}}
                            <div class="col-md-6 col-lg-3">
                                <label class="form-label">Cari Berita</label>
                                <input type="text" name="search" class="form-control"
                                    placeholder="Cari judul atau penulis..." value="{{ request('search') }}">
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
                                <select name="filter" class="form-control">
                                    <option value="">Semua</option>
                                    <option value="mine" {{ request('filter') == 'mine' ? 'selected' : '' }}>Berita Saya
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 col-lg-3 d-flex align-items-end">

                                <button type="submit" class="btn btn-primary flex-fill" style="margin-right:10px;">
                                    <i class="fas fa-search"></i> Filter
                                </button>

                                @if (request('search') || request('status') || request('sort') || request('filter'))
                                    <a href="{{ route($prefix . '.berita.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i> Reset
                                    </a>
                                @endif

                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                    <th>Kepemilikan</th>
                                    <th>Status</th>
                                    <th>Aksi Status</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($news as $index => $item)
                                    <tr>
                                        <td>{{ $news->firstItem() + $index }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->author->name ?? '-' }}</td>
                                        <td>{{ $item->created_at->format('d M Y') }}</td>

                                        {{-- AKSI --}}
                                        <td>

                                            <a href="{{ route($prefix . '.berita.show', $item->slug) }}"
                                                class="btn btn-info btn-sm">
                                                Lihat
                                            </a>

                                            @can('update', $item)
                                                <a href="{{ route($prefix . '.berita.edit', $item->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>
                                            @endcan

                                            @can('delete', $item)
                                                <form action="{{ route($prefix . '.berita.destroy', $item->id) }}"
                                                    method="POST" style="display:inline">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm">
                                                        Hapus
                                                    </button>

                                                </form>
                                            @endcan

                                        </td>

                                        {{-- KEPEMILIKAN --}}
                                        <td>
                                            @if ($item->author_id == Auth::id())
                                                <span class="badge badge-success">Milikmu</span>
                                            @else
                                                <span class="badge badge-light">Umum</span>
                                            @endif
                                        </td>

                                        {{-- STATUS + ACTION --}}
                                        <td>

                                            {{-- STATUS --}}
                                            @if ($item->status == 'draft')
                                                <span class="badge badge-secondary">Draft</span>
                                            @elseif($item->status == 'review')
                                                <span class="badge badge-warning">Review</span>
                                            @elseif($item->status == 'published')
                                                <span class="badge badge-success">Published</span>
                                            @elseif($item->status == 'rejected')
                                                <span class="badge badge-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td>{{-- APARAT: KIRIM REVIEW --}}
                                            @if (Auth::user()->role == 'aparat_desa' && Auth::id() == $item->author_id && $item->status == 'draft')
                                                <form action="{{ route('aparat.berita.submitReview', $item->id) }}"
                                                    method="POST" class="mt-1">
                                                    @csrf
                                                    <button class="btn btn-info btn-sm">Kirim</button>
                                                </form>
                                            @endif
                                            {{-- KEPALA: APPROVE / REJECT --}}
                                            @if (Auth::user()->role == 'kepala_desa' && $item->status == 'review')
                                                <form action="{{ route('kepala.berita.approve', $item->id) }}"
                                                    method="POST" style="display:inline">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm mt-1">Approve</button>
                                                </form>

                                                <button class="btn btn-danger btn-sm mt-1" data-toggle="modal"
                                                    data-target="#rejectModal{{ $item->id }}">
                                                    Reject
                                                </button>
                                            @endif
                                            @if ($item->review_note && Auth::id() == $item->author_id)
                                                <button class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#noteModal{{ $item->id }}">
                                                    Lihat Catatan
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- MODAL DI LUAR TR --}}
                                    <div class="modal fade" id="rejectModal{{ $item->id }}">
                                        <div class="modal-dialog">
                                            <form action="{{ route('kepala.berita.reject', $item->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5>Alasan Penolakan</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <textarea name="review_note" class="form-control" required></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-danger">Kirim</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @if ($item->review_note)
                                        <div class="modal fade" id="noteModal{{ $item->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Catatan Revisi</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <p>{{ $item->review_note }}</p>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" data-dismiss="modal">
                                                            Tutup
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
