@extends('layouts.app')
@section('title', 'Daftar Beasiswa')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold text-primary">Daftar Beasiswa Aktif</h2>

    <div class="row g-4 justify-content-center">
        @forelse ($beasiswas as $beasiswa)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm rounded-4 border-0 h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between mb-2">
                            <h5 class="fw-bold text-danger">{{ $beasiswa->nama_beasiswa }}</h5>
                            <span class="badge bg-warning text-dark">Kuota: {{ $beasiswa->kuota ?? 'N/A' }}</span>
                        </div>
                        <p class="text-muted small">{{ Str::limit($beasiswa->deskripsi, 150) }}</p>
                        <p class="mb-2"><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($beasiswa->tanggal_berakhir)->translatedFormat('d F Y') }}</p>
                        <a href="#" class="btn btn-warning rounded-pill mt-auto align-self-start px-4">Daftar</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">Belum ada beasiswa tersedia.</div>
        @endforelse
    </div>
</div>
@endsection
