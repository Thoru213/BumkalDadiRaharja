<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertanian;
use Illuminate\Http\Request;

class PertanianController extends Controller
{
    public function index()
    {
        $data = Pertanian::latest()->get();
        return view('admin.pertanian.index', compact('data'));
    }

    public function create()
    {
        return view('admin.pertanian.form');
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
            $file->move(public_path('uploads/pertanian'), $filename);
            $data['gambar'] = 'uploads/pertanian/' . $filename;
        }

        Pertanian::create($data);

        return redirect()->route('admin.pertanian.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Pertanian $pertanian)
    {
        return view('admin.pertanian.form', compact('pertanian'));
    }

    public function update(Request $request, Pertanian $pertanian)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['judul', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            if ($pertanian->gambar && file_exists(public_path($pertanian->gambar))) {
                unlink(public_path($pertanian->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pertanian'), $filename);
            $data['gambar'] = 'uploads/pertanian/' . $filename;
        }

        $pertanian->update($data);

        return redirect()->route('admin.pertanian.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(Pertanian $pertanian)
    {
        if ($pertanian->gambar && file_exists(public_path($pertanian->gambar))) {
            unlink(public_path($pertanian->gambar));
        }

        $pertanian->delete();

        return redirect()->route('admin.pertanian.index')->with('success', 'Data berhasil dihapus!');
    }
}
