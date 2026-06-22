<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sistem Inventaris Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        @keyframes spin360 { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        @keyframes popIn   { 0% { transform: scale(0) rotate(-10deg); } 70% { transform: scale(1.1) rotate(4deg); } 100% { transform: scale(1) rotate(0deg); } }
        @keyframes bounce  { 0%,100% { transform: translateY(0) rotate(-3deg); } 50% { transform: translateY(-8px) rotate(2deg); } }
        @keyframes bounce2 { 0%,100% { transform: translateY(0) rotate(3deg); } 50% { transform: translateY(-8px) rotate(-2deg); } }

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
            min-height: 640px;
            width: 100%;
            max-width: 900px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            border: 3px solid #1A1A1A;
            border-radius: 4px;
            overflow: hidden;
            padding: 30px 0;
        }

        .dots-deco {
            position: absolute; top: 24px; right: 28px;
            width: 54px; height: 54px;
            border: 3px solid #1A1A1A; border-radius: 50%;
            border-style: dashed;
            animation: spin360 18s linear infinite;
        }

        .float-icon {
            position: absolute;
            background: #fff; border: 3px solid #1A1A1A;
            border-radius: 8px; padding: 10px;
            box-shadow: 5px 5px 0 #1A1A1A;
            animation: popIn .5s ease both, bounce 4s ease-in-out infinite;
        }
        .float-icon i { font-size: 20px; color: #1A1A1A; }
        .fi1 { top: 40px;  left: 40px;  background: #7CD9C2; animation-delay: .1s, 0s; }
        .fi2 { bottom: 50px; right: 50px; background: #FFE34D; animation-delay: .4s, .7s; animation-name: popIn, bounce2; }

        .card {
            background: #fff;
            border: 3px solid #1A1A1A;
            border-radius: 8px;
            box-shadow: 8px 8px 0 #1A1A1A;
            padding: 40px 44px;
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 3;
            animation: popIn .5s ease both;
        }

        .brand-tag {
            display: inline-block;
            background: #7CD9C2;
            border: 2px solid #1A1A1A;
            font-size: 10px; font-weight: 800;
            text-transform: uppercase; letter-spacing: 1px;
            padding: 4px 10px;
            margin-bottom: 16px;
        }

        .title { font-size: 28px; font-weight: 900; color: #1A1A1A; text-transform: uppercase; letter-spacing: -.5px; margin-bottom: 6px; }
        .subtitle { font-size: 12px; color: #666; margin-bottom: 24px; font-weight: 500; }

        .alert-error {
            background: #FFE5E5; border: 2px solid #1A1A1A;
            padding: 10px 14px; font-size: 12px; font-weight: 600;
            color: #1A1A1A; margin-bottom: 16px; border-radius: 6px;
        }

        .input-group { margin-bottom: 14px; }
        .input-label { display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: .5px; color: #1A1A1A; margin-bottom: 6px; }
        .input-field {
            width: 100%;
            border: 3px solid #1A1A1A; border-radius: 6px;
            padding: 11px 14px; font-size: 13px;
            font-family: inherit; background: #FAFAF7;
        }
        .input-field::placeholder { color: #888; font-weight: 500; }
        .input-field:focus { outline: none; box-shadow: 3px 3px 0 #1A1A1A; }

        .form-error { font-size: 11px; color: #FF4D4D; font-weight: 700; margin-top: 4px; }

        .btn-submit {
            width: 100%;
            background: #1A1A1A; color: #FFE34D;
            border: 3px solid #1A1A1A;
            padding: 14px;
            font-size: 14px; font-weight: 800;
            text-transform: uppercase; cursor: pointer;
            box-shadow: 4px 4px 0 #FF4D4D;
            font-family: inherit;
            margin-top: 6px;
            transition: transform .1s, box-shadow .1s;
        }
        .btn-submit:hover { transform: translate(-2px,-2px); box-shadow: 6px 6px 0 #FF4D4D; }
        .btn-submit:active { transform: translate(0,0); box-shadow: 2px 2px 0 #FF4D4D; }

        .bottom-link { text-align: center; font-size: 12px; color: #666; margin-top: 18px; font-weight: 500; }
        .bottom-link a { color: #1A1A1A; font-weight: 800; text-decoration: underline; }

        @media (max-width: 600px) {
            .float-icon { display: none; }
            .card { padding: 30px 24px; }
            .title { font-size: 24px; }
        }
    </style>
</head>
<body>

<div class="wrap">
    <div class="dots-deco"></div>
    <div class="float-icon fi1"><i class="bi bi-hdd-network"></i></div>
    <div class="float-icon fi2"><i class="bi bi-cpu"></i></div>

    <div class="card">
        <div class="brand-tag">Daftar Mahasiswa</div>
        <div class="title">Bikin Akun</div>
        <div class="subtitle">Isi data diri buat akses sistem peminjaman</div>

        @if($errors->any())
            <div class="alert-error">
                <i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group">
                <label class="input-label">Nama Lengkap</label>
                <input type="text" name="name" class="input-field" placeholder="Nama lengkap" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label class="input-label">NIM</label>
                <input type="text" name="nim" class="input-field" placeholder="Nomor Induk Mahasiswa" value="{{ old('nim') }}" required>
                @error('nim')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label class="input-label">Email</label>
                <input type="email" name="email" class="input-field" placeholder="contoh@email.com" value="{{ old('email') }}" required>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label class="input-label">Password</label>
                <input type="password" name="password" class="input-field" placeholder="Minimal 8 karakter" required>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label class="input-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="input-field" placeholder="Ulangi password" required>
            </div>



            <button type="submit" class="btn-submit">Daftar Sekarang</button>

            <div class="bottom-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </div>
        </form>
    </div>
</div>
{{-- ============================================================
     PAGE TRANSITION SNIPPET — taruh ini di SETIAP layout/halaman
     (welcome, login, register, layouts/main, mahasiswa/layout)
     Letakkan tepat SEBELUM tag </body>
     ============================================================ --}}

<div id="page-transition-overlay"></div>

<style>
    /* ===== Overlay transisi (full screen) ===== */
    #page-transition-overlay {
    position: fixed; inset: 0; background: #1A1A1A; z-index: 9999;
    transform: translateY(100%); pointer-events: none;
    will-change: transform;
}

    /* Saat HALAMAN BARU baru dimuat: overlay nutup penuh dulu lalu slide ke atas (terbuka) */
    #page-transition-overlay.enter {
        animation: slideUpReveal 0.5s cubic-bezier(.65,0,.35,1) forwards;
    }

    /* Saat user KLIK link/tombol: overlay slide dari bawah menutupi layar */
    #page-transition-overlay.leave {
        animation: slideUpCover 0.4s cubic-bezier(.65,0,.35,1) forwards;
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
