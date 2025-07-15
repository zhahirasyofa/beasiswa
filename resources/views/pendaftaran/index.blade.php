@extends('layouts.app')

@section('title', 'Pendaftaran Saya')

@section('content')
    <div class="container py-5">
        <h3 class="mb-4 fw-bold text-primary text-center">Daftar Pendaftaran Saya</h3>

        @if (session('success'))
            <div class="alert alert-success text-center rounded-3">{{ session('success') }}</div>
        @endif

        @if ($pendaftarans->isEmpty())
            <div class="alert alert-warning text-center rounded-4 shadow-sm">
                <i class="bi bi-info-circle"></i> Belum ada pendaftaran yang dilakukan.
            </div>
        @else
            <div class="table-responsive shadow-sm rounded-4">
                <table class="table table-striped table-hover align-middle text-center">
                    <thead class="bg-light text-dark fw-semibold border-bottom">
                        <tr>
                            <th>No</th>
                            <th>Beasiswa</th>
                            <th>Tanggal Daftar</th>
                            <th>NIM</th>
                            <th>Prodi</th>
                            <th>Asal Kampus</th>
                            <th>Semester</th>
                            <th>No. Telepon</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftarans as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-start">{{ $data->beasiswa->nama_beasiswa ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_daftar)->translatedFormat('d M Y') }}</td>
                                <td>{{ $data->nim }}</td>
                                <td>{{ $data->prodi }}</td>
                                <td>{{ $data->asal_kampus }}</td>
                                <td>{{ $data->semester }}</td>
                                <td>{{ $data->no_telepon }}</td>
                                <td>
                                    @if ($data->status === 'diproses')
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Diproses</span>
                                    @elseif($data->status === 'diterima')
                                        <span class="badge bg-success rounded-pill px-3 py-2">Diterima</span>
                                    @else
                                        <span class="badge bg-danger rounded-pill px-3 py-2">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
