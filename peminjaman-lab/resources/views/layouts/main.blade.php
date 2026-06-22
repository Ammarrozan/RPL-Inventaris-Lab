<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        @keyframes popIn  { 0% { transform: scale(0) rotate(-6deg); } 70% { transform: scale(1.05); } 100% { transform: scale(1); } }
        @keyframes bounce { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-6px); } }

        :root { --sidebar-w: 210px; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #FAFAF7;
            color: #1A1A1A;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            min-width: var(--sidebar-w);
            min-height: 100vh;
            background: #1A1A1A;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
        }

        .sidebar-brand { padding: 20px 18px; border-bottom: 2px solid #333; }
        .sidebar-brand-icon {
            width: 30px; height: 30px;
            background: #FFE34D; border: 2px solid #1A1A1A;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 8px;
        }
        .sidebar-brand-icon i { font-size: 14px; color: #1A1A1A; }
        .sidebar-brand-name { color: #fff; font-weight: 900; font-size: 13px; text-transform: uppercase; letter-spacing: -.3px; }
        .sidebar-brand-sub { color: #888; font-size: 9px; text-transform: uppercase; letter-spacing: 1px; margin-top: 2px; }

        .sidebar-label { color: #777; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; padding: 16px 18px 8px; }

        .sidebar-profile {
            display: flex; align-items: center; gap: 10px;
            padding: 16px 18px;
            border-bottom: 2px solid #333;
        }
        .sb-avatar {
            width: 34px; height: 34px; border-radius: 6px;
            background: #FFE34D; border: 2px solid #fff;
            display: flex; align-items: center; justify-content: center;
            font-weight: 900; color: #1A1A1A; font-size: 13px;
            flex-shrink: 0;
        }
        .sb-uname { color: #fff; font-weight: 800; font-size: 12px; }
        .sb-urole { color: #888; font-size: 10px; }

        .nav-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 14px; margin: 0 10px 4px;
            border-radius: 6px;
            color: #ccc; text-decoration: none;
            font-size: 13px; font-weight: 700;
            transition: background .15s, color .15s;
        }
        .nav-item i { font-size: 15px; width: 18px; text-align: center; }
        .nav-item:hover { background: rgba(255,255,255,.08); color: #fff; }
        .nav-item.active { background: #FFE34D; color: #1A1A1A; }

        .sidebar-footer {
            margin-top: auto; padding: 14px 18px;
            border-top: 2px solid #333;
        }
        .sidebar-logout-btn {
            width: 100%;
            background: transparent; border: none;
            color: #FF9D9D; font-family: inherit;
            font-size: 13px; font-weight: 700;
            padding: 10px 12px; border-radius: 6px;
            display: flex; align-items: center; gap: 10px;
            cursor: pointer; transition: background .15s;
        }
        .sidebar-logout-btn i { font-size: 16px; width: 18px; text-align: center; }
        .sidebar-logout-btn:hover { background: rgba(255,77,77,.15); }

        /* ── Main ── */
        .main-wrap { margin-left: var(--sidebar-w); flex: 1; min-width: 0; display: flex; flex-direction: column; min-height: 100vh; }

        .topbar {
            background: #fff;
            border-bottom: 3px solid #1A1A1A;
            height: 56px;
            padding: 0 28px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }
        .topbar-left { font-size: 12px; color: #666; font-weight: 600; display: flex; align-items: center; gap: 6px; }
        .tb-dot { width: 7px; height: 7px; border-radius: 50%; background: #7CD9C2; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .topbar-username { font-size: 13px; font-weight: 700; color: #1A1A1A; }
        .btn-logout {
            font-family: inherit; font-size: 11px; font-weight: 800;
            color: #FF4D4D; background: #fff;
            border: 2px solid #1A1A1A; border-radius: 6px;
            padding: 6px 14px; cursor: pointer;
            box-shadow: 3px 3px 0 #1A1A1A;
            display: flex; align-items: center; gap: 5px;
            transition: transform .1s, box-shadow .1s;
        }
        .btn-logout:hover { transform: translate(-1px,-1px); box-shadow: 4px 4px 0 #1A1A1A; }

        .main-content { padding: 24px 28px; flex: 1; min-width: 0; }

        .alert-success-custom {
            background: #7CD9C2; border: 3px solid #1A1A1A; border-radius: 8px;
            padding: 11px 16px; font-size: 13px; font-weight: 700;
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 20px;
            box-shadow: 4px 4px 0 #1A1A1A;
        }

        .alert-error-custom {
            background: #FF9D9D; border: 3px solid #1A1A1A; border-radius: 8px;
            padding: 11px 16px; font-size: 13px; font-weight: 700;
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 20px;
            box-shadow: 4px 4px 0 #1A1A1A;
        }

        /* ── Page header ── */
        .page-title { font-size: 22px; font-weight: 900; color: #1A1A1A; text-transform: uppercase; letter-spacing: -.5px; }
        .page-subtitle { font-size: 12px; color: #666; font-weight: 600; margin-top: 2px; }

        /* ── Stats card ── */
        .stat-card {
            background: #fff; border: 3px solid #1A1A1A; border-radius: 8px;
            box-shadow: 4px 4px 0 #1A1A1A;
            padding: 16px 18px;
            display: flex; align-items: center; gap: 12px;
            animation: popIn .4s ease both;
        }
        .stat-icon {
            width: 38px; height: 38px;
            border: 2px solid #1A1A1A; border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; flex-shrink: 0;
        }
        .stat-num { font-size: 22px; font-weight: 900; color: #1A1A1A; line-height: 1; }
        .stat-label { font-size: 10px; color: #666; font-weight: 700; margin-top: 2px; }

        /* ── Bootstrap overrides ── */
        .table { font-size: 12px; font-family: inherit; }
        .table thead th {
            background: #1A1A1A !important; color: #FFE34D !important;
            font-size: 10px; font-weight: 800;
            text-transform: uppercase; letter-spacing: .5px;
            padding: 11px 14px; border: none !important;
        }
        .table tbody td { padding: 11px 14px; vertical-align: middle; border-bottom: 2px solid #F0EFEA; color: #333; font-weight: 600; border-top: none !important; }
        .table-bordered { border: 3px solid #1A1A1A !important; border-radius: 8px; overflow: hidden; box-shadow: 5px 5px 0 #1A1A1A; }
        .table-bordered td, .table-bordered th { border-color: #F0EFEA !important; }

        .btn { font-family: inherit; font-size: 11px; font-weight: 800; border-radius: 6px; text-transform: uppercase; }
        .btn-primary { background: #1A1A1A; color: #FFE34D !important; border: 3px solid #1A1A1A; box-shadow: 4px 4px 0 #FF4D4D; }
        .btn-primary:hover { background: #1A1A1A; transform: translate(-1px,-1px); box-shadow: 5px 5px 0 #FF4D4D; }
        .btn-warning { background: #FFE34D; color: #1A1A1A !important; border: 2px solid #1A1A1A; box-shadow: 2px 2px 0 #1A1A1A; }
        .btn-danger { background: #FF9D9D; color: #1A1A1A !important; border: 2px solid #1A1A1A; box-shadow: 2px 2px 0 #1A1A1A; }
        .btn-success { background: #A8F0A8; color: #1A1A1A !important; border: 2px solid #1A1A1A; box-shadow: 2px 2px 0 #1A1A1A; }
        .btn-info { background: #9DC8FF; color: #1A1A1A !important; border: 2px solid #1A1A1A; box-shadow: 2px 2px 0 #1A1A1A; }
        .btn-sm { padding: 4px 10px; font-size: 10px; }

        .form-control, .form-select {
            font-family: inherit; font-size: 13px;
            border: 3px solid #1A1A1A; border-radius: 6px;
            padding: 9px 12px;
        }
        .form-control:focus, .form-select:focus { border-color: #1A1A1A; box-shadow: 3px 3px 0 #1A1A1A; }
        .form-label { font-size: 11px; font-weight: 800; color: #1A1A1A; text-transform: uppercase; margin-bottom: 5px; }

        .card { border: 3px solid #1A1A1A; border-radius: 8px; box-shadow: 5px 5px 0 #1A1A1A; }
        .card-body { padding: 20px; }
    </style>
</head>
<body class="d-flex">

{{-- ── Sidebar ── --}}
<aside class="sidebar">
    <div class="sidebar-brand">

        <div class="sidebar-brand-name"></div>
        <div class="sidebar-brand-sub"></div>
    </div>

    @php $role = auth()->user()->role?->nama; @endphp

    <div class="sidebar-profile">
        <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <div>
            <div class="sb-uname">{{ auth()->user()->name }}</div>
            <div class="sb-urole">{{ ucfirst($role ?? 'User') }}</div>
        </div>
    </div>

    <div class="sidebar-label">Menu</div>

    @if(strtolower($role ?? '') === 'mahasiswa')
        <a href="{{ route('mahasiswa.dashboard') }}" class="nav-item {{ request()->is('mahasiswa/dashboard') ? 'active' : '' }}"><i class="bi bi-grid"></i> Dashboard</a>
        <a href="{{ route('mahasiswa.barang') }}" class="nav-item {{ request()->is('mahasiswa/barang') ? 'active' : '' }}"><i class="bi bi-archive"></i> Pinjam Barang</a>
        <a href="{{ route('mahasiswa.riwayat') }}" class="nav-item {{ request()->is('mahasiswa/riwayat') ? 'active' : '' }}"><i class="bi bi-clock-history"></i> Riwayat</a>
    @else
        <a href="{{ route('barang.index') }}" class="nav-item {{ request()->is('barang*') ? 'active' : '' }}"><i class="bi bi-box-seam"></i> Barang</a>
        <a href="{{ route('transaksi.index') }}" class="nav-item {{ request()->is('transaksi*') ? 'active' : '' }}"><i class="bi bi-arrow-left-right"></i> Transaksi</a>
        @if(strtolower($role ?? '') === 'kalab')
            <a href="{{ route('users.index') }}" class="nav-item {{ request()->is('users*') ? 'active' : '' }}"><i class="bi bi-people"></i> Pengguna</a>
        @endif
    @endif

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-logout-btn">
                <i class="bi bi-box-arrow-right"></i> <span>Log Out</span>
            </button>
        </form>
    </div>
</aside>

{{-- ── Main ── --}}
<div class="main-wrap">
    <header class="topbar">
        <div class="topbar-left"><div class="tb-dot"></div> System Online</div>
        <div class="topbar-right">
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf

            </form>
        </div>
    </header>

    <div class="main-content">
        @if(session('success'))
            <div class="alert-success-custom">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-error-custom">
                <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<div id="page-transition-overlay"></div>

<style>
    #page-transition-overlay {
        position: fixed; inset: 0; background: #1A1A1A; z-index: 9999;
        transform: translateY(100%); pointer-events: none;
    }
    #page-transition-overlay.enter { animation: slideUpReveal 0.5s cubic-bezier(.65,0,.35,1) forwards; }
    #page-transition-overlay.leave { animation: slideUpCover 0.4s cubic-bezier(.65,0,.35,1) forwards; pointer-events: all; }
    @keyframes slideUpCover  { from { transform: translateY(100%); } to { transform: translateY(0%); } }
    @keyframes slideUpReveal { from { transform: translateY(0%); } to { transform: translateY(-100%); } }

    .pt-fade-up { opacity: 0; transform: translateY(24px); animation: ptFadeUp 0.6s cubic-bezier(.2,.8,.2,1) forwards; }
    @keyframes ptFadeUp { to { opacity: 1; transform: translateY(0); } }
    .pt-delay-1 { animation-delay: .05s; }
    .pt-delay-2 { animation-delay: .12s; }
    .pt-delay-3 { animation-delay: .2s; }
    .pt-delay-4 { animation-delay: .28s; }
</style>

<script>
(function () {
    var overlay = document.getElementById('page-transition-overlay');
    overlay.classList.add('enter');
    overlay.addEventListener('animationend', function () {
        overlay.classList.remove('enter');
        overlay.style.transform = 'translateY(100%)';
    }, { once: true });

    document.addEventListener('click', function (e) {
        var link = e.target.closest('a');
        if (!link) return;
        if (link.target === '_blank') return;
        if (link.hasAttribute('download')) return;
        var href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('javascript:')) return;
        if (link.origin && link.origin !== window.location.origin) return;

        e.preventDefault();
        overlay.style.transform = 'translateY(100%)';
        overlay.classList.add('leave');
        setTimeout(function () { window.location.href = href; }, 380);
    });

    document.addEventListener('submit', function (e) {
        var form = e.target;
        if (form.hasAttribute('data-no-transition')) return;
        e.preventDefault();
        overlay.style.transform = 'translateY(100%)';
        overlay.classList.add('leave');
        setTimeout(function () { form.submit(); }, 380);
    });
})();
</script>


</body>
</html>
