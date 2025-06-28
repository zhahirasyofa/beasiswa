@extends('layouts.app')
@section('title', 'Homepage')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Daftar Beasiswa</h1>

        @if ($beasiswas->count() > 0)
            <div class="row g-4">
                @foreach ($beasiswas as $beasiswa)
                    <div class="col-md-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $beasiswa->nama_beasiswa }}</h5>
                                <p class="card-text">{{ Str::limit($beasiswa->deskripsi, 100) }}</p>
                                <p class="card-text"><strong>Deadline:</strong> {{ $beasiswa->tanggal_berakhir }}</p>
                                <a href="#" class="btn btn-outline-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $beasiswas->links() }}
            </div>
        @else
            <p>Tidak ada data beasiswa tersedia.</p>
        @endif
    </div>
@endsection
