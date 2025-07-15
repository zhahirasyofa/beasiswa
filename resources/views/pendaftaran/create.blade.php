@extends('layouts.app')

@section('title', 'Form Pendaftaran Beasiswa')

@section('content')
    <div class="container py-5">
        <h3 class="mb-4 fw-bold text-primary text-center">Form Pendaftaran Beasiswa</h3>

        @if (session('error'))
            <div class="alert alert-danger text-center rounded-3">
                {{ session('error') }}
            </div>
        @elseif(session('success'))
            <div class="alert alert-success text-center rounded-3">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('pendaftaran.store') }}" method="POST" class="shadow-sm p-4 rounded-4 bg-white">
            @csrf

            <input type="hidden" name="beasiswa_id" value="{{ $beasiswa->id }}">

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Beasiswa</label>
                <input type="text" class="form-control bg-light" value="{{ $beasiswa->nama }}" disabled>
            </div>

            <div class="mb-3">
                <label for="nim" class="form-label fw-semibold">NIM</label>
                <input type="text" class="form-control" name="nim" id="nim" required>
            </div>

            <div class="mb-3">
                <label for="prodi" class="form-label fw-semibold">Program Studi</label>
                <input type="text" class="form-control" name="prodi" id="prodi" required>
            </div>

            <div class="mb-3">
                <label for="asal_kampus" class="form-label fw-semibold">Asal Kampus</label>
                <input type="text" class="form-control" name="asal_kampus" id="asal_kampus" required>
            </div>

            <div class="mb-3">
                <label for="semester" class="form-label fw-semibold">Semester</label>
                <input type="text" class="form-control" name="semester" id="semester" required>
            </div>

            <div class="mb-4">
                <label for="no_telepon" class="form-label fw-semibold">No. Telepon</label>
                <input type="text" class="form-control" name="no_telepon" id="no_telepon" required>
            </div>

            <div class="d-flex gap-2 justify-content-end">
                <a href="{{ route('homepage') }}" class="btn btn-secondary rounded-pill px-4">Kembali</a>
                <button type="submit" class="btn btn-primary text-white rounded-pill px-4"
                    style="background-color: #0D1B2A;">Daftar Sekarang</button>
            </div>
        </form>
    </div>
@endsection
