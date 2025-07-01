<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZhahiraBeasiswas;
use App\Models\ZhahiraKategoris;


class ZhahiraBeasiswasController extends Controller
{
    public function index()
    {
        $beasiswas = ZhahiraBeasiswas::all();
        return view('admin.beasiswa.index', compact('beasiswas'));
    }

    public function create()
    {
        $kategoris = ZhahiraKategoris::all(); // ambil semua kategori dari DB
        return view('admin.beasiswa.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_beasiswa' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kuota' => 'required|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'kategori_id' => 'required|exists:zhahira_kategoris,id',
        ]);

        ZhahiraBeasiswas::create([
            'nama_beasiswa' => $request->nama_beasiswa,
            'deskripsi' => $request->deskripsi,
            'kuota' => $request->kuota,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kategori_id' => $request->kategori_id,
        ]);

        // Redirect ke halaman daftar beasiswa dengan pesan sukses
        return redirect()->route('beasiswa.index')->with('success', 'Beasiswa berhasil ditambahkan.');
    }

    public function update(Request $request, ZhahiraBeasiswas $beasiswa)
    {
        $request->validate([
            'nama_beasiswa' => 'required',
            'deskripsi' => 'required',
            'kuota' => 'required|numeric',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'kategori_id' => 'required|exists:zhahira_kategoris,id',
        ]);

        $beasiswa->update([
            'nama_beasiswa' => $request->nama_beasiswa,
            'deskripsi' => $request->deskripsi,
            'kuota' => $request->kuota,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('beasiswa.index')->with('success', 'Data beasiswa berhasil diperbarui.');
    }

    public function edit(ZhahiraBeasiswas $beasiswa)
    {
        $kategoris = ZhahiraKategoris::all();
        return view('admin.beasiswa.edit', compact('beasiswa', 'kategoris'));
    }


    public function destroy(ZhahiraBeasiswas $beasiswa)
    {
        $beasiswa->delete();
        return redirect()->route('beasiswa.index')->with('success', 'Beasiswa berhasil dihapus.');
    }
}
