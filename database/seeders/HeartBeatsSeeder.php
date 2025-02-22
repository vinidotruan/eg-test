<?php

namespace Database\Seeders;

use App\Models\HeartBeat;
use App\Models\User;
use Illuminate\Database\Seeder;

class HeartBeatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        for($i=0;$i<10;$i++){
            HeartBeat::create([
                'user_id' => $user->id,
                'data' => fake()->numberBetween(60, 190),
                'created_at' => fake()->dateTimeBetween('-1 month', 'now'),
            ]);
        }

    }
}
