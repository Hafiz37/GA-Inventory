<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // $fillable mendaftarkan kolom mana saja yang boleh diisi data
    protected $fillable = ['name', 'type', 'description'];

    // Relasi: Satu Kategori memiliki Banyak Asset (hasMany)
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
