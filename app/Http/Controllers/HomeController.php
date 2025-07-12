<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZhahiraBeasiswas; // ← Pastikan ini sesuai nama model kamu
use App\Models\ZhahiraPengumumans;

class HomeController extends Controller
{
    public function index()
    {
        $beasiswas = ZhahiraBeasiswas::latest()->paginate(6);
        $pengumumans = ZhahiraPengumumans::with('kategori')->latest()->take(5)->get(); // ambil 5 pengumuman terbaru

        return view('homepage', compact('beasiswas', 'pengumumans'));
    }
    public function dashboard()
    {
        $beasiswas = ZhahiraBeasiswas::latest()->paginate(6);
        return view('dashboard', compact('beasiswas'));
    }
}
