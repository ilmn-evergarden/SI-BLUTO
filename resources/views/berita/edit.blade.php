@extends(Auth::user()->role == 'kepala_desa' ? 'layouts.kepala.app' : 'layouts.aparat.app')

@section('content')
    @php
        $prefix = Auth::user()->role == 'kepala_desa' ? 'kepala' : 'aparat';
    @endphp

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <h4>Edit Berita</h4>
                    @if ($news->review_note && Auth::id() == $news->author_id)
                        <button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#noteModal">
                            Lihat Catatan
                        </button>
                    @endif
                    @if ($news->review_note && Auth::id() == $news->author_id)
                        <div class="modal fade" id="noteModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Catatan Revisi</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <p>{{ $news->review_note }}</p>
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

                    <form action="{{ route($prefix . '.berita.update', $news->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <input type="text" name="title" class="form-control mb-2" value="{{ $news->title }}" required>

                        @if ($news->image)
                            <img src="{{ asset('storage/' . $news->image) }}" width="200">
                        @endif

                        <input type="file" name="image" class="form-control mb-2">

                        <textarea name="content" id="editor"class="form-control mb-2" rows="5">{{ $news->content }}</textarea>

                        <button class="btn btn-primary">Update</button>

                        <a href="{{ route($prefix . '.berita.index') }}" class="btn btn-light">Batal</a>

                    </form>

                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
