@extends('layouts.main')

@section('content')
<div class="container-fluid py-2">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="page-title mb-1">Tambah Barang Baru</h1>
            <p class="page-subtitle mb-0">Dafrarkan aset atau peralatan laboratorium baru ke dalam sistem database.</p>
        </div>
        <a href="{{ route('barang.index') }}" class="btn btn-light border shadow-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6 border-end pe-md-4">
                        <h5 class="fw-semibold text-primary mb-3"><i class="bi bi-tag-fill me-2"></i>Informasi Umum</h5>

                        <div class="mb-3">
                            <label class="form-label fw-medium">Kode Barang <span class="text-danger">*</span></label>
                            <input type="text" name="kode" class="form-control" placeholder="Contoh: KB001" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-medium">Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama alat / komponen" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-medium">Deskripsi Barang</label>
                            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tulis spesifikasi singkat atau keterangan barang..."></textarea>
                        </div>
                    </div>

                    <div class="col-md-6 ps-md-4">
                        <h5 class="fw-semibold text-primary mb-3"><i class="bi bi-boxes me-2"></i>Stok & Lokasi</h5>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Stok Total <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="stok_total" class="form-control" min="0" required>
                                    <span class="input-group-text bg-light text-muted">unit</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Stok Tersedia <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="stok_tersedia" class="form-control" min="0" required>
                                    <span class="input-group-text bg-light text-muted">unit</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-medium">Kondisi Alat <span class="text-danger">*</span></label>
                            <select name="kondisi_id" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Kondisi --</option>
                                <option value="1">Baik</option>
                                <option value="2">Rusak Ringan</option>
                                <option value="3">Rusak Berat</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Lokasi Penyimpanan <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Rak 5, Lemari B3" required>
                        </div>
                    </div>
                </div>

                <hr class="my-4 text-muted opacity-25">

                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-light border px-4 py-2">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset Form
                    </button>
                    <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">
                        <i class="bi bi-check-circle-fill me-1"></i> Simpan Barang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
