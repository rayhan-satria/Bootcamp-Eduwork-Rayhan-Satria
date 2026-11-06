<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Elektronik',
            'Fashion',
            'Rumah Tangga',
            'Olahraga',
        ];

        $categoryIds = [];

        foreach ($categories as $categoryName) {
            $category = ProductCategory::firstOrCreate(
                ['slug' => str($categoryName)->slug()],
                ['name' => $categoryName]
            );

            $categoryIds[$categoryName] = $category->id;
        }

        $products = [
            // ELEKTRONIK
            [
                'category' => 'Elektronik',
                'name' => 'Wireless Headphone',
                'slug' => 'wireless-headphone',
                'description' => 'Headphone wireless dengan suara jernih dan baterai tahan lama.',
                'price' => 350000,
                'stock' => 25,
                'image' => 'products/headphone.avif',
            ],
            [
                'category' => 'Elektronik',
                'name' => 'Mechanical Keyboard',
                'slug' => 'mechanical-keyboard',
                'description' => 'Keyboard mechanical dengan RGB lighting dan switch responsif.',
                'price' => 450000,
                'stock' => 15,
                'image' => 'products/keyboard.avif',
            ],
            [
                'category' => 'Elektronik',
                'name' => 'Wireless Mouse',
                'slug' => 'wireless-mouse',
                'description' => 'Mouse wireless ergonomis untuk produktivitas dan gaming.',
                'price' => 175000,
                'stock' => 30,
                'image' => 'products/mouse.avif'
            ],
            [
                'category' => 'Elektronik',
                'name' => 'Power Bank 20000mAh',
                'slug' => 'power-bank',
                'description' => 'Power bank berkapasitas besar dengan fast charging.',
                'price' => 275000,
                'stock' => 20,
                'image' => 'products/pb.avif'
            ],
            [
                'category' => 'Elektronik',
                'name' => 'Bluetooth Speaker',
                'slug' => 'bluetooth-speaker',
                'description' => 'Speaker portable dengan bass kuat dan koneksi Bluetooth.',
                'price' => 320000,
                'stock' => 18,
                'image' => 'products/speaker.avif'
            ],

            // FASHION
            [
                'category' => 'Fashion',
                'name' => 'Basic Oversized T-Shirt',
                'slug' => 'basic-tshirt',
                'description' => 'Kaos oversized berbahan cotton combed yang nyaman.',
                'price' => 85000,
                'stock' => 40,
                'image' => 'products/ovts.avif',
            ],
            [
                'category' => 'Fashion',
                'name' => 'Denim Jacket',
                'slug' => 'denim-jacket',
                'description' => 'Jaket denim dengan desain casual dan timeless.',
                'price' => 275000,
                'stock' => 12,
                'image' => 'products/denim.avif'
            ],
            [
                'category' => 'Fashion',
                'name' => 'Canvas Sneakers',
                'slug' => 'canvas-sneakers',
                'description' => 'Sepatu sneakers canvas untuk penggunaan sehari-hari.',
                'price' => 220000,
                'stock' => 20,
                'image' => 'products/sneakers.avif'
            ],
            [
                'category' => 'Fashion',
                'name' => 'Casual Backpack',
                'slug' => 'casual-backpack',
                'description' => 'Tas backpack multifungsi dengan banyak kompartemen.',
                'price' => 180000,
                'stock' => 16,
                'image' => 'products/backpack.avif'
            ],
            [
                'category' => 'Fashion',
                'name' => 'Classic Wristwatch',
                'slug' => 'classic-wristwatch',
                'description' => 'Jam tangan casual dengan desain minimalis.',
                'price' => 325000,
                'stock' => 10,
                'image' => 'products/watch.avif'
            ],

            // RUMAH TANGGA
            [
                'category' => 'Rumah Tangga',
                'name' => 'Electric Kettle',
                'slug' => 'electric-kettle',
                'description' => 'Ketel listrik stainless steel dengan kapasitas 1.8 liter.',
                'price' => 195000,
                'stock' => 15,
                'image' => 'products/watch.avif'
            ],
            [
                'category' => 'Rumah Tangga',
                'name' => 'Table Lamp',
                'slug' => 'table-lamp',
                'description' => 'Lampu meja minimalis untuk belajar dan bekerja.',
                'price' => 125000,
                'stock' => 22,
                'image' => 'products/lamp.avif'
            ],
            [
                'category' => 'Rumah Tangga',
                'name' => 'Storage Organizer',
                'slug' => 'storage-organizer',
                'description' => 'Kotak penyimpanan multifungsi untuk merapikan barang.',
                'price' => 65000,
                'stock' => 35,
                'image' => 'products/storage.avif'
            ],
            [
                'category' => 'Rumah Tangga',
                'name' => 'Nonstick Frying Pan',
                'slug' => 'frying-pan',
                'description' => 'Wajan anti lengket untuk kebutuhan memasak sehari-hari.',
                'price' => 155000,
                'stock' => 14,
                'image' => 'products/pan.avif'
            ],
            [
                'category' => 'Rumah Tangga',
                'name' => 'Digital Wall Clock',
                'slug' => 'digital-clock',
                'description' => 'Jam dinding digital dengan tampilan LED.',
                'price' => 145000,
                'stock' => 18,
                'image' => 'products/clock.avif'
            ],

            // OLAHRAGA
            [
                'category' => 'Olahraga',
                'name' => 'Yoga Mat',
                'slug' => 'yoga-mat',
                'description' => 'Matras yoga anti-slip untuk olahraga dan stretching.',
                'price' => 110000,
                'stock' => 25,
                'image' => 'products/mat.avif'
            ],
            [
                'category' => 'Olahraga',
                'name' => 'Adjustable Dumbbell',
                'slug' => 'adjustable-dumbbell',
                'description' => 'Dumbbell adjustable untuk latihan kekuatan di rumah.',
                'price' => 550000,
                'stock' => 8,
                'image' => 'products/dumbbell.avif'
            ],
            [
                'category' => 'Olahraga',
                'name' => 'Resistance Band Set',
                'slug' => 'resistance-band',
                'description' => 'Set resistance band dengan berbagai tingkat resistansi.',
                'price' => 95000,
                'stock' => 30,
                'image' => 'products/bands.avif'
            ],
            [
                'category' => 'Olahraga',
                'name' => 'Sports Water Bottle',
                'slug' => 'sports-bottle',
                'description' => 'Botol minum olahraga dengan kapasitas 1 liter.',
                'price' => 75000,
                'stock' => 28,
                'image' => 'products/bottle.avif'
            ],
            [
                'category' => 'Olahraga',
                'name' => 'Skipping Rope',
                'slug' => 'skipping-rope',
                'description' => 'Tali skipping dengan panjang yang dapat disesuaikan.',
                'price' => 45000,
                'stock' => 40,
                'image' => 'products/skipping.avif'
            ],
        ];

        foreach ($products as $product) {
            $slug = str($product['name'])->slug();

            Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'product_category_id' => $categoryIds[$product['category']],
                    'name' => $product['name'],
                    'slug' => $slug,
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                    'image' => $product['image'],
                ]
            );
        }
    }
}
