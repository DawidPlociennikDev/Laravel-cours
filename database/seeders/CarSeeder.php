<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cars')->insert([
            'name' => Str::random(18),
            'created_at' => now(),
            'updated_at' => now(),
            'lpg' => 0,
            'email' => 'mail@mail.eu',
            'counter' => random_int(1, 1000),
            'description' => Str::random(100) . '\nPrice = ' . random_int(250000, 1000000) / 100,
            'purchased_on' => date("Y-m-d"),
            'liczba' => DB::table('cars')->count() + 1,
        ]);
    }
}
