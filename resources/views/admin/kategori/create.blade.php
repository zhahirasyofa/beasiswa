@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Kategori</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="nama">Nama Kategori</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
