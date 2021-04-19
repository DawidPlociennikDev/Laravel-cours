<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\RepairFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Repair::factory(5)->create();
        //for ($n=100; --$n;) $this->call(CarSeeder::class);
    }
}
