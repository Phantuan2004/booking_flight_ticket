<?php

namespace Database\Seeders;

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
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone' => '',
                'address' => '',
                'password' => bcrypt(0000),
                'role' => 'admin',
                'status' => 'activate',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($user as $acc) {
            DB::table('users')->insert([
                'name' => $acc['name'],
                'email' => $acc['email'],
                'phone' => $acc['phone'],
                'address' => $acc['address'],
                'password' => $acc['password'],
                'role' => $acc['role'],
                'status' => $acc['status'],
                'created_at' => $acc['created_at'],
                'updated_at' => $acc['updated_at']
            ]);
        }
    }
}
