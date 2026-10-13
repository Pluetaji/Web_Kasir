<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $makanan = Category::where('name', 'Makanan Utama')->first();
        $minuman = Category::where('name', 'Minuman')->first();
        $camilan = Category::where('name', 'Camilan')->first();

        $products = [
            [
                'category_id' => $makanan?->id,
                'name' => 'Nasi Goreng Spesial',
                'description' => 'Nasi goreng dengan telur mata sapi, suwiran ayam, dan kerupuk',
                'price' => 25000,
                'image' => null,
                'is_active' => true,
            ],
            [
                'category_id' => $makanan?->id,
                'name' => 'Ayam Bakar Madu',
                'description' => 'Ayam bakar dengan bumbu madu legit disajikan dengan sambal terasi',
                'price' => 32000,
                'image' => null,
                'is_active' => true,
            ],
            [
                'category_id' => $minuman?->id,
                'name' => 'Es Teh Manis Jumbo',
                'description' => 'Es teh manis segar ukuran jumbo',
                'price' => 8000,
                'image' => null,
                'is_active' => true,
            ],
            [
                'category_id' => $minuman?->id,
                'name' => 'Kopi Susu Aren',
                'description' => 'Perpaduan espresso, susu segar, dan gula aren asli',
                'price' => 18000,
                'image' => null,
                'is_active' => true,
            ],
            [
                'category_id' => $camilan?->id,
                'name' => 'Kentang Goreng Crispy',
                'description' => 'French fries renyah bertabur bumbu gurih dengan saus sambal',
                'price' => 15000,
                'image' => null,
                'is_active' => true,
            ],
            [
                'category_id' => $camilan?->id,
                'name' => 'Pisang Goreng Keju',
                'description' => 'Pisang goreng renyah dengan topping keju parut melimpah dan susu kental manis',
                'price' => 20000,
                'image' => null,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                $product
            );
        }
    }
}
