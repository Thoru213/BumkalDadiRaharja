<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);

        $galeri = new Galeri();
        $galeri->judul = $request->judul;

        if ($request->hasFile('gambar')) {
            $imageFile = $request->file('gambar');
            $filename = time() . '_' . $imageFile->getClientOriginalName();
            
            // Save optimized full image (max 1200px width, 85% quality)
            $fullImage = Image::read($imageFile)
                ->scale(width: 1200)
                ->toJpeg(quality: 85);
            
            $fullPath = 'galeri/' . $filename;
            Storage::disk('public')->put($fullPath, $fullImage);
            
            // Save tiny thumbnail for blur placeholder (50px width, 60% quality)
            $thumbImage = Image::read($imageFile)
                ->scale(width: 50)
                ->toJpeg(quality: 60);
            
            $thumbPath = 'galeri/thumb_' . $filename;
            Storage::disk('public')->put($thumbPath, $thumbImage);

            $galeri->gambar = $fullPath;
            $galeri->gambar_thumb = $thumbPath;
        }

        $galeri->save();

        return redirect()->route('admin.galeri.index')->with('success', 'Gambar berhasil ditambahkan!');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.form', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $galeri->judul = $request->judul;

        if ($request->hasFile('gambar')) {
            // Delete old images
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            if ($galeri->gambar_thumb && Storage::disk('public')->exists($galeri->gambar_thumb)) {
                Storage::disk('public')->delete($galeri->gambar_thumb);
            }

            $imageFile = $request->file('gambar');
            $filename = time() . '_' . $imageFile->getClientOriginalName();
            
            // Save optimized full image
            $fullImage = Image::read($imageFile)
                ->scale(width: 1200)
                ->toJpeg(quality: 85);
            
            $fullPath = 'galeri/' . $filename;
            Storage::disk('public')->put($fullPath, $fullImage);
            
            // Save thumbnail
            $thumbImage = Image::read($imageFile)
                ->scale(width: 50)
                ->toJpeg(quality: 60);
            
            $thumbPath = 'galeri/thumb_' . $filename;
            Storage::disk('public')->put($thumbPath, $thumbImage);

            $galeri->gambar = $fullPath;
            $galeri->gambar_thumb = $thumbPath;
        }

        $galeri->save();

        return redirect()->route('admin.galeri.index')->with('success', 'Gambar berhasil diupdate!');
    }

    public function destroy(Galeri $galeri)
    {
        // Delete images
        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }
        if ($galeri->gambar_thumb && Storage::disk('public')->exists($galeri->gambar_thumb)) {
            Storage::disk('public')->delete($galeri->gambar_thumb);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Gambar berhasil dihapus!');
    }
}
