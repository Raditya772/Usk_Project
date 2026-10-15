<?php

namespace Database\Seeders;

use App\Models\CertificationScheme;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'admin',
        ]);

        CertificationScheme::firstOrCreate(
            ['code' => 'JWD-01'],
            [
                'name' => 'Junior Web Developer',
                'description' => 'Skema sertifikasi pengembangan web tingkat junior.',
            ]
        );
    }
}
