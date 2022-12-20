<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Generate Random Date
        $year = rand(2009, 2016);
        $month = rand(1, 12);
        $day = rand(1, 28);

        $date = Carbon::create($year,$month ,$day , 0, 0, 0);


        DB::table('book')->insert([
            'tittle' => Str::random(10),
            'author' => Str::random(10).'@gmail.com',
            'isbn' => random_int(1,100),
            'publish_date'=>$date->format('Y-m-d H:i:s'),
        ]);
    }
}
