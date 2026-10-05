<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Marketplace Kampus</title>
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
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body { margin: 0; min-height: 100%; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            padding: 2rem 1.5rem 3rem;
        }

        .page { max-width: 1040px; margin: 0 auto; }

        /* ---------- Header ---------- */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }

        .page-header h1 {
            margin: 0;
            font-size: 1.6rem;
            letter-spacing: -0.02em;
        }

        .page-header .count { color: var(--muted); font-size: 0.9rem; margin-top: 0.2rem; }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 0.9rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text);
            text-decoration: none;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            transition: background 0.15s, border-color 0.15s;
        }

        .back-link:hover { background: #f8fafc; border-color: #cbd5e1; }

        .back-link svg {
            width: 18px;
            height: 18px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ---------- Alert ---------- */
        .alert {
            background: var(--danger-soft);
            border: 1px solid var(--danger-border);
            color: #b91c1c;
            padding: 0.75rem 0.95rem;
            border-radius: 10px;
            margin-bottom: 1.25rem;
            font-size: 0.9rem;
        }

        /* ---------- Layout ---------- */
        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 360px;
            gap: 1.5rem;
            align-items: start;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 10px 25px -15px rgba(15, 23, 42, 0.15);
        }

        /* ---------- Daftar item ---------- */
        .items { list-style: none; margin: 0; padding: 0.5rem 0; }

        .item {
            display: grid;
            grid-template-columns: 52px minmax(0, 1fr) auto;
            gap: 1rem;
            align-items: center;
            padding: 1rem 1.25rem;
        }

        .item + .item { border-top: 1px solid var(--border); }

        .item-thumb {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: var(--primary-soft);
            display: grid;
            place-items: center;
            color: var(--primary);
            font-weight: 700;
            font-size: 1.1rem;
        }

        .item-info { min-width: 0; }

        .item-name {
            font-weight: 600;
            font-size: 0.98rem;
            margin: 0 0 0.15rem;
            overflow-wrap: anywhere;
        }

        .item-seller { color: var(--muted); font-size: 0.82rem; margin: 0 0 0.5rem; }

        .item-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.4rem 0.75rem;
            font-size: 0.85rem;
            color: var(--muted);
        }

        .qty {
            display: inline-block;
            padding: 0.15rem 0.6rem;
            background: #f1f5f9;
            border-radius: 999px;
            font-weight: 600;
            color: var(--text);
            font-size: 0.8rem;
        }

        .item-side {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.5rem;
        }

        .item-subtotal { font-weight: 700; font-size: 0.98rem; white-space: nowrap; }

        .btn-remove {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            background: none;
            border: 0;
            padding: 0.3rem 0.5rem;
            margin-right: -0.5rem;
            font-family: inherit;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--danger);
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-remove:hover { background: var(--danger-soft); }
        .btn-remove:focus-visible { outline: 2px solid var(--danger); }

        .btn-remove svg {
            width: 15px;
            height: 15px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ---------- Empty state ---------- */
        .empty {
            text-align: center;
            padding: 3.5rem 1.5rem;
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
        .empty p { margin: 0 0 1.25rem; color: var(--muted); font-size: 0.95rem; }

        /* ---------- Ringkasan & checkout ---------- */
        .summary { padding: 1.5rem; position: sticky; top: 1.5rem; }

        .summary h2 { margin: 0 0 1rem; font-size: 1.1rem; }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            font-size: 0.92rem;
            color: var(--muted);
            margin-bottom: 0.65rem;
        }

        .row span:last-child { color: var(--text); font-weight: 600; white-space: nowrap; }

        .row.total {
            margin: 1rem 0 1.5rem;
            padding-top: 1rem;
            border-top: 1px dashed #cbd5e1;
            font-size: 1rem;
            color: var(--text);
            font-weight: 700;
        }

        .row.total span:last-child { font-size: 1.25rem; color: var(--primary); }

        .form-group { margin-bottom: 1.1rem; }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 0.4rem;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 0.95rem;
            font-size: 1rem; /* 16px biar ga auto-zoom di iOS */
            font-family: inherit;
            color: var(--text);
            background: #fff;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        textarea.form-control { min-height: 96px; resize: vertical; line-height: 1.5; }

        .form-control::placeholder { color: #94a3b8; }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            background: var(--primary);
            color: #fff;
            border: 0;
            padding: 0.9rem 1rem;
            font-size: 1rem;
            font-family: inherit;
            font-weight: 600;
            text-decoration: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.15s, transform 0.05s;
        }

        .btn:hover { background: var(--primary-hover); }
        .btn:active { transform: translateY(1px); }
        .btn:focus-visible { outline: 3px solid rgba(79, 70, 229, 0.35); outline-offset: 2px; }

        .btn.inline { width: auto; padding: 0.8rem 1.5rem; }

        /* ---------- Responsive ---------- */
        @media (max-width: 900px) {
            .layout { grid-template-columns: 1fr; }
            .summary { position: static; }
        }

        @media (max-width: 520px) {
            body { padding: 1rem 0.75rem 2rem; }

            .page-header { align-items: flex-start; }
            .back-link { width: 100%; justify-content: center; }

            .item {
                grid-template-columns: 44px minmax(0, 1fr);
                padding: 1rem;
                gap: 0.75rem;
            }

            .item-thumb { width: 44px; height: 44px; font-size: 1rem; }

            .item-side {
                grid-column: 1 / -1;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                padding-top: 0.75rem;
                border-top: 1px dashed var(--border);
            }

            .btn-remove { margin-right: 0; }
            .summary { padding: 1.25rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; }
        }
    </style>
</head>
<body>
    @php
        $shipping = 5000;
        $grandTotal = 0;
        foreach ($items as $it) {
            $grandTotal += $it->product->price * $it->quantity;
        }
    @endphp

    <div class="page">
        <header class="page-header">
            <div>
                <h1>Keranjang Belanja</h1>
                @if(count($items) > 0)
                    <div class="count">{{ count($items) }} produk di keranjang</div>
                @endif
            </div>
            <a class="back-link" href="{{ route('buyer.dashboard') }}">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M19 12H5" /><path d="m11 6-6 6 6 6" /></svg>
                Kembali ke Katalog
            </a>
        </header>

        @if(session('error'))
            <div class="alert" role="alert">{{ session('error') }}</div>
        @endif

        @if(count($items) > 0)
            <div class="layout">

                {{-- Daftar produk --}}
                <section class="card" aria-label="Daftar produk di keranjang">
                    <ul class="items">
                        @foreach($items as $item)
                            @php $subtotal = $item->product->price * $item->quantity; @endphp
                            <li class="item">
                                <div class="item-thumb" aria-hidden="true">
                                    {{ strtoupper(mb_substr($item->product->name, 0, 1)) }}
                                </div>

                                <div class="item-info">
                                    <p class="item-name">{{ $item->product->name }}</p>
                                    <p class="item-seller">UMKM: {{ $item->product->seller->name ?? '-' }}</p>
                                    <div class="item-meta">
                                        <span>Rp {{ number_format($item->product->price, 0, ',', '.') }}</span>
                                        <span>&times;</span>
                                        <span class="qty">{{ $item->quantity }}</span>
                                    </div>
                                </div>

                                <div class="item-side">
                                    <div class="item-subtotal">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                                    <form action="{{ route('buyer.cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-remove">
                                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                                <path d="M3 6h18" />
                                                <path d="M8 6V4h8v2" />
                                                <path d="M6 6l1 14h10l1-14" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>

                {{-- Ringkasan & checkout --}}
                <aside class="card summary" aria-label="Ringkasan pesanan">
                    <h2>Ringkasan Pesanan</h2>

                    <div class="row">
                        <span>Total Produk</span>
                        <span>Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="row">
                        <span>Ongkir Antarkampus (Flat)</span>
                        <span>Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                    </div>
                    <div class="row total">
                        <span>Total Pembayaran</span>
                        <span>Rp {{ number_format($grandTotal + $shipping, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('buyer.checkout') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="delivery_address">Alamat / Lokasi Pengantaran Tujuan</label>
                            <textarea
                                id="delivery_address"
                                name="delivery_address"
                                class="form-control"
                                required
                                placeholder="Contoh: Gedung Fakultas Teknik, Kampus A (Titik Kumpul Lobi)"
                            >{{ old('delivery_address') }}</textarea>
                        </div>
                        <button type="submit" class="btn">Buat Pesanan (Checkout)</button>
                    </form>
                </aside>
            </div>
        @else
            <section class="card empty">
                <div class="empty-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 4h2l2.4 11.2a1.5 1.5 0 0 0 1.5 1.2h8.2a1.5 1.5 0 0 0 1.5-1.1L20 8H6.2" />
                        <circle cx="9.5" cy="20" r="1" />
                        <circle cx="17" cy="20" r="1" />
                    </svg>
                </div>
                <h2>Keranjang belanja masih kosong</h2>
                <p>Yuk, cari makanan dan produk UMKM kampus di katalog.</p>
                <a href="{{ route('buyer.dashboard') }}" class="btn inline">Lihat Katalog</a>
            </section>
        @endif
    </div>
    <script src="{{ asset('js/marketplace-confirm.js') }}?v=20261005b"></script>
</body>
</html>
