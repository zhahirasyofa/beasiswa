<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ZhahiraPendaftarans;
use App\Models\ZhahiraBeasiswas;
use App\Models\ZhahiraKategoris;
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

        $userId = Auth::id();

        // Cek apakah user sudah mendaftar ke beasiswa yang sama
        $sudahDaftarBeasiswaIni = ZhahiraPendaftarans::where('user_id', $userId)
            ->where('beasiswa_id', $request->beasiswa_id)
            ->exists();

        if ($sudahDaftarBeasiswaIni) {
            return redirect()->back()->with('error', 'Anda sudah mendaftar ke beasiswa ini.');
        }

        $beasiswa = ZhahiraBeasiswas::findOrFail($request->beasiswa_id);

        if ($beasiswa->kuota <= 0) {
            return redirect()->back()->with('error', 'Kuota beasiswa sudah habis.');
        }

        // Simpan pendaftaran
        ZhahiraPendaftarans::create([
            'user_id' => $userId,
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

    public function semua(Request $request)
    {
        $query = ZhahiraPendaftarans::with(['user', 'beasiswa.kategori']);

        // Filter nama beasiswa
        if ($request->has('beasiswa') && $request->beasiswa != '') {
            $query->whereHas('beasiswa', function ($q) use ($request) {
                $q->where('nama_beasiswa', 'like', '%' . $request->beasiswa . '%');
            });
        }

        // Filter kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->whereHas('beasiswa.kategori', function ($q) use ($request) {
                $q->where('id', $request->kategori);
            });
        }

        $pendaftarans = $query->latest()->get();
        $kategoris = ZhahiraKategoris::all();

        return view('admin.pendaftaran.index', compact('pendaftarans', 'kategoris'));
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,diterima,ditolak',
        ]);

        $pendaftaran = ZhahiraPendaftarans::findOrFail($id);

        // Cek apakah user sudah diterima di beasiswa lain
        if ($request->status === 'diterima') {
            $userId = $pendaftaran->user_id;

            // Cek apakah sudah diterima di beasiswa lain
            $sudahDiterima = ZhahiraPendaftarans::where('user_id', $userId)
                ->where('status', 'diterima')
                ->where('id', '!=', $pendaftaran->id)
                ->exists();

            if ($sudahDiterima) {
                return redirect()->back()->with('error', 'User ini sudah diterima di beasiswa lain.');
            }

            // Ubah semua pendaftaran lain menjadi ditolak
            ZhahiraPendaftarans::where('user_id', $userId)
                ->where('id', '!=', $pendaftaran->id)
                ->where('status', '!=', 'diterima')
                ->update(['status' => 'ditolak']);
        }

        // Update status yang dipilih
        $pendaftaran->status = $request->status;
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $pendaftaran = ZhahiraPendaftarans::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->back()->with('success', 'Data pendaftar berhasil dihapus.');
    }

    public function penerima()
    {
        $penerimas = ZhahiraPendaftarans::with(['beasiswa'])
            ->where('status', 'diterima')
            ->where('user_id', Auth::id()) // hanya user yang login
            ->get();

        return view('admin.pendaftaran.penerima', compact('penerimas'));
    }
}
