@extends('layouts.aparat.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Edit Buku Tamu</h4>

                    <form action="{{ route('guest.update', $guest->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- NAMA --}}
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ $guest->name }}" required>
                        </div>

                        {{-- INSTANSI --}}
                        <div class="form-group">
                            <label>Instansi</label>
                            <input type="text" name="institution" class="form-control" value="{{ $guest->institution }}">
                        </div>

                        {{-- JENIS SURAT --}}
                        <div class="form-group">
                            <label>Jenis Surat</label>

                            <div style="display:flex; gap:10px;">
                                <select name="letter_type_id" id="letterTypeSelect" class="form-control">

                                    <option value="">-- Pilih Jenis Surat --</option>

                                    @foreach ($letterTypes as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $guest->letter_type_id == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        {{-- MANUAL --}}
                        <div class="form-group">
                            <label>Atau Isi Manual</label>
                            <input type="text" name="custom_letter_type" class="form-control"
                                value="{{ $guest->custom_letter_type }}">
                        </div>

                        {{-- NOMOR SURAT --}}
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" name="letter_number" class="form-control"
                                value="{{ $guest->letter_number }}">
                        </div>

                        {{-- TUJUAN --}}
                        <div class="form-group">
                            <label>Tujuan</label>
                            <textarea name="purpose" class="form-control" required>{{ $guest->purpose }}</textarea>
                        </div>

                        {{-- PHONE --}}
                        <div class="form-group">
                            <label>No HP</label>
                            <input type="text" name="phone" class="form-control" value="{{ $guest->phone }}">
                        </div>

                        {{-- TANGGAL --}}
                        <div class="form-group">
                            <label>Tanggal Kunjungan</label>
                            <input type="date" name="visit_date" class="form-control" value="{{ $guest->visit_date }}"
                                required>
                        </div>

                        {{-- BUTTON --}}
                        <button class="btn btn-primary">
                            Update
                        </button>

                        <a href="{{ route('guest.index') }}" class="btn btn-light">
                            Batal
                        </a>

                    </form>

                </div>
            </div>

        </div>
    </div>

    {{-- SCRIPT (SAMA SEPERTI CREATE) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const select = document.getElementById('letterTypeSelect');
            const manual = document.querySelector('[name="custom_letter_type"]');

            // INIT STATE
            if (select.value !== '') {
                manual.disabled = true;
            }

            if (manual.value !== '') {
                select.disabled = true;
            }

            // dropdown → disable manual
            select.addEventListener('change', function() {
                if (this.value !== '') {
                    manual.value = '';
                    manual.disabled = true;
                } else {
                    manual.disabled = false;
                }
            });

            // manual → disable dropdown
            manual.addEventListener('input', function() {
                if (this.value !== '') {
                    select.value = '';
                    select.disabled = true;
                } else {
                    select.disabled = false;
                }
            });

        });
    </script>
@endsection
