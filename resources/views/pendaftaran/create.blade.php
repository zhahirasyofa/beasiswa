@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Form Pendaftaran Beasiswa</h3>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @elseif(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('pendaftaran.store') }}" method="POST">
            @csrf

            <input type="hidden" name="beasiswa_id" value="{{ $beasiswa->id }}">

            <div class="mb-3">
                <label class="form-label">Nama Beasiswa</label>
                <input type="text" class="form-control" value="{{ $beasiswa->nama }}" disabled>
            </div>

            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" name="nim" id="nim" required>
            </div>

            <div class="mb-3">
                <label for="prodi" class="form-label">Program Studi</label>
                <input type="text" class="form-control" name="prodi" id="prodi" required>
            </div>

            <div class="mb-3">
                <label for="asal_kampus" class="form-label">Asal Kampus</label>
                <input type="text" class="form-control" name="asal_kampus" id="asal_kampus" required>
            </div>

            <div class="mb-3">
                <label for="semester" class="form-label">Semester</label>
                <input type="text" class="form-control" name="semester" id="semester" required>
            </div>

            <div class="mb-3">
                <label for="no_telepon" class="form-label">No. Telepon</label>
                <input type="text" class="form-control" name="no_telepon" id="no_telepon" required>
            </div>

            <button type="submit" class="btn btn-primary text-light" style="background-color: #0D1B2A;">Daftar
                Sekarang</button>
            <a href="{{ route('homepage') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
