@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm border-0 rounded-4 p-4" style="max-width: 600px; margin: auto;">
            <h3 class="fw-bold text-primary mb-4 text-center">Tambah Kategori Beasiswa</h3>

            @if (session('success'))
                <div class="alert alert-success text-center rounded-3 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Kategori</label>
                    <input type="text" name="nama" id="nama" class="form-control rounded-3 shadow-sm" required
                        placeholder="Contoh: Beasiswa Unggulan">
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
@endsection
