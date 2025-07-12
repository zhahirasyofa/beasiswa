@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="d-flex justify-content-center align-items-center bg-light" style="min-height: 85vh;">
        <div class="card shadow rounded-4 border-0" style="width: 100%; max-width: 400px;">
            <div class="card-body p-4">
                <h4 class="text-center fw-bold mb-4" style="color: #0D1B2A;">Daftar Akun</h4>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label text-dark">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control rounded-3" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label text-dark">Alamat Email</label>
                        <input type="email" name="email" class="form-control rounded-3" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-dark">Kata Sandi</label>
                        <input type="password" name="password" class="form-control rounded-3" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label text-dark">Konfirmasi Sandi</label>
                        <input type="password" name="password_confirmation" class="form-control rounded-3" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn rounded-pill text-white fw-semibold"
                            style="background-color: #0D1B2A;">
                            Daftar
                        </button>
                    </div>
                </form>

                <div class="mt-4 text-center small text-muted">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none"
                        style="color: #1E3A8A;">Login di sini</a>
                </div>
            </div>
        </div>
    </div>
@endsection
