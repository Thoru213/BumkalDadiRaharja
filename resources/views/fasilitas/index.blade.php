@extends('layouts.app')

@section('content')
<h1>Daftar Fasilitas</h1>
<ul>
@foreach($fasilitas as $f)
<li>
    <a href="{{ route('fasilitas.show', $f->id_fasilitas) }}">
    {{ $f->judul_fasilitas }}
    </a>
</li>
@endforeach
</ul>
@endsection
