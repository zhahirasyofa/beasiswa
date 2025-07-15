<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ZhahiraPendaftarans;
use App\Models\ZhahiraBeasiswas;
use App\Models\User;


class ZhahiraPendaftaransController extends Controller
{
    public function index()
    {
        $pendaftarans = ZhahiraPendaftarans::with('beasiswa') // relasi beasiswa
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pendaftaran.index', compact('pendaftarans'));
    }

    // Tampilkan form daftar beasiswa
    public function create($beasiswa)
    {
        $beasiswa = ZhahiraBeasiswas::findOrFail($beasiswa);
        return view('pendaftaran.create', compact('beasiswa'));
    }


    // Simpan data pendaftaran
    public function store(Request $request)
    {
        $request->validate([
            'beasiswa_id' => 'required|exists:zhahira_beasiswas,id',
            'nim' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'asal_kampus' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:255',
        ]);

        $beasiswa = ZhahiraBeasiswas::findOrFail($request->beasiswa_id);

        if ($beasiswa->kuota <= 0) {
            return back()->with('error', 'Kuota beasiswa sudah habis.');
        }

        ZhahiraPendaftarans::create([
            'user_id' => Auth::id(),
            'beasiswa_id' => $request->beasiswa_id,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'asal_kampus' => $request->asal_kampus,
            'semester' => $request->semester,
            'no_telepon' => $request->no_telepon,
            'tanggal_daftar' => now(),
            'status' => 'diproses',
        ]);

        $beasiswa->decrement('kuota');

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil.');
    }
    


    public function semua()
    {
        $pendaftarans = ZhahiraPendaftarans::with(['user', 'beasiswa'])->latest()->get();

        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,diterima,ditolak',
        ]);

        $pendaftaran = ZhahiraPendaftarans::findOrFail($id);
        $pendaftaran->status = $request->status;
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }
}
