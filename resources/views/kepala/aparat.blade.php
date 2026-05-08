@extends('layouts.kepala.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Manajemen Aparat Desa</h4>
                    <p class="card-description">Kelola data aparat desa</p>
                    <form method="GET" action="{{ route('aparat.index') }}" class="mb-3">
                        <div class="d-flex">

                            <div class="col-12">
                                <div class="d-flex align-items-center" style="gap:12px;">

                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control" placeholder="Cari nama atau email..." style="flex:1;">

                                    <button class="btn btn-primary">
                                        <i class="fa fa-search" style="margin-right:4px;"></i> Cari
                                    </button>

                                    @if (request('search'))
                                        <a href="{{ route('aparat.index') }}" class="btn btn-outline-secondary">
                                            <i class="fa fa-refresh" style="margin-right:4px;"></i> Reset
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </form>

                    <button class="btn btn-primary mb-3" onclick="openAdd()">
                        <i class="fa fa-user-plus" style="margin-right:4px;"></i> Tambah Aparat
                    </button>

                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($aparats as $index => $aparat)
                                    <tr>

                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $aparat->name }}</td>
                                        <td>{{ $aparat->email }}</td>

                                        <td>

                                            <button class="btn btn-warning btn-sm"
                                                onclick="openEdit(
'{{ $aparat->id }}',
'{{ $aparat->name }}',
'{{ $aparat->email }}'
)">

                                                <i class="fa fa-pencil"></i> Edit

                                            </button>

                                            <form action="{{ route('aparat.destroy', $aparat->id) }}" method="POST"
                                                style="display:inline">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus aparat ini?')">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>

                                            </form>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- MODAL TAMBAH --}}

    <div class="modal fade" id="addModal">

        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Aparat</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <form action="{{ route('aparat.store') }}" method="POST">

                        @csrf

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <button class="btn btn-primary"><i class="fa fa-save" style="margin-right:4px;"></i> Simpan</button>

                    </form>

                </div>

            </div>
        </div>

    </div>


    {{-- MODAL EDIT --}}

    <div class="modal fade" id="editModal">

        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Aparat</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <form id="editForm" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id="editName" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="editEmail" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Password Baru (opsional)</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <button class="btn btn-primary"><i class="fa fa-check" style="margin-right:4px;"></i> Update</button>

                    </form>

                </div>

            </div>
        </div>

    </div>


    <script>
        function openAdd() {
            $('#addModal').modal('show')
        }

        function openEdit(id, name, email) {

            $('#editName').val(name)
            $('#editEmail').val(email)

            $('#editForm').attr('action', '/kepala/aparat/' + id)

            $('#editModal').modal('show')

        }
    </script>
@endsection
