<footer>
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-logo">
                <span class="footer-label">BUMKAL</span>
                <h2 class="footer-title">Dadi Raharja</h2>
            </div>
            
            <p class="footer-description">
                {{ App\Models\Setting::get('tentang_kami_deskripsi', 'BUMKal Dadi Raharja lahir dari semangat masyarakat Kalurahan Margodadi, Kapanewon Seyegan, Kabupaten Sleman, untuk menciptakan kemandirian ekonomi berbasis potensi lokal. Kami hadir bukan sekadar sebagai lembaga ekonomi desa, melainkan sebagai penggerak perubahan sosial dan wisata edukatif berbasis alam yang menghubungkan nilai budaya, pertanian, dan kewirausahaan masyarakat.') }}
            </p>
            
            <div class="footer-social">
                @php
                    $instagramUrl = App\Models\Setting::get('kontak_instagram', '#');
                    $mapsUrl = 'https://maps.app.goo.gl/TKk9fFgrwFHNoTwu8';
                @endphp
                
                @if($instagramUrl && $instagramUrl !== '#')
                    <a href="{{ $instagramUrl }}" target="_blank" class="footer-icon" title="Instagram">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                @endif
                
                @if($mapsUrl && $mapsUrl !== '#')
                    <a href="{{ $mapsUrl }}" target="_blank" class="footer-icon" title="Google Maps">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>© {{ date('Y') }} BumKal Dadi Raharja. Hak Cipta Dilindungi.</p>
    </div>
</footer>
