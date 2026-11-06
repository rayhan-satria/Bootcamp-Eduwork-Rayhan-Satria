<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Elektronik',
                'slug' => 'elektronik',
                'description' => 'Teknologi cerdas untuk aktivitas harian lebih mudah dan praktis.',
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'description' => 'Koleksi up-to-date untuk ekspresikan gaya setiap hari.',
            ],
            [
                'name' => 'Rumah Tangga',
                'slug' => 'rumah-tangga',
                'description' => 'Perlengkapan estetik dan fungsional untuk hunian yang lebih nyaman.',
            ],
            [
                'name' => 'Olahraga',
                'slug' => 'olahraga',
                'description' => 'Pilihan alat berkualitas untuk dukung gaya hidup sehat dan aktif.',
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
