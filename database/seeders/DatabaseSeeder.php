<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Laravel Developer',
            'username' => 'developer',
            'email' => 'developer@gmail.com',
            'password' => 'Test@Password123#'
        ]);
        $this->call(LoanDetailsSeeder::class);
    }
}
