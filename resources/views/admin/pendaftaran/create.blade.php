@extends('layouts.app')

@section('title', 'Form Pendaftaran Beasiswa')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Form Pendaftaran Beasiswa</h2>

    {{-- Error Validation --}}
    @if ($errors->any())
        <div class="alert alert-danger">
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
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" name="nim" value="{{ old('nim') }}" required>
        </div>

        <div class="mb-3">
            <label for="prodi" class="form-label">Program Studi</label>
            <input type="text" class="form-control" name="prodi" value="{{ old('prodi') }}" required>
        </div>

        <div class="mb-3">
            <label for="asal_kampus" class="form-label">Asal Kampus</label>
            <input type="text" class="form-control" name="asal_kampus" value="{{ old('asal_kampus') }}" required>
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="text" class="form-control" name="semester" value="{{ old('semester') }}" required>
        </div>

        <div class="mb-3">
            <label for="no_telepon" class="form-label">No Telepon</label>
            <input type="text" class="form-control" name="no_telepon" value="{{ old('no_telepon') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
</div>
@endsection
