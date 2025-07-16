@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm border-0 rounded-4 p-4" style="max-width: 700px; margin: auto;">
            <h3 class="fw-bold text-primary mb-4 text-center">Tambah Pengumuman Baru</h3>

            {{-- Notifikasi berhasil --}}
            @if (session('success'))
                <div class="alert alert-success rounded-3">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form tambah --}}
            <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">Judul Pengumuman</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                        class="form-control rounded-3 shadow-sm" placeholder="Contoh: Penerimaan Beasiswa Semester Ganjil"
                        required>
                    @error('judul')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label fw-semibold">Isi Pengumuman</label>
                    <textarea name="isi" id="isi" rows="6" class="form-control rounded-3 shadow-sm"
                        placeholder="Tulis detail informasi pengumuman di sini..." required>{{ old('isi') }}</textarea>
                    @error('isi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label fw-semibold">Upload Gambar (Opsional)</label>
                    <input type="file" name="gambar" id="gambar" class="form-control rounded-3 shadow-sm"
                        accept="image/*">
                    @error('gambar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="kategori_id" class="form-label fw-semibold">Pilih Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-select rounded-3 shadow-sm" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('pengumuman.index') }}" class="btn btn-outline-secondary rounded-pill">
                        Kembali
                    </a>

                    <button type="submit" class="btn px-4 py-2 rounded-pill fw-semibold text-white"
                        style="background-color: #0D1B2A;">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
