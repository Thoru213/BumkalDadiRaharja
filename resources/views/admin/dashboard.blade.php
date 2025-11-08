@extends('admin.layout')

@section('content')
    <div style="margin-bottom: 20px;">
        <h1>Dashboard Admin</h1>
        <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>
    </div>

    <div class="stat-box">
        <div class="card" style="position: relative; cursor: pointer;">
            <h3>Total Fasilitas</h3>
            <p style="font-size: 32px; font-weight: bold; color: #2e7d32;">
                {{ $stats['pertanian'] + $stats['pariwisata'] + $stats['umkm'] }}
            </p>
            <div class="facility-tooltip">
                <div style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                    <strong>Pertanian:</strong> {{ $stats['pertanian'] }}
                </div>
                <div style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                    <strong>Pariwisata:</strong> {{ $stats['pariwisata'] }}
                </div>
                <div style="padding: 0.5rem 0;">
                    <strong>UMKM:</strong> {{ $stats['umkm'] }}
                </div>
            </div>
        </div>
        
        <div class="card" style="position: relative; cursor: pointer;">
            <h3>Total Gambar</h3>
            <p style="font-size: 32px; font-weight: bold; color: #2e7d32;">
                {{ $stats['total_gambar'] }}
            </p>
            <div class="facility-tooltip">
                <div style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                    <strong>Pertanian:</strong> {{ $stats['pertanian'] }} gambar
                </div>
                <div style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                    <strong>Pariwisata:</strong> {{ $stats['pariwisata'] }} gambar
                </div>
                <div style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                    <strong>UMKM:</strong> {{ $stats['umkm'] }} gambar
                </div>
                <div style="padding: 0.5rem 0;">
                    <strong>Galeri:</strong> {{ $stats['galeri'] }} gambar
                </div>
            </div>
        </div>
        
        <div class="card" style="position: relative; cursor: pointer;">
            <h3>Total Users</h3>
            <p style="font-size: 32px; font-weight: bold; color: #2e7d32;">
                {{ \App\Models\User::count() ?? 0 }}
            </p>
            <div class="facility-tooltip">
                <div style="padding: 0.5rem 0; border-bottom: 1px solid #e0e0e0;">
                    <strong>Admin:</strong> {{ \App\Models\User::where('role', 'admin')->count() }}
                </div>
                <div style="padding: 0.5rem 0;">
                    <strong>Regular:</strong> {{ \App\Models\User::where('role', '!=', 'admin')->orWhereNull('role')->count() }}
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 30px;">
        <!-- <h2>Informasi Sistem</h2>
        <p>Email: {{ Auth::user()->email }}</p>
        <p>Role: <span style="background: #2e7d32; color: white; padding: 4px 8px; border-radius: 3px;">{{ Auth::user()->role }}</span></p> -->
    </div>
@endsection
