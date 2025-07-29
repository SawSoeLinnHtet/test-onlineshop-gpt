<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            ['KPay', '0912345678', 'Isaac'],
            ['Wave Pay', '0912345678', 'Isaac']
        ];

        foreach ($methods as $method) {
            Payment::firstOrCreate([
                'name' => $method[0],
                'account_number' => $method[1],
                'account_name' => $method[2]
            ]);
        }
    }
}
