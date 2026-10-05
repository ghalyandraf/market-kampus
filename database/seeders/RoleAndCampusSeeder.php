<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleAndCampusSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Isi Data Roles (Sangat penting agar pilihan role di register tidak kosong/error)
        DB::table('roles')->insertOrIgnore([
            ['id' => 1, 'name' => 'buyer', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'seller', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'driver', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 2. Data Kampus (Opsional, karena input kampus sudah diubah jadi text bebas)
        DB::table('campuses')->insertOrIgnore([
            ['id' => 1, 'name' => 'Kampus A (Teknik & Saintek)', 'address' => 'Jl. Kampus Teknik No. 1', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Kampus B (Humaniora & Ekonomi)', 'address' => 'Jl. Kampus Ekonomi No. 5', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 3. Data Kategori Produk Makanan/Minuman
        DB::table('categories')->insertOrIgnore([
            ['id' => 1, 'name' => 'Makanan Berat', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Minuman', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Snack / Jajanan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
