<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Driver - Marketplace Kampus</title>
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
            --danger: #dc2626;
            --danger-soft: #fef2f2;
            --danger-border: #fecaca;
            --danger-text: #b91c1c;
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
            max-width: 1000px;
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
        .page { max-width: 1000px; margin: 0 auto; padding: 2rem 1.5rem 3rem; }

        .page-head { margin-bottom: 1.5rem; }
        .page-head h1 { margin: 0 0 0.3rem; font-size: 1.6rem; letter-spacing: -0.02em; }
        .page-head p { margin: 0; color: var(--muted); font-size: 0.95rem; }

        .alert {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.75rem 0.95rem;
            border-radius: 10px;
            margin-bottom: 1.25rem;
            font-size: 0.9rem;
        }

        .alert-success { background: var(--success-bg); border: 1px solid var(--success-border); color: var(--success-text); }
        .alert-error { background: var(--danger-soft); border: 1px solid var(--danger-border); color: var(--danger-text); }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 10px 25px -15px rgba(15, 23, 42, 0.15);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1.1rem 1.35rem;
            border-bottom: 1px solid var(--border);
        }

        .card-head h2 { margin: 0; font-size: 1.05rem; letter-spacing: -0.01em; }

        .count {
            min-width: 28px;
            height: 28px;
            padding: 0 0.6rem;
            display: grid;
            place-items: center;
            background: var(--primary-soft);
            color: var(--primary-text);
            font-size: 0.8rem;
            font-weight: 700;
            border-radius: 999px;
        }

        .card-body { padding: 1.1rem 1.35rem 1.35rem; display: grid; gap: 1rem; }

        /* ---------- Item order ---------- */
        .order {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1rem 1.1rem;
            background: #fff;
        }

        .order-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 0.75rem;
        }

        .order-id { font-weight: 700; font-size: 1rem; }

        .badge {
            display: inline-block;
            flex-shrink: 0;
            background: var(--primary-soft);
            color: var(--primary-text);
            padding: 0.25rem 0.7rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .meta { display: grid; gap: 0.6rem; }

        .meta-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.1rem;
        }

        .meta-value { font-size: 0.93rem; line-height: 1.5; overflow-wrap: anywhere; }

        /* ---------- Form update ---------- */
        .update-form {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px dashed #cbd5e1;
            display: grid;
            grid-template-columns: minmax(0, 1.3fr) minmax(0, 1fr) auto;
            gap: 0.65rem;
            align-items: center;
        }

        .form-control {
            width: 100%;
            padding: 0.7rem 0.85rem;
            font-size: 1rem; /* 16px biar ga auto-zoom di iOS */
            font-family: inherit;
            color: var(--text);
            background: #fff;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-control::placeholder { color: #94a3b8; }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
        }

        select.form-control {
            appearance: none;
            -webkit-appearance: none;
            padding-right: 2.4rem;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 18px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            background: var(--primary);
            color: #fff;
            border: 0;
            padding: 0.75rem 1.15rem;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            white-space: nowrap;
            transition: background 0.15s, transform 0.05s;
        }

        .btn:hover { background: var(--primary-hover); }
        .btn:active { transform: translateY(1px); }
        .btn:focus-visible { outline: 3px solid rgba(79, 70, 229, 0.35); outline-offset: 2px; }

        /* Order siap jemput */
        .order.pickup {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .pickup-info { min-width: 0; }

        /* ---------- Empty state ---------- */
        .empty {
            text-align: center;
            padding: 2rem 1rem;
            color: var(--muted);
            font-size: 0.93rem;
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            background: #f8fafc;
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 720px) {
            .update-form { grid-template-columns: 1fr 1fr; }
            .update-form select { grid-column: 1 / -1; }
            .update-form .btn { width: 100%; }
        }

        @media (max-width: 560px) {
            .topbar-inner { padding: 0.65rem 1rem; }
            .page { padding: 1.25rem 1rem 2rem; }
            .page-head h1 { font-size: 1.35rem; }

            .card-head, .card-body { padding-left: 1rem; padding-right: 1rem; }

            .btn-logout span { display: none; }
            .btn-logout { padding: 0.6rem; }
            .btn-logout svg { width: 19px; height: 19px; }

            .update-form { grid-template-columns: 1fr; }
            .update-form select { grid-column: auto; }

            .order.pickup { flex-direction: column; align-items: stretch; }
            .order.pickup .btn { width: 100%; }
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
                        <path d="M4 7.5 12 3l8 4.5v9L12 21l-8-4.5v-9Z" />
                        <path d="m4 7.5 8 4.5 8-4.5" />
                        <path d="M12 12v9" />
                    </svg>
                </div>
                <div class="brand-text">
                    <div class="brand-name">Marketplace Kampus</div>
                    <div class="brand-role">Kurir (Driver Mahasiswa)</div>
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
        <div class="page-head">
            <h1>Dashboard Kurir</h1>
            <p>Kelola pengiriman aktif dan ambil order yang siap dijemput.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success" role="status">
                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 6 9 17l-5-5" /></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error" role="alert">
                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Order yang sedang saya antar --}}
        <section class="card" aria-label="Pengiriman aktif">
            <div class="card-head">
                <h2>Pengiriman Aktif Saya</h2>
                <span class="count">{{ count($myDeliveries) }}</span>
            </div>
            <div class="card-body">
                @forelse($myDeliveries as $deliv)
                    <article class="order">
                        <div class="order-top">
                            <div class="order-id">Order #{{ $deliv->id }}</div>
                            <span class="badge">{{ $deliv->status }}</span>
                        </div>

                        <div class="meta">
                            <div>
                                <div class="meta-label">UMKM</div>
                                <div class="meta-value">{{ $deliv->seller->name ?? '-' }}</div>
                            </div>
                            <div>
                                <div class="meta-label">Tujuan</div>
                                <div class="meta-value">{{ $deliv->delivery_address }}</div>
                            </div>
                        </div>

                        <form action="{{ route('driver.orders.update', $deliv->id) }}" method="POST" class="update-form">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-control" aria-label="Status pengiriman" required>
                                <option value="on_delivery">Dalam Perjalanan (On Delivery)</option>
                                <option value="delivered">Terkirim / Selesai (Delivered)</option>
                            </select>
                            <input
                                type="text"
                                name="otp_code"
                                class="form-control"
                                placeholder="4 digit OTP Buyer"
                                aria-label="Kode OTP Buyer"
                                inputmode="numeric"
                                autocomplete="off"
                            >
                            <button type="submit" class="btn">Selesaikan / Update</button>
                        </form>
                    </article>
                @empty
                    <div class="empty">Tidak ada pengiriman aktif saat ini.</div>
                @endforelse
            </div>
        </section>

        {{-- Order tersedia untuk diambil --}}
        <section class="card" aria-label="Order siap jemput">
            <div class="card-head">
                <h2>Order Siap Jemput (Ready for Pickup)</h2>
                <span class="count">{{ count($availableOrders) }}</span>
            </div>
            <div class="card-body">
                @forelse($availableOrders as $ord)
                    <article class="order pickup">
                        <div class="pickup-info">
                            <div class="order-id">Order #{{ $ord->id }}</div>
                            <div class="meta" style="margin-top: 0.5rem;">
                                <div>
                                    <div class="meta-label">UMKM</div>
                                    <div class="meta-value">{{ $ord->seller->name ?? '-' }}</div>
                                </div>
                                <div>
                                    <div class="meta-label">Tujuan</div>
                                    <div class="meta-value">{{ $ord->delivery_address }}</div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('driver.orders.accept', $ord->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn">Ambil Order</button>
                        </form>
                    </article>
                @empty
                    <div class="empty">Belum ada pesanan yang siap dijemput.</div>
                @endforelse
            </div>
        </section>
    </main>
    <script src="{{ asset('js/marketplace-confirm.js') }}?v=20261005b"></script>
</body>
</html>
