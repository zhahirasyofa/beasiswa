@extends('layouts.app')

@section('title', 'Homepage Beasiswa')

@section('content')
    {{-- Header Banner --}}
    <div class="d-flex align-items-center justify-content-center min-vh-100 text-white"
        style="background: linear-gradient(135deg, #0D1B2A, #1B263B);">
        <div class="card shadow-lg rounded-4 text-center px-5 py-5 border-0 bg-white" style="max-width: 800px;">
            <h1 class="fw-bold mb-3 text-dark">🎓 Selamat Datang di Portal Beasiswa</h1>
            <p class="lead text-secondary mb-0">
                Temukan dan daftar berbagai program beasiswa untuk mendukung pendidikan dan masa depanmu.
            </p>
        </div>
    </div>

    {{-- Pengumuman List --}}
    <div id="pengumuman" class="container py-5">
        <h2 class="mb-5 text-center fw-bold text-primary">📢 Pengumuman Beasiswa Terbaru</h2>

        @if ($pengumumans->count() > 0)
            <div class="row g-4">
                @foreach ($pengumumans as $pengumuman)
                    <div class="col-md-6 col-lg-4 d-flex">
                        <div
                            class="card border-0 shadow-lg rounded-4 bg-white flex-fill d-flex flex-column h-100 pengumuman-card">
                            <div class="card-body d-flex flex-column">
                                @if ($pengumuman->gambar)
                                    <img src="{{ asset($pengumuman->gambar) }}" alt="gambar pengumuman"
                                        class="img-fluid rounded-3 mb-3"
                                        style="height: 180px; object-fit: cover; object-position: center;">
                                @else
                                    <div class="bg-secondary-subtle rounded-3 mb-3 d-flex align-items-center justify-content-center"
                                        style="height: 180px;">
                                        <span class="text-muted">Tidak ada gambar</span>
                                    </div>
                                @endif

                                <h5 class="card-title fw-bold text-dark mb-2">
                                    {{ Str::limit($pengumuman->judul, 50) }}
                                </h5>

                                <p class="text-muted mb-1">
                                    <small><i class="bi bi-tag-fill"></i> Kategori:
                                        {{ $pengumuman->kategori->nama ?? '-' }}</small>
                                </p>

                                <p class="card-text text-secondary mb-4">
                                    {{ Str::limit(strip_tags($pengumuman->isi), 100) }}
                                </p>

                                <a href="{{ route('admin.pengumuman.show', $pengumuman->id) }}#pengumuman"
                                    class="btn btn-sm btn-primary mt-auto w-100 rounded-pill">
                                    Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning text-center mt-4 rounded-4 shadow-sm">
                <i class="bi bi-info-circle"></i> Belum ada pengumuman terbaru.
            </div>
        @endif
    </div>

    {{-- Pagination (aktifkan jika diperlukan) --}}
    {{-- 
    <div class="mt-5 d-flex justify-content-center">
        {{ $pengumumans->links() }}
    </div> 
    --}}

    {{-- Tambahan CSS untuk efek hover --}}
    <style>
        .pengumuman-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .pengumuman-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection
