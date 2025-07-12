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
            'nama' => 'required|string|max:255'
        ]);

        ZhahiraKategoris::create([
            'nama' => $request->nama,
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan');
    }
}
