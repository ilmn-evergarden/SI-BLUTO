@extends('layouts.aparat.app')

@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">

        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Tambah Buku Tamu</h4>

                <form action="{{ route('guest.store') }}" method="POST">
                    @csrf

                    {{-- NAMA --}}
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    {{-- INSTANSI --}}
                    <div class="form-group">
                        <label>Instansi</label>
                        <input type="text" name="institution" class="form-control">
                    </div>

                    {{-- JENIS SURAT --}}
                    <div class="form-group">
                        <label>Jenis Surat</label>

                        <div style="display:flex; gap:10px;">

                            <select name="letter_type_id" id="letterTypeSelect" class="form-control">
                                <option value="">-- Pilih Jenis Surat --</option>

                                @foreach ($letterTypes as $type)
                                    <option value="{{ $type->id }}">
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- BUTTON KE HALAMAN KELOLA --}}
                            <a href="{{ route('letter-types.manage') }}" class="btn btn-secondary">
                                Kelola
                            </a>

                        </div>
                    </div>

                    {{-- INPUT MANUAL --}}
                    <div class="form-group">
                        <label>Atau Isi Manual</label>
                        <input type="text" name="custom_letter_type" class="form-control">
                    </div>

                    {{-- NOMOR SURAT --}}
                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input type="text" name="letter_number" class="form-control">
                    </div>

                    {{-- TUJUAN --}}
                    <div class="form-group">
                        <label>Tujuan</label>
                        <textarea name="purpose" class="form-control" required></textarea>
                    </div>

                    {{-- NO HP --}}
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="phone" class="form-control">
                    </div>

                    {{-- TANGGAL --}}
                    <div class="form-group">
                        <label>Tanggal Kunjungan</label>
                        <input type="date" name="visit_date" class="form-control" required>
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('guest.index') }}" class="btn btn-light">Batal</a>

                </form>

            </div>
        </div>

    </div>
</div>

{{-- =========================
SCRIPT (LOGIC SELECT vs MANUAL)
========================= --}}
<script>
document.addEventListener('DOMContentLoaded', function(){

    const select = document.getElementById('letterTypeSelect');
    const manual = document.querySelector('[name="custom_letter_type"]');

    if (select && manual) {

        select.addEventListener('change', function(){
            if(this.value !== ''){
                manual.value = '';
                manual.disabled = true;
            } else {
                manual.disabled = false;
            }
        });

        manual.addEventListener('input', function(){
            if(this.value !== ''){
                select.value = '';
                select.disabled = true;
            } else {
                select.disabled = false;
            }
        });

    }

});
</script>

@endsection