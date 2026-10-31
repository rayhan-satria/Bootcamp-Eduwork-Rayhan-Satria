<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategories;
use App\Models\Product;
use Pest\Plugins\Actions\CallsTerminable;

class CoffeaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. kategori menu
        $coffee = ProductCategories::create(['name' => 'Coffee Based']);
        $nonCoffee = ProductCategories::create(['name' => 'Non-Coffee']);
        $dessert = ProductCategories::create(['name' => 'Dessert']);
        $mainCourse = ProductCategories::create(['name' => 'Main Course']);

        // 2. menu
        Product::create([
            'category_id' => $coffee->id,
            'name' => 'Espresso',
            'slug' => 'Espresso',
            'description' => 'Pure cofee with zero distraction',
            'price' => 20000,
            'stock' => rand(1, 20),
            'image' => 'espresso.avif'
        ]);
        Product::create([
            'category_id' => $nonCoffee->id,
            'name' => 'Red Velvet',
            'slug' => 'Red Velvet',
            'description' => 'Creamy red velvet over ice',
            'price' => 32000,
            'stock' => rand(1, 20),
            'image' => 'red velvet.avif'
        ]);
        Product::create([
            'category_id' => $dessert->id,
            'name' => 'Croissant',
            'slug' => 'Croissant',
            'description' => 'Flaky golden butter pastry crisp',
            'price' => 22000,
            'stock' => rand(1, 20),
            'image' => 'quasong.avif'
        ]);
        Product::create([
            'category_id' => $mainCourse->id,
            'name' => 'Salad',
            'slug' => 'Salad',
            'description' => 'awikwok',
            'price' => 35000,
            'stock' => rand(1, 20),
            'image' => 'default.jpg'
        ]);
    }
}
