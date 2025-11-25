@extends('admin.layout')

@section('content')
<div style="padding: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="color: #047857; margin: 0;">📸 Galeri</h2>
        <a href="{{ route('admin.galeri.create') }}" style="background: linear-gradient(135deg, #047857 0%, #059669 100%); color: white; padding: 0.85rem 2rem; text-decoration: none; border-radius: 8px; font-weight: 600; transition: transform 0.3s;">
            ➕ Tambah Gambar
        </a>
    </div>

    @if(session('success'))
        <div style="background: #d1fae5; color: #047857; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; border-left: 4px solid #047857;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div style="background: white; border-radius: 10px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        @if($galeris->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 2rem;">
                @foreach($galeris as $galeri)
                    <div style="background: #f9fafb; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.3s;">
                        <div style="position: relative; padding-top: 75%; overflow: hidden;">
                            <img src="{{ asset($galeri->gambar) }}" 
                                 alt="{{ $galeri->judul }}" 
                                 style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div style="padding: 1rem;">
                            <h3 style="color: #047857; margin: 0 0 1rem 0; font-size: 1.1rem;">{{ $galeri->judul }}</h3>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('admin.galeri.edit', $galeri) }}" 
                                   style="flex: 1; background: #059669; color: white; padding: 0.6rem 1rem; text-decoration: none; border-radius: 6px; text-align: center; font-size: 0.9rem; font-weight: 600;">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" style="flex: 1;" onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="width: 100%; background: #dc2626; color: white; padding: 0.6rem 1rem; border: none; border-radius: 6px; cursor: pointer; font-size: 0.9rem; font-weight: 600;">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align: center; padding: 3rem; color: #6b7280;">
                <p style="font-size: 1.2rem; margin-bottom: 1rem;">📷 Belum ada gambar di galeri</p>
                <a href="{{ route('admin.galeri.create') }}" style="background: #059669; color: white; padding: 0.85rem 2rem; text-decoration: none; border-radius: 8px; display: inline-block; font-weight: 600;">
                    Tambah Gambar Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
