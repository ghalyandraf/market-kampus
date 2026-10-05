<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Seller - Marketplace Kampus</title>
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
            --dark: #0f172a;
            --danger: #dc2626;
            --danger-soft: #fef2f2;
            --danger-border: #fecaca;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body { margin: 0; min-height: 100%; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
        }

        svg.ic {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ---------- Topbar ---------- */
        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar-inner {
            max-width: 1040px;
            margin: 0 auto;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .brand { display: flex; align-items: center; gap: 0.65rem; min-width: 0; }

        .brand-mark {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--primary);
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .brand-mark svg {
            width: 21px;
            height: 21px;
            fill: none;
            stroke: #fff;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .brand-text { min-width: 0; }
        .brand-name { font-weight: 700; font-size: 1rem; letter-spacing: -0.01em; white-space: nowrap; }
        .brand-role { font-size: 0.75rem; color: var(--muted); }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 0.95rem;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--danger);
            background: var(--surface);
            border: 1px solid var(--danger-border);
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-logout:hover { background: var(--danger-soft); }
        .btn-logout:focus-visible { outline: 3px solid rgba(220, 38, 38, 0.25); outline-offset: 2px; }

        /* ---------- Konten ---------- */
        .page { max-width: 1040px; margin: 0 auto; padding: 2rem 1.5rem 3rem; }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 10px 25px -15px rgba(15, 23, 42, 0.15);
        }

        /* Hero */
        .hero {
            background: var(--dark);
            color: #e2e8f0;
            border-radius: 20px;
            padding: 2rem;
            display: flex;
            align-items: center;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: var(--primary);
            color: #fff;
            display: grid;
            place-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .hero-text { min-width: 0; }

        .hero h1 {
            margin: 0 0 0.35rem;
            font-size: 1.5rem;
            line-height: 1.25;
            color: #fff;
            letter-spacing: -0.02em;
            overflow-wrap: anywhere;
        }

        .hero p { margin: 0; color: #94a3b8; font-size: 0.95rem; line-height: 1.55; }

        .badge {
            display: inline-block;
            vertical-align: middle;
            background: rgba(165, 180, 252, 0.15);
            color: #c7d2fe;
            padding: 0.2rem 0.65rem;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        /* Info cards */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-card { padding: 1.25rem; display: flex; align-items: center; gap: 1rem; }

        .info-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--primary-soft);
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .info-icon svg {
            width: 22px;
            height: 22px;
            fill: none;
            stroke: var(--primary);
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .info-label { font-size: 0.8rem; color: var(--muted); margin-bottom: 0.15rem; }
        .info-value { font-weight: 600; font-size: 1rem; overflow-wrap: anywhere; }

        /* CTA kelola produk */
        .cta {
            padding: 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
        }

        .cta-text { min-width: 0; }
        .cta h2 { margin: 0 0 0.4rem; font-size: 1.15rem; letter-spacing: -0.01em; }
        .cta p { margin: 0; color: var(--muted); font-size: 0.95rem; line-height: 1.6; max-width: 520px; }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            flex-shrink: 0;
            background: var(--primary);
            color: #fff;
            padding: 0.85rem 1.4rem;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 10px;
            transition: background 0.15s, transform 0.05s;
        }

        .btn-primary:hover { background: var(--primary-hover); }
        .btn-primary:active { transform: translateY(1px); }
        .btn-primary:focus-visible { outline: 3px solid rgba(79, 70, 229, 0.35); outline-offset: 2px; }

        /* ---------- Responsive ---------- */
        @media (max-width: 640px) {
            .topbar-inner { padding: 0.65rem 1rem; }
            .page { padding: 1.25rem 1rem 2rem; }

            .brand-role { display: none; }

            .hero { flex-direction: column; align-items: flex-start; padding: 1.5rem; gap: 1rem; }
            .hero h1 { font-size: 1.3rem; }

            .info-grid { grid-template-columns: 1fr; }

            .cta { flex-direction: column; align-items: stretch; padding: 1.35rem; gap: 1.25rem; }

            .btn-logout span { display: none; }
            .btn-logout { padding: 0.6rem; }
            .btn-logout svg { width: 19px; height: 19px; }
        }

        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <div class="brand">
                <div class="brand-mark" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 10.5 12 5l8 5.5v8A1.5 1.5 0 0 1 18.5 20h-13A1.5 1.5 0 0 1 4 18.5v-8Z" />
                        <path d="M8 20v-5.5A2.5 2.5 0 0 1 10.5 12h3A2.5 2.5 0 0 1 16 14.5V20" />
                        <path d="M9 9h6" />
                    </svg>
                </div>
                <div class="brand-text">
                    <div class="brand-name">Marketplace Kampus</div>
                    <div class="brand-role">UMKM (Seller)</div>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout" aria-label="Logout">
                    <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><path d="m16 17 5-5-5-5" /><path d="M21 12H9" /></svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </header>

    <main class="page">
        {{-- Sambutan --}}
        <section class="hero">
            <div class="avatar" aria-hidden="true">
                {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="hero-text">
                <h1>Halo, {{ auth()->user()->name }}!</h1>
                <p>
                    Kelola warung / UMKM makanan kampus Anda.
                    <span class="badge">{{ auth()->user()->role->name }}</span>
                </p>
            </div>
        </section>

        {{-- Info akun --}}
        <section class="info-grid" aria-label="Informasi akun">
            <div class="card info-card">
                <div class="info-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 9.5 12 5l9 4.5-9 4.5-9-4.5Z" />
                        <path d="M7 12v4.5c0 1 2.2 2.5 5 2.5s5-1.5 5-2.5V12" />
                    </svg>
                </div>
                <div>
                    <div class="info-label">Kampus</div>
                    <div class="info-value">{{ auth()->user()->campus_name ?? '-' }}</div>
                </div>
            </div>

            <div class="card info-card">
                <div class="info-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 9.5 5.5 4h13L20 9.5" />
                        <path d="M4 9.5a2.7 2.7 0 0 0 5.3 0 2.7 2.7 0 0 0 5.4 0 2.7 2.7 0 0 0 5.3 0" />
                        <path d="M5 12.5V20h14v-7.5" />
                    </svg>
                </div>
                <div>
                    <div class="info-label">Peran Akun</div>
                    <div class="info-value">{{ ucfirst(auth()->user()->role->name) }}</div>
                </div>
            </div>
        </section>

        {{-- Kelola produk --}}
        <section class="card cta">
            <div class="cta-text">
                <h2>Kelola Menu Dagangan</h2>
                <p>Atur menu makanan, harga, dan stok dagangan Anda melalui tombol di samping.</p>
            </div>
            <a href="{{ route('seller.products.index') }}" class="btn-primary">
                Buka Menu Kelola Produk
                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14" /><path d="m13 6 6 6-6 6" /></svg>
            </a>
        </section>
    </main>
    <script src="{{ asset('js/marketplace-confirm.js') }}?v=20261005b"></script>
</body>
</html>
