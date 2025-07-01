<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZhahiraBeasiswas; // ← Pastikan ini sesuai nama model kamu

class HomeController extends Controller
{
    public function index()
    {
        $beasiswas = ZhahiraBeasiswas::latest()->paginate(6); // ← gunakan model yang benar
        return view('homepage', compact('beasiswas')); // ← pastikan view-nya "homepage"
    }
    public function dashboard()
{
    $beasiswas = ZhahiraBeasiswas::latest()->paginate(6);
    return view('dashboard', compact('beasiswas'));
}

}
