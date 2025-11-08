<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pariwisata;
use Illuminate\Http\Request;

class PariwisataController extends Controller
{
    public function index()
    {
        $data = Pariwisata::latest()->get();
        return view('admin.pariwisata.index', compact('data'));
    }

    public function create()
    {
        return view('admin.pariwisata.form');
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
            $file->move(public_path('uploads/pariwisata'), $filename);
            $data['gambar'] = 'uploads/pariwisata/' . $filename;
        }

        Pariwisata::create($data);

        return redirect()->route('admin.pariwisata.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pariwisata = Pariwisata::findOrFail($id);
        return view('admin.pariwisata.form', compact('pariwisata'));
    }

    public function update(Request $request, $id)
    {
        $pariwisata = Pariwisata::findOrFail($id);
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['judul', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            if ($pariwisata->gambar && file_exists(public_path($pariwisata->gambar))) {
                unlink(public_path($pariwisata->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pariwisata'), $filename);
            $data['gambar'] = 'uploads/pariwisata/' . $filename;
        }

        $pariwisata->update($data);

        return redirect()->route('admin.pariwisata.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $pariwisata = Pariwisata::findOrFail($id);
        
        if ($pariwisata->gambar && file_exists(public_path($pariwisata->gambar))) {
            unlink(public_path($pariwisata->gambar));
        }

        $pariwisata->delete();

        return redirect()->route('admin.pariwisata.index')->with('success', 'Data berhasil dihapus!');
    }
}
