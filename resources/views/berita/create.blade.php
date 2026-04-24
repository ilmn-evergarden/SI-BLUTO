    @extends(Auth::user()->role == 'kepala_desa' ? 'layouts.kepala.app' : 'layouts.aparat.app')

@section('content')
    @php
        $prefix = Auth::user()->role == 'kepala_desa' ? 'kepala' : 'aparat';
    @endphp

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <h4>Tambah Berita</h4>


                    <form action="{{ route($prefix.'.berita.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <input type="text" name="title" class="form-control mb-2" placeholder="Judul" required>

                        <input type="file" name="image" class="form-control mb-2">

                         <textarea name="content" id="editor"class="form-control mb-2" rows="5"></textarea>

                        <button class="btn btn-primary">Simpan</button>

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
