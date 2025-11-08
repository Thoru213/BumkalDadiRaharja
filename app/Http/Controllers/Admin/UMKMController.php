<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UMKM;
use Illuminate\Http\Request;

class UMKMController extends Controller
{
    public function index()
    {
        $data = UMKM::latest()->get();
        return view('admin.umkm.index', compact('data'));
    }

    public function create()
    {
        return view('admin.umkm.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['judul', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/umkm'), $filename);
            $data['gambar'] = 'uploads/umkm/' . $filename;
        }

        UMKM::create($data);

        return redirect()->route('admin.umkm.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(UMKM $umkm)
    {
        return view('admin.umkm.form', compact('umkm'));
    }

    public function update(Request $request, UMKM $umkm)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['judul', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            if ($umkm->gambar && file_exists(public_path($umkm->gambar))) {
                unlink(public_path($umkm->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/umkm'), $filename);
            $data['gambar'] = 'uploads/umkm/' . $filename;
        }

        $umkm->update($data);

        return redirect()->route('admin.umkm.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(UMKM $umkm)
    {
        if ($umkm->gambar && file_exists(public_path($umkm->gambar))) {
            unlink(public_path($umkm->gambar));
        }

        $umkm->delete();

        return redirect()->route('admin.umkm.index')->with('success', 'Data berhasil dihapus!');
    }
}
