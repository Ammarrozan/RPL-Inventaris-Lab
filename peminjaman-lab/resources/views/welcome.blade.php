<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        @keyframes spin360 { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        @keyframes bounce  { 0%,100% { transform: translateY(0) rotate(-3deg); } 50% { transform: translateY(-10px) rotate(2deg); } }
        @keyframes bounce2 { 0%,100% { transform: translateY(0) rotate(3deg); } 50% { transform: translateY(-8px) rotate(-2deg); } }
        @keyframes fadeUp  { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes popIn   { 0% { transform: scale(0) rotate(-10deg); } 70% { transform: scale(1.1) rotate(4deg); } 100% { transform: scale(1) rotate(0deg); } }
        @keyframes wiggle  { 0%,100% { transform: rotate(-4deg); } 50% { transform: rotate(4deg); } }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #E8E6DD;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .wrap {
            background: #FAFAF7;
            overflow: hidden;
            position: relative;
            min-height: 640px;
            width: 100%;
            max-width: 1100px;
            border: 3px solid #1A1A1A;
            border-radius: 4px;
            display: flex;
            flex-direction: column;
        }

        .dots-deco {
            position: absolute;
            top: 24px; right: 28px;
            width: 60px; height: 60px;
            border: 3px solid #1A1A1A;
            border-radius: 50%;
            border-style: dashed;
            animation: spin360 18s linear infinite;
            z-index: 1;
        }

        /* ── Nav ── */
        .nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 20px 36px;
            border-bottom: 3px solid #1A1A1A;
            position: relative; z-index: 4;
        }
        .brand { color: #1A1A1A; font-weight: 900; font-size: 18px; letter-spacing: -.5px; }
        .nav-links { display: flex; gap: 22px; color: #1A1A1A; font-size: 12px; font-weight: 700; text-transform: uppercase; }
        .nav-links a { color: #1A1A1A; text-decoration: none; }
        .btn-register {
            background: #1A1A1A; color: #FFE34D;
            border: 3px solid #1A1A1A; padding: 8px 18px;
            font-size: 12px; font-weight: 800; cursor: pointer;
            text-transform: uppercase; text-decoration: none;
            display: inline-block;
        }

        /* ── Hero split ── */
        .main-split {
            display: grid; grid-template-columns: 1.1fr .9fr; gap: 10px;
            position: relative; z-index: 3; align-items: center;
            padding: 0 36px; flex: 1;
        }
        .hero { position: relative; z-index: 3; padding: 50px 0 30px; animation: fadeUp .6s ease; }
        .title {
            color: #1A1A1A; font-size: 52px; font-weight: 900;
            line-height: 1; letter-spacing: -1.5px; text-transform: uppercase;
        }
        .title .pop {
            background: #FFE34D; padding: 0 10px; display: inline-block;
            box-shadow: 5px 5px 0 #1A1A1A; margin-top: 8px;
        }
        .desc { color: #444; font-size: 14px; max-width: 340px; margin: 22px 0 26px; line-height: 1.65; font-weight: 500; }
        .btn-cta {
            background: #FF4D4D; color: #fff;
            border: 3px solid #1A1A1A; padding: 14px 30px;
            font-size: 14px; font-weight: 800; cursor: pointer;
            text-transform: uppercase; box-shadow: 5px 5px 0 #1A1A1A;
            text-decoration: none; display: inline-block;
            transition: transform .1s, box-shadow .1s;
        }
        .btn-cta:hover { transform: translate(-2px,-2px); box-shadow: 7px 7px 0 #1A1A1A; }

        .illust { position: relative; height: 320px; display: flex; align-items: center; justify-content: center; }
        .pop-card {
            position: absolute; background: #fff;
            border: 3px solid #1A1A1A; border-radius: 8px;
            padding: 16px 18px; box-shadow: 6px 6px 0 #1A1A1A;
            animation: popIn .5s ease both;
        }
        .pop-card i { font-size: 28px; color: #1A1A1A; margin-bottom: 8px; display: block; }
        .pc-router {
            top: 10px; left: 20px; background: #FFE34D;
            animation-delay: .2s, 0s;
            animation-name: popIn, bounce;
            animation-duration: .5s, 4s;
            animation-iteration-count: 1, infinite;
        }
        .pc-lan {
            top: 80px; right: 10px; background: #7CD9C2;
            animation-delay: .5s, .5s;
            animation-name: popIn, bounce2;
            animation-duration: .5s, 4.5s;
            animation-iteration-count: 1, infinite;
        }
        .pc-conv {
            bottom: 20px; left: 70px; background: #FF9D9D;
            animation-delay: .8s, 1s;
            animation-name: popIn, bounce;
            animation-duration: .5s, 5s;
            animation-iteration-count: 1, infinite;
        }
        .pc-num { font-size: 22px; font-weight: 900; color: #1A1A1A; }
        .pc-label { font-size: 11px; font-weight: 800; text-transform: uppercase; color: #1A1A1A; margin-top: 2px; }

        /* ── Footer band ── */
        .footer-band {
            position: relative; z-index: 3;
            border-top: 3px solid #1A1A1A;
            padding: 16px 36px;
            display: flex; justify-content: space-between; align-items: center;
            background: #1A1A1A;
        }
        .foot-text {
            color: #FAFAF7; font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1px;
            display: flex; align-items: center; gap: 8px;
        }
        .foot-icons { display: flex; gap: 12px; }
        .foot-icon {
            width: 30px; height: 30px;
            border: 2px solid #FFE34D; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            animation: wiggle 3s ease-in-out infinite;
        }
        .foot-icon i { font-size: 13px; color: #FFE34D; }
        .foot-icon:nth-child(2) { animation-delay: .3s; }
        .foot-icon:nth-child(3) { animation-delay: .6s; }

        @media (max-width: 768px) {
            .main-split { grid-template-columns: 1fr; }
            .illust { height: 220px; margin-top: 20px; }
            .title { font-size: 38px; }
            .nav-links { display: none; }
            .footer-band { flex-direction: column; gap: 12px; text-align: center; }
        }
    </style>
</head>
<body>

<div class="wrap">
    <div class="dots-deco"></div>

    {{-- ── Navbar ── --}}
    <nav class="nav">
        <div class="brand">LAB.INV</div>
        <div class="nav-links">
            <a href="#daftar-alat"></a>
            <a href="#aturan"></a>
            <a href="#kontak"></a>
        </div>
        <a href="{{ route('register') }}" class="btn-register">Daftar</a>
    </nav>

    {{-- ── Hero ── --}}
    <div class="main-split">
        <div class="hero">
            <div class="title">PINJAM ALAT<br><span class="pop">JADI SIMPLE</span></div>
            <p class="desc">Nggak perlu nunggu lama. Cek stok, request pinjam, kelar dalam hitungan menit.</p>
            <a href="{{ route('login') }}" class="btn-cta">GASKAN →</a>
        </div>

        <div class="illust">
            <div class="pop-card pc-router">
                <i class="bi bi-router"></i>
                <div class="pc-num"></div>
                <div class="pc-label">Router</div>
            </div>
            <div class="pop-card pc-lan">
                <i class="bi bi-diagram-3"></i>
                <div class="pc-num"></div>
                <div class="pc-label">LAN</div>
            </div>
            <div class="pop-card pc-conv">
                <i class="bi bi-plug"></i>
                <div class="pc-num"></div>
                <div class="pc-label">Converter</div>
            </div>
        </div>
    </div>

    {{-- ── Footer ── --}}
    <div class="footer-band">
        <div class="foot-text"><i class="bi bi-flask"></i> Sistem Inventaris Lab &copy; {{ date('Y') }}</div>
        <div class="foot-icons">
            <div class="foot-icon"><i class="bi bi-router"></i></div>
            <div class="foot-icon"><i class="bi bi-plug"></i></div>
            <div class="foot-icon"><i class="bi bi-hdd-network"></i></div>
        </div>
    </div>
</div>


<div id="page-transition-overlay"></div>

<style>
    /* ===== Overlay transisi (full screen) ===== */
    #page-transition-overlay {
        position: fixed;
        inset: 0;
        background: #1A1A1A;
        z-index: 9999;
        transform: translateY(100%);
        pointer-events: none;
    }

    /* Saat HALAMAN BARU baru dimuat: overlay nutup penuh dulu lalu slide ke atas (terbuka) */
    #page-transition-overlay.enter {
        animation: slideUpReveal 0.5s cubic-bezier(.65,0,.35,1) forwards;
    }

    /* Saat user KLIK link/tombol: overlay slide dari bawah menutupi layar */
    #page-transition-overlay {
    position: fixed; inset: 0; background: #1A1A1A; z-index: 9999;
    transform: translateY(100%); pointer-events: none;
    will-change: transform;
}

    @keyframes slideUpCover {
        from { transform: translateY(100%); }
        to   { transform: translateY(0%); }
    }
    @keyframes slideUpReveal {
        from { transform: translateY(0%); }
        to   { transform: translateY(-100%); }
    }

    /* ===== Animasi "muncul dari bawah" untuk elemen konten ===== */
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

    // 1) Saat halaman ini baru terbuka -> jalankan animasi "reveal" (overlay slide ke atas)
    overlay.classList.add('enter');
    overlay.addEventListener('animationend', function () {
        overlay.classList.remove('enter');
        overlay.style.transform = 'translateY(100%)';
    }, { once: true });

    // 2) Intercept semua klik pada <a> yang menuju halaman lain (same-origin, bukan _blank/#/javascript:)
    document.addEventListener('click', function (e) {
        var link = e.target.closest('a');
        if (!link) return;
        if (link.target === '_blank') return;
        if (link.hasAttribute('download')) return;
        var href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('javascript:')) return;
        if (link.origin && link.origin !== window.location.origin) return; // skip external link

        e.preventDefault();
        overlay.style.transform = 'translateY(100%)';
        overlay.classList.add('leave');
        setTimeout(function () {
            window.location.href = href;
        }, 380);
    });

    // 3) Intercept submit form (login, register, tambah barang, dll)
    document.addEventListener('submit', function (e) {
        var form = e.target;
        if (form.hasAttribute('data-no-transition')) return;

        e.preventDefault();
        overlay.style.transform = 'translateY(100%)';
        overlay.classList.add('leave');
        setTimeout(function () {
            form.submit();
        }, 380);
    });
})();
</script>
</body>
</html>
