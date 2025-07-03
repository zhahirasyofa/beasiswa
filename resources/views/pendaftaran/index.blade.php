@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Daftar Pendaftaran Saya</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($pendaftarans->isEmpty())
            <div class="alert alert-warning">Belum ada pendaftaran yang dilakukan.</div>
        @else
            <table class="table table-bordered table-striped">
                <thead>
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
                            <td>{{ $data->beasiswa->nama_beasiswa ?? '-' }}</td>
                            <td>{{ $data->tanggal_daftar }}</td>
                            <td>{{ $data->nim }}</td>
                            <td>{{ $data->prodi }}</td>
                            <td>{{ $data->asal_kampus }}</td>
                            <td>{{ $data->semester }}</td>
                            <td>{{ $data->no_telepon }}</td>
                            <td>
                                @if ($data->status === 'diproses')
                                    <span class="badge bg-warning text-dark">Diproses</span>
                                @elseif($data->status === 'diterima')
                                    <span class="badge bg-success">Diterima</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
