<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Peminjaman Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background-color: #212529;
            padding-top: 20px;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            border-radius: 6px;
            margin: 2px 10px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #0d6efd;
            color: white;
        }
        .sidebar .brand {
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px 20px;
            border-bottom: 1px solid #444;
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
    <!-- Sidebar -->
    <!-- Sidebar -->
<div class="sidebar" style="width: 240px; min-width: 240px;">
    <div class="brand">
        <i class="bi bi-box-seam"></i> Peminjaman Lab
        <br>
    <small style="font-size: 11px; opacity: 0.7;">
        @php $role = auth()->user()->role?->nama; @endphp
        @if($role === 'kalab')
            <i class="bi bi-shield-fill-check"></i> Kepala Lab
        @elseif($role === 'aslab')
            <i class="bi bi-person-badge"></i> Asisten Lab
        @elseif($role === 'operator')
            <i class="bi bi-gear"></i> Operator
        @else
            <i class="bi bi-person"></i> Admin
        @endif
    </small>
    </div>

    @if(auth()->user()->role && in_array(auth()->user()->role->nama, ['aslab', 'kalab']))
    <a href="{{ route('barang.index') }}" class="{{ request()->is('barang*') ? 'active' : '' }}">
        <i class="bi bi-archive"></i> Barang
    </a>
    {{-- <a href="{{ route('peminjam.index') }}" class="{{ request()->is('peminjam*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Peminjam
    </a> --}}
    @endif

    <a href="{{ route('transaksi.index') }}" class="{{ request()->is('transaksi*') ? 'active' : '' }}">
        <i class="bi bi-arrow-left-right"></i> Transaksi
    </a>

    @if(auth()->user()->role && auth()->user()->role->nama === 'kalab')
    <a href="{{ route('users.index') }}" class="{{ request()->is('users*') ? 'active' : '' }}">
        <i class="bi bi-person-gear"></i> Users
    </a>
    @endif
</div>
    <!-- Main -->
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
