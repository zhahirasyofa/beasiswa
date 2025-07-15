@extends('layouts.app')

@section('title', 'Tambah Beasiswa')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm border-0 rounded-4 p-4" style="max-width: 800px; margin: auto;">
            <h3 class="fw-bold text-primary text-center mb-4">➕ Tambah Beasiswa Baru</h3>

            <form action="{{ route('beasiswa.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_beasiswa" class="form-label fw-semibold">🎓 Nama Beasiswa</label>
                    <input type="text" class="form-control rounded-3 shadow-sm" name="nama_beasiswa" id="nama_beasiswa"
                        placeholder="Contoh: Beasiswa Prestasi Unggulan" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-semibold">📝 Deskripsi</label>
                    <textarea class="form-control rounded-3 shadow-sm" name="deskripsi" id="deskripsi" rows="4"
                        placeholder="Tulis deskripsi lengkap tentang beasiswa..." required></textarea>
                </div>

                <div class="mb-3">
                    <label for="kuota" class="form-label fw-semibold">👥 Kuota</label>
                    <input type="number" class="form-control rounded-3 shadow-sm" name="kuota" id="kuota"
                        placeholder="Contoh: 50" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tanggal_mulai" class="form-label fw-semibold">📅 Tanggal Mulai</label>
                        <input type="date" class="form-control rounded-3 shadow-sm" name="tanggal_mulai"
                            id="tanggal_mulai" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_selesai" class="form-label fw-semibold">📅 Tanggal Selesai</label>
                        <input type="date" class="form-control rounded-3 shadow-sm" name="tanggal_selesai"
                            id="tanggal_selesai" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="kategori_id" class="form-label fw-semibold">🏷️ Kategori Beasiswa</label>
                    <select name="kategori_id" id="kategori_id" class="form-select rounded-3 shadow-sm" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="bantuan" class="form-label fw-semibold">💸 Bantuan</label>
                    <textarea name="bantuan" id="bantuan" rows="4" class="form-control rounded-3 shadow-sm"
                        placeholder="Contoh:
Biaya kuliah penuh
Tunjangan hidup
Dana buku & transportasi" required></textarea>
                    <small class="text-muted">Pisahkan poin dengan Enter agar tampil bullet point.</small>
                </div>


                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold"
                        style="background-color: #0D1B2A;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
