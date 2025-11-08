@extends('admin.layout')

@section('content')
<div style="padding: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2>Data UMKM</h2>
        <a href="{{ route('admin.umkm.create') }}" style="background: #2d6a4f; color: white; padding: 0.7rem 1.5rem; text-decoration: none; border-radius: 5px;">+ Tambah Data</a>
    </div>

    @if(session('success'))
    <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
        {{ session('success') }}
    </div>
    @endif

    <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden;">
        <thead style="background: #2d6a4f; color: white;">
            <tr>
                <th style="padding: 1rem; text-align: left;">No</th>
                <th style="padding: 1rem; text-align: left;">Gambar</th>
                <th style="padding: 1rem; text-align: left;">Judul</th>
                <th style="padding: 1rem; text-align: left;">Deskripsi</th>
                <th style="padding: 1rem; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            <tr style="border-bottom: 1px solid #e0e0e0;">
                <td style="padding: 1rem;">{{ $index + 1 }}</td>
                <td style="padding: 1rem;">
                    @if($item->gambar)
                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" style="width: 80px; height: 60px; object-fit: cover; border-radius: 5px;">
                    @else
                    <span style="color: #999;">Tidak ada gambar</span>
                    @endif
                </td>
                <td style="padding: 1rem;">{{ $item->judul }}</td>
                <td style="padding: 1rem;">{{ Str::limit($item->deskripsi, 100) }}</td>
                <td style="padding: 1rem; text-align: center;">
                    <a href="{{ route('admin.umkm.edit', $item) }}" style="background: #ffc107; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 3px; margin-right: 0.5rem;">Edit</a>
                    <form action="{{ route('admin.umkm.destroy', $item) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" style="background: #dc3545; color: white; padding: 0.5rem 1rem; border: none; border-radius: 3px; cursor: pointer;">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: 2rem; text-align: center; color: #999;">Belum ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
