@extends('layouts.frontend')

@section('title', 'UMKM - Gugur Gunung')

@section('content')
<div class="back-btn-container">
    <a href="{{ route('home') }}" class="back-btn">← Kembali ke Beranda</a>
</div>

<section>
    <h2 style="text-align: center; margin-bottom: 2rem;">UMKM</h2>
    
    <img src="{{ asset('assets/images/umkm.jpg') }}" alt="UMKM" class="cakupan-img">
    
    <p style="text-align: justify; max-width: 800px; margin: 0 auto 3rem; line-height: 1.8; color: #555;">
        Bidang UMKM di Bumkal Dadi Raharja Berfokus pada pengolahan hasil bumi
        dari sector pertanian dan perkebunan, serta kerja sama dengan pelaku
        usaha local di sekitar Kawasan. Kolaborasi ini bertujuan untuk
        meningkatkan nilai tambah produk pertanian dan memperkuat eknonomi
        masyarakat melalui inovasi dan pemasaran yang berkelanjutan. Kawasan ini
        juga telah menyiapkan layout tenant bagi UMKM setempat sebagai wadah
        kolaborasi dan promosi produk unggulan desa, sehingga dapat memperluas
        peluang usaha dan memberdayakan masyarakat secara langsung.
    </p>
    
    @if($umkmData->count() > 0)
        <h3 style="text-align: center; color: #2d6a4f; margin-bottom: 2rem;">Yang Dapat Anda Nikmati</h3>
        <h2 style="text-align: center; color: #2d6a4f; font-size: 2.5rem; margin-bottom: 3rem;">Fasilitas Kami</h2>
        
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; max-width: 1400px; margin: 0 auto; padding: 0 2rem;">
            @foreach($umkmData as $item)
                <div class="facility-card" data-modal="modal{{ $loop->index }}" style="cursor: pointer;">
                    @if($item->gambar)
                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" class="facility-card-img">
                    @endif
                    <div class="facility-card-overlay">
                        <h3 class="facility-card-title">{{ $item->judul }}</h3>
                        <div class="facility-card-arrow">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M7 17L17 7M17 7H7M17 7V17"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div id="modal{{ $loop->index }}" class="facility-modal">
                    <div class="modal-content">
                        <span class="modal-close">&times;</span>
                        @if($item->gambar)
                            <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 10px; margin-bottom: 1.5rem;">
                        @endif
                        <h2 style="color: #2d6a4f; margin-bottom: 1rem;">{{ $item->judul }}</h2>
                        @if($item->deskripsi)
                            <p style="color: #374151; line-height: 1.8; text-align: justify; font-size: 1rem;">{{ $item->deskripsi }}</p>
                        @else
                            <p style="color: #9ca3af; font-style: italic;">Deskripsi belum tersedia</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 4rem 2rem; background: #f0f9ff; border-radius: 15px; max-width: 600px; margin: 0 auto;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">🧺</div>
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
    border-radius: 15px;
    overflow: hidden;
    position: relative;
    height: 350px;
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.facility-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.2);
}

.facility-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.facility-card:hover .facility-card-img {
    transform: scale(1.1);
}

.facility-card-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 70%, transparent 100%);
    padding: 2rem 1.5rem 1.5rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.facility-card:hover .facility-card-overlay {
    background: linear-gradient(to top, rgba(4, 120, 87, 0.95) 0%, rgba(4, 120, 87, 0.7) 70%, transparent 100%);
}

.facility-card-title {
    color: white;
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    transition: transform 0.3s ease;
}

.facility-card:hover .facility-card-title {
    transform: translateY(-5px);
}

.facility-card-arrow {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 1;
    transform: translate(0, 0) rotate(0deg);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

.facility-card:hover .facility-card-arrow {
    background: rgba(255, 255, 255, 1);
    transform: translate(5px, -5px) rotate(0deg);
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
}

.facility-card-arrow svg {
    color: #047857;
}

.facility-modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    animation: fadeIn 0.3s ease;
}

.facility-modal.active {
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: white;
    padding: 2.5rem;
    border-radius: 15px;
    max-width: 700px;
    width: 90%;
    max-height: 85vh;
    overflow-y: auto;
    position: relative;
    animation: slideUp 0.3s ease;
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
}

.modal-close {
    position: absolute;
    right: 1.5rem;
    top: 1.5rem;
    font-size: 2rem;
    font-weight: bold;
    color: #6b7280;
    cursor: pointer;
    transition: color 0.2s ease;
    line-height: 1;
}

.modal-close:hover {
    color: #047857;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
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

@push('scripts')
<script>
document.addEventListener('click', function(e) {
    const card = e.target.closest('.facility-card');
    if (card) {
        const modalId = card.getAttribute('data-modal');
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    if (e.target.classList.contains('modal-close') || e.target.classList.contains('facility-modal')) {
        const modal = e.target.closest('.facility-modal');
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }

    if (e.target.closest('.modal-content') && !e.target.classList.contains('modal-close')) {
        e.stopPropagation();
    }
});

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('.facility-modal.active');
        modals.forEach(modal => {
            modal.classList.remove('active');
        });
        document.body.style.overflow = 'auto';
    }
});
</script>
@endpush
@endsection
