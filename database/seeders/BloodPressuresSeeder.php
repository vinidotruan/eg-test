<?php

namespace Database\Seeders;

use App\Models\BloodPressure;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodPressuresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        for ($i=0; $i < 10; $i++) {
            BloodPressure::create([
                'user_id' => $user->id,
                'systolic' => fake()->numberBetween(110, 140),
                'diastolic' => fake()->numberBetween(70, 90),
                'created_at' => fake()->dateTimeBetween('-1 month', 'now'),
            ]);
        }
    }
}
