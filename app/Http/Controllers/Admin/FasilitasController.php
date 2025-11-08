<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFasilitasRequest;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    public function __construct()
    {
        // register middleware satu per satu => lebih jelas error jika salah
        $this->middleware(['auth', 'is_admin']);
    }

    public function index()
    {
        $fasilitas = Fasilitas::orderBy('tanggal_fasilitas', 'desc')->paginate(15);
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.fasilitas.create');
    }

    public function store(StoreFasilitasRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto_fasilitas')) {
            $path = $request->file('foto_fasilitas')->store('fasilitas', 'public');
            $data['foto_fasilitas'] = $path;
        }

        Fasilitas::create($data);

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $f = Fasilitas::findOrFail($id);
        return view('admin.fasilitas.edit', compact('f'));
    }

    public function update(StoreFasilitasRequest $request, $id)
    {
        $f = Fasilitas::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('foto_fasilitas')) {
            if ($f->foto_fasilitas && Storage::disk('public')->exists($f->foto_fasilitas)) {
                Storage::disk('public')->delete($f->foto_fasilitas);
            }
            $path = $request->file('foto_fasilitas')->store('fasilitas', 'public');
            $data['foto_fasilitas'] = $path;
        }

        $f->update($data);

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil diupdate.');
    }

    public function destroy($id)
    {
        $f = Fasilitas::findOrFail($id);
        if ($f->foto_fasilitas && Storage::disk('public')->exists($f->foto_fasilitas)) {
            Storage::disk('public')->delete($f->foto_fasilitas);
        }
        $f->delete();

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}
