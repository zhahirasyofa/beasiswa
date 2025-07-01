<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ZhahiraPendaftarans;
use App\Models\ZhahiraBeasiswas;
use Carbon\Carbon;

class ZhahiraPendaftaransController extends Controller
{
    // Tampilkan form daftar beasiswa
    public function create(Request $request)
    {
        $beasiswaId = $request->query('beasiswa_id');

        // Pastikan beasiswa tersedia
        $beasiswa = ZhahiraBeasiswas::findOrFail($beasiswaId);

        return view('pendaftaran.create', compact('beasiswa'));
    }

    // Simpan data pendaftaran
    public function store(Request $request)
    {
        $request->validate([
            'beasiswa_id'     => 'required|exists:zhahira_beasiswas,id',
            'tanggal_daftar'  => 'required|date',
        ]);

        // Simpan data pendaftaran
        ZhahiraPendaftarans::create([
            'user_id'        => Auth::id(),
            'beasiswa_id'    => $request->beasiswa_id,
            'tanggal_daftar' => $request->tanggal_daftar,
            'status'         => 'diproses'
        ]);

        return redirect()->route('homepage')->with('success', 'Pendaftaran beasiswa berhasil!');
    }
}
