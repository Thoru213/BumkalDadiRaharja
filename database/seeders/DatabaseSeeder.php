<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan semua seeders dalam urutan yang tepat
        $this->call([
            AdminSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
