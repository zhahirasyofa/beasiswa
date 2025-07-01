@extends('layouts.app')

@section('title', 'Daftar Beasiswa')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold text-primary">Daftar Beasiswa Aktif</h2>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tombol Tambah Beasiswa --}}
    <div class="mb-4 text-end">
        <a href="{{ route('beasiswa.create') }}" class="btn btn-primary">+ Tambah Beasiswa</a>
    </div>

    {{-- List Beasiswa --}}
    <div class="row g-4 justify-content-center">
        @forelse ($beasiswas as $beasiswa)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm rounded-4 border-0 h-100">
                    <div class="card-body d-flex flex-column">
                        {{-- Nama Beasiswa --}}
                        <h5 class="fw-bold text-dark">{{ $beasiswa->nama_beasiswa }}</h5>
                        
                        {{-- Kuota --}}
                        <p class="mb-2"><span class="badge bg-warning text-dark">Kuota: {{ $beasiswa->kuota ?? 'N/A' }}</span></p>

                        {{-- Deskripsi --}}
                        <p class="text-muted small">{{ Str::limit($beasiswa->deskripsi, 150) }}</p>

                        {{-- Tanggal --}}
                        <p class="mb-1"><strong>Mulai:</strong> {{ \Carbon\Carbon::parse($beasiswa->tanggal_mulai)->translatedFormat('d F Y') }}</p>
                        <p class="mb-2"><strong>Berakhir:</strong> {{ \Carbon\Carbon::parse($beasiswa->tanggal_selesai)->translatedFormat('d F Y') }}</p>

                        {{-- Kategori --}}
                        <p><strong>Kategori:</strong> {{ $beasiswa->kategori->nama_kategori ?? '-' }}</p>

                        {{-- Tombol Aksi --}}
                        <div class="mt-auto d-flex gap-2">
                            <a href="{{ route('pendaftaran.create', $beasiswa->id) }}" class="btn btn-warning btn-sm rounded-pill px-3">
                                Daftar
                            </a>
                            <a href="{{ route('beasiswa.edit', $beasiswa->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                Edit
                            </a>
                            <form action="{{ route('beasiswa.destroy', $beasiswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus beasiswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Belum ada beasiswa tersedia.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
