@extends('layouts.app')

@section('title', 'Tambah Beasiswa')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 fw-bold text-dark">Tambah Beasiswa</h2>

        <form action="{{ route('beasiswa.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama_beasiswa" class="form-label">Nama Beasiswa</label>
                <input type="text" class="form-control" name="nama_beasiswa" id="nama_beasiswa" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="kuota" class="form-label">Kuota</label>
                <input type="number" class="form-control" name="kuota" id="kuota" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai" required>
            </div>

            <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori Beasiswa</label>
                <select name="kategori_id" id="kategori_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>


            <button type="submit" class="btn btn-primary text-light" style="background-color: #0D1B2A;">Simpan</button>
        </form>
    </div>
@endsection
