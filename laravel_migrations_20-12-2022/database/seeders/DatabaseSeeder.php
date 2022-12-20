<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CheckOut;
use App\Models\Checkouts;
use App\Models\Review;
use App\Models\Reviews;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([

           // UserSeeder::class,
            //BookSeeder::class,
        ]);
        Reviews::factory(5)->create();
        Checkouts::factory(10)->create();

    }
}