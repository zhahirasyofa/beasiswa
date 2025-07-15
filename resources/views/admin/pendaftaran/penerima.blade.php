@extends('layouts.app')

@section('title', 'Data Penerima Beasiswa')

@section('content')
    <div class="container-fluid px-5 py-5 bg-white">
        <h2 class="mb-5 fw-bold text-center text-primary">Penetapan Penerima Beasiswa</h2>

        @forelse ($penerimas as $p)
            <div class="card shadow-sm border-0 rounded-4 px-4 py-4 mb-5">
                <div class="mb-3">
                    <p class="mb-1"><strong>Nama Penerima:</strong></p>
                    <h4 class="fw-bold text-primary">{{ $p->user->name ?? '-' }}</h4>
                </div>

                <div class="mb-3">
                    <p class="mb-1"><strong>NIM:</strong> {{ $p->nim }}</p>
                    <p class="mb-1"><strong>Program Studi:</strong> {{ $p->prodi }}</p>
                    <p class="mb-1"><strong>Asal Kampus:</strong> {{ $p->asal_kampus }}</p>
                    <p class="mb-1"><strong>Semester:</strong> {{ $p->semester }}</p>
                    <p class="mb-1"><strong>No Telepon:</strong> {{ $p->no_telepon }}</p>
                </div>

                <div class="mb-3">
                    <p class="mb-1"><strong>Tanggal Daftar:</strong>
                        {{ \Carbon\Carbon::parse($p->tanggal_daftar)->translatedFormat('d F Y') }}</p>
                </div>

                <div class="mb-3">
                    <p class="mb-1"><strong>Nama Beasiswa:</strong> {{ $p->beasiswa->nama_beasiswa ?? '-' }}</p>
                    <p class="mb-1"><strong>Kategori:</strong> {{ $p->beasiswa->kategori->nama ?? '-' }}</p>
                    <p class="mb-1"><strong>Biaya Hidup:</strong>
                        <span class="text-success fw-bold">Rp
                            {{ number_format($p->beasiswa->kategori->biaya_hidup ?? 0, 0, ',', '.') }}</span>
                    </p>
                    <p class="mb-1"><strong>Biaya Pendidikan:</strong>
                        <span class="text-success fw-bold">Rp
                            {{ number_format($p->beasiswa->kategori->biaya_pendidikan ?? 0, 0, ',', '.') }}</span>
                    </p>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center rounded-4 shadow-sm">
                Belum ada data penerima beasiswa.
            </div>
        @endforelse
    </div>
@endsection
