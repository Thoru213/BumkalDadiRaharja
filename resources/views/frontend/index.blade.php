@extends('layouts.frontend')

@section('title', 'BUMKAL Dadi Raharja - Beranda')

@section('content')
<!-- 🔹 HERO SECTION -->
<section class="hero">
    <div class="hero-container">
        <!-- Left: YouTube Video -->
        <div class="hero-video">
            <iframe 
                src="https://www.youtube.com/embed/D9vsEqrsZxU?si=382Y8TfUOubfdUE4" 
                title="YouTube video player" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowfullscreen>
            </iframe>
        </div>
        
        <!-- Right: Hero Content -->
        <div class="hero-content">
            <h1>Rasakan Serunya Berkemah di Tengah Perkebunan</h1>
            <p>Jelajahi pengalaman agrowisata terbaik yang menggabungkan pesona bumi perkemahan dengan keasrian perkebunan. Nikmati udara segar, keindahan alam, serta aktivitas edukatif dan rekreasi untuk keluarga dan teman.</p>
        </div>
    </div>
</section>

<!-- 🔹 TENTANG KAMI -->
<section id="tentang" class="tentang">
    <p style="color: #666; font-size: 1rem; margin-bottom: 0.5rem; text-align: center;">Mengenal Lebih Dekat</p>
    <h2 style="color: #047857; text-align: center; margin-bottom: 3rem;">{{ App\Models\Setting::get('tentang_kami_title', 'Tentang Agrowisata Kami') }}</h2>
    
    <div style="display: flex; gap: 3rem; align-items: flex-start; max-width: 1200px; margin: 0 auto;">
        @if(App\Models\Setting::get('tentang_kami_image'))
            <div style="flex: 0 0 45%; min-width: 0; position: relative; overflow: hidden; border-radius: 15px;">
                {{-- Tiny blurred placeholder (loads instantly) --}}
                @if(App\Models\Setting::get('tentang_kami_image_thumb'))
                <img src="{{ asset('storage/' . App\Models\Setting::get('tentang_kami_image_thumb')) }}" 
                     alt="Tentang Kami" 
                     class="tentang-image-placeholder"
                     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; filter: blur(20px); transform: scale(1.1); z-index: 1;">
                @endif
                
                {{-- Full optimized image (lazy loaded) --}}
                <img src="{{ asset('storage/' . App\Models\Setting::get('tentang_kami_image')) }}"
                     data-src="{{ asset('storage/' . App\Models\Setting::get('tentang_kami_image')) }}"
                     alt="Tentang Kami"
                     class="tentang-image-full lazy-load"
                     loading="lazy"
                     style="position: relative; width: 100%; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); transition: opacity 0.6s ease; z-index: 2;">
            </div>
        @endif
        
        <div style="flex: 1; min-width: 0;">
            <p style="font-size: 1.1rem; line-height: 1.8; color: #4b5563; text-align: justify;">
                {!! nl2br(e(App\Models\Setting::get('tentang_kami_description', 'Agrowisata Dadi Raharja Bumkal Margodadi adalah wisata yang didirikan dengan memanfaatkan lahan milik Bumi Kalurahan (Bumkal) dan menggali potensi sumber daya di sekitar. Agrowisata ini berfokus pada 3 bidang yakni Agrowisata, Usaha Mikro Kecil dan Menengah (UMKM), serta Perkebunan, Pertanian, Perikanan, dan lain-lain.'))) !!}
            </p>
        </div>
    </div>
</section>

<!-- 🔹 CAKUPAN -->
<section id="cakupan" class="cakupan">
    <p style="color: #666; font-size: 1rem; margin-bottom: 0.5rem;">Yang Dapat Anda Nikmati</p>
    <h2 style="color: #047857;">Fasilitas Kami</h2>
    <div class="cakupan-container">
        <a href="{{ route('cakupan.show', 'pertanian') }}" class="cakupan-item">
            <img src="{{ asset('assets/images/pertanian.jpg') }}" alt="Pertanian" class="cakupan-item-img">
            <h3>Pertanian, Perkebunan, Peternakan & Perikanan</h3>
            <p>Pelajari lebih lanjut mengenai pengelolaan sumber daya alam dan pertanian lokal kami.</p>
        </a>
        <a href="{{ route('cakupan.show', 'pariwisata') }}" class="cakupan-item">
            <img src="{{ asset('assets/images/pariwisata.jpg') }}" alt="Pariwisata" class="cakupan-item-img">
            <h3>Pariwisata</h3>
            <p>Jelajahi destinasi wisata alam dan budaya unggulan daerah kami.</p>
        </a>
        <a href="{{ route('cakupan.show', 'umkm') }}" class="cakupan-item">
            <img src="{{ asset('assets/images/umkm.jpg') }}" alt="UMKM" class="cakupan-item-img">
            <h3>UMKM</h3>
            <p>Dukung produk dan inovasi UMKM masyarakat lokal.</p>
        </a>
    </div>
</section>

<!-- 🔹 GALERI -->
<section id="galeri" class="galeri">
    <p style="color: #666; font-size: 1rem; margin-bottom: 0.5rem;">Galeri Foto</p>
    <h2 style="color: #047857;">Keindahan Agrowisata Kami</h2>
    <div class="galeri-grid">
        {{-- Pertanian Images --}}
        @foreach($pertanianData as $item)
            <div class="galeri-item" style="position: relative; overflow: hidden; border-radius: 10px;">
                <img src="{{ asset($item->gambar) }}"
                     alt="{{ $item->judul }}"
                     class="galeri-img"
                     loading="lazy"
                     style="width: 100%; height: 100%; object-fit: cover;">
                <div class="galeri-caption">{{ $item->judul }}</div>
            </div>
        @endforeach
        
        {{-- Pariwisata Images --}}
        @foreach($pariwisataData as $item)
            <div class="galeri-item" style="position: relative; overflow: hidden; border-radius: 10px;">
                <img src="{{ asset($item->gambar) }}"
                     alt="{{ $item->judul }}"
                     class="galeri-img"
                     loading="lazy"
                     style="width: 100%; height: 100%; object-fit: cover;">
                <div class="galeri-caption">{{ $item->judul }}</div>
            </div>
        @endforeach
        
        {{-- UMKM Images --}}
        @foreach($umkmData as $item)
            <div class="galeri-item" style="position: relative; overflow: hidden; border-radius: 10px;">
                <img src="{{ asset($item->gambar) }}"
                     alt="{{ $item->judul }}"
                     class="galeri-img"
                     loading="lazy"
                     style="width: 100%; height: 100%; object-fit: cover;">
                <div class="galeri-caption">{{ $item->judul }}</div>
            </div>
        @endforeach
        
        {{-- Gallery Images with Blur-up Effect --}}
        @foreach($galeriData as $item)
            <div class="galeri-item" style="position: relative; overflow: hidden; border-radius: 10px;">
                {{-- Tiny blurred placeholder --}}
                @if($item->gambar_thumb)
                <img src="{{ asset('storage/' . $item->gambar_thumb) }}"
                     alt="{{ $item->judul }}"
                     style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; filter: blur(20px); transform: scale(1.1); z-index: 1;">
                @endif
                
                {{-- Full image with lazy loading --}}
                <img data-src="{{ asset('storage/' . $item->gambar) }}"
                     alt="{{ $item->judul }}"
                     class="lazy-load galeri-img"
                     loading="lazy"
                     style="position: relative; width: 100%; height: 100%; object-fit: cover; opacity: 0; transition: opacity 0.6s ease; z-index: 2;">
                <div class="galeri-caption">{{ $item->judul }}</div>
            </div>
        @endforeach
        
        @if($pertanianData->count() == 0 && $pariwisataData->count() == 0 && $umkmData->count() == 0 && $galeriData->count() == 0)
            <div style="grid-column: 1/-1; text-align: center; padding: 3rem; color: #6b7280;">
                <p style="font-size: 1.2rem;">📷 Belum ada foto di galeri</p>
            </div>
        @endif
    </div>
</section>

<!-- 🔹 KONTAK -->
<section id="kontak" class="kontak">
    <p style="color: #666; font-size: 1rem; margin-bottom: 0.5rem; text-align: center;">Ada Pertanyaan?</p>
    <h2 style="text-align: center; margin-bottom: 1rem; color: #047857;">Hubungi Kami</h2>
    <p style="text-align: center; color: #666; margin-bottom: 3rem;">
        Jika Anda memiliki pertanyaan atau ingin informasi lebih lanjut tentang agrowisata kami, jangan ragu untuk menghubungi kami.
    </p>
    
    <div class="kontak-container">
        <!-- Left: Google Maps -->
        <div class="kontak-map">
            {!! App\Models\Setting::get('kontak_maps_embed', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.5!2d107.123!3d-6.789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNDcnMjAuNCJTIDEwN8KwMDcnMjIuOCJF!5e0!3m2!1sen!2sid!4v1234567890" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" title="Lokasi Agrowisata"></iframe>') !!}
        </div>        <!-- Right: Contact Info -->
        <div class="kontak-info">
            <div class="kontak-item">
                <div class="kontak-icon">📍</div>
                <div>
                    <h3>Alamat</h3>
                    <p>{{ App\Models\Setting::get('kontak_address', 'Kel. Margodadi, Kec. Seyegan, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55561') }}</p>
                </div>
            </div>
            
            <div class="kontak-item">
                <div class="kontak-icon">📞</div>
                <div>
                    <h3>Telepon</h3>
                    <p>{{ App\Models\Setting::get('kontak_phone', '+62 123 4567 890') }}</p>
                </div>
            </div>
            
            <div class="kontak-item">
                <div class="kontak-icon">✉️</div>
                <div>
                    <h3>Email</h3>
                    <p>{{ App\Models\Setting::get('kontak_email', 'info@agrowisata.com') }}</p>
                </div>
            </div>
            
            <div class="kontak-item">
                <div class="kontak-icon">🕐</div>
                <div>
                    <h3>Jam Operasional</h3>
                    <p>Senin - Minggu: 08.00 - 17.00</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Lazy load images with blur-up effect
document.addEventListener('DOMContentLoaded', function() {
    const lazyImages = document.querySelectorAll('.lazy-load');
    
    // Check if browser supports IntersectionObserver
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.addEventListener('load', function() {
                        img.style.opacity = '1';
                    });
                    observer.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px' // Start loading 50px before image enters viewport
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    } else {
        // Fallback for older browsers
        lazyImages.forEach(img => {
            img.src = img.dataset.src;
            img.style.opacity = '1';
        });
    }
});
</script>
@endpush
