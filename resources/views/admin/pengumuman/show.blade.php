@extends('layouts.app')

@section('title', $pengumuman->judul)

@section('content')
    <div class="container py-5">
        {{-- Tombol Kembali --}}
        <div class="mb-4">
            <a href="{{ url('/') }}#pengumuman" class="btn btn-secondary">Kembali</a>

        </div>

        {{-- Konten Pengumuman --}}
        <div class="card border-0 shadow rounded-4 p-4">
            @if ($pengumuman->gambar)
                <img src="{{ asset($pengumuman->gambar) }}" class="img-fluid rounded mb-4"
                    style="max-height: 400px; object-fit: cover;" alt="Gambar Pengumuman">
            @endif

            <h2 class="fw-bold text-dark">{{ $pengumuman->judul }}</h2>
            <p class="text-muted mb-2">
                <small><i>Kategori: {{ $pengumuman->kategori->nama ?? '-' }}</i></small>
            </p>
            <div class="text-dark">
                {!! nl2br(e($pengumuman->isi)) !!}
            </div>
        </div>
    </div>
@endsection
