@extends('layouts.app')

@section('title', 'Tambah Beasiswa')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold">Tambah Beasiswa Baru</h2>

    <form action="{{ route('beasiswa.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_beasiswa" class="form-label">Nama Beasiswa</label>
            <input type="text" class="form-control" id="nama_beasiswa" name="nama_beasiswa" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="kuota" class="form-label">Kuota</label>
            <input type="number" class="form-control" id="kuota" name="kuota" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
            <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Beasiswa</button>
    </form>
</div>
@endsection
