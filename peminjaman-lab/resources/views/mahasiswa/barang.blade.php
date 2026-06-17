<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang Tersedia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #F5F6FA;
            --surface: #FFFFFF;
            --border: #E8EAF0;
            --text-primary: #1A1D2E;
            --text-secondary: #6B7280;
            --text-muted: #9CA3AF;
            --blue: #3B82F6;
            --blue-light: #EFF6FF;
            --blue-dark: #1D4ED8;
            --teal: #0D9488;
            --teal-light: #F0FDFA;
            --amber: #D97706;
            --amber-light: #FFFBEB;
            --green: #16A34A;
            --green-light: #F0FDF4;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
            --shadow-md: 0 4px 12px rgba(0,0,0,.08);
            --shadow-lg: 0 10px 40px rgba(0,0,0,.12);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text-primary);
            min-height: 100vh;
        }

        /* ── Topbar ── */
        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .topbar-brand {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .topbar-brand-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--blue);
        }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .topbar-user  { display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--text-secondary); }
        .avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--blue-light); color: var(--blue-dark);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 600;
        }
        .btn-logout {
            font-family: inherit; font-size: 13px; font-weight: 500;
            color: #EF4444; background: transparent;
            border: 1px solid #FECACA; border-radius: var(--radius-sm);
            padding: 6px 14px; cursor: pointer;
            display: flex; align-items: center; gap: 6px;
            transition: background .15s, border-color .15s;
        }
        .btn-logout:hover { background: #FEF2F2; border-color: #FCA5A5; }

        /* ── Alert ── */
        .alert-success {
            background: var(--green-light); color: var(--green);
            border: 1px solid #BBF7D0; border-radius: var(--radius-md);
            padding: 12px 16px; font-size: 14px; font-weight: 500;
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 20px;
        }

        /* ── Page layout ── */
        .page { max-width: 1100px; margin: 0 auto; padding: 40px 24px; }
        .page-header { margin-bottom: 28px; }
        .page-header h1 { font-size: 22px; font-weight: 600; margin-bottom: 4px; }
        .page-header p  { font-size: 14px; color: var(--text-secondary); }

        /* ── Grid ── */
        .barang-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        /* ── Card ── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px;
            transition: transform .2s, box-shadow .2s, border-color .2s;
            box-shadow: var(--shadow-sm);
        }
        .card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); border-color: #D1D5DB; }

        .card-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 16px; }
        .card-icon {
            width: 44px; height: 44px; border-radius: var(--radius-md);
            display: flex; align-items: center; justify-content: center;
        }
        .card-badge-kondisi {
            font-size: 11px; font-weight: 600; padding: 4px 10px;
            border-radius: 20px; display: inline-flex; align-items: center; gap: 4px;
        }
        .badge-baik  { background: var(--green-light); color: var(--green); }
        .badge-rusak { background: #FEF2F2; color: #EF4444; }

        .card-name     { font-size: 17px; font-weight: 600; margin-bottom: 2px; text-transform: capitalize; }
        .card-kategori { font-size: 12px; font-weight: 500; color: var(--text-muted); text-transform: uppercase; letter-spacing: .05em; margin-bottom: 18px; }

        .stok-section { margin-bottom: 16px; }
        .stok-top     { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 6px; }
        .stok-label   { font-size: 12px; color: var(--text-muted); }
        .stok-count   { font-size: 18px; font-weight: 600; }
        .stok-bar     { height: 5px; background: var(--border); border-radius: 99px; overflow: hidden; }
        .stok-fill    { height: 100%; border-radius: 99px; }

        .card-meta    { display: flex; flex-direction: column; gap: 8px; margin-bottom: 20px; }
        .meta-item    { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--text-secondary); }
        .meta-icon    { width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; color: var(--text-muted); flex-shrink: 0; }
        .meta-val     { font-weight: 500; color: var(--text-primary); }

        .btn-pinjam {
            font-family: inherit; width: 100%; padding: 10px; border: none;
            border-radius: var(--radius-md); font-size: 14px; font-weight: 600;
            color: #fff; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 6px;
            transition: opacity .15s, transform .1s;
        }
        .btn-pinjam:hover  { opacity: .9; }
        .btn-pinjam:active { transform: scale(.98); }

        /* color themes */
        .theme-blue  .card-icon { background: var(--blue-light);  color: var(--blue); }
        .theme-blue  .stok-fill { background: var(--blue); }
        .theme-blue  .btn-pinjam { background: var(--blue); }
        .theme-teal  .card-icon { background: var(--teal-light);  color: var(--teal); }
        .theme-teal  .stok-fill { background: var(--teal); }
        .theme-teal  .btn-pinjam { background: var(--teal); }
        .theme-amber .card-icon { background: var(--amber-light); color: var(--amber); }
        .theme-amber .stok-fill { background: var(--amber); }
        .theme-amber .btn-pinjam { background: var(--amber); }

        /* empty */
        .empty { grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: var(--text-muted); font-size: 15px; }

        /* ── Banner Info ── */
        .banner-section { margin-top: 36px; }
        .banner-section-title {
            font-size: 12px; font-weight: 600; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: .06em; margin-bottom: 14px;
        }
        .banner-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 16px;
        }
        .banner-main {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 22px 26px;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .banner-icon-wrap {
            width: 52px; height: 52px; flex-shrink: 0;
            border-radius: var(--radius-md);
            background: var(--blue-light);
            color: var(--blue);
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
        }
        .banner-main-text h3 { font-size: 15px; font-weight: 600; color: var(--text-primary); margin-bottom: 6px; }
        .banner-main-text p  { font-size: 13px; color: var(--text-secondary); line-height: 1.6; }
        .banner-tag {
            display: inline-flex; align-items: center; gap: 5px;
            margin-top: 12px; font-size: 12px; font-weight: 500;
            background: var(--blue-light); color: var(--blue-dark);
            padding: 4px 10px; border-radius: 20px;
        }
        .banner-side { display: flex; flex-direction: column; gap: 10px; }
        .info-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 14px 16px;
            display: flex; align-items: center; gap: 12px;
            flex: 1;
        }
        .info-icon {
            width: 36px; height: 36px; flex-shrink: 0;
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 17px;
        }
        .info-icon-green { background: var(--green-light); color: var(--green); }
        .info-icon-amber { background: var(--amber-light); color: var(--amber); }
        .info-icon-blue  { background: var(--blue-light);  color: var(--blue); }
        .info-card-text p    { font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 2px; }
        .info-card-text span { font-size: 12px; color: var(--text-secondary); }

        @media (max-width: 768px) {
            .banner-grid { grid-template-columns: 1fr; }
        }

        /* ── Modal ── */
        .modal-overlay {
            display: none;
            position: fixed; inset: 0; z-index: 50;
            background: rgba(15,23,42,.45);
            align-items: center; justify-content: center;
        }
        .modal-overlay.active { display: flex; }
        .modal {
            background: var(--surface);
            border-radius: var(--radius-lg);
            padding: 28px;
            width: 100%; max-width: 420px;
            box-shadow: var(--shadow-lg);
            animation: modal-in .18s ease;
        }
        @keyframes modal-in { from { transform: translateY(12px); opacity: 0; } to { transform: none; opacity: 1; } }
        .modal-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
        .modal-header h2 { font-size: 17px; font-weight: 600; }
        .modal-close {
            width: 32px; height: 32px; border-radius: var(--radius-sm);
            border: 1px solid var(--border); background: transparent;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            color: var(--text-muted); transition: background .15s;
        }
        .modal-close:hover { background: var(--bg); }

        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: 13px; font-weight: 500; color: var(--text-secondary); margin-bottom: 6px; }
        .form-input {
            width: 100%; padding: 9px 12px;
            border: 1px solid var(--border); border-radius: var(--radius-sm);
            font-family: inherit; font-size: 14px; color: var(--text-primary);
            background: var(--surface); transition: border-color .15s;
            outline: none;
        }
        .form-input:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(59,130,246,.1); }

        .modal-info {
            background: var(--bg); border-radius: var(--radius-sm);
            padding: 10px 14px; font-size: 13px; color: var(--text-secondary);
            display: flex; align-items: center; gap: 8px; margin-bottom: 20px;
        }
        .modal-info strong { color: var(--text-primary); }

        .modal-actions { display: flex; gap: 10px; }
        .btn-cancel {
            flex: 1; padding: 10px; border: 1px solid var(--border);
            border-radius: var(--radius-md); background: transparent;
            font-family: inherit; font-size: 14px; font-weight: 500;
            color: var(--text-secondary); cursor: pointer;
            transition: background .15s;
        }
        .btn-cancel:hover { background: var(--bg); }
        .btn-submit {
            flex: 2; padding: 10px; border: none;
            border-radius: var(--radius-md); background: var(--blue);
            font-family: inherit; font-size: 14px; font-weight: 600;
            color: #fff; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 6px;
            transition: opacity .15s;
        }
        .btn-submit:hover { opacity: .9; }

        /* error */
        .form-error { font-size: 12px; color: #EF4444; margin-top: 4px; }

        @media (max-width: 600px) {
            .topbar { padding: 0 16px; }
            .page   { padding: 24px 16px; }
            .modal  { margin: 16px; }
        }
    </style>
</head>
<body>

{{-- Topbar --}}
<header class="topbar">
    <div class="topbar-brand">
        <div class="topbar-brand-dot"></div>
        Inventaris Lab
    </div>
    <div class="topbar-right">
        <div class="topbar-user">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <span>{{ auth()->user()->name }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Logout
            </button>
        </form>
    </div>
</header>

{{-- Konten --}}
<main class="page">
    <div class="page-header">
        <h1>Daftar Barang Tersedia</h1>
        <p>{{ $barangs->count() }} item tersedia untuk dipinjam</p>
    </div>

    {{-- Flash success --}}
    @if(session('success'))
        <div class="alert-success">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="barang-grid">
        @forelse($barangs as $index => $barang)
            @php
                $themes  = ['blue', 'teal', 'amber'];
                $theme   = $themes[$index % count($themes)];
                $icons   = [
                    'router'    => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="14" width="20" height="6" rx="2"/><path d="M6 14v-4"/><path d="M18 14v-4"/><path d="M12 14V8"/><path d="M2 20h.01"/><path d="M6 20h.01"/></svg>',
                    'lan'       => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="2" width="6" height="4" rx="1"/><rect x="2" y="18" width="6" height="4" rx="1"/><rect x="16" y="18" width="6" height="4" rx="1"/><path d="M12 6v4M5 18v-3a3 3 0 0 1 3-3h8a3 3 0 0 1 3 3v3"/></svg>',
                    'converter' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v6m0 8v6M4.93 4.93l4.24 4.24m5.66 5.66 4.24 4.24M2 12h6m8 0h6M4.93 19.07l4.24-4.24m5.66-5.66 4.24-4.24"/></svg>',
                    'default'   => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>',
                ];
                $iconKey  = strtolower($barang->nama);
                $icon     = $icons[$iconKey] ?? $icons['default'];
                $maxStok  = 15;
                $persen   = min(round(($barang->stok_tersedia / $maxStok) * 100), 100);
                $kondisi  = $barang->kondisi->nama ?? $barang->kondisi ?? '-';
            @endphp

            <div class="card theme-{{ $theme }}">
                <div class="card-header">
                    <div class="card-icon">{!! $icon !!}</div>
                    <span class="card-badge-kondisi {{ $kondisi === 'Baik' ? 'badge-baik' : 'badge-rusak' }}">
                        @if($kondisi === 'Baik')
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        @endif
                        {{ $kondisi }}
                    </span>
                </div>

                <p class="card-name">{{ $barang->nama }}</p>
                <p class="card-kategori">{{ $barang->kategori ?? 'Umum' }}</p>

                <div class="stok-section">
                    <div class="stok-top">
                        <span class="stok-label">Stok tersedia</span>
                        <span class="stok-count">{{ $barang->stok_tersedia }}</span>
                    </div>
                    <div class="stok-bar">
                        <div class="stok-fill" style="width: {{ $persen }}%"></div>
                    </div>
                </div>

                <div class="card-meta">
                    <div class="meta-item">
                        <span class="meta-icon">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </span>
                        Lokasi: <span class="meta-val">{{ $barang->lokasi ?? '-' }}</span>
                    </div>
                </div>

                {{-- Tombol buka modal --}}
                <button type="button" class="btn-pinjam"
                    onclick="bukaModal({{ $barang->id }}, '{{ $barang->nama }}', {{ $barang->stok_tersedia }})">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                    Pinjam
                </button>
            </div>
        @empty
            <div class="empty">Tidak ada barang tersedia saat ini.</div>
        @endforelse
    </div>

    {{-- ── Banner Info & Pengumuman ── --}}
    <div class="banner-section">
        <p class="banner-section-title">Informasi &amp; Pengumuman</p>
        <div class="banner-grid">

            <div class="banner-main">
                <div class="banner-icon-wrap">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 0 1-7.743 5.743L10 14H7l-4 4V8a4 4 0 0 1 4-4h7a6 6 0 0 1 4 2z"/></svg>
                </div>
                <div class="banner-main-text">
                    <h3>Pengumuman Lab</h3>
                    <p>Peminjaman peralatan hanya dapat dilakukan pada jam operasional lab. Setiap peminjaman wajib mendapat persetujuan dari asisten laboratorium sebelum barang dapat diambil.</p>
                    <span class="banner-tag">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Diperbarui {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                    </span>
                </div>
            </div>

            <div class="banner-side">
                <div class="info-card">
                    <div class="info-icon info-icon-green">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="info-card-text">
                        <p>Jam Operasional</p>
                        <span>Senin – Jumat, 08.00 – 16.00</span>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-icon info-icon-amber">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <div class="info-card-text">
                        <p>Batas Peminjaman</p>
                        <span>Maksimal 3 hari per item</span>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-icon info-icon-blue">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.73a16 16 0 0 0 6 6l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <div class="info-card-text">
                        <p>Hubungi Aslab</p>
                        <span>ext. 1234 / Ruang Lab Lt. 2</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

{{-- ── Modal Pinjam ── --}}
<div class="modal-overlay" id="modalOverlay" onclick="tutupModalDiluar(event)">
    <div class="modal" id="modalBox">
        <div class="modal-header">
            <h2>Form Peminjaman</h2>
            <button class="modal-close" onclick="tutupModal()" aria-label="Tutup">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <div class="modal-info">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
            <span>Barang: <strong id="modalNamaBarang">-</strong></span>
        </div>

        <form method="POST" action="{{ route('mahasiswa.request') }}" id="formPinjam">
            @csrf
            <input type="hidden" name="id_barang" id="inputIdBarang">

            <div class="form-group">
                <label class="form-label" for="nim">NIM</label>
                <input type="text" name="nim" id="nim"
                    class="form-input" placeholder="Masukkan NIM kamu"
                    value="{{ auth()->user()->nim ?? old('nim') }}" required>
                @error('nim')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="tanggal_dipinjam">Tanggal Pinjam</label>
                <input type="date" name="tanggal_dipinjam" id="tanggal_dipinjam"
                    class="form-input" min="{{ date('Y-m-d') }}" required>
                @error('tanggal_dipinjam')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah"
                    class="form-input" min="1" value="1" required>
                @error('jumlah')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
                <button type="submit" class="btn-submit">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
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

    // Buka modal otomatis kalau ada error validasi
    @if($errors->any())
        bukaModal(
            '{{ old('id_barang') }}',
            'Barang yang dipilih',
            99
        );
    @endif
</script>

</body>
</html>
