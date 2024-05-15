<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun admin default
        User::create([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => Hash::make('Admin1234'), 
            'phone' => '08123456789', 
            'type' => true 
        ]);

        // Membuat beberapa akun pengguna lainnya jika diperlukan
        // \App\Models\User::factory(10)->create();
    }
}
