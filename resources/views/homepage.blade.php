@extends('layouts.app')

@section('title', 'Homepage Beasiswa')

@section('content')
    {{-- Header Banner --}}
    <div class="d-flex align-items-center justify-content-center min-vh-100" style="background-color: #0D1B2A;">
        <div class="card shadow-lg rounded-4 text-center px-5 py-5 border-0"
            style="max-width: 800px; background-color: #ffffff;">
            <h1 class="fw-bold mb-3 text-dark">Selamat Datang di Portal Beasiswa</h1>
            <p class="lead mb-0 text-secondary">
                Temukan dan daftar berbagai program beasiswa untuk mendukung pendidikanmu.
            </p>
        </div>
    </div>

    {{-- Pengumuman List --}}
    <div id="pengumuman" class="container py-5">
        <h2 class="mb-4 text-center fw-bold text-dark">Pengumuman</h2>

        @if ($pengumumans->count() > 0)
            <div class="row g-4">
                @foreach ($pengumumans as $pengumuman)
                    <div class="col-md-4 d-flex">
                        <div class="card border-0 shadow rounded-4 bg-light flex-fill d-flex flex-column">
                            <div class="card-body d-flex flex-column">
                                @if ($pengumuman->gambar)
                                    <img src="{{ asset($pengumuman->gambar) }}" alt="gambar pengumuman"
                                        class="img-fluid rounded-3 mb-3" style="height: 180px; object-fit: cover;">
                                @endif

                                <h5 class="card-title fw-bold text-dark">{{ $pengumuman->judul }}</h5>
                                <p class="text-muted mb-1">
                                    <small><i>Kategori: {{ $pengumuman->kategori->nama ?? '-' }}</i></small>
                                </p>
                                <p class="card-text mb-4">{{ Str::limit($pengumuman->isi, 100) }}</p>

                                <a href="{{ route('admin.pengumuman.show', $pengumuman->id) }}#pengumuman"
                                    class="btn btn-sm btn-dark mt-auto">
                                    Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning text-center mt-4 rounded-4 shadow-sm">
                Belum ada pengumuman terbaru.
            </div>
        @endif
    </div>

    {{-- (Optional) Pagination, jika ada --}}
    {{-- <div class="mt-5 d-flex justify-content-center">
        {{ $pengumumans->links() }}
    </div> --}}
@endsection
