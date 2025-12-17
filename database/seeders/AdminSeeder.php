<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat atau update admin user
        User::updateOrCreate(
            ['email' => 'admin@agrowisata.com'],
            [
                'name' => 'Admin Agrowisata',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        $this->command->info('Admin user berhasil dibuat: admin@agrowisata.com / admin123');
    }
}
