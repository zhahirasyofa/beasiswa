@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm border-0 rounded-4 p-4" style="max-width: 700px; margin: auto;">
            <h3 class="fw-bold text-primary mb-4 text-center">Edit Pengumuman</h3>

            <form action="{{ route('pengumuman.update', $pengumumans->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">Judul Pengumuman</label>
                    <input type="text" name="judul" id="judul" value="{{ $pengumumans->judul }}"
                        class="form-control rounded-3 shadow-sm" required>
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label fw-semibold">Isi Pengumuman</label>
                    <textarea name="isi" id="isi" class="form-control rounded-3 shadow-sm" rows="6" required>{{ $pengumumans->isi }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label fw-semibold">Upload Gambar Baru (Opsional)</label>
                    <input type="file" name="gambar" id="gambar" class="form-control rounded-3 shadow-sm"
                        accept="image/*">
                    @if ($pengumumans->gambar)
                        <img src="{{ asset($pengumumans->gambar) }}" alt="Gambar" width="150" class="mt-2">
                    @endif
                </div>

                <div class="mb-4">
                    <label for="kategori_id" class="form-label fw-semibold">Pilih Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-select rounded-3 shadow-sm" required>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ $pengumumans->kategori_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn px-4 py-2 rounded-pill fw-semibold text-white"
                        style="background-color: #0D1B2A;">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
