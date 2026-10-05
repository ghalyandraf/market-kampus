<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Marketplace Kampus</title>
    <style>
        :root {
            --bg: #f1f5f9;
            --surface: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --border: #e2e8f0;
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --dark: #0f172a;
            --danger-bg: #fef2f2;
            --danger-border: #fecaca;
            --danger-text: #b91c1c;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body { margin: 0; min-height: 100%; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .auth-shell {
            width: 100%;
            max-width: 960px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px -20px rgba(15, 23, 42, 0.18);
        }

        /* ---------- Panel kiri (brand) ---------- */
        .auth-aside {
            background: var(--dark);
            color: #e2e8f0;
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 2rem;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--primary);
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .brand-mark svg {
            width: 24px;
            height: 24px;
            fill: none;
            stroke: #fff;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .brand-name { font-weight: 700; font-size: 1.05rem; color: #fff; letter-spacing: -0.01em; }

        .aside-copy h2 {
            margin: 0 0 0.75rem;
            font-size: 1.75rem;
            line-height: 1.25;
            color: #fff;
            letter-spacing: -0.02em;
        }

        .aside-copy p { margin: 0; color: #94a3b8; line-height: 1.6; font-size: 0.95rem; }

        .feature-list { list-style: none; margin: 0; padding: 0; display: grid; gap: 0.75rem; }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            font-size: 0.9rem;
            color: #cbd5e1;
        }

        .feature-list svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            fill: none;
            stroke: #a5b4fc;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ---------- Panel kanan (form) ---------- */
        .auth-main {
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-main h1 {
            margin: 0 0 0.4rem;
            font-size: 1.6rem;
            letter-spacing: -0.02em;
        }

        .auth-subtitle {
            margin: 0 0 1.75rem;
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.55;
        }

        .alert {
            background: var(--danger-bg);
            border: 1px solid var(--danger-border);
            color: var(--danger-text);
            padding: 0.7rem 0.9rem;
            border-radius: 10px;
            margin-bottom: 1.25rem;
            font-size: 0.875rem;
        }

        .form-group { margin-bottom: 1.15rem; }

        .form-group label {
            display: block;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 0.4rem;
        }

        .input-wrap { position: relative; }

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

        .form-control::placeholder { color: #94a3b8; }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
        }

        .form-control.is-invalid { border-color: #f87171; }

        .has-toggle .form-control { padding-right: 3rem; }

        .toggle-pw {
            position: absolute;
            top: 50%;
            right: 0.4rem;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            background: none;
            border: 0;
            border-radius: 8px;
            color: var(--muted);
            cursor: pointer;
        }

        .toggle-pw:hover { color: var(--text); background: #f1f5f9; }
        .toggle-pw:focus-visible { outline: 2px solid var(--primary); }

        .toggle-pw svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .field-error { color: var(--danger-text); font-size: 0.8rem; margin-top: 0.35rem; }

        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.4rem;
            font-size: 0.875rem;
        }

        .remember { display: flex; align-items: center; gap: 0.5rem; color: var(--muted); cursor: pointer; }
        .remember input { width: 16px; height: 16px; accent-color: var(--primary); }

        .btn {
            width: 100%;
            background: var(--primary);
            color: #fff;
            border: 0;
            padding: 0.9rem 1rem;
            font-size: 1rem;
            font-family: inherit;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.15s, transform 0.05s;
        }

        .btn:hover { background: var(--primary-hover); }
        .btn:active { transform: translateY(1px); }
        .btn:focus-visible { outline: 3px solid rgba(79, 70, 229, 0.35); outline-offset: 2px; }

        .footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: var(--muted);
        }

        .footer a { color: var(--primary); text-decoration: none; font-weight: 600; }
        .footer a:hover { text-decoration: underline; }

        /* ---------- Responsive ---------- */
        @media (max-width: 820px) {
            body { padding: 1rem; align-items: flex-start; }

            .auth-shell {
                grid-template-columns: 1fr;
                max-width: 480px;
                margin: auto;
            }

            /* panel brand jadi header ringkas */
            .auth-aside { padding: 1.5rem; gap: 0; }
            .aside-copy, .feature-list { display: none; }
            .auth-main { padding: 1.75rem 1.5rem 2rem; }
        }

        @media (max-width: 380px) {
            body { padding: 0; }
            .auth-shell { border-radius: 0; border: 0; min-height: 100vh; }
            .auth-main { padding: 1.5rem 1.25rem 2rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; }
        }
    </style>
</head>
<body>
    <div class="auth-shell">

        {{-- Panel brand --}}
        <aside class="auth-aside">
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

            <div class="aside-copy">
                <h2>Semua kebutuhan kampus, satu tempat.</h2>
                <p>Pesan makanan kampus, kelola UMKM, dan pantau order dengan mudah.</p>
            </div>

            <ul class="feature-list">
                <li>
                    <svg viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>
                    Pesan makanan tanpa antre
                </li>
                <li>
                    <svg viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>
                    Kelola produk &amp; UMKM sendiri
                </li>
                <li>
                    <svg viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>
                    Pantau status order real-time
                </li>
            </ul>
        </aside>

        {{-- Form login --}}
        <main class="auth-main">
            <h1>Masuk</h1>
            <p class="auth-subtitle">Selamat datang kembali! Masuk untuk melanjutkan.</p>

            @if($errors->any())
                <div class="alert" role="alert">{{ $errors->first() }}</div>
            @endif

            <form action="{{ url('/login') }}" method="POST" novalidate>
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="nama@email.com"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required
                        autofocus
                    >
                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap has-toggle">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >
                        <button type="button" class="toggle-pw" id="togglePw" aria-label="Tampilkan password">
                            <svg viewBox="0 0 24 24" id="iconEye">
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg viewBox="0 0 24 24" id="iconEyeOff" style="display:none">
                                <path d="M3 3l18 18"/>
                                <path d="M10.6 5.1A10.6 10.6 0 0 1 12 5c6.5 0 10 7 10 7a17 17 0 0 1-3.2 4.2"/>
                                <path d="M6.6 6.6C3.7 8.4 2 12 2 12s3.5 7 10 7c1.7 0 3.2-.4 4.5-1"/>
                                <path d="M9.9 9.9a3 3 0 0 0 4.2 4.2"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <label class="remember">
                        <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn">Masuk Sekarang</button>
            </form>

            <div class="footer">
                Belum punya akun? <a href="{{ url('/register') }}">Daftar di sini</a>
            </div>
        </main>
    </div>

    <script>
        (function () {
            var btn = document.getElementById('togglePw');
            var input = document.getElementById('password');
            var eye = document.getElementById('iconEye');
            var eyeOff = document.getElementById('iconEyeOff');

            btn.addEventListener('click', function () {
                var show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                eye.style.display = show ? 'none' : '';
                eyeOff.style.display = show ? '' : 'none';
                btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
            });
        })();
    </script>
</body>
</html>