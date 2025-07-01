@extends('layouts.app')
@section('title', 'Form Pendaftaran')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-primary text-white fw-bold">
                    Form Pendaftaran Beasiswa
                </div>
                <div class="card-body">
                    <form action="{{ route('pendaftaran.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="beasiswa_id" value="{{ $beasiswa->id }}">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Beasiswa</label>
                            <input type="text" class="form-control" value="{{ $beasiswa->nama_beasiswa }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal Daftar</label>
                            <input type="date" name="tanggal_daftar" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold">Kirim Pendaftaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
