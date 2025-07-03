@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Data Seluruh Pendaftar Beasiswa</h3>

        @if ($pendaftarans->isEmpty())
            <div class="alert alert-warning">Belum ada pendaftar.</div>
        @else
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Beasiswa</th>
                        <th>Tanggal Daftar</th>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th>Asal Kampus</th>
                        <th>Semester</th>
                        <th>No Telepon</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendaftarans as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $p->user->name ?? '-' }}</td>
                            <td>{{ $p->user->email ?? '-' }}</td>
                            <td>{{ $p->beasiswa->nama_beasiswa ?? '-' }}</td>
                            <td>{{ $p->tanggal_daftar }}</td>
                            <td>{{ $p->nim }}</td>
                            <td>{{ $p->prodi }}</td>
                            <td>{{ $p->asal_kampus }}</td>
                            <td>{{ $p->semester }}</td>
                            <td>{{ $p->no_telepon }}</td>
                            <td>
                                <span
                                    class="badge 
                                    @if ($p->status == 'diproses') bg-warning 
                                    @elseif($p->status == 'diterima') bg-success 
                                    @elseif($p->status == 'ditolak') bg-danger @endif">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td>
                                @if ($p->status === 'diproses')
                                    <div class="d-flex gap-1">
                                        <form action="{{ route('admin.pendaftaran.updateStatus', $p->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="diterima">
                                            <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                        </form>

                                        <form action="{{ route('admin.pendaftaran.updateStatus', $p->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-muted">Sudah diproses</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
