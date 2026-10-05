<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace Kampus</title>
    <style>
        :root {
            --bg: #f1f5f9;
            --surface: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --border: #e2e8f0;
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --primary-soft: #eef2ff;
            --primary-text: #3730a3;
            --dark: #0f172a;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body { margin: 0; min-height: 100%; }

        body {
            min-height: 100vh;
            overflow-x: hidden;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            background:
                radial-gradient(60rem 28rem at 50% -8rem, rgba(79, 70, 229, 0.10), transparent 70%),
                var(--bg);
        }

        svg.ic {
            fill: none;
            stroke: currentColor;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ---------- Splash ---------- */
        .splash {
            position: fixed;
            inset: 0;
            z-index: 10;
            display: grid;
            place-items: center;
            background: var(--dark);
            color: #fff;
            animation: splash-out 600ms ease 1400ms forwards;
        }

        .splash-inner {
            display: grid;
            gap: 1.4rem;
            justify-items: center;
            animation: splash-pop 650ms ease both;
        }

        .logo {
            display: grid;
            width: 84px;
            height: 84px;
            place-items: center;
            border-radius: 24px;
            background: var(--primary);
            box-shadow: 0 24px 60px rgba(79, 70, 229, 0.4);
        }

        .logo svg { width: 46px; height: 46px; stroke-width: 1.8; }

        .loader {
            width: 120px;
            height: 4px;
            overflow: hidden;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.14);
        }

        .loader::before {
            display: block;
            width: 42%;
            height: 100%;
            border-radius: inherit;
            background: #fff;
            content: "";
            animation: load-slide 900ms ease-in-out infinite;
        }

        /* ---------- Halaman utama ---------- */
        .welcome {
            display: grid;
            width: min(1080px, calc(100% - 2rem));
            min-height: 100vh;
            margin: 0 auto;
            align-content: center;
            gap: 2.5rem;
            padding: 3rem 0;
            opacity: 0;
            transform: translateY(14px);
            animation: welcome-in 600ms ease 1500ms forwards;
        }

        .hero { display: grid; gap: 1rem; text-align: center; }

        .brand {
            justify-self: center;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.4rem 0.9rem 0.4rem 0.4rem;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 999px;
            font-size: 0.88rem;
            font-weight: 700;
        }

        .brand-mark {
            width: 30px;
            height: 30px;
            border-radius: 999px;
            background: var(--primary);
            display: grid;
            place-items: center;
        }

        .brand-mark svg { width: 17px; height: 17px; stroke: #fff; stroke-width: 1.9; }

        h1 {
            max-width: 720px;
            margin: 0 auto;
            font-size: clamp(2.1rem, 5.5vw, 3.9rem);
            line-height: 1.05;
            letter-spacing: -0.04em;
        }

        .hero p {
            max-width: 560px;
            margin: 0 auto;
            color: var(--muted);
            font-size: clamp(1rem, 2vw, 1.1rem);
            line-height: 1.65;
        }

        /* ---------- Kartu role ---------- */
        .role-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.25rem;
        }

        .role-card {
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
            padding: 1.5rem;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 14px 30px -20px rgba(15, 23, 42, 0.25);
            transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
        }

        .role-card:hover {
            transform: translateY(-4px);
            border-color: #c7d2fe;
            box-shadow: 0 24px 44px -22px rgba(79, 70, 229, 0.35);
        }

        .role-icon {
            display: grid;
            width: 52px;
            height: 52px;
            place-items: center;
            border-radius: 14px;
            background: var(--primary-soft);
            color: var(--primary);
        }

        .role-icon svg { width: 28px; height: 28px; stroke-width: 1.8; }

        .role-card h2 { margin: 0.25rem 0 0; font-size: 1.3rem; letter-spacing: -0.02em; }

        .role-card p { margin: 0; color: var(--muted); font-size: 0.95rem; line-height: 1.6; }

        .actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.65rem;
            margin-top: auto;
            padding-top: 0.6rem;
        }

        .btn {
            display: inline-flex;
            min-height: 46px;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.15s, border-color 0.15s, transform 0.05s;
        }

        .btn:active { transform: translateY(1px); }
        .btn:focus-visible { outline: 3px solid rgba(79, 70, 229, 0.35); outline-offset: 2px; }

        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-hover); }

        .btn-secondary { background: var(--surface); color: var(--text); border: 1px solid #cbd5e1; }
        .btn-secondary:hover { background: #f8fafc; border-color: #94a3b8; }

        .foot { text-align: center; color: var(--muted); font-size: 0.85rem; }

        /* ---------- Animasi ---------- */
        @keyframes splash-pop {
            from { opacity: 0; transform: scale(0.92); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes load-slide {
            from { transform: translateX(-110%); }
            to { transform: translateX(260%); }
        }

        @keyframes splash-out { to { opacity: 0; visibility: hidden; } }
        @keyframes welcome-in { to { opacity: 1; transform: translateY(0); } }

        /* ---------- Responsive ---------- */
        @media (max-width: 860px) {
            .role-grid { grid-template-columns: 1fr; max-width: 520px; width: 100%; margin: 0 auto; }
        }

        @media (max-width: 520px) {
            .welcome { width: calc(100% - 1.5rem); padding: 1.75rem 0; gap: 1.75rem; }
            .hero { text-align: left; }
            .brand { justify-self: start; }
            h1, .hero p { margin: 0; }
            .role-card { padding: 1.25rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            .splash { display: none; }
            .welcome { opacity: 1; transform: none; animation: none; }
            *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
            .role-card:hover { transform: none; }
        }
    </style>
</head>
<body>
    <section class="splash" aria-label="Memuat Marketplace Kampus">
        <div class="splash-inner">
            <div class="logo" aria-hidden="true">
                <svg class="ic" viewBox="0 0 24 24">
                    <path d="M4 10.5 12 5l8 5.5v8A1.5 1.5 0 0 1 18.5 20h-13A1.5 1.5 0 0 1 4 18.5v-8Z" />
                    <path d="M8 20v-5.5A2.5 2.5 0 0 1 10.5 12h3A2.5 2.5 0 0 1 16 14.5V20" />
                    <path d="M9 9h6" />
                </svg>
            </div>
            <div class="loader" aria-hidden="true"></div>
        </div>
    </section>

    <main class="welcome">
        <section class="hero">
            <div class="brand">
                <span class="brand-mark" aria-hidden="true">
                    <svg class="ic" viewBox="0 0 24 24">
                        <path d="M4 10.5 12 5l8 5.5v8A1.5 1.5 0 0 1 18.5 20h-13A1.5 1.5 0 0 1 4 18.5v-8Z" />
                        <path d="M8 20v-5.5A2.5 2.5 0 0 1 10.5 12h3A2.5 2.5 0 0 1 16 14.5V20" />
                        <path d="M9 9h6" />
                    </svg>
                </span>
                Marketplace Kampus
            </div>
            <h1>Mau masuk sebagai siapa hari ini?</h1>
            <p>Pilih role dulu, lalu lanjut login atau daftar. Role di form register otomatis mengikuti pilihanmu.</p>
        </section>

        <section class="role-grid" aria-label="Pilih role">
            <article class="role-card buyer">
                <div class="role-icon" aria-hidden="true">
                    <svg class="ic" viewBox="0 0 24 24"><path d="M5 6h16l-2 8H7L5 6Z" /><path d="M5 6 4 3H2" /><circle cx="8" cy="20" r="1.5" /><circle cx="18" cy="20" r="1.5" /></svg>
                </div>
                <h2>Buyer</h2>
                <p>Cari menu kampus, masuk keranjang, checkout, dan pantau pesananmu.</p>
                <div class="actions">
                    <a class="btn btn-secondary" href="{{ route('login', ['role' => 'buyer']) }}">Login</a>
                    <a class="btn btn-primary" href="{{ url('/register?role=buyer') }}">Register</a>
                </div>
            </article>

            <article class="role-card seller">
                <div class="role-icon" aria-hidden="true">
                    <svg class="ic" viewBox="0 0 24 24"><path d="M4 10h16" /><path d="M5 10l1-5h12l1 5" /><path d="M6 10v9h12v-9" /><path d="M9 19v-5h6v5" /></svg>
                </div>
                <h2>Seller</h2>
                <p>Kelola UMKM, upload foto produk, atur stok, dan proses pesanan masuk.</p>
                <div class="actions">
                    <a class="btn btn-secondary" href="{{ route('login', ['role' => 'seller']) }}">Login</a>
                    <a class="btn btn-primary" href="{{ url('/register?role=seller') }}">Register</a>
                </div>
            </article>

            <article class="role-card driver">
                <div class="role-icon" aria-hidden="true">
                    <svg class="ic" viewBox="0 0 24 24"><path d="M5 17a3 3 0 0 0 6 0" /><path d="M13 17a3 3 0 0 0 6 0" /><path d="M6 17h12" /><path d="M7 14h8l2-4h3" /><path d="M5 14l2-6h5l2 6" /></svg>
                </div>
                <h2>Driver</h2>
                <p>Ambil order siap jemput, update perjalanan, dan selesaikan pengiriman.</p>
                <div class="actions">
                    <a class="btn btn-secondary" href="{{ route('login', ['role' => 'driver']) }}">Login</a>
                    <a class="btn btn-primary" href="{{ url('/register?role=driver') }}">Register</a>
                </div>
            </article>
        </section>

        <p class="foot">Marketplace Kampus &middot; Pesan, jual, dan antar dalam satu ekosistem kampus.</p>
    </main>
</body>
</html>