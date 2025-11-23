@extends('admin.layout')

@section('title', 'Tentang Kami - Settings')

@section('content')
<style>
    .settings-page {
        max-width: 900px;
        margin: 0 auto;
    }
    
    .settings-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    
    .settings-header {
        background: linear-gradient(135deg, #047857 0%, #059669 100%);
        color: white;
        padding: 2rem;
        border-bottom: 3px solid #065f46;
    }
    
    .settings-header h1 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 600;
    }
    
    .settings-header p {
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
        font-size: 0.95rem;
    }
    
    .settings-body {
        padding: 2.5rem;
    }
    
    .form-group {
        margin-bottom: 2rem;
    }
    
    .form-group label {
        display: block;
        font-weight: 600;
        color: #047857;
        margin-bottom: 0.6rem;
        font-size: 1rem;
    }
    
    .form-control {
        width: 100%;
        padding: 0.85rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        font-family: inherit;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }
    
    .form-control.is-invalid {
        border-color: #dc2626;
    }
    
    .invalid-feedback {
        color: #dc2626;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: block;
    }
    
    .form-text {
        color: #6b7280;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: block;
    }
    
    .image-preview {
        margin-top: 1rem;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 8px;
        text-align: center;
    }
    
    .image-preview img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .form-actions {
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 2px solid #f3f4f6;
        display: flex;
        gap: 1rem;
    }
    
    .btn {
        padding: 0.85rem 2rem;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #047857 0%, #059669 100%);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(5, 150, 105, 0.3);
    }
    
    .btn-secondary {
        background: #6b7280;
        color: white;
    }
    
    .btn-secondary:hover {
        background: #4b5563;
        transform: translateY(-2px);
    }
    
    .alert {
        padding: 1rem 1.5rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 500;
    }
    
    .alert-success {
        background: #d1fae5;
        color: #047857;
        border-left: 4px solid #059669;
    }
    
    .alert-success::before {
        content: "✓";
        background: #059669;
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
</style>

<div class="settings-page">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="settings-card">
        <div class="settings-header">
            <h1>📜 Pengaturan Tentang Kami</h1>
            <p>Kelola informasi tentang BumKal yang ditampilkan di halaman depan</p>
        </div>
        
        <div class="settings-body">
            <form action="{{ route('admin.settings.tentang-kami.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="title">📌 Judul Section</label>
                    <input type="text"
                           name="title"
                           id="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', App\Models\Setting::get('tentang_kami_title', 'Tentang BumKal Kami')) }}"
                           required
                           placeholder="Contoh: Tentang BumKal Kami">
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">📝 Deskripsi</label>
                    <textarea name="description"
                              id="description"
                              rows="8"
                              class="form-control @error('description') is-invalid @enderror"
                              required
                              placeholder="Ceritakan tentang agrowisata Anda...">{{ old('description', App\Models\Setting::get('tentang_kami_description', 'Agrowisata Dadi Raharja Bumkal Margodadi adalah wisata yang didirikan dengan memanfaatkan lahan milik Bumi Kalurahan (Bumkal) dan menggali potensi sumber daya di sekitar.')) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <small class="form-text">Jelaskan dengan detail tentang sejarah, visi, dan misi agrowisata</small>
                </div>

                <div class="form-group">
                    <label for="image">🖼️ Gambar Ilustrasi</label>
                    @if(App\Models\Setting::get('tentang_kami_image'))
                        <div class="image-preview">
                            <img src="{{ asset('storage/' . App\Models\Setting::get('tentang_kami_image')) }}"
                                 alt="Tentang Kami">
                            <p style="margin-top: 0.75rem; color: #6b7280; font-size: 0.875rem;">Gambar saat ini</p>
                        </div>
                    @endif
                    <input type="file"
                           name="image"
                           id="image"
                           class="form-control @error('image') is-invalid @enderror"
                           accept="image/*"
                           style="margin-top: 1rem;">
                    <small class="form-text">📏 Ukuran maksimal: 2MB • Format: JPG, PNG, GIF • Resolusi rekomendasi: 1200x600px</small>
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <span>💾</span> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                        <span>✕</span> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection