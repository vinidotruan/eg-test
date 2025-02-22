<?php

namespace Database\Seeders;

use App\Models\Step;
use App\Models\User;
use Illuminate\Database\Seeder;

class StepsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        for ($i=0; $i < 1000; $i++) {
            Step::create([
                'user_id' => $user->id,
                'data' => fake()->numberBetween(1000, 10000),
                'created_at' => fake()->dateTimeBetween('-1 month', 'now'),
            ]);
        }
    }
}
