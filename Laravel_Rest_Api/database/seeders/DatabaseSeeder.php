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
        for($i =0; $i<10; $i++)
        {
            $this->call
            ([
                UserSeeder::class,
                BookSeeder::class,
            ]);
        }
        Review::factory(5)->create();
        Checkout::factory(5)->create();

    }
}
