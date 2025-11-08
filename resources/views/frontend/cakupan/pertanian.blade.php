@extends('layouts.frontend')

@section('title', 'Pertanian & Perkebunan - Gugur Gunung')

@section('content')
<!-- 🔹 TOMBOL KEMBALI -->
<div class="back-btn-container">
    <a href="{{ route('home') }}" class="back-btn">← Kembali ke Beranda</a>
</div>

<section>
    <h2 style="text-align: center; margin-bottom: 2rem;">Pertanian & Perkebunan</h2>
    
    <img src="{{ asset('assets/images/pertanian.jpg') }}" alt="Pertanian" class="cakupan-img">
    
    <p style="text-align: justify; max-width: 800px; margin: 0 auto 3rem; line-height: 1.8; color: #555;">
        Bidang Pertanian dan Perkebunan merupakan salah satu sector yang ada di
        Bumkal Dadi Raharja. Kawasan ini mengembangkan berbagai komoditas unggulan
        sebagai bagian dari program ketahanan pangan pemerintah, yang menjadi hasil
        pertanian khas masyarakat setempat. Melalui konsep eduwisata, pengunjung
        dapat belajar langsung tentang proses budidaya tanaman, sekaligus suasana
        alam pedesaan yang asri dan produktif.
    </p>
    
    @if($pertanianData->count() > 0)
        <h3 style="text-align: center; color: #2d6a4f; margin-bottom: 2rem;">Yang Dapat Anda Nikmati</h3>
        <h2 style="text-align: center; color: #2d6a4f; font-size: 2.5rem; margin-bottom: 3rem;">Fasilitas Kami</h2>
        
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; max-width: 1400px; margin: 0 auto; padding: 0 2rem;">
            @foreach($pertanianData as $item)
                <div class="facility-card">
                    @if($item->gambar)
                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}">
                    @endif
                    <div style="padding: 1.5rem;">
                        <h3 style="color: #2d6a4f; margin-bottom: 1rem;">{{ $item->judul }}</h3>
                        <p style="color: #666; line-height: 1.6; text-align: justify;">{{ $item->deskripsi }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 4rem 2rem; background: #f0f9ff; border-radius: 15px; max-width: 600px; margin: 0 auto;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">🌱</div>
            <h3 style="color: #047857; font-size: 1.5rem; margin-bottom: 1rem;">Fasilitas Akan Segera Hadir</h3>
            <p style="color: #6b7280; font-size: 1.1rem; line-height: 1.6;">
                Kami sedang mempersiapkan berbagai layanan yang menarik untuk Anda. 
                Nantikan kehadirannya segera!
            </p>
        </div>
    @endif
</section>

@push('styles')
<style>
.facility-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
}

.facility-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.facility-card img {
    width: 100%;
    height: 250px;
    object-fit: contain;
    object-position: center;
    border-radius: 10px 10px 0 0;
    display: block;
    background: #f8f9fa;
}

@media (max-width: 1024px) {
    section > div {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}

@media (max-width: 768px) {
    section > div {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endpush
@endsection
