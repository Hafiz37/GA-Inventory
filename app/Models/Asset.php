<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    // Daftar kolom tabel assets yang boleh diisi
    protected $fillable = [
        'category_id', 'name', 'brand', 'serial_number',
        'status', 'held_by', 'stock', 'notes'
    ];

    // Relasi: Asset ini adalah milik dari Satu Kategori (belongsTo)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scope khusus untuk filter stok barang yang <= 5 (Trigger Alert!)
    public function scopeLowStock($query)
    {
        return $query->where('stock', '<=', 5);
    }
}
