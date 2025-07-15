@extends('layouts.app')

@section('title', 'Daftar Beasiswa')

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-5 fw-bold" style="color: #0D1B2A;">Daftar Beasiswa Aktif</h2>

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show text-center rounded-3 shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Form Pencarian dan Filter --}}
        <form method="GET" action="{{ route('beasiswa.index') }}" class="row mb-4 g-3 align-items-end">
            <div class="col-md-6">
                <label for="search" class="form-label fw-semibold">Cari Nama Beasiswa</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    class="form-control rounded-3 shadow-sm" placeholder="Masukkan nama beasiswa...">
            </div>

            <div class="col-md-4">
                <label for="kategori" class="form-label fw-semibold">Filter Kategori</label>
                <select name="kategori" id="kategori" class="form-select rounded-3 shadow-sm">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 text-end">
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold">
                    Cari
                </button>
            </div>
        </form>

        {{-- Tombol Tambah Beasiswa --}}
        @auth
            @if (auth()->user()->role === 'admin')
                <div class="text-end mb-4">
                    <a href="{{ route('beasiswa.create') }}" class="btn px-4 py-2 rounded-pill fw-semibold text-white"
                        style="background: linear-gradient(to right, #1E3A8A, #0D1B2A);">
                        + Tambah Beasiswa
                    </a>
                </div>
            @endif
        @endauth

        {{-- List Beasiswa --}}
        <div class="row g-4 justify-content-start">
            @forelse ($beasiswas as $beasiswa)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow rounded-4 d-flex flex-column justify-content-between"
                        style="background-color: #F1F5F9;">
                        <div class="card-body d-flex flex-column justify-content-between">

                            {{-- Nama Beasiswa dan Kuota Sejajar --}}
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold text-dark mb-0">{{ $beasiswa->nama_beasiswa }}</h5>
                                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                    Kuota: {{ $beasiswa->kuota ?? 'N/A' }}
                                </span>
                            </div>

                            {{-- Info Detail --}}
                            <div class="mb-4">
                                <p class="text-secondary small">{{ Str::limit($beasiswa->deskripsi, 100) }}</p>

                                <p class="text-dark small mb-1"><strong>Mulai:</strong>
                                    {{ \Carbon\Carbon::parse($beasiswa->tanggal_mulai)->translatedFormat('d F Y') }}
                                </p>
                                <p class="text-dark small mb-2"><strong>Berakhir:</strong>
                                    {{ \Carbon\Carbon::parse($beasiswa->tanggal_selesai)->translatedFormat('d F Y') }}
                                </p>

                                <p class="text-muted small mb-0">
                                    <strong>Kategori:</strong> {{ $beasiswa->kategori->nama ?? '-' }}
                                </p>
                            </div>

                            {{-- Tombol Aksi di Kanan Bawah --}}
                            <div class="d-flex justify-content-end gap-2">
                                @if ($beasiswa->kuota > 0)
                                    <a href="{{ route('pendaftaran.create', $beasiswa->id) }}"
                                        class="btn btn-sm rounded-pill px-3 text-light" style="background-color: #0D1B2A;">
                                        Daftar
                                    </a>
                                @else
                                    <span class="badge bg-danger rounded-pill px-3 py-2">
                                        Kuota Habis
                                    </span>
                                @endif


                                @auth
                                    @if (auth()->user()->role === 'admin')
                                        <a href="{{ route('beasiswa.edit', $beasiswa->id) }}"
                                            class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                            Edit
                                        </a>

                                        <form action="{{ route('beasiswa.destroy', $beasiswa->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus beasiswa ini?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center rounded-4 shadow-sm">
                        Belum ada beasiswa tersedia.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
