@extends('mahasiswa.layout')

@section('content')
<style>
    @keyframes wave { 0%,100% { transform: rotate(0deg); } 25% { transform: rotate(18deg); } 75% { transform: rotate(-12deg); } }
    .wave-emoji { display: inline-block; animation: wave 1.8s ease-in-out infinite; transform-origin: 70% 70%; }

    .action-card {
        transition: transform .15s ease, box-shadow .15s ease;
    }
    .action-card:hover {
        transform: translate(-3px, -3px);
        box-shadow: 8px 8px 0 #1A1A1A !important;
        cursor: pointer;
    }

    .stat-card { transition: transform .15s ease; }
    .stat-card:hover { transform: translateY(-3px); }

    /* Override timing pt-fade-up khusus halaman ini biar lebih smooth */
    .pt-fade-up {
        will-change: opacity, transform;
        animation-delay: .15s;
    }
    .pt-delay-1 { animation-delay: .2s; }
    .pt-delay-2 { animation-delay: .26s; }
    .pt-delay-3 { animation-delay: .32s; }
    .pt-delay-4 { animation-delay: .38s; }
</style>

{{-- Hero banner --}}
<div class="card glass-card border-0 mb-4 pt-fade-up">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold mb-2" style="color:#1A1A1A;text-transform:uppercase;letter-spacing:-.5px">
                Halo, {{ auth()->user()->name ?? 'Mahasiswa' }}! <span class="wave-emoji">👋</span>
            </h3>
            <p class="mb-0" style="color:#666;font-weight:500;font-size:13px">Selamat datang di Portal Mahasiswa Peminjaman Lab</p>
        </div>
        <div style="width:50px;height:50px;background:#FFE34D;border:3px solid #1A1A1A;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:22px">
            🎓
        </div>
    </div>
</div>

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-md-3 pt-fade-up pt-delay-1">
        <div class="card glass-card border-0 h-100 stat-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="fw-bold mb-1" style="color:#1A1A1A">{{ $totalPeminjaman ?? 1 }}</h3>
                    <span class="small" style="color:#666;font-weight:600">Total Peminjaman</span>
                </div>
                <div style="width:38px;height:38px;border:2px solid #1A1A1A;border-radius:6px;background:#7CD9C2;display:flex;align-items:center;justify-content:center">
                    <i class="bi bi-collection" style="font-size:16px"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 pt-fade-up pt-delay-2">
        <div class="card glass-card border-0 h-100 stat-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="fw-bold mb-1" style="color:#1A1A1A">{{ $menungguApproval ?? 0 }}</h3>
                    <span class="small" style="color:#666;font-weight:600">Menunggu Approval</span>
                </div>
                <div style="width:38px;height:38px;border:2px solid #1A1A1A;border-radius:6px;background:#FFE34D;display:flex;align-items:center;justify-content:center">
                    <i class="bi bi-hourglass-split" style="font-size:16px"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 pt-fade-up pt-delay-3">
        <div class="card glass-card border-0 h-100 stat-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="fw-bold mb-1" style="color:#1A1A1A">{{ $sedangDipinjam ?? 0 }}</h3>
                    <span class="small" style="color:#666;font-weight:600">Sedang Dipinjam</span>
                </div>
                <div style="width:38px;height:38px;border:2px solid #1A1A1A;border-radius:6px;background:#9DC8FF;display:flex;align-items:center;justify-content:center">
                    <i class="bi bi-box-seam" style="font-size:16px"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 pt-fade-up pt-delay-4">
        <div class="card glass-card border-0 h-100 stat-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="fw-bold mb-1" style="color:#1A1A1A">{{ $selesai ?? 1 }}</h3>
                    <span class="small" style="color:#666;font-weight:600">Selesai</span>
                </div>
                <div style="width:38px;height:38px;border:2px solid #1A1A1A;border-radius:6px;background:#A8F0A8;display:flex;align-items:center;justify-content:center">
                    <i class="bi bi-check-circle" style="font-size:16px"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Action cards --}}
<div class="row g-3">
    <div class="col-md-6">
        <a href="{{ route('mahasiswa.barang') ?? '#' }}" class="text-decoration-none">
            <div class="card glass-card border-0 h-100 action-card">
                <div class="card-body p-4 d-flex align-items-center">
                    <div style="width:46px;height:46px;border:3px solid #1A1A1A;border-radius:8px;background:#9DC8FF;display:flex;align-items:center;justify-content:center;flex-shrink:0" class="me-3">
                        <i class="bi bi-cart-plus" style="font-size:20px;color:#1A1A1A"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fw-bold mb-1" style="color:#1A1A1A;text-transform:uppercase;font-size:14px">Mulai Pinjam Alat</h5>
                        <span class="small" style="color:#666;font-weight:500">Lihat dan request alat lab yang tersedia</span>
                    </div>
                    <div style="font-size:18px;color:#1A1A1A;font-weight:900">→</div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-6">
        <a href="{{ route('mahasiswa.riwayat') ?? '#' }}" class="text-decoration-none">
            <div class="card glass-card border-0 h-100 action-card">
                <div class="card-body p-4 d-flex align-items-center">
                    <div style="width:46px;height:46px;border:3px solid #1A1A1A;border-radius:8px;background:#7CD9C2;display:flex;align-items:center;justify-content:center;flex-shrink:0" class="me-3">
                        <i class="bi bi-file-earmark-text" style="font-size:20px;color:#1A1A1A"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="fw-bold mb-1" style="color:#1A1A1A;text-transform:uppercase;font-size:14px">Cek Status Peminjaman</h5>
                        <span class="small" style="color:#666;font-weight:500">Pantau status approval & pengembalian</span>
                    </div>
                    <div style="font-size:18px;color:#1A1A1A;font-weight:900">→</div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
