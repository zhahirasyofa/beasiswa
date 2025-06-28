<?php

namespace App\Http\Controllers;

use App\Models\ZhahiraPengumumans;
use App\Models\ZhahiraKategoris;
use Illuminate\Http\Request;

class ZhahiraPengumumansController extends Controller
{
    public function index()
    {
        $data = ZhahiraPengumumans::with('kategori')->get();
        return view('admin.pengumuman.index', compact('data'));
    }

    public function create()
    {
        $kategori = ZhahiraKategoris::all();
        return view('admin.pengumuman.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string',
            'kategori_id' => 'required|exists:zhahira_kategoris,id',
        ]);

        ZhahiraPengumumans::create($request->all());

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function edit(ZhahiraPengumumans $pengumuman)
    {
        $kategori = ZhahiraKategoris::all();
        return view('admin.pengumuman.edit', compact('pengumuman', 'kategori'));
    }

    public function update(Request $request, ZhahiraPengumumans $pengumuman)
    {
        $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string',
            'kategori_id' => 'required|exists:zhahira_kategoris,id',
        ]);

        $pengumuman->update($request->all());

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui');
    }

    public function destroy(ZhahiraPengumumans $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dihapus');
    }
}
