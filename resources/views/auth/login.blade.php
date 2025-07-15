@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="d-flex justify-content-center align-items-center bg-light" style="min-height: 85vh;">
        <div class="card shadow-lg rounded-4 border-0 px-4 py-3" style="width: 100%; max-width: 400px;">
            <div class="card-body">
                <h4 class="text-center fw-bold mb-4 text-primary">Masuk ke Akun</h4>

                {{-- Pesan Error --}}
                @if (session('error'))
                    <div class="alert alert-danger text-center rounded-3 shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label text-dark">Alamat Email</label>
                        <input type="email" name="email" id="email" class="form-control rounded-3 shadow-sm"
                            required autofocus>
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label text-dark">Kata Sandi</label>
                        <input type="password" name="password" id="password" class="form-control rounded-3 shadow-sm"
                            required>
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn rounded-pill text-white fw-semibold"
                            style="background-color: #0D1B2A;">
                            Masuk
                        </button>
                    </div>
                </form>

                {{-- Link ke Register --}}
                <div class="mt-4 text-center small text-muted">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none fw-semibold"
                        style="color: #1E3A8A;">Daftar di sini</a>
                </div>
            </div>
        </div>
    </div>
@endsection
