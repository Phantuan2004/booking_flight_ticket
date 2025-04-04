<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Airlines extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airlines = [
            [
                'name' => 'Vietnam Airlines',
                'logo' => null
            ],
            [
                'name' => 'VietJet Air',
                'logo' => null
            ],
            [
                'name' => 'Jetstar Asia Airways',
                'logo' => null
            ]
        ];

        foreach ($airlines as $airline) {
            DB::table('airlines')->insert([
                'name' => $airline['name'],
                'logo' => $airline['logo']
            ]);
        }
    }
}
