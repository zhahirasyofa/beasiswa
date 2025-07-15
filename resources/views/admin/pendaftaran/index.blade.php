@extends('layouts.app')

@section('title', 'Data Pendaftar Beasiswa')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 fw-bold text-center text-primary">Data Seluruh Pendaftar Beasiswa</h2>

        {{-- Form Pencarian & Filter --}}
        <div class="card shadow-sm border-0 rounded-4 mb-4 p-4">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="beasiswa" class="form-label fw-semibold">🔍 Cari Nama Beasiswa</label>
                    <input type="text" name="beasiswa" id="beasiswa" class="form-control rounded-3 shadow-sm"
                        value="{{ request('beasiswa') }}" placeholder="Contoh: Beasiswa Unggulan">
                </div>

                <div class="col-md-5">
                    <label for="kategori" class="form-label fw-semibold">Filter Kategori</label>
                    <select name="kategori" id="kategori" class="form-select rounded-3 shadow-sm">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill fw-semibold">Cari</button>
                </div>
            </form>
        </div>

        {{-- Tabel Data --}}
        @if ($pendaftarans->isEmpty())
            <div class="alert alert-warning text-center rounded-4 shadow-sm">
                <i class="bi bi-info-circle"></i> Belum ada pendaftar.
            </div>
        @else
            <div class="table-responsive shadow-sm rounded-4">
                <table class="table table-striped table-hover align-middle text-center">
                    <thead class="bg-light text-dark border-bottom fw-semibold">
                        <tr style="vertical-align: middle;">
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
                                <td class="text-start">{{ $p->user->name ?? '-' }}</td>
                                <td class="text-start">{{ $p->user->email ?? '-' }}</td>
                                <td class="text-start">{{ $p->beasiswa->nama_beasiswa ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal_daftar)->translatedFormat('d M Y') }}</td>
                                <td>{{ $p->nim }}</td>
                                <td>{{ $p->prodi }}</td>
                                <td>{{ $p->asal_kampus }}</td>
                                <td>{{ $p->semester }}</td>
                                <td>{{ $p->no_telepon }}</td>
                                <td>
                                    <span
                                        class="badge px-3 py-2 rounded-pill 
                                        @if ($p->status == 'diproses') bg-warning text-dark
                                        @elseif($p->status == 'diterima') bg-success
                                        @elseif($p->status == 'ditolak') bg-danger @endif">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div
                                        class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-2">
                                        @if ($p->status === 'diproses')
                                            <form action="{{ route('admin.pendaftaran.updateStatus', $p->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="diterima">
                                                <button type="submit"
                                                    class="btn btn-success btn-sm rounded-pill px-3">Setujui</button>
                                            </form>

                                            <form action="{{ route('admin.pendaftaran.updateStatus', $p->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="ditolak">
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm rounded-pill px-3">Tolak</button>
                                            </form>
                                        @else
                                            <span class="text-muted small">Sudah diproses</span>
                                        @endif

                                        <form action="{{ route('admin.pendaftaran.destroy', $p->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
