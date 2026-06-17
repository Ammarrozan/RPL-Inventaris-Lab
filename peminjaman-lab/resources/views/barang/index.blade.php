@extends('layouts.main')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <div class="page-title">Daftar Barang</div>
        <div class="page-subtitle">{{ $barangs->count() }} barang terdaftar</div>
    </div>
    <a href="{{ route('barang.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Barang
    </a>
</div>

{{-- Stats Card --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:42px;height:42px;border-radius:10px;background:#EFF6FF;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <i class="bi bi-box-seam" style="color:#3B82F6;font-size:18px"></i>
                </div>
                <div>
                    <div style="font-size:22px;font-weight:700;color:#0F172A;line-height:1">{{ $barangs->count() }}</div>
                    <div style="font-size:12px;color:#64748B;margin-top:2px">Jenis Barang</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:42px;height:42px;border-radius:10px;background:#F0FDF4;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <i class="bi bi-stack" style="color:#10B981;font-size:18px"></i>
                </div>
                <div>
                    <div style="font-size:22px;font-weight:700;color:#0F172A;line-height:1">{{ $barangs->sum('stok_total') }}</div>
                    <div style="font-size:12px;color:#64748B;margin-top:2px">Total Stok</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:42px;height:42px;border-radius:10px;background:#F0FDF4;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <i class="bi bi-check-circle" style="color:#10B981;font-size:18px"></i>
                </div>
                <div>
                    <div style="font-size:22px;font-weight:700;color:#0F172A;line-height:1">{{ $barangs->sum('stok_tersedia') }}</div>
                    <div style="font-size:12px;color:#64748B;margin-top:2px">Stok Tersedia</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:42px;height:42px;border-radius:10px;background:#FFFBEB;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <i class="bi bi-arrow-left-right" style="color:#F59E0B;font-size:18px"></i>
                </div>
                <div>
                    <div style="font-size:22px;font-weight:700;color:#0F172A;line-height:1">{{ $barangs->sum('stok_total') - $barangs->sum('stok_tersedia') }}</div>
                    <div style="font-size:12px;color:#64748B;margin-top:2px">Sedang Dipinjam</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel dan Gambar Berdampingan (Force Flexbox) --}}
<div class="row g-4 align-items-start">

    <div class="col-md-8">
        <div class="card m-0">
            <div class="card-body p-0">
                <table class="table table-bordered mb-0 w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Stok Tersedia</th>
                            <th>Kondisi</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangs as $index => $barang)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $barang->kode ?? '-' }}</td>
                            <td>{{ $barang->nama }}</td>
                            <td>{{ $barang->stok_tersedia }}</td>
                            <td>{{ $barang->kondisi->nama ?? '-' }}</td>
                            <td>{{ $barang->lokasi ?? '-' }}</td>
                            <td>
                                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4 text-center">
        <div class="card border-0 bg-transparent p-2">
            <img src="{{ asset('images/stok barang.png') }}"
                 class="img-fluid"
                 alt="Ilustrasi Inventaris"
                 style="max-height: 280px; object-fit: contain; width: 100%;">
        </div>
    </div>

</div>

@endsection
