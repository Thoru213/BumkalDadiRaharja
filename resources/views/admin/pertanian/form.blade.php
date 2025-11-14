@extends('admin.layout')

@section('content')
<div style="padding: 2rem;">
    <h2 style="color: #047857; margin-bottom: 1.5rem;">{{ isset($pertanian) ? '✏️ Edit' : '➕ Tambah' }} Data Pertanian, Perkebunan, Peternakan & Perikanan</h2>
    
    <form action="{{ isset($pertanian) ? route('admin.pertanian.update', $pertanian) : route('admin.pertanian.store') }}" method="POST" enctype="multipart/form-data" style="background: white; padding: 2rem; border-radius: 10px; max-width: 800px; margin-top: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        @csrf
        @if(isset($pertanian))
            @method('PUT')
        @endif

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #047857;">📌 Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $pertanian->judul ?? '') }}" required
                style="width: 100%; padding: 0.85rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;"
                onfocus="this.style.borderColor='#059669'" onblur="this.style.borderColor='#e5e7eb'">
            @error('judul')
                <span style="color: #dc2626; font-size: 0.875rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #047857;">📝 Deskripsi</label>
            <textarea name="deskripsi" rows="5" required
                style="width: 100%; padding: 0.85rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s; font-family: inherit;"
                onfocus="this.style.borderColor='#059669'" onblur="this.style.borderColor='#e5e7eb'">{{ old('deskripsi', $pertanian->deskripsi ?? '') }}</textarea>
            @error('deskripsi')
                <span style="color: #dc2626; font-size: 0.875rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 1.5rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #047857;">🖼️ Gambar</label>
            @if(isset($pertanian) && $pertanian->gambar)
                <div style="margin-bottom: 1rem; padding: 1rem; background: #f9fafb; border-radius: 8px; text-align: center;">
                    <img src="{{ asset($pertanian->gambar) }}" alt="{{ $pertanian->judul }}" style="max-width: 300px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <p style="margin-top: 0.75rem; color: #6b7280; font-size: 0.875rem;">Gambar saat ini</p>
                </div>
            @endif
            <input type="file" name="gambar" accept="image/*"
                style="width: 100%; padding: 0.85rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem;">
            <small style="color: #6b7280; font-size: 0.875rem; display: block; margin-top: 0.5rem;">
                📏 Ukuran maksimal: 2MB • Format: JPG, PNG, GIF • Resolusi rekomendasi: 800x600px
            </small>
            @error('gambar')
                <span style="color: #dc2626; font-size: 0.875rem; display: block; margin-top: 0.5rem;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem; padding-top: 1.5rem; border-top: 2px solid #f3f4f6;">
            <button type="submit" style="background: linear-gradient(135deg, #047857 0%, #059669 100%); color: white; padding: 0.85rem 2rem; border: none; border-radius: 8px; cursor: pointer; font-size: 1rem; font-weight: 600; transition: transform 0.3s;"
                onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                💾 {{ isset($pertanian) ? 'Update' : 'Simpan' }}
            </button>
            <a href="{{ route('admin.pertanian.index') }}" style="background: #6b7280; color: white; padding: 0.85rem 2rem; text-decoration: none; border-radius: 8px; display: inline-flex; align-items: center; font-weight: 600; transition: background 0.3s;"
                onmouseover="this.style.background='#4b5563'" onmouseout="this.style.background='#6b7280'">
                ✕ Batal
            </a>
        </div>
    </form>
</div>
@endsection
