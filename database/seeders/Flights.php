<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Flights extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 5; $i++) {
            DB::table('flights')->insert([
                'airline_id' => rand(1, 3),
                'flight_code' => 'VN' . $faker->unique()->randomNumber(5),
                'departure' => $faker->city,
                'destination' => $faker->city,
                'departure_time' => $faker->dateTimeBetween('-1 year', 'now'),
                'arrival_time' => $faker->dateTimeBetween('-1 year', 'now'),
                'price' => $faker->randomFloat(2, 100, 1000),
                'seats' => $faker->randomNumber(2),
                'available_seats' => $faker->randomNumber(2),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
