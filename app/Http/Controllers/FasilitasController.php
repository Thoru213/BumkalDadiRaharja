<?php

namespace App\Http\Controllers;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{

public function index()
{
    $fasilitas = Fasilitas::orderBy('tanggal_fasilitas', 'desc')->paginate(9);
        return view('fasilitas.index', compact('fasilitas'));
}


public function show($id)
{
$f = Fasilitas::findOrFail($id);
return view('fasilitas.show', ['fasilitas' => $f]);
}
}

