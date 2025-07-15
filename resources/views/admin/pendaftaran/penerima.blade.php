@extends('layouts.app')

@section('title', 'Data Penerima Beasiswa')

@section('content')
    <div class="container py-5">
        <h2 class="mb-5 fw-bold text-center text-primary">📋 Penetapan Penerima Beasiswa</h2>

        @forelse ($penerimas as $p)
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body px-4 py-4">
                    <h5 class="fw-bold text-primary mb-4">👤 {{ $p->user->name ?? '-' }}</h5>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>NIM:</strong> {{ $p->nim }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>📅 Tanggal Daftar:</strong>
                                {{ \Carbon\Carbon::parse($p->tanggal_daftar)->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Program Studi:</strong> {{ $p->prodi }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>🎓 Nama Beasiswa:</strong> {{ $p->beasiswa->nama_beasiswa ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Asal Kampus:</strong> {{ $p->asal_kampus }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>🏷️ Kategori:</strong> {{ $p->beasiswa->kategori->nama ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>No Telepon:</strong> {{ $p->no_telepon }}</p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Semester:</strong> {{ $p->semester }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1">
                                <strong>💸 Rincian Bantuan:</strong>
                            <ul class="mb-0">
                                @foreach (explode("\n", $p->beasiswa->bantuan ?? '') as $item)
                                    @if (!empty(trim($item)))
                                        <li>{{ $item }}</li>
                                    @endif
                                @endforeach
                            </ul>
                            </p>
                        </div>
                    </div>




                </div>
            </div>
        @empty
            <div class="alert alert-info text-center rounded-4 shadow-sm">
                <i class="bi bi-info-circle"></i> Belum ada data penerima beasiswa.
            </div>
        @endforelse
    </div>
@endsection
