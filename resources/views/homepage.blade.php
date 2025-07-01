@extends('layouts.app')

@section('title', 'Homepage Beasiswa')

@section('content')
    {{-- Header Banner --}}
    <div class="bg-primary text-white text-center py-5 rounded">
        <h1 class="fw-bold">Selamat Datang di Portal Beasiswa</h1>
        <p class="lead">Temukan dan daftar berbagai program beasiswa untuk mendukung pendidikanmu.</p>
    </div>

    {{-- Beasiswa List --}}
    <div class="container py-5">
        <h2 class="mb-4 text-center fw-bold">Daftar Beasiswa Tersedia</h2>

        @if ($beasiswas->count() > 0)
            <div class="row g-4 justify-content-center">
                @foreach ($beasiswas as $beasiswa)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow rounded-4 border-0" style="background-color: #fefefe;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-danger">{{ $beasiswa->nama_beasiswa }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($beasiswa->deskripsi, 100) }}</p>
                                
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="badge rounded-pill bg-warning text-dark px-3 py-2">
                                        Deadline: {{ $beasiswa->tanggal_berakhir }}
                                    </span>
                                    <a href="{{ route('pendaftaran.create', ['beasiswa_id' => $beasiswa->id]) }}" class="btn btn-outline-danger btn-sm fw-bold">Daftar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-5 d-flex justify-content-center">
                {{ $beasiswas->links() }}
            </div>
        @else
            <div class="alert alert-info text-center mt-4">
                Tidak ada data beasiswa tersedia saat ini.
            </div>
        @endif
    </div>
@endsection
