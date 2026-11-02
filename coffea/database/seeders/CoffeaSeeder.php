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
        $nonCoffee = ProductCategories::create(['name' => 'Non Coffee']);
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
            'category_id' => $coffee->id,
            'name' => 'Americano',
            'slug' => 'Americano',
            'description' => 'Simple sleek coffee all day long',
            'price' => 25000,
            'stock' => rand(1, 20),
            'image' => 'americano.avif'
        ]);
        Product::create([
            'category_id' => $coffee->id,
            'name' => 'Butterscotch',
            'slug' => 'Butterscotch',
            'description' => 'Rich coffee with buttery magic',
            'price' => 38000,
            'stock' => rand(1, 20),
            'image' => 'butterscotch.avif'
        ]);
        Product::create([
            'category_id' => $coffee->id,
            'name' => 'Caffe Latte',
            'slug' => 'Caffe Latte',
            'description' => 'Soft smooth and milky comfort',
            'price' => 30000,
            'stock' => rand(1, 20),
            'image' => 'caffe latte.avif'
        ]);
        Product::create([
            'category_id' => $coffee->id,
            'name' => 'Cappucino',
            'slug' => 'Cappucino',
            'description' => 'Bold coffee with cloud foam',
            'price' => 30000,
            'stock' => rand(1, 20),
            'image' => 'cappucino.avif'
        ]);
        Product::create([
            'category_id' => $coffee->id,
            'name' => 'Caramel Macchiato',
            'slug' => 'Caramel Macchiato',
            'description' => 'Layered espresso with golden drizzle',
            'price' => 35000,
            'stock' => rand(1, 20),
            'image' => 'caramel macchiato.avif'
        ]);
        Product::create([
            'category_id' => $coffee->id,
            'name' => 'Cold Brew',
            'slug' => 'Cold Brew',
            'description' => 'Steeped slow for smooth kick',
            'price' => 28000,
            'stock' => rand(1, 20),
            'image' => 'cold brew.avif'
        ]);
        Product::create([
            'category_id' => $coffee->id,
            'name' => 'Iced Coffee',
            'slug' => 'Iced Coffee',
            'description' => 'Classic chill for daily boost',
            'price' => 25000,
            'stock' => rand(1, 20),
            'image' => 'iced coffee.avif'
        ]);
        Product::create([
            'category_id' => $coffee->id,
            'name' => 'Mocha',
            'slug' => 'Mocha',
            'description' => 'Coffee meets sweet chocolate romance',
            'price' => 35000,
            'stock' => rand(1, 20),
            'image' => 'mocha.avif'
        ]);
        Product::create([
            'category_id' => $coffee->id,
            'name' => 'Vietnam Drip',
            'slug' => 'Vietnam Drip',
            'description' => 'Slow drip, pure sweet patience',
            'price' => 22000,
            'stock' => rand(1, 20),
            'image' => 'vietnam drip.avif'
        ]);

        // 

        Product::create([
            'category_id' => $nonCoffee->id,
            'name' => 'Red Velvet',
            'slug' => 'Red Velvet',
            'description' => 'Creamy red velvet over ice',
            'price' => 32000,
            'stock' => rand(1, 20),
            'image' => 'redvelvet.avif'
        ]);
        Product::create([
            'category_id' => $nonCoffee->id,
            'name' => 'Chocolate',
            'slug' => 'Chocolate',
            'description' => 'Rich dark chocolate served cold',
            'price' => 28000,
            'stock' => rand(1, 20),
            'image' => 'coklat.avif'
        ]);
        Product::create([
            'category_id' => $nonCoffee->id,
            'name' => 'Matcha',
            'slug' => 'Matcha',
            'description' => 'Earthy green tea served ice-cold',
            'price' => 35000,
            'stock' => rand(1, 20),
            'image' => 'matcha.avif'
        ]);
        Product::create([
            'category_id' => $nonCoffee->id,
            'name' => 'Taro',
            'slug' => 'Taro',
            'description' => 'Sweet purple taro on ice',
            'price' => 30000,
            'stock' => rand(1, 20),
            'image' => 'taro.avif'
        ]);
        Product::create([
            'category_id' => $nonCoffee->id,
            'name' => 'Tea',
            'slug' => 'Tea',
            'description' => 'Ice-cold tea always hits the spot',
            'price' => 18000,
            'stock' => rand(1, 20),
            'image' => 'teh.avif'
        ]);

        //

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
            'category_id' => $dessert->id,
            'name' => 'Apple Pie',
            'slug' => 'Apple Pie',
            'description' => 'Warm spiced apple pastry treat',
            'price' => 28000,
            'stock' => rand(1, 20),
            'image' => 'apple pie.avif'
        ]);
        Product::create([
            'category_id' => $dessert->id,
            'name' => 'Cromboloni',
            'slug' => 'Cromboloni',
            'description' => 'Crispy roll with creamy filling',
            'price' => 32000,
            'stock' => rand(1, 20),
            'image' => 'kromboloni.webp'
        ]);
        Product::create([
            'category_id' => $dessert->id,
            'name' => 'Strawberry Shortcake',
            'slug' => 'Strawberry Shortcake',
            'description' => 'Light sponge with fresh berries',
            'price' => 35000,
            'stock' => rand(1, 20),
            'image' => 'str shortcake.avif'
        ]);
        Product::create([
            'category_id' => $dessert->id,
            'name' => 'Tiramisu',
            'slug' => 'Tiramisu',
            'description' => 'Rich coffee layered dessert slice',
            'price' => 38000,
            'stock' => rand(1, 20),
            'image' => 'tiramisu.avif'
        ]);
    }
}
