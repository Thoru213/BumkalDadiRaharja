<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertanian;
use App\Models\Pariwisata;
use App\Models\UMKM;
use App\Models\Galeri;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'pertanian' => Pertanian::count(),
            'pariwisata' => Pariwisata::count(),
            'umkm' => UMKM::count(),
            'galeri' => Galeri::count(),
            'total_gambar' => Pertanian::count() + Pariwisata::count() + UMKM::count() + Galeri::count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }
}
