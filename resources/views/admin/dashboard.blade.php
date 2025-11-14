@extends('admin.layout')

@section('content')
    <div style="margin-bottom: 30px;">
        <h1 style="font-size: 32px; color: #2e7d32; margin-bottom: 10px;">Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</h1>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 30px; margin-bottom: 30px;">
        <!-- Total Fasilitas Chart -->
        <div class="card" style="padding: 30px;">
            <h3 style="margin-bottom: 20px; text-align: center; color: #2e7d32;">Total Fasilitas</h3>
            <div style="text-align: center; margin-bottom: 15px;">
                <p style="font-size: 28px; font-weight: bold; color: #2e7d32;">
                    {{ $stats['pertanian'] + $stats['pariwisata'] + $stats['umkm'] }}
                </p>
            </div>
            <div style="max-width: 300px; margin: 0 auto;">
                <canvas id="fasilitasChart"></canvas>
            </div>
            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e0e0e0;">
                <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                    <span><span style="display: inline-block; width: 12px; height: 12px; background: #4CAF50; border-radius: 50%; margin-right: 8px;"></span>Pertanian, Perkebunan, Peternakan & Perikanan:</span>
                    <strong>{{ $stats['pertanian'] }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                    <span><span style="display: inline-block; width: 12px; height: 12px; background: #2196F3; border-radius: 50%; margin-right: 8px;"></span>Pariwisata:</span>
                    <strong>{{ $stats['pariwisata'] }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                    <span><span style="display: inline-block; width: 12px; height: 12px; background: #FF9800; border-radius: 50%; margin-right: 8px;"></span>UMKM:</span>
                    <strong>{{ $stats['umkm'] }}</strong>
                </div>
            </div>
        </div>
        
        <!-- Total Gambar Chart -->
        <div class="card" style="padding: 30px;">
            <h3 style="margin-bottom: 20px; text-align: center; color: #2e7d32;">Total Gambar</h3>
            <div style="text-align: center; margin-bottom: 15px;">
                <p style="font-size: 28px; font-weight: bold; color: #2e7d32;">
                    {{ $stats['total_gambar'] }}
                </p>
            </div>
            <div style="max-width: 300px; margin: 0 auto;">
                <canvas id="gambarChart"></canvas>
            </div>
            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e0e0e0;">
                <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                    <span><span style="display: inline-block; width: 12px; height: 12px; background: #4CAF50; border-radius: 50%; margin-right: 8px;"></span>Pertanian, Perkebunan, Peternakan & Perikanan:</span>
                    <strong>{{ $stats['pertanian'] }} gambar</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                    <span><span style="display: inline-block; width: 12px; height: 12px; background: #2196F3; border-radius: 50%; margin-right: 8px;"></span>Pariwisata:</span>
                    <strong>{{ $stats['pariwisata'] }} gambar</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                    <span><span style="display: inline-block; width: 12px; height: 12px; background: #FF9800; border-radius: 50%; margin-right: 8px;"></span>UMKM:</span>
                    <strong>{{ $stats['umkm'] }} gambar</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                    <span><span style="display: inline-block; width: 12px; height: 12px; background: #9C27B0; border-radius: 50%; margin-right: 8px;"></span>Galeri:</span>
                    <strong>{{ $stats['galeri'] }} gambar</strong>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // @ts-nocheck
    /* eslint-disable */
    document.addEventListener('DOMContentLoaded', function() {
        // Data from server
        const fasilitasData = {
            pertanian: {{ $stats['pertanian'] ?? 0 }},
            pariwisata: {{ $stats['pariwisata'] ?? 0 }},
            umkm: {{ $stats['umkm'] ?? 0 }},
            galeri: {{ $stats['galeri'] ?? 0 }}
        };

        // Fasilitas Pie Chart
        const fasilitasCtx = document.getElementById('fasilitasChart');
        if (fasilitasCtx) {
            new Chart(fasilitasCtx.getContext('2d'), {
                type: 'pie',
                data: {
                    labels: ['Pertanian, Perkebunan, Peternakan & Perikanan', 'Pariwisata', 'UMKM'],
                    datasets: [{
                        data: [fasilitasData.pertanian, fasilitasData.pariwisata, fasilitasData.umkm],
                        backgroundColor: [
                            '#4CAF50',  // Green
                            '#2196F3',  // Blue
                            '#FF9800'   // Orange
                        ],
                        borderColor: '#ffffff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                                    label += ' (' + percentage + '%)';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }

        // Gambar Pie Chart
        const gambarCtx = document.getElementById('gambarChart');
        if (gambarCtx) {
            new Chart(gambarCtx.getContext('2d'), {
                type: 'pie',
                data: {
                    labels: ['Pertanian, Perkebunan, Peternakan & Perikanan', 'Pariwisata', 'UMKM', 'Galeri'],
                    datasets: [{
                        data: [fasilitasData.pertanian, fasilitasData.pariwisata, fasilitasData.umkm, fasilitasData.galeri],
                        backgroundColor: [
                            '#4CAF50',  // Green
                            '#2196F3',  // Blue
                            '#FF9800',  // Orange
                            '#9C27B0'   // Purple
                        ],
                        borderColor: '#ffffff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed + ' gambar';
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                                    label += ' (' + percentage + '%)';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
