<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Lab</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sidebar-w: 220px;
            --navy: #0F172A;
            --navy-2: #1E293B;
            --navy-3: #293548;
            --accent: #3B82F6;
            --accent-2: #60A5FA;
            --accent-glow: rgba(59,130,246,.18);
            --text-1: #F1F5F9;
            --text-2: #94A3B8;
            --text-3: #64748B;
            --surface: #FFFFFF;
            --bg: #F0F4FA;
            --border: #E2E8F0;
            --green: #10B981;
            --amber: #F59E0B;
            --red: #EF4444;
            --radius: 12px;
            --radius-sm: 8px;
            --shadow: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
            --shadow-md: 0 4px 16px rgba(0,0,0,.08);
        }

        body {
            font-family: 'Sora', sans-serif;
            background: var(--bg);
            color: #1E293B;
            min-height: 100vh;
            display: flex;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            min-width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--navy);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            overflow: hidden;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
            background-size: 24px 24px;
            pointer-events: none;
        }

        .sidebar-brand {
            padding: 22px 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,.06);
            margin-bottom: 8px;
            position: relative;
        }
        .sidebar-brand-dot {
            width: 28px; height: 28px;
            border-radius: 8px;
            background: var(--accent);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 10px;
            box-shadow: 0 0 16px var(--accent-glow);
        }
        .sidebar-brand-dot i { color: white; font-size: 14px; }
        .sidebar-brand-name {
            font-size: 13px; font-weight: 600;
            color: var(--text-1);
            letter-spacing: .01em;
        }
        .sidebar-brand-sub {
            font-size: 10px; font-weight: 400;
            color: var(--text-3);
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-top: 2px;
        }

        .sidebar-section {
            padding: 0 12px;
            margin-bottom: 4px;
        }
        .sidebar-label {
            font-size: 9px; font-weight: 600;
            color: var(--text-3);
            text-transform: uppercase;
            letter-spacing: .1em;
            padding: 12px 8px 6px;
        }

        .nav-item {
            display: flex; align-items: center; gap: 9px;
            padding: 9px 10px;
            border-radius: var(--radius-sm);
            color: var(--text-2);
            text-decoration: none;
            font-size: 13px; font-weight: 500;
            transition: background .15s, color .15s;
            position: relative;
            margin-bottom: 1px;
        }
        .nav-item i {
            width: 18px; text-align: center;
            font-size: 15px; flex-shrink: 0;
        }
        .nav-item:hover {
            background: rgba(255,255,255,.06);
            color: var(--text-1);
        }
        .nav-item.active {
            background: var(--accent-glow);
            color: var(--accent-2);
        }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 6px; bottom: 6px;
            width: 3px; border-radius: 99px;
            background: var(--accent);
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,.06);
        }
        .sidebar-user {
            display: flex; align-items: center; gap: 10px;
            padding: 8px;
            border-radius: var(--radius-sm);
        }
        .user-avatar {
            width: 30px; height: 30px; border-radius: 8px;
            background: var(--accent);
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 600; color: white;
            flex-shrink: 0;
        }
        .user-name { font-size: 12px; font-weight: 500; color: var(--text-1); }
        .user-role { font-size: 10px; color: var(--text-3); margin-top: 1px; }

        /* ── Main ── */
        .main-wrap { margin-left: var(--sidebar-w); flex: 1; min-width: 0; display: flex; flex-direction: column; min-height: 100vh; }

        /* topbar */
        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            height: 52px;
            padding: 0 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }
        .topbar-left {
            font-size: 13px; color: var(--text-3);
            display: flex; align-items: center; gap: 6px;
        }
        .topbar-left i { font-size: 12px; }
        .topbar-right { display: flex; align-items: center; gap: 10px; }
        .topbar-username {
            font-size: 13px; font-weight: 500; color: #1E293B;
        }
        .btn-logout {
            font-family: 'Sora', sans-serif;
            font-size: 12px; font-weight: 500;
            color: var(--red); background: transparent;
            border: 1px solid #FECACA; border-radius: var(--radius-sm);
            padding: 5px 12px; cursor: pointer;
            display: flex; align-items: center; gap: 5px;
            transition: background .15s;
        }
        .btn-logout:hover { background: #FEF2F2; }

        /* content pembungkus ditingkatkan jadi container-fluid */
        .main-content { padding: 28px; flex: 1; }

        /* ── Alert ── */
        .alert-success-custom {
            background: #F0FDF4; color: #15803D;
            border: 1px solid #BBF7D0; border-radius: var(--radius);
            padding: 11px 16px; font-size: 13px; font-weight: 500;
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 20px;
        }

        /* ── Override Bootstrap table ── */
        .table { font-size: 13px; font-family: 'Sora', sans-serif; }
        .table thead th {
            font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: .05em;
            color: #64748B; background: #F8FAFC !important;
            border-bottom: 1px solid var(--border) !important;
            border-top: none; padding: 10px 14px;
        }
        .table tbody td {
            padding: 11px 14px; vertical-align: middle;
            border-color: var(--border); color: #334155;
            font-size: 13px;
        }
        .table tbody tr:hover td { background: #F8FAFC; }
        .table-bordered { border: 1px solid var(--border) !important; border-radius: var(--radius); overflow: hidden; }
        .table-bordered td, .table-bordered th { border-color: var(--border) !important; }

        /* ── Buttons override ── */
        .btn { font-family: 'Sora', sans-serif; font-size: 12px; font-weight: 500; border-radius: var(--radius-sm); }
        .btn-primary { background: var(--accent); border-color: var(--accent); }
        .btn-primary:hover { background: #2563EB; border-color: #2563EB; }
        .btn-sm { padding: 4px 10px; font-size: 11px; }

        /* ── Page header ── */
        .page-title {
            font-size: 18px; font-weight: 600; color: #0F172A;
            margin-bottom: 4px;
        }
        .page-subtitle { font-size: 13px; color: var(--text-3); margin-bottom: 20px; }

        /* ── Form controls override ── */
        .form-control, .form-select {
            font-family: 'Sora', sans-serif;
            font-size: 13px;
            border-color: var(--border);
            border-radius: var(--radius-sm);
            padding: 8px 12px;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }
        .form-label { font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 5px; }

        /* card */
        .card {
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }
        .card-body { padding: 20px; }
    </style>
</head>
<body>

{{-- ── Sidebar ── --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-dot"><i class="bi bi-boxes"></i></div>
        <div class="sidebar-brand-name">Inventaris Lab</div>
        <div class="sidebar-brand-sub">Management System</div>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Menu</div>

        @php $role = auth()->user()->role?->nama; @endphp

        @if($role === 'mahasiswa')
            <a href="{{ route('mahasiswa.dashboard') }}"
               class="nav-item {{ request()->is('mahasiswa/dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> Dashboard
            </a>
            <a href="{{ route('mahasiswa.barang') }}"
               class="nav-item {{ request()->is('mahasiswa/barang') ? 'active' : '' }}">
                <i class="bi bi-archive"></i> Pinjam Barang
            </a>
            <a href="{{ route('mahasiswa.riwayat') }}"
               class="nav-item {{ request()->is('mahasiswa/riwayat') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i> Riwayat
            </a>
        @else
            <a href="{{ route('barang.index') }}"
               class="nav-item {{ request()->is('barang*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Barang
            </a>
            <a href="{{ route('transaksi.index') }}"
               class="nav-item {{ request()->is('transaksi*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i> Transaksi
            </a>
            @if($role === 'kalab')
                <a href="{{ route('users.index') }}"
                   class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Pengguna
                </a>
            @endif
        @endif
    </div>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">{{ ucfirst($role ?? 'User') }}</div>
            </div>
        </div>
    </div>
</aside>

{{-- ── Main ── --}}
<div class="main-wrap">
    <header class="topbar">
        <div class="topbar-left">
            <i class="bi bi-circle-fill" style="color:#10B981;font-size:7px"></i>
            System Online
        </div>
        <div class="topbar-right">
            <span class="topbar-username">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </header>

    <div class="main-content container-fluid">
        @if(session('success'))
            <div class="alert-success-custom">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
