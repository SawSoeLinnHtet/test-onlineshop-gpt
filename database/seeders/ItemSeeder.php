<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $products = [
            ['Laptop Pro X15', 'Electronics'],
            ['AirBoost Sneakers', 'Footwear'],
            ['Elegant Wrist Watch', 'Accessories'],
            ['BassUp Bluetooth Speaker', 'Electronics'],
            ['Urban Travel Backpack', 'Bags'],
            ['Smartphone Nova Z', 'Electronics'],
            ['ComfyFit Hoodie', 'Clothing'],
            ['Polarized Sunglasses', 'Accessories'],
            ['Ocean Mist Perfume', 'Beauty'],
            ['Ergo Wireless Mouse', 'Electronics'],
            ['Ceramic Coffee Mug', 'Home'],
            ['Classic Leather Notebook', 'Stationery'],
            ['Vintage T-Shirt', 'Clothing'],
            ['Recliner Gaming Chair', 'Furniture'],
            ['UltraSharp LED Monitor', 'Electronics'],
        ];

        foreach ($products as [$name, $categoryName]) {
            $categoryID = DB::table('categories')->where('name', $categoryName)->value('id');

            if (!$categoryID) continue; // skip if not found

            DB::table('items')->insert([
                'codeNo'      => $faker->ean8(),
                'name'        => $name,
                'image'       => "https://source.unsplash.com/640x480/?".Str::slug($name),
                'price'       => $faker->numberBetween(10000, 90000),
                'description' => $faker->paragraph,
                'discount'    => rand(0, 50),
                'inStock'     => rand(0, 1),
                'categoryID'  => $categoryID,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }    
}
