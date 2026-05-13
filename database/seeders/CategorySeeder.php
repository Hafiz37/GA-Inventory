<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Alat Jaringan', 'type' => 'Elektronik', 'description' => 'Router, Switch, Access Point'],
            ['name' => 'Laptop & PC', 'type' => 'Elektronik', 'description' => 'Unit laptop staf dan komputer PC'],
            ['name' => 'Alat Teknik', 'type' => 'Perkakas', 'description' => 'Tang, Obeng, Solder'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
