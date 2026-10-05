<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Masuk - Seller UMKM</title>
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
            padding: 2rem 1.5rem 3rem;
        }

        .page { max-width: 900px; margin: 0 auto; }

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

        /* ---------- Header ---------- */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }

        .page-header h1 { margin: 0; font-size: 1.6rem; letter-spacing: -0.02em; }
        .page-header .sub { color: var(--muted); font-size: 0.9rem; margin-top: 0.2rem; }

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
        .back-link:focus-visible { outline: 3px solid rgba(79, 70, 229, 0.3); outline-offset: 2px; }

        /* ---------- Alert ---------- */
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

        /* ---------- Kartu order ---------- */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 10px 25px -15px rgba(15, 23, 42, 0.15);
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .order-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            padding: 1.1rem 1.35rem;
            border-bottom: 1px solid var(--border);
        }

        .order-id { font-weight: 700; font-size: 1.05rem; letter-spacing: -0.01em; }
        .order-buyer { color: var(--muted); font-size: 0.85rem; margin-top: 0.15rem; overflow-wrap: anywhere; }

        .badge {
            display: inline-block;
            flex-shrink: 0;
            background: var(--primary-soft);
            color: var(--primary-text);
            padding: 0.3rem 0.75rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .order-body {
            padding: 1.1rem 1.35rem;
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr);
            gap: 0.9rem 1.5rem;
        }

        .detail-label {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 0.25rem;
        }

        .detail-value { font-size: 0.95rem; line-height: 1.5; overflow-wrap: anywhere; }
        .total { font-weight: 700; font-size: 1.15rem; }

        /* ---------- Form status ---------- */
        .status-box {
            padding: 1rem 1.35rem 1.2rem;
            background: #f8fafc;
            border-top: 1px solid var(--border);
        }

        .status-box .detail-label { margin-bottom: 0.5rem; }

        .status-form {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 0.65rem;
            align-items: center;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 0.9rem;
            font-size: 1rem; /* 16px biar ga auto-zoom di iOS */
            font-family: inherit;
            color: var(--text);
            background: #fff;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
        }

        select.form-control {
            appearance: none;
            -webkit-appearance: none;
            padding-right: 2.5rem;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.8rem center;
            background-size: 18px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            color: #fff;
            border: 0;
            padding: 0.8rem 1.25rem;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 10px;
            cursor: pointer;
            white-space: nowrap;
            transition: background 0.15s, transform 0.05s;
        }

        .btn:hover { background: var(--primary-hover); }
        .btn:active { transform: translateY(1px); }
        .btn:focus-visible { outline: 3px solid rgba(79, 70, 229, 0.35); outline-offset: 2px; }

        /* ---------- Empty state ---------- */
        .empty { text-align: center; padding: 3.5rem 1.5rem; }

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
        @media (max-width: 600px) {
            body { padding: 1rem 0.75rem 2rem; }

            .page-header { align-items: flex-start; }
            .back-link { width: 100%; justify-content: center; }

            .order-head, .order-body, .status-box { padding-left: 1rem; padding-right: 1rem; }

            .order-body { grid-template-columns: 1fr; }

            .status-form { grid-template-columns: 1fr; }
            .status-form .btn { width: 100%; }
        }

        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; }
        }
    </style>
</head>
<body>
    <div class="page">
        <header class="page-header">
            <div>
                <h1>Kelola Pesanan Masuk</h1>
                @if(count($orders) > 0)
                    <div class="sub">{{ count($orders) }} pesanan</div>
                @endif
            </div>
            <a class="back-link" href="{{ route('seller.dashboard') }}">
                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 12H5" /><path d="m11 6-6 6 6 6" /></svg>
                Kembali ke Dashboard
            </a>
        </header>

        @if(session('success'))
            <div class="alert-success" role="status">
                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 6 9 17l-5-5" /></svg>
                {{ session('success') }}
            </div>
        @endif

        @forelse($orders as $ord)
            <article class="card">
                <div class="order-head">
                    <div>
                        <div class="order-id">Order #{{ $ord->id }}</div>
                        <div class="order-buyer">Pembeli: {{ $ord->buyer->name ?? '-' }}</div>
                    </div>
                    <span class="badge">{{ $ord->status }}</span>
                </div>

                <div class="order-body">
                    <div>
                        <div class="detail-label">Alamat Pengantaran</div>
                        <div class="detail-value">{{ $ord->delivery_address }}</div>
                    </div>
                    <div>
                        <div class="detail-label">Total Harga Produk</div>
                        <div class="detail-value total">Rp {{ number_format($ord->total_product_price, 0, ',', '.') }}</div>
                    </div>
                </div>

                <div class="status-box">
                    <div class="detail-label">Ubah Status Pesanan</div>
                    <form action="{{ route('seller.orders.update', $ord->id) }}" method="POST" class="status-form">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-control" aria-label="Status pesanan">
                            <option value="accepted" {{ $ord->status == 'accepted' ? 'selected' : '' }}>Terima (Accepted)</option>
                            <option value="preparing" {{ $ord->status == 'preparing' ? 'selected' : '' }}>Sedang Disiapkan (Preparing)</option>
                            <option value="ready_for_pickup" {{ $ord->status == 'ready_for_pickup' ? 'selected' : '' }}>Siap Dijemput Kurir (Ready for Pickup)</option>
                            <option value="rejected" {{ $ord->status == 'rejected' ? 'selected' : '' }}>Tolak Pesanan (Rejected)</option>
                        </select>
                        <button type="submit" class="btn">Update Status</button>
                    </form>
                </div>
            </article>
        @empty
            <section class="card empty">
                <div class="empty-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M4 7.5 12 3l8 4.5v9L12 21l-8-4.5v-9Z" /><path d="m4 7.5 8 4.5 8-4.5" /><path d="M12 12v9" /></svg>
                </div>
                <h2>Belum ada pesanan masuk</h2>
                <p>Pesanan dari pembeli akan muncul di sini.</p>
            </section>
        @endforelse
    </div>
    <script src="{{ asset('js/marketplace-confirm.js') }}?v=20261005b"></script>
</body>
</html>
