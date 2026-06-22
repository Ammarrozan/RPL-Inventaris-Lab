<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Mahasiswa - Peminjaman Lab</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        * { box-sizing: border-box; }

        body {
            background: #E8E6DD;
            color: #1A1A1A;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* card umum mono-pop */
        .glass-card {
            background: #fff !important;
            border: 3px solid #1A1A1A !important;
            border-radius: 8px !important;
            box-shadow: 5px 5px 0 #1A1A1A !important;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            background: #1A1A1A;
            border-right: 3px solid #1A1A1A;
            padding: 20px;
            z-index: 1050; /* Naikkan z-index biar di atas elemen lain pas di HP */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: width 0.3s ease, padding 0.3s ease, left 0.3s ease;
        }

        .sidebar-title {
            color: #FFE34D;
            font-weight: 900;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: -.5px;
            margin-bottom: 20px;
            white-space: nowrap;
            padding-bottom: 16px;
            border-bottom: 2px solid #333;
        }

        .profile-section {
            display: flex;
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #333;
            margin-bottom: 15px;
            white-space: nowrap;
        }

        .profile-icon {
            width: 38px; height: 38px;
            background: #FFE34D;
            border: 2px solid #fff;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 900; color: #1A1A1A;
            flex-shrink: 0;
        }

        .menu-label {
            font-size: 0.7rem;
            font-weight: 800;
            color: #777;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 8px;
            margin-top: 10px;
            padding-left: 5px;
            white-space: nowrap;
        }

        .nav-link {
            color: #ccc;
            border-radius: 6px;
            padding: 11px 14px;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 13px;
            transition: all .15s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
            white-space: nowrap;
            overflow: hidden;
        }

        .nav-link i { font-size: 1.05rem; width: 22px; text-align: center; margin-right: 10px; }

        .nav-link:hover { background: rgba(255,255,255,.08); color: #fff; }

        .nav-link.active {
            background: #FFE34D;
            color: #1A1A1A;
            font-weight: 800;
        }

        .logout-btn {
            color: #FF9D9D;
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            padding: 11px 14px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 13px;
            display: flex;
            align-items: center;
            transition: all .15s ease;
            white-space: nowrap;
        }

        .logout-btn:hover { background: rgba(255,77,77,.15); }
        .logout-btn i { font-size: 1.05rem; width: 22px; text-align: center; margin-right: 10px; }

        /* collapsed state (Desktop Only) */
        .sidebar.collapsed { width: 76px; padding: 20px 10px; }
        .sidebar.collapsed .sidebar-title,
        .sidebar.collapsed .profile-details,
        .sidebar.collapsed .menu-text,
        .sidebar.collapsed .menu-label-text,
        .sidebar.collapsed .logout-text { opacity: 0; display: none; }
        .sidebar.collapsed .profile-icon { margin: 0 auto; }
        .sidebar.collapsed .nav-link,
        .sidebar.collapsed .logout-btn { justify-content: center; padding: 11px 0; }
        .sidebar.collapsed .nav-link i,
        .sidebar.collapsed .logout-btn i { margin-right: 0; }
        .sidebar.collapsed .menu-label { text-align: center; padding-left: 0; }
        .sidebar.collapsed .menu-label::after { content: '...'; }

        /* --- MAIN WRAPPER --- */
        .main-wrapper {
            margin-left: 250px;
            padding: 24px 36px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        .main-wrapper.expanded { margin-left: 76px; }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 14px;
            margin-bottom: 24px;
            border-bottom: 3px solid #1A1A1A;
        }

        .toggle-btn {
            background: #fff;
            border: 3px solid #1A1A1A;
            color: #1A1A1A;
            padding: 7px 12px;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 3px 3px 0 #1A1A1A;
            transition: transform .1s, box-shadow .1s;
        }
        .toggle-btn:hover { transform: translate(-1px,-1px); box-shadow: 4px 4px 0 #1A1A1A; }

        /* ============================================================
           🔥 UPDATE REKAYASA RESPONSIVE (HP & TABLET)
           ============================================================ */
        @media (max-width: 768px) {
            /* Sembunyikan penuh sidebar ke kiri luar layar */
            .sidebar {
                left: -260px;
                width: 250px !important;
                padding: 20px;
                box-shadow: 5px 0 0 #1A1A1A; /* Shadow pop tebal khas lu */
            }

            /* Tampilkan tulisan/elemen sidebar secara normal saat laci terbuka di HP */
            .sidebar .sidebar-title,
            .sidebar .profile-details,
            .sidebar .menu-text,
            .sidebar .menu-label-text,
            .sidebar .logout-text {
                opacity: 1 !important;
                display: block !important;
            }
            .sidebar .profile-section { display: flex !important; }
            .sidebar .nav-link, .sidebar .logout-btn { justify-content: flex-start; padding: 11px 14px; }
            .sidebar .nav-link i, .sidebar .logout-btn i { margin-right: 10px; }
            .sidebar .menu-label { text-align: left; padding-left: 5px; }

            /* Class pemicu geser masuk pas tombol hamburger di-klik */
            .sidebar.show-mobile {
                left: 0 !important;
            }

            /* Konten utama penuhin layar penuh di HP */
            .main-wrapper {
                margin-left: 0 !important;
                padding: 20px 16px;
            }
            .main-wrapper.expanded { margin-left: 0 !important; }
        }
    </style>
</head>
<body>

    <div class="sidebar" id="sidebar">
        <div>
            <div class="sidebar-title">Portal Mhs</div>

            <div class="profile-section">
                <div class="profile-icon"><i class="bi bi-person-fill"></i></div>
                <div class="profile-details ms-3">
                    <div class="fw-bold" style="color:#fff">{{ auth()->user()->name ?? 'Mahasiswa' }}</div>
                    <div class="small" style="color:#999;font-size:.75rem">Mahasiswa</div>
                </div>
            </div>

            <div class="menu-label"><span class="menu-label-text">Menu</span></div>

            <ul class="nav flex-column mt-2" style="list-style:none;padding:0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('mahasiswa/dashboard*') ? 'active' : '' }}" href="/mahasiswa/dashboard">
                        <i class="bi bi-house-door"></i> <span class="menu-text">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('mahasiswa/barang*') ? 'active' : '' }}" href="/mahasiswa/barang">
                        <i class="bi bi-plus-circle"></i> <span class="menu-text">Pinjam Alat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('mahasiswa/riwayat*') ? 'active' : '' }}" href="/mahasiswa/riwayat">
                        <i class="bi bi-chat-square-text"></i> <span class="menu-text">Riwayat</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <hr style="border-color:#333;margin-bottom:10px">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> <span class="logout-text">Log Out</span>
                </button>
            </form>
        </div>
    </div>

    <div class="main-wrapper" id="mainWrapper">
        <div class="topbar">
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="bi bi-list fs-5"></i>
            </button>
            <div></div>
        </div>

        @if(session('success'))
            <div style="background:#7CD9C2;border:3px solid #1A1A1A;border-radius:8px;padding:12px 16px;font-size:13px;font-weight:700;margin-bottom:20px;box-shadow:4px 4px 0 #1A1A1A">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            if (window.innerWidth <= 768) {
                // JIKA DI HP: Slide laci masuk & keluar luar layar
                document.getElementById('sidebar').classList.toggle('show-mobile');
            } else {
                // JIKA DI DESKTOP: Mengecilkan sidebar jadi icon (Fitur lama lu)
                document.getElementById('sidebar').classList.toggle('collapsed');
                document.getElementById('mainWrapper').classList.toggle('expanded');
            }
        }
    </script>

    {{-- ============================================================
     PAGE TRANSITION SNIPPET
     ============================================================ --}}
    <div id="page-transition-overlay"></div>

    <style>
        #page-transition-overlay {
            position: fixed; inset: 0; background: #1A1A1A; z-index: 9999;
            transform: translateY(100%) translateZ(0);
            pointer-events: none;
            will-change: transform;
            backface-visibility: hidden;
        }
        #page-transition-overlay.enter {
            animation: slideUpReveal 0.5s cubic-bezier(.65,0,.35,1) forwards;
        }
        #page-transition-overlay.leave {
            animation: slideUpCover 0.35s ease-out forwards;
            pointer-events: all;
        }
        @keyframes slideUpCover {
            from { transform: translateY(100%); }
            to   { transform: translateY(0%); }
        }
        @keyframes slideUpReveal {
            from { transform: translateY(0%); }
            to   { transform: translateY(-100%); }
        }
        .pt-fade-up {
            opacity: 0;
            transform: translateY(24px);
            animation: ptFadeUp 0.5s cubic-bezier(.2,.8,.2,1) forwards;
            animation-delay: 0.15s;
            will-change: opacity, transform;
        }
        @keyframes ptFadeUp {
            to { opacity: 1; transform: translateY(0); }
        }
        .pt-delay-1 { animation-delay: .2s; }
        .pt-delay-2 { animation-delay: .27s; }
        .pt-delay-3 { animation-delay: .35s; }
        .pt-delay-4 { animation-delay: .43s; }
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
            overlay.classList.add('leave');
            setTimeout(function () {
                window.location.href = href; /* 🔥 FIX: Kemarin typo form.submit() di sini, sekarang jalan normal */
            }, 320);
        });

        document.addEventListener('submit', function (e) {
            var form = e.target;
            if (form.hasAttribute('data-no-transition')) return;

            e.preventDefault();
            overlay.classList.add('leave');
            setTimeout(function () {
                form.submit();
            }, 380);
        });
    })();
    </script>
</body>
</html>
