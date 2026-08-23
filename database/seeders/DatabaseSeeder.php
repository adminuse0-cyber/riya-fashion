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
        $this->call([
            BusinessSettingSeeder::class,
            ServiceSeeder::class,
            WorkProcessSeeder::class,
        ]);
        
        // Note:
        // 1. Client reviews start completely empty (0 fake reviews).
        // 2. Admin user accounts are created securely via `php artisan admin:create`
        //    without committing or hardcoding passwords.
    }
}
