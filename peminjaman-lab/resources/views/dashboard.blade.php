<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Peminjaman Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
    background: #0a0e1a;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        .dashboard-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 40px;
        width: 100%;
        max-width: 480px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        animation: fadeInUp 0.6s ease forwards;
        text-align: center;
        z-index: 1;
        position: relative;
        opacity: 0;
        animation: fadeInUp 0.6s ease 0.2s forwards;
}

        .dashboard-icon {
            font-size: 56px;
            color: #0d6efd;
            animation: float 3s ease-in-out infinite;
            display: inline-block;
        }

        .dashboard-title {
            font-weight: 700;
            color: #1e3a5f;
            margin-top: 12px;
        }

        .role-badge {
            display: inline-block;
            background: linear-gradient(135deg, #0d6efd, #0056b3);
            color: white;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-top: 8px;
        }

        .btn-masuk {
            background: linear-gradient(135deg, #0d6efd, #0056b3);
            border: none;
            border-radius: 8px;
            padding: 12px 32px;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-masuk:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13,110,253,0.4);
        }

        body::before {
            content: '';
            position: fixed;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            top: -100px;
            left: -100px;
            animation: float 6s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: fixed;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            bottom: -50px;
            right: -50px;
            animation: float 4s ease-in-out infinite reverse;
        }
    </style>
</head>
<body>
    <div class="dashboard-card">
        <i class="bi bi-box-seam-fill dashboard-icon"></i>
        <h4 class="dashboard-title">Selamat Datang!</h4>
        <p class="text-muted">{{ auth()->user()->name }}</p>
        <div class="role-badge">
            <i class="bi bi-shield-check me-1"></i>
            {{ ucfirst(auth()->user()->role?->nama ?? 'User') }}
        </div>

        <hr class="my-4">

        <p class="text-muted mb-4">Kamu sudah berhasil login. Silakan masuk ke sistem.</p>

        @php $role = auth()->user()->role?->nama; @endphp

    <i class="bi bi-box-seam-fill dashboard-icon"></i>
    <h4 class="dashboard-title">Login Berhasil!</h4>
    <p class="text-muted">{{ auth()->user()->name }}</p>

    @if($role === 'mahasiswa')
        <div class="role-badge" style="background: linear-gradient(135deg, #0d6efd, #0056b3);">
            <i class="bi bi-mortarboard me-1"></i> Mahasiswa
        </div>
        <p class="mt-3 text-muted">Kamu berhasil login sebagai <strong>Mahasiswa</strong>. Selamat datang di Portal Mahasiswa!</p>
    @elseif($role === 'kalab')
        <div class="role-badge" style="background: linear-gradient(135deg, #dc3545, #a71d2a);">
            <i class="bi bi-shield-fill-check me-1"></i> Kepala Lab
        </div>
        <p class="mt-3 text-muted">Kamu berhasil login sebagai <strong>Kepala Lab</strong>. Selamat datang!</p>
    @elseif($role === 'aslab')
        <div class="role-badge" style="background: linear-gradient(135deg, #198754, #0f5132);">
            <i class="bi bi-person-badge me-1"></i> Asisten Lab
        </div>
        <p class="mt-3 text-muted">Kamu berhasil login sebagai <strong>Asisten Lab</strong>. Selamat datang!</p>
    @elseif($role === 'operator')
        <div class="role-badge" style="background: linear-gradient(135deg, #fd7e14, #b35400);">
            <i class="bi bi-gear me-1"></i> Operator
        </div>
        <p class="mt-3 text-muted">Kamu berhasil login sebagai <strong>Operator</strong>. Selamat datang!</p>
    @else
        <div class="role-badge">
            <i class="bi bi-person me-1"></i> User
        </div>
        <p class="mt-3 text-muted">Kamu berhasil login. Selamat datang!</p>
    @endif

    <hr class="my-3">

    @if($role === 'mahasiswa')
        <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-primary btn-masuk text-white">
            <i class="bi bi-arrow-right-circle me-2"></i>Masuk ke Portal Mahasiswa
        </a>
    @else
        <a href="{{ route('barang.index') }}" class="btn btn-primary btn-masuk text-white">
            <i class="bi bi-arrow-right-circle me-2"></i>Masuk ke Sistem
        </a>
    @endif

    <p class="text-muted mt-3" style="font-size: 13px;">
        Otomatis masuk dalam <span id="countdown">3</span> detik...
    </p>

<div class="mt-2">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-box-arrow-right me-1"></i>Logout
        </button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<canvas id="stars" style="position:fixed;top:0;left:0;z-index:0;pointer-events:none;"></canvas>
<script>
const canvas = document.getElementById('stars');
const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

window.addEventListener('resize', () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
});

// Shooting stars
const shootingStars = [];
const stars = [];

// Buat bintang diam
for (let i = 0; i < 200; i++) {
    stars.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        r: Math.random() * 1.5 + 0.3,
        opacity: Math.random() * 0.8 + 0.2,
        twinkleSpeed: Math.random() * 0.02 + 0.005,
        twinkleDir: Math.random() > 0.5 ? 1 : -1,
    });
}

// Buat shooting star baru
function createShootingStar() {
    shootingStars.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height * 0.5,
        len: Math.random() * 150 + 80,
        speed: Math.random() * 8 + 6,
        opacity: 1,
        angle: Math.PI / 4,
    });
}

// Buat shooting star tiap 2 detik
setInterval(createShootingStar, 2000);

// Ikon lab melayang
const icons = ['🔬', '🧪', '⚗️', '🔭', '💡', '🖥️', '⚡', '🧲'];
const floatingIcons = [];
for (let i = 0; i < 12; i++) {
    floatingIcons.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        icon: icons[Math.floor(Math.random() * icons.length)],
        size: Math.random() * 16 + 14,
        dx: (Math.random() - 0.5) * 0.4,
        dy: (Math.random() - 0.5) * 0.4,
        opacity: Math.random() * 0.25 + 0.1,
        rotation: Math.random() * Math.PI * 2,
        rotationSpeed: (Math.random() - 0.5) * 0.01,
    });
}

function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Gambar nebula/glow di background
    const gradient1 = ctx.createRadialGradient(
        canvas.width * 0.2, canvas.height * 0.3, 0,
        canvas.width * 0.2, canvas.height * 0.3, 300
    );
    gradient1.addColorStop(0, 'rgba(30, 60, 180, 0.15)');
    gradient1.addColorStop(1, 'transparent');
    ctx.fillStyle = gradient1;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    const gradient2 = ctx.createRadialGradient(
        canvas.width * 0.8, canvas.height * 0.7, 0,
        canvas.width * 0.8, canvas.height * 0.7, 250
    );
    gradient2.addColorStop(0, 'rgba(80, 20, 150, 0.12)');
    gradient2.addColorStop(1, 'transparent');
    ctx.fillStyle = gradient2;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Gambar bintang diam dengan efek twinkle
    stars.forEach(s => {
        s.opacity += s.twinkleSpeed * s.twinkleDir;
        if (s.opacity > 1 || s.opacity < 0.1) s.twinkleDir *= -1;

        ctx.beginPath();
        ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(255, 255, 255, ${s.opacity})`;
        ctx.fill();
    });

    // Gambar shooting stars
    for (let i = shootingStars.length - 1; i >= 0; i--) {
        const ss = shootingStars[i];
        ctx.beginPath();
        ctx.moveTo(ss.x, ss.y);
        ctx.lineTo(ss.x - Math.cos(ss.angle) * ss.len, ss.y - Math.sin(ss.angle) * ss.len);

        const grad = ctx.createLinearGradient(
            ss.x, ss.y,
            ss.x - Math.cos(ss.angle) * ss.len,
            ss.y - Math.sin(ss.angle) * ss.len
        );
        grad.addColorStop(0, `rgba(255, 255, 255, ${ss.opacity})`);
        grad.addColorStop(1, 'transparent');
        ctx.strokeStyle = grad;
        ctx.lineWidth = 1.5;
        ctx.stroke();

        ss.x += Math.cos(ss.angle) * ss.speed;
        ss.y += Math.sin(ss.angle) * ss.speed;
        ss.opacity -= 0.015;

        if (ss.opacity <= 0) shootingStars.splice(i, 1);
    }

    // Gambar floating icons
    floatingIcons.forEach(p => {
        ctx.save();
        ctx.globalAlpha = p.opacity;
        ctx.translate(p.x, p.y);
        ctx.rotate(p.rotation);
        ctx.font = `${p.size}px serif`;
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText(p.icon, 0, 0);
        ctx.restore();

        p.x += p.dx;
        p.y += p.dy;
        p.rotation += p.rotationSpeed;

        if (p.x < -50) p.x = canvas.width + 50;
        if (p.x > canvas.width + 50) p.x = -50;
        if (p.y < -50) p.y = canvas.height + 50;
        if (p.y > canvas.height + 50) p.y = -50;
    });

    requestAnimationFrame(draw);
}

draw();
</script>
</body>
</html>
