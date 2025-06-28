<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZhahiraBeasiswas;

class ZhahiraBeasiswaController extends Controller
{
    public function index()
    {
        $data = ZhahiraBeasiswas::all();
        return view('admin.beasiswa.index', compact('data'));
    }

    public function create()
    {
        return view('admin.beasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_beasiswa' => 'required',
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai'
        ]);

        ZhahiraBeasiswas::create($request->all());
        return redirect()->route('beasiswa.index')->with('success', 'Data beasiswa berhasil ditambahkan.');
    }

    public function edit(ZhahiraBeasiswas $beasiswa)
    {
        return view('admin.beasiswa.edit', compact('beasiswa'));
    }

    public function update(Request $request, ZhahiraBeasiswas $beasiswa)
    {
        $request->validate([
            'nama_beasiswa' => 'required',
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai'
        ]);

        $beasiswa->update($request->all());
        return redirect()->route('beasiswa.index')->with('success', 'Data beasiswa berhasil diperbarui.');
    }

    public function destroy(ZhahiraBeasiswas $beasiswa)
    {
        $beasiswa->delete();
        return redirect()->route('beasiswa.index')->with('success', 'Data beasiswa berhasil dihapus.');
    }
}
