<?php

namespace App\Http\Controllers;

use App\Models\Pertanian;
use App\Models\Pariwisata;
use App\Models\UMKM;
use Illuminate\Http\Request;

class CakupanController extends Controller
{
    /**
     * List of valid cakupan pages
     */
    private array $allowedPages = [
        'pertanian',
        'pariwisata',
        'umkm',
    ];
    
    /**
     * Display a specific cakupan page
     */
    public function show(string $page)
    {
        // Security: Validate page name against whitelist
        if (!in_array($page, $this->allowedPages)) {
            abort(404, 'Halaman tidak ditemukan');
        }
        
        // Security: Prevent path traversal
        $page = basename($page);
        
        // Check if view file exists
        $viewPath = "frontend.cakupan.{$page}";
        if (!view()->exists($viewPath)) {
            abort(404, 'Halaman tidak ditemukan');
        }
        
        // Get data based on page type
        $data = [];
        switch ($page) {
            case 'pertanian':
                $data['pertanianData'] = Pertanian::latest()->get();
                break;
            case 'pariwisata':
                $data['pariwisataData'] = Pariwisata::latest()->get();
                break;
            case 'umkm':
                $data['umkmData'] = UMKM::latest()->get();
                break;
        }
        
        return view($viewPath, $data);
    }
}
