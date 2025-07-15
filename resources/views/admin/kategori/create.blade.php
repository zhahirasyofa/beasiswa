@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Kategori</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="biaya_hidup" class="form-label">Biaya Hidup</label>
                <input type="text" name="biaya_hidup" id="biaya_hidup" class="form-control" placeholder="Contoh: 1000000"
                    required>
            </div>

            <div class="mb-3">
                <label for="biaya_pendidikan" class="form-label">Biaya Pendidikan</label>
                <input type="text" name="biaya_pendidikan" id="biaya_pendidikan" class="form-control"
                    placeholder="Contoh: 3000000" required>
            </div>

            <button type="submit" class="btn btn-primary text-light" style="background-color: #0D1B2A;">Simpan</button>
        </form>
    </div>
@endsection
