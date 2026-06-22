@extends('layouts.main')

@section('content')
<div class="container-fluid py-2">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="page-title mb-1">Tambah Barang Baru</h1>
            <p class="page-subtitle mb-0">Daftarkan aset atau peralatan laboratorium baru ke dalam sistem database.</p>
        </div>
        <a href="{{ route('barang.index') }}" class="btn btn-light-mono">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card pt-fade-up">
        <div class="card-body p-4">
            <form action="{{ route('barang.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6 form-section-left">
                        <h5 class="section-heading"><i class="bi bi-tag-fill me-2"></i>Informasi Umum</h5>

                        <div class="mb-3">
                            <label class="form-label">Kode Barang <span class="text-required">*</span></label>
                            <input type="text" name="kode" class="form-control form-readonly" placeholder="Otomatis di-generate oleh sistem (cth: RO-001)" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Barang <span class="text-required">*</span></label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama alat / komponen" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi Barang</label>
                            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Tulis spesifikasi singkat atau keterangan barang..."></textarea>
                        </div>
                    </div>

                    <div class="col-md-6 form-section-right">
                        <h5 class="section-heading"><i class="bi bi-boxes me-2"></i>Stok &amp; Lokasi</h5>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Stok Total <span class="text-required">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="stok_total" class="form-control" min="0" required>
                                    <span class="input-group-text-mono">unit</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kondisi Alat <span class="text-required">*</span></label>
                            <select name="kondisi_id" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Kondisi --</option>
                                <option value="1">Baik</option>
                                <option value="2">Rusak Ringan</option>
                                <option value="3">Rusak Berat</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Lokasi Penyimpanan <span class="text-required">*</span></label>
                            <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Rak 5, Lemari B3" required>
                        </div>
                    </div>
                </div>

                <hr class="form-divider">

                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-light-mono">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset Form
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle-fill me-1"></i> Simpan Barang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .section-heading {
        font-size: 14px; font-weight: 800; color: #1A1A1A;
        text-transform: uppercase; letter-spacing: .3px;
        margin-bottom: 18px;
        display: flex; align-items: center;
    }
    .section-heading i { color: #1A1A1A; }

    .form-section-left {
        border-right: 3px solid #1A1A1A;
        padding-right: 24px;
    }
    .form-section-right { padding-left: 24px; }
    @media (max-width: 768px) {
        .form-section-left { border-right: none; border-bottom: 3px solid #1A1A1A; padding-right: 0; padding-bottom: 20px; margin-bottom: 8px; }
        .form-section-right { padding-left: 0; }
    }

    .text-required { color: #FF4D4D; font-weight: 800; }

    .form-readonly {
        background: #F0EFEA !important;
        color: #888 !important;
    }

    .input-group-text-mono {
        border: 3px solid #1A1A1A; border-left: none;
        background: #F0EFEA; color: #666;
        font-size: 12px; font-weight: 700;
        padding: 9px 14px; border-radius: 0 6px 6px 0;
    }
    .input-group .form-control { border-radius: 6px 0 0 6px; }

    .form-divider { border: none; border-top: 3px solid #1A1A1A; margin: 28px 0 20px; opacity: 1; }

    .btn-light-mono {
        background: #fff; color: #1A1A1A;
        border: 3px solid #1A1A1A; border-radius: 6px;
        padding: 10px 20px; font-size: 12px; font-weight: 800;
        text-transform: uppercase; cursor: pointer;
        box-shadow: 3px 3px 0 #1A1A1A;
        transition: transform .1s, box-shadow .1s;
        text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
    }
    .btn-light-mono:hover { color: #1A1A1A; transform: translate(-1px,-1px); box-shadow: 4px 4px 0 #1A1A1A; }

    .pt-fade-up { will-change: opacity, transform; animation-delay: .15s; }
</style>
@endsection
