<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ZhahiraPendaftarans;
use App\Models\ZhahiraBeasiswas;
use App\Models\ZhahiraKategoris;

class ZhahiraPendaftaransController extends Controller
{
    /**
     * Tampilkan data pendaftaran user yang login.
     */
    public function index()
    {
        $pendaftarans = ZhahiraPendaftarans::with('beasiswa')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pendaftaran.index', compact('pendaftarans'));
    }

    /**
     * Tampilkan form daftar beasiswa.
     */
    public function create($beasiswa)
    {
        $beasiswa = ZhahiraBeasiswas::findOrFail($beasiswa);
        return view('pendaftaran.create', compact('beasiswa'));
    }

    /**
     * Simpan data pendaftaran beasiswa.
     */
    public function store(Request $request)
    {
        $request->validate([
            'beasiswa_id'  => 'required|exists:zhahira_beasiswas,id',
            'nim'          => 'required|string|max:255',
            'prodi'        => 'required|string|max:255',
            'asal_kampus'  => 'required|string|max:255',
            'semester'     => 'required|string|max:255',
            'no_telepon'   => 'required|string|max:255',
        ]);

        $userId = Auth::id();

        // ✅ Cek apakah user sudah diterima di beasiswa lain
        $sudahDiterima = ZhahiraPendaftarans::where('user_id', $userId)
            ->where('status', 'diterima')
            ->exists();

        if ($sudahDiterima) {
            return redirect()->back()->with('error', 'Anda sudah diterima di salah satu beasiswa. Tidak dapat mendaftar lagi.');
        }

        // ✅ Cek apakah user sudah daftar di beasiswa ini
        $sudahDaftarBeasiswaIni = ZhahiraPendaftarans::where('user_id', $userId)
            ->where('beasiswa_id', $request->beasiswa_id)
            ->exists();

        if ($sudahDaftarBeasiswaIni) {
            return redirect()->back()->with('error', 'Anda sudah mendaftar ke beasiswa ini.');
        }

        // ✅ Cek kuota beasiswa
        $beasiswa = ZhahiraBeasiswas::findOrFail($request->beasiswa_id);
        if ($beasiswa->kuota <= 0) {
            return redirect()->back()->with('error', 'Kuota beasiswa sudah habis.');
        }

        // ✅ Simpan data pendaftaran
        ZhahiraPendaftarans::create([
            'user_id'       => $userId,
            'beasiswa_id'   => $request->beasiswa_id,
            'nim'           => $request->nim,
            'prodi'         => $request->prodi,
            'asal_kampus'   => $request->asal_kampus,
            'semester'      => $request->semester,
            'no_telepon'    => $request->no_telepon,
            'tanggal_daftar' => now(),
            'status'        => 'diproses',
        ]);

        // ✅ Kurangi kuota
        $beasiswa->decrement('kuota');

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil.');
    }

    /**
     * Tampilkan semua pendaftar (untuk admin).
     */
    public function semua(Request $request)
    {
        $query = ZhahiraPendaftarans::with(['user', 'beasiswa.kategori']);

        // Filter berdasarkan nama beasiswa
        if ($request->filled('beasiswa')) {
            $query->whereHas('beasiswa', function ($q) use ($request) {
                $q->where('nama_beasiswa', 'like', '%' . $request->beasiswa . '%');
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->whereHas('beasiswa.kategori', function ($q) use ($request) {
                $q->where('id', $request->kategori);
            });
        }

        $pendaftarans = $query->latest()->get();
        $kategoris = ZhahiraKategoris::all();

        return view('admin.pendaftaran.index', compact('pendaftarans', 'kategoris'));
    }

    /**
     * Update status pendaftaran (admin).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,diterima,ditolak',
        ]);

        $pendaftaran = ZhahiraPendaftarans::findOrFail($id);

        if ($request->status === 'diterima') {
            $userId = $pendaftaran->user_id;

            // ✅ Cek apakah sudah diterima di beasiswa lain
            $sudahDiterima = ZhahiraPendaftarans::where('user_id', $userId)
                ->where('status', 'diterima')
                ->where('id', '!=', $pendaftaran->id)
                ->exists();

            if ($sudahDiterima) {
                return redirect()->back()->with('error', 'User ini sudah diterima di beasiswa lain.');
            }

            // ✅ Tolak semua pendaftaran lain milik user tersebut
            ZhahiraPendaftarans::where('user_id', $userId)
                ->where('id', '!=', $pendaftaran->id)
                ->where('status', '!=', 'diterima')
                ->update(['status' => 'ditolak']);
        }

        $pendaftaran->status = $request->status;
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    /**
     * Hapus data pendaftaran (admin).
     */
    public function destroy($id)
    {
        $pendaftaran = ZhahiraPendaftarans::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->back()->with('success', 'Data pendaftar berhasil dihapus.');
    }

    /**
     * Tampilkan daftar beasiswa yang user sudah diterima.
     */
    public function penerima()
    {
        $penerimas = ZhahiraPendaftarans::with('beasiswa')
            ->where('status', 'diterima')
            ->where('user_id', Auth::id())
            ->get();

        return view('admin.pendaftaran.penerima', compact('penerimas'));
    }
}
