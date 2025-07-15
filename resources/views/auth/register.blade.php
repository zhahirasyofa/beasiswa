@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="d-flex justify-content-center align-items-center bg-light" style="min-height: 85vh;">
        <div class="card shadow-lg rounded-4 border-0" style="width: 100%; max-width: 400px;">
            <div class="card-body p-4">
                <h4 class="text-center fw-bold mb-4 text-primary">Daftar Akun</h4>

                {{-- Tampilkan Validasi Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger rounded-3 shadow-sm">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div class="mb-3">
                        <label for="name" class="form-label text-dark">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control rounded-3 shadow-sm"
                            value="{{ old('name') }}" required autofocus>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label text-dark">Alamat Email</label>
                        <input type="email" id="email" name="email" class="form-control rounded-3 shadow-sm"
                            value="{{ old('email') }}" required>
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label text-dark">Kata Sandi</label>
                        <input type="password" id="password" name="password" class="form-control rounded-3 shadow-sm"
                            required>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label text-dark">Konfirmasi Sandi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control rounded-3 shadow-sm" required>
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn rounded-pill text-white fw-semibold"
                            style="background-color: #0D1B2A;">
                            Daftar
                        </button>
                    </div>
                </form>

                {{-- Link ke Login --}}
                <div class="mt-4 text-center small text-muted">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold"
                        style="color: #1E3A8A;">Login di sini</a>
                </div>
            </div>
        </div>
    </div>
@endsection
