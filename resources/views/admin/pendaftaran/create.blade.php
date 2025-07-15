@extends('layouts.app')

@section('title', 'Form Pendaftaran Beasiswa')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm border-0 rounded-4 p-4" style="max-width: 700px; margin: auto;">
            <h3 class="fw-bold text-primary text-center mb-4">📝 Form Pendaftaran Beasiswa</h3>

            {{-- Error Validation --}}
            @if ($errors->any())
                <div class="alert alert-danger rounded-3 shadow-sm">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pendaftaran.store') }}" method="POST">
                @csrf
                <input type="hidden" name="beasiswa_id" value="{{ $beasiswa->id }}">

                <div class="mb-3">
                    <label for="nim" class="form-label fw-semibold">🎓 NIM</label>
                    <input type="text" name="nim" id="nim" class="form-control rounded-3 shadow-sm"
                        value="{{ old('nim') }}" placeholder="Contoh: 2301092035" required>
                </div>

                <div class="mb-3">
                    <label for="prodi" class="form-label fw-semibold">📚 Program Studi</label>
                    <input type="text" name="prodi" id="prodi" class="form-control rounded-3 shadow-sm"
                        value="{{ old('prodi') }}" placeholder="Contoh: Manajemen Informatika" required>
                </div>

                <div class="mb-3">
                    <label for="asal_kampus" class="form-label fw-semibold">🏫 Asal Kampus</label>
                    <input type="text" name="asal_kampus" id="asal_kampus" class="form-control rounded-3 shadow-sm"
                        value="{{ old('asal_kampus') }}" placeholder="Contoh: Politeknik Negeri Padang" required>
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label fw-semibold">📅 Semester</label>
                    <input type="text" name="semester" id="semester" class="form-control rounded-3 shadow-sm"
                        value="{{ old('semester') }}" placeholder="Contoh: 4" required>
                </div>

                <div class="mb-4">
                    <label for="no_telepon" class="form-label fw-semibold">📞 No Telepon</label>
                    <input type="text" name="no_telepon" id="no_telepon" class="form-control rounded-3 shadow-sm"
                        value="{{ old('no_telepon') }}" placeholder="Contoh: 081234567890" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn px-4 py-2 rounded-pill fw-semibold text-white"
                        style="background-color: #0D1B2A;">
                        Daftar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
