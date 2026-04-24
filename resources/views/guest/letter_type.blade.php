@extends('layouts.aparat.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3">Kelola Jenis Surat</h4>

            {{-- TAMBAH --}}
            <form action="{{ route('letter-types.store') }}" method="POST" class="mb-4">
                @csrf

                <div class="d-flex align-items-center">

                    <input type="text" name="name" class="form-control" style="max-width: 900px; margin-right: 15px;"
                        placeholder="Nama jenis surat" required>

                    <button class="btn btn-primary">
                        Tambah
                    </button>

                </div>
            </form>


            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Kelola Jenis Surat</h4>

                <a href="{{ route('guest.create') }}" class="btn btn-secondary btn-sm">
                    ← Kembali
                </a>
            </div>

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table align-middle">

                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Jenis Surat</th>
                            <th style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($letterTypes as $index => $type)
                            <tr>

                                <td>{{ $index + 1 }}</td>

                                <td>{{ $type->name }}</td>

                                <td>
                                    <div style="display:inline-flex; align-items:center;">

                                        {{-- EDIT --}}
                                        <button type="button" class="btn btn-warning btn-sm btn-edit"
                                            style="margin-right:5px;" data-id="{{ $type->id }}"
                                            data-name="{{ $type->name }}">
                                            Edit
                                        </button>

                                        {{-- DELETE --}}
                                        <form action="{{ route('letter-types.destroy', $type->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus jenis surat ini?')">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    Belum ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    {{-- ================= MODAL EDIT ================= --}}
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5>Edit Jenis Surat</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <input type="text" name="name" id="editName" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>



    {{-- ================= SCRIPT ================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.btn-edit').forEach(btn => {

                btn.addEventListener('click', function() {

                    let id = this.dataset.id;
                    let name = this.dataset.name;

                    document.getElementById('editName').value = name;
                    document.getElementById('editForm').action = '/letter-types/' + id;

                    $('#editModal').modal('show');

                });

            });

        });
    </script>
@endsection
