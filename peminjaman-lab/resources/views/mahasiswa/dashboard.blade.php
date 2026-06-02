@extends('mahasiswa.layout')

@section('content')

@php
    $user = auth()->user();
    $peminjam = \App\Models\Peminjam::where('id_user', $user->id)->first();
    $totalPeminjaman = $peminjam ? \App\Models\Transaksi::where('id_peminjam', $peminjam->id)->count() : 0;
    $sedangDipinjam = $peminjam ? \App\Models\Transaksi::where('id_peminjam', $peminjam->id)->whereHas('status', fn($q) => $q->where('nama', 'Dipinjam'))->count() : 0;
    $menunggu = $peminjam ? \App\Models\Transaksi::where('id_peminjam', $peminjam->id)->whereHas('status', fn($q) => $q->where('nama', 'Menunggu Approval'))->count() : 0;
    $selesai = $peminjam ? \App\Models\Transaksi::where('id_peminjam', $peminjam->id)->whereHas('status', fn($q) => $q->where('nama', 'Selesai'))->count() : 0;
@endphp

<!-- Sambutan -->
<div style="background: linear-gradient(135deg, #0d6efd, #0056b3); border-radius: 16px; padding: 28px 32px; color: white; margin-bottom: 28px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h4 style="font-weight: 700; margin-bottom: 4px;">Halo, {{ $user->name }}! 👋</h4>
        <p style="opacity: 0.85; margin: 0; font-size: 14px;">Selamat datang di Portal Mahasiswa Peminjaman Lab</p>
    </div>
    <div style="font-size: 48px;">🎓</div>
</div>

<!-- Kartu Statistik -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-left: 4px solid #0d6efd;">
            <div style="font-size: 28px; font-weight: 700; color: #0d6efd;">{{ $totalPeminjaman }}</div>
            <div style="font-size: 13px; color: #6c757d; margin-top: 4px;">Total Peminjaman</div>
            <div style="font-size: 24px; margin-top: 8px;">📋</div>
        </div>
    </div>
    <div class="col-md-3">
        <div style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-left: 4px solid #ffc107;">
            <div style="font-size: 28px; font-weight: 700; color: #ffc107;">{{ $menunggu }}</div>
            <div style="font-size: 13px; color: #6c757d; margin-top: 4px;">Menunggu Approval</div>
            <div style="font-size: 24px; margin-top: 8px;">⏳</div>
        </div>
    </div>
    <div class="col-md-3">
        <div style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-left: 4px solid #0dcaf0;">
            <div style="font-size: 28px; font-weight: 700; color: #0dcaf0;">{{ $sedangDipinjam }}</div>
            <div style="font-size: 13px; color: #6c757d; margin-top: 4px;">Sedang Dipinjam</div>
            <div style="font-size: 24px; margin-top: 8px;">🔬</div>
        </div>
    </div>
    <div class="col-md-3">
        <div style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-left: 4px solid #198754;">
            <div style="font-size: 28px; font-weight: 700; color: #198754;">{{ $selesai }}</div>
            <div style="font-size: 13px; color: #6c757d; margin-top: 4px;">Selesai</div>
            <div style="font-size: 24px; margin-top: 8px;">✅</div>
        </div>
    </div>
</div>

<!-- Shortcut Menu -->
<div class="row g-3">
    <div class="col-md-6">
        <a href="{{ route('mahasiswa.barang') }}" style="text-decoration: none;">
            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); display: flex; align-items: center; gap: 16px; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,0.12)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 12px rgba(0,0,0,0.08)'">
                <div style="background: #e8f0fe; border-radius: 12px; padding: 14px; font-size: 28px;">🔭</div>
                <div>
                    <div style="font-weight: 700; color: #1e3a5f; font-size: 15px;">Pinjam Barang</div>
                    <div style="font-size: 13px; color: #6c757d; margin-top: 2px;">Lihat dan request barang tersedia</div>
                </div>
                <div style="margin-left: auto; color: #0d6efd; font-size: 20px;">→</div>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="{{ route('mahasiswa.riwayat') }}" style="text-decoration: none;">
            <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); display: flex; align-items: center; gap: 16px; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,0.12)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 12px rgba(0,0,0,0.08)'">
                <div style="background: #e8f0fe; border-radius: 12px; padding: 14px; font-size: 28px;">📋</div>
                <div>
                    <div style="font-weight: 700; color: #1e3a5f; font-size: 15px;">Riwayat Peminjaman</div>
                    <div style="font-size: 13px; color: #6c757d; margin-top: 2px;">Lihat status peminjaman kamu</div>
                </div>
                <div style="margin-left: auto; color: #0d6efd; font-size: 20px;">→</div>
            </div>
        </a>
    </div>
</div>

@endsection
