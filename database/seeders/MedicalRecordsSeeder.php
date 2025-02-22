<?php

namespace Database\Seeders;

use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalRecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        for ($i=0; $i < 1000; $i++) {
            MedicalRecord::create([
                'user_id' => $user->id,
                'weight' => fake()->randomFloat(2, 50, 100),
                'height' => 168,
                'observations' => fake()->sentence(59),
                'created_at' => fake()->dateTimeBetween('-1 month', 'now'),
            ]);
        }
    }
}
