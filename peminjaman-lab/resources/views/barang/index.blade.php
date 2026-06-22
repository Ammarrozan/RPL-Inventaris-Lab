@extends('layouts.main')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <div class="page-title">Daftar Barang</div>
        <div class="page-subtitle">{{ $barangs->count() }} barang terdaftar</div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" form="barcodeForm" class="btn btn-light" style="border: 3px solid #1A1A1A; border-radius: 6px; font-weight: bold; box-shadow: 3px 3px 0 #1A1A1A;">
            <i class="bi bi-upc-scan me-1"></i> Cetak Barcode
        </button>

        <a href="{{ route('barang.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Barang
        </a>
    </div>
</div>

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-md-3 pt-fade-up pt-delay-1">
        <div class="stat-card">
            <div class="stat-icon" style="background:#9DC8FF"><i class="bi bi-box"></i></div>
            <div>
                <div class="stat-num">{{ $jenisBarang }}</div>
                <div class="stat-label">Jenis Barang</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 pt-fade-up pt-delay-2">
        <div class="stat-card">
            <div class="stat-icon" style="background:#7CD9C2"><i class="bi bi-stack"></i></div>
            <div>
                <div class="stat-num">{{ $totalStok }}</div>
                <div class="stat-label">Total Stok</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 pt-fade-up pt-delay-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#A8F0A8"><i class="bi bi-check-circle"></i></div>
            <div>
                <div class="stat-num">{{ $stokTersedia }}</div>
                <div class="stat-label">Stok Tersedia</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 pt-fade-up pt-delay-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:#FFE34D"><i class="bi bi-arrow-left-right"></i></div>
            <div>
                <div class="stat-num">{{ $barangs->sum('stok_total') - $barangs->sum('stok_tersedia') }}</div>
                <div class="stat-label">Sedang Dipinjam</div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel --}}
<div class="card w-100 pt-fade-up" style="animation-delay:.45s">
    <div class="card-body p-0">
        <form id="barcodeForm" action="{{ route('barang.cetak-barcode') }}" method="POST" target="_blank">
            @csrf
            <table class="table table-bordered mb-0 w-100">
                <thead>
                    <tr>
                        <th width="4%" class="text-center align-middle">
                            <input type="checkbox" id="checkAll" class="form-check-input" style="border: 2px solid #1a1a1a; cursor: pointer;">
                        </th>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Stok Total</th>
                        <th>Stok Tersedia</th>
                        <th>Kondisi</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangs as $index => $barang)
                    <tr>
                        <td class="text-center align-middle">
                            <input type="checkbox" name="barang_id[]" value="{{ $barang->id }}" class="form-check-input check-item" style="border: 2px solid #1a1a1a; cursor: pointer;">
                        </td>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $barang->kode ?? '-' }}</td>
                        <td>{{ $barang->nama }}</td>
                        <td>{{ $barang->stok_total }}</td>
                        <td>{{ $barang->stok_tersedia }}</td>
                        <td>{{ $barang->kondisi->nama ?? '-' }}</td>
                        <td>{{ $barang->lokasi ?? '-' }}</td>
                        <td>
                            <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <button type="submit" form="delete-form-{{ $barang->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>

@foreach($barangs as $barang)
<form id="delete-form-{{ $barang->id }}" action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
@endforeach

{{-- Script Fitur Check All --}}
<script>
    document.getElementById('checkAll').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.check-item');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>

@endsection
