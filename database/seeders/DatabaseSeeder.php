<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TestUserSeeder::class,
            MedicalRecordsSeeder::class,
            HeartBeatsSeeder::class,
            StepsSeeder::class,
            BloodPressuresSeeder::class,
        ]);User::factory(10)->create();

    }
}
