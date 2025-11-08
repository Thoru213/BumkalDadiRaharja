<?php

namespace App\Http\Controllers;

use App\Models\Pertanian;
use App\Models\Pariwisata;
use App\Models\UMKM;
use App\Models\Galeri;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display homepage
     */
    public function index()
    {
        // Get all facility data from database
        $pertanianData = Pertanian::latest()->get();
        $pariwisataData = Pariwisata::latest()->get();
        $umkmData = UMKM::latest()->get();
        $galeriData = Galeri::latest()->get();
        
        return view('frontend.index', compact('pertanianData', 'pariwisataData', 'umkmData', 'galeriData'));
    }
}
