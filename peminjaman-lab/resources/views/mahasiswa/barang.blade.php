@extends('mahasiswa.layout')

@section('content')

<style>
    /* ── Header Halaman ── */
    .page-header-custom { margin-bottom: 28px; }
    .page-header-custom h1 { font-size: 24px; font-weight: 900; margin-bottom: 4px; color: #1A1A1A; text-transform: uppercase; letter-spacing: -.5px; }
    .page-header-custom p  { font-size: 13px; color: #666; font-weight: 600; }

    /* ── Alert ── */
    .alert-custom-success {
        background: #A8F0A8; color: #1A1A1A;
        border: 3px solid #1A1A1A; border-radius: 8px;
        padding: 12px 16px; font-size: 13px; font-weight: 700;
        display: flex; align-items: center; gap: 8px;
        margin-bottom: 24px;
        box-shadow: 4px 4px 0 #1A1A1A;
    }

    /* ── Grid & Card ── */
    .barang-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 36px;
    }

    .item-card {
        background: #fff;
        border: 3px solid #1A1A1A;
        border-radius: 8px;
        padding: 20px;
        transition: transform .15s ease, box-shadow .15s ease;
        box-shadow: 5px 5px 0 #1A1A1A;
        display: flex;
        flex-direction: column;
    }
    .item-card:hover { transform: translate(-2px,-2px); box-shadow: 7px 7px 0 #1A1A1A; }

    .item-card-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 16px; }
    .item-card-icon {
        width: 44px; height: 44px; border: 2px solid #1A1A1A; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
    }
    .item-card-badge {
        font-size: 10px; font-weight: 800; padding: 4px 10px;
        border: 2px solid #1A1A1A; border-radius: 20px;
        display: inline-flex; align-items: center; gap: 4px;
        text-transform: uppercase;
    }
    .badge-baik  { background: #A8F0A8; color: #1A1A1A; }
    .badge-rusak { background: #FF9D9D; color: #1A1A1A; }

    .item-card-name    { font-size: 17px; font-weight: 900; margin-bottom: 2px; text-transform: uppercase; color: #1A1A1A; }
    .item-card-kategori { font-size: 11px; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 16px; }

    .stok-section { margin-bottom: 16px; }
    .stok-top     { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 6px; }
    .stok-label   { font-size: 11px; color: #888; font-weight: 700; text-transform: uppercase; }
    .stok-count   { font-size: 18px; font-weight: 900; color: #1A1A1A; }
    .stok-bar     { height: 8px; background: #F0EFEA; border: 2px solid #1A1A1A; border-radius: 99px; overflow: hidden; }
    .stok-fill    { height: 100%; transition: width 0.5s ease; }

    .item-card-meta    { display: flex; flex-direction: column; gap: 8px; margin-bottom: 18px; flex-grow: 1; }
    .meta-item    { display: flex; align-items: center; gap: 8px; font-size: 12px; color: #666; font-weight: 600; }
    .meta-icon    { width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; color: #888; flex-shrink: 0; }
    .meta-val     { font-weight: 800; color: #1A1A1A; }

    .btn-pinjam {
        font-family: inherit; width: 100%; padding: 11px; border: 3px solid #1A1A1A;
        border-radius: 8px; font-size: 13px; font-weight: 800;
        color: #1A1A1A; cursor: pointer; text-transform: uppercase;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        box-shadow: 3px 3px 0 #1A1A1A;
        transition: transform .1s, box-shadow .1s;
    }
    .btn-pinjam:hover  { transform: translate(-1px,-1px); box-shadow: 4px 4px 0 #1A1A1A; }
    .btn-pinjam:active { transform: translate(0,0); box-shadow: 1px 1px 0 #1A1A1A; }

    /* Theme Colors */
    .theme-blue  .item-card-icon { background: #9DC8FF; }
    .theme-blue  .stok-fill { background: #9DC8FF; }
    .theme-blue  .btn-pinjam { background: #9DC8FF; }

    .theme-teal  .item-card-icon { background: #7CD9C2; }
    .theme-teal  .stok-fill { background: #7CD9C2; }
    .theme-teal  .btn-pinjam { background: #7CD9C2; }

    .theme-amber .item-card-icon { background: #FFE34D; }
    .theme-amber .stok-fill { background: #FFE34D; }
    .theme-amber .btn-pinjam { background: #FFE34D; }

    /* ── Banner Info ── */
    .banner-section-title {
        font-size: 11px; font-weight: 800; color: #777;
        text-transform: uppercase; letter-spacing: .1em; margin-bottom: 14px;
    }
    .banner-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 16px; }
    .banner-main {
        background: #fff; border: 3px solid #1A1A1A; border-radius: 8px;
        padding: 20px 24px; display: flex; align-items: center; gap: 18px;
        box-shadow: 5px 5px 0 #1A1A1A;
    }
    .banner-icon-wrap {
        width: 52px; height: 52px; flex-shrink: 0; border: 2px solid #1A1A1A; border-radius: 8px;
        background: #FFE34D; color: #1A1A1A;
        display: flex; align-items: center; justify-content: center; font-size: 24px;
    }
    .banner-main-text h3 { font-size: 15px; font-weight: 900; color: #1A1A1A; margin-bottom: 6px; text-transform: uppercase; }
    .banner-main-text p  { font-size: 13px; color: #666; line-height: 1.6; margin-bottom: 0; font-weight: 500;}
    .banner-tag {
        display: inline-flex; align-items: center; gap: 5px;
        margin-top: 12px; font-size: 11px; font-weight: 800;
        background: #F0EFEA; color: #1A1A1A; border: 2px solid #1A1A1A;
        padding: 4px 10px; border-radius: 20px;
    }
    .banner-side { display: flex; flex-direction: column; gap: 10px; }
    .info-card {
        background: #fff; border: 3px solid #1A1A1A; border-radius: 8px;
        padding: 14px 16px; display: flex; align-items: center; gap: 12px; flex: 1;
        box-shadow: 4px 4px 0 #1A1A1A;
    }
    .info-icon {
        width: 36px; height: 36px; flex-shrink: 0; border: 2px solid #1A1A1A; border-radius: 6px;
        display: flex; align-items: center; justify-content: center; font-size: 16px;
    }
    .info-icon-green { background: #A8F0A8; color: #1A1A1A; }
    .info-icon-amber { background: #FFE34D; color: #1A1A1A; }
    .info-icon-blue  { background: #9DC8FF;  color: #1A1A1A; }
    .info-card-text p    { font-size: 13px; font-weight: 800; color: #1A1A1A; margin-bottom: 2px; }
    .info-card-text span { font-size: 12px; color: #666; font-weight: 600; }

    @media (max-width: 768px) { .banner-grid { grid-template-columns: 1fr; } }

    /* ── Modal ── */
    .modal-overlay-custom {
        display: none; position: fixed; inset: 0; z-index: 9999;
        background: rgba(26,26,26,.55);
        align-items: center; justify-content: center;
    }
    .modal-overlay-custom.active { display: flex; }
    .modal-box {
        background: #fff; border: 3px solid #1A1A1A; border-radius: 8px; padding: 28px;
        width: 100%; max-width: 420px; box-shadow: 8px 8px 0 #1A1A1A;
        animation: modal-in .2s ease-out;
    }
    @keyframes modal-in { from { transform: translateY(20px); opacity: 0; } to { transform: none; opacity: 1; } }
    .modal-header-custom { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
    .modal-header-custom h2 { font-size: 16px; font-weight: 900; margin: 0; text-transform: uppercase; color: #1A1A1A;}
    .modal-close-btn {
        width: 32px; height: 32px; border-radius: 6px;
        border: 2px solid #1A1A1A; background: #fff;
        cursor: pointer; display: flex; align-items: center; justify-content: center;
        color: #1A1A1A; box-shadow: 2px 2px 0 #1A1A1A; transition: all .15s;
    }
    .modal-close-btn:hover { background: #FF9D9D; }

    .form-group-custom { margin-bottom: 16px; }
    .form-label-custom { display: block; font-size: 11px; font-weight: 800; color: #1A1A1A; text-transform: uppercase; margin-bottom: 6px; }
    .form-input-custom {
        width: 100%; padding: 10px 12px;
        border: 3px solid #1A1A1A; border-radius: 6px;
        font-family: inherit; font-size: 13px; color: #1A1A1A;
        background: #FAFAF7; outline: none;
    }
    .form-input-custom:focus { box-shadow: 3px 3px 0 #1A1A1A; }

    .modal-info-box {
        background: #F0EFEA; border: 2px solid #1A1A1A; border-radius: 6px;
        padding: 10px 14px; font-size: 12px; color: #1A1A1A; font-weight: 600;
        display: flex; align-items: center; gap: 8px; margin-bottom: 20px;
    }
    .modal-info-box strong { font-weight: 800; }

    .modal-actions-custom { display: flex; gap: 10px; margin-top: 20px;}
    .btn-cancel-custom {
        flex: 1; padding: 11px; border: 3px solid #1A1A1A; background: #fff;
        border-radius: 8px;
        font-family: inherit; font-size: 12px; font-weight: 800; text-transform: uppercase;
        color: #1A1A1A; cursor: pointer; box-shadow: 3px 3px 0 #1A1A1A;
        transition: transform .1s, box-shadow .1s;
    }
    .btn-cancel-custom:hover { transform: translate(-1px,-1px); box-shadow: 4px 4px 0 #1A1A1A; }
    .btn-submit-custom {
        flex: 2; padding: 11px; border: 3px solid #1A1A1A;
        border-radius: 8px; background: #FF4D4D;
        font-family: inherit; font-size: 12px; font-weight: 800; text-transform: uppercase;
        color: #fff; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;
        box-shadow: 3px 3px 0 #1A1A1A;
        transition: transform .1s, box-shadow .1s;
    }
    .btn-submit-custom:hover { transform: translate(-1px,-1px); box-shadow: 4px 4px 0 #1A1A1A; }
    .form-error { font-size: 11px; color: #FF4D4D; margin-top: 4px; font-weight: 700;}

    /* ── Animasi pop-up ── */
    .pt-fade-up {
        opacity: 0; transform: translateY(24px);
        animation: ptFadeUp 0.5s cubic-bezier(.2,.8,.2,1) forwards;
        animation-delay: .15s; will-change: opacity, transform;
    }
    @keyframes ptFadeUp { to { opacity: 1; transform: translateY(0); } }
    .pt-delay-1 { animation-delay: .2s; }
    .pt-delay-2 { animation-delay: .26s; }
    .pt-delay-3 { animation-delay: .32s; }
    .pt-delay-4 { animation-delay: .38s; }
    .pt-delay-5 { animation-delay: .44s; }
    .pt-delay-6 { animation-delay: .5s; }
</style>

<div class="page-header-custom pt-fade-up">
    <h1>Daftar Barang Tersedia</h1>
    <p>{{ $barangs->count() }} item tersedia untuk dipinjam di laboratorium</p>
</div>

{{-- Flash success --}}
@if(session('success'))
    <div class="alert-custom-success pt-fade-up">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
@endif

<div class="barang-grid">
    @forelse($barangs as $index => $barang)
        @php
            $themes  = ['blue', 'teal', 'amber'];
            $theme   = $themes[$index % count($themes)];
            $icons   = [
                'router'    => 'bi-hdd-network',
                'lan'       => 'bi-diagram-3',
                'converter' => 'bi-plug',
                'hdmi'      => 'bi-display',
                'default'   => 'bi-box-seam',
            ];
            $iconKey  = strtolower($barang->nama);
            $icon     = $icons[$iconKey] ?? $icons['default'];
            $maxStok  = 50;
            $persen   = min(round(($barang->stok_tersedia / $maxStok) * 100), 100);
            $kondisi  = $barang->kondisi->nama ?? $barang->kondisi ?? '-';
            $delayClass = 'pt-delay-' . min($index + 1, 6);
        @endphp

        <div class="item-card theme-{{ $theme }} pt-fade-up {{ $delayClass }}">
            <div class="item-card-header">
                <div class="item-card-icon"><i class="bi {{ $icon }}" style="font-size:20px;color:#1A1A1A"></i></div>
                <span class="item-card-badge {{ $kondisi === 'Baik' ? 'badge-baik' : 'badge-rusak' }}">
                    @if($kondisi === 'Baik')
                        <i class="bi bi-check-lg"></i>
                    @endif
                    {{ $kondisi }}
                </span>
            </div>

            <p class="item-card-name">{{ $barang->nama }}</p>
            <p class="item-card-kategori">{{ $barang->kategori ?? 'Umum' }}</p>

            <div class="stok-section">
                <div class="stok-top">
                    <span class="stok-label">Stok Tersedia</span>
                    <span class="stok-count">{{ $barang->stok_tersedia }}</span>
                </div>
                <div class="stok-bar">
                    <div class="stok-fill" style="width: {{ $persen }}%"></div>
                </div>
            </div>

            <div class="item-card-meta">
                <div class="meta-item">
                    <span class="meta-icon"><i class="bi bi-geo-alt"></i></span>
                    Lokasi: <span class="meta-val">{{ $barang->lokasi ?? '-' }}</span>
                </div>
            </div>

            <button type="button" class="btn-pinjam"
                onclick="bukaModal({{ $barang->id }}, '{{ $barang->nama }}', {{ $barang->stok_tersedia }})">
                <i class="bi bi-cart-plus"></i>
                Pinjam Alat
            </button>
        </div>
    @empty
        <div class="col-12 text-center py-5" style="color:#888;font-weight:600">
            Tidak ada barang tersedia saat ini.
        </div>
    @endforelse
</div>

{{-- ── Banner Info & Pengumuman ── --}}
<div class="mb-5 pt-fade-up pt-delay-5">
    <p class="banner-section-title">Informasi &amp; Aturan Lab</p>
    <div class="banner-grid">

        <div class="banner-main">
            <div class="banner-icon-wrap"><i class="bi bi-megaphone-fill"></i></div>
            <div class="banner-main-text">
                <h3>Pengumuman Peminjaman</h3>
                <p>Peminjaman peralatan hanya dapat dilakukan pada jam operasional lab. Setiap peminjaman wajib mendapat persetujuan dari asisten laboratorium sebelum barang diambil.</p>
                <span class="banner-tag">
                    <i class="bi bi-clock-history"></i>
                    Diperbarui {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </span>
            </div>
        </div>

        <div class="banner-side">
            <div class="info-card">
                <div class="info-icon info-icon-green"><i class="bi bi-clock-fill"></i></div>
                <div class="info-card-text">
                    <p>Jam Operasional</p>
                    <span>Senin – Jumat, 08.00 – 16.00</span>
                </div>
            </div>
            <div class="info-card">
                <div class="info-icon info-icon-amber"><i class="bi bi-exclamation-triangle-fill"></i></div>
                <div class="info-card-text">
                    <p>Batas Peminjaman</p>
                    <span>Maksimal 3 hari per item</span>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ── Modal Pinjam ── --}}
<div class="modal-overlay-custom" id="modalOverlay" onclick="tutupModalDiluar(event)">
    <div class="modal-box" id="modalBox">
        <div class="modal-header-custom">
            <h2>Form Peminjaman</h2>
            <button class="modal-close-btn" onclick="tutupModal()" aria-label="Tutup">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="modal-info-box">
            <i class="bi bi-box-seam"></i>
            <span>Barang terpilih: <strong id="modalNamaBarang">-</strong></span>
        </div>

        <form method="POST" action="{{ route('mahasiswa.request') }}" id="formPinjam" data-no-transition>
            @csrf
            <input type="hidden" name="id_barang" id="inputIdBarang">

            <div class="form-group-custom">
                <label class="form-label-custom" for="nim">NIM</label>
                <input type="text" name="nim" id="nim"
                    class="form-input-custom" placeholder="Masukkan NIM kamu"
                    value="{{ auth()->user()->nim ?? old('nim') }}" required>
                @error('nim')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group-custom">
                <label class="form-label-custom" for="tanggal_dipinjam">Tanggal Peminjaman</label>
                <input type="date" name="tanggal_dipinjam" id="tanggal_dipinjam"
                    class="form-input-custom" min="{{ date('Y-m-d') }}" required>
                @error('tanggal_dipinjam')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group-custom">
                <label class="form-label-custom" for="jumlah">Jumlah Barang</label>
                <input type="number" name="jumlah" id="jumlah"
                    class="form-input-custom" min="1" value="1" required>
                @error('jumlah')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="modal-actions-custom">
                <button type="button" class="btn-cancel-custom" onclick="tutupModal()">Batalkan</button>
                <button type="submit" class="btn-submit-custom">
                    <i class="bi bi-send-fill"></i>
                    Kirim Request
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function bukaModal(id, nama, stok) {
        document.getElementById('inputIdBarang').value = id;
        document.getElementById('modalNamaBarang').textContent = nama;
        document.getElementById('jumlah').max = stok;
        document.getElementById('modalOverlay').classList.add('active');
    }
    function tutupModal() {
        document.getElementById('modalOverlay').classList.remove('active');
    }
    function tutupModalDiluar(e) {
        if (e.target === document.getElementById('modalOverlay')) tutupModal();
    }

    @if($errors->any())
        bukaModal(
            '{{ old('id_barang') }}',
            'Barang yang dipilih',
            99
        );
    @endif
</script>

@endsection
