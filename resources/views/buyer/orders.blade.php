<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - Marketplace Kampus</title>
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

        .page { max-width: 820px; margin: 0 auto; }

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
        .order-seller { color: var(--muted); font-size: 0.85rem; margin-top: 0.15rem; overflow-wrap: anywhere; }

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

        .order-body { padding: 1.1rem 1.35rem; display: grid; gap: 0.9rem; }

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
        .total small { font-weight: 400; font-size: 0.8rem; color: var(--muted); margin-left: 0.35rem; }

        /* OTP */
        .otp-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.9rem 1.35rem;
            background: var(--primary-soft);
            border-top: 1px solid #e0e7ff;
        }

        .otp-text { min-width: 0; }
        .otp-label { font-size: 0.82rem; font-weight: 600; color: var(--primary-text); }
        .otp-hint { font-size: 0.78rem; color: var(--muted); margin-top: 0.1rem; }

        .otp-code {
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 0.25em;
            color: var(--primary-text);
            background: #fff;
            border: 1px dashed #a5b4fc;
            border-radius: 10px;
            padding: 0.4rem 0.9rem 0.4rem 1.15rem; /* kompensasi letter-spacing */
            white-space: nowrap;
        }

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
        .empty p { margin: 0 0 1.25rem; color: var(--muted); font-size: 0.95rem; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            color: #fff;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 10px;
            transition: background 0.15s;
        }

        .btn:hover { background: var(--primary-hover); }
        .btn:focus-visible { outline: 3px solid rgba(79, 70, 229, 0.35); outline-offset: 2px; }

        /* ---------- Responsive ---------- */
        @media (max-width: 520px) {
            body { padding: 1rem 0.75rem 2rem; }

            .page-header { align-items: flex-start; }
            .back-link { width: 100%; justify-content: center; }

            .order-head, .order-body, .otp-box { padding-left: 1rem; padding-right: 1rem; }

            .otp-box { flex-direction: column; align-items: stretch; text-align: center; }
            .otp-code { font-size: 1.4rem; }
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
                <h1>Riwayat Pesanan</h1>
                @if(count($orders) > 0)
                    <div class="sub">{{ count($orders) }} pesanan</div>
                @endif
            </div>
            <a class="back-link" href="{{ route('buyer.dashboard') }}">
                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 12H5" /><path d="m11 6-6 6 6 6" /></svg>
                Kembali ke Katalog
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
                        <div class="order-seller">UMKM: {{ $ord->seller->name ?? '-' }}</div>
                    </div>
                    <span class="badge">{{ $ord->status }}</span>
                </div>

                <div class="order-body">
                    <div>
                        <div class="detail-label">Alamat Tujuan</div>
                        <div class="detail-value">{{ $ord->delivery_address }}</div>
                    </div>
                    <div>
                        <div class="detail-label">Total Pembayaran</div>
                        <div class="detail-value total">
                            Rp {{ number_format($ord->total_amount, 0, ',', '.') }}
                            <small>(Termasuk Ongkir)</small>
                        </div>
                    </div>
                </div>

                <div class="otp-box">
                    <div class="otp-text">
                        <div class="otp-label">Kode OTP Penerimaan</div>
                        <div class="otp-hint">Tunjukkan kode ini saat pesanan diterima.</div>
                    </div>
                    <div class="otp-code">{{ $ord->otp_code }}</div>
                </div>
            </article>
        @empty
            <section class="card empty">
                <div class="empty-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M4 7.5 12 3l8 4.5v9L12 21l-8-4.5v-9Z" /><path d="m4 7.5 8 4.5 8-4.5" /><path d="M12 12v9" /></svg>
                </div>
                <h2>Belum ada pesanan</h2>
                <p>Pesanan yang kamu buat akan muncul di sini.</p>
                <a href="{{ route('buyer.dashboard') }}" class="btn">Lihat Katalog</a>
            </section>
        @endforelse
    </div>
</body>
</html>