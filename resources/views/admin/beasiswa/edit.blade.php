@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Edit Beasiswa</h4>

        <form action="{{ route('beasiswa.update', $beasiswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_beasiswa" class="form-label">Nama Beasiswa</label>
                <input type="text" name="nama_beasiswa" class="form-control" value="{{ $beasiswa->nama_beasiswa }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3" required>{{ $beasiswa->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label for="kuota" class="form-label">Kuota</label>
                <input type="number" name="kuota" class="form-control" value="{{ $beasiswa->kuota }}" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control" value="{{ $beasiswa->tanggal_mulai }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="{{ $beasiswa->tanggal_selesai }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori</label>
                <select name="kategori_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ $kategori->id == $beasiswa->kategori_id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="bantuan" class="form-label fw-semibold">Bantuan</label>
                <textarea name="bantuan" id="bantuan" rows="4" class="form-control rounded-3 shadow-sm" required>{{ old('bantuan', $beasiswa->bantuan) }}</textarea>
                <small class="text-muted">Pisahkan poin dengan Enter agar tampil bullet point.</small>
            </div>


            <button type="submit" class="btn btn-primary text-light" style="background-color: #0D1B2A;">Update</button>
        </form>
    </div>
@endsection
