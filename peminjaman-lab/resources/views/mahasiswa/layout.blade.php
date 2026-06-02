<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Mahasiswa - Peminjaman Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background-color: #0d6efd;
            padding-top: 20px;
        }
        .sidebar a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            border-radius: 6px;
            margin: 2px 10px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: rgba(255,255,255,0.2);
            color: white;
        }
        .sidebar .brand {
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.3);
            margin-bottom: 10px;
        }
        .main-content { padding: 30px; }
        .topbar {
            background: white;
            padding: 12px 24px;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar" style="width: 240px; min-width: 240px;">
        <div class="brand">
            <i class="bi bi-mortarboard"></i> Portal Mahasiswa
        </div>
        <a href="{{ route('mahasiswa.dashboard') }}" class="{{ request()->is('mahasiswa/dashboard') ? 'active' : '' }}">
            <i class="bi bi-house"></i> Dashboard
        </a>
        <a href="{{ route('mahasiswa.barang') }}" class="{{ request()->is('mahasiswa/barang') ? 'active' : '' }}">
            <i class="bi bi-archive"></i> Pinjam Barang
        </a>
        <a href="{{ route('mahasiswa.riwayat') }}" class="{{ request()->is('mahasiswa/riwayat') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Riwayat
        </a>
    </div>

    <div class="flex-grow-1">
        <div class="topbar">
            <span class="me-3">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>

        <div class="main-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
