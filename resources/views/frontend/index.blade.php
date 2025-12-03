@extends('layouts.frontend')

@section('title', 'BUMKAL Dadi Raharja - Beranda')

@section('content')
<!-- 🔹 HERO SECTION -->
<section class="hero">
    <div class="hero-container">
        <!-- Left: YouTube Video -->
        <div class="hero-video fade-in-up">
            <iframe 
                src="https://www.youtube.com/embed/Q6fF-Dn8Nos?si=tlY-8OsOK5YQUU85" 
                title="YouTube video player" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowfullscreen>
            </iframe>
        </div>
        
        <!-- Right: Hero Content -->
        <div class="hero-content fade-in-up">
            <h1>Rasakan Serunya Belajar dan Berkemah di Tengah Perkebunan</h1>
            <p>Jelajahi pengalaman agrowisata terbaik yang menggabungkan pesona bumi perkemahan dengan keasrian perkebunan. Nikmati udara segar, keindahan alam, serta aktivitas edukatif dan rekreasi untuk keluarga dan teman.</p>
        </div>
    </div>
</section>

<!-- 🔹 TENTANG KAMI -->
<section id="tentang" class="tentang">
    <!-- <p style="color: #666; font-size: 1rem; margin-bottom: 0.5rem; text-align: center;">Mengenal Lebih Dekat</p> -->
    <h2 class="fade-in-up" style="color: #047857; text-align: center; margin-bottom: 3rem;">{{ App\Models\Setting::get('tentang_kami_title', 'Tentang Agrowisata Kami') }}</h2>
    
    <div style="display: flex; gap: 3rem; align-items: flex-start; max-width: 1200px; margin: 0 auto;">
        @if(App\Models\Setting::get('tentang_kami_image'))
            <div class="fade-in-up" style="flex: 0 0 45%; min-width: 0; position: relative; overflow: hidden; border-radius: 15px;">
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
        
        <div class="fade-in-up" style="flex: 1; min-width: 0;">
            <p style="font-size: 1.1rem; line-height: 1.8; color: #4b5563; text-align: justify;">
                {!! nl2br(e(App\Models\Setting::get('tentang_kami_description', 'Agrowisata Dadi Raharja Bumkal Margodadi adalah wisata yang didirikan dengan memanfaatkan lahan milik Bumi Kalurahan (Bumkal) dan menggali potensi sumber daya di sekitar. Agrowisata ini berfokus pada 3 bidang yakni Agrowisata, Usaha Mikro Kecil dan Menengah (UMKM), serta Perkebunan, Pertanian, Perikanan, dan lain-lain.'))) !!}
            </p>
        </div>
    </div>
</section>

<!-- 🔹 CAKUPAN -->
<section id="cakupan" class="cakupan">
    <h2 class="fade-in-up" style="color: #047857; text-align: center; margin-bottom: 3rem;">Bidang Unggulan Kami</h2>
    <div class="cakupan-cards">
        <a href="{{ route('cakupan.show', 'pertanian') }}" class="facility-card fade-in-up">
            <img src="{{ asset('assets/images/pertanian.jpg') }}" alt="Pertanian" class="facility-card-img">
            <div class="facility-card-overlay">
                <h3 class="facility-card-title">Pertanian, Perkebunan, Peternakan & Perikanan</h3>
                <p class="facility-card-subtitle">Sumber Daya Alam Lokal</p>
                <div class="facility-card-arrow">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M7 17L17 7M17 7H7M17 7V17"/>
                    </svg>
                </div>
            </div>
        </a>
        
        <a href="{{ route('cakupan.show', 'pariwisata') }}" class="facility-card fade-in-up">
            <img src="{{ asset('assets/images/pariwisata.jpg') }}" alt="Pariwisata" class="facility-card-img">
            <div class="facility-card-overlay">
                <h3 class="facility-card-title">Pariwisata</h3>
                <p class="facility-card-subtitle">Wisata dan Edukasi Alam</p>
                <div class="facility-card-arrow">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M7 17L17 7M17 7H7M17 7V17"/>
                    </svg>
                </div>
            </div>
        </a>
        
        <a href="{{ route('cakupan.show', 'umkm') }}" class="facility-card fade-in-up">
            <img src="{{ asset('assets/images/umkm.jpg') }}" alt="UMKM" class="facility-card-img">
            <div class="facility-card-overlay">
                <h3 class="facility-card-title">UMKM</h3>
                <p class="facility-card-subtitle">Produk dan Inovasi Lokal</p>
                <div class="facility-card-arrow">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M7 17L17 7M17 7H7M17 7V17"/>
                    </svg>
                </div>
            </div>
        </a>
    </div>
</section>

<!-- 🔹 GALERI -->
<section id="galeri" class="galeri">
    <!-- <p style="color: #666; font-size: 1rem; margin-bottom: 0.5rem;">Galeri Foto</p> -->
    <h2 class="fade-in-up" style="color: #047857;">Keindahan BumKal Kami</h2>
    <div class="galeri-grid" id="galeriGrid">
        {{-- Pertanian Images --}}
        @foreach($pertanianData as $item)
            <div class="galeri-item fade-in-up" style="position: relative; overflow: hidden; border-radius: 10px;">
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
            <div class="galeri-item fade-in-up" style="position: relative; overflow: hidden; border-radius: 10px;">
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
            <div class="galeri-item fade-in-up" style="position: relative; overflow: hidden; border-radius: 10px;">
                <img src="{{ asset($item->gambar) }}"
                    alt="{{ $item->judul }}"
                    class="galeri-img"
                    loading="lazy"
                    style="width: 100%; height: 100%; object-fit: cover;">
                <div class="galeri-caption">{{ $item->judul }}</div>
            </div>
        @endforeach
        
        {{-- Gallery Images --}}
        @foreach($galeriData as $item)
            <div class="galeri-item fade-in-up" style="position: relative; overflow: hidden; border-radius: 10px;">
                <img src="{{ asset($item->gambar) }}"
                    alt="{{ $item->judul }}"
                    class="galeri-img"
                    loading="lazy"
                    style="width: 100%; height: 100%; object-fit: cover;">
                <div class="galeri-caption">{{ $item->judul }}</div>
            </div>
        @endforeach
        
        @if($pertanianData->count() == 0 && $pariwisataData->count() == 0 && $umkmData->count() == 0 && $galeriData->count() == 0)
            <div style="grid-column: 1/-1; text-align: center; padding: 3rem; color: #6b7280;">
                <p style="font-size: 1.2rem;">📷 Belum ada foto di galeri</p>
            </div>
        @endif
    </div>
    
    @if(($pertanianData->count() + $pariwisataData->count() + $umkmData->count() + $galeriData->count()) > 3)
        <div style="text-align: center; margin-top: 3rem;">
            <button id="viewMoreBtn" class="view-more-btn fade-in-up" onclick="toggleGallery()">
                <span id="btnText">Lihat Lebih Banyak</span>
                <svg id="btnIcon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left: 0.5rem; transition: transform 0.3s ease;">
                    <path d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
        </div>
    @endif
</section>

<!-- 🔹 KONTAK -->
<section id="kontak" class="kontak">
    <!-- <p class="fade-in-up" style="color: #666; font-size: 1rem; margin-bottom: 0.5rem; text-align: center;">Ada Pertanyaan?</p> -->
    <h2 class="fade-in-up" style="text-align: center; margin-bottom: 1rem; color: #047857;">Hubungi Kami</h2>
    <p class="fade-in-up" style="text-align: center; color: #666; margin-bottom: 3rem;">
        Jika Anda memiliki pertanyaan atau ingin informasi lebih lanjut tentang BumKal kami, jangan ragu untuk menghubungi kami.
    </p>
    
    <div class="kontak-container">
        <!-- Left: Google Maps -->
        <div class="kontak-map fade-in-up">
            {!! App\Models\Setting::get('kontak_maps_embed', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.5!2d107.123!3d-6.789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNDcnMjAuNCJTIDEwN8KwMDcnMjIuOCJF!5e0!3m2!1sen!2sid!4v1234567890" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" title="Lokasi Agrowisata"></iframe>') !!}
        </div>        <!-- Right: Contact Info -->
        <div class="kontak-info fade-in-up">
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
                    @php
                        $contactsJson = App\Models\Setting::get('kontak_contacts', '[]');
                        $contacts = json_decode($contactsJson, true);
                    @endphp
                    
                    @if($contacts && count($contacts) > 0)
                        @foreach($contacts as $contact)
                            @if(!empty($contact['phone']))
                                <p>
                                    {{ $contact['phone'] }}
                                    @if(!empty($contact['name']))
                                        <span style="color: #6b7280;">({{ $contact['name'] }})</span>
                                    @endif
                                </p>
                            @endif
                        @endforeach
                    @else
                        <p>{{ App\Models\Setting::get('kontak_phone', '+62 123 4567 890') }}</p>
                    @endif
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
// Toggle Gallery View More/Less
function toggleGallery() {
    const grid = document.getElementById('galeriGrid');
    const items = grid.querySelectorAll('.galeri-item');
    const btnText = document.getElementById('btnText');
    const btnIcon = document.getElementById('btnIcon');
    
    if (grid.classList.contains('collapsed')) {
        // Expand - show all items with smooth animation
        grid.classList.remove('collapsed');
        
        items.forEach((item, index) => {
            if (index >= 3) {
                // Set initial hidden state
                item.style.display = 'block';
                item.style.opacity = '0';
                item.style.transform = 'translateY(30px) scale(0.95)';
                
                // Animate in with staggered delay
                setTimeout(() => {
                    item.style.transition = 'opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1), transform 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0) scale(1)';
                }, (index - 3) * 80); // Stagger by 80ms
            }
        });
        
        btnText.textContent = 'Lihat Lebih Sedikit';
        btnIcon.style.transform = 'rotate(180deg)';
    } else {
        // Collapse - hide items after first 3 with smooth animation
        const itemsToHide = Array.from(items).slice(3);
        
        itemsToHide.reverse().forEach((item, index) => {
            setTimeout(() => {
                item.style.transition = 'opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1), transform 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                item.style.opacity = '0';
                item.style.transform = 'translateY(-15px) scale(0.98)';
            }, index * 40);
        });
        
        // Hide after all animations complete
        setTimeout(() => {
            itemsToHide.forEach(item => {
                item.style.display = 'none';
            });
        }, (itemsToHide.length * 40) + 500);
        
        grid.classList.add('collapsed');
        btnText.textContent = 'Lihat Lebih Banyak';
        btnIcon.style.transform = 'rotate(0deg)';
        
        // Scroll to gallery section after animation starts
        setTimeout(() => {
            document.getElementById('galeri').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 200);
    }
}

// Initialize gallery as collapsed if more than 3 items
document.addEventListener('DOMContentLoaded', function() {
    const grid = document.getElementById('galeriGrid');
    if (grid) {
        const items = grid.querySelectorAll('.galeri-item');
        if (items.length > 3) {
            grid.classList.add('collapsed');
            // Hide items after the first 3
            items.forEach((item, index) => {
                if (index >= 3) {
                    item.style.display = 'none';
                    item.style.opacity = '0';
                }
            });
        }
    }
});

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
