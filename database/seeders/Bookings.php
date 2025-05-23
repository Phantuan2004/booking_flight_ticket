<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Bookings extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 5; $i++) {
            DB::table('bookings')->insert([
                'booking_code' => 'SK' . $faker->unique()->randomNumber(5),
                'user_id' => rand(3, 4),
                'flight_id' => rand(6, 10),
                'total_price' => $faker->randomFloat(2, 100, 1000),
                'status' => 'chưa giải quyết',
                'created_at' => now(),
            ]);
        }
    }
}
