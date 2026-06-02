<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Peminjaman Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: #0a0e1a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            font-family: 'Segoe UI', sans-serif;
        }
        .wrapper {
            display: flex;
            width: 900px;
            min-height: 620px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0,0,0,0.5);
            position: relative;
            z-index: 1;
        }
        .left-panel {
            background: white;
            width: 55%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            opacity: 0;
            animation: fadeInLeft 0.7s ease 0.2s forwards;
        }
        .logo-area {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .logo-area img {
            height: 40px;
        }
        .logo-area span {
            font-weight: 700;
            font-size: 16px;
            color: #1e3a5f;
        }
        .left-panel h2 {
            font-weight: 700;
            color: #1e3a5f;
            margin-bottom: 4px;
        }
        .left-panel p.subtitle {
            color: #6c757d;
            font-size: 13px;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #374151;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 10px 14px;
            border: 1.5px solid #e5e7eb;
            font-size: 14px;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13,110,253,0.12);
        }
        .input-group-text {
            background: #f9fafb;
            border: 1.5px solid #e5e7eb;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: #6c757d;
        }
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        .btn-register {
            background: linear-gradient(135deg, #0d6efd, #0056b3);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13,110,253,0.35);
        }
        .right-panel {
            background: linear-gradient(135deg, #e8f0fe 0%, #c7d9ff 50%, #a8c4ff 100%);
            width: 45%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 30px;
            text-align: center;
            opacity: 0;
            animation: fadeInRight 0.7s ease 0.3s forwards;
            position: relative;
            overflow: hidden;
        }
        .right-panel img {
            width: 260px;
            animation: float 4s ease-in-out infinite;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));
        }
        .right-panel h3 {
            color: #1e3a5f;
            font-weight: 700;
            font-size: 20px;
            margin-top: 20px;
            position: relative;
            z-index: 1;
        }
        .right-panel p {
            color: #374151;
            font-size: 13px;
            margin-top: 8px;
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>

<canvas id="stars" style="position:fixed;top:0;left:0;z-index:0;pointer-events:none;"></canvas>

<div class="wrapper">
    <!-- Kiri: Form Register -->
    <div class="left-panel">
        <div class="logo-area">
            <img src="{{ asset('images/logo-uns-biru.png') }}" alt="Logo UNS">
            <span>Peminjaman Lab</span>
        </div>
        <h2>Daftar Akun</h2>
        <p class="subtitle">Buat akun untuk mengakses sistem peminjaman lab</p>

        @if($errors->any())
            <div class="alert alert-danger py-2" style="font-size:13px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-2">
                <label class="form-label">Nama Lengkap</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="name" class="form-control" placeholder="Nama lengkap" value="{{ old('name') }}" required>
                </div>
            </div>
            <div class="mb-2">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="contoh@email.com" value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="mb-2">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>
            <div class="mb-2">
                <label class="form-label">Konfirmasi Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                </div>
            </div>
            <input type="hidden" value="{{ $role->id }}" name="id_role">
            <button type="submit" class="btn btn-primary btn-register w-100 text-white mb-3">
                <i class="bi bi-person-check me-2"></i>Daftar Sekarang
            </button>
            <div class="text-center">
                <span class="text-muted" style="font-size:13px;">Sudah punya akun?</span>
                <a href="{{ route('login') }}" class="text-primary fw-semibold ms-1" style="font-size:13px;">Masuk</a>
            </div>
        </form>
    </div>

    <!-- Kanan: Ilustrasi -->
    <div class="right-panel">
        <img src="{{ asset('images/register.png') }}" alt="Ilustrasi Lab">
        <h3>Bergabung Sekarang</h3>
        <p>Daftar dan mulai kelola peminjaman peralatan laboratorium</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const canvas = document.getElementById('stars');
const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
window.addEventListener('resize', () => { canvas.width = window.innerWidth; canvas.height = window.innerHeight; });
const stars = [];
for (let i = 0; i < 200; i++) {
    stars.push({ x: Math.random()*canvas.width, y: Math.random()*canvas.height, r: Math.random()*1.5+0.3, opacity: Math.random()*0.8+0.2, twinkleSpeed: Math.random()*0.02+0.005, twinkleDir: Math.random()>0.5?1:-1 });
}
const shootingStars = [];
setInterval(() => {
    shootingStars.push({ x: Math.random()*canvas.width, y: Math.random()*canvas.height*0.5, len: Math.random()*150+80, speed: Math.random()*8+6, opacity: 1, angle: Math.PI/4 });
}, 2000);
function draw() {
    ctx.clearRect(0,0,canvas.width,canvas.height);
    stars.forEach(s => {
        s.opacity += s.twinkleSpeed * s.twinkleDir;
        if (s.opacity > 1 || s.opacity < 0.1) s.twinkleDir *= -1;
        ctx.beginPath(); ctx.arc(s.x,s.y,s.r,0,Math.PI*2);
        ctx.fillStyle = `rgba(255,255,255,${s.opacity})`; ctx.fill();
    });
    for (let i = shootingStars.length-1; i >= 0; i--) {
        const ss = shootingStars[i];
        ctx.beginPath(); ctx.moveTo(ss.x,ss.y);
        ctx.lineTo(ss.x-Math.cos(ss.angle)*ss.len, ss.y-Math.sin(ss.angle)*ss.len);
        const g = ctx.createLinearGradient(ss.x,ss.y,ss.x-Math.cos(ss.angle)*ss.len,ss.y-Math.sin(ss.angle)*ss.len);
        g.addColorStop(0,`rgba(255,255,255,${ss.opacity})`); g.addColorStop(1,'transparent');
        ctx.strokeStyle=g; ctx.lineWidth=1.5; ctx.stroke();
        ss.x+=Math.cos(ss.angle)*ss.speed; ss.y+=Math.sin(ss.angle)*ss.speed; ss.opacity-=0.015;
        if(ss.opacity<=0) shootingStars.splice(i,1);
    }
    requestAnimationFrame(draw);
}
draw();
</script>
</body>
</html>
