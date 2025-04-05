<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 4; $i++) {
            DB::table('users')->insert([
                'user_code' => 'User_' . $faker->unique()->randomNumber(5),
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->unique()->phoneNumber,
                'address' => $faker->address,
                'password' => bcrypt('password'), // Mật khẩu đã mã hóa
                'role' => 'user', // Hoặc 'admin'
                'status' => 'activate',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
