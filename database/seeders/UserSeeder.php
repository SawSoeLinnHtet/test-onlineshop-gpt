<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['System', 'sys', 1],
            ['John Doe', 'john', 0],
            ['Jill Hamza', 'jill', 0],
            ['Mai Rosalind', 'mai', 0],
            ['Ronald Dacey', 'ron', 0],
            ['Sebastian Picasco', 'seb', 0],
            ['Jackie Pham', 'jack', 0],
        ];

        foreach ($users as $user) {
            User::firstOrCreate([
                'name' => $user[0],
                'email' => $user[1] . '@demo.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('demodemo'),
                'seller_status' => 'none'
            ]);
        }
    }
}
