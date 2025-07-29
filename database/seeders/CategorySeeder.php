<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics', 'Clothing', 'Footwear', 'Accessories',
            'Beauty', 'Home', 'Bags', 'Stationery', 'Furniture', 'Sports'
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
