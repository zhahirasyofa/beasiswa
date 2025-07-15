<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZhahiraPengumumans;
use App\Models\ZhahiraKategoris;
use App\Models\ZhahiraBeasiswas;


class ZhahiraPengumumansController extends Controller
{

    public function index()
    {
        $beasiswas = ZhahiraBeasiswas::paginate(6); // contoh
        $pengumumans = ZhahiraPengumumans::with('kategori')->latest()->take(5)->get();

        return view('homepage', compact('beasiswas', 'pengumumans'));
    }

    public function create()
    {
        $kategoris = ZhahiraKategoris::all();
        return view('admin.pengumuman.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori_id' => 'required|exists:zhahira_kategoris,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only('judul', 'isi', 'kategori_id');

        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('gambar'), $namaFile);
            $data['gambar'] = 'gambar/' . $namaFile; // disimpan di DB
        }

        ZhahiraPengumumans::create($data);

        return redirect()->route('pengumuman.create')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pengumuman = ZhahiraPengumumans::with('kategori')->findOrFail($id);
        return view('admin.pengumuman.show', compact('pengumuman'));
    }
}
