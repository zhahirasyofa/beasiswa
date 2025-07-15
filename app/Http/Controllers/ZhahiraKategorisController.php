<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZhahiraKategoris;

class ZhahiraKategorisController extends Controller
{

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('admin.kategori.create');
    }

    // Menyimpan data kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'biaya_hidup' => 'nullable|numeric|min:0',
            'biaya_pendidikan' => 'nullable|numeric|min:0',
        ]);

        ZhahiraKategoris::create([
            'nama' => $request->nama,
            'biaya_hidup' => $request->biaya_hidup,
            'biaya_pendidikan' => $request->biaya_pendidikan,
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }
}
