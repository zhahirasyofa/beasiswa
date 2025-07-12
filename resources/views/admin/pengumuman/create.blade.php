@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Pengumuman</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="judul">Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="isi">Isi</label>
                <textarea name="isi" class="form-control" rows="5" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="gambar">Upload Gambar</label>
                <input type="file" name="gambar" class="form-control" accept="image/*">
            </div>

            <div class="form-group mb-3">
                <label for="kategori_id">Kategori</label>
                <select name="kategori_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
