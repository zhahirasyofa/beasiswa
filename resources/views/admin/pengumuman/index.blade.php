@extends('layouts.app')

@section('content')
    <div class="container py-5">

        {{-- Judul & Tombol Tambah --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary mb-0">Daftar Pengumuman</h3>
            <a href="{{ route('pengumuman.create') }}" class="btn btn-primary rounded-pill px-4 py-2">
                + Tambah Pengumuman Baru
            </a>
        </div>

        {{-- Form Search & Filter --}}
        <form action="{{ route('pengumuman.index') }}" method="GET" class="row g-3 mb-4">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control rounded-pill" placeholder="Cari judul pengumuman..."
                    value="{{ request('search') }}">
            </div>

            <div class="col-md-4">
                <select name="kategori" class="form-select rounded-pill">
                    <option value="">-- Semua Kategori --</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100 rounded-pill">
                    Cari
                </button>
            </div>
        </form>

        {{-- Tabel Daftar Pengumuman --}}
        <table class="table table-striped table-bordered align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengumumans as $pengumuman)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pengumuman->judul }}</td>
                        <td>{{ $pengumuman->kategori->nama }}</td>
                        <td>
                            @if ($pengumuman->gambar)
                                <img src="{{ asset($pengumuman->gambar) }}" alt="Gambar" width="100">
                            @else
                                Tidak ada gambar
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('pengumuman.edit', $pengumuman->id) }}"
                                class="btn btn-sm btn-warning rounded-pill mb-1">
                                Edit
                            </a>
                            <form action="{{ route('pengumuman.destroy', $pengumuman->id) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger rounded-pill">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada pengumuman</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
