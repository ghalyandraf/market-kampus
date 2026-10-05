<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - Seller UMKM</title>
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
            padding: 2rem 1.5rem 3rem;
        }

        .page { max-width: 1000px; margin: 0 auto; }

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
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
            padding: 0.75rem 0.95rem;
            border-radius: 10px;
            margin-bottom: 1.25rem;
            font-size: 0.9rem;
        }

        .alert svg.ic { margin-top: 0.15rem; }
        .alert-success { background: var(--success-bg); border: 1px solid var(--success-border); color: var(--success-text); }
        .alert-error { background: var(--danger-soft); border: 1px solid var(--danger-border); color: var(--danger-text); }
        .alert-error ul { margin: 0; padding-left: 1.1rem; }

        /* ---------- Card ---------- */
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

        .card-body { padding: 1.35rem; }

        /* ---------- Form ---------- */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0 1rem;
        }

        .form-group { margin-bottom: 1.1rem; }
        .span-2 { grid-column: 1 / -1; }

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

        input[type="file"].form-control { padding: 0.55rem; cursor: pointer; }

        input[type="file"].form-control::file-selector-button {
            margin-right: 0.85rem;
            padding: 0.5rem 0.9rem;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary-text);
            background: var(--primary-soft);
            border: 0;
            border-radius: 8px;
            cursor: pointer;
        }

        input[type="file"].form-control::file-selector-button:hover { background: #e0e7ff; }

        .hint { color: var(--muted); font-size: 0.8rem; margin-top: 0.35rem; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            background: var(--primary);
            color: #fff;
            border: 0;
            padding: 0.85rem 1.5rem;
            font-family: inherit;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.15s, transform 0.05s;
        }

        .btn:hover { background: var(--primary-hover); }
        .btn:active { transform: translateY(1px); }
        .btn:focus-visible { outline: 3px solid rgba(79, 70, 229, 0.35); outline-offset: 2px; }

        /* ---------- Tabel produk ---------- */
        .table-wrap { width: 100%; }

        table { width: 100%; border-collapse: collapse; }

        th, td {
            padding: 0.85rem 1.1rem;
            text-align: left;
            font-size: 0.9rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        th {
            background: #f8fafc;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        tbody tr:last-child td { border-bottom: 0; }
        tbody tr:hover { background: #fafbff; }

        th:first-child, td:first-child { padding-left: 1.35rem; }
        th:last-child, td:last-child { padding-right: 1.35rem; }

        .table-photo {
            width: 52px;
            height: 52px;
            border-radius: 10px;
            background: #f1f5f9;
            display: grid;
            place-items: center;
            overflow: hidden;
        }

        .table-photo img { width: 100%; height: 100%; object-fit: cover; display: block; }

        .photo-placeholder {
            width: 24px;
            height: 24px;
            fill: none;
            stroke: #94a3b8;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .prod-name { font-weight: 600; overflow-wrap: anywhere; }

        .chip {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            background: #f1f5f9;
            color: #334155;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .price { font-weight: 600; white-space: nowrap; }

        .btn-danger {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.45rem 0.8rem;
            font-family: inherit;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--danger);
            background: var(--surface);
            border: 1px solid var(--danger-border);
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-danger:hover { background: var(--danger-soft); }
        .btn-danger:focus-visible { outline: 2px solid var(--danger); outline-offset: 2px; }

        .btn-danger svg.ic { width: 15px; height: 15px; }

        /* ---------- Empty state ---------- */
        .empty { text-align: center; padding: 3rem 1.5rem; }

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

        .empty h3 { margin: 0 0 0.4rem; font-size: 1.1rem; }
        .empty p { margin: 0; color: var(--muted); font-size: 0.95rem; }

        /* ---------- Responsive ---------- */
        @media (max-width: 720px) {
            /* tabel jadi kartu bertumpuk */
            table, tbody, tr, td { display: block; width: 100%; }
            thead { display: none; }

            tbody tr {
                display: grid;
                grid-template-columns: 56px minmax(0, 1fr);
                gap: 0.25rem 0.85rem;
                padding: 1rem 1.1rem;
                border-bottom: 1px solid var(--border);
            }

            tbody tr:last-child { border-bottom: 0; }
            tbody tr:hover { background: transparent; }

            td { padding: 0; border: 0; }
            th:first-child, td:first-child, th:last-child, td:last-child { padding-left: 0; padding-right: 0; }

            td.col-photo { grid-row: 1 / span 3; }
            td.col-name { grid-column: 2; }
            td.col-meta { grid-column: 2; display: flex; flex-wrap: wrap; align-items: center; gap: 0.5rem 0.75rem; font-size: 0.85rem; color: var(--muted); }
            td.col-meta .price { color: var(--text); }
            td.col-action { grid-column: 1 / -1; margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px dashed var(--border); }
            td.col-action .btn-danger { width: 100%; justify-content: center; padding: 0.6rem; }

            /* kolom kategori, harga, stok digabung ke satu baris lewat .col-meta */
            .desktop-only { display: none !important; }
        }

        @media (min-width: 721px) {
            .mobile-only { display: none !important; }
        }

        @media (max-width: 600px) {
            body { padding: 1rem 0.75rem 2rem; }

            .page-header { align-items: flex-start; }
            .back-link { width: 100%; justify-content: center; }

            .card-head, .card-body { padding-left: 1rem; padding-right: 1rem; }

            .form-grid { grid-template-columns: 1fr; }
            .btn[type="submit"] { width: 100%; }
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
                <h1>Kelola Menu / Produk UMKM</h1>
                <div class="sub">Tambah menu baru dan atur daftar dagangan Anda.</div>
            </div>
            <a class="back-link" href="{{ route('seller.dashboard') }}">
                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 12H5" /><path d="m11 6-6 6 6 6" /></svg>
                Kembali ke Dashboard
            </a>
        </header>

        @if(session('success'))
            <div class="alert alert-success" role="status">
                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 6 9 17l-5-5" /></svg>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error" role="alert">
                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Tambah Produk --}}
        <section class="card" aria-label="Tambah produk baru">
            <div class="card-head">
                <h2>Tambah Produk Baru</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Nama Produk</label>
                            <input type="text" id="name" name="name" class="form-control" required placeholder="Contoh: Nasi Goreng Spesial" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select id="category_id" name="category_id" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">Harga (Rp)</label>
                            <input type="number" id="price" name="price" class="form-control" required placeholder="15000" inputmode="numeric" value="{{ old('price') }}">
                        </div>
                        <div class="form-group">
                            <label for="stock">Stok</label>
                            <input type="number" id="stock" name="stock" class="form-control" required placeholder="25" inputmode="numeric" value="{{ old('stock') }}">
                        </div>

                        <div class="form-group span-2">
                            <label for="description">Deskripsi</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Deskripsi makanan...">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group span-2">
                            <label for="image">Foto Produk</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/*">
                            <div class="hint">Opsional. Gunakan foto yang jelas agar menu lebih menarik.</div>
                        </div>
                    </div>

                    <button type="submit" class="btn">Simpan Produk</button>
                </form>
            </div>
        </section>

        {{-- Daftar Produk --}}
        <section class="card" aria-label="Daftar produk">
            <div class="card-head">
                <h2>Daftar Produk Anda</h2>
                <span class="count">{{ count($products) }}</span>
            </div>

            @if(count($products) > 0)
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $prod)
                                <tr>
                                    <td class="col-photo">
                                        <div class="table-photo">
                                            @if($prod->image)
                                                <img src="{{ asset('storage/' . $prod->image) }}" alt="{{ $prod->name }}" loading="lazy">
                                            @else
                                                <svg class="photo-placeholder" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 6.5A2.5 2.5 0 0 1 6.5 4h11A2.5 2.5 0 0 1 20 6.5v11a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 17.5v-11Z" /><path d="m6.5 16 3.25-3.25 2.5 2.5L15.5 12 18 14.5" /><circle cx="9" cy="8.5" r="1.25" /></svg>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="col-name"><span class="prod-name">{{ $prod->name }}</span></td>

                                    {{-- Desktop: 3 kolom terpisah --}}
                                    <td class="desktop-only"><span class="chip">{{ $prod->category->name ?? '-' }}</span></td>
                                    <td class="desktop-only"><span class="price">Rp {{ number_format($prod->price, 0, ',', '.') }}</span></td>
                                    <td class="desktop-only">{{ $prod->stock }}</td>

                                    {{-- Mobile: digabung satu baris --}}
                                    <td class="col-meta mobile-only">
                                        <span class="price">Rp {{ number_format($prod->price, 0, ',', '.') }}</span>
                                        <span class="chip">{{ $prod->category->name ?? '-' }}</span>
                                        <span>Stok: {{ $prod->stock }}</span>
                                    </td>

                                    <td class="col-action">
                                        <form action="{{ route('seller.products.destroy', $prod->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger">
                                                <svg class="ic" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 6h18" /><path d="M8 6V4h8v2" /><path d="M6 6l1 14h10l1-14" /></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty">
                    <div class="empty-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><path d="M4 7.5 12 3l8 4.5v9L12 21l-8-4.5v-9Z" /><path d="m4 7.5 8 4.5 8-4.5" /><path d="M12 12v9" /></svg>
                    </div>
                    <h3>Belum ada produk</h3>
                    <p>Produk yang kamu tambahkan lewat form di atas akan muncul di sini.</p>
                </div>
            @endif
        </section>
    </div>
    <script src="{{ asset('js/marketplace-confirm.js') }}?v=20261005b"></script>
</body>
</html>
