<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'voucherNo' => $this->faker->ean13,
            'qty' => rand(1,10),
            'total' => $this->faker->numberBetween(50000, 500000),
            'paymentSlip' => $this->faker->imageUrl(),
            'paymentID' => \App\Models\Payment::inRandomOrder()->first()->id,
            'itemID' => \App\Models\Item::inRandomOrder()->first()->id,
            'userID' => \App\Models\User::inRandomOrder()->first()->id,

        ];
    }
}
