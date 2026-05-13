<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Category;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        // Mengambil ID kategori pertama (Alat Jaringan)
        $jaringanId = Category::where('name', 'Alat Jaringan')->first()->id;
        $laptopId = Category::where('name', 'Laptop & PC')->first()->id;

        Asset::create([
            'category_id' => $jaringanId,
            'name' => 'Router MikroTik RB4011',
            'brand' => 'MikroTik',
            'serial_number' => 'MT-990123',
            'status' => 'Tersedia',
            'stock' => 3,
            'notes' => 'Baru datang dari gudang pusat'
        ]);

        Asset::create([
            'category_id' => $laptopId,
            'name' => 'Macbook Pro M2',
            'brand' => 'Apple',
            'serial_number' => 'APPLE-M2-001',
            'status' => 'Dipakai',
            'held_by' => 'Hafiz (Admin GA)',
            'stock' => 1,
            'notes' => 'Unit inventaris kantor'
        ]);
    }
}
