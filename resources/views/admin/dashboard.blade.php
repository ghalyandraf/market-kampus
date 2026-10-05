<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Marketplace Kampus</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8fafc; margin: 0; padding: 2rem; color: #1e293b; }
        .container { max-width: 1100px; margin: 0 auto; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
        .stat-card { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .stat-number { font-size: 1.8rem; font-weight: 700; color: #4f46e5; margin-top: 0.5rem; }
        .card { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 1.5rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #e2e8f0; font-size: 0.875rem; }
        th { background: #f1f5f9; }
        .badge { background: #e0e7ff; color: #3730a3; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; }
        .btn { background: #4f46e5; color: white; border: none; padding: 0.4rem 0.8rem; border-radius: 4px; font-weight: 600; cursor: pointer; }
        .btn-success { background: #22c55e; }
        .btn-danger { background: #ef4444; color: white; border: none; padding: 0.4rem 0.8rem; border-radius: 4px; font-weight: 600; cursor: pointer; }
        .alert-success { background: #dcfce7; color: #166534; padding: 0.75rem; border-radius: 4px; margin-bottom: 1rem; }
    </style>
    <link rel="stylesheet" href="{{ asset('css/marketplace.css') }}?v=20261005b">
</head>
<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2>Dashboard Administrator</h2>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-danger">Logout</button>
            </form>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <!-- Statistik Ringkas -->
        <div class="stats-grid">
            <div class="stat-card">
                <div>Total Pengguna</div>
                <div class="stat-number">{{ $totalUsers }}</div>
            </div>
            <div class="stat-card">
                <div>Total UMKM (Seller)</div>
                <div class="stat-number">{{ $totalSellers }}</div>
            </div>
            <div class="stat-card">
                <div>Total Kurir (Driver)</div>
                <div class="stat-number">{{ $totalDrivers }}</div>
            </div>
            <div class="stat-card">
                <div>Total Pesanan</div>
                <div class="stat-number">{{ $totalOrders }}</div>
            </div>
        </div>

        <!-- Kelola User & Verifikasi -->
        <div class="card">
            <h3>Manajemen & Verifikasi Pengguna (User)</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                        <tr>
                            <td><strong>{{ $u->name }}</strong></td>
                            <td>{{ $u->email }}</td>
                            <td><span class="badge">{{ $u->role->name ?? '-' }}</span></td>
                            <td>
                                @if($u->is_verified)
                                    <span style="color: #166534; font-weight: 600;">Verified</span>
                                @else
                                    <span style="color: #991b1b; font-weight: 600;">Unverified</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.users.verify', $u->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn {{ $u->is_verified ? 'btn-danger' : 'btn-success' }}">
                                        {{ $u->is_verified ? 'Batalkan Verifikasi' : 'Verifikasi Akun' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pantau Semua Transaksi -->
        <div class="card">
            <h3>Monitor Seluruh Transaksi Pesanan</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID Order</th>
                        <th>Pembeli</th>
                        <th>UMKM</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $ord)
                        <tr>
                            <td>#{{ $ord->id }}</td>
                            <td>{{ $ord->buyer->name ?? '-' }}</td>
                            <td>{{ $ord->seller->name ?? '-' }}</td>
                            <td>Rp {{ number_format($ord->total_amount, 0, ',', '.') }}</td>
                            <td><span class="badge">{{ $ord->status }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #64748b;">Belum ada transaksi pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ asset('js/marketplace-confirm.js') }}?v=20261005b"></script>
</body>
</html>
