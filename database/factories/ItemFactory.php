<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->word;
        return [
            'codeNo' => $this->faker->ean8,
            'name' => $name,
            'image' => $this->faker->imageUrl(640, 480, $name, true),
            'price' => $this->faker->numberBetween(10000,90000),
            'description' => $this->faker->paragraph,
            'discount' => rand(0,100),
            'inStock' => rand(0,1),
            'categoryID' => rand(1,10)
        ];
    }
}
