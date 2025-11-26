@extends('admin.layout')

@section('title', 'Kontak - Settings')

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
    
    .section-divider {
        margin: 2.5rem 0 2rem 0;
        padding-top: 2rem;
        border-top: 2px solid #f3f4f6;
    }
    
    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #047857;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
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
    
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
        font-family: 'Courier New', monospace;
        font-size: 0.85rem;
        line-height: 1.5;
    }
    
    textarea#maps_embed {
        background-color: #f9fafb;
        color: #1f2937;
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
            <h1>📍 Pengaturan Kontak</h1>
            <p>Kelola informasi kontak yang ditampilkan di halaman depan</p>
        </div>
        
        <div class="settings-body">
            <form action="{{ route('admin.settings.kontak.update') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="phone">📞 Nomor Telepon</label>
                    <input type="text"
                           name="phone"
                           id="phone"
                           class="form-control @error('phone') is-invalid @enderror"
                           value="{{ old('phone', App\Models\Setting::get('kontak_phone', '+62 123 4567 890')) }}"
                           required
                           placeholder="+62 812 3456 7890">
                    @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <small class="form-text">Format: +62 untuk Indonesia, atau 0812-xxxx-xxxx</small>
                </div>

                <div class="form-group">
                    <label for="phone_name">👤 Nama Pemilik Nomor</label>
                    <input type="text"
                           name="phone_name"
                           id="phone_name"
                           class="form-control @error('phone_name') is-invalid @enderror"
                           value="{{ old('phone_name', App\Models\Setting::get('kontak_phone_name', '')) }}"
                           placeholder="Contoh: Pak Budi, Customer Service, dll">
                    @error('phone_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <small class="form-text">Nama ini akan ditampilkan dalam kurung di sebelah nomor telepon. Kosongkan jika tidak perlu</small>
                </div>

                <div class="form-group">
                    <label for="email">✉️ Email</label>
                    <input type="email"
                           name="email"
                           id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', App\Models\Setting::get('kontak_email', 'info@agrowisata.com')) }}"
                           required
                           placeholder="info@agrowisata.com">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <small class="form-text">Email resmi untuk dihubungi pengunjung</small>
                </div>

                <div class="form-group">
                    <label for="address">📍 Alamat Lengkap</label>
                    <textarea name="address"
                              id="address"
                              rows="4"
                              class="form-control @error('address') is-invalid @enderror"
                              required
                              placeholder="Jalan..., Kelurahan..., Kecamatan..., Kabupaten...">{{ old('address', App\Models\Setting::get('kontak_address', 'Kel. Margodadi, Kec. Seyegan, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55561')) }}</textarea>
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <small class="form-text">Tulis alamat lengkap termasuk kode pos</small>
                </div>

                <div class="form-group">
                    <label for="maps_embed">🗺️ Google Maps Embed Code</label>
                    <textarea name="maps_embed"
                              id="maps_embed"
                              rows="5"
                              class="form-control @error('maps_embed') is-invalid @enderror"
                              placeholder='<iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'>{{ old('maps_embed', App\Models\Setting::get('kontak_maps_embed', '')) }}</textarea>
                    <small class="form-text">
                        💡 <strong>Cara mendapatkan:</strong><br>
                        1. Buka <a href="https://www.google.com/maps" target="_blank" style="color: #047857; font-weight: 600;">Google Maps</a><br>
                        2. Cari lokasi Anda<br>
                        3. Klik <strong>Share</strong> → Pilih <strong>Embed a map</strong><br>
                        4. Klik <strong>Copy HTML</strong><br>
                        5. Paste kode HTML lengkap di sini (termasuk tag &lt;iframe&gt;)
                    </small>
                    @error('maps_embed')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="section-divider">
                    <h4 class="section-title">🌐 Media Sosial (Opsional)</h4>
                </div>

                <div class="form-group">
                    <label for="facebook">📘 Facebook</label>
                    <input type="url"
                           name="facebook"
                           id="facebook"
                           class="form-control @error('facebook') is-invalid @enderror"
                           value="{{ old('facebook', App\Models\Setting::get('kontak_facebook', '')) }}"
                           placeholder="https://facebook.com/agrowisata">
                    @error('facebook')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <small class="form-text">URL lengkap halaman Facebook (kosongkan jika tidak ada)</small>
                </div>

                <div class="form-group">
                    <label for="instagram">📸 Instagram</label>
                    <input type="url"
                           name="instagram"
                           id="instagram"
                           class="form-control @error('instagram') is-invalid @enderror"
                           value="{{ old('instagram', App\Models\Setting::get('kontak_instagram', '')) }}"
                           placeholder="https://instagram.com/agrowisata">
                    @error('instagram')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <small class="form-text">URL lengkap profil Instagram (kosongkan jika tidak ada)</small>
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
