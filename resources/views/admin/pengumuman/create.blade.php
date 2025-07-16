@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm border-0 rounded-4 p-4" style="max-width: 700px; margin: auto;">
            <h3 class="fw-bold text-primary mb-4 text-center">Tambah Pengumuman Baru</h3>

            @if (session('success'))
                <div class="alert alert-success text-center rounded-3 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">Judul Pengumuman</label>
                    <input type="text" name="judul" id="judul" class="form-control rounded-3 shadow-sm" required
                        placeholder="Contoh: Penerimaan Beasiswa Semester Ganjil">
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label fw-semibold">Isi Pengumuman</label>
                    <textarea name="isi" id="isi" class="form-control rounded-3 shadow-sm" rows="6" required
                        placeholder="Tulis detail informasi pengumuman di sini..."></textarea>
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label fw-semibold">Upload Gambar (Opsional)</label>
                    <input type="file" name="gambar" id="gambar" class="form-control rounded-3 shadow-sm"
                        accept="image/*">
                </div>

                <div class="mb-4">
                    <label for="kategori_id" class="form-label fw-semibold">Pilih Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-select rounded-3 shadow-sm" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn px-4 py-2 rounded-pill fw-semibold text-white"
                        style="background-color: #0D1B2A;">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-5">
        <h4 class="fw-bold text-primary mb-3 text-center">Daftar Pengumuman</h4>
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
                                <img src="{{ asset('storage/' . $pengumuman->gambar) }}" alt="Gambar" width="100">
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
