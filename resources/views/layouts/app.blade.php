<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Portal Beasiswa')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --dongker: #0D1B2A;
            --biru-soft: #1e3a8a;
        }

        body {
            background-color: #f8f9fa;
        }

        .navbar-custom {
            background: linear-gradient(90deg, var(--dongker), var(--biru-soft));
        }

        .nav-link {
            font-weight: 600;
            font-size: 1.05rem;
            color: #f8f9fa !important;
            transition: all 0.2s ease-in-out;
        }

        .nav-link:hover {
            color: #dbeafe !important;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            color: #ffffff !important;
        }

        .btn-profile {
            background-color: white;
            color: var(--biru-soft);
            font-weight: 600;
            border-radius: 30px;
            padding: 6px 18px;
        }

        .btn-profile:hover {
            background-color: #f0f0f0;
            color: #0b5ed7;
        }

        .main-content {
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('homepage') }}">
                <img src="https://img.icons8.com/ios-filled/32/ffffff/graduation-cap.png" class="me-2" alt="Logo">
                BeasiswaApp
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('homepage') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('beasiswa.index') }}">Beasiswa</a></li>

                    @auth
                        @if (auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.pendaftaran.index') }}">Data Pendaftar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('kategori.create') }}">Tambah Kategori</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pengumuman.create') }}">Tambah Pengumuman</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pendaftaran.index') }}">Status Pendaftaran</a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="btn btn-profile dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">@csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-content">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
