<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kuliner - Marketplace Kampus</title>
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
            --danger: #dc2626;
            --danger-soft: #fef2f2;
            --danger-border: #fecaca;
            --success-bg: #f0fdf4;
            --success-border: #bbf7d0;
            --success-text: #166534;
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
            max-width: 1120px;
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

        .brand-name {
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: -0.01em;
            white-space: nowrap;
        }

        .nav { display: flex; align-items: center; gap: 0.5rem; }

        .nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.55rem 0.85rem;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text);
            text-decoration: none;
            background: transparent;
            border: 1px solid transparent;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s;
        }

        .nav-btn:hover { background: #f1f5f9; }
        .nav-btn:focus-visible { outline: 3px solid rgba(79, 70, 229, 0.3); outline-offset: 2px; }

        .nav-btn.primary { color: var(--primary); }
        .nav-btn.primary:hover { background: var(--primary-soft); }

        .nav-btn.danger { color: var(--danger); border-color: var(--danger-border); background: var(--surface); }
        .nav-btn.danger:hover { background: var(--danger-soft); }

        /* ---------- Konten ---------- */
        .page { max-width: 1120px; margin: 0 auto; padding: 2rem 1.5rem 3rem; }

        .page-head { margin-bottom: 1.5rem; }
        .page-head h1 { margin: 0 0 0.3rem; font-size: 1.6rem; letter-spacing: -0.02em; }
        .page-head p { margin: 0; color: var(--muted); font-size: 0.95rem; }

        .alert-success {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            background: var(--success-bg);
            border: 1px solid var(--success-border);
            color: var(--success-text);
            padding: 0.75rem 0.95rem;
            border-radius: 10px;
            margin-bottom: 1.25rem;
            font-size: 0.9rem;
        }

        /* ---------- Grid produk ---------- */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.25rem;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.2s, transform 0.2s, border-color 0.2s;
        }

        .card:hover {
            box-shadow: 0 16px 30px -18px rgba(15, 23, 42, 0.3);
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }

        .product-photo {
            aspect-ratio: 4 / 3;
            background: #f1f5f9;
            display: grid;
            place-items: center;
            overflow: hidden;
        }

        .product-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .photo-placeholder {
            width: 44px;
            height: 44px;
            fill: none;
            stroke: #94a3b8;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .card-body {
            padding: 1rem 1.1rem 1.1rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .title {
            font-size: 1rem;
            font-weight: 600;
            line-height: 1.35;
            margin-bottom: 0.25rem;
            overflow-wrap: anywhere;
        }

        .seller { font-size: 0.8rem; color: var(--muted); }

        .price {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 0.75rem;
        }

        .card-body form { margin-top: auto; padding-top: 1rem; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            width: 100%;
            background: var(--primary);
            color: #fff;
            border: 0;
            padding: 0.7rem 0.75rem;
            font-family: inherit;
            font-size: 0.92rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.15s, transform 0.05s;
        }

        .btn:hover { background: var(--primary-hover); }
        .btn:active { transform: translateY(1px); }
        .btn:focus-visible { outline: 3px solid rgba(79, 70, 229, 0.35); outline-offset: 2px; }

        /* ---------- Empty state ---------- */
        .empty {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3.5rem 1.5rem;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            border-radius: 16px;
            background: var(--primary-soft);
            display: grid;
            place-items: center;
        }

        .empty-icon svg {
            width: 30px;
            height: 30px;
            fill: none;
            stroke: var(--primary);
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .empty h2 { margin: 0 0 0.4rem; font-size: 1.15rem; }
        .empty p { margin: 0; color: var(--muted); font-size: 0.95rem; }

        /* ---------- Responsive ---------- */
        @media (max-width: 720px) {
            .topbar-inner { padding: 0.65rem 1rem; }
            .page { padding: 1.25rem 1rem 2rem; }

            .brand-name { display: none; }

            /* nav jadi ikon saja di HP */
            .nav { gap: 0.25rem; }
            .nav-btn { padding: 0.6rem; }
            .nav-btn .label { display: none; }
            .nav-btn svg.ic { width: 20px; height: 20px; }

            .page-head h1 { font-size: 1.35rem; }
        }

        @media (max-width: 520px) {
            .grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0.75rem; }

            .card-body { padding: 0.8rem; }
            .title { font-size: 0.92rem; }
            .price { font-size: 1rem; margin-top: 0.5rem; }
            .btn { padding: 0.65rem 0.5rem; font-size: 0.85rem; }
        }

        @media (max-width: 340px) {
            .grid { grid-template-columns: 1fr; }
        }

        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; }
            .card:hover { transform: none; }
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
                <span class="brand-name">Marketplace Kampus</span>
            </div>

            <nav class="nav" aria-label="Navigasi utama">
                <a class="nav-btn" href="{{ route('buyer.cart') }}" aria-label="Keranjang Belanja">
                    <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 6h16l-2 8H7L5 6Z" /><path d="M5 6 4 3H2" /><circle cx="8" cy="20" r="1.5" /><circle cx="18" cy="20" r="1.5" /></svg>
                    <span class="label">Keranjang Belanja</span>
                </a>
                <a class="nav-btn primary" href="{{ route('buyer.orders') }}" aria-label="Pesanan Saya">
                    <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7.5 12 3l8 4.5v9L12 21l-8-4.5v-9Z" /><path d="m4 7.5 8 4.5 8-4.5" /><path d="M12 12v9" /></svg>
                    <span class="label">Pesanan Saya</span>
                </a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-btn danger" aria-label="Logout">
                        <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><path d="m16 17 5-5-5-5" /><path d="M21 12H9" /></svg>
                        <span class="label">Logout</span>
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <main class="page">
        <div class="page-head">
            <h1>Katalog Kuliner Kampus</h1>
            <p>Pilih menu favoritmu dari UMKM kampus dan tambahkan ke keranjang.</p>
        </div>

        @if(session('success'))
            <div class="alert-success" role="status">
                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 6 9 17l-5-5" /></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="grid">
            @forelse($products as $prod)
                <article class="card">
                    <div class="product-photo">
                        @if($prod->image)
                            <img src="{{ asset('storage/' . $prod->image) }}" alt="{{ $prod->name }}" loading="lazy">
                        @else
                            <svg class="photo-placeholder" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 6.5A2.5 2.5 0 0 1 6.5 4h11A2.5 2.5 0 0 1 20 6.5v11a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 17.5v-11Z" /><path d="m6.5 16 3.25-3.25 2.5 2.5L15.5 12 18 14.5" /><circle cx="9" cy="8.5" r="1.25" /></svg>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="title">{{ $prod->name }}</div>
                        <div class="seller">UMKM: {{ $prod->seller->name ?? '-' }}</div>
                        <div class="price">Rp {{ number_format($prod->price, 0, ',', '.') }}</div>

                        <form action="{{ route('buyer.cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $prod->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn">
                                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14" /><path d="M5 12h14" /></svg>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="empty">
                    <div class="empty-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><path d="M4 6.5A2.5 2.5 0 0 1 6.5 4h11A2.5 2.5 0 0 1 20 6.5v11a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 17.5v-11Z" /><path d="m6.5 16 3.25-3.25 2.5 2.5L15.5 12 18 14.5" /><circle cx="9" cy="8.5" r="1.25" /></svg>
                    </div>
                    <h2>Belum ada menu tersedia</h2>
                    <p>Menu makanan dari UMKM kampus akan muncul di sini.</p>
                </div>
            @endforelse
        </div>
    </main>
    <script src="{{ asset('js/marketplace-confirm.js') }}?v=20261005b"></script>
</body>
</html>
